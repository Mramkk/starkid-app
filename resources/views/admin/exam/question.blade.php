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
        <div class="card info-card sales-card p-5">
            <div class="card-body">

                @foreach ($ques as $cal)
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="fw-bold">Question No. {{ $cal->id }}</p>
                        </div>
                        <div class="col-md-6">
                            <p id="txtime" class="fw-bold text-end"></p>
                        </div>


                    </div>
                    <div class="container">
                        <div class="row fw-bold">
                            {{ $cal->d1 }}
                        </div>
                        <div class="row fw-bold">
                            {{ $cal->d2 }}
                        </div>
                        <div class="row fw-bold">
                            {{ $cal->d3 }}
                        </div>
                        <div class="row fw-bold">
                            {{ $cal->d4 }}
                        </div>


                    </div>
                @endforeach
                <div class="col-md-3 mt-5">
                    <input type="text" id="txtuans" name="uans" class="form-control" placeholder="Answer" required>

                </div>

                {{ $ques->links('vendor.pagination.custom') }}

            </div>
        </div>








        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script>
        let seconds = 0;
        let sec = sessionStorage.getItem("sec");

        if (sec != "") {
            seconds += parseInt(sec);
        }

        function myTimer() {
            seconds += 1;

            $('#txtime').text(seconds + " Sec");

        }
        myInterval = setInterval(myTimer, 1000);
        // seconds = 0;
    </script>
@endsection
