@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Orders')
@section('main')
    @include('admin.main')

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
                    
                <form action="{{ route('admin.orders.store') }}" id="frmOrderCreate" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select class="form-select" id="customer_id" name="customer_id">
                                <option value="" selected disabled>Choose a customer...</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order_date">Order Date</label>
                            <input type="datetime-local" class="form-control" id="order_date" name="order_date">
                        </div>
                        <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Enter the total amount">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="Enter status">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="save">Save</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmOrderCreate")
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
