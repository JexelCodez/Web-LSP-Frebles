<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frebles - Invoice</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Include SweetAlert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <!-- Include SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Include Font Awesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

        <!-- Bootstrap icon library  -->
        <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

        <!-- Link to CSS file -->
        <link rel="stylesheet" href="{{ asset('landingpage/assets/css/myorders.css') }}">
</head>
<body>

<section class="h-100 h-custom" style="background-color: #eee;">

    <a href="{{ route('landingpage') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Frebles</a>
    <a href="{{ route('landingpage-items.shop') }}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Kembali</a>

    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
            <div class="card-body p-5">

              <p class="lead fw-bold mb-5" style="color: #f37a27;">Tanda Terima Pembelian pada {{ \Illuminate\Support\Carbon::parse($order->order_date)->format('F j, Y') }}</p>

              <div class="row">
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Detail Waktu</p>
                  <p>{{ $order->order_date }}</p>
                </div>
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Order No.</p>
                  <p>{{ $order->id }}</p>
                </div>
              </div>
              
              @foreach ($order->orderDetails as $orderDetail)
                  <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                      <div class="row">
                          <div class="col-md-5 col-lg-5">
                              <p>{{ $orderDetail->product->product_name }}</p>
                          </div>
                          <div class="col-md-2 col-lg-2">
                              <p>{{ $orderDetail->quantity }}</p>
                          </div>
                          <div class="col-md-5 col-lg-5">
                              <p>Rp{{ number_format($orderDetail->subtotal, 0) }}</p>
                          </div>
                          <p>Dijual Oleh : {{ $orderDetail->product->vendor->name }}</p>
                      </div>
                      <hr>
                      <div class="row">
                      </div>
                  </div>
              @endforeach

              <div class="row my-4">
                <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                  <p class="lead fw-bold mb-0" style="color: #f37a27;">Rp{{ number_format($order->total_amount, 0) }}</p>
                </div>
              </div>

              <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Status Orderan</p>

              <div class="row">
                <div class="col-lg-12">

                  <div class="horizontal-timeline">

                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">{{ $order->status }}</p
                          class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                      </li>
                    </ul>

                  </div>

                </div>
              </div>

              <p class="mt-4 pt-2 mb-0">Perlu bantuan? <a href="{{ route('landingpage-items.contact') }}" style="color: #f37a27;">Bisa hubungi kami</a></p>
              <p class="mt-5">Jangan lupa untuk <strong>simpan bukti</strong> ini dalam bentuk screenshot ataupun media lainnya.</p>         
            </div>
            
            @if ($order->status == 'Canceled')
                <p class="ms-3">Order telah dibatalkan. Terima kasih telah berbelanja bersama kami!</p>
                <button type="button" class="btn btn-success">Berhasil Dibatalkan</button>
            @else
                @if (!$order->payment)
                    <p class="ms-3">Sepertinya Anda belum memilih metode pembayaran untuk orderan ini..</p>
                    <a href="{{ route('landingpage-items.payment-form', $order->id) }}" class="btn btn-success mt-2">Pilih Metode Pembayaran</a>
                @endif
                @if ($order->status == 'Pending COD Payment' || $order->status == 'In Process')
                    <a href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger" onclick="return confirm('Anda akan membatalkan order?')">Batalkan Order</a>
                @endif
            @endif

          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>