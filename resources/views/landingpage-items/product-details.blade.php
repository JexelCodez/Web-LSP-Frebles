<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Frebles - Detail Produk</title>

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
                      <li><a href="{{ route('landingpage') }}">Frebles</a></li>
                      <li><a href="{{ route('landingpage-items.shop') }}">Belanja</a></li>
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
          <h3>LANJUT KEBAWAH</h3>
          <span class="breadcrumb"><a href="{{ route('landingpage') }}">Frebles</a>  >  <a href="{{ route('landingpage-items.shop') }}">Belanja</a>  >  {{$product->product_name}}</span>
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
              @foreach ($product->discounts as $discount)

                  @if ($product->type === 'Fruit')
                      <span class="badge bg-info"><em>{{ $discount->discountCategory->category_name }}</em></span>
                      <span class="price"><em>Rp{{ number_format($product->price, 0) }}/kg</em></span>
                      <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage / 100), 0) }}/kg</span>

                  @elseif ($product->type === 'Vegetables')
                      <span class="badge bg-info"><em>{{ $discount->discountCategory->category_name }}</em></span>
                      <span class="price"><em>Rp{{ number_format($product->price, 0) }}/bunch</em></span>
                      <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage / 100), 0) }}/ikat</span>

                  @else
                      <span class="badge bg-info"><em>{{ $discount->discountCategory->category_name }}</em></span>
                      <span class="price"><em>Rp{{ number_format($product->price, 0) }}/kg</em></span>
                      <span class="discounted-price">Rp{{ number_format($product->price - ($product->price * $discount->percentage / 100), 0) }}/kg</span>
                  @endif
              @endforeach
              
          @else
              @if ($product->type === 'Fruit')
                  <span class="price">Rp{{ number_format($product->price, 0) }}/kg</span>

              @elseif ($product->type === 'Vegetables')
                  <span class="price">Rp{{ number_format($product->price, 0) }}/ikat</span>
                  
              @else
                  <span class="price">Rp{{ number_format($product->price, 0) }}/kg</span>
              @endif
          @endif
          <!-- End Logic For Displaying Discount Price -->

            
          <p>{{$product->description}}</p>
          <form id="stock_quantity" action="{{ route('landingpage-items.add-to-cart', $product->id) }}" method="POST">
            @csrf
            <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" aria-describedby="stock_quantity" value="1" min="1">
            <button type="submit" value="Add To Cart"><i class="fa fa-shopping-bag"></i> MASUK KERANJANG</button>
          </form>
          <ul>
            <li><span>Di Jual Oleh Vendor:</span> {{$product->vendor->name}}</li>
            <li><span>Kategori:</span> {{$product->productCategories->category_name}}</li>

            <!-- If condition for Fruit and Vegetables Unit Measurement -->
            @if ($product->type === 'Fruit')
              <li><span>Stok:</span> {{$product->stock_quantity}}kg</a></li>
            @elseif ($product->type === 'Vegetables')
              <li><span>Stok:</span> {{$product->stock_quantity}}(ikat/gulung)</a></li>
            @else
              <li><span>Stok:</span> {{$product->stock_quantity}}kg</a></li>
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
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Deskripsi</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Review Pelanggan</button>
                  </li>
                </ul>
              </div>              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                  <p>{{$product->description}}</p>
                  <br>
                  <p>{{$randomQuote}}</p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                  @foreach ($reviews as $review)
                  <p>{{ $review->comment }}</p>
                  <br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Other Products -->
  <div class="section categories related-games">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <a href="{{ route('landingpage-items.shop') }}" class="btn btn-success">Kembali Ke Frebles</a>
                    <h2>Produk Lainnya</h2>
                </div>
            </div>
            <div class="col-lg-6">
            </div>

            @foreach ($productsAll as $products)
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>{{ $products->product_name }}</h4>
                        <div class="thumb">
                            <a href="{{ route('landingpage-items.product-details', $products->id) }}">
                            <img src="{{ asset('storage/' . $products->image1_url) }}" alt="other_image1">
                            </a>
                        </div>
                    </div>
                </div>
                @if($product->image2_url)
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>{{ $products->product_name }}</h4>
                        <div class="thumb">
                            <a href="{{ route('landingpage-items.product-details', $products->id) }}">
                            <img src="{{ asset('storage/' . $products->image2_url) }}" alt="other_image2">
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @if($product->image3_url)
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>{{ $products->product_name }}</h4>
                        <div class="thumb">
                            <a href="{{ route('landingpage-items.product-details', $products->id) }}">
                            <img src="{{ asset('storage/' . $products->image3_url) }}" alt="other_image3">
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @if($product->image4_url)
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>{{ $products->product_name }}</h4>
                        <div class="thumb">
                            <a href="{{ route('landingpage-items.product-details', $products->id) }}">
                            <img src="{{ asset('storage/' . $products->image4_url) }}" alt="other_image4">
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @if($product->image5_url)
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>{{ $products->product_name }}</h4>
                        <div class="thumb">
                            <a href="{{ route('landingpage-items.product-details', $products->id) }}">
                            <img src="{{ asset('storage/' . $products->image5_url) }}" alt="other_image5">
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
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
  
  </body>
</html>