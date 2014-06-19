<?php

class Project extends Eloquent {
    protected $softDelete= true;
    protected $guarded=["skills"];
    
    public static $rules = [
        'name' => 'required|min:1',
        "startDate"=>"required|date",
        "weight"=>"numeric"
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
}
