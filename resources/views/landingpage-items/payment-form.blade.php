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
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Sweetalert -->
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">

    <title>Frebles - Payment</title>

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

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
                <p class="mb-0 fw-bold h4">Payment Methods</p>
            </div>
            <!-- Cash On Delivery -->
            <div class="card p-3 mb-3">
                <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                   href="{{ route('CashOnDelivery', $order->id) }}">
                    <span class="fw-bold">Cash On Delivery (COD)</span>
                </a>
            </div>
            <!-- Snap Container -->
                <div id="snap-container" class="card p-3">
                    <button id="pay-button" class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between">
                        <span class="fw-bold">Via E-Wallet</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Input Fields for Status and Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

    <!-- JS Link For Bootstrap -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('landingpage/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/counter.js') }}"></script>
    <script src="{{ asset('landingpage/assets/js/custom.js') }}"></script>

    <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.embed('{{ $snapToken }}', {
        embedId: 'snap-container',
        onSuccess: function (result) {
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });

  </script>

  <!-- Success Message Update -->
  <script>
        const masterBody = document.getElementById("master");
        const sts = document.getElementById("sts");
        const msg = document.getElementById("msg");

        function saveMessage() {
            if (sts.value == "save") {
                swal('Success!', msg.value, 'success');
            }
        }

        masterBody.onload = function() {
            saveMessage();
        };
    </script>

</body>

</html>
