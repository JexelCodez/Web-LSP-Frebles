<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}">

  <!-- Soft UI Template -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
  
  <!-- Bootstrap Icons Library -->
  <link href="{{ asset('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

  <style>
    .bg-white {
      border-radius: 0.45rem; /* Adjust the value as needed */
    }
  </style>
  
</head>

<body>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-gradient-dark fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="bi bi-x-lg p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('landingpage') }}" target="_blank" onclick="highlightNavItem(this)">
        <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-light">Frebles</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="navbar-nav">
      <ul class="navbar-nav">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-4 mt-4 text-light">Management</h6>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/dashboard') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-house-door-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/products') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-box-seam-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/product-categories') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-boxes text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Product Categories</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.index') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-check-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Customers</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/users') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-people-fill text-warning"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>

        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-4 mt-4 text-light">Order and Deliveries</h6>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/orders') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-clipboard2-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/order_details') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-receipt text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Order Details</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/deliveries') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-truck text-warning"></i>
            </div>
            <span class="nav-link-text ms-1">Deliveries</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/payments') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-credit-card-fill text-success"></i>
            </div>
            <span class="nav-link-text ms-1">Payments</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/discounts') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-tag text-danger"></i>
            </div>
            <span class="nav-link-text ms-1">Discount</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/discount-categories') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-tags text-danger"></i>
            </div>
            <span class="nav-link-text ms-1">Discount Categories</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <!-- Focusing when on load and active color -->
  <script>
  function markActiveLinkAndScroll() {
    document.querySelectorAll(".nav-link").forEach((link) => {
      if (link.href === window.location.href) {
        link.classList.add("bg-white");
        link.setAttribute("aria-current", "page");
        link.scrollIntoView();
      }
    });
  }

  function highlightNavItem(clickedItem) {
    document.querySelectorAll('.nav-item').forEach(function(navItem) {
      navItem.classList.remove('active');
    });
    clickedItem.closest('.nav-item').classList.add('active');
  }

  window.addEventListener("load", markActiveLinkAndScroll);
</script>


</body>
</html>
