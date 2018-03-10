<?php

namespace App\Console\Commands;

use App\Jobs\UpdateRemoteSite;
use App\Site;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SITEClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '删除已过期的站点';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $expiredSites = Site::where('expire_at', '<', Carbon::now())->get();
        foreach ($expiredSites as $expiredSite){
            if ($expiredSite->delete()){
                dispatch(new UpdateRemoteSite($expiredSite));
                $this->info("已将站点 [{$expiredSite->id}]{$expiredSite->url} 加入删除队列");
            }else{
                $this->error("无法删除站点 [{$expiredSite->id}]{$expiredSite->url} ");
            }
        }
    }
}
