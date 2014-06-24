<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        {{HTML::style("css/default.css");}}
        {{HTML::style("css/admin.css");}}
        {{HTML::style("css/home.css");}}
        {{HTML::style("css/projectList.css");}}
        @yield("extraStyles")
    </head>
    <body>
        <div id='wrap'>
            <div id="header">
                <div class="row">
                    <a href="{{URL::to("/")}}" id="logo" class="col-xs-2">
                        Mike Qin
                    </a>
                    <ul class="col-xs-10">
                        <li><a href="{{URL::to('resume')}}">resume</a></li>
                        <li><a href="{{URL::to('contact')}}">contact</a></li>
                    </ul>
                </div>
            </div>

            <div id="belt">
                @if(Session::has("message"))
                <div id="messageBanner">
                    {{{Session::get("message")}}}
                    @if($errors->all())
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endif

                <div id="contentWrapper">
                    @yield("content")
                </div>
            </div>
        </div>

        <div id="footer">
            <div>
                <a href="{{URL::action("AdminController@getIndex")}}" class="">admin</a>
                @if(Auth::check())
                /
                <a href="{{URL::action("UserController@getLogout")}}">logout</a>
                @endif
            </div>
        </div>

        <script>
            var PUBLIC = "{{URL::to('/') . '/'}}";
<?php
$url = URL::action("AdminController@getIndex");
$adminURL = str_replace("index", "", $url);

?>
            var ADMIN = "{{$adminURL}}";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        {{HTML::script("scripts/common.js")}}
        {{HTML::script("scripts/admin.js")}}
        {{HTML::script("scripts/jquery.zaccordion.min.js")}}
        @yield("extraScripts")

    </body>
</html>