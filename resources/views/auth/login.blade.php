<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Frebles - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Logo -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap icon library  -->
    <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

</head>
<body>

<section class="vh-0" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h3 class="mb-5">Login</h3>
                        <img src="{{ asset('landingpage/assets/images/logos/frebles-hd-1.png') }}" alt="main_logo" style="width: 158px;">

                        <div class="form-floating mb-4 mt-4">
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="name@example.com">
                            <label for="email">Email</label>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check d-flex justify-content-start mb-2">
                            <input class="form-check-input" type="checkbox" id="remember_me">
                            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                        </div>

                        <button class="btn btn-primary btn-lg w-100" type="submit">Login</button>

                        <div class="flex items-center justify-end mt-3">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                        <hr class="my-4">

                        <button class="btn btn-lg btn-block btn-primary ms-auto" style="background-color: #dd4b39;" type="submit"><i class="bi bi-google"></i> Sign in with Google</button>
                        <button class="btn btn-lg btn-block btn-primary ms-auto mt-2" style="background-color: #3b5998;" type="submit"><i class="bi bi-facebook"></i> Sign in with Facebook</button>
                        <p class="mt-3 mb-0">Not registered? <a href="{{ route('register') }}">Register here</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
