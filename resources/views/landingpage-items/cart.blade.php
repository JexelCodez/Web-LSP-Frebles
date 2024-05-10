<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Link to CSS file -->
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/cart.css') }}">
    <!-- Frebles Logo Link -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">
    <!-- Bootstrap Icons Library -->
    <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <title>Frebles - Cart</title>
</head>
<body>
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="{{ route('landingpage-items.shop') }}" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have 4 items in your cart</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
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
                        <div style="width: 80px;">
                          <h5 class="mb-0">${{ number_format($cart->price, 2) }}</h5>
                        </div>
                        <!-- Make a link with red color trash can logo -->
                        <a href="{{ route('landingpage-items.remove-from-cart', $cart->id) }}" onclick="return confirm('Are you sure to remove this product?')"><i class="bi bi-trash-fill text-danger"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                <!-- <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img2.webp"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5>Samsung galaxy Note 10 </h5>
                          <p class="small mb-0">256GB, Navy Blue</p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0">2</h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">$900</h5>
                        </div>
                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img3.webp"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5>Canon EOS M50</h5>
                          <p class="small mb-0">Onyx Black</p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0">1</h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">$1199</h5>
                        </div>
                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div> -->

                <!-- <div class="card mb-3 mb-lg-0">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img4.webp"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5>MacBook Pro</h5>
                          <p class="small mb-0">1TB, Graphite</p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0">1</h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">$1799</h5>
                        </div>
                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>

              <div class="col-lg-5">
                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">CUSTOMER DETAILS</h5>
                      <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                        class="img-fluid rounded-3" style="width: 45px;" alt="Avatar"> -->
                        <i class="bi bi-person-check h1"></i>
                    </div>

                      <div class="mb-4">
                        <label class="form-label" for="typeText">Customer's Name</label>
                        <div>{{ $customers->name }}</div>
                      </div>

                    <form class="mt-4">

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Customer's Email</label>
                        <div>{{ $customers->email }}</div>
                      </div>
                      
                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Customer's Number</label>
                        <div>{{ $customers->phone }}</div>
                      </div>

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Customer's Address 1</label>
                        <div>{{ $customers->address1 }}</div>
                      </div>

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Customer's Address 2 (Optional)</label>
                        <div>{{ $customers->address2 }}</div>
                      </div>

                      <hr class="my-4">
                      <div class="mb-4">
                        <label class="form-label" for="typeText">Customer's Address 3 (Optional)</label>
                        <div>{{ $customers->address3 }}</div>
                      </div>

                    </form>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2">${{ number_format($total_price, 2) }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2">Free</p>
                    </div>

                    <!-- <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2">$0</p>
                    </div> -->
                    <p class="mb-2">Proceed to order...</p>
                    <a href="{{ url('cartOrder') }}" class="btn btn-info btn-block btn-lg mt-3" onclick="return confirm('Are you sure you want to Order?')">
                      <i class="bi bi-box2"></i>
                      <span class="ms-auto">Order Now</span>
                    </a>
                    <!-- <a href="{{ route('landingpage-items.payment-form') }}" class="btn btn-info btn-block btn-lg mt-3">
                      <i class="bi bi-credit-card-fill"></i>
                      <span class="ms-auto">Pay Using Card</span>
                    </a> -->
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
<!-- Bootstrap core JS -->
<script src="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.js') }}"></script>
</body>
</html>