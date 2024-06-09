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
    .bg-dark {
      border-radius: 0.45rem; /* Adjust the value as needed */
    }

    .text-white {
      color: white;
    }

  </style>
  
</head>

<body>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-light fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="bi bi-x-lg p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('landingpage') }}" target="_blank" onclick="highlightNavItem(this)">
        <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-dark">Frebles</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="navbar-nav">
      <ul class="navbar-nav">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-4 mt-4 text-dark">Management</h6>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('owner/dashboard') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-house-door-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('owner/vendors') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-inboxes-fill text-secondary"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Vendors</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('owner/orders') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-clipboard2-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Orders</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('owner/customers') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-check-fill text-primary"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Customers</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('owner/users') }}" onclick="highlightNavItem(this)">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-people-fill text-warning"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Users</span>
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
        link.classList.add("bg-dark");
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
