<?php

class HomeController extends BaseController {

    protected $layout = "layouts.default";

    public function getIndex() {
        View::inject("content", View::make("home"));
    }

    public function getProjectList() {
        View::inject("content", View::make("projectList"));
    }

    public function getProject($id) {
        
    }

}
