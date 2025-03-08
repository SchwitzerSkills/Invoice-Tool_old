<?php

namespace App\Http\Databases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login
{

    public function auth(Request $request){
        $username = trim($request->usernameInput);
        $password = trim($request->passwordInput);
        $count = DB::table("users")->where("username", $username)->count();

        if(!$count){
            return redirect("/")->with("error_message", "Username oder Passwort falsch!");
        }

        $hash_password = DB::table("users")->select("password")->where("username", $username)->get()->first()->password;
        $verify_password = password_verify($password, $hash_password);

        if(!$verify_password){
            return redirect("/")->with("error_message", "Username oder Passwort falsch!");
        }

        $admin = DB::table("users")->select("admin")->where("username", $username)->get()->first()->admin;

        session()->put("active", true);
        session()->put("username", $username);
        session()->put("admin", $admin);

        return redirect("/");
    }

}
