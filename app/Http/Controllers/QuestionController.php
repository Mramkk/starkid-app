<?php

namespace App\Http\Controllers;

use App\Models\Queset;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function byExamId(Request $req)
    {
        $ques = Question::Where('exid', $req->id)->paginate(1);

        return view('admin.exam.question', compact('ques'));
    }
}
