<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles - Toko Kami</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/assets/css/shop.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Bootstrap icon library  -->
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
<!--

TemplateMo 589 lugx gaming
https://templatemo.com/tm-589-lugx-gaming

-->

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

    @if (session('success'))
      <div class="container">
        <div class="row alert-container">
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill h3"></i>
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('landingpage') }}" class="logo">
                        <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" alt="logo" style="width: 158px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="{{ route('landingpage-items.cart') }}" class="cart-icon-link">
                        <img src="{{ asset('landingpage/assets/images/logos/cart2.png') }}" alt="Cart" class="img-fluid cart-icon" style="max-width: 32px;">
                        <span class="badge bg-secondary cart-item-count position-absolute top-0 start-45 translate-middle">{{ $cartItemCount }}</span>
                      </a></li>
                      <li><a href="{{ route('landingpage') }}">Frebles</a></li>
                      <li><a href="{{ route('landingpage-items.shop') }}" class="active">Belanja</a></li>
                      <li><a href="{{ route('landingpage-items.contact') }}">Kontak & Informasi</a></li>
                      
                      <!-- If user is logged in, it shows the user's name (Login and Registration) -->
                      @if (Route::has('login'))
                                @auth

                                      <!-- IF CONDITION 2 -->
                                      @if(Auth::user()->usertype == 'admin')
                                      <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                      @endif
                                      <!-- END IF CONDITION 2 -->
                                      
                                    <li><a href="{{ url('/dashboard') }}">{{ Auth::user()->name }}</a></li>
                                @else
                                    <li><a href="{{ route('login') }}">Log in</a></li>

                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endif
                                @endauth
                        @endif  
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>Semua Yang Anda Butuhkan Ada Disini</h3>
          <span class="breadcrumb"><a href="#">Frebles</a> > Belanja</span>
        </div>
      </div>
    </div>
  </div>

  <div class="section trending">
    <div class="container">

    <!-- Search Input -->
    <div class="search-input d-flex justify-content-center">
      <form action="{{ route('searchProduct') }}" class="d-flex" method="GET">
        <input type="text" placeholder="Cari sesuatu" id="search" name="search" class="form-control me-2 mb-2" />
        <button type="submit" class="btn btn-primary mb-2" value="search">Cari</button>
      </form>
    </div>
  
      <!-- <div class="row trending-box"> -->

      <!-- start logic for showing product -->

      @if ($products->isNotEmpty())
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="/single-product/{{ $product->id }}">
                            <div class="product-img-container">
                                <img class="card-img-top" src="{{ asset('storage/' . $product->image1_url) }}" alt="{{ $product->product_name }}">
                            </div>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><a href="/single-product/{{ $product->id }}">{{ $product->product_name }}</a></h5>

                            <!-- The Logic For Displaying Discount Price -->
                            <!-- We use the number_format() function to format the prices with 2 decimal places. -->
                            <p class="card-text">
                                @if ($product->discounts->isNotEmpty())
                                    @foreach ($product->discounts as $discount)
                                        <span class="badge bg-info">{{ $discount->discountCategory->category_name }}</span>
                                        <span class="badge bg-danger">{{ $discount->percentage }}% Off</span>
                                        <del class="text-muted">Rp{{ number_format($product->price), 0 }}</del>
                                        <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage / 100), 0) }}</span>
                                    @endforeach
                                @else
                                  <span class="price">Rp{{ number_format($product->price, 0) }}</span>
                                @endif
                            </p>
                            <!-- End Logic For Displaying Discount Price -->
                            
                            <!-- The Buttons in The Card -->
                            <div class="d-flex justify-content-start">

                                <a href="{{ route('landingpage-items.product-details', $product->id) }}" class="icon-link btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i>Lihat</a>
                            
                                <form action="{{ route('wishlist.add') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                        <i class="bi bi-star-fill"></i> Tambah Ke Wishlist
                                    </button>
                                </form>

                                <a href="{{ route('product-reviews.create', $product->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-chat-dots"></i> Review Produk</a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Show Pagination Links for Products -->
        {{ $products->onEachSide(1)->links() }}
      @else
          <p>Produk belum ada.</p>
      @endif
      
      <!-- end logic for show product -->

    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p><i>Hak Cipta © 2024 Frebles Online Shop. Hak cipta dilindungi undang-undang. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Desain: oleh TemplateMo. Sentuhan Kecil: oleh Janya.</i></a></p>
      </div>
    </div>
  </footer>

  <!-- Hidden Input Fields for Status and Message -->
  <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
  <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />
    
    <!-- Success Message Update -->
    <script>
        const masterBody = document.getElementById("master");
        const sts = document.getElementById("sts");
        const msg = document.getElementById("msg");

        function saveMessage() {
            if (sts.value == "save") {
                swal('Berhasil!', msg.value, 'success');
            }
        }

        masterBody.onload = function() {
            saveMessage();
        };
    </script>

  <!-- JS Link For Bootstrap -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('landingpage/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/counter.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/custom.js') }}"></script>


  <script>
    document.addEventListener("DOMContentLoaded", function(event) { 
      var scrollpos = localStorage.getItem('scrollpos');
      
      if (scrollpos) window.scrollTo(0, scrollpos);
    });
      window.onbeforeunload = function(e) {
      localStorage.setItem('scrollpos', window.scrollY);
    };
  </script>

    
  </body>
</html>