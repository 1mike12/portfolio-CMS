<?php
//inbound=====
//$data = [
//            "projects" => $projects,
//            "talent_skills"=>$talent_skills
//        ];
$brightness = "#FFFFFF";

?>
<div id="accordion">
    <?php $slideCount = 0; ?>
    @foreach($talent_skills as $array)
    <div class="slideEpi" style="background:{{$brightness}}}">
        <div class="slideEndo">
            @include("chart")
        </div>
    </div>

    <?php
    //lower brightness of slides & keep slideCount to do display:none to subsequent slides
    $brightness = adjustBrightness($brightness, -10);
    $slideCount++;

    ?>
    @endforeach
</div>

<div id="sortButtons">
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

