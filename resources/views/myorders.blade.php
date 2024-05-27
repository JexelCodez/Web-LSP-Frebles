<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach ($orders as $order)
    <section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Reciept</p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Date</p>
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
                        <div class="col-md-8 col-lg-9">
                            <p>{{ $orderDetail->product->product_name }}</p>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <p>Rp{{ number_format($orderDetail->product->price, 0) }}</p>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            @endforeach

            <div class="row my-4">
              <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                <p class="lead fw-bold mb-0" style="color: #f37a27;">Rp{{ number_format($order->total_amount, 0) }}</p>
              </div>
            </div>

            <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>

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

            <p class="mt-4 pt-2 mb-0">Want any help? <a href="{{ route('landingpage-items.contact') }}" style="color: #f37a27;">Please contact
                us</a></p>

                @if (!$order->payment)
                  <a href="{{ route('landingpage-items.payment-form', $order->id) }}" class="btn btn-success mt-2">Select Payment Method</a>
                @endif
          </div>
          
          @if ($order->status == 'Pending COD Payment')
          <a href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order?')">Cancel Order</a>

          @elseif ($order->status == 'In Process')
          <a href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order?')">Cancel Order</a>

          @else
          <button type="button" class="btn btn-danger">Not Allowed</button>
          @endif

        </div>
      </div>
    </div>
  </div>
</section>
@endforeach
</x-app-layout>
