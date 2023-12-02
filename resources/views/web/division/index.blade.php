@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Division</h5>
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
                                <label class="form-label">Dividend</label>
                                <select id="txtdividend" onchange="selVailidation()" class="form-select"
                                    aria-label="Default select example">
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
                            <div class="mb-3">
                                <label class="form-label">Diviser</label>
                                <select id="txtdiviser" onchange="selVailidation()" class="form-select"
                                    aria-label="Default select example">
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
                                <span class="text-danger" id="lbldiviser"></span>
                            </div>

                            <div class=" mb-5">
                                <label class="form-label">Time In Seconds</label>
                                <select id="txtsecond" class="form-select" aria-label="Default select example">
                                    <option value="0.5">0.5</option>
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>

                                </select>
                            </div>




                            <div class="text-center">
                                <button id="btnstart" type="button" style="width: 200px ; height:50px;"
                                    class="btn btn-primary rounded-pill shadow-lg"><b>Start</b></button>
                            </div>
                        </div>

                        {{--  --}}



                    </div>
                    <div id="loading" class="row justify-content-center">
                        <div class="text-center">

                            <img width="40" height="40" src="assets/img/loading.gif" alt="">

                        </div>
                    </div>
                    <b class="fs-1 text-center" id="txtcal"></b>
                    <div id="section2" class="container text-center mt-5">
                        <strong>
                            <p class="fs-3" id="strcal"></p>
                        </strong>
                        <form id="frm">
                            @csrf
                            <div class="row justify-content-center">
                                <input type="hidden" name="operation" value="Division">
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
                                    <p class="text-success fs-4">Quotient : <b class="text-secondary fs-4"
                                            id="txtquotient">0</b>
                                    </p>
                                    <p class="text-success fs-4">Remainder : <b class="text-secondary fs-4"
                                            id="txtremainder">0</b>
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
        var myInterval;


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

            $('#dans').hide()
            $('#section2').hide();
            $('#btnnext').hide();
            $('#loading').hide();
            $('#btnstart').click(function() {
                $('#section1').hide();
                $('#frm').hide();
                $('#btnnext').hide();
                $('#dans').hide()
                $('#txtcal').text("");
                $('#txtcal').hide();
                let sec = $('#txtsecond').val();
                numsm[0] = generateCalcDividend();
                numsm[1] = generateCalcDiviser();

                $('#strcal').hide();
                $('#strcal').text(numsm[0] + " / " + numsm[1])


                let len = numsm.length - 2;

                for (var i = 0; i < numsm.length; i++) {
                    doSetTimeout(i, sec, numsm, len);

                }


            })
            $('#btnnext').click(function() {

                $('#section1').hide();
                $('#frm').hide();
                $('#btnnext').hide();
                $('#dans').hide()
                $('#txtcal').text("");
                $('#txtcal').hide();
                let sec = $('#txtsecond').val();
                numsm[0] = generateCalcDividend();
                numsm[1] = generateCalcDiviser(numsm[0] - 1);

                $('#strcal').hide();
                $('#strcal').text(numsm[0] + " / " + numsm[1])

                let len = numsm.length - 2;

                for (var i = 0; i < numsm.length; i++) {
                    doSetTimeout(i, sec, numsm, len);

                }
            })



            $('#frm').submit(function(e) {
                e.preventDefault();
                $("#btnSubmit").html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Answer</b>`
                );
                let num1 = numsm[0];
                let num2 = numsm[1];
                let quotient = num1 / num2;
                let reminder = num1 % num2;


                $('#txtcans').val(reminder)
                $('#txtnums').val(num1 + " / " + num2)
                let req = api.setFormData(api.url() + "/division", this);
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
                        $('#txtremainder').text(reminder)
                        $('#txtquotient').text(Math.floor(quotient))

                    } else {
                        $('#load').hide();
                        $('#btnnext').show();


                    }
                });
            })



        })

        function coundown() {
            var timeleft = 1;
            var downloadTimer = setInterval(function() {
                if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                    $('#ctime').show();
                    $('#ctime').text('');
                    myInterval = setInterval(myTimer, 1000);
                    seconds = 0;
                    $('#strcal').show();
                    $('#section2').show();
                    $('#frm').show();
                    $('button[type="submit"]').show();
                    $('#txtuserans').show()
                    $('#txtuserans').val('')
                    $('#txtcal').html("");

                    $("#txtuserans").focus();

                }
                timeleft -= 1;
            }, 1000);
        }

        function doSetTimeout(i, sec, numsm, len) {
            $('#txtcal').show();
            setTimeout(function() {
                if (i % 2 == 0) {
                    $("#txtcal").css("color", "#6666ff");
                    $('#txtcal').html(numsm[i]);
                } else {
                    $("#txtcal").css("color", "#ff9933");
                    $('#txtcal').html(numsm[i]);
                }


                if (len != i) {
                    coundown();
                }

            }, i * 1000 * sec);

        }

        function selVailidation() {
            var dividend = $('#txtdividend').val();
            var diviser = $('#txtdiviser').val();
            if (dividend < diviser) {
                $('#lbldiviser').text("Diviser greater then Dividend")
                return
            } else {
                $('#lbldiviser').text("")
            }
        }


        function generateRandomNumber(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function generateCalcDividend() {
            let nums = [];
            let dividend = $('#txtdividend').val();
            if (dividend == "1") {
                nums[0] = generateRandomNumber(1, 9)
            } else if (dividend == "2") {
                nums[0] = generateRandomNumber(10, 99)
            } else if (dividend == '3') {
                nums[0] = generateRandomNumber(100, 999)
            } else if (dividend == '4') {
                nums[0] = generateRandomNumber(1000, 9999)
            } else if (dividend == '5') {
                nums[0] = generateRandomNumber(10000, 99999)
            } else if (dividend == '6') {
                nums[0] = generateRandomNumber(100000, 999999)
            } else if (dividend == '7') {
                nums[0] = generateRandomNumber(1000000, 9999999)
            } else if (dividend == '8') {
                nums[0] = generateRandomNumber(10000000, 99999999)
            } else if (dividend == '9') {
                nums[0] = generateRandomNumber(100000000, 999999999)
            }
            return nums[0];


        }

        function generateCalcDiviser() {
            let nums
            let diviser = $('#txtdiviser').val();
            if (diviser == "1") {
                nums = generateRandomNumber(1, 9)
            } else if (diviser == "2") {
                nums = generateRandomNumber(10, 99)
            } else if (diviser == '3') {
                nums = generateRandomNumber(100, 999)
            } else if (diviser == '4') {
                nums = generateRandomNumber(1000, 9999)
            } else if (diviser == '5') {
                nums = generateRandomNumber(10000, 99999)
            } else if (diviser == '6') {
                nums = generateRandomNumber(100000, 999999)
            } else if (diviser == '7') {
                nums = generateRandomNumber(1000000, 9999999)
            } else if (diviser == '8') {
                nums = generateRandomNumber(10000000, 99999999)
            } else if (diviser == '9') {
                nums = generateRandomNumber(100000000, 999999999)
            }
            return nums;
        }
    </script>
@endsection
