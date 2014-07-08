<?php
Route::controller("database", "DatabaseController");
Route::controller("user", "UserController");

Route::group(["prefix" => "admin", "before"=> "auth"], function() {
    Route::controller("talent", "TalentController");
    Route::controller("skill", "SkillController");
    Route::controller("project", "ProjectController");
    Route::controller("photo", "PhotoController");
    Route::controller("/", "AdminController");
});


Route::controller("/", "HomeController");

App::missing(function($exception)
{
    return Response::view('errors.missing', array('url' => Request::server('PATH_INFO')), 404);
});

//View::inject == 
//$this->layout->getEnvironment()->inject($yieldName,$value)
//1. specify protected $layout= "layouts.common"
//2. View::inject("yieldName", $value)