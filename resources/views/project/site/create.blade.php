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

    <form method="post" action="{{route('project.site.store')}}">
        {{csrf_field()}}
        <input type="text" name="project_id" value="{{$project->id}}" style="display: none;">
        <div class="form-group">
            <label for="projectName">URL</label>
            <input type="text" class="form-control @if($errors->has('url'))is-invalid @endif" id="siteUrl"
                   name="url" placeholder="google.com" value="{{old('url')}}">
            @if($errors->has('url'))
                <p class="invalid-feedback">
                    @foreach($errors->get('url') as $message)
                        {{$message}}
                    @endforeach
                </p>
            @endif
        </div>
        <div class="form-group">
            <label for="siteExpireAt">到期时间（空为永久）</label>
            <input type="text" class="form-control @if($errors->has('expire_at'))is-invalid @endif" id="siteExpireAt"
                   name="expire_at" placeholder="2012-12-12"
                   value="{{old('expire_at')}}">
            @if($errors->has('expire_at'))
                <p class="invalid-feedback">
                    @foreach($errors->get('expire_at') as $message)
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
