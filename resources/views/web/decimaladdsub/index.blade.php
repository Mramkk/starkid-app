@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Decimal Add/Sub
    </h5>
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
                                <label class="form-label">Number Of Digit</label>
                                <select id="txtdigit" class="form-select" aria-label="Default select example">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="1-2">1-2</option>
                                    <option value="3">3</option>
                                    <option value="1-3">1-3</option>
                                    <option value="2-3">2-3</option>
                                    <option value="4">4</option>
                                    <option value="1-4">1-4</option>
                                    <option value="5">5</option>
                                    <option value="1-5">1-5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>

                                </select>
                            </div><!-- End Card -->

                            <div class=" mb-3">
                                <label class="form-label">No. of Sum</label>
                                <input id="txtsum" type="text" class="form-control">
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
                    <div id="loading" class="row justify-content-center">
                        <div class="text-center">

                            <img width="40" height="40" src="assets/img/loading.gif" alt="">

                        </div>
                    </div>
                    <div id="section2" class="container text-center mt-5">

                        <form id="frm">
                            @csrf
                            <div class="row justify-content-center">
                                <input type="hidden" name="operation" value="Decimal Add/Sub">
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
        let nums = [];
        var seconds = 0;

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
                nums = [];
                var nums = generateCalc();
                let sec = $('#txtsecond').val();
                let sum = $('#txtsum').val();
                let len = nums.length - 1;
                for (var i = 0; i < sum; i++) {
                    doSetTimeout(i, sec, nums, len);
                }


            })
            $('#btnnext').click(function() {

                $('#section1').hide();
                $('#frm').hide();
                $('#btnnext').hide();
                $('#dans').hide()
                $('#txtcal').text("");
                $('#txtcal').hide();
                var nums = generateCalc();
                let sec = $('#txtsecond').val();
                let sum = $('#txtsum').val();
                let len = nums.length - 2;
                for (var i = 0; i < sum; i++) {
                    doSetTimeout(i, sec, nums, len);

                }
            })



            $('#frm').submit(function(e) {
                e.preventDefault();
                let calcStr = "";
                calcStr = nums.toString().replaceAll(',', '+')
                calcStr = calcStr.toString().replaceAll('+-', '-')
                $("#btnSubmit").html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Answer</b>`
                );
                $('#txtnums').val(calcStr)
                let sumCal = 0.0;
                nums.forEach(element => {

                    sumCal += parseFloat(element);

                });
                // $('#txtcans').val(parseFloat(sumCal.toFixed(2)))
                $('#txtcans').val(sumCal.toFixed(2))
                let req = api.setFormData(api.url() + "/subtraction", this);
                $("#btnSubmit").attr("disabled", true);
                req.then((res) => {
                    myTimerStop(myInterval);
                    $('#ctime').hide();
                    $("#btnSubmit").html(` <b>Answer</b>`);
                    $("#btnSubmit").attr("disabled", false);
                    const rs = JSON.parse(res);
                    if (rs.status == true) {

                        $('button[type="submit"]').hide();
                        $('#btnnext').show();
                        // $('#txtuserans').hide()
                        $('#dans').show()

                        $('#txtans').text(sumCal.toFixed(2))
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

        function doSetTimeout(i, sec, nums, len) {
            $('#txtcal').show();
            setTimeout(function() {
                if (i % 2 == 0) {
                    $("#txtcal").css("color", "#002233");
                    $('#txtcal').html(nums[i]);
                } else {
                    $("#txtcal").css("color", "#006699");
                    $('#txtcal').html(nums[i]);
                }


                if (len == i) {
                    coundown();
                }

            }, i * 1000 * sec);

        }

        function decimalVal(min, max) {

            return (Math.floor(Math.random() * (max - min)) + min);
        }

        function generateRandomNumber(min, max) {

            return parseFloat((Math.floor(Math.random() * (max - min)) + min).toString() + '.' + decimalVal(1, 99)
                    .toString())
                .toFixed(2);
        }



        function primeNumber(n) {

            if (n === 1) {
                return false;
            } else if (n === 2) {
                return true;
            } else {
                for (var x = 2; x < n; x++) {
                    if (n % x === 0) {
                        return false;
                    }
                }
                return true;
            }
        }



        function generateCalc() {

            let sum = $('#txtsum').val();
            let digit = $('#txtdigit').val();


            if (digit == "1") {
                nums = [];
                for (let i = 0; i < sum; i++) {
                    if (primeNumber(i)) {
                        nums[i] = generateRandomNumber(1, 9)
                    } else {
                        let last = nums[nums.length - 1];
                        let start = last - 1
                        nums[i] = generateRandomNumber(-1, -start)
                    }
                }


            } else if (digit == "2") {
                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(10, 99)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -10)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(10, 99);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 50) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }


            } else if ($('#txtdigit').val() == '1-2') {
                nums = [];
                if (sum <= 9) {
                    for (let i = 0; i < sum; i++) {

                        if (i == 0) {
                            nums[i] = generateRandomNumber(10, 99)

                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 2) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1, 9)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-9, -1)
                                }


                            } else {
                                nums[i] = generateRandomNumber(10, 99)
                            }
                        }

                    }
                } else {
                    for (let i = 0; i < sum; i++) {
                        if (i % 2 == 0) {
                            nums[i] = generateRandomNumber(10, 99);
                        } else {
                            nums[i] = generateRandomNumber(1, 9);
                        }

                    }

                    for (let i = 2; i < nums.length; i++) {

                        if (nums[i].toString().length == 1) {
                            if (nums[i] % 2 == 0) {

                            } else {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }

                        }

                    }
                }


            } else if ($('#txtdigit').val() == '3') {
                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(100, 999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -100)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(100, 999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 500) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }


            } else if ($('#txtdigit').val() == '1-3') {


                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(700, 999)
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 6) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(10, 99)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -10)
                                }


                            } else if (last.toString().length == 5) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1, 9)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -1)
                                }

                            } else {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(100, 999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -100)
                                }


                            }
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(100, 999);
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 6) {
                                nums[i] = generateRandomNumber(10, 99);
                            } else if (last.toString().length == 5) {
                                nums[i] = generateRandomNumber(1, 9);
                            } else {
                                nums[i] = generateRandomNumber(100, 999);
                            }
                        }

                    }
                    for (let i = 3; i < nums.length; i++) {

                        if (nums[i].toString().length == 5) {
                            if (nums[i] <= 50) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        } else if (nums[i].toString().length == 4) {
                            if (nums[i] >= 5) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        }

                    }
                }
                var firstVal = nums.shift();
                nums.sort(() => Math.random() - 0.5);
                nums.unshift(firstVal);

            } else if ($('#txtdigit').val() == '2-3') {

                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(100, 999)
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 6) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(10, 99)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -10)
                                }


                            } else {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(100, 999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -100)
                                }


                            }
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(100, 999);
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 6) {
                                nums[i] = generateRandomNumber(10, 99);
                            } else {
                                nums[i] = generateRandomNumber(100, 999);
                            }
                        }

                    }
                    for (let i = 3; i < nums.length; i++) {

                        if (nums[i] <= 50) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }
                var firstVal = nums.shift();
                nums.sort(() => Math.random() - 0.5);
                nums.unshift(firstVal);
            } else if ($('#txtdigit').val() == '4') {
                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(1000, 9999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -1000)
                        }
                    }

                } else {
                    let midCal = 0;
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(1000, 9999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 5000) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }



            } else if ($('#txtdigit').val() == '1-4') {
                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(7000, 9999)
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 7) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(100, 999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -100)
                                }


                            } else if (last.toString().length == 6) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(10, 99)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -10)
                                }

                            } else if (last.toString().length == 5) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1, 9)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -1)
                                }

                            } else {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1000, 9999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -1000)
                                }


                            }
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(1000, 9999);
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 7) {
                                nums[i] = generateRandomNumber(100, 999);
                            } else if (last.toString().length == 6) {
                                nums[i] = generateRandomNumber(10, 99);
                            } else if (last.toString().length == 5) {
                                nums[i] = generateRandomNumber(1, 9);
                            } else {
                                nums[i] = generateRandomNumber(1000, 9999);
                            }
                        }

                    }
                    for (let i = 3; i < nums.length; i++) {

                        if (nums[i].toString().length == 6) {
                            if (nums[i] <= 500) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        } else if (nums[i].toString().length == 5) {
                            if (nums[i] >= 50) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        } else if (nums[i].toString().length == 4) {
                            if (nums[i] >= 5) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        }

                    }
                }
                var firstVal = nums.shift();
                nums.sort(() => Math.random() - 0.5);
                nums.unshift(firstVal);
            } else if ($('#txtdigit').val() == '5') {
                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(10000, 99999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -10000)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(10000, 99999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 50000) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }


            } else if ($('#txtdigit').val() == '1-5') {
                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(70000, 99999)
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 8) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1000, 9999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -1000)
                                }


                            } else if (last.toString().length == 7) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(100, 999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -100)
                                }


                            } else if (last.toString().length == 6) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(10, 99)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -10)
                                }

                            } else if (last.toString().length == 5) {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1, 9)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -1)
                                }

                            } else {
                                if (primeNumber(i)) {
                                    nums[i] = generateRandomNumber(1000, 9999)
                                } else {
                                    let last = nums[nums.length - 1];
                                    let start = last - 1
                                    nums[i] = generateRandomNumber(-start, -1000)
                                }


                            }
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        if (i == 0) {
                            nums[i] = generateRandomNumber(10000, 99999);
                        } else {
                            let last = nums[nums.length - 1];
                            if (last.toString().length == 8) {
                                nums[i] = generateRandomNumber(1000, 9999);
                            } else if (last.toString().length == 7) {
                                nums[i] = generateRandomNumber(100, 999);
                            } else if (last.toString().length == 6) {
                                nums[i] = generateRandomNumber(10, 99);
                            } else if (last.toString().length == 5) {
                                nums[i] = generateRandomNumber(1, 9);
                            } else {
                                nums[i] = generateRandomNumber(10000, 99999);
                            }
                        }

                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i].toString().length == 7) {
                            if (nums[i] <= 5000) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        } else if (nums[i].toString().length == 6) {
                            if (nums[i] >= 500) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        } else if (nums[i].toString().length == 5) {
                            if (nums[i] >= 50) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        } else if (nums[i].toString().length == 4) {
                            if (nums[i] >= 5) {
                                var x = nums[i];
                                x = -x;
                                nums[i] = x;
                            }
                        }

                    }
                }
                var firstVal = nums.shift();
                nums.sort(() => Math.random() - 0.5);
                nums.unshift(firstVal);
            } else if ($('#txtdigit').val() == '6') {

                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(100000, 999999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -100000)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(100000, 999999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 500000) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }
            } else if ($('#txtdigit').val() == '7') {

                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(1000000, 9999999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -1000000)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(1000000, 9999999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 5000000) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }
            } else if ($('#txtdigit').val() == '8') {

                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(10000000, 99999999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -10000000)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(10000000, 99999999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 50000000) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }
            } else if ($('#txtdigit').val() == '9') {

                nums = [];
                if (sum <= 8) {
                    for (let i = 0; i < sum; i++) {
                        if (primeNumber(i)) {
                            nums[i] = generateRandomNumber(100000000, 999999999)
                        } else {
                            let last = nums[nums.length - 1];
                            let start = last - 1
                            nums[i] = generateRandomNumber(-start, -100000000)
                        }
                    }

                } else {
                    for (let i = 0; i < sum; i++) {
                        nums[i] = generateRandomNumber(100000000, 999999999);
                    }
                    for (let i = 3; i < nums.length; i++) {
                        if (nums[i] <= 500000000) {
                            var x = nums[i];
                            x = -x;
                            nums[i] = x;
                        }
                    }
                }
            }
            return nums;


        }
    </script>
@endsection
