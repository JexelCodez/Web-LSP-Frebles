@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Deliveries')
@section('main')
    @include('admin.main')

    <!-- Form -->
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
                
                <form action="{{ route('admin.deliveries.store') }}" id="frmDeliveryLogCreate" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="order_id" class="form-label">Order ID</label>
                            <select class="form-select" id="order_id" name="order_id">
                                <option value="" selected disabled>Choose an order...</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">ID{{ $order->id }} - Order From: {{ $order->customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shipping_date">Shipping Date</label>
                            <input type="datetime-local" class="form-control" id="shipping_date" name="shipping_date">
                        </div>
                        <div class="form-group">
                            <label for="tracking_code">Tracking Code</label>
                            <input type="text" class="form-control" id="tracking_code" name="tracking_code" placeholder="Enter the tracking code">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="Enter the status">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="save">Save</button>
                        <a href="{{ route('admin.deliveries.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmDeliveryLogCreate")
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
