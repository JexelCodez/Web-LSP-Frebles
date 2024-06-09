<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Order') }}
        </h2>
        <h6 class="text-s text-gray-800 leading-tight">Cek secara berkala, status ORDERAN Anda dan status PENGIRIMAN Anda.</h6>
    </x-slot>

    <!-- Search Input -->
    <div class="search-input d-flex justify-content-center">
      <form action="{{ route('searchMyOrders') }}" class="d-flex" method="GET">
        <input type="text" placeholder="Cari status order" id="search" name="search" class="form-control mt-5 mb-3" />
        <button type="submit" class="btn btn-primary mt-5 mb-3" value="search">Cari</button>
      </form>
    </div>

    @if ($orders->isNotEmpty())
      @foreach ($orders as $order)
      <section class="h-100 h-custom" style="background-color: #eee;">

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
            </div>
            
            @if ($order->status == 'Dibatalkan')
                <p class="ms-3">Order telah dibatalkan. Terima kasih telah berbelanja bersama kami!</p>
                <button type="button" class="btn btn-success">Berhasil Dibatalkan</button>
            @else
                @if (!$order->payment)
                    <p class="ms-3">Sepertinya Anda belum memilih metode pembayaran untuk orderan ini..</p>
                    <a href="{{ route('landingpage-items.payment-form', $order->id) }}" class="btn btn-success mt-2">Pilih Metode Pembayaran</a>
                @endif
                @if ($order->status == 'Pending COD Payment' || $order->status == 'Dalam Proses')
                    <a href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger" onclick="return confirm('Anda akan membatalkan order ini?')">Batalkan Order</a>
                @endif
            @endif

          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach
@else
  <p class="text-center p-3 bg-light border rounded shadow-sm">Order tidak ditemukan.</p>
@endif
</x-app-layout>
