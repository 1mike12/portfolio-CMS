<?php
if (!isset($photo)) {
    $photo = new Photo;
    $photo->url= URL::to("assets/defaultThumb.jpg");
}

?>
{{ Form::open(array('action'=>"PhotoController@postCreate", 'class'=>'photoForm form-inline', "files"=>true)) }}

<div class="form-group">
    <img class="photoFormThumbnail" src="{{$photo->url}}"/>
    {{ Form::text('name', $photo->name, [ 'class'=>'form-control','placeholder'=>'name']) }}
    {{ Form::text('caption', $photo->caption, ['class'=>'form-control', 'placeholder'=>'caption']) }}
    {{Form::button("submit", ["class"=>"btn btn-default"])}}
    {{Form::button("delete", ["class"=>"btn btn-default"])}}
</div>

{{ Form::close() }}