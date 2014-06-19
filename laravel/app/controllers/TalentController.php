<?php
class TalentController extends BaseController{
    protected $layout = "layouts.default";
    
    public function getCreate(){
        View::inject("content", View::make("admin.talent.create"));
    }
    public function postCreate(){
        $validator = Validator::make(Input::all(), Talent::$rules);
        if ($validator->passes()) {
            $talent = new Talent(Input::all());
            $talent->save();
            return Redirect::action("AdminController@getIndex")->with("message", "talent added!");
        } else {
            return Redirect::action("TalentController@getCreate")
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
    }
    
    public function getEdit($id){
        
    }
    public function postEdit(){
        
    }
    public function postDelete($id){
        
    }

}
