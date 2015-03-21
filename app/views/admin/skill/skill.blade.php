{{HTML::linkAction("AdminController@getIndex","Back to Admin")}}
<h2 class="form-signup-heading">Create or modify</h2>

{{ Form::open(['action'=>$action, 'class'=>'form-horizontal']) }}
{{Form::hidden("id", $instance->id)}}
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Skill Name</label>
    <div class="col-sm-3">
        {{ Form::text('name', $instance->name, ['class'=>'form-control', 'placeholder'=>'enter name']) }}
    </div>
    <label for="talent_id" class="col-sm-3 control-label">Talent</label>
    <div class="col-sm-3">
        {{ Form::select('talent_id', Talent::lists("name", "id"), $instance->talent_id, ["class"=>"form-control"]) }}  
    </div>
</div>

<div class="form-group">
    <label for="weight" class="col-sm-2 control-label">Weight</label>
    <div class="col-sm-4">
        {{ Form::text('weight', $instance->weight, ['class'=>'form-control', 'placeholder'=>'enter a number']) }}
    </div>
    <label for="level" class="col-sm-2 control-label">Level</label>
    <div class="col-sm-4 ">
        {{ Form::select('level', [1=>1,2=>2,3=>3,4=>4,5=>5], $instance->level, ["class"=>"form-control"]) }}  
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