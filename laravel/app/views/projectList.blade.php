<?php 
//inbound=====
//$data = [
//            "projects" => $projects,
//            "talent_skills"=>$talent_skills
//        ];
$brightness= "#FFFFFF";
?>
<div id="accordion">
    @foreach($talent_skills as $array)
    <div class="slideEpi" style="background:{{$brightness}}}">
        <div class="slideEndo">
            graph goes here
            <div class="slideTab r-90">{{$array["talent"]->name}}</div>
        </div>
    </div>
    <?php $brightness= adjustBrightness($brightness, -20);?>
    @endforeach
</div>
@foreach($projects as $project)
@include("thumb")
@endforeach

@include("chart")
