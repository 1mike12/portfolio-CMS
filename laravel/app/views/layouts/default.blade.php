<html class="{{isset($htmlClass)? $htmlClass:""}}">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        {{HTML::style("css/projectList.css")}}
        {{HTML::style("css/featherlight.min.css")}}
        {{HTML::style("css/default.css")}}
        {{HTML::style("css/admin.css")}}
        {{HTML::style("css/home.css")}}
        @yield("extraStyles")
    </head>
    <body>
        <div id='wrap'>
            <div id="header">
                <div class="row">
                    <a href="{{URL::to("/")}}" id="logo" class="col-xs-6">
                        Mike Qin
                    </a>
                    <ul class="col-xs-6">
                        <li><a class="{{ Request::is("about")? "active": ""}}" href="{{URL::to('about')}}">about</a></li>
                        <li><a class="{{ Request::is("contact")? "active": ""}}" href="{{URL::to('contact')}}">contact</a></li>
                        <li><a class="{{ Request::is("project-list")? "active": ""}}" href="{{URL::to('project-list')}}">projects</a></li>
                        @if(Auth::check())
                        <li>
                            <span><a href="{{URL::action("UserController@getLogout")}}">logout</a><a href="{{URL::action("AdminController@getIndex")}}" class="">admin</a></span>

                        </li>

                        @endif
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
            <div class="gradientLine"></div>
            <div class="text-center">
                <span class="copyright">All rights reserved Mike Qin. Copyright &copy; <?php echo date("Y"); ?> Mike Qin. <a href="{{URL::to("about#plugins")}}">how is the site made?</a></span>
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/amplifyjs/1.1.0/amplify.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        {{HTML::script("scripts/featherlight.min.js")}}
        {{HTML::script("scripts/jquery.zaccordion.min.js")}}
        {{HTML::script("scripts/isotope.js")}}
        {{HTML::script("scripts/common.js")}}
        {{HTML::script("scripts/admin.js")}}
        {{HTML::script("scripts/project_list.js")}}
    </body>
</html>