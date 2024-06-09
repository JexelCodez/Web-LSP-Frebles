<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/assets/css/payment-form.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Sweetalert -->
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">

    <title>Frebles - Pembayaran</title>

</head>

<body id="master" class="background-radial-gradient">

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Payment Methods -->
                <div class="card p-3 mb-3">
                    <p class="mb-0 fw-bold h4">Metode Pembayaran</p>
                </div>
                <!-- Cash On Delivery -->
                <div class="card p-3 mb-3">
                    <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                       href="{{ route('CashOnDelivery', $order->id) }}">
                        <span class="fw-bold">Bayar Di Tempat (COD)</span>
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <footer>
                <p><i>Untuk bantuan lainnya, silahkan hubungi kami atau kirim pesan &nbsp;&nbsp; 
                    <a rel="nofollow" href="{{ route('landingpage-items.contact') }}" target="_blank">Klik disini.</i></a></p>
            </footer>
            
        </div>

        <!-- Hidden Input Fields for Status and Message -->
        <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
        <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />
    </div>

    <!-- JS Link For Bootstrap -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('landingpage/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/counter.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/custom.js') }}"></script>

    <!-- Success Message Update -->
    <script>
        const masterBody = document.getElementById("master");
        const sts = document.getElementById("sts");
        const msg = document.getElementById("msg");

        function saveMessage() {
            if (sts.value == "save") {
                swal('Orderan Anda sudah kami proses!', msg.value, 'success');
            }
        }

        masterBody.onload = function() {
            saveMessage();
        };
    </script>

</body>

</html>
