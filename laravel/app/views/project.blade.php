<?php
//project 

?>
<h1>{{$project->name}} <span class="small">{{$talent->name}}</span></h1>
<h4>{{$project->printSkills()}}</h4>
<h3>{{$project->getStartDate("M Y")}}</h3>
<div class="row">
    <div class="col-sm-4">
        {{$project->content}}
    </div>
    <div class="col-sm-8">
        @foreach($project->photos->sortBy("weight") as $photo)
        <h4>{{$photo->name}}</h4>
        <a class="lightbox" href="{{$photo->getURL()}}" 
           data-toggle="lightbox" 
           data-title="{{$photo->name}}" 
           data-footer="{{$photo->caption}}" 
           data-gallery="project">
            <img class="projectPhoto" src="{{$photo->getURL()}}"/>
        </a>
        
        @endforeach
    </div>
</div>
