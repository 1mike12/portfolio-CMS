<?php

class DatabaseController extends BaseController {

    protected $tables = ["talents", "skills", "projects", "photos", "project_skill", "users"];

    public function getDrop() {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        foreach ($this->tables as $table) {
            Schema::dropIfExists($table);
        }
        return "tables dropped";
    }

    public function getUp() {
        Schema::create("users", function($table){
            $table->increments("id");
            $table->string("email", 255);
            $table->string("password", 255);
            $table->string("remember_token", 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create("talents", function($table) {
            $table->increments('id');
            $table->string("name", 255);
            $table->integer("weight");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("skills", function($table) {
            $table->increments('id');
            $table->integer("talent_id")->index()->unsigned();
            $table->string("name", 255);
            $table->integer("level");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('talent_id')
                    ->references('id')->on('talents')
                    ->onDelete("cascade")->onUpdate("cascade");
        });

        Schema::create("projects", function($table) {
            $table->increments('id');
            $table->integer("talent_id")->index()->unsigned();
            $table->string("name", 255);
            $table->text("content", 255)->nullable();
            $table->string("thumbnail", 255);
            $table->string("cover", 255);
            $table->date("startDate");
            $table->integer("weight");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('talent_id')
                    ->references('id')->on('talents')
                    ->onDelete("cascade")->onUpdate("cascade");
        });
        
        Schema::create("photos", function($table) {
            $table->increments('id');
            $table->integer("project_id")->index()->unsigned();
            $table->string("name", 255);
            $table->string("caption", 255)->nullable();
            $table->string("path", 255);
            $table->string("extension", 12);
            $table->integer("weight");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id')
                    ->references('id')->on('projects')
                    ->onDelete("cascade")->onUpdate("cascade");
        });
        
        Schema::create("project_skill", function($table) {
            $table->integer("project_id")->index()->unsigned();
            $table->integer("skill_id")->index()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id')
                    ->references('id')->on('projects')
                    ->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('skill_id')
                    ->references('id')->on('skills')
                    ->onDelete("cascade")->onUpdate("cascade");
        });
    }

}
