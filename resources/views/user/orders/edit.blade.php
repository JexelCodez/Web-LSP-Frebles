@extends('admin.master')
@section('title', 'Edit Section')
@section('page', 'Edit Order')
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
                            <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-order.svg') }}" alt="Card image cap">

                            <h5 class="card-title">Welcome to Order's Edit!</h5>

                            <p class="card-text"><q>I love ordering things online because when they arrive it's like a present from me to me.</q></p>

                            <form action="{{ route('orders.update', $orders->id) }}" method="POST" id="frmOrderEdit">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="customer_id" class="form-label">Customer</label>
                                        <select class="form-select" id="customer_id" name="customer_id">
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $orders->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="order_date" class="form-label">Order Date</label>
                                        <input type="datetime-local" class="form-control" id="order_date" name="order_date" value="{{ $orders->order_date }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_amount" class="form-label">Total Amount</label>
                                        <input type="number" class="form-control" id="total_amount" name="total_amount" value="{{ $orders->total_amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" value="{{ $orders->status }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmOrderEdit")
        let csm = document.getElementById("customer_id")
        let ordate = document.getElementById("order_date")
        let amount = document.getElementById("total_amount")
        let sts = document.getElementById("status")

        function save(){
            let pesan = ""
            if(csm.value == "") {
                csm.focus()
                swal("Incomplete data", "Please choose a customer!", "error")
            } else if(ordate.value == "") {
                ordate.focus()
                swal("Incomplete data", "Please fill when the customer ordered!", "error")
            } else if(amount.value == "") {
                amount.focus()
                swal("Incomplete data", "Please fill how much did the customer order!", "error")
            } else if(sts.value == "") {
                sts.focus()
                swal("Incomplete data", "Must fill the status of the order!", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
        
    </script>

@endsection
