<?php

namespace App\Http\Controllers;

use App\Project;
use App\Site;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project.list', compact('projects'));
    }

    public function store(Project $project, Request $request)
    {
        $project = $project->refresh();
        $validator = validator($request->all(), [
            'name' => 'string|required',
            'extra' => 'array|nullable',
            'git' => ['required',
                'regex:/(?:git|ssh|git@[-\w.]+):(\/\/)?(.*?)(\.git)(\/?|\#[-\d\w._]+?)$/']
        ]);
        $validator->sometimes('git', 'unique:projects,git', function ($input) use ($project) {
            if ($project->exists())
                return $input !== $project->git;
            else
                return true;
        });

        $data = $validator->validate();

        $message = $project->exists() ? '修改已保存' : '项目已建立';
        if ($project->fill($data)->save()) {
            flash($message)->success();
        } else {
            flash('写入数据库失败')->error();
        }

        return back();
    }

    public function show(Project $project)
    {
        $sites = $project->sites()->paginate(15);
        return view('project.site.list', compact('project', 'sites'));
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function createSite(Project $project)
    {
        return view('project.site.create', compact('project'));
    }

    public function editSite(Project $project, Site $site)
    {
        return view('project.site.edit', compact('project', 'site'));
    }
}
