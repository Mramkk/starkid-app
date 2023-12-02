@extends('admin.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <style>
        .switch.ios,
        .switch-on.ios,
        .switch-off.ios {
            border-radius: 20rem;
        }

        .switch.ios .switch-handle {
            border-radius: 20rem;
        }
    </style>
    <div class="row">

        <div class="card info-card">

            <div class="card-header">
                Student Details
            </div>


            <div class="card-body">
                <div class="row justify-content-center mt-4">
                    <div class="col-md-2">
                        <img class="img-fluid" src="{{ url('assets/img/stud.jpg') }}" alt="">
                    </div>

                </div>
                <div class="row mt-4">

                    <div class="col-md-3 mb-2"><b>Class</b></div>
                    <div class="col-md-3 mb-2">{{ $user->class }}</div>
                    <div class="col-md-3 mb-2"><b>Name</b></div>
                    <div class="col-md-3 mb-2">{{ $user->name }}</div>
                    <div class="col-md-3 mb-2"><b>Email</b></div>
                    <div class="col-md-3 mb-2">{{ $user->email }}</div>
                    <div class="col-md-3 mb-2"><b>Phone</b></div>
                    <div class="col-md-3 mb-2">{{ $user->phone }}</div>
                    <div class="col-md-3 mb-2"><b>Gender</b></div>
                    <div class="col-md-3 mb-2">{{ $user->gender }}</div>
                    <div class="col-md-3 mb-2"><b>Date of Birth</b></div>
                    <div class="col-md-3 mb-2">{{ date('d/m/Y', strtotime($user->dob)) }}</div>
                    <div class="col-md-3 mb-2"><b>Age</b></div>
                    <div class="col-md-3 mb-2">{{ $user->age }} Years</div>
                    <div class="col-md-3 mb-2"><b>Father </b></div>
                    <div class="col-md-3 mb-2"> {{ $user->father }}</div>
                    <div class="col-md-3 mb-2"><b>Mother </b></div>
                    <div class="col-md-3 mb-2"> {{ $user->mother }}</div>
                    <div class="col-md-3 mb-2"><b>Country </b></div>
                    <div class="col-md-3 mb-2"> {{ $user->country }}</div>
                    <div class="col-md-3 mb-2"><b>State </b></div>
                    <div class="col-md-3 mb-2"> {{ $user->state }}</div>
                    <div class="col-md-3 mb-2"><b>City </b></div>
                    <div class="col-md-3 mb-2"> {{ $user->city }}</div>

                </div>
                <hr>
                <p class="card-title text-center"> Calculations Solved by Student</p>
                <form method="get">

                    <div class="row justify-content-end mb-3">
                        <div class="col-md-3">
                            <input type="date" name="date" class="form-control"
                                onchange="event.preventDefault();
                            this.closest('form').submit();">
                        </div>
                    </div>
                </form>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Slno</th>
                                <th>Date</th>
                                <th>Operation</th>
                                <th>Calculation</th>
                                <th>Student Ans</th>
                                <th>Second</th>
                                <th>Correct Ans</th>


                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cals as $key => $cal)
                                <tr>
                                    @if ($cal->cans == $cal->uans)
                                        <td>
                                            <i class="bi bi-check2 text-success fs-3"></i>
                                        </td>
                                    @else
                                        <td>
                                            <i class="bi bi-x text-danger fs-2"></i>
                                        </td>
                                    @endif

                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ date('d/m/Y', strtotime($cal->created_at)) }}
                                    </td>
                                    <td>
                                        {{ $cal->operation }}
                                    </td>
                                    <td>
                                        <div class="w-25">
                                            {{ $cal->nums }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $cal->uans }}</td>
                                    <td>{{ $cal->second }}</td>
                                    <td>{{ $cal->cans }}</td>


                                </tr>
                            @endforeach





                        </tbody>
                    </table>
                    @if (isset($req->date) == null)
                        {{ $cals->links('vendor.pagination.bootstrap-5') }}
                    @endif


                </div>

            </div>
        </div>







        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
