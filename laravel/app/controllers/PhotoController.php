<?php

class PhotoController extends BaseController {

    protected $layout = "layouts.default";
    public $Model;
    public $model;
    

    function __construct() {
        $this->Model = str_replace("Controller", "", __CLASS__);
        $this->model = strtolower($this->Model);
        
    }
    
    public function getPhotofield() {
        return View::make("admin.photo.field");
    }
    
    public function getTest(){
        $photo= Photo::find(1);
        return $photo->absolutePath();
    }

    public function postCreate() {
        
    }
}
