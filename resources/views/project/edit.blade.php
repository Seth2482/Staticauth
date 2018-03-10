@extends('layouts.home')

@section('content')
    <div>
        <h4 style="color: rgba(0,0,0, .64)">
            <i class="material-icons">description</i>
            {{$project->name}}
        </h4>
    </div>
    <br/>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{active_class(if_route('project.site.list'))}}"
               href="{{route('project.site.list', compact('project'))}}">站点列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{active_class(if_route('project.site.create'))}}"
               href="{{route('project.site.create', $project)}}">添加站点</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{active_class(if_route('project.edit'))}}" href="{{route('project.edit', $project)}}">修改项目</a>
        </li>
    </ul>
    <br/>
    <form method="post" action="{{route('project.store', compact('project'))}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="projectName">项目名</label>
            <input type="text" class="form-control @if($errors->has('name'))is-invalid @endif" id="projectName"
                   name="name" placeholder="A New Project" value="{{$project->name}}">
            @if($errors->has('name'))
                <p class="invalid-feedback">
                    @foreach($errors->get('name') as $message)
                        {{$message}}
                    @endforeach
                </p>
            @endif
        </div>
        <div class="form-group">
            <label for="projectGit">项目仓库</label>
            <input type="text" class="form-control @if($errors->has('git'))is-invalid @endif" id="projectGit" name="git"
                   placeholder="git@github.com:test/test.git" value="{{$project->git}}">
            @if($errors->has('git'))
                <p class="invalid-feedback">
                    @foreach($errors->get('git') as $message)
                        {{$message}}
                    @endforeach
                </p>
            @endif
        </div>
        <br/>
        <button type="submit" class="btn btn-outline-primary">保存</button>
    </form>
@endsection

@section('scripts')
@endsection
