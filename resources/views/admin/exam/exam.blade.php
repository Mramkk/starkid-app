@extends('admin.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <div class="row justify-content-between mb-3">
        <div class="col">
            <h3 class="text-center">Class Wise Exam List</h3>
        </div>
        <div class="col text-end">
            <a href="{{ route('createExamIndex') }}" class="btn btn-primary fw-bold">Add Exam</a>
        </div>
    </div>
    <hr>
    <div class="row">

        <!-- Left side columns -->
        <!--  Card -->
        @if (is_null($exams->first()))
            <div class="row justify-content-center">

                <div class="col-md-3">
                    <p class="text-center">Exam Not Found</p>

                    {{-- <a href="{{ route('createExamIndex') }}" class="btn btn-primary fw-bold w-100">Add Exam</a> --}}
                </div>
            </div>
        @else
            @foreach ($exams as $item)
                <div class="col-xxl-4 col-md-4 ">


                    <div class="card info-card sales-card text-center">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mt-3">

                                <i class="bi bi-newspaper fs-1 text-dark"></i>

                            </div>
                            <p class="text-primary fw-bold">{{ $item->title }}</p>
                            <p class="fw-bold">({{ $item->question_type }})</p>
                            <p class="fw-bold">({{ $item->class }})</p>
                            <div class="d-flex justify-content-center mt-1">
                                <a href="{{ url('admin/exam/view') . '/' . $item->id }}" class="btn btn-link">View</a>
                                {{-- <a href="{{ url('admin/exam/edit') . '/' . $item->id }}"
                                    class="btn btn-link text-success">Edit</a> --}}
                                <a href="{{ url('admin/exam') . '/' . $item->id . '/' . 'question' }}"
                                    class="btn btn-link text-dark">Add
                                    Questions</a>
                                <a id="{{ $item->id }}" onclick="deleteEx({{ $item->id }})" href="#"
                                    class="btn btn-link text-danger">Delete</a>
                            </div>
                        </div>
                    </div>

                </div><!-- End Card -->
                {{-- testing --}}
            @endforeach
        @endif









        <!-- Right side columns -->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/speech.js') }}"></script>
    <script src="{{ url('assets/js/index.js') }}"></script>
    <script src="{{ url('assets/js/service.js') }}"></script>
    <script>
        let api = new ApiService();

        function deleteEx(id) {
            $('#' + id).addClass("");
            $('#' + id).text("");
            $('#' + id).addClass("spinner-border text-primary");
            var data = {
                "_token": "{{ csrf_token() }}",
                "id": id,
            };
            let req = api.setData(api.url() + "/admin/exam/delete", data);
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
