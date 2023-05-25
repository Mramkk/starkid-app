@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Flash Card</h5>
@endsection
@section('content')
    <strong>
        <p id="ctime" class="text-end"></p>
    </strong>
    <div class="row mt-5">

        <div class="table-responsive" style="min-height: 250px;">
            <div class="row justify-content-center">
                <script src="{{ url('assets/js/abacus-setup.js') }}"></script>
                <script defer="" src="{{ url('assets/js/abacus.js') }}"></script>
            </div>
        </div>
        <div id="loading" class="row justify-content-center">
            <div class="text-center">

                <img width="40" height="40" src="assets/img/loading.gif" alt="">

            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-md-6">
                <form id="frm">
                    @csrf
                    <input type="hidden" name="operation" value="Flash-Card
                "><input type="hidden"
                        id="txtnums" name="nums">
                    <input type="hidden" id="txtcans" name="cans">
                    <input type="hidden" id="txtime" name="time">

                    <div class="text-center mt-4 ml-3">
                        <input id="txtuserans" type="text" class="form-control h3" name="uans"
                            placeholder="Enter your answer" required style="height:50px;">
                    </div>
                    <div id="section1">



                        <div class="text-center mt-4">
                            <button id="btnAns" type="submit" style="width: 200px ; height:50px;"
                                class="btn btn-primary rounded-pill"><b>Answer</b></button>
                        </div>

                </form>
            </div>





        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div id="section2">



                <div class="text-center mt-4">
                    <p class="text-success fs-2">Correct Answer : <b class="text-secondary fs-2" id="txtans">0</b>
                    </p>
                    <button id="btnNext" type="button" style="width: 200px ; height:50px;"
                        class="btn btn-primary rounded-pill"><b>Next</b></button>
                </div>
            </div>





        </div>
    </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/service.js') }}"></script>
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script>
        var seconds = 0;
        var myInterval

        function myTimerStop(myInterval) {
            clearInterval(myInterval);
            seconds = 0;

        }

        function myTimer() {
            seconds += 1;

            $('#txtime').val(seconds);
            $('#ctime').text(seconds + " Sec");
        }
        $(document).ready(function() {
            let api = new ApiService();
            myInterval = setInterval(myTimer, 1000);
            seconds = 0;

            $("#section2").hide();
            $("#loading").hide();
            $("#txtuserans").focus();
            $('#frm').submit(function(e) {
                e.preventDefault();
                $("#loading").show();
                $("#section1").hide();
                $("#txtime").val(seconds);
                var cans = sessionStorage.getItem("nums");
                $("#txtcans").val(cans);
                $("#txtnums").val("Flash Card");
                $("#txtans").text(cans);
                myTimerStop(myInterval);


                let req = api.setFormData(api.url() + "/flash", this);
                req.then((res) => {
                    myTimerStop(myInterval);
                    $('#ctime').hide();
                    const rs = JSON.parse(res);
                    if (rs.status == true) {
                        $("#loading").hide();
                        $("#section2").show();
                        $("#section1").hide();
                    } else {
                        $("#loading").hide();


                    }
                });

            });
            $("#btnNext").click(function() {
                $("#section2").hide();
                $("#section1").show();
                location.reload();
            });
        })
    </script>
@endsection
