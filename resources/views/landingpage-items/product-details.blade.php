<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles - Product Detail</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

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
                    <a href="index.html" class="logo">
                        <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" alt="logo" style="width: 158px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <!-- Cart Logo -->
                      <li><a href="{{ route('landingpage-items.cart') }}" class="cart-icon-link">
                        <img src="{{ asset('landingpage/assets/images/logos/cart2.png') }}" alt="Cart" class="img-fluid cart-icon" style="max-width: 32px;">
                        <span class="badge bg-secondary cart-item-count position-absolute top-0 start-45 translate-middle">{{ $cartItemCount }}</span>
                      </a></li>
                      <li><a href="{{ route('landingpage') }}">Home</a></li>
                      <li><a href="{{ route('landingpage-items.shop') }}">Our Shop</a></li>
                      <li><a href="{{ route('landingpage-items.contact') }}">Contact Us</a></li>
                      
                      <!-- If user is logged in, it shows the user's name (Login and Registration) -->
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
          <h3>SCROLL DOWN</h3>
          <span class="breadcrumb"><a href="{{ route('landingpage') }}">Home</a>  >  <a href="{{ route('landingpage-items.shop') }}">Shop</a>  >  {{$product->product_name}}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="single-product section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="left-image">
            <img src="{{ asset('storage/' . $product->image1_url) }}" alt="product_image">
          </div>
        </div>
        <div class="col-lg-6 align-self-center">
        <h4>{{$product->product_name}}</h4>
          

          <!-- The Logic For Displaying Discount Price -->
          <!-- We use the number_format() function to format the prices with 2 decimal places. -->
          @if ($product->discounts->isNotEmpty())

              <!-- @foreach ($product->discounts as $discount)
                  <span class="price"><em>Rp{{ number_format($product->price, 0) }}</em></span>
                  <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage), 0) }}</span>
              @endforeach -->

              @if ($product->type === 'Fruit')
              @foreach ($product->discounts as $discount)
                  <span class="price"><em>Rp{{ number_format($product->price, 0) }}/kg</em></span>
                  <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage), 0) }}/kg</span>
              @endforeach

              @elseif ($product->type === 'Vegetables')
              @foreach ($product->discounts as $discount)
                  <span class="price"><em>Rp{{ number_format($product->price, 0) }}/bunch</em></span>
                  <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage), 0) }}/bunch</span>
              @endforeach

              @else
              @foreach ($product->discounts as $discount)
                  <span class="price"><em>Rp{{ number_format($product->price, 0) }}/kg</em></span>
                  <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage), 0) }}/kg</span>
              @endforeach

              @endif

          @endif
          <!-- End Logic For Displaying Discount Price -->
            
          <p>{{$product->description}}</p>
          <form id="stock_quantity" action="{{ route('landingpage-items.add-to-cart', $product->id) }}" method="POST">
            @csrf
            <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" aria-describedby="stock_quantity" value="1" min="1">
            <!-- <input type="qty" class="form-control" id="1" aria-describedby="quantity" placeholder="1"> -->
            <button type="submit" value="Add To Cart"><i class="fa fa-shopping-bag"></i> ADD TO CART</button>
            <!-- <input type="submit" value="Add To Cart"> -->
            <!-- <button type="submit"><i class="fa fa-shopping-bag"></i> ADD TO CART</button> -->
          </form>
          <ul>
            <li><span>Category:</span> {{$product->productCategories->category_name}}</li>

            <!-- If condition for Fruit and Vegetables Unit Measurement -->
            @if ($product->type === 'Fruit')
              <li><span>Available Quantity:</span> {{$product->stock_quantity}}kg</a></li>
            @elseif ($product->type === 'Vegetables')
              <li><span>Available Quantity:</span> {{$product->stock_quantity}}(bunch/bundle)</a></li>
            @else
              <li><span>Available Quantity:</span> {{$product->stock_quantity}}kg</a></li>
            @endif
          </ul>
        </div>
        <div class="col-lg-12">
          <div class="sep"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="more-info">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                  </li>
                </ul>
              </div>              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                  <p>Quote here.</p>
                  <br>
                  <p>{{$product->description}}</p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                  <p>Coloring book air plant shabby chic, crucifix normcore raclette cred swag artisan activated charcoal. PBR&B fanny pack pok pok gentrify truffaut kitsch helvetica jean shorts edison bulb poutine next level humblebrag la croix adaptogen. <br><br>Hashtag poke literally locavore, beard marfa kogi bruh artisan succulents seitan tonx waistcoat chambray taxidermy. Same cred meggings 3 wolf moon lomo irony cray hell of bitters asymmetrical gluten-free art party raw denim chillwave tousled try-hard succulents street art.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section categories related-games">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>{{$product->product_name}}</h6>
            <h2>Other Pictures Of This Product</h2>
          </div>
        </div>
        <div class="col-lg-6">
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Image 1</h4>
            <div class="thumb">
              <img src="{{ asset('storage/' . $product->image2_url) }}" alt="other_image1">
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Image 2</h4>
            <div class="thumb">
              <img src="{{ asset('storage/' . $product->image3_url) }}" alt="other_image2">
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Image 3</h4>
            <div class="thumb">
              <img src="{{ asset('storage/' . $product->image4_url) }}" alt="other_image3">
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Image 4</h4>
            <div class="thumb">
              <img src="{{ asset('storage/' . $product->image5_url) }}" alt="other_image4">
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
      // Function to update the cart item count
      function updateCartItemCount() {
          // Send an Ajax request to fetch the current cart item count
          $.ajax({
              url: "{{ route('landingpage-items.shop') }}", // Update the route with your actual route
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