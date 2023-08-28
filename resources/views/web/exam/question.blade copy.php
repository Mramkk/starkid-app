@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card info-card sales-card p-5">
                <div class="card-body">
                    <h4>{{ $exam->class }}</h4>
                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <p>Total No. of Questions : {{ $datalist->count() }}</p>
                        </div>
                        <div class="col-md-6 mb-2 text-lg-end">Questions Attempted : {{ $count }}</div>
                    </div>
                    @foreach ($ques as $item)
                        <div class="row ">

                            <div class="col-md-6">
                                <p class="fw-bold">Question No. {{ $item->slno }}</p>
                                <input hidden id="txtqid" value="{{ $item->id }}" type="text">
                            </div>
                            <div class="col-md-6">
                                <p id="txtime" class="fw-bold text-lg-end"></p>
                            </div>


                        </div>
                        <div class="container">
                            @foreach ($qset as $q)
                                <div class="row fw-bold">
                                    {{ $q->num }}
                                </div>
                            @endforeach

                            {{-- <div class="row fw-bold">
                                {{ $item->d2 }}
                            </div>
                            <div class="row fw-bold">
                                {{ $item->d3 }}
                            </div>
                            <div class="row fw-bold">
                                {{ $item->d4 }}
                            </div> --}}


                        </div>
                    @endforeach
                    <div class="col-md-3 mt-5">
                        <input type="text" id="txtuans" name="uans" value="{{ $studAns->uans ?? '' }}"
                            class="form-control" placeholder="Answer" required>

                    </div>

                    {{ $ques->links('vendor.pagination.custom') }}

                </div>
            </div>
        </div>
        <div style="max-height:440px;overflow-y:scroll;" class="col-md-3 ">

            <div class="row">
                <div class="card info-card sales-card">
                    <div class="card-body p-3  text-center">


                        @foreach ($datalist as $item)
                            <a onclick="numClick({{ $ques->first()->exid }},{{ $item->slno }})" style="width: 60px;"
                                class="{{ $item->uans <= '0' ? 'btn btn-light mb-2 rounded-circle shadow-sm' : 'btn btn-success mb-2 rounded-circle shadow-sm' }}">{{ $item->slno }}</a>
                        @endforeach




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
        let sec = sessionStorage.getItem("sec");
        if (sec != null) {
            seconds += parseInt(sec);
        }

        function myTimer() {
            seconds += 1;
            $('#txtime').text(seconds + " Sec");
            sessionStorage.setItem("sec", seconds);

        }
        myInterval = setInterval(myTimer, 1000);
        // seconds = 0;

        async function numClick(exid, qid) {
            var url = window.location.href;
            url = url.substr(0, url.lastIndexOf("?"));
            let slash = url.lastIndexOf('/');
            url += "?page=";
            url += qid;

            location.assign(url)
        }
        // $('.toggle-sidebar-btn').on("click", function() {
        //     alert('ok')
        // });
        // $(document).ready(function() {

        // });
    </script>
@endsection
