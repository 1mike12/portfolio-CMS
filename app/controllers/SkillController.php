<?php

class SkillController extends BaseController {

    protected $layout = "layouts.default";
    public $Model;
    public $model;

    function __construct() {
        $this->Model = str_replace("Controller", "", __CLASS__);
        $this->model = strtolower($this->Model);
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
        //model specific end

        View::inject("content", View::make("admin.$this->model.$this->model", $data));
    }

    public function postCreate() {
        $Model = $this->Model;
        $validator = Validator::make(Input::all(), $Model::$rules);
        if ($validator->passes()) {
            $instance = new $Model(Input::all());
            $instance->save();//get id assigned first

            return Redirect::action("AdminController@getIndex", $instance->id)->with("message", "$Model added!");
        } else {
            return Redirect::action(__CLASS__ . "@getCreate")
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
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
            "delete" => __CLASS__ . "@getDelete"
        ];
        //extra model specific stuff
        //end model specific
        View::inject("content", View::make("admin.$this->model.$this->model", $data));
    }

    public function postEdit() {
        $Model = $this->Model;
        $validator = Validator::make(Input::all(), $Model::$rules);
        if ($validator->passes()) {
            $instance = $Model::where("id", "=", Input::get("id"))->first();
            $instance->fill(Input::all());


            //start model specific 
            //end model specific
            $instance->save();

            return Redirect::action("AdminController@getIndex")->with("message", "$Model edited!");
        } else {
            return Redirect::back()
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
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
            $instance->delete();
            return Redirect::action("AdminController@getIndex")->with("message", "$Model deleted!");
        }
    }

}
