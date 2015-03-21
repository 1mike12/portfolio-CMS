<?php
//inbound $project
?>
<div class="projectListThumbEpi col-sm-4">
    <a href="{{URL::action("HomeController@getProject", "$project->id")}}" style="background-image: url({{$project->getThumbURL()}})" class="projectThumbEndo">
        <div class="projectThumbFade">
            <h3>{{$project->name}}</h3>
            <div>{{$project->getStartDate("M • Y")}}</div>
            <div class="skillString">{{$project->printSkills()}}</div>
        </div>
    </a>
    <div class="hidden">
        <div class="weight">{{$project->weight}}</div>
        <div class="startDate">{{$project->startDate}}</div>
        <div class="name">{{$project->name}}</div>
        <div class="talent_id">{{$project->talent_id}}</div>
        <div class="skills">{{$project->printSkillIDs()}}</div>
    </div>
</div>
