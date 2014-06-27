<?php

class Skill extends Eloquent {
    protected $fillable = ["name", "level", "talent_id"];
    
    public static $rules = [
        'name' => 'required|min:1',
        "level"=> "required|numeric"
    ];
    
    public function projects() {
        return $this->belongsToMany("Project");
    }
}
