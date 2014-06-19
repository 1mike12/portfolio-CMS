<?php

class Talent extends Eloquent {

    protected $fillable = ["name", "weight"];
    
    public static $rules = [
        'name' => 'required|alpha|min:2',
    ];

}
