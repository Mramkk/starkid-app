@extends('admin.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <div class="row">
        <!-- Left side columns -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('admin.student') }}">

                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <i class="bi bi-people  fs-1 text-danger"></i>
                        </div>
                        <h5 class="card-title text-primary">Students</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ url('/admin/exam') }}">

                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">

                            <i class="bi bi-newspaper fs-1 text-danger"></i>

                        </div>
                        <h5 class="card-title text-primary">Exam</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ url('/admin/exam') }}">

                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">

                            <i class="bi bi-newspaper fs-1 text-danger"></i>

                        </div>
                        <h5 class="card-title text-primary">Result</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->








        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
@endsection
