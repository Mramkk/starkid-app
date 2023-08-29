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
                <h3 class="text-center">Create Exam</h3>
                <form id="frm">
                    @csrf



                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Exam Title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type">
                                <option selected value="Exam">Exam</option>
                                <option value="Vedic Math">Vedic Math</option>
                                <option value="Practice Exam">Practice Exam</option>
                                <option value="GK">GK</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Question Type</label>
                            <select class="form-select" name="question_type">
                                <option selected value="General">General</option>
                                <option value="Multi Choice"> Multi Choice</option>

                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Class</label>
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
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Marks Per Question</label>
                            <input type="text" name="marks_per_question" class="form-control"
                                placeholder="Marks / Question" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Pass Marks</label>
                            <input type="text" name="pass_marks" class="form-control" placeholder="Pass Marks" required>
                        </div>

                        {{--  --}}
                    </div>

                    <div class="text-center mt-3">


                        <button id="btnSubmit" type="submit" class="btn btn-primary w-25"><b>Submit</b></button>
                    </div>

                </form>
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
        getClasses(api.url())
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
                    location.href = api.url() + "/admin/exam"
                } else {
                    alert(rs.message);
                    location.reload();
                }
            });
        });

        function getClasses(url) {


            $.ajax({
                url: url + "/admin/class",
                type: "GET",
                success: function(res) {
                    const rs = JSON.parse(res);
                    if (rs.status == true) {
                        let options = rs.data.map(o => `<option value="${o.class}">${o.class}</option>`);
                        $('#txtclass').append(options);
                    }

                }
            })
        }
    </script>
@endsection
