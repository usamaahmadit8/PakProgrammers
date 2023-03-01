<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class signupController extends Controller
{
    //
    public function logInUser(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $check_user = array();
        $check_user = User::where("email", "=", $email)->where("password", "=", $password)->get();
        if (count($check_user) > 0) {

            return $check_user;
        }
        $check_user['message'] = "Invalid email or password.";
        return $check_user;
    }
    public function sign(Request $request)

    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]
        );

        $name = $request->name;
        $email = $request->email;
        $password = md5($request->password);
        //$password=bcrypt($request->password);
        $check_user = array();
        $check_user = user::where("email", "=", $email)->get();
        if (count($check_user) == 0) {
            $user = new user;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $result = $user->save();
            if ($result) {
                $message = ["message" => "User registerd Succesfully."];
                return $message;
            } else {
                $message = ["message" => "User not registered."];
                return $message;
            }
        } else {
            $message = ["message" => "User already registered."];
            return $message;
        }
    }
}
