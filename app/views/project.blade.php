<?php
//project 

?>
<div class="projectTitleWrap">
    <div class="row">
        <div class="col-sm-6">
            <h1>{{$project->name}} <span class="small">{{$talent->name}}</span></h1>
            <h3>{{$project->intro}}</h3>
            <div class="projectSubtitle">
                <h4>{{$project->printSkills()}}</h4>
            </div>
            
        </div>
        <div class="col-sm-6 text-right">
            <h3>{{$project->getStartDate("M Y")}}</h3>
            <img src="{{$project->getThumbURL()}}"/>
        </div>

    </div>
    <div class="gradientLine"></div>
</div>

<div class="row">
    <div class="col-sm-5">
        {{$project->content}}
    </div>
    <div class="col-sm-offset-1 col-sm-6">
        @foreach($project->photos->sortBy("weight") as $photo)
        <div class="projectThumbnailEpi">
            <a href="#" 
               data-featherlight="#fl-{{$photo->id}}">
                <img class="projectPhoto" src="{{$photo->getURL()}}"/>
            </a>
            <h4>{{$photo->name}}</h4>
            <br>
        </div>

        <div class="lightboxSource" id="fl-{{$photo->id}}">
            <h3>{{$photo->name}}</h3>
            <img class="projectPhoto" src="{{$photo->getURL()}}"/>
            <div class="photoCaption">{{$photo->caption}}</div>
        </div>
        @endforeach
    </div>
</div>
