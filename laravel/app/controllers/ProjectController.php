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
        $v = $instance->startDate;
        //model specific start
        $allSkills = ProjectController::getAllSkillsArray();
        $data["allSkills"] = $allSkills;
        //model specific end

        View::inject("content", View::make("admin.$this->model.edit", $data));
    }

    public function postCreate() {
        $Model = $this->Model;
        $validator = Validator::make(Input::all(), $Model::$rules);
        if ($validator->passes()) {
            $instance = new $Model(Input::all());
            $instance->save();//get id assigned first
            if (Input::get("skills")) {
                $instance->skills()->sync(Input::get("skills"));
            }
            if (Input::hasFile("thumbnail")) {

                $thumb = Input::file("thumbnail");
                $extension = $thumb->getClientOriginalExtension();
                $instance->thumbnail_extension = $extension;
                $instance->save();//save a second time with photo extension
                $thumb->move($instance->thumbPath(), $instance->thumbFileName());
            }



            return Redirect::action(__CLASS__ . "@getEdit", $instance->id)->with("message", "$Model added!");
        } else {
            return Redirect::action(__CLASS__ . "@getCreate")
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
    }

    private static function getAllSkillsArray() {
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
        $allSkills = ProjectController::getAllSkillsArray();

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


            //start model specific 
            if (Input::get("skills")) {
                $instance->skills()->sync(Input::get("skills"));
            }

            if (Input::hasFile("thumbnail")) {

                $thumb = Input::file("thumbnail");
                $extension = $thumb->getClientOriginalExtension();
                $instance->thumbnail_extension = $extension;
                $thumb->move($instance->thumbPath(), $instance->thumbFileName());
            }
            //end model specific
            $instance->save();

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
            //delete thumbnail
            $instance->deleteThumb();
            //delete all photos
            foreach ($instance->photos as $photo) {
                $photo->deleteFiles();
            }
            $instance->delete();
            return Redirect::action("AdminController@getIndex")->with("message", "$Model deleted!");
        }
    }

    public function getDelete($id) {
        $Model = $this->Model;
        $instance = $Model::where("id", "=", $id);

        if (!$instance) {
            return Redirect::back()
                            ->with("message", "Couldn't delete. $Model with id: $id not found")
                            ->withInput();
        } else {
            //delete thumbnail
            $instance->deleteFiles();
            $instance->delete();
            return Redirect::action("AdminController@getIndex")->with("message", "$Model deleted!");
        }
    }

}
