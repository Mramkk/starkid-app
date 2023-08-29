<?php

namespace App\Http\Controllers;

use App\Helper\ResMsg;
use App\Models\Exam;
use App\Models\Mquestion;
use App\Models\multiChoiceQues;
use App\Models\result;
use App\Models\StudExamAns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PracticeExamController extends Controller
{
    public function store(Request $req)
    {
        $ex = Exam::Where('id', $req->exid)->first();
        if ($ex->question_type == "Multi Choice") {
            $qu = multiChoiceQues::Where('exid', $req->exid)->Where('slno', $req->qid)->first();
            $stud = new StudExamAns();
            $stud->uid = Auth()->user()->id;
            $stud->exid = $req->exid;
            $stud->qid = $req->qid;
            $stud->uans = $req->uans;
            $stud->ans_check = $qu->answer == $req->uans ? '1' : '0';
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
                $dpm = ceil((60 * $marks) / $req->seconds);
                $result = new result();
                $result->uid = Auth()->user()->id;
                $result->exid = $req->exid;
                $result->second = $req->seconds;
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
        } else {
            $qu = Mquestion::Where('exid', $req->exid)->Where('slno', $req->qid)->first();
            $stud = new StudExamAns();
            $stud->uid = Auth()->user()->id;
            $stud->exid = $req->exid;
            $stud->qid = $req->qid;
            $stud->uans = $req->uans;
            $stud->ans_check = $qu->answer == $req->uans ? '1' : '0';
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
                $dpm = ceil((60 * $marks) / $req->seconds);
                $result = new result();
                $result->uid = Auth()->user()->id;
                $result->exid = $req->exid;
                $result->second = $req->seconds;
                $result->marks_obtained = $marks;
                $result->dpm = $dpm;
                $status = $result->save();
                if ($status) {
                    return  ResMsg::successWithUrl("Data saved successfully !", "/practice/result/" . auth()->user()->id . "/" . $req->exid);
                } else {
                    return  ResMsg::error();
                }
            } else {
                return  ResMsg::error();
            }
        }
    }

    public function result(Request $req)
    {


        $result =  result::where('uid', auth()->user()->id)->where('exid', $req->exid)->first();
        $req->session()->put('second', $result->second);
        $req->session()->put('marks', $result->marks_obtained);
        $req->session()->put('dpm', $result->dpm);

        StudExamAns::where('uid', auth()->user()->id)->where('exid', $req->exid)->delete();
        $result->delete();



        return view('web.practice.index');
    }
}
