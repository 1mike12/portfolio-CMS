<?php

class HomeController extends BaseController {

    protected $layout = "layouts.default";

    public function getIndex() {
        View::inject("content", View::make("home"));
    }

    public function getProjectList() {
        $talents = Talent::all();
        $projects = Project::all();
        $talent_skills = [];

        foreach ($talents as $talent) {
            $skills = $talent->skills;
            //only add talents that have skills
            if (!$skills->isEmpty()) {
                $talent_skills[] = ["talent" => $talent, "skills" => $skills];
            }
        }
        $data = [
            "projects" => $projects,
            "talent_skills" => $talent_skills,
        ];
        //add constantScroll to html element- to keep scrollbar when using isotope sorting
        $this->layout->htmlClass= "constantScroll";
        View::inject("content", View::make("projectList", $data));
    }

    public function getProject($id) {
        $project = Project::find($id);
        $talent = $project->talent;

        $data = [
            "project" => $project,
            "talent" => $talent
        ];

        View::inject("content", View::make("project", $data));
    }
    
    public function getContact(){
        View::inject("content", View::make("contact"));
    }
    public function getAbout(){
        View::inject("content", View::make("about"));
    }
}
