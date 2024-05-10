@extends('admin.master')
@section('title', 'Edit Delivery')
@section('page', 'Edit Delivery')
@section('main')
    @include('admin.main')

    <!-- Main Page -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">

            @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Frebles Logo -->
                <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

                <div class="card-body">
                    <!-- Cool Tip and SVG -->
                    <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-delivery.svg') }}" alt="Card image cap">

                    <h5 class="card-title">Welcome to Delivery's Edit!</h5>

                    <p class="card-text"><q>My specialties include macaroni and cheese and ordering Chinese-food delivery.</q></p>

                        <form action="{{ route('admin.deliveries.update', $deliveries->id) }}" id="frmDeliveryLogEdit" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="order_id" class="form-label">Order ID</label>
                                    <select class="form-select" id="order_id" name="order_id">
                                        <option value="" selected disabled>Choose an order...</option>
                                        @foreach ($orders as $order)
                                            <<option value="{{ $order->id }}" {{ $deliveries->order_id == $order->id ? 'selected' : '' }}>
                                                ID{{ $order->id }} - Order From: {{ $order->customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="shipping_date">Shipping Date</label>
                                    <input type="datetime-local" class="form-control" id="shipping_date" name="shipping_date" value="{{ $deliveries->shipping_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="tracking_code">Tracking Code</label>
                                    <input type="text" class="form-control" id="tracking_code" name="tracking_code" value="{{ $deliveries->tracking_code }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" value="{{ $deliveries->status }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" id="save">Update</button>
                                <a href="{{ route('admin.deliveries.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmDeliveryLogEdit")
        let order = document.getElementById("order_id")
        let shipping = document.getElementById("shipping_date")
        let code = document.getElementById("tracking_code")
        let sts = document.getElementById("status")

        function save(){
            let pesan = ""
            if(order.value == "") {
                order.focus()
                swal("Incomplete data", "Please choose an order!", "error")
            } else if(shipping.value == "") {
                shipping.focus()
                swal("Incomplete data", "Please fill when the order is going to be shipped!", "error")
            } else if(code.value == "") {
                code.focus()
                swal("Incomplete data", "Please enter the tracking code!", "error")
            } else if(sts.value == "") {
                sts.focus()
                swal("Incomplete data", "Please fill in the status of the delivery", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
        
    </script>
@endsection
