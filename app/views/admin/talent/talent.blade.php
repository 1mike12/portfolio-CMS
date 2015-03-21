{{HTML::linkAction("AdminController@getIndex","Back to Admin")}}
<h2 class="form-signup-heading">Create or modify</h2>

{{ Form::open(['action'=>$action, 'class'=>'form-horizontal']) }}
{{Form::hidden("id", $instance->id)}}

<div class="form-group">
    {{ Form::label("name", "Talent Name", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-4">
        {{ Form::text('name', $instance->name, ['class'=>'form-control', 'placeholder'=>'enter name']) }}
    </div>

    {{ Form::label("weight", "Weight", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-4">
        {{ Form::text('weight', $instance->weight, ['class'=>'form-control', 'placeholder'=>'enter a number']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
</div>
@if (isset($delete))
<div class="form-group">
    <a href="{{URL::action($Model."Controller@getDelete", $instance->id)}}" class="btn btn-warning">Delete</a>
</div>
@endif
{{ Form::close() }}
