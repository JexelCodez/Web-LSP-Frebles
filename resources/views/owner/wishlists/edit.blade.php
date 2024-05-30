@extends('user.master')
@section('title', 'Frebles')
@section('page', 'Edit')
@section('main')
    @include('user.main')

    <!-- Edit Form -->
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
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-wishlist.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Wishlist's Edit!</h5>

                        <p class="card-text"><q>You could make a wish or you could make it happen.</q></p>

                            <form action="{{ route('wishlists.update', $wishlists->id) }}" id="frmWishlistLogEdit" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="customer_id" class="form-label">Customer's Name</label>
                                        <select class="form-select" id="customer_id" name="customer_id">
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" @if ($customer->id == $wishlists->customer_id) selected @endif>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_id" class="form-label">Product's Name</label>
                                        <select class="form-select" id="product_id" name="product_id">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" @if ($product->id == $wishlists->product_id) selected @endif>{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" id="save">Update</button>
                                        <a href="{{ route('wishlists.index') }}" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmWishlistLogEdit")
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
