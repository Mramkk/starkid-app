<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


</head>

<body>

    <div class="container mt-5">

        <form id="frm" method="POST" action="{{ route('login') }}">
            @csrf


            <div class="row justify-content-center">
                <div class="col-md-5 mt-5">
                    <div class="card shadow-lg p-5">

                        <div class="text-center ">
                            <img src="{{ url('assets/img/logo.png') }}" width="160">

                        </div>

                        <div class="mt-4 text-center">

                            <h4>Log In KK.</h4>
                            <span>Login with your credentials</span>

                            <div class="mb-3 mt-3">

                                <input type="text" class="form-control" name="email" placeholder="Email" required>




                            </div>


                            <div class="mb-3">

                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>


                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Keep me Logged in
                                    </label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <a href="{{ route('password.request.user') }}" class="forgot">Forgot Password</a>
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


                            <button type="submit" id="btnSubmit" style="width: 200px;"
                                class="btn btn-primary btn-block">Log
                                In</button>


                        </div>
                        <div class="mt-3 text-center">
                            <a href="{{ route('register') }}" class="forgot">Don't have account? Sign Up</a>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="{{ route('admin.login') }}" class="forgot">Admin Login</a>
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
<script>
    $(document).ready(function() {
        $('#frm').submit(function(e) {
            $("#btnSubmit").html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Log In`
            );

        });

    });
</script>

</html>
