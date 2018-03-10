<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{config('app.name')}}</title>

    <!-- styles -->
    <link href="{{mix('css/app.css')}}" rel="stylesheet">

</head>

<body>
{{--导航条 Start--}}
<div class="navbar">
    <span class="title">{{config('app.name')}}</span>

</div>
{{--导航条 End--}}


<div class="container">
    <div class="row">
        <div class="col-md-10 col-xs-12 offset-md-1 page-content">
            @include('flash::message')
            @yield('content')
        </div>
    </div>
</div>
<!-- scripts -->
<script src="{{mix('js/app.js')}}"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@yield('scripts')
</body>
</html>