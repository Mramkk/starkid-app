<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {

        $data =  Pdf::latest()->where('class', auth()->user()->class)->where('status', '1')->get();
        return view('web.pdf.index', compact('data'));
    }
}
