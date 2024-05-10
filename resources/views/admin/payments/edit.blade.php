@extends('admin.master')
@section('title', 'Edit Payment')
@section('page', 'Edit Payment')
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

                    <!-- Frebles Logo -->
                    <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

                    <div class="card-body">
                        <!-- Cool Tip and SVG -->
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-payment.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Payment's Edit!</h5>

                        <p class="card-text"><q>Your life undeniably revolves around the way you are paid. Believe it or not, the key to reinventing yourself is reinventing how you get paid.</q></p>

                    
                        <form action="{{ route('admin.payments.update', $payments->id) }}" id="frmPaymentEditLog" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="order_id" class="form-label">Order ID</label>
                                    <select class="form-select" id="order_id" name="order_id">
                                        <option value="" selected disabled>Choose an order...</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}" {{ $order->id == $payments->order_id ? 'selected' : '' }}>
                                                ID{{ $order->id }} - Order From: {{ $order->customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_date" class="form-label">Payment Date</label>
                                    <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" value="{{ $payments->payment_date }}">
                                </div>
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $payments->payment_method }}">
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" value="{{ $payments->amount }}">
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="psn" class="form-control" value="{{ $message ?? '' }}" />

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmPaymentEditLog")
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
