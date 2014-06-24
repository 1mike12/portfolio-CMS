<?php //inbound $project
$skillNames=[];
foreach($project->skills as $skill){
    $skillNames[]= $skill->name;
}
$skillString="";
foreach($skillNames as $name){
    $skillString.="$name ";
}
?>
<a href="{{URL::action("HomeController@getProject", "$project->id")}}">
    <img src="{{$project->thumbnail()}}"/>
    <span>{{$project->name}}</span>
    <span>{{$project->startDate("n.j.Y")}}</span>
    <span>{{$skillString}}</span>
</a>