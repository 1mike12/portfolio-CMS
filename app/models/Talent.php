<?php

class Talent extends Eloquent {

    protected $fillable = ["name", "weight"];
    
    public static $rules = [
        'name' => 'required|alpha|min:2',
    ];
    
    public function skills() {
        return $this->hasMany('Skill');
    }
    public function projects(){
        return $this->hasMany("Project");
    }

}
