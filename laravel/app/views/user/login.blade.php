<h2 class="form-signin-heading">Please Login</h2>
{{ Form::open(array("action"=>"UserController@postLogin", 'class'=>'form')) }}
<div class="form-group">
        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
</div>
<div class="form-group">
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
</div>

<div class="form-group">
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary'))}}
</div>
{{ Form::close() }}
