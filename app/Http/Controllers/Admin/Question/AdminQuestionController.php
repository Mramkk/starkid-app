<?php

namespace App\Http\Controllers\Admin\Question;

use App\Helper\ResMsg;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Mquestion;
use App\Models\multiChoiceQues;
use App\Models\Queset;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function index(Request $req)
    {
        $exam =  Exam::Where('id', $req->exid)->first();

        if ($exam->type == "") {
        } else if ($exam->question_type == "Multi Choice") {
            return view('admin.question.multi-choice', compact('exam'));
        } else {
            return view('admin.question.create', compact('exam'));
        }
    }
    // public function save(Request $req)
    // {
    //     $qid = Question::max('id') + 1;
    //     $slno = Question::Where('exid', $req->exid)->max('slno') + 1;

    //     $que = new Question();
    //     $que->exid = $req->exid;
    //     $que->slno = $slno;
    //     $que->num_of_rows = $req->num_of_rows;


    //     $que->ans = $req->answer;
    //     $status = $que->save();
    //     if ($status) {
    //         for ($i = 0; $i < $req->num_of_rows; $i++) {
    //             $qs = new Queset();
    //             $qs->exid = $req->exid;
    //             $qs->qid = $qid;
    //             $qs->num = $req->num[$i];
    //             $qs->save();
    //         }
    //         return ResMsg::success('Question Added Successfully !');
    //     } else {
    //         return ResMsg::error();
    //     }
    // }
    public function save(Request $req)
    {
        $req->validate([
            'question' => 'required|string',
            'answer' => 'required|string|max:225',
        ]);
        $exam = Exam::Where('id', $req->exid)->first();
        if ($exam != null) {
            $slno = Mquestion::Where('exid', $req->exid)->max('slno') + 1;
            $mcq = new Mquestion();
            $mcq->exid =  $exam->id;
            $mcq->slno =  $slno;
            $mcq->question =  $req->question;
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
    public function saveMcq(Request $req)
    {
        $req->validate([
            'question' => 'required|string',
            'option_1' => 'required|string|max:225',
            'option_2' => 'required|string|max:225',
            'option_3' => 'required|string|max:225',
            'option_4' => 'required|string|max:225',
            'answer' => 'required|string|max:225',
        ]);
        $exam = Exam::Where('id', $req->exid)->first();
        if ($exam != null) {
            $slno = multiChoiceQues::Where('exid', $req->exid)->max('slno') + 1;
            $mcq = new multiChoiceQues();
            $mcq->exid =  $exam->id;
            $mcq->slno =  $slno;
            $mcq->question =  $req->question;
            $mcq->option_1 =  $req->option_1;
            $mcq->option_2 =  $req->option_2;
            $mcq->option_3 =  $req->option_3;
            $mcq->option_4 =  $req->option_4;
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

        $exam = Exam::Where('id', $req->exid)->first();
        if ($exam->question_type == "Multi Choice") {
            $multi = multiChoiceQues::Where('id', $req->qid)->Where('exid', $req->exid)->first();
            return view('admin.question.edit-multi-choice', compact('multi'));
        } else {
            $ques = Mquestion::Where('id', $req->qid)->first();
            return view('admin.question.edit', compact('ques'));
        }
        // $ques = Question::Where('id', $req->qid)->first();
        // return view('admin.question.edit', compact('ques'));
    }

    // public function update(Request $req)
    // {
    //     return $req->qid;
    //     // $que = Question::Where('id', $req->qid)->first();
    //     // $que->num_of_rows = $req->num_of_rows;
    //     // $que->ans = $req->answer;
    //     // $status = $que->update();
    //     // $status = Queset::Where('qid', $que->id)->delete();
    //     // if ($status) {

    //     //     for ($i = 0; $i < $req->num_of_rows; $i++) {
    //     //         $qs = new Queset();
    //     //         $qs->exid = $que->exid;
    //     //         $qs->qid = $que->id;
    //     //         $qs->num = $req->num[$i];
    //     //         $qs->save();
    //     //     }
    //     //     return ResMsg::success('Question Updated Successfully !');
    //     // } else {
    //     //     return ResMsg::error();
    //     // }
    // }

    public function update(Request $req)
    {
        $mcq = Mquestion::where('id', $req->id)->first();
        $mcq->question =  $req->question;
        $mcq->answer =  $req->answer;
        $mcq->notes =  $req->notes;
        $status =  $mcq->update();
        if ($status) {
            return redirect()->back()->with('success', 'Data updated successfully !');
        } else {
            return redirect()->back()->with('error', 'Error, try again later.');
        }
    }
    public function updateMcq(Request $req)
    {
        $mcq = multiChoiceQues::where('id', $req->id)->first();
        $mcq->question =  $req->question;
        $mcq->option_1 =  $req->option_1;
        $mcq->option_2 =  $req->option_2;
        $mcq->option_3 =  $req->option_3;
        $mcq->option_4 =  $req->option_4;
        $mcq->answer =  $req->answer;
        $mcq->notes =  $req->notes;
        $status =  $mcq->update();
        if ($status) {
            return redirect()->back()->with('success', 'Data updated successfully !');
        } else {
            return redirect()->back()->with('error', 'Error, try again later.');
        }
    }
}
