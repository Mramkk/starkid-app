<?php

namespace App\Http\Controllers\Admin\User;

use App\Helper\ResMsg;
use App\Http\Controllers\Controller;
use App\Models\Calculation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(Request $req)
    {

        $users = User::all();
        $data = compact('users');
        return view('admin.student.student')->with($data);
    }
    public function classList(Request $req)
    {

        $class = User::select('class')->groupBy('class')->get();
        if ($class) {
            return ResMsg::data('Class List', $class);
        } else {
            return ResMsg::error();
        }
    }
    public function details(Request $req)
    {

        $user = User::Where('id', $req->id)->first();
        $cals =  Calculation::latest()->Where('uid', $user->id)->paginate(20);
        $data = compact('user', 'cals');
        return view('admin.student.details')->with($data);
    }
    public function status(Request $req)
    {
        $user = User::Where('id', $req->id)->first();
        if ($user->status == '1') {
            $user->status = "0";
            $status = $user->update();
            if ($status) {

                return  ResMsg::success('Status Changed Successfully ! ');
            } else {
                return  ResMsg::error();
            }
        } else {
            $user->status = "1";
            $status = $user->update();
            if ($status) {

                return  ResMsg::success('Status Changed Successfully ! ');
            } else {
                return  ResMsg::error();
            }
        }
    }
}
