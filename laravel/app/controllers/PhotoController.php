<?php

class PhotoController extends BaseController {

    public function getPhotofield() {
        return View::make("admin.photo.field");
    }

    public function postCreate() {
        $input = Input::all();
        $validator = Validator::make(Input::all(), Photo::$rules);
        $filetypes = ["jpeg", "png", "jpg", "gif", "bmp", "svg"];

        $response = ["success" => true, "messages" => "", "data" => ""];
        if ($validator->passes() && Input::hasFile("photo")) {
            $file = Input::file("photo");
            $mime = $file->getClientOriginalExtension();
            if (in_array($mime, $filetypes)) {
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

    public function postDelete($id) {
        $response = ["success" => true, "messages" => "", "data" => ""];
        $photo = Photo::find($id);
        if (!$photo){
            $response["success"]=false;
            $response["messages"]= "couldn't find photo with id: $id";
        }else{
            if(file_exists($photo->fullPath())){
                unlink($photo->fullPath());
                $response["messages"].="removed file " . $photo->fileName(). "from server. ";
            }
            $photo->delete();
            $response["messages"].= "removed photo with id: $id from database";
        }
        return $response;
    }

}
