@extends('layouts.home')

@section('content')
    <div>
        <h4 style="color: rgba(0,0,0, .64)">
            <i class="material-icons">explore</i>
            项目列表
            <span class="action-button">
                <a href="{{route('project.create')}}" class="btn btn-outline-primary">
                    添加项目
                </a>
            </span>
        </h4>

        <hr/>
    </div>
    <div class="list-group">
        @foreach($projects as $project)
            <a href="{{route('project.site.list', compact('project'))}}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$project->name}}</h4>
                <p class="list-group-item-text text-dark">{{$project->git}}</p>
            </a>
        @endforeach
        @if(count($projects) < 1)
            <div style="margin: 5em; text-align: center;color: #7f929b;">
                什么都还没有诶...
            </div>
        @endif
    </div>
@endsection