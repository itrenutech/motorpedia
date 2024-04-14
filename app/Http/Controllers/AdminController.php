<?php

namespace App\Http\Controllers;

use App\Models\admins;
use App\Models\loginlogs;
use Illuminate\Http\Request;
use Session;
use Exception;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    //
    public function Index(){
        return view('Admin.Login');
    }

    public function Verify(Request $req){
        try {
            $session_id = Session::getId();
            $req->validate([
                'username' => 'required',
                'password' => 'required'
            ]);
            $user = admins::where("username", $req->username)
                ->where("status", 1)
                ->get();
            if (count($user) == 0) {
                throw new Exception('Invalid Username!!!');
            }
            $userinfo = admins::where("username", $req->username)
                ->where("status", 1)
                ->first();
            $chekpass = Hash::check($req->password, $userinfo->password);
            if ($chekpass == 0) {
                throw new Exception('Username and Password not matched!!!');
            }
            if (Hash::check($req->password, $userinfo->password)) {
                $user_id = $userinfo->id;
                $logform = [
                    "login_id" => $user_id,
                    "login_by" => "Admin",
                    "type" => "Login",
                    "time" => date("Y-m-d H:i:s"),
                    "ip_address" => \Request::ip(),
                    "session" => $session_id
                ];
                loginlogs::insertGetId($logform);
                $adminSession = json_decode(json_encode($userinfo), true);
                Session::put("adminSession", $adminSession);
                return redirect()
                    ->route("admin.dashboard")
                    ->with("flash_message_success", "Login Successfully!!!");
            }
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            )->withInput();
        }
    }

    public function Logout(){
        if (!empty(Session::get("adminSession")["id"])) {
            $lid = Session::get("adminSession")["id"];
            $session_id = Session::getId();
            $logform = [
                "login_id" => $lid,
                "login_by" => "Admin",
                "type" => "Logout",
                "time" => date("Y-m-d H:i:s"),
                "ip_address" => \Request::ip(),
                "session" => $session_id
            ];
            loginlogs::insertGetId($logform);
            Session::flush();
            return redirect()
                    ->route("login.index")
                    ->with("success", "Logout Successfully!!!");
        } else {
            return redirect()
                    ->route("login.index")
                    ->with("success", "Logout Successfully!!!");
        }
    }
}
