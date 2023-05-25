<?php

namespace App\Http\Controllers\Admin\Question;

use App\Helper\ResMsg;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\multiChoiceQues;
use App\Models\Queset;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function index(Request $req)
    {
        $exam =  Exam::Where('id', $req->exid)->first();

        if ($exam->question_type == "Multi Choice") {
            return view('admin.question.multi-choice', compact('exam'));
        } else {
            return view('admin.question.create', compact('exam'));
        }
    }
    public function save(Request $req)
    {
        $qid = Question::max('id') + 1;
        $slno = Question::Where('exid', $req->exid)->max('slno') + 1;

        $que = new Question();
        $que->exid = $req->exid;
        $que->slno = $slno;
        $que->num_of_rows = $req->num_of_rows;


        $que->ans = $req->answer;
        $status = $que->save();
        if ($status) {
            for ($i = 0; $i < $req->num_of_rows; $i++) {
                $qs = new Queset();
                $qs->exid = $req->exid;
                $qs->qid = $qid;
                $qs->num = $req->num[$i];
                $qs->save();
            }
            return ResMsg::success('Question Added Successfully !');
        } else {
            return ResMsg::error();
        }
    }
    public function saveMcq(Request $req)
    {
        $req->validate([
            'question' => 'required|string',
            'choice_1' => 'required|string|max:225',
            'choice_2' => 'required|string|max:225',
            'choice_3' => 'required|string|max:225',
            'choice_4' => 'required|string|max:225',
            'notes' => 'required|string',
            'answer' => 'required|string|max:225',
        ]);
        $exam = Exam::Where('id', $req->exid)->first();
        if ($exam != null) {
            $slno = multiChoiceQues::Where('exid', $req->exid)->max('slno') + 1;
            $mcq = new multiChoiceQues();
            $mcq->exid =  $exam->id;
            $mcq->slno =  $slno;
            $mcq->question =  $req->question;
            $mcq->choice_1 =  $req->choice_1;
            $mcq->choice_2 =  $req->choice_2;
            $mcq->choice_3 =  $req->choice_3;
            $mcq->choice_4 =  $req->choice_4;
            $mcq->answer =  $req->answer;
            $mcq->notes =  $req->notes;
            $status =  $mcq->save();
            if ($status) {
                return redirect()->back()->with('success', 'Data saved successfully !');
            } else {
                return redirect()->back()->with('error', 'Error, try again later.');
            }
        } else {
            return redirect()->back()->with('error', 'Error, try again later.');
        }
    }
    public function edit(Request $req)
    {
        $ques = Question::Where('id', $req->qid)->first();
        return view('admin.question.edit', compact('ques'));
    }

    public function update(Request $req)
    {
        $que = Question::Where('id', $req->qid)->first();
        $que->num_of_rows = $req->num_of_rows;
        $que->ans = $req->answer;
        $status = $que->update();
        $status = Queset::Where('qid', $que->id)->delete();
        if ($status) {

            for ($i = 0; $i < $req->num_of_rows; $i++) {
                $qs = new Queset();
                $qs->exid = $que->exid;
                $qs->qid = $que->id;
                $qs->num = $req->num[$i];
                $qs->save();
            }
            return ResMsg::success('Question Updated Successfully !');
        } else {
            return ResMsg::error();
        }
    }
}
