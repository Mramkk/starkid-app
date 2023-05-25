@extends('web.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <style>
        a:hover img {
            animation: shake 0.5s;
            animation-iteration-count: infinite;

        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }
    </style>
    <div class="row">
        <!-- Left side columns -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('addition') }}">

                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/add.png" alt="">
                        </div>
                        <h5 class="card-title">Addition</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->

        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('add-sub') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/sub.png" alt="">
                        </div>
                        <h5 class="card-title">Add/Sub</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->


        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('multiply') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/multiply.png" alt="">
                        </div>
                        <h5 class="card-title">Multiplication</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('deciaml-addition') }}">

                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/add.png" alt="">
                        </div>
                        <h5 class="card-title">Decimal Addition</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('decimal-add-sub') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/sub.png" alt="">
                        </div>
                        <h5 class="card-title"> Decimal Add/Sub</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->


        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('decimal-multiply') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/multiply.png" alt="">
                        </div>
                        <h5 class="card-title">Decimal Multiplication</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('division') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/div.png" alt="">
                        </div>
                        <h5 class="card-title">Division</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('flash-setup') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">

                            <img width="70" height="70" src="assets/img/icons/abacus.png" alt="">
                        </div>
                        <h5 class="card-title ">Flash Card</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('rnd-num') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Random Numbers</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('square-practice') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Square Practice</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!--  Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('square') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Square Root</h5>
                    </div>
                </div>
            </a>
        </div>
        <!-- End Card -->
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('cube-practice') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Cube Practice</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('cube') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Cube Root</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('percentage') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Percentage</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <div class="col-xxl-4 col-md-4">
            <a href="{{ route('times-table') }}">
                <div class="card info-card sales-card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <img width="70" height="70" src="assets/img/icons/rand.png" alt="">
                        </div>
                        <h5 class="card-title">Times Table</h5>
                    </div>
                </div>
            </a>
        </div><!-- End Card -->
        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
@endsection
