@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')


    <div class="row">
        <h4 class="text-center">Exams</h4>
        <hr>
        <!-- Left side columns -->
        <!--  Card -->
        @if (is_null($exams))
            <div class="row justify-content-center">

                <div class="col-md-3">
                    <p class="text-center">Exam Not Found</p>

                </div>
            </div>
        @else
            @foreach ($exams as $item)
                <div class="col-xxl-4 col-md-4 ">


                    <div class="card info-card sales-card text-center">
                        <a href="{{ url('exam') . '/' . $item->id }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mt-3">

                                    <i class="bi bi-newspaper fs-1 text-dark"></i>

                                </div>
                                <p class="text-primary fw-bold">{{ $item->title }}</p>
                                <p class="text-dark fw-bold mt-3">{{ $item->class }} <br> ({{ $item->question_type }})</p>



                                {{-- <p class="text-dark">No. of Question : {{ $item->no_of_questions }}</p> --}}
                            </div>
                        </a>
                    </div>


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
    <script>
        sessionStorage.removeItem("sec");
    </script>
@endsection
