<?php
if (!isset($photo)) {
    $photo = new Photo;
}

?>
{{ Form::open(array('action'=>"PhotoController@postCreate", 'class'=>'photoForm form-inline', "files"=>true)) }}
<div class="bg-warning"></div>
<div class="form-group">
    {{ Form::hidden("id", $photo->id)}}
    {{ Form::hidden("project_id", $photo->project_id)}}
    <img class="photoFieldThumbnail" src="{{$photo->getURL()}}"/>
    {{ Form::text('name', $photo->name, [ 'class'=>'form-control','placeholder'=>'title']) }}
    {{ Form::text('caption', $photo->caption, ['class'=>'form-control', 'placeholder'=>'caption']) }}
    {{ Form::file("photo", ['class'=>'form-control'])}}
    {{ Form::text("weight", $photo->weight, [ 'class'=>'form-control','placeholder'=>'weight'])}}
    {{Form::submit("submit", 
        [
            "class"=>"photoSubmit btn btn-primary", 
            "data-loading-text"=>"uploading...", 
        ]
    )}}
    {{Form::button("delete", ["class"=>"photoDelete btn btn-warning"])}}
</div>

{{ Form::close() }}