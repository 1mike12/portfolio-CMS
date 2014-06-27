<?php

class Project extends Eloquent {

    protected $softDelete = true;
    protected $guarded = ["skills"];
    public static $rules = [
        'name' => 'required|min:1',
        "startDate" => "required|date",
        "weight" => "numeric",
        "thumbnail" => "mimes:jpeg,png,svg,bmp,gif"
    ];

    public function getThumbURL() {
        if (isset($this->id)) {
            return URL::to("assets/project-thumbnails") . "/" . $this->thumbFileName();
        } else {
            return URL::to("assets/defaultThumb.jpg");
        }
    }

    public function thumbPath() {
        return public_path() . "\assets\project-thumbnails";
    }

    public function thumbFileName() {
        return "$this->id.$this->thumbnail_extension";
    }

    //magic relational methods
    public function talent() {
        return $this->belongsTo("Talent");
    }

    public function skills() {
        return $this->belongsToMany('Skill');
    }

    public function photos() {
        return $this->hasMany("Photo");
    }

    public function thumbnail() {
        return URL::to("assets/project-thumbnails") . "/" . $this->thumbnail;
    }
    
    //1mike12 don't name model methods the same as model parameters. When you call $project->parameter in a form, it will think to look for $project->parameter(), which is a function, and return an exception
    public function getStartDate($format = "n-j-Y") {
        $date = new DateTime($this->startDate);
        return $date->format($format);
    }
    public function deleteThumb(){
        $path= $this->thumbPath()."/".$this->thumbFileName();
        if (file_exists($path)){
            unlink ($path);
            return true;
        }else{
            return false;
        }
    }
    public function deleteFiles(){
        $this->deleteThumb();
        $photos= $this->photos;
        foreach($photos as $photo){
            $photo->deleteFiles();
        }
    }
}
