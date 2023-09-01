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
                <div class="d-flex justify-content-between">
                    <div class="row">
                        PDF
                    </div>
                    <div class="row">
                        <a href="{{ route('admin.pdf.create') }}" class="btn btn-success">Add</a>
                    </div>

                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>Title</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Actions</th>



                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->class }}</td>
                                    <td>
                                        @if ($item->status == '1')
                                            <input id="{{ $item->id }}" onchange="status(this.id)" type="checkbox"
                                                data-toggle="switchbutton" checked data-size="sm" data-style="ios">
                                        @else
                                            <input id="{{ $item->id }}" onchange="status(this.id)" type="checkbox"
                                                data-toggle="switchbutton" data-size="sm" data-style="ios">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/pdf/edit') . '/' . $item->id }}"
                                            class="btn btn-outline-primary">Edit</a>
                                        <a href="{{ route('admin.pdf.delete') }}" class="btn btn-outline-danger">Delete</a>
                                    </td>

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
    <script src="{{ url('assets/js/service.js') }}"></script>
    <script>
        let api = new ApiService();

        function status(id) {
            var data = {
                "_token": "{{ csrf_token() }}",
                "id": id
            };
            let req = api.setData("{{ route('admin.pdf.status') }}", data);
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
