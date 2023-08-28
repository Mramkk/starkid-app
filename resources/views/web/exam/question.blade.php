@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('style')
    <style>
        .blink {
            font-size: 18px;
            color: #000000;
            font-weight: bold;
            text-align: center;
            animation: animate 1.5s linear infinite;
        }

        .blink1 {
            font-size: 18px;
            color: #fff;
            font-weight: bold;
            text-align: center;
            animation: animate 1.5s linear infinite;
        }

        @keyframes animate {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card info-card sales-card p-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>{{ $exam->class }}</h4>

                        </div>
                        <div class="col-md-3">
                            <h4>{{ $exam->question_type }}</h4>

                        </div>
                        <div class="col-md-3">
                            <p id="txtime" class="fw-bold text-lg-end"></p>

                        </div>
                    </div>

                    <hr>
                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <p>Total No. of Questions : {{ $qcount }}</p>
                        </div>
                        <div class="col-md-6 mb-2 text-lg-end">Questions Attempted : {{ $anscount }}</div>
                    </div>

                    @foreach ($mques as $item)
                        <div class="row ">

                            <div class="col-md-6">
                                <p class="fw-bold">Question No. {{ $item->slno }}</p>
                                <input hidden id="txtqid" value="{{ $item->id }}" type="text">
                            </div>
                            <div class="col-md-6">
                                {{-- <p id="txtime" class="fw-bold text-lg-end"></p> --}}
                            </div>


                        </div>
                        <div class="container">
                            {!! $item->question !!}
                        </div>
                        <div class="row mt-5 mb-5">
                            <p class="mt-5 fs-6">Notes : {{ $item->notes }}</p>
                        </div>
                    @endforeach
                    <div class="col-md-3 mt-5">
                        <input type="text" id="txtuans" name="uans" value="{{ $studAns->uans ?? '' }}"
                            class="form-control" placeholder="Answer" required>

                    </div>

                    {{ $mques->links('vendor.pagination.custom') }}

                </div>
            </div>
        </div>
        <div style="max-height:440px;overflow-y:scroll;" class="col-md-3 ">

            <div class="row">
                <div class="card info-card sales-card">
                    <div class="card-body p-3  text-center">


                        @foreach ($datalist as $item)
                            @if ($mques->first()->slno == $item->slno)
                                <a onclick="numClick({{ $mques->first()->exid }},{{ $item->slno }})" style="width: 60px;"
                                    class="{{ $item->uans <= '0' ? 'btn btn-light mb-2 rounded-circle shadow-sm border border-5' : 'btn btn-success mb-2 rounded-circle shadow-sm border border-5' }}">{{ $item->slno }}</a>
                            @else
                                <a onclick="numClick({{ $mques->first()->exid }},{{ $item->slno }})"
                                    style="width: 60px;"
                                    class="{{ $item->uans <= '0' ? 'btn btn-light  mb-2 rounded-circle shadow-sm' : 'btn btn-success mb-2 rounded-circle shadow-sm' }}">{{ $item->slno }}</a>
                            @endif
                        @endforeach




                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- model --}}


    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-5">

                <div class="modal-body">
                    <h4 class="mb-5 text-center">Do you want to start ?</h4>
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <button type="button" name="start" class="btn btn-success fw-bold w-100"
                                data-bs-dismiss="modal">Start</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('/') }}" class="btn btn-primary fw-bold w-100">Back</a>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script>
        if (screen.width > 480) {
            $('.toggle-sidebar-btn').trigger('click');
        }

        let seconds = 0;
        let mainSeconds = 0;



        let sec = sessionStorage.getItem("sec");
        let mainSec = sessionStorage.getItem("mainSec");

        if (sec != null) {
            seconds += parseInt(sec);
        }
        if (mainSec != null) {
            mainSeconds += parseInt(mainSec);
        }

        function myTimer() {
            seconds += 1;
            mainSeconds += 1;
            console.log(mainSeconds);
            sessionStorage.setItem("mainSec", mainSeconds);
            sessionStorage.setItem("sec", seconds);

            let min = Math.floor(mainSeconds / 60);
            let hours = Math.floor(min / 60);
            $('#txtime').text(hours.toString().padStart(2, '0') + " : " + min.toString().padStart(2, '0') + " : " +
                seconds
                .toString()
                .padStart(2, '0'));

            if (seconds >= 60) {
                seconds = 0

            }

        }


        $(document).ready(function() {
            let start = sessionStorage.getItem('start');
            if (start == null) {
                sessionStorage.setItem('start', true)
                $('#myModal').modal('toggle');
            } else {
                myInterval = setInterval(myTimer, 1000);
                if (start != "true") {
                    $('#myModal').modal('toggle');
                }
            }
            $("button[name='start']").click(function() {
                myInterval = setInterval(myTimer, 1000);

            });
        })

        // seconds = 0;

        function numClick(exid, qid) {
            var url = window.location.href;
            url = url.substr(0, url.lastIndexOf("?"));
            let slash = url.lastIndexOf('/');
            url += "?page=";
            url += qid;

            location.assign(url)
        }
    </script>
@endsection
