<?php

class Photo extends Eloquent {

    protected $softDelete = true;
    protected $guarded = ["photo"];
    public static $rules = [
        "name" => "required",
        "weight" => "numeric"
    ];
    public static $fileTypes = ["jpeg", "png", "jpg", "gif", "bmp", "svg"];

    public function getURL() {
        if (isset($this->id)) {
            return URL::to("assets/project-photos") . "/$this->id.$this->extension";
        } else {
            return URL::to("assets/defaultThumb.jpg");
        }
    }

    public function movePath() {
        return public_path() . "\assets\project-photos";
    }

    public function fileName() {
        return "$this->id.$this->extension";
    }

    public function fullPath() {
        $movePath = $this->movePath();
        $fileName = $this->fileName();
        return $movePath . "\\" . $fileName;
    }

    public function deletePhoto() {
        if (file_exists($this->fullPath())) {
            unlink($this->fullPath());
            return true;
        }else{
            return false;
        }
    }

    //magic relational methods
    public function project() {
        return $this->belongsTo("Project");
    }

}
