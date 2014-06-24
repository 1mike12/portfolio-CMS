<?php

class Project extends Eloquent {

    protected $softDelete = true;
    protected $guarded = ["skills"];
    public static $rules = [
        'name' => 'required|min:1',
        "startDate" => "required|date",
        "weight" => "numeric"
    ];

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
    
    public function startDate($format= "n-j-Y"){
        $date = new DateTime($this->startDate);
        return $date->format($format);
    }

}
