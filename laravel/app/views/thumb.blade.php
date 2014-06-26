<?php
//inbound $project
$skillNames = [];
foreach ($project->skills as $skill) {
    $skillNames[] = $skill->name;
}
$skillString = "";
foreach ($skillNames as $name) {
    $skillString.="$name ";
}

?>
<div class="projectThumbEpi col-sm-4">
    <a href="{{URL::action("HomeController@getProject", "$project->id")}}" style="background-image: url({{$project->getThumbURL()}})" class="projectThumbEndo">
        <div class="projectThumbFade">
            <h3>{{$project->name}}</h3>
            <div>{{$project->getStartDate("n.j.Y")}}</div>
            <div class="skillString">{{$skillString}}</div>
        </div>
    </a>
</div>
