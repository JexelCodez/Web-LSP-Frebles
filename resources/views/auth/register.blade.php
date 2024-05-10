<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frebles - Register</title>
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap icon library  -->
    <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    
    <style>
        .background-radial-gradient {
            background-color: hsl(200, 50%, 90%);
            background-image: radial-gradient(650px circle at 0% 0%, hsl(330, 90%, 70%) 15%, hsl(200, 90%, 70%) 35%, hsl(330, 90%, 70%) 75%, hsl(200, 90%, 70%) 80%, transparent 100%), radial-gradient(1250px circle at 100% 100%, hsl(330, 90%, 70%) 15%, hsl(200, 90%, 70%) 35%, hsl(330, 90%, 70%) 75%, hsl(200, 90%, 70%) 80%, transparent 100%);
        }

        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#28d5f7, #1cc74f);
            /* background: radial-gradient(blue, green); */
            overflow: hidden;
        }

        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#28d5f7, #1cc74f);
            overflow: hidden;
        }

        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
        }
    </style>
</head>
<body>

<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                    Just One Click <br />
                    <span style="color: hsl(260, 70%, 50%)">All your needs</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(0, 0%, 20%)">
                Welcome to Frebles, your fresh produce paradise! At Frebles, we're passionate about providing you with the finest selection of farm-fresh fruits and vegetables, handpicked just for you.
                </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- 2 column grid layout with text inputs for the first and last names -->

                            <h3 class="mb-5">Registration</h3>

                            <!-- Name input -->
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="name" name="name" />
                                <label for="name">Name</label>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email input -->
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" />
                                <label for="email">Email address</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password input -->
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password" />
                                <label for="password">Password</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password input -->
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                                <label for="password_confirmation">Confirm Password</label>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- To Login Page -->
                            <div class="form-floating mb-3 d-flex justify-content-center">
                                <a class="" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                                </a>
                            </div>

                            <!-- Checkbox -->
                            <!-- <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                                <label class="form-check-label" for="form2Example33">
                                    Subscribe to our newsletter
                                </label>
                            </div> -->

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign up</button>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>or sign up with:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="bi bi-facebook"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="bi bi-google"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="bi bi-twitter-x"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="bi bi-github"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
