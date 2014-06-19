<?php

class ProjectController extends BaseController {

    protected $layout = "layouts.default";
    public $Model;
    public $model;

    function __construct() {
        $this->Model = str_replace("Controller", "", __CLASS__);
        $this->model = strtolower($this->Model);
    }

    public function getIndex() {
        
    }

    public function getCreate() {
        $Model = $this->Model;
        $instance = new $this->Model;
        $data = [
            "instance" => $instance,
            "Model" => $this->Model,
            "model" => $this->model,
            "action" => __CLASS__ . "@postCreate"
        ];

        //model specific start
        $allSkills = $this->getAllSkillsArray();
        $data["allSkills"] = $allSkills;
        //model specific end

        View::inject("content", View::make("admin.$this->model.edit", $data));
    }

    public function postCreate() {
        $Model = $this->Model;
        $validator = Validator::make(Input::all(), $Model::$rules);
        if ($validator->passes()) {
            $instance = new $Model(Input::all());
            $instance->save();
            $instance->skills()->sync(Input::get("skills"));
            return Redirect::action("AdminController@getIndex")->with("message", "$Model added!");
        } else {
            return Redirect::action(__CLASS__ . "@getCreate")
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
    }

    private function getAllSkillsArray() {
        //[skillID=> ["name", (bool) selected] ]
        $allSkillObjs = Skill::all();
        $allSkills = [];
        foreach ($allSkillObjs as $skill) {
            $allSkills[$skill->id] = ["name" => $skill->name, "selected" => false];
        }
        return $allSkills;
    }

    public function getEdit($id) {
        $Model = $this->Model;
        $instance = $Model::find($id);
        if (!$instance) {
            return View::inject("content", "$this->model with id: $id not found");
        }
        $data = [
            "instance" => $instance,
            "Model" => $this->Model,
            "model" => $this->model,
            "action" => __CLASS__ . "@postEdit",
            "delete" => __CLASS__ . "@postDelete"
        ];
        //extra model specific stuff
        $allSkills = $this->getAllSkillsArray();

        $selectedSkillObjs = $instance->skills;
        $selectedSkills = [];
        foreach ($selectedSkillObjs as $skill) {
            $selectedSkills[] = $skill->id;
        }

        foreach ($selectedSkills as $id) {
            $allSkills[$id]["selected"] = true;
        }
        $data["allSkills"] = $allSkills;

        //adding photos
        $photos = Photo::where("project_id", "=", $instance->id)->get();
        $data["photos"] = $photos;
        //end model specific
        View::inject("content", View::make("admin.$this->model.edit", $data));
    }
    
    public function postEdit() {
        $Model = $this->Model;
        $validator = Validator::make(Input::all(), $Model::$rules);
        if ($validator->passes()) {
            $instance = $Model::where("id", "=", Input::get("id"))->first();
            $instance->fill(Input::all());
            $instance->save();

            //start model specific 
            $instance->skills()->sync(Input::get("skills"));
            //end model specific

            return Redirect::action("AdminController@getIndex")->with("message", "$Model edited!");
        } else {
            return Redirect::back()
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
    }

    public function postDelete() {
        $Model = $this->Model;
        $instance = $Model::where("id", "=", Input::get("id"))->first();
        if (!$instance) {
            return Redirect::back()
                            ->with("message", "something went wrong")
                            ->withInput();
        } else {
            $instance->delete();
            return Redirect::action("AdminController@getIndex")->with("message", "$Model deleted!");
        }
    }

}
