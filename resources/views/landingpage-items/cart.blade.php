<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Frebles - Keranjang</title>
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Link to CSS file -->
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/cart.css') }}">

    <!-- Frebles Logo Link -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Bootstrap Icons Library -->
    <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Sweetalert -->
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <style>
      .alert-container{
        margin-top:10px;
        position: fixed;
        z-index: 999;
      }
    </style>

</head>

<body id="master">

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

  <!-- Session Messages -->
  @if (session('success'))
      <div class="container">
        <div class="row alert-container">
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill h3"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      </div>
    @endif

  
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="{{ route('landingpage-items.shop') }}" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Lanjut belanja</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Keranjang Belanja</p>
                    <p class="mb-0">Kamu ada {{ $total_item }} barang dalam sini.</p>
                  </div>
                </div>

                @foreach($carts as $cart)
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="{{ asset('storage/' . $cart->image) }}"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5>{{ $cart->product_title }}</h5>
                          <p class="small mb-0">{{ $cart->category_name }}</p>
                        </div>
                      </div>
                      
                      <div class="d-flex flex-row align-items-center">
                          <div style="width: 50px;">
                              <h5 class="fw-normal mb-0">{{ $cart->quantity }}</h5>
                          </div>
                          <div style="overflow: hidden;">
                              <h5 class="mb-0" style="white-space: nowrap;">Rp{{ number_format($cart->price, 0) }}</h5>
                          </div>
                          <!-- Make a link with red color trash can logo -->
                          <a href="{{ route('landingpage-items.remove-from-cart', $cart->id) }}" onclick="return confirm('Are you sure to remove this product?')">
                              <i class="bi bi-trash-fill text-danger"></i>
                          </a>
                      </div>

                    </div>
                  </div>
                </div>
                @endforeach
              </div>

              <div class="col-lg-5">
                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">DETAIL CUSTOMER</h5>
                        <i class="bi bi-person-check h1"></i>
                    </div>
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Nama Customer</label>
                        <div>{{ $customers->name }}</div>
                      </div>

                    <form class="mt-4">
                      
                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">No Telp Customer</label>
                        <div>{{ $customers->phone }}</div>
                      </div>

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Alamat 1</label>
                        <div>{{ $customers->address1 }}</div>
                      </div>

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Alamat 2 (Optional)</label>
                        <div>{{ $customers->address2 }}</div>
                      </div>

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Alamat 3 (Optional)</label>
                        <div>{{ $customers->address3 }}</div>
                      </div>

                    </form>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2 text-light">Subtotal</p>
                      <p class="mb-2 text-light">Rp{{ number_format($total_price, 0) }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2 text-light">Ongkos Kirim</p>
                      <p class="mb-2 text-light">Gratis (berlaku s.d 1 Juli 2024)</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2 text-light">Kamu hemat</p>
                      <p class="mb-2 text-light">Rp0</p>
                    </div>

                    <p class="mb-2 text-light">Mohon cek kembali...</p>
                    <p class="mb-2 text-light">Bila ada yang kurang sesuai...</p>
                    <p class="mb-2"><a href="{{ route('dashboard') }}" class="ms-7 badge badge-primary">Anda bisa merubah data customer Anda disini...</a></p>
                    <a href="{{ route('cart.order') }}" class="btn btn-info btn-block btn-lg mt-3" onclick="return confirm('Anda akan order?')">
                      <i class="bi bi-box2"></i>
                      <span class="ms-auto">Order</span>
                    </a>
                    <!-- <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span>$4818.00</span>
                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button> -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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