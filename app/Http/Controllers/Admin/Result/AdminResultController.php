<?php

namespace App\Http\Controllers\Admin\Result;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\result;
use App\Models\User;
use Illuminate\Http\Request;

class AdminResultController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.result.index', compact('users'));
    }
    public function exams(Request $req)
    {
        $user = User::Where('id', $req->id)->first();
        $exams = Exam::Where('class', $user->class)->get();
        
        return view('admin.result.exams', compact('exams'));
    }
    public function result(Request $req)
    {
        $user = User::Where('id', $req->uid)->first();
        $exam = Exam::Where('id', $req->exid)->first();
        $result = result::Where('uid', $req->uid)->Where('exid', $req->exid)->first();
        return view('admin.result.result', compact('user', 'exam', 'result'));
    }
}
