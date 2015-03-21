<a href="{{URL::to("/")}}" class="btn btn-default">homepage</a>
<a href="{{URL::to("/project-list")}}" class="btn btn-default">project list</a>
<a href="{{URL::action("TalentController@getCreate")}}" class="btn btn-default">new talent</a>
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
            <code>{{HTML::linkAction("SkillController@getEdit", $skill->name, $skill->id)}}</code>
            @endforeach
            /
            <a href="{{URL::action("SkillController@getCreate")}}" class="btn btn-xs btn-primary">new skill</a>
        </div>
        
        <h3>projects</h3>
        @if(count($array["projects"])>0)
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Project Name</th>
                        <th>Date Started</th>
                        <th>Skills</th>
                        <th>Weight</th>
                        <th></th>
                    </tr>
                    @foreach($array["projects"]->sortBy("weight") as $project)
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
                        <td>{{$project->weight}}</td>
                        <td>
                            <a href="{{URL::action("ProjectController@getEdit", [$project->id])}}" class="btn btn-default btn-sm">
                                edit
                            </a>
                            <a href="{{URL::action("ProjectController@getDelete", [$project->id])}}" class="btn btn-default btn-sm">
                                delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
        </div>  
        @else
        <div>there are no projects in {{$array["talent"]->name}}.</div>
        @endif
        {{HTML::linkAction("ProjectController@getCreate","add project", $array["talent"]->id, ["class"=>"btn btn-default btn-block"])}}
    @endforeach
@else
@endif