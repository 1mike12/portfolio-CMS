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
<div>
    <span>sort by: </span>
    <span class="isotopeUI" id="sortWeight" href="#"> original order<span class="caret"></span>
    </span>
    <span class="isotopeUI" id="sortName" href="#"> name <span class="caret"></span></span>
    <span class="isotopeUI" id="sortDate" href="#"> date <span class="caret"></span></span>
</div>
<div id="projectListThumbWrap" class="row">
    @foreach($projects->sortBy("weight") as $project)
    @include("thumb")
    @endforeach
</div>


