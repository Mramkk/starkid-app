<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\multiChoiceQues;
use App\Models\Queset;
use App\Models\Question;
use App\Models\result;
use App\Models\StudExamAns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index()
    {
        $class = Auth()->user()->class;
        $year =  date('Y', strtotime(Auth()->user()->created_at));
        $result = result::select('exid')->Where('uid', Auth()->user()->id)->latest()->get();
        $exams = DB::table('exams')
            ->select('type', 'slug')
            ->whereNotIn('id',  $result)
            ->where('class', $class)
            ->where('session', $year)
            ->groupBy('type', 'slug')
            ->get();
        if (is_null($exams)) {
            return view('web.home');
        } else {
            return view('web.exam.index', compact('exams'));
        }




        // $result = result::select('exid')->Where('uid', Auth()->user()->id)->latest();
        // $class = Auth()->user()->class;
        // return  Exam::whereNotIn('id',  $result)->Where('class', $class)->get();

    }
    public function list(Request $req)
    {

        $result = result::select('exid')->Where('uid', Auth()->user()->id)->latest();
        $class = Auth()->user()->class;
        $exams = Exam::whereNotIn('id',  $result)->Where('slug', $req->slug)->Where('class', $class)->get();
        if (is_null($exams)) {
            return view('web.home');
        } else {
            return view('web.exam.list', compact('exams'));
        }
    }
    public function examById(Request $req)
    {
        $exam = Exam::Where('id', $req->id)->first();
        if ($exam->question_type == "Multi Choice") {
            $multi =  multiChoiceQues::Where('exid', $req->id)->paginate(1);
            $qcount =  multiChoiceQues::Where('exid', $req->id)->count();
            $anscount = StudExamAns::Where('exid', $req->id)->Where('uans', '!=', '0')->get()->count();
            $studAns = StudExamAns::Where('exid', $req->id)->Where('qid', $multi->first()->id)->first();
            $datalist = DB::table('multi_choice_ques')
                ->select('*')
                ->leftJoin('stud_exam_ans', function ($join) {
                    $join->on('multi_choice_ques.exid', '=', 'stud_exam_ans.exid')
                        ->on('multi_choice_ques.id', '=', 'stud_exam_ans.qid');
                })
                ->where('multi_choice_ques.exid', $req->id)
                ->orderBy('multi_choice_ques.id', 'ASC')
                ->get();
            return view('web.exam.question-multi-choice', compact('exam', 'multi', 'qcount', 'anscount', 'studAns', 'datalist'));
        } else {
            $ques =  Question::Where('exid', $req->id)->first();
            if ($ques == null) {
                return '<script>
                alert("Question not found !")


                location.href = "./"
                </script>';
            } else {

                $exam = Exam::Where('id', $req->id)->first();
                $ques = Question::Where('exid', $req->id)->paginate(1);
                $qset = Queset::Where('exid', $req->id)->Where('qid', $ques->first()->id)->get();
                $studAns = StudExamAns::Where('exid', $req->id)->Where('qid', $ques->first()->id)->first();
                $count = StudExamAns::Where('exid', $req->id)->Where('uans', '!=', '0')->get()->count();
                $datalist = DB::table('questions')

                    ->select('*')
                    ->leftJoin('stud_exam_ans', function ($join) {
                        $join->on('questions.exid', '=', 'stud_exam_ans.exid')
                            ->on('questions.id', '=', 'stud_exam_ans.qid');
                    })
                    ->where('questions.exid', $req->id)
                    ->orderBy('questions.id', 'ASC')
                    ->get();





                return view('web.exam.question', compact('exam', 'ques', 'datalist', 'studAns', 'count', 'qset'));
            }
        }
    }
}
