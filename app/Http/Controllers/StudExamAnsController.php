<?php

namespace App\Http\Controllers;

use App\Helper\ResMsg;
use App\Models\Exam;
use App\Models\Mquestion;
use App\Models\multiChoiceQues;
use App\Models\Question;
use App\Models\StudExamAns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudExamAnsController extends Controller
{
    public function ansByStud(Request $req)
    {
        $exam = Exam::Where('id', $req->exid)->first();
        if ($exam->question_type == "Multi Choice") {
            $status = StudExamAns::Where('uid', Auth()->user()->id)->Where('qid', $req->qid)->Where('exid', $req->exid)->first();
            if ($status != null) {
                $qu = multiChoiceQues::Where('id', $req->qid)->Where('exid', $req->exid)->first();
                $stud =  StudExamAns::Where('uid', Auth()->user()->id)->Where('qid', $req->qid)->Where('exid', $req->exid)->first();
                $stud->uid = Auth()->user()->id;
                $stud->exid = $req->exid;
                $stud->qid = $req->qid;
                $stud->uans = $req->uans;
                $stud->ans_check = $qu->answer == $req->uans ? '1' : '0';
                $status = $stud->update();
                if ($status) {
                    return  ResMsg::success("Updated Successfully !");
                } else {
                    return  ResMsg::error();
                }
            } else {
                $qu = multiChoiceQues::Where('id', $req->qid)->Where('exid', $req->exid)->first();
                $stud = new StudExamAns();
                $stud->uid = Auth()->user()->id;
                $stud->exid = $req->exid;
                $stud->qid = $req->qid;
                $stud->uans = $req->uans;
                $stud->ans_check = $qu->answer == $req->uans ? '1' : '0';
                $status = $stud->save();
                if ($status) {
                    return  ResMsg::success("Submited Successfully !");
                } else {
                    return  ResMsg::error();
                }
            }
        } else {
            $status = StudExamAns::Where('uid', Auth()->user()->id)->Where('qid', $req->qid)->Where('exid', $req->exid)->first();
            if ($status != null) {
                $qu = Mquestion::Where('id', $req->qid)->Where('exid', $req->exid)->first();
                $stud =  StudExamAns::Where('uid', Auth()->user()->id)->Where('qid', $req->qid)->Where('exid', $req->exid)->first();
                $stud->uid = Auth()->user()->id;
                $stud->exid = $req->exid;
                $stud->qid = $req->qid;
                $stud->uans = $req->uans;
                $stud->ans_check = $qu->answer == $req->uans ? '1' : '0';
                $status = $stud->update();
                if ($status) {
                    return  ResMsg::success("Updated Successfully !");
                } else {
                    return  ResMsg::error();
                }
            } else {
                $qu = Mquestion::Where('id', $req->qid)->Where('exid', $req->exid)->first();
                $stud = new StudExamAns();
                $stud->uid = Auth()->user()->id;
                $stud->exid = $req->exid;
                $stud->qid = $req->qid;
                $stud->uans = $req->uans;
                $stud->ans_check = $qu->answer == $req->uans ? '1' : '0';
                $status = $stud->save();
                if ($status) {
                    return  ResMsg::success("Submited Successfully !");
                } else {
                    return  ResMsg::error();
                }
            }
        }
    }
}
