@extends('layouts.home')

@section('content')
    <div>
        <h4 style="color: rgba(0,0,0, .64)">
            <i class="material-icons">add_circle_outline</i>
            创建项目
        </h4>

        <hr/>
    </div>
    <form method="post" action="{{route('project.store')}}">
        {{csrf_field()}}
        <div class="form-group @if($errors->has('name')) has-error @endif">
            <label for="projectName">项目名</label>
            <input type="text" class="form-control @if($errors->has('name'))is-invalid @endif" id="projectName"
                   name="name" placeholder="A New Project" value="{{old('name')}}">
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
                   placeholder="git@github.com:test/test.git" value="{{old('git')}}">
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