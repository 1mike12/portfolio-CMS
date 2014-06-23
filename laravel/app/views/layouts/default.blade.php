<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        {{HTML::style("css/default.css");}}
        {{HTML::style("css/admin.css");}}
        @yield("extraStyles")
    </head>
    <body>
        <div id="header">
        </div>
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

        <div id="footer">
            <span>{{HTML::linkAction("UserController@getLogin", "login")}}</span>
        </div>
        <script>
            var PUBLIC= "{{URL::to('/') . '/'}}";
            <?php 
            $url= URL::action("AdminController@getIndex");
            $adminURL= str_replace("index", "", $url);
            ?>
            var ADMIN= "{{$adminURL}}";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        {{HTML::script("scripts/admin.js")}}
        
        @yield("extraScripts")
    </body>
</html>