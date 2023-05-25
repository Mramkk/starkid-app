@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center">Flash Card</h5>
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
                                <label class="form-label">Number of Digits</label>
                                <select id="txtdigit" class="form-select" aria-label="Default select example">
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
                            </div><!-- End Card -->




                            <div class="text-center">
                                <button id="btnstart" type="button" style="width: 200px ; height:50px;"
                                    class="btn btn-primary rounded-pill"><b>Start</b></button>
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
        $("#btnstart").click(function() {
            sessionStorage.setItem("digit", $("#txtdigit").val());

            var nums = generateCalc();

            sessionStorage.setItem("nums", nums);
            var url = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
            location.assign(url + "flash");

            function generateRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min)) + min;
            }

            function generateCalc() {
                var nums = null;
                if ($('#txtdigit').val() == '1') {
                    nums = generateRandomNumber(1, 9)

                } else if ($('#txtdigit').val() == '2') {
                    nums = generateRandomNumber(10, 99)

                } else if ($('#txtdigit').val() == '3') {
                    nums = generateRandomNumber(100, 999)

                } else if ($('#txtdigit').val() == '4') {
                    nums = generateRandomNumber(1000, 9999)

                } else if ($('#txtdigit').val() == '5') {
                    nums = generateRandomNumber(10000, 99999)
                } else if ($('#txtdigit').val() == '6') {
                    nums = generateRandomNumber(100000, 999999)

                } else if ($('#txtdigit').val() == '7') {
                    nums = generateRandomNumber(1000000, 9999999)

                } else if ($('#txtdigit').val() == '8') {
                    nums = generateRandomNumber(10000000, 99999999)

                } else if ($('#txtdigit').val() == '9') {
                    nums = generateRandomNumber(100000000, 999999999)

                }
                return nums;


            }

        });
    </script>
@endsection
