<?php

namespace App\Http\Controllers;

use App\Events\SiteUpdated;
use App\Jobs\UpdateRemoteSite;
use App\Project;
use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function store(Site $site, Request $request)
    {
        $rules = [
            'url' => ['required',
                'regex:/^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'],
            'project_id' => 'required|exists:projects,id',
            'expire_at' => 'nullable|date_format:Y-m-d|after:today',
            'extra' => 'nullable|array'
        ];

        //TODO: 校验附加数据
        $data = $this->validate($request, $rules);
        $data['status'] = Site::STATUS_UNCOMMIT;
        $message = $site->exists() ? "站点已添加，请等待系统提交" : "授权站点已创建，请等待系统提交";

        if ($site->fill($data)->save()) {
            // 触发事件
            event(new SiteUpdated($site));

            // 分发任务
            dispatch(new UpdateRemoteSite($site));

            flash($message)->success();

        } else {
            flash('写入数据库失败')->error();
        }
        return back();
    }

    public function delete(Project $project, Site $site)
    {
        if (!$site->exists) {
            flash('站点不存在')->error();
            return back();
        }

        if ($site->delete()) {
            flash('站点已加入删除队列，请等待系统提交');
        } else {
            flash('写入数据库失败');
        }

        // 写不写都无所谓
        $site->update(['status' => Site::STATUS_COMMITTED]);

        return route('project.site.list', compact('project'));
    }
}
