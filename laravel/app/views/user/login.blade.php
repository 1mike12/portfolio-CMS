<h2 class="form-signin-heading">Please Login</h2>
{{ Form::open(array("action"=>"UserController@postLogin", 'class'=>'form-horizontal')) }}
<div class="form-group">
    <div class="col-sm-6">
        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
    </div>
    <div class="col-sm-6">
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    </div>
</div>

{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
