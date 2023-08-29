@extends('admin.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('page-title')
    <h5 id="page-title" class="card-title text-center"></h5>
@endsection
@section('content')
    <div class="row">

        <!-- Left side columns -->
        <!--  Card -->
        <div class="card info-card sales-card p-5">
            <div class="card-body">
                <h3 class="text-center">Exam Details</h3>
                <hr>
                <div class="row mt-3">

                    <div class="col-md-3 mb-3 fw-bold">Exam Title</div>
                    <div class="col-md-3 mb-3">{{ $exam->title }}</div>
                    <div class="col-md-3 mb-3 fw-bold">Class</div>
                    <div class="col-md-3 mb-3">{{ $exam->class }}</div>
                    <div class="col-md-3 mb-3 fw-bold">Type</div>
                    <div class="col-md-3 mb-3">{{ $exam->type }}</div>
                    <div class="col-md-3 mb-3 fw-bold">Question Type</div>
                    <div class="col-md-3 mb-3">{{ $exam->question_type }}</div>

                    <div class="col-md-3 mb-3 fw-bold">Marks Per Question</div>
                    <div class="col-md-3 mb-3">{{ $exam->marks_per_question }}</div>
                    <div class="col-md-3 mb-3 fw-bold">Pass Marks</div>
                    <div class="col-md-3 mb-3">{{ $exam->pass_marks }}</div>

                </div>
                <div class="row mt-2 px-3">

                    {{ $exam->long_description }}
                </div>
                <hr>
                <h3 class="text-center mt-3">Questions</h3>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>Answer</th>
                                <th>Question</th>
                                <th>Actions</th>



                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($ques as $item)
                                <tr>
                                    <td>
                                        {{ $item->slno }}
                                    </td>
                                    <td>
                                        {!! $item->question !!}
                                    </td>
                                    <td>
                                        {{ $item->answer }}
                                    </td>



                                    <td><a class="btn btn-info text-light shadow-lg"
                                            href="{{ url('admin/question/') . '/' . $exam->id . '/' . $item->id }}">Edit</a>


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

        $('#frm').submit(function(e) {
            e.preventDefault();
            $("#btnSubmit").html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Answer</b>`
            );
            let req = api.setFormData(api.url() + "/admin/exam/create", this);
            $("#btnSubmit").attr("disabled", true);
            req.then((res) => {

                const rs = JSON.parse(res);
                if (rs.status == true) {
                    alert(rs.message);
                    location.reload();
                } else {
                    alert(rs.message);
                    location.reload();
                }
            });
        });
    </script>
@endsection
