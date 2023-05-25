<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <style>
        .iti.iti--allow-dropdown {
            width: 100%
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <form id="frm" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-9 mt-5 mb-5">
                    <div class="card shadow-lg p-5">

                        <div class="text-center ">
                            <img src="{{ url('assets/img/logo.png') }}" width="160">

                        </div>
                        <h4 class="mb-4 text-center">Sign Up</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    value="{{ old('name') }}" oninput="this.value = this.value.toUpperCase()"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" id="phone" class="form-control" placeholder="Phone Number"
                                    name="phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="date" data-date-format="DD/MM/YYYY" class="form-control" name="dob"
                                    value="{{ old('dob') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" name="gender">
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
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
                                <input type="text" class="form-control" name="father" placeholder="Father Name"
                                    oninput="this.value = this.value.toUpperCase()" value="{{ old('father') }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="mother" placeholder="Mother Name"
                                    oninput="this.value = this.value.toUpperCase()" value="{{ old('mother') }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" id="txtcountry" name="country">
                                    <option value="" selected>Select Country</option>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="password" placeholder="Password" class="form-control" name="password"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" id="txtstate" name="state">
                                    <option value="" selected>Select State</option>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="password" placeholder="Confirm Password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" id="txtcity" name="city">
                                    <option value="" selected>Select City</option>

                                </select>
                            </div>


                        </div>





                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="mt-3 text-center">
                                    <span class="text-danger mb-3"> {{ $error }}</span>
                                </div>
                            @endforeach
                        @endif
                        <div class="mt-3 text-center">


                            <button id="btnSubmit" style="width: 200px;" class="btn btn-primary btn-block"><b>Sign
                                    Up</b></button>


                        </div>







                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        initialCountry: "in",
        separateDialCode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
    });
</script>
<script>
    loadCountries()
    $(document).ready(function() {

        $('#frm').submit(function(e) {
            $("#btnSubmit").html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Sign
                                    Up</b>`
            );

        });
        // $("#btnSubmit").attr("disabled", true);

        $('#txtcountry').on('change', function() {
            let country = $(this).find(":selected").val();
            loadStates(country);
        });
        $('#txtstate').on('change', function() {
            let state = $(this).find(":selected").val();
            loadCities(state);
        });

    });

    function loadCountries() {
        $.ajax({
            url: "https://jissoftware.in/world/api/country",
            type: "GET",
            success: function(res) {
                if (res.status == true) {
                    let options = res.data.map(o => `<option value="${o.name}">${o.name}</option>`);
                    $('#txtcountry').append(options);
                }

            }
        })
    }

    function loadStates(country) {
        let data = {
            "action": "states",
            "country": country
        }
        $.ajax({
            url: "https://jissoftware.in/world/api/country",
            type: "GET",
            data: data,
            success: function(res) {
                if (res.status == true) {
                    let options = res.data.map(o => `<option value="${o.name}">${o.name}</option>`);
                    $('#txtstate').append(options);
                }

            }
        })
    }

    function loadCities(state) {
        let data = {
            "action": "cities",
            "state": state
        }
        $.ajax({
            url: "https://jissoftware.in/world/api/country",
            type: "GET",
            data: data,
            success: function(res) {
                if (res.status == true) {
                    let options = res.data.map(o => `<option value="${o.name}">${o.name}</option>`);
                    $('#txtcity').append(options);
                }

            }
        })
    }
</script>

</html>
