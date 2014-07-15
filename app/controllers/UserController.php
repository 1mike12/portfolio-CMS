<?php

class UserController extends BaseController {

    protected $layout = "layouts.default";

    public function getLogin() {
        if (Auth::check()) {
            return Redirect::back()->with("message", "You're already logged in");
        } else {
            View::inject("content", View::make("user.login"));
        }
    }

    public function postLogin() {
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
            return Redirect::intended("admin");
        } else {
            return Redirect::to('user/login')
                            ->with('message', 'Your username/password combination was incorrect')
                            ->withInput();
        }
    }

    public function getRegister() {
        $users = User::all();
        if ($users->isEmpty()) {
            View::inject("content", View::make("user.register"));
        }else{
            View::inject("content", "Can't register more than one user");
        }
    }
    
    public function postRegister() {
        $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->passes()) {
            $user = new User(Input::all());
            $user->password = Hash::make(Input::get("password"));
            $user->save();
            return Redirect::to("user/login")->with("message", "thanks for registering!");
        } else {
            return Redirect::to("user/register")
                            ->with("message", "The following errors occured:")
                            ->withErrors($validator)->withInput();
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to("/")->with("message", "Signed out");
    }

}
