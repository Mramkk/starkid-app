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
                <div class="row">
                    <div class="col-md-6 mt-2">Students</div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <label class="form-label">Classes</label>

                            </div>
                            <div class="col-md-10">
                                <select class="form-select" name="class">
                                    <option selected value="LITTLE CHAMPS JR. LEVEL 1">LITTLE CHAMPS JR. LEVEL 1
                                    </option>
                                    <option value="LITTLE CHAMPS JR. LEVEL 2">LITTLE CHAMPS JR. LEVEL 2</option>
                                    <option value="LITTLE CHAMPS JR. LEVEL 3">LITTLE CHAMPS JR. LEVEL 3</option>
                                    <option value="LITTLE CHAMPS JR. LEVEL 4">LITTLE CHAMPS JR. LEVEL 4</option>
                                    <option value="LITTLE CHAMPS SR. LEVEL 1">LITTLE CHAMPS SR. LEVEL 1</option>
                                    <option value="LITTLE CHAMPS SR. LEVEL 2">LITTLE CHAMPS SR. LEVEL 2</option>
                                    <option value="LITTLE CHAMPS SR. LEVEL 3">LITTLE CHAMPS SR. LEVEL 3</option>
                                    <option value="SENIOR CHAMPS  LEVEL 2">SENIOR CHAMPS LEVEL 2</option>
                                    <option value="SENIOR CHAMPS  LEVEL 3">SENIOR CHAMPS LEVEL 3</option>
                                    <option value="SENIOR CHAMPS  LEVEL 4">SENIOR CHAMPS LEVEL 4</option>
                                    <option value="SENIOR CHAMPS  LEVEL 5">SENIOR CHAMPS LEVEL 5</option>
                                    <option value="SENIOR CHAMPS  LEVEL 6">SENIOR CHAMPS LEVEL 6</option>
                                    <option value="SENIOR CHAMPS  LEVEL 7">SENIOR CHAMPS LEVEL 7</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>


                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <a href="  {{ url('admin/student') . '/' . $user->id }}">
                                            Select
                                        </a>
                                    </td>
                                    <td>{{ $user->class }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status == '1')
                                            <input id="{{ $user->id }}" onchange="status(this.id)" type="checkbox"
                                                data-toggle="switchbutton" checked data-size="sm" data-style="ios">
                                        @else
                                            <input id="{{ $user->id }}" onchange="status(this.id)" type="checkbox"
                                                data-toggle="switchbutton" data-size="sm" data-style="ios">
                                        @endif

                                    </td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 mt-2"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <label class="form-label">Update Class</label>

                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="class">
                                        <option selected value="LITTLE CHAMPS JR. LEVEL 1">LITTLE CHAMPS JR. LEVEL 1
                                        </option>
                                        <option value="LITTLE CHAMPS JR. LEVEL 2">LITTLE CHAMPS JR. LEVEL 2</option>
                                        <option value="LITTLE CHAMPS JR. LEVEL 3">LITTLE CHAMPS JR. LEVEL 3</option>
                                        <option value="LITTLE CHAMPS JR. LEVEL 4">LITTLE CHAMPS JR. LEVEL 4</option>
                                        <option value="LITTLE CHAMPS SR. LEVEL 1">LITTLE CHAMPS SR. LEVEL 1</option>
                                        <option value="LITTLE CHAMPS SR. LEVEL 2">LITTLE CHAMPS SR. LEVEL 2</option>
                                        <option value="LITTLE CHAMPS SR. LEVEL 3">LITTLE CHAMPS SR. LEVEL 3</option>
                                        <option value="SENIOR CHAMPS  LEVEL 2">SENIOR CHAMPS LEVEL 2</option>
                                        <option value="SENIOR CHAMPS  LEVEL 3">SENIOR CHAMPS LEVEL 3</option>
                                        <option value="SENIOR CHAMPS  LEVEL 4">SENIOR CHAMPS LEVEL 4</option>
                                        <option value="SENIOR CHAMPS  LEVEL 5">SENIOR CHAMPS LEVEL 5</option>
                                        <option value="SENIOR CHAMPS  LEVEL 6">SENIOR CHAMPS LEVEL 6</option>
                                        <option value="SENIOR CHAMPS  LEVEL 7">SENIOR CHAMPS LEVEL 7</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{--  --}}
        </div>







        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script src="{{ url('assets/js/service.js') }}"></script>
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
