<?php
//inbound $array["skills"] (eloquent collection)
$levels = [
    5 => "Master",
    4 => "Expert",
    3 => "Adept",
    2 => "Familiar",
    1 => "Beginner",
];
$denominator = count($array["skills"]);
$totalWidth = 80 / $denominator;
$margin = $totalWidth * .125;
if ($margin >= 1.7) {
    $margin = 1.7;
}
$body = $totalWidth * .75;

?>
<div class="slideTab">{{$array["talent"]->name}}</div>
<ul class="chart" style="<?php if ($slideCount > 0) echo "display:none;" ?>">
    <li class="axis">
        @foreach($levels as $number=>$level)
        <div class="level">{{{$level}}}</div>
        @endforeach
    </li>

    @foreach($array["skills"]->sortByDesc("level") as $skill)
<?php $height = 20 * (int) $skill->level; ?>
    <li class="bar" skill_height="{{$height}}%" skill_id="{{$skill->id}}" style="height: {{$height}}%; width:{{$body}}%; margin-right:{{$margin}}%; margin-left:{{$margin}}%">
        <div class="skill">{{$skill->name}}</div>
        <div class="percent">{{$levels[$skill->level]}}</div>
        <div class="gradientLine"></div>
    </li>
    @endforeach
</ul>
<div class="gradientLine"></div>