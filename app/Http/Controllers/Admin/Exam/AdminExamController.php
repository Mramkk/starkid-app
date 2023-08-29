<?php

namespace App\Http\Controllers\Admin\exam;

use App\Helper\ResMsg;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Mquestion;
use App\Models\multiChoiceQues;
use App\Models\Queset;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminExamController extends Controller
{
    public function index()
    {



        $exams = DB::table('exams')
            ->select('type', 'slug')
            ->groupBy('type', 'slug')
            ->get();
        return view('admin.exam.index', compact('exams'));
    }
    public function exam(Request $req)
    {
        $exams = Exam::where('slug', '=', $req->slug)->get();
        return view('admin.exam.exam', compact('exams'));
    }

    public function createExamIndex()
    {

        return view('admin.exam.create');
    }

    public function view(Request $req)
    {
        $exam = Exam::Where('id', $req->id)->first();

        if ($exam->question_type == "Multi Choice") {
            $multi = multiChoiceQues::where('exid', $exam->id)->get();
            return view('admin.exam.view-multi-choice', compact('exam', 'multi'));
        } else {
            // $ques = Question::Where('exid', $exam->id)->with('qset')->get();
            // return view('admin.exam.view', compact('exam', 'ques'));
            $ques = Mquestion::Where('exid', $exam->id)->get();
            return view('admin.exam.view', compact('exam', 'ques'));
        }
    }

    public function delete(Request $req)
    {
        $exam = Exam::Where('id', $req->id)->first();
        if ($exam->question_type == "Multi Choice") {

            $mcq = multiChoiceQues::Where('exid', $req->id)->get();
            if ($mcq != null) {
                $status =  $mcq->delete();
            }
            $status = $exam->delete();
            if ($status) {
                return ResMsg::success('Deleted deleted successfully !');
            } else {
                return ResMsg::error();
            }
        } else {
            $status = $exam->delete();
            $mq =  Mquestion::Where('exid', $req->id)->delete();
            if ($mq != null) {
                $status =  $mq->delete();
            }



            if ($status) {
                return ResMsg::success('Deleted deleted successfully !');
            } else {
                return ResMsg::error();
            }
        }
    }
    public function edit(Request $req)
    {
        $exam = Exam::Where('id', $req->id)->first();
        if ($exam->question_type == "Multi Choice") {
            return view('admin.exam.edit', compact('exam'));
        } else {
            return view('admin.exam.edit', compact('exam'));
        }
    }

    public function update(Request $req)
    {
        $validator =  Validator::make($req->all(), [
            'title' => 'required|string|max:225',
            'class' => 'required|string|max:225',
            'marks_per_question' => 'required|numeric|digits_between:0,9',
            'pass_marks' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->first('title')) {
                return ResMsg::failed($errors->first('title'));
            } else if ($errors->first('class')) {
                return ResMsg::failed($errors->first('class'));
            } else if ($errors->first('marks_per_question')) {
                return ResMsg::failed($errors->first('marks_per_question'));
            } else if ($errors->first('pass_marks')) {
                return ResMsg::failed($errors->first('pass_marks'));
            }
        }

        $exam =  Exam::Where('id', $req->id)->first();
        $exam->title = $req->title;
        $exam->class = $req->class;
        $exam->marks_per_question = $req->marks_per_question;
        $exam->pass_marks = $req->pass_marks;

        $status = $exam->update();
        if ($status) {
            return ResMsg::success('Exam Updated Successfully !');
        } else {
            return ResMsg::error();
        }
    }

    public function createExam(Request $req)
    {


        $validator =  Validator::make($req->all(), [
            'title' => 'required|string|max:225',
            'class' => 'required|string|max:225',
            'marks_per_question' => 'required|numeric|digits_between:0,9',
            'pass_marks' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->first('title')) {
                return ResMsg::failed($errors->first('title'));
            } else if ($errors->first('class')) {
                return ResMsg::failed($errors->first('class'));
            } else if ($errors->first('marks_per_question')) {
                return ResMsg::failed($errors->first('marks_per_question'));
            } else if ($errors->first('pass_marks')) {
                return ResMsg::failed($errors->first('pass_marks'));
            }
        }

        $id = Exam::max('id') + 1;
        $exam = new Exam();
        $exam->session = date("Y");
        $exam->title = $req->title;
        $exam->slug =  Str::slug($req->type);
        $exam->type = $req->type;
        $exam->question_type = $req->question_type;
        $exam->class = $req->class;
        $exam->marks_per_question = $req->marks_per_question;
        $exam->pass_marks = $req->pass_marks;

        $status = $exam->save();
        if ($status) {
            return ResMsg::success('Exam Created Successfully !');
        } else {
            return ResMsg::error();
        }
    }

    public function createExam1(Request $req)
    {


        $validator =  Validator::make($req->all(), [
            'title' => 'required|string|max:225',
            'class' => 'required|string|max:225',
            'digit_from' => 'required|numeric|digits_between:1,9',
            'digit_to' => 'required|numeric|digits_between:1,9',
            'no_of_questions' => 'required|numeric|min:1|max:100',
            'marks_per_question' => 'required|numeric|digits_between:1,10',
            'pass_marks' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->first('title')) {
                return ResMsg::failed($errors->first('title'));
            } else if ($errors->first('class')) {
                return ResMsg::failed($errors->first('class'));
            } else if ($errors->first('digit_from')) {
                return ResMsg::failed($errors->first('digit_from'));
            } else if ($errors->first('digit_to')) {
                return ResMsg::failed($errors->first('digit_to'));
            } else if ($errors->first('no_of_questions')) {
                return ResMsg::failed($errors->first('no_of_questions'));
            } else if ($errors->first('marks_per_question')) {
                return ResMsg::failed($errors->first('marks_per_question'));
            } else if ($errors->first('pass_marks')) {
                return ResMsg::failed($errors->first('pass_marks'));
            }
        }
        $id = Exam::max('id') + 1;
        $exam = new Exam();
        $exam->title = $req->title;
        $exam->class = $req->class;
        $exam->digit_from = $req->digit_from;
        $exam->digit_to = $req->digit_to;
        $exam->no_of_questions = $req->no_of_questions;
        $exam->marks_per_question = $req->marks_per_question;
        $exam->pass_marks = $req->pass_marks;
        $exam->short_description = $req->short_desc;
        $exam->long_description = $req->long_desc;
        $status = $exam->save();
        if ($status) {
            $nums = range($req->digit_from, $req->digit_to);
            for ($i = 1; $i <= $req->no_of_questions; $i++) {
                if ($req->no_of_questions == 50) {
                    $this->fifty($id, $i, $nums);
                } else {
                    $this->hundred($id, $i, $nums);
                }
            }



            return ResMsg::success('Exam Created Successfully !');
        } else {
            return ResMsg::error();
        }
    }

    public function fifty($id, $i, $nums)
    {



        if (count($nums) == 2) {

            if ($i < 25) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                }
            } elseif ($i >= 25 && $i <= 50) {
                if ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->eightDigit($id, $i);
                }
            }
        } else if (count($nums) == 3) {
            if ($i < 20) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 35) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 35 && $i <= 50) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 4) {
            if ($i < 20) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 30) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 40) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 50) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 5) {
            if ($i < 10) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 20) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 30) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 40) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 50) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 6) {
            if ($i < 5) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 5 && $i <= 10) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 20) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 30) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 40) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 50) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 7) {
            if ($i < 5) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 5 && $i <= 10) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 15) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 15 && $i <= 20) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 30) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 40) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 50) {
                if ($nums[6] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[6] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[6] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[6] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[6] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[6] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[6] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[6] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[6] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 8) {
            if ($i < 5) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 5 && $i <= 10) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 20) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 30) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 35) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 35 && $i <= 40) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 45) {
                if ($nums[6] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[6] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[6] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[6] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[6] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[6] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[6] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[6] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[6] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 45 && $i <= 50) {
                if ($nums[7] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[7] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[7] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[7] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[7] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[7] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[7] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[7] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[7] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 9) {
            if ($i < 5) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 5 && $i <= 10) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 15) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 15 && $i <= 25) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 25 && $i <= 30) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 35) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 35 && $i <= 40) {
                if ($nums[6] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[6] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[6] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[6] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[6] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[6] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[6] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[6] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[6] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 45) {
                if ($nums[7] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[7] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[7] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[7] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[7] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[7] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[7] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[7] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[7] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 45 && $i <= 50) {
                if ($nums[8] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[8] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[8] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[8] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[8] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[8] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[8] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[8] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[8] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        }
    }

    public function hundred($id, $i, $nums)
    {



        if (count($nums) == 2) {

            if ($i < 50) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                }
            } elseif ($i >= 50 && $i <= 100) {
                if ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->eightDigit($id, $i);
                }
            }
        } else if (count($nums) == 3) {
            if ($i < 35) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 35 && $i <= 70) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 70 && $i <= 100) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 4) {
            if ($i < 25) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 25 && $i <= 50) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 50 && $i <= 75) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 75 && $i <= 100) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 5) {
            if ($i < 20) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 40) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 60) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 60 && $i <= 80) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 80 && $i <= 100) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 6) {
            if ($i < 10) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 30) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 40) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 60) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 60 && $i <= 80) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 80 && $i <= 100) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 7) {
            if ($i < 10) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 20) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 30) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 30 && $i <= 50) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 50 && $i <= 70) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 70 && $i <= 90) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 90 && $i <= 10) {
                if ($nums[6] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[6] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[6] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[6] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[6] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[6] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[6] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[6] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[6] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 8) {
            if ($i < 5) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 5 && $i <= 10) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 20) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 40) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 55) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 55 && $i <= 75) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 75 && $i <= 90) {
                if ($nums[6] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[6] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[6] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[6] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[6] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[6] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[6] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[6] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[6] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 90 && $i <= 100) {
                if ($nums[7] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[7] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[7] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[7] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[7] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[7] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[7] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[7] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[7] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        } else if (count($nums) == 9) {
            if ($i < 5) {
                if ($nums[0] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[0] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[0] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[0] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[0] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[0] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[0] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[0] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[0] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 5 && $i <= 10) {
                if ($nums[1] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[1] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[1] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[1] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[1] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[1] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[1] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[1] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[1] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 10 && $i <= 20) {
                if ($nums[2] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[2] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[2] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[2] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[2] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[2] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[2] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[2] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[2] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 20 && $i <= 40) {
                if ($nums[3] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[3] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[3] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[3] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[3] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[3] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[3] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[3] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[3] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 40 && $i <= 60) {
                if ($nums[4] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[4] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[4] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[4] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[4] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[4] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[4] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[4] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[4] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 60 && $i <= 70) {
                if ($nums[5] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[5] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[5] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[5] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[5] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[5] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[5] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[5] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[5] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 70 && $i <= 80) {
                if ($nums[6] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[6] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[6] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[6] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[6] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[6] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[6] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[6] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[6] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 80 && $i <= 90) {
                if ($nums[7] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[7] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[7] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[7] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[7] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[7] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[7] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[7] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[7] == 9) {
                    $this->nineDigit($id, $i);
                }
            } elseif ($i >= 90 && $i <= 100) {
                if ($nums[8] == 1) {
                    $this->oneDigit($id, $i);
                } elseif ($nums[8] == 2) {
                    $this->twoDigit($id, $i);
                } elseif ($nums[8] == 3) {
                    $this->threeDigit($id, $i);
                } elseif ($nums[8] == 4) {
                    $this->fourDigit($id, $i);
                } elseif ($nums[8] == 5) {
                    $this->fiveDigit($id, $i);
                } elseif ($nums[8] == 6) {
                    $this->sixDigit($id, $i);
                } elseif ($nums[8] == 7) {
                    $this->sevenDigit($id, $i);
                } elseif ($nums[8] == 8) {
                    $this->eightDigit($id, $i);
                } elseif ($nums[8] == 9) {
                    $this->nineDigit($id, $i);
                }
            }
        }
    }

    public function oneDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(1, 9);
        $d2 = rand(1, 9);
        $d3 = rand(1, 9);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 10) {
            $d4 =  rand(1, 9);
        } else {
            $d4 =  rand(1, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function twoDigit($id, $i)
    {

        $q = new Question();
        $d1 = rand(10, 99);
        $d2 = rand(10, 99);
        $d3 = rand(10, 99);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 99) {
            $d4 =  rand(10, 99);
        } else {
            $d4 =  rand(10, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function threeDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(100, 999);
        $d2 = rand(100, 999);
        $d3 = rand(100, 999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 999) {
            $d4 =  rand(100, 999);
        } else {
            $d4 =  rand(100, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function fourDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(1000, 9999);
        $d2 = rand(1000, 9999);
        $d3 = rand(1000, 9999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 9999) {
            $d4 =  rand(1000, 9999);
        } else {
            $d4 =  rand(1000, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function fiveDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(10000, 99999);
        $d2 = rand(10000, 99999);
        $d3 = rand(10000, 99999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 99999) {
            $d4 =  rand(10000, 99999);
        } else {
            $d4 =  rand(10000, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function sixDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(100000, 999999);
        $d2 = rand(100000, 999999);
        $d3 = rand(100000, 999999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 999999) {
            $d4 =  rand(100000, 999999);
        } else {
            $d4 =  rand(100000, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }

    public function sevenDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(1000000, 9999999);
        $d2 = rand(1000000, 9999999);
        $d3 = rand(1000000, 9999999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 9999999) {
            $d4 =  rand(1000000, 9999999);
        } else {
            $d4 =  rand(1000000, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function eightDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(10000000, 99999999);
        $d2 = rand(10000000, 99999999);
        $d3 = rand(10000000, 99999999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 99999999) {
            $d4 =  rand(10000000, 99999999);
        } else {
            $d4 =  rand(10000000, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
    public function nineDigit($id, $i)
    {
        $q = new Question();
        $d1 = rand(100000000, 999999999);
        $d2 = rand(100000000, 999999999);
        $d3 = rand(100000000, 999999999);
        $cal = $d1 * $d2;
        $d4 = 0;
        if ($cal > 999999999) {
            $d4 =  rand(100000000, 999999999);
        } else {
            $d4 =  rand(100000000, $cal);
        }


        $ans = $d1 * $d2 + $d3 - $d4;
        $d1 = $d1 . "*";
        $d4 = "-" . $d4;
        $q->exid =  $id;
        $q->slno =  $i;
        $q->d1 = $d1;
        $q->d2 = $d2;
        $q->d3 = $d3;
        $q->d4 = $d4;
        $q->ans = $ans;
        $q->save();
    }
}
