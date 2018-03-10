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

    <div>

        @if(count($sites) > 0 )
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">URL</th>
                    <th scope="col">到期时间</th>
                    <th scope="col">状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sites as $site)
                    <tr style="cursor: pointer;" href="{{route('project.site.edit', compact('site','project'))}}">
                        <th scope="row">{{$site->id}}</th>
                        <td>{{$site->url}}</td>
                        @if(empty($site->expire_at))
                            <td>永久</td>
                        @else
                            <td>{{$site->expire_at}}</td>
                        @endif
                        @switch($site->status)
                            @case(\App\Site::STATUS_UNCOMMIT)
                            <td class="text-info">等待提交</td>
                            @break
                            @case(\App\Site::STATUS_COMMITTED)
                            <td class="text-success">正常</td>
                            @break
                            @case(\App\Site::STATUS_FAILED)
                            <td class="text-danger">提交失败</td>
                            @break
                            @default
                            <td class="text-waring">未知错误({{$site->status}})</td>
                            @break
                        @endswitch
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div style="margin: 5em; text-align: center;color: #7f929b;">
                什么都还没有诶...
            </div>
        @endif
        <div style="margin: 1em;">{{$sites->links()}}</div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('tr').on('click', function () {
                if ($(this).attr('href') !== undefined) {
                    window.location = $(this).attr('href');
                }
            });
        })
    </script>
@endsection