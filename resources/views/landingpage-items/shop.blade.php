<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles - Shop Page</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

    <!-- Bootstrap icon library  -->
    <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

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

  <style>
    .card {
    /* Set fixed width for the card */
    width: 100%;
    /* Set fixed height for the card */
    height: 400px; /* Adjust the height as needed */
    /* Add padding and margin for spacing */
    padding: 15px;
    margin-bottom: 20px;
    /* Ensure content inside the card is aligned properly */
    display: flex;
    flex-direction: column;
    }

    .product-img-container {
        /* Set fixed height for the image container */
        height: 200px; /* Adjust the height as needed */
        /* Ensure image covers the container without distortion */
        overflow: hidden;
    }

    .product-img-container img {
        /* Ensure image covers the container without distortion */
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                      <li><a href="{{ route('landingpage') }}">Home</a></li>
                      <li><a href="{{ route('landingpage-items.shop') }}" class="active">Our Shop</a></li>
                      <li><a href="{{ route('landingpage-items.contact') }}">Contact Us</a></li>
                      
                      <!-- If user is logged in, it shows the user's name (Login and Registration) -->
                      @if (Route::has('login'))
                                @auth
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
          <h3>Our Shop</h3>
          <span class="breadcrumb"><a href="#">Home</a> > Our Shop</span>
        </div>
      </div>
    </div>
  </div>

  <div class="section trending">
    <div class="container">
      <!-- <ul class="trending-filter">
        <li>
          <a class="is_active" href="#!" data-filter="*">Show All</a>
        </li>
        <li>
          <a href="#!" data-filter=".lfy">Leafy Greens</a>
        </li>
        <li>
          <a href="#!" data-filter=".crc">Cruciferous</a>
        </li>
        <li>
          <a href="#!" data-filter=".mrw">Marrow</a>
        </li>
        <li>
          <a href="#!" data-filter=".rvs">Root Vegetables</a>
        </li>
        <li>
          <a href="#!" data-filter=".eps">Edible Plant Stem</a>
        </li>
        <li>
          <a href="#!" data-filter=".alm">Allium</a>
        </li>
        <li>
          <a href="#!" data-filter=".ctr">Citrus</a>
        </li>
        <li>
          <a href="#!" data-filter=".stn">Stone Fruit</a>
        </li>
        <li>
          <a href="#!" data-filter=".tae">Tropical and Exotic</a>
        </li>
        <li>
          <a href="#!" data-filter=".brs">Berries</a>
        </li>
        <li>
          <a href="#!" data-filter=".mln">Melons</a>
        </li>
      </ul> -->

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
                                        <span class="badge bg-danger">{{ $discount->percentage * 100 }}% Off</span>
                                        <del class="text-muted">${{ $product->price }}</del>
                                        <span class="discounted-price">${{ number_format($product->price - ($product->price * $discount->percentage), 2) }}</span>
                                    @endforeach
                                @else
                                  <span class="price">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </p>
                            <!-- End Logic For Displaying Discount Price -->
                            
                            <!-- The Buttons in The Card -->
                            <div class="d-flex justify-content-start">

                                <a href="{{ route('landingpage-items.product-details', $product->id) }}" class="icon-link btn btn-sm btn-primary"><i class="bi bi-eye-fill">View</i></a>
                                
                                <a href="{{ url('user/wishlists') }}" class="btn btn-sm btn-secondary"><i class="bi bi-star-fill">Add To Wishlist</i> </a>

                                <a href="{{ route('landingpage-items.product-details', $product->id) }}" class="btn btn-sm btn-success"><i class="bi bi-cart-dash-fill">Add To Cart</i></a>

                                <!-- <form id="stock_quantity" action="{{ route('landingpage-items.cart', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" aria-describedby="stock_quantity" value="1" min="1">
                                    <button type="submit" value="Add To Cart"><i class="bi bi-cart-dash-fill"></i>Add To Cart</button>
                                </form> -->

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      @else
          <p>No products found</p>
      @endif
        
      <!-- end logic for show product -->

      <!-- </div> -->
      <!-- <div class="row">
        <div class="col-lg-12">
          <ul class="pagination">
          <li><a href="#"> &lt; </a></li>
            <li><a href="#">1</a></li>
            <li><a class="is_active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"> &gt; </a></li>
          </ul>
        </div>
      </div> -->
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2024 Frebles Online Shop. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: by TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- JS Link For Bootstrap -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('landingpage/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/counter.js') }}"></script>
  <script src="{{ asset('landingpage/assets/js/custom.js') }}"></script>

  <script>
      // Function to update the cart item count
      function updateCartItemCount() {
          // Send an Ajax request to fetch the current cart item count
          $.ajax({
              url: "{{ route('landingpage-items.product-details', $product->id) }}", // Update the route with your actual route
              method: "GET",
              success: function(response) {
                  // Update the cart item count displayed in the badge
                  $('.cart-item-count').text(response.itemCount);
              },
              error: function(xhr, status, error) {
                  // Handle error
                  console.error(error);
              }
          });
      }

      // Update cart item count on page load
      $(document).ready(function() {
          updateCartItemCount();
      });
  </script>

  </body>
</html>