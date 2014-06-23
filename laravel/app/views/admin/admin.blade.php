{{HTML::linkAction("TalentController@getCreate","new talent")}}<br>
{{HTML::linkAction("SkillController@getCreate","new skill")}}<br>
{{HTML::linkAction("ProjectController@getCreate","new project")}}<br>

@if($talent_projects)
    @foreach($talent_projects as $array)
        <h2>{{$array["talent"]->name}} 
            <a href="{{URL::action("TalentController@getEdit", [$array["talent"]->id])}}">edit</a>
        </h2>
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
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
        @else
        <div>there are no projects in {{$array["talent"]->name}}. <a href="{{URL::action("ProjectController@getCreate")}}">add a new project</a></div>
        @endif
    @endforeach
@else
@endif

