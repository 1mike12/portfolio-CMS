<?php

class SkillController extends BaseController {

    protected $layout = "layouts.default";

    public function getCreate() {
        $talents = Talent::all();
        $talentID_talentName = [];
        foreach ($talents as $talent) {
            $talentID_talentName[$talent->id] = $talent->name;
        }
        View::inject("content", View::make("admin.skill.create")->with("talentID_talentName", $talentID_talentName));
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), Skill::$rules);
        if ($validator->passes()) {
            $user = new Skill(Input::all());
            $user->save();
            return Redirect::action(__CLASS__ . "@getIndex")->with("message", "Skill added!");
        } else {
            return Redirect::action(__CLASS__ . "@getCreate")
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
    }

    public function getEdit($id) {
        
    }

    //relationship magic methods
    public function talent() {
        return $this->belongsTo("Talent");
    }

}
