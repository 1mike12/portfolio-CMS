<?php
//inbound $project
?>
<div class="projectThumbEpi col-sm-4">
    <a href="{{URL::action("HomeController@getProject", "$project->id")}}" style="background-image: url({{$project->getThumbURL()}})" class="projectThumbEndo">
        <div class="projectThumbFade">
            <h3>{{$project->name}}</h3>
            <div>{{$project->getStartDate("M Y")}}</div>
            <div class="skillString">{{$project->printSkills()}}</div>
        </div>
    </a>
</div>
