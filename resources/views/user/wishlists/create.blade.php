@extends('user.master')
@section('title', 'Create Section')
@section('nav')
    @include('user.nav')
@endsection
@section('page', 'Create Wishlists')
@section('main')
    @include('user.main')

    <!--  Tabel -->
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

                    <form action="{{ route('wishlists.store') }}" id="frmWishlistLogCreate" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="customer_id" class="form-label">Customer's Name</label>
                                <select class="form-select" id="customer_id" name="customer_id">
                                    <option value="" selected disabled>Choose a customer...</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id" class="form-label">Product's Name</label>
                                <select class="form-select" id="product_id" name="product_id">
                                    <option value="" selected disabled>Choose a product...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" id="save">Save</button>
                                <a href="{{ route('wishlists.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="psn" class="form-control" value="{{ $pesan ?? '' }}" />

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmWishlistLogCreate")
        let customer = document.getElementById("customer_id")
        let prd = document.getElementById("product_id")

        function save(){
            let pesan = ""
            if(customer.value == "") {
                customer.focus()
                swal("Incomplete data", "Please choose a customer!", "error")
            } else if(prd.value == "") {
                prd.focus()
                swal("Incomplete data", "Please choose a product!", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
        
    </script>
@endsection
