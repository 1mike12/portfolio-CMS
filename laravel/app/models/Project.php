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

    public function startDate($format = "n-j-Y") {
        $date = new DateTime($this->startDate);
        return $date->format($format);
    }

}
