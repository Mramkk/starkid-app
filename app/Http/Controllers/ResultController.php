<?php

namespace App\Http\Controllers;

use App\Helper\ResMsg;
use App\Models\Exam;
use App\Models\Question;
use App\Models\result;
use App\Models\StudExamAns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    // public function byExid(Request $req)
    // {
    //     return result::Where('uid', Auth()->user()->id)->Where('exid', $req->id)->first();
    // }
    public function store(Request $req)
    {

        $ex = Exam::Where('id', $req->exid)->first();
        $qu = Question::Where('id', $req->qid)->Where('exid', $req->exid)->first();
        $stud = new StudExamAns();
        $stud->uid = Auth()->user()->id;
        $stud->exid = $req->exid;
        $stud->qid = $req->qid;
        $stud->uans = $req->uans;
        $stud->ans_check = $qu->ans == $req->uans ? '1' : '0';
        $status = $stud->save();
        if ($status) {
            $marks = 0;
            $markPerQue = 0;
            $markPerQue = $ex->marks_per_question;
            $studs = StudExamAns::Where('uid', Auth()->user()->id)->Where('exid', $req->exid)->get();
            foreach ($studs as $stud) {
                if ($stud->ans_check == 1) {
                    $marks += $markPerQue;
                }
            }
            $dpm = ceil((60 * $marks) / $req->second);
            $result = new result();
            $result->uid = Auth()->user()->id;
            $result->exid = $req->exid;
            $result->second = $req->second;
            $result->marks_obtained = $marks;
            $result->dpm = $dpm;
            $status = $result->save();
            if ($status) {
                return  ResMsg::success("Submited Successfully !");
            } else {
                return  ResMsg::error();
            }
        } else {
            return  ResMsg::error();
        }
    }
}
