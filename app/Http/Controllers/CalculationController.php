<?php

namespace App\Http\Controllers;

use App\Helper\ResMsg;
use App\Models\Calculation;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function multipliction(Request $req)
    {

        $cal = new Calculation();
        $cal->uid = auth()->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
    }
    public function division(Request $req)
    {

        $cal = new Calculation();
        $cal->uid = auth()->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
    }
    public function addition(Request $req)
    {


        $cal = new Calculation();
        $cal->uid = auth()->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
        // return $req->all();
    }
    public function subtraction(Request $req)
    {

        $cal = new Calculation();
        $cal->uid = auth()->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
        // return $req->all();
    }
    public function flashCard(Request $req)
    {


        $cal = new Calculation();
        $cal->uid = $req->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
        // return $req->all();
    }
    public function square(Request $req)
    {


        $cal = new Calculation();
        $cal->uid = $req->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
        // return $req->all();
    }
    public function cube(Request $req)
    {


        $cal = new Calculation();
        $cal->uid = $req->user()->id;
        $cal->operation = $req->operation;
        $cal->nums = $req->nums;
        $cal->uans = $req->uans;
        $cal->second = $req->time;
        $cal->cans = $req->cans;
        $status = $cal->save();
        if ($status) {
            return  ResMsg::success('Data save successfully !');
        } else {
            return  ResMsg::error();
        }
        // return $req->all();
    }
}
