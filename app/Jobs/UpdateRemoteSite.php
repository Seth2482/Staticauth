<?php

namespace App\Jobs;

use App\Site;
use Cz\Git\GitRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class UpdateRemoteSite implements ShouldQueue
{
    /**
     * @var Site $site
     */
    private $site;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 缓存文件夹
        $cacheFolder = Storage::path($this->site->project->id);

        // 不存在则克隆
        if (realpath($cacheFolder)) {
            $repo = new GitRepository($cacheFolder);
        } else {
            $repo = GitRepository::cloneRepository($this->site->project->git, $cacheFolder);
        }

        // 文件名
        $filename = base64_encode($this->site->url);

        // 绝对路径
        $filepath = "{$cacheFolder}/{$filename}";

        // 该站点被软删除
        if ($this->site->trashed()) {
            // 还未被删除
            if (realpath($filepath)) {
                $repo->removeFile($filename);
                $this->commitAndPush($repo);
            }
            $this->site->forceDelete();

        } else {
            // 生成内容
            $filecontent = json_encode($this->site->only(['extra', 'expire_at']));

            $result = file_put_contents($filepath, $filecontent);
            if (!$result) {
                throw new \Exception('写入文件失败');
            }

            $this->commitAndPush($repo);

            $this->finished();
        }
    }

    public function commitAndPush(GitRepository $repo)
    {
        if ($repo->hasChanges()) {
            $repo->addAllChanges();
            $repo->commit('auto update');
            $repo->push();
        }
    }

    public function finished()
    {
        $this->site->update([
            'status' => Site::STATUS_COMMITTED
        ]);
    }
}
