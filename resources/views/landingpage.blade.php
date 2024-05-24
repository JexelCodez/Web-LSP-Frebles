<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

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


    <!--
      ===========================
              Contents
      ===========================
    -->

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
                        <li><a href="{{ route('landingpage') }}" class="active">Home</a></li>
                        <li><a href="{{ route('landingpage-items.shop') }}">Our Shop</a></li>
                        <li><a href="{{ route('landingpage-items.contact') }}">Contact Us</a></li>

                        <!-- Show Login And Registration Links IF THE USER LOGS IN OR NOT -->
                        @if (Route::has('login'))
                                  @auth
                                      <!-- IF CONDITION 2 -->
                                      @if(Auth::user()->usertype == 'admin')
                                      <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                      @else
                                      <li><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
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
            <h2>BEST SELLING SITE EVER!</h2>
            <p>"Welcome to Frebles, your fresh produce paradise! At Frebles, we're passionate about providing you with the finest selection of farm-fresh fruits and vegetables, handpicked just for you. Dive into our vibrant array of seasonal delights, from juicy berries to crisp greens and everything in between. With Frebles, you're not just getting groceries - you're embarking on a journey of flavor, quality, and wholesome goodness. Explore our online market and discover the joy of bringing nature's bounty straight to your doorstep. Let's make every meal a masterpiece together at Frebles - where freshness meets convenience, and every bite is a celebration!"</p>
          </div>
        </div>
        <div class="col-lg-4 offset-lg-2">
          <div class="right-image">
            <img src="{{ asset('landingpage/assets/images/fresh-veggie-and-fruit-potrait-hd.webp') }}" alt="Fruits and Veggie Banner">
            <span class="price">$22</span>
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
              <h4>Fresh Delights Await</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/a-garden-in-every-bite-round-hd-pic.webp') }}" alt="A Garden In Every Bite" style="max-width: 100px;">
              </div>
              <h4>A Garden in Every Bite</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/nature-finest-selection-round-hd.webp') }}" alt="Nature Finest Selection" style="max-width: 70px;">
              </div>
              <h4>Nature's Finest Selection</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#">
            <div class="item">
              <div class="image">
                <img src="{{ asset('landingpage/assets/images/farm-to-table-treasure-round-hd.webp') }}" alt="Farm to Table Treasures" style="max-width: 100px;">
              </div>
              <h4>Farm to Table Treasures</h4>
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
            <h2>Trending Now</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="{{ route('landingpage-items.shop') }}">View All</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/leafy-greens/spinach-hd-1.webp') }}" alt="trending_item_1"></a>
              <span class="price"><em>$28</em>$20</span>
            </div>
            <div class="down-content">
              <span class="category">Leafy Greens</span>
              <h4>Spinach</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/leafy-greens/kale-hd-1.webp') }}" alt="trending_item_2"></a>
              <span class="price">$44</span>
            </div>
            <div class="down-content">
              <span class="category">Leafy Greens</span>
              <h4>Kale</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/leafy-greens/arugula-hd-2.webp') }}" alt="trending_item_3"></a>
              <span class="price"><em>$64</em>$44</span>
            </div>
            <div class="down-content">
              <span class="category">Leafy Greens</span>
              <h4>Arugula (Rocket)</h4>
              <a href="{{ route('landingpage-items.shop') }}"><i class="fa fa-shopping-bag"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/root-vegetables/carrot-hd-1.webp') }}" alt="trending_item_4"></a>
              <span class="price">$32</span>
            </div>
            <div class="down-content">
              <span class="category">Root Vegetables</span>
              <h4>Carrot</h4>
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
            <h6>TOP FRUITS</h6>
            <h2>Most Purchased</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="{{ route('landingpage-items.shop') }}">View All</a>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/citrus/oranges-hd-2.webp') }}" alt="trending_item_1"></a>
            </div>
            <div class="down-content">
                <span class="category">Citrus</span>
                <h4>Orange</h4>
                <a href="{{ route('landingpage-items.shop') }}">Explore</a>
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
                <h4>Mandarine</h4>
                <a href="{{ route('landingpage-items.shop') }}">Explore</a>
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
                <h4>Lime</h4>
                <a href="{{ route('landingpage-items.shop') }}">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/stone-fruit/apricots-2.webp') }}" alt="trending_item_4"></a>
            </div>
            <div class="down-content">
                <span class="category">Stone Fruit</span>
                <h4>Apricot</h4>
                <a href="{{ route('landingpage-items.shop') }}">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/stone-fruit/nectarines-1.webp') }}" alt="trending_item_5"></a>
            </div>
            <div class="down-content">
                <span class="category">Stone Fruit</span>
                <h4>Nectarine</h4>
                <a href="{{ route('landingpage-items.shop') }}">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="item">
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ asset('landingpage/assets/images/tropical-and-exotic/banana-1.webp') }}" alt="trending_item_6"></a>
            </div>
            <div class="down-content">
                <span class="category">Tropical and Exotic</span>
                <h4>Banana</h4>
                <a href="{{ route('landingpage-items.shop') }}">Explore</a>
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
            <h6>Categories</h6>
            <h2>Top Categories</h2>
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
            <h4>Tropical and Exotic</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-02.webp') }}" alt="category-02"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Berries</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-03.webp') }}" alt="category-03"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Leafy Greens</h4>
            <div class="thumb">
              <a href="{{ route('landingpage-items.shop') }}"><img src="{{ ('landingpage/assets/images/category-section/categories-04.webp') }}" alt="category-04"></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Root Vegetables</h4>
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
                  <h6>Our Shop</h6>
                  <h2>Go Pre-Order Buy & Get Best <em>Prices</em> For You!</h2>
                </div>
                <p>Note that on weekdays we might even throw a special discount event!</p>
                <div class="main-button">
                  <a href="{{ route('landingpage-items.shop') }}">Shop Now</a>
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
                  <h6>NEWSLETTER</h6>
                  <h2>Get Up To $20 Off Just Buy <em>Subscribe</em> Newsletter!</h2>
                </div>

                <!-- Newsletter Subscription -->
                <div class="main-button">
                <form action="{{ url('subscribe') }}" method="POST" id="subscribeForm">
                    @csrf
                    <input type="email" name="email" id="email" placeholder="Enter your email">

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
        <p><i>Copyright © 2024 Frebles Online Shop. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: by TemplateMo. Little Touches: by Janya.</i></a></p>
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
          
    </script>

    <script>
      const form = document.getElementById("subscribeForm")
      let mail = document.getElementById("email")
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      function sendSubcription() {
      if (mail.value.trim() == "" || !emailPattern.test(mail.value.trim())) {
        mail.focus()
        swal("Incomplete data", "Please fill out your email!", "error")
      } else {
              swal({
                  title: "You are subscribing?",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonColor: '#DD6B55',
                  confirmButtonText: 'Yes!',
                  cancelButtonText: "No, cancel it!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              },
              function(isConfirm) {
                  if (isConfirm) {
                      form.submit();
                      swal("Success!", "Thank you for subscribing", "success");
                  } else {
                      swal("Cancelled", "Thank you for considering", "error");
                  }
              });
          }
      }
    </script>
  
  </body>
</html>