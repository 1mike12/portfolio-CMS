<?php

class AdminController extends BaseController {

    protected $layout = "layouts.default";

    public function getIndex() {
        $talent_projects = [];
        $talents = Talent::all();
        foreach ($talents as $talent) {
            $projects = Project::where("talent_id", "=", $talent->id)->get();
            $skills= $talent->skills->sortBy("weight");
            $talent_projects[] = [
                "talent" => $talent,
                "projects" => $projects,
                "skills"=>$skills
            ];
        }
        View::inject("content", View::make("admin.admin")->with("talent_projects", $talent_projects));
    }

}
