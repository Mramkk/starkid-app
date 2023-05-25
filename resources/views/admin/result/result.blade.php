@extends('admin.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <div class="row">

        <div class="card info-card">

            <div class="card-header">
                Sudent Details
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




            </div>
        </div>



        <div class="card info-card">

            <div class="card-header">
                Exam Details
            </div>


            <div class="card-body">

                <div class="row mt-3">
                    <div class="col-md-3 mb-2"><b>Class</b></div>
                    <div class="col-md-3 mb-2">{{ $exam->class }}</div>
                    <div class="col-md-3 mb-2"><b>Title</b></div>
                    <div class="col-md-3 mb-2">{{ $exam->title }}</div>



                </div>




            </div>
        </div>

        <div class="card info-card">

            <div class="card-header">
                Result
            </div>


            <div class="card-body">

                @if ($result == null)
                    <p class="text-danger text-center mt-3">Exam not attended</p>
                @else
                    <div class="row mt-3">
                        <div class="col-md-3 mb-2"><b>Date</b></div>
                        <div class="col-md-3 mb-2">{{ date('d/m/Y', strtotime($result->created_at)) }}</div>
                        <div class="col-md-3 mb-2"><b>Obtained Marks</b></div>
                        <div class="col-md-3 mb-2">{{ $result->marks_obtained }}</div>
                        <div class="col-md-3 mb-2"><b>DPM</b></div>
                        <div class="col-md-3 mb-2">{{ $result->dpm }}</div>



                    </div>
                @endif




            </div>
        </div>







        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script src="{{ url('js/service.js') }}"></script>
    <script>
        let api = new ApiService();

        function status(id) {
            var data = {
                "_token": "{{ csrf_token() }}",
                "id": id
            };
            let req = api.setData("student/status", data);
            req.then((res) => {


                if (res.status == true) {

                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                    location.reload();
                }
            });
        }
    </script>
@endsection
