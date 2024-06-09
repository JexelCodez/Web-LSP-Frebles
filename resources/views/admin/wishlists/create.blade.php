@extends('admin.master')
@section('title', 'Create Section')
@section('page', 'Create Wishlists')
@section('main')
    @include('admin.main')

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

                    <!-- Frebles Logo -->
                    <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

                    <div class="card-body">
                        <!-- Cool Tip and SVG -->
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-wishlist.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Wishlist!</h5>

                        <p class="card-text"><q>Di sini Anda bisa membuat sebuah harapan atau Anda bisa menjadikannya kenyataan.</q></p>

                    <form action="{{ route('wishlists.store') }}" id="frmWishlistLogCreate" method="POST">
                        @csrf
                        <div class="card-body">

                        <div class="form-group">
                                <label for="customer_id" class="form-label">Nama Customer</label>
                                <select class="form-select" id="customer_id" name="customer_id">
                                    <option value="" selected disabled>Nama Anda...</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
   
                            <div class="form-group">
                                <label for="product_id" class="form-label">Anda ingin simpan produk apa?</label>
                                <select class="form-select" id="product_id" name="product_id">
                                    <option value="" selected disabled>Pilih produk...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" id="save">Simpan</button>
                                <a href="{{ route('landingpage-items.shop') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmWishlistLogCreate")
        let customer = document.getElementById("customer_id")
        let prd = document.getElementById("product_id")

        function save(){
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
