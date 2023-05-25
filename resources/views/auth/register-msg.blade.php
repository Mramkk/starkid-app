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


        <div class="row justify-content-center">
            <div class="col-md-9 mt-5 mb-5">
                <div class="card shadow-lg p-5">

                    <div class="text-center mt-5">
                        <img src="{{ url('assets/img/logo.png') }}" width="160">

                    </div>
                    <h4 class="mb-3 text-center mt-5">You Sign Up successfully !</h4>
                    <p class="text-center mb-5">Please contact admin to active your account.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-center">
                            <a class="btn btn-success" href="{{ url('/') }}">Back to home</a>
                        </div>
                    </div>











                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>


</html>
