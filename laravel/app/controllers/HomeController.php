<?php

class HomeController extends BaseController {

    protected $layout = "layouts.default";

    public function getIndex() {
        View::inject("content", View::make("home"));
    }

    public function getProjectList() {
        $talents= Talent::all();
        $projects= Project::all();
        $talent_skills=[];
        
        foreach($talents as $talent){
            $skills= $talent->skills;
            //only add talents that have skills
            if(!$skills->isEmpty()){
                $talent_skills[]= ["talent"=>$talent, "skills"=>$skills];
            }
        }
        $data = [
            "projects" => $projects,
            "talent_skills"=>$talent_skills
        ];
        
        View::inject("content", View::make("projectList", $data));
    }
    public function getProject($id) {
        $talent_projects = [];
        $talents = Talent::all();
        foreach ($talents as $talent) {
            $projects = Project::where("talent_id", "=", $talent->id)->get();
            $talent_projects[] = [
                "talent" => $talent,
                "projects" => $projects,
            ];
        }
    }

}
