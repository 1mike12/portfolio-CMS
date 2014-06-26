<?php
if (!isset($photo)) {
    $photo = new Photo;
}

?>
{{ Form::open(array('action'=>"PhotoController@postCreate", 'class'=>'photoForm form-inline', "files"=>true)) }}

<div class="bg-warning">
</div>
<div class="row">

    <div class="col-sm-10">
        {{ Form::hidden("id", $photo->id)}}
        {{ Form::hidden("project_id", $photo->project_id)}}
        <div class="form-group">
            <img class="photoFieldThumbnail" src="{{$photo->getURL()}}"/>
        </div>
        <div class="form-group">
            {{ Form::file("photo", ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{ Form::text('name', $photo->name, [ 'class'=>'form-control','placeholder'=>'title']) }}
        </div>

        <div class="form-group">
            {{ Form::textarea('caption', $photo->caption, ['class'=>'form-control', 'placeholder'=>'caption', "rows"=>"1"]) }}
        </div>
        
        <div class="form-group">
            {{ Form::text("weight", $photo->weight, [ 'class'=>'form-control','placeholder'=>'weight'])}}
        </div>
    </div>

    <div class="col-sm-2">
        {{Form::submit("submit", ["class"=>"photoSubmit btn btn-primary"])}}
        {{Form::button("delete", ["class"=>"photoDelete btn btn-warning"])}}
    </div>
</div>

{{ Form::close() }}