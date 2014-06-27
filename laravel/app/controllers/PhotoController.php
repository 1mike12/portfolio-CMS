<?php

class PhotoController extends BaseController {

    public function getPhotofield() {
        return View::make("admin.photo.field");
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), Photo::$rules);

        $response = ["success" => true, "messages" => "", "data" => ""];
        if ($validator->passes() && Input::hasFile("photo")) {
            $file = Input::file("photo");
            $mime = $file->getClientOriginalExtension();
            if (in_array($mime, Photo::$fileTypes)) {
                $photo = new Photo(Input::all());
                $photo->extension = $mime;
                $photo->save();
                $file->move($photo->movePath(), $photo->fileName());
                $response["data"] = ["id" => $photo->id, "path" => $photo->getURL()];
            } else {
                $response["success"] = false;
                $response["messages"] = "file must be of type: jpeg, jpg, png, gif, bmp, svg";
            }
        } else {
            $response["success"] = false;
            $messageBag = $validator->messages();
            foreach ($messageBag->all() as $message) {
                $response["messages"].=$message;
            }
        }
        return $response;
    }

    public function postEdit() {
        $response = ["success" => true, "messages" => "", "data" => ""];
        //editing with new photo upload==============
        $validator = Validator::make(Input::all(), Photo::$rules);
        //1. validator passes
        //2. check if editing content AND file
        //3. iff file manipulation worked, THEN add photo to DB
        $photo = Photo::find(Input::get("id"));
        if ($validator->passes()) {//1
            if (Input::hasFile("photo")) {//2
                $file = Input::file("photo");
                $mime = $file->getClientOriginalExtension();
                if (in_array($mime, Photo::$fileTypes)) {
                    //delete old file and add new
                    if ($photo->detachFile()) {
                        $file->move($photo->movePath(), $photo->fileName());
                        $response["messages"] .= "old photo replaced with new. ";
                    } else {
                        $response["success"] = false;
                        $response["messages"].="couldn't detach file";
                    }
                } else {
                    $response["success"] = false;
                    $response["messages"] .= "file must be of type: jpeg, jpg, png, gif, bmp, svg. ";
                }
            }
            if ($response["success"]) {//3
                $photo->fill(Input::all());
                $photo->save();
                $response["messages"].="photo edited in database. ";
            }
        } else {
            $response["success"] = false;
            $messageBag = $validator->messages();
            foreach ($messageBag->all() as $message) {
                $response["messages"].=$message;
            }
        }
        return $response;
    }

    public function postDelete() {
        $id = Input::get("id");
        $response = ["success" => true, "messages" => "", "data" => ""];
        $photo = Photo::find($id);
        if (!$photo) {
            $response["success"] = false;
            $response["messages"] = "couldn't find photo with id: $id";
        } else {
            if ($photo->deleteFiles()) {
                $response["messages"].="removed file " . $photo->fileName() . " from server. ";
            }
            $photo->delete();
            $response["messages"].= "removed photo with id: $id from database";
        }
        return $response;
    }

}
