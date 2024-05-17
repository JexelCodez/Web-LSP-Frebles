<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <title>Frebles - Payment</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

.container {
    margin: 30px auto;
}

.container .card {
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    background: #fff;
    border-radius: 0px;
}

body {
    background: #eee
}



.btn.btn-primary {
    background-color: #ddd;
    color: black;
    box-shadow: none;
    border: none;
    font-size: 20px;
    width: 100%;
    height: 100%;
}

.btn.btn-primary:focus {
    box-shadow: none;
}

.container .card .img-box {
    width: 80px;
    height: 50px;
}

.container .card img {
    width: 100%;
    object-fit: fill;
}

.container .card .number {
    font-size: 24px;
}

.container .card-body .btn.btn-primary .fab.fa-cc-paypal {
    font-size: 32px;
    color: #3333f7;
}

.fab.fa-cc-amex {
    color: #1c6acf;
    font-size: 32px;
}

.fab.fa-cc-mastercard {
    font-size: 32px;
    color: red;
}

.fab.fa-cc-discover {
    font-size: 32px;
    color: orange;
}

.c-green {
    color: green;
}

.box {
    height: 40px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ddd;
}

.btn.btn-primary.payment {
    background-color: red;
    color: white;
    border-radius: 0px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 24px;
}


.form__div {
    height: 50px;
    position: relative;
    margin-bottom: 24px;
}

.form-control {
    width: 100%;
    height: 45px;
    font-size: 14px;
    border: 1px solid #DADCE0;
    border-radius: 0;
    outline: none;
    padding: 2px;
    background: none;
    z-index: 1;
    box-shadow: none;
}

.form__label {
    position: absolute;
    left: 16px;
    top: 10px;
    background-color: #fff;
    color: #80868B;
    font-size: 16px;
    transition: .3s;
    text-transform: uppercase;
}

.form-control:focus+.form__label {
    top: -8px;
    left: 12px;
    color: #1A73E8;
    font-size: 12px;
    font-weight: 500;
    z-index: 10;
}

.form-control:not(:placeholder-shown).form-control:not(:focus)+.form__label {
    top: -8px;
    left: 12px;
    font-size: 12px;
    font-weight: 500;
    z-index: 10;
}

.form-control:focus {
    border: 1.5px solid #1A73E8;
    box-shadow: none;
}

    </style>

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

</head>

<body>
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
                    <span>
                        <span class="fab fa-cc-amex"></span>
                        <span class="fab fa-cc-mastercard"></span>
                        <span class="fab fa-cc-discover"></span>
                    </span>
                </a>
                <div class="collapse p-3 pt-0" id="paypalCollapse">
                    <!-- PayPal Summary -->
                    <div class="row">
                        <div class="col-8">
                            <p class="h4 mb-0">Summary</p>
                            <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of product</span></p>
                            <p class="mb-0"><span class="fw-bold">Price:</span><span class="c-green">:$452.90</span></p>
                            <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nihil neque quisquam aut repellendus, dicta vero? Animi dicta cupiditate, facilis provident quibusdam ab quis, iste harum ipsum hic, nemo qui!</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Snap Container -->
            <div class="card p-3 mb-3">
                <div id="snap-container" class="card p-3">
                    <button id="pay-button" class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between">
                        <span class="fw-bold">Via E-Wallet</span>
                        <span>
                            <span class="fab fa-cc-amex"></span>
                            <span class="fab fa-cc-mastercard"></span>
                            <span class="fab fa-cc-discover"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

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

</body>

</html>
