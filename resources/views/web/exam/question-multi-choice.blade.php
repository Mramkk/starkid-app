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

                    @foreach ($multi as $item)
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
                    @endforeach
                    <div class="row mt-5 mb-5">
                        <hr>
                        <div class="col-md-3">
                            <label class="mb-2 me-3"><span class="me-2">(A)</span> {{ $multi->first()->option_1 }}</label>
                            @if (is_null($studAns))
                                <input class="form-check-input" type="radio" name="uans"
                                    value="{{ $multi->first()->option_1 }}">
                            @else
                                @if ($multi->first()->option_1 == $studAns->uans)
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_1 }}" checked>
                                @else
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_1 }}">
                                @endif
                            @endif
                        </div>

                        <div class="col-md-3">
                            <label class="mb-2 me-3"><span class="me-2">(B)</span>
                                {{ $multi->first()->option_2 }}</label>
                            @if (is_null($studAns))
                                <input class="form-check-input" type="radio" name="uans"
                                    value="{{ $multi->first()->option_2 }}">
                            @else
                                @if ($multi->first()->option_2 == $studAns->uans)
                                    <input class="form-check-input" type="radio" name="uans"
                                        {{ $multi->first()->option_2 }} checked>
                                @else
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_2 }}">
                                @endif
                            @endif
                        </div>

                        <div class="col-md-3">
                            <label class="mb-2 me-3"><span class="me-2">(C)</span>
                                {{ $multi->first()->option_3 }}</label>
                            @if (is_null($studAns))
                                <input class="form-check-input" type="radio" name="uans"
                                    value="{{ $multi->first()->option_3 }}">
                            @else
                                @if ($multi->first()->option_3 == $studAns->uans)
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_3 }}" checked>
                                @else
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_3 }}">
                                @endif
                            @endif
                        </div>

                        <div class="col-md-3">
                            <label class="mb-2 me-3"><span class="me-2">(D)</span>
                                {{ $multi->first()->option_4 }}</label>
                            @if (is_null($studAns))
                                <input class="form-check-input" type="radio" name="uans"
                                    value="{{ $multi->first()->option_4 }}">
                            @else
                                @if ($multi->first()->option_4 == $studAns->uans)
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_4 }}" checked>
                                @else
                                    <input class="form-check-input" type="radio" name="uans"
                                        value="{{ $multi->first()->option_4 }}">
                                @endif
                            @endif

                        </div>

                    </div>
                    {{-- <div class="col-md-3 mt-5">
                        <input type="text" id="txtuans" name="uans" value="{{ $studAns->uans ?? '' }}"
                            class="form-control" placeholder="Answer" required>

                    </div> --}}

                    {{ $multi->links('vendor.pagination.multi') }}

                </div>
            </div>
        </div>
        <div style="max-height:440px;overflow-y:scroll;" class="col-md-3 ">

            <div class="row">
                <div class="card info-card sales-card">
                    <div class="card-body p-3  text-center">


                        @foreach ($datalist as $item)
                            @if ($multi->first()->slno == $item->slno)
                                <a onclick="numClick({{ $multi->first()->exid }},{{ $item->slno }})"
                                    style="width: 60px;"
                                    class="{{ $item->uans <= '0' ? 'btn btn-light mb-2 rounded-circle shadow-sm border border-5' : 'btn btn-success mb-2 rounded-circle shadow-sm border border-5' }}">{{ $item->slno }}</a>
                            @else
                                <a onclick="numClick({{ $multi->first()->exid }},{{ $item->slno }})"
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
        let mainSce = sessionStorage.getItem("mainSec");

        if (sec != null) {
            seconds += parseInt(sec);
        }
        if (mainSce != null) {
            mainSce += parseInt(mainSce);
        }


        function myTimer() {
            seconds += 1;
            mainSeconds += 1;
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
            let start = sessionStorage.getItem('startmcq');
            if (start == null) {
                sessionStorage.setItem('startmcq', true)
                $('#myModal').modal('toggle');
            } else {
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
