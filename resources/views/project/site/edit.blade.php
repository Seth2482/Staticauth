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
            <a id="listPage" class="nav-link {{active_class(if_route('project.site.list'))}}"
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

    <form method="post" action="{{route('project.site.store', $site)}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="projectName">URL</label>
            <input type="text" class="form-control @if($errors->has('url'))is-invalid @endif" id="siteUrl"
                   name="url" placeholder="google.com" value="{{$site->url}}">
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
                   value="{{$site->expire_at}}">
            @if($errors->has('siteExpireAt'))
                <p class="invalid-feedback">
                    @foreach($errors->get('siteExpireAt') as $message)
                        {{$message}}
                    @endforeach
                </p>
            @endif
        </div>
        <br/>
        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                data-target="#deleteConfirm" style="margin-right: 1em;"
        >删除
        </button>
        <button type="submit" class="btn btn-outline-primary">保存</button>
    </form>
    <!-- 模态框 -->
    <div class="modal fade" id="deleteConfirm">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">确认删除</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body">
                    您真的要删除这个站点吗？此操作不可恢复。
                </div>

                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary  delete-button"
                            href="{{route('project.site.delete', compact('project','site'))}}">确认
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete-button').on('click', function () {
                axios.post($(this).attr('href'))
                    .then(function (response) {
                        window.location = $('#listPage').attr('href');
                    });
            });
        });
    </script>
@endsection
