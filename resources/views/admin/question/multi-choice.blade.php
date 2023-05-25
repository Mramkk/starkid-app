@extends('admin.layouts.master')
@section('title')
    <title>Star Kid Academy</title>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('public/vendor/laraberg/css/laraberg.css') }}">
    <script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
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
                <h3 class="text-center">Add Multi-Choice Questions </h3>
                <form action="{{ route('admin.mcq.save') }}" method="POST">
                    @csrf

                    @if (Session::has('success'))
                        <div class="row justify-content-end">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span> {!! Session::get('success') !!}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        {{ Session::forget('success') }}
                    @endif
                    @if (Session::has('error'))
                        <div class="row justify-content-end">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span> {!! Session::get('error') !!}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        {{ Session::forget('error') }}
                    @endif

                    <input type="text" name="exid" value="{{ $exam->id }}" hidden>


                    <div class="row mb-3">
                        <label class="mb-2">Question</label>
                        <textarea id="question" name="question"></textarea>
                        @error('question')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="mb-2 me-3">Choice (1)</label>
                            <input class="form-check-input" type="radio" name="answer">
                            <input type="text" class="form-control" name="choice_1">
                            @error('choice_1')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="mb-2 me-3">Choice (2)</label>
                            <input class="form-check-input" type="radio" name="answer">
                            <input type="text" class="form-control" name="choice_2">
                            @error('choice_2')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="mb-2 me-3">Choice (3)</label>
                            <input class="form-check-input" type="radio" name="answer">
                            <input type="text" class="form-control" name="choice_3">
                            @error('choice_3')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="mb-2 me-3">Choice (4)</label>
                            <input class="form-check-input" type="radio" name="answer">
                            <input type="text" class="form-control" name="choice_4">
                            @error('choice_4')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
                        </div>
                        @error('answer')
                            <span class="text-danger text-center mt-3">* {{ $message }}</span>
                        @enderror
                    </div>



                    <div class="row mb-3">
                        <label class="mb-2">Notes</label>
                        <textarea class="form-control" name="notes" rows="5"></textarea>
                        @error('notes')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center mt-5">
                        {{--
                        <button id="btnGenerate" type="button" class="btn btn-primary w-25"><b>Generate</b></button> --}}
                        <button type="submit" class="btn btn-primary w-25"><b>Submit</b></button>
                    </div>

                    <div id="digits" class="row mt-5">

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
    <script src="{{ url('public/vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        $(document).ready(function() {
            Laraberg.init('question')
            $('.alert').alert();
            setTimeout(() => {
                $('.alert').alert('close')
            }, 3000)

            $('input:radio[name="answer"]').change(function() {

                let val = $(this).parent().find("input[type=text]").val()
                $(this).val(val)
                // alert(val);
            });
        })
    </script>
    <script>
        let api = new ApiService();
        let input = "";
        $("#btnGenerate").click(function() {
            let input = "";
            for (let index = 0; index < $('#rows').val(); index++) {
                input += `
              <div class="col-md-3 mb-3">
                <input id="rows" type="text" name="num[]" class="form-control"
                                placeholder="Num" required>
                </div>

              `;

            }
            input += `<div class="mb-3 mt-5">
                            <label class="form-label">Answer</label>
                            <input id="rows" type="text" name="answer" class="form-control"
                                placeholder="Answer" required>
                        </div>

                        <div class="text-center mt-3">
                        <button id="btnSubmit" type="submit" class="btn btn-primary w-25"><b>Submit</b></button>
                        </div>


                        `
            $('#digits').html(input);

        });

        // getClasses(api.url())
        $('#frm').submit(function(e) {
            e.preventDefault();
            $("#btnSubmit").html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Answer</b>`
            );
            let req = api.setFormData(api.url() + "/admin/question/create", this);
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
