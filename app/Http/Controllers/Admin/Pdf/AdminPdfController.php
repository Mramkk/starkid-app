<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Helper\ResMsg;
use App\Http\Controllers\Controller;
use App\Models\Pdf;
use Illuminate\Http\Request;

class AdminPdfController extends Controller
{
    public function index()
    {
        $data = Pdf::latest()->get();
        return view('admin.pdf.index', compact('data'));
    }
    public function create()
    {
        return view('admin.pdf.create');
    }
    public function save(Request $req)
    {
        $req->validate([
            'title' => 'required|string',
            'class' => 'required|string',
            'file' => 'required|mimes:pdf|max:10000'
        ]);

        $obj = new Pdf();
        $obj->title = $req->title;
        $obj->class = $req->class;
        $status =  $obj->save();
        if ($req->hasFile('file')) {
            $path = public_path('pdfs/');
            $fileName =  uniqid() . ".pdf";
            $obj->file = "public/pdfs/" . $fileName;
            $status =  $obj->save();
            $status = $req->file->move($path, $fileName);
        }
        if ($status) {
            return redirect()->back()->with('success', 'Data saved successfully !');
        } else {
            return redirect()->back()->with('error', 'Error, try again later.');
        }
    }
    public function edit(Request $req)
    {
        $data =  Pdf::where('id', $req->id)->first();
        return view('admin.pdf.edit', compact('data'));
    }
    public function update(Request $req)
    {


        $req->validate([
            'title' => 'required|string',
            'class' => 'required|string',

        ]);
        $obj =  Pdf::where('id', $req->id)->first();
        $obj->title = $req->title;
        $obj->class = $req->class;
        $status =  $obj->update();
        // 
        if ($req->hasFile('file')) {
            $req->validate([

                'file' => 'required|mimes:pdf|max:10000'
            ]);
            $status = unlink($obj->file);
            $path = public_path('pdfs/');
            $fileName =  uniqid() . ".pdf";
            $obj->file = "public/pdfs/" . $fileName;
            $status =  $obj->update();
            $status = $req->file->move($path, $fileName);
        }
        if ($status) {
            return redirect()->back()->with('success', 'Data updated successfully !');
        } else {
            return redirect()->back()->with('error', 'Error, try again later.');
        }
    }
    public function status(Request $req)
    {
        $obj = Pdf::Where('id', $req->id)->first();
        if ($obj->status == '1') {
            $obj->status = "0";
            $status = $obj->update();
            if ($status) {

                return  ResMsg::success('Status Changed Successfully ! ');
            } else {
                return  ResMsg::error();
            }
        } else {
            $obj->status = "1";
            $status = $obj->update();
            if ($status) {

                return  ResMsg::success('Status Changed Successfully ! ');
            } else {
                return  ResMsg::error();
            }
        }
    }
    public function delete(Request $req)
    {
        $obj = Pdf::Where('id', $req->id)->first();
        if ($obj->file != null) {
            unlink($obj->file);
        }
        $status = $obj->delete();
        if ($status) {

            return  ResMsg::success('Data deleted successfully ! ');
        } else {
            return  ResMsg::error();
        }
    }
}
