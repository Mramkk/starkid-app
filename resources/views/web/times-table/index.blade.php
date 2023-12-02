@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Times Table</h5>
@endsection
@section('content')
    <div class="row" style="min-height: 1000px;">
        <div class="card info-card sales-card ">
            <div class="card-body">

                <div class="row justify-content-center  mt-5">

                    <div class="col-md-6">
                        <div id="section1">


                            <div class=" mb-3">
                                <label class="form-label">Number Of Digit</label>
                                <input id="txtdigit" type="text" class="form-control" required>
                            </div>
                            <div class=" mb-3">
                                <label class="form-label">No. of Sum</label>
                                <input id="txtsum" type="text" class="form-control" required>
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
                                    class="btn btn-primary rounded-pill"><b>Start</b></button>
                            </div>
                        </div>

                        {{--  --}}



                    </div>
                    <b class="fs-1 text-center" id="txtcal"></b>
                    {{-- <div id="section2" class="container text-center mt-5">
                        <div id="dans" class="row justify-content-center">
                            <p class="text-success fs-2">Correct Answer : <b class="text-secondary fs-2"
                                    id="txtans">0</b>
                            </p>
                        </div>
                        <form id="frm">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <input id="txtuserans" type="text" class="form-control h3" name="answer"
                                        placeholder="Enter your answer" required style="height:50px;">
                                </div>

                            </div>
                            <div class="row justify-content-center">

                                <div class="col-md-4">
                                    <button type="submit" style="width: 100% ; height:50px;"
                                        class="btn btn-primary   rounded-pill mt-3"><b>Answer</b></button>
                                </div>
                            </div>

                        </form>


                        <div class="row justify-content-center mt-3">
                            <div class="col-md-4">
                                <button id="btnnext" type="button" style="width: 100% ; height:50px;"
                                    class="btn btn-primary  rounded-pill"><b>Next</b></button>
                            </div>
                        </div>




                    </div> --}}

                    <!-- Right side columns -->

                </div>

            </div>

        </div>

        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script>
        let nums = [];
        $(document).ready(function() {
            var sp = spInit();
            let ans = 0;


            $('#btnstart').click(function() {
                $('#section1').hide();
                let sum = $('#txtsum').val();
                let sec = $('#txtsecond').val();
                nums = generateRandNum();

                let len = nums.length - 2;
                for (var i = 0; i < sum; i++) {
                    doSetTimeout(i, sec, nums, len);

                }


            })








        })



        function coundown() {
            var timeleft = 1;
            var downloadTimer = setInterval(function() {
                if (timeleft <= 0) {
                    location.reload();
                }
                timeleft -= 1;
            }, 2000);
        }

        function doSetTimeout(i, sec, nums, len) {
            $('#txtcal').show();
            setTimeout(function() {
                if (i % 2 == 0) {
                    $("#txtcal").css("color", "#6666ff");
                    $('#txtcal').html(nums[i]);

                } else {
                    $("#txtcal").css("color", "#ff9933");
                    $('#txtcal').html(nums[i]);

                }


                if (len == i) {
                    coundown();
                }

            }, i * 1000 * sec);

        }


        // function generateRandomNumber(min, max) {
        //     return Math.floor(Math.random() * (max - min)) + min;
        // }

        function generateRandNum() {
            let nums = [];
            let digit = $('#txtdigit').val();
            let sum = $('#txtsum').val();
            let j = 0;
            for (let i = 1; i <= sum; i++) {
                nums[j] = digit * i;
                j++;
            }

            return nums;

        }
    </script>
@endsection
