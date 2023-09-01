@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')


    <div class="row">
        <h4 class="text-center">PDF</h4>
        <hr>
        <!-- Left side columns -->
        <!--  Card -->
        @if (is_null($data))
            <div class="row justify-content-center">

                <div class="col-md-3">
                    <p class="text-center">PDF Not Found</p>

                </div>
            </div>0
        @else
            @foreach ($data as $item)
                <div class="col-xxl-4 col-md-4 ">
                    <a href="{{ $item->file }}" target="_blank">

                        <div class="card info-card sales-card text-center">

                            <div class="card-body">
                                <div class="d-flex justify-content-center mt-3">

                                    <i class="bi bi-newspaper fs-1 text-dark"></i>

                                </div>
                                <p class="text-dark fw-bold mt-3">{{ $item->class }}</p>
                                <a class="fw-bold" href="{{ $item->file }}" target="_blank"
                                    rel="noopener noreferrer">{{ $item->title }}</a>

                            </div>

                        </div>
                    </a>

                </div><!-- End Card -->
            @endforeach
        @endif









        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script src="{{ url('assets/js/service.js') }}"></script>
@endsection
