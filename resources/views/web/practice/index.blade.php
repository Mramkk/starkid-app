@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Practice Exam Result</h5>
@endsection
@section('content')
    <div class="row" style="min-height: 1000px;">
        <div class="card info-card sales-card ">
            <div class="card-body text-center">
                <h2 class="text-center mt-5">Result</h2>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-3 mt-3">
                        <p><b class="fs-5">Seconds : </b> <b class="ms-3 fs-5">{{ Session::get('second') }}</b></p>
                        <p><b class="fs-5">Marks : </b> <b class="ms-3 fs-5">{{ Session::get('marks') }}</b></p>
                        <p><b class="fs-5">DPM : </b> <b class="ms-3 fs-5">{{ Session::get('dpm') }}</b></p>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-5">Home</a>
                    </div>
                </div>

                {{ Session::forget('second') }}
                {{ Session::forget('marks') }}
                {{ Session::forget('dpm') }}
            </div>

        </div>

        <!-- Right side columns -->
    </div>
@endsection
