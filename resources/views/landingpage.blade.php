<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap icon library  -->
    <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Next to title name logo -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Sweetalert Library -->
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

  <body>
    
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

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('landingpage') }}" class="main_logo">
                        <img src="{{ asset('landingpage/assets/images/logos/frebles-hd-1.png') }}" alt="main_logo" style="width: 158px;">
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                        <li><a href="{{ route('landingpage') }}" class="active">Frebles</a></li>
                        <li><a href="{{ route('landingpage-items.shop') }}">Belanja</a></li>
                        <li><a href="{{ route('landingpage-items.contact') }}">Kontak & Informasi</a></li>

                        <!-- Show Login And Registration Links IF THE USER LOGS IN OR NOT -->
                        @if (Route::has('login'))
                                  @auth
                                      <!-- IF CONDITION 2 -->
                                      @if(Auth::user()->usertype == 'admin')
                                      <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                      @elseif(Auth::user()->usertype == 'owner')
                                      <li><a href="{{ url('owner/dashboard') }}">Dashboard</a></li>
                                      @endif
                                      <!-- END IF CONDITION 2 -->

                                      <li><a href="{{ url('/dashboard') }}">{{ Auth::user()->name }}</a></li>
                                  @else
                                      <li><a href="{{ route('login') }}">Login</a></li>

                                      @if (Route::has('register'))
                                          <li><a href="{{ route('register') }}">Register</a></li>
                                      @endif
                                  @endauth
                          @endif 
                    </ul>
                    <!-- ***** Menu End ***** -->

                </nav>
            </div>
        </div>
    </div>
  </header>

  <!-- ***** Header Area End ***** -->

  <div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="caption header-text">
            <h6>Welcome to Fresh Fruit and Vegetables Online</h6>
            <h2>WEBSITE PALING SEDERHANA UNTUK ANDA!</h2>
            <p>"Selamat datang di Frebles, surga produk segar Anda! Di Frebles, kami bersemangat menyediakan pilihan buah dan sayuran segar terbaik untuk Anda, dipetik langsung dari kebun. Nikmati beragam pilihan musiman kami yang penuh warna, mulai dari beri yang juicy hingga sayuran yang renyah, dan semuanya di antaranya. Dengan Frebles, Anda tidak hanya mendapatkan bahan makanan - Anda memulai perjalanan rasa, kualitas, dan kebaikan alami. Jelajahi pasar online kami dan temukan kebahagiaan membawa hasil alam langsung ke pintu rumah Anda. Mari kita buat setiap hidangan menjadi mahakarya bersama di Frebles - di mana kesegaran bertemu dengan kenyamanan, dan setiap gigitan adalah perayaan!"</p>
          </div>
        </div>
        <div class="col-lg-4 offset-lg-2">
          <div class="right-image">
            <img src="{{ asset('landingpage/assets/images/fresh-veggie-and-fruit-potrait-hd.webp') }}" alt="Fruits and Veggie Banner">
            <span class="price">Rp100,000</span>
            <span class="offer">-40%</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/fresh-delight-awaits-round-hd.webp') }}" alt="Fresh Delight Await" style="max-width: 100px;">
              </div>
              <h4>Kesegaran Mengasyikkan Menanti</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/a-garden-in-every-bite-round-hd-pic.webp') }}" alt="A Garden In Every Bite" style="max-width: 100px;">
              </div>
              <h4>Kepuasan Dalam Setiap Gigit</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/nature-finest-selection-round-hd.webp') }}" alt="Nature Finest Selection" style="max-width: 70px;">
              </div>
              <h4>Terbaik Dari Alam</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/farm-to-table-treasure-round-hd.webp') }}" alt="Farm to Table Treasures" style="max-width: 100px;">
              </div>
              <h4>Sajian Berharga Dari Kebun</h4>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="section trending">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>Trending</h6>
            <h2>Trending Saat Ini</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="{{ route('landingpage-items.shop') }}">Lihat Semua</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/leafy-greens/lettuce-1.jpeg') }}" alt="trending_item_1"></a>
              <span class="price"><em>Rp20000</em>Rp10,000</span>
            </div>
            <div class="down-content">
              <span class="category">Berdaun Hijau</span>
              <h4>Selada</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/cruciferous/broccoli-2.webp') }}" alt="trending_item_2"></a>
              <span class="price">Rp27,500</span>
            </div>
            <div class="down-content">
              <span class="category">Kucifer</span>
              <h4>Brokoli</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/cruciferous/cauliflower-2.jpeg') }}" alt="trending_item_3"></a>
              <span class="price"><em>Rp38199</em>Rp30,099</span>
            </div>
            <div class="down-content">
              <span class="category">Kucifer</span>
              <h4>Kembang Kol</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/root-vegetables/carrot-hd-1.webp') }}" alt="trending_item_4"></a>
              <span class="price">Rp16,875</span>
            </div>
            <div class="down-content">
              <span class="category">Umbi-Umbian</span>
              <h4>Wortel</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section most-played">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>BUAH-BUAHAN</h6>
            <h2>Paling Dibeli</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="{{ route('landingpage-items.shop') }}">Lihat Semua</a>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/citrus/oranges-hd-2.webp') }}" alt="trending_item_1"></a>
            </div>
            <div class="down-content">
                <span class="category">Citrus</span>
                <h4>Jeruk</h4>
                <a href="{{ route('landingpage-items.shop') }}">BELI</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/citrus/mandarins-hd-1.webp') }}" alt="trending_item_2"></a>
            </div>
            <div class="down-content">
                <span class="category">Citrus</span>
                <h4>Jeruk Mandarin</h4>
                <a href="{{ route('landingpage-items.shop') }}">BELI</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/citrus/limes-hd-2.webp') }}" alt="trending_item_3"></a>
            </div>
            <div class="down-content">
                <span class="category">Citrus</span>
                <h4>Jeruk Nipis</h4>
                <a href="{{ route('landingpage-items.shop') }}">BELI</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/stone-fruit/apricots-2.webp') }}" alt="trending_item_4"></a>
            </div>
            <div class="down-content">
                <span class="category">Buah Batu</span>
                <h4>Aprikot</h4>
                <a href="{{ route('landingpage-items.shop') }}">BELI</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/stone-fruit/nectarines-1.webp') }}" alt="trending_item_5"></a>
            </div>
            <div class="down-content">
                <span class="category">Buah Batu</span>
                <h4>Nektarin</h4>
                <a href="{{ route('landingpage-items.shop') }}">BELI</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/tropical-and-exotic/banana-1.webp') }}" alt="trending_item_6"></a>
            </div>
            <div class="down-content">
                <span class="category">Buah-Buahan Eksotis</span>
                <h4>Pisang</h4>
                <a href="{{ route('landingpage-items.shop') }}">BELI</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h6>KATEGORI-KATEGORI</h6>
            <h2>Top Kategori</h2>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Citrus</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-01.webp') }}" alt="category-01"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Buah-Buahan Exotis</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-02.webp') }}" alt="category-02"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Buah-Buahan Beri</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-03.webp') }}" alt="category-03"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Berdaun Hijau</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-04.webp') }}" alt="category-04"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Umbi-Umbian</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-05.webp') }}" alt="category-05"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="section cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="shop">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <h6>Toko Kami</h6>
                  <h2>Pesan Sekarang & Dapatkan <em>Harga Terbaik</em> Untuk Anda!</h2>
                </div>
                <p>Perhatikan bahwa pada hari spesial kami mungkin akan mengadakan acara diskon khusus!</p>
                <div class="main-button">
                  <a href="{{ route('landingpage-items.shop') }}">Mulai</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-2 align-self-end">
          <div class="subscribe">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <h6>BULETIN</h6>
                  <h2>Dapatkan Diskon Hingga Rp20,000 Hanya dengan <em>Berlangganan</em> Buletin!</h2>
                </div>

                <!-- Newsletter Subscription -->
                <div class="main-button">
                <form action="{{ url('subscribe') }}" method="POST" id="subscribeForm">
                    @csrf
                    <input type="email" name="email" id="email" placeholder="Masukkan email">

                    @auth
                      <button type="button" onclick="sendSubcription()">Subscribe Now</button>
                    @else
                      <p class="ms-2 mt-3">To make the button appear, login first!</p>
                    @endauth
                    
                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p><i>Hak Cipta © 2024 Frebles Online Shop. Hak cipta dilindungi undang-undang. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Desain: oleh TemplateMo. Sentuhan Kecil: oleh Janya.</i></a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('landingpage/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/counter.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/custom.js') }}"></script>

    <script>
      const form = document.getElementById("subscribeForm")
      let mail = document.getElementById("email")
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      function sendSubcription() {
      if (mail.value.trim() == "" || !emailPattern.test(mail.value.trim())) {
        mail.focus()
        swal("Tidak bisa", "Tolong masukkan data email Anda", "error")
      } else {
              swal({
                  title: "Anda ingin berlangganan?",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonColor: '#DD6B55',
                  confirmButtonText: 'Yes!',
                  cancelButtonText: "Eh, tolong batal!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              },
              function(isConfirm) {
                  if (isConfirm) {
                      form.submit();
                      swal("Success!", "Terima kasih telah berlangganan dengan kami!", "success");
                  } else {
                      swal("Cancelled", "Terima kasih atas tanggapannya!", "error");
                  }
              });
          }
      }
    </script>
  
  </body>
</html>