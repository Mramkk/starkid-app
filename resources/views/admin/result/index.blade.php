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
                Students
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



                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <a href="  {{ url('admin/result') . '/' . $user->id }}">
                                            Select
                                        </a>
                                    </td>
                                    <td>{{ $user->class }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>

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
