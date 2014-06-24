{{HTML::linkAction("AdminController@getIndex","Back to Admin")}}
<h2 class="form-signup-heading">Edit {{$model}}</h2>
<?php
//form::label()
//form::TYPE(name, value, [attributes])
//form::SELECTABLE(name, value, {selected},[attributes]) --select, checkbox,radio

?>
{{ Form::open(array('action'=>$action, 'class'=>'form-horizontal', "files"=>true)) }}

{{ Form::hidden("id", $instance->id)}}
<div class="form-group">
    {{ Form::label("name", "Project Name", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-10">
        {{ Form::text('name', $instance->name, array('class'=>'col-sm-10 form-control', 'placeholder'=>'project name')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("talent_id", "Talent Name", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-3">
        {{ Form::select('talent_id', Talent::lists("name", "id"), null, ['class'=>'form-control']) }}
    </div>
    {{ Form::label("startDate", "Start Date", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-3">
        <input type="date" class="form-control" name="startDate" value="{{$instance->startDate}}"/>
    </div>
    {{ Form::label("weight", "Weight", ["class"=>"col-sm-1 control-label"])}}
    <div class="col-sm-1">
        {{ Form::text('weight', $instance->weight, array('class'=>'form-control', 'placeholder'=>'weight')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("skills[]", "Skills", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-10">
        @foreach($allSkills as $id=>$array)
        <label class="checkbox-inline">
            {{Form::checkbox('skills[]', $id , $array["selected"], ["class"=>""])}}
            {{$array["name"]}}
        </label>
        @endforeach
    </div>
</div>

<div class="form-group">
    {{ Form::label("content", "Content", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-10">
        {{ Form::textarea('content', $instance->content, array('class'=>'form-control', 'placeholder'=>'enter content. HTML allowed')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("thumbnail", "Thumbnail", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-10">
        {{ Form::text('thumbnail', $instance->thumbnail, array('class'=>'form-control', 'placeholder'=>'thumbnail')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("cover", "Cover", ["class"=>"col-sm-2 control-label"])}}
    <div class="col-sm-10">
        {{ Form::text('cover', $instance->cover, array('class'=>'form-control', 'placeholder'=>'cover')) }}
    </div>
</div>
{{ Form::submit('Submit', array('class'=>'btn btn-primary'))}}
{{ Form::close() }}
@if (isset($delete))
{{ Form::open(array('action'=>$delete, 'class'=>'')) }}
{{ Form::hidden("id", $instance->id)}}
{{ Form::submit("Delete ". $model, ["class"=>"btn btn-warning"])}}
{{ Form::close() }}
@endif




@if(isset($delete))
<h2>Photos</h2>
<div id="photoFormWrapper">
    @foreach($photos as $photo)
    @include("admin.photo.field")
    @endforeach
</div>
{{ Form::button("add new photo", ["class"=>"addNewPhoto btn btn-default btn-block", "project_id"=>$instance->id])}}
@endif

