@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Cube Root</h5>
@endsection
@section('content')
    <div class="row" style="min-height: 1000px;">
        <div class="card info-card sales-card ">
            <div class="card-body">

                <div class="row justify-content-center  mt-5">
                    <strong>
                        <p id="ctime" class="text-end"></p>
                    </strong>
                    <div class="col-md-6">
                        <div id="section1">

                            <div class="mb-3">
                                <label class="form-label">Numbers of Digits</label>
                                <select id="txtdigits" class="form-select" aria-label="Default select example">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>

                                </select>
                            </div>





                            <div class="text-center">
                                <button id="btnstart" type="button" style="width: 200px ; height:50px;"
                                    class="btn btn-primary rounded-pill shadow-lg"><b>Start</b></button>
                            </div>
                        </div>

                        {{--  --}}



                    </div>
                    <b class="fs-1 text-center" id="txtcal"></b>
                    <div id="loading" class="row justify-content-center">
                        <div class="text-center">

                            <img width="40" height="40" src="assets/img/loading.gif" alt="">

                        </div>
                    </div>
                    <div id="section2" class="container text-center mt-5">

                        <form id="frm">
                            @csrf
                            <div class="row justify-content-center">
                                <input type="hidden" name="operation" value="Cube Root">
                                <input type="hidden" id="txtnums" name="nums">
                                <input type="hidden" id="txtcans" name="cans">
                                <input type="hidden" id="txtime" name="time">
                                <div class="col-md-4">
                                    <input id="txtuserans" type="text" class="form-control h3" name="uans"
                                        placeholder="Enter your answer" required style="height:50px;">
                                </div>

                            </div>
                            <div class="row justify-content-center">
                                <div id="dans" class="row justify-content-center">
                                    <p class="text-success fs-2">Correct Answer : <b class="text-secondary fs-2"
                                            id="txtans">0</b>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <button id="btnSubmit" type="submit" style="width: 100% ; height:50px;"
                                        class="btn btn-primary   rounded-pill shadow-lg mt-3"><b>Answer</b></button>
                                </div>
                            </div>

                        </form>


                        <div class="row justify-content-center mt-3">
                            <div class="col-md-4">
                                <button id="btnnext" type="button" style="width: 100% ; height:50px;"
                                    class="btn btn-primary  rounded-pill shadow-lg"><b>Next</b></button>
                            </div>
                        </div>




                    </div>

                    <!-- Right side columns -->

                </div>

            </div>

        </div>

        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/service.js') }}"></script>
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script>
        let numsm = [];
        var seconds = 0;
        var myInterval
        let sec = 2;

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
            var sp = spInit();
            let ans = 0;
            $('#loading').hide()
            $('#dans').hide()
            $('#section2').hide();
            $('#btnnext').hide();

            $('#btnstart').click(function() {
                $('#section1').hide();

                $('#section2').show();
                $('#frm').show();
                $('#txtcal').text(generateNum())
                coundown();



            })
            $('#btnnext').click(function() {

                $('#section1').hide();
                $('#txtcal').text(generateNum())
                $('#section2').show();
                $('#frm').show();
                $('#btnnext').hide();
                $('#dans').hide()
                coundown();
                $('#txtuserans').val("")
                $("#btnSubmit").show();
                $("#btnSubmit").attr("disabled", false);

            })




            $('#frm').submit(function(e) {
                e.preventDefault();
                $("#btnSubmit").html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Answer</b>`
                );
                let sumCal = 0;

                sumCal = $('#txtcal').text();
                sumCal = Math.cbrt(sumCal).toFixed(1);
                $('#txtcans').val(sumCal)
                $('#txtnums').val($('#txtcal').text())
                let req = api.setFormData(api.url() + "/cube", this);
                $("#btnSubmit").attr("disabled", true);
                req.then((res) => {
                    myTimerStop(myInterval);
                    seconds = 0;
                    $('#ctime').hide();
                    $("#btnSubmit").html(` <b>Answer</b>`);
                    $("#btnSubmit").attr("disabled", false);
                    const rs = JSON.parse(res);
                    if (rs.status == true) {
                        $('button[type="submit"]').hide();
                        $('#btnnext').show();
                        // $('#txtuserans').hide()
                        $('#dans').show()
                        $('#txtans').text(sumCal)


                    } else {

                        $('#btnnext').show();

                    }
                });
            })



        })

        function coundown() {
            myInterval = setInterval(myTimer, 1000);
            seconds = 0;
            $("#txtuserans").focus();
        }

        function doSetTimeout(i, sec, numsm, len) {
            $('#txtcal').show();
            setTimeout(function() {
                if (i % 2 == 0) {
                    $("#txtcal").css("color", "#002233");
                    $('#txtcal').html(numsm[i]);
                } else {
                    $("#txtcal").css("color", "#006699");
                    $('#txtcal').html(numsm[i]);
                }


                if (len == i) {
                    coundown();
                }

            }, i * 1000 * sec);

        }


        function generateRandomNumber(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }



        function generateNum() {

            let digits = $('#txtdigits').val();
            if (digits == "1") {
                return generateRandomNumber(1, 9)
            } else if (digits == "2") {
                return generateRandomNumber(10, 99)
            } else if (digits == '3') {
                return generateRandomNumber(100, 999)
            } else if (digits == '4') {
                return generateRandomNumber(1000, 9999)
            } else if (digits == '5') {
                return generateRandomNumber(10000, 99999)
            } else if (digits == '6') {
                return generateRandomNumber(100000, 999999)
            } else if (digits == '7') {
                return generateRandomNumber(1000000, 9999999)
            } else if (digits == '8') {
                return generateRandomNumber(10000000, 99999999)
            } else if (digits == '9') {
                return generateRandomNumber(100000000, 999999999)
            }



        }
    </script>
@endsection
