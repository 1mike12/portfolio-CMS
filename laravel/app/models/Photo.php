<?php

class Photo extends Eloquent {
    
    protected $softDelete= true;
    protected $guarded=[];
    
    public static $rules = [
        "weight"=>"numeric"
    ];
    
    public function absolutePath(){
        return $this->path . $this->id . $this->extension;
    }
    
      //magic relational methods
    public function project() {
        return $this->belongsTo("Project");
    }
}
