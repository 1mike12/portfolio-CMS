{{HTML::linkAction("TalentController@getCreate","new talent")}}<br>
<a href="{{URL::to("/")}}">view homepage</a>
<?php
//inbound $talent_projects[i]=
//[ 
    //"talent"=>talentObj, 
    //"projects"=>[projects ], 
    //"skills"=>[skills] 
//]
?>
@if($talent_projects)
    @foreach($talent_projects as $array)
        <h1>{{$array["talent"]->name}} 
            <a href="{{URL::action("TalentController@getEdit", [$array["talent"]->id])}}" class="small">edit talent</a>
        </h1>
        <h3>skills</h3>
        <div class="skillListWrapper">
            @foreach($array["skills"] as $skill)
            {{HTML::linkAction("SkillController@getEdit", $skill->name, $skill->id)}}
            @endforeach
            /
            {{HTML::linkAction("SkillController@getCreate","new skill", null)}}
        </div>
        
        
        @if(count($array["projects"])>0)
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Project Name</th>
                        <th>Date Started</th>
                        <th>Skills</th>
                        <th></th>
                    </tr>
                    @foreach($array["projects"] as $project)
                    <?php $date = new DateTime($project->startDate);?>
                    <tr>
                        <td>{{$project->name}}</td>
                        <td>{{date($date->format("n-j-Y"))}}</td>
                        <?php
                        $skillString="";
                        foreach($project->skills as $skill){
                            $skillString.="$skill->name ";
                        }
                        ?>
                        <td>{{$skillString}}</td>
                        <td>
                            <a href="{{URL::action("ProjectController@getEdit", [$project->id])}}">
                                edit
                            </a>/
                            <a href="{{URL::action("ProjectController@getDelete", [$project->id])}}">
                                delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
        @else
        <div>there are no projects in {{$array["talent"]->name}}.</div>
        @endif
        {{HTML::linkAction("ProjectController@getCreate","new", null, ["class"=>"btn btn-default btn-block"])}}
    @endforeach
@else
@endif