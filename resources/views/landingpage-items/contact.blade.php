<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles - Kontak Kami</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- SweetAlert -->
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
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
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill h3"></i>
            {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                      <li><a href="{{ route('landingpage') }}">Frebles</a></li>
                      <li><a href="{{ route('landingpage-items.shop') }}">Belanja</a></li>
                      <li><a href="{{ route('landingpage-items.contact') }}" class="active">Kontak & Informasi</a></li>

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
          <h3>Kontak Kami</h3>
          <span class="breadcrumb"><a href="#">Frebles</a>  >  Kontak & Informasi</span>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="left-text">
            <div class="section-heading">
              <h6>Kontak Kami</h6>
              <h2>Ayo Sapa!</h2>
            </div>
            <p>Frebles adalah situs E-commerce yang dibuat untuk menjual buah dan sayuran segar. Situs ini dibuat oleh seorang siswa yang bersemangat karena sebuah tugas. Website ini menggunakan Laravel Breeze untuk sistem login dan registrasinya, dan ya, dibuat dengan menggunakan Laravel 11 Framework. Frebles menggunakan Bootstrap 5 dan Bootstrap Icons Library untuk meningkatkan tampilan website, dengan tambahan CSS di beberapa bagian.</p>
            <ul>
              <li><span>Alamat</span> Pasar Bersih blok KA.02</li>
              <li><span>No Telp</span> +64 821 2214 5176</li>
              <li><span>Email</span> frebles.official@gmail.com</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-content">
            <div class="row">
              <div class="col-lg-12">
                <!-- Google Maps -->
                <div id="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.657448462733!2d106.85881917317286!3d-6.564849364171563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c7d8dfaba225%3A0xd7692ba12bd1d239!2sPasar%20Bersih%20Sentul%20City!5e0!3m2!1sid!2sid!4v1715575185324!5m2!1sid!2sid" width="100%" height="325px" frameborder="0" style="border:0; border-radius: 23px;" allowfullscreen=""></iframe>
                </div>
              </div>
              <div class="col-lg-12">
                <form id="contact-form" action="{{ route('message.store') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="name" name="name" id="name" placeholder="Nama kamu..." autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="surname" name="surname" id="surname" placeholder="Nama panggilan..." autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-mail kamu..." required="">
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="subject" name="subject" id="subject" placeholder="Subjek/Topik..." autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <textarea name="message" id="message" placeholder="Pesan kamu" required></textarea>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="save" class="orange-button">Kirim Pesan</button>
                      </fieldset>
                    </div>
                  </div>
                </form>
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
                swal('Terkirim', msg.value, 'success');
            }
        }

        masterBody.onload = function() {
            saveMessage();
        };
    </script>

    <!-- Return Confirm -->
    <script>
        document.getElementById('save').addEventListener('click', function(event) {
            var confirmSend = confirm("Apakah Anda yakin ingin mengirim pesan ini?");
            if (!confirmSend) {
                // Prevent the form from submitting
                event.preventDefault();
            }
        });
    </script>

  </body>
</html>