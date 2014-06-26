<?php
//inbound=====
//$data = [
//            "projects" => $projects,
//            "talent_skills"=>$talent_skills
//        ];
$brightness = "#FFFFFF";

?>
<div id="accordion">
    @foreach($talent_skills as $array)
    <div class="slideEpi" style="background:{{$brightness}}}">
        <div class="slideEndo">
            <div class="slideTab">{{$array["talent"]->name}}</div>
            @include("chart")
        </div>
    </div>
    <?php $brightness = adjustBrightness($brightness, -10); ?>
    @endforeach
</div>
<div id="projectThumbWrap">
    @foreach(array_chunk($projects->all(),3) as $projectRow)
    <div class="row">
        @foreach($projectRow as $project)
        @include("thumb")
        @endforeach
    </div>
    @endforeach
</div>


