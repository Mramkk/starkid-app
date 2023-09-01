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
                <h3 class="text-center">Upload PDF</h3>
                <form id="frm" action="{{ route('admin.pdf.save') }}" method="POST" enctype="multipart/form-data">
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


                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <textarea name="title" class="form-control" rows="2"></textarea>
                            @error('title')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
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
                            @error('class')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">PDF file</label>
                            <input class="form-control" name="file" type="file">
                            @error('file')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror
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
        $(document).ready(function() {
            $('.alert').alert();
            setTimeout(() => {
                $('.alert').alert('close')
            }, 3000)

            getClasses(api.url())
            $('#frm').submit(function(e) {

                $("button[type='submit']").html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Submit</b>`
                );

            });
        })


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
