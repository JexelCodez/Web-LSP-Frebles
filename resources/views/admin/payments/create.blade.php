@extends('admin.master')
@section('title', 'Create Payments')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Payments')
@section('main')
    @include('admin.main')

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
                    
                    <div class="card-header">
                        <h5 class="card-title">Create Payment</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payments.store') }}" id="frmPaymentsCreateLog" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="order_id" class="form-label">Order ID</label>
                                <select class="form-select" id="order_id" name="order_id">
                                    <option value="" selected disabled>Choose an order...</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}">{{ $order->id }} - Customer: {{ $order->customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="datetime-local" class="form-control" id="payment_date" name="payment_date">
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <input type="text" class="form-control" id="payment_method" name="payment_method">
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="save">Save</button>
                                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="psn" class="form-control" value="{{ $pesan ?? '' }}" />

    <script>
       const btnSave = document.getElementById("save")
        const form = document.getElementById("frmPaymentsCreateLog")
        let order = document.getElementById("order_id")
        let payDate = document.getElementById("payment_date")
        let payMethod = document.getElementById("payment_method")
        let amnt = document.getElementById("amount")

        function save(){
            let pesan = ""
            if(order.value == "") {
                order.focus()
                swal("Incomplete data", "Please choose an order!", "error")
            } else if(payDate.value == "") {
                payDate.focus()
                swal("Incomplete data", "Please fill when the customer payed!", "error")
            } else if(payMethod.value == "") {
                payMethod.focus()
                swal("Incomplete data", "Fill in the payment method!", "error")
            } else if(amnt.value == "") {
                amnt.focus()
                swal("Incomplete data", "How much did the customer pay?", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
    </script>
@endsection
