@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Product Reviews')
@section('main')
    @include('admin.main')

    <!-- Form for creating a new product review -->
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

                    <form action="{{ route('product-reviews.store') }}" method="POST" id="frmProductReviewsCreate">
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
                                <label for="product_id" class="form-label">Product</label>
                                <select class="form-select" id="product_id" name="product_id">
                                    <option value="" selected disabled>Choose a product...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rating" class="form-label">Rating (1-10)</label>
                                <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" placeholder="Enter rating">
                            </div>
                            <div class="form-group">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Please tell us what you think about the product ^_^"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="save">Save</button>
                            <a href="{{ route('product-reviews.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmProductReviewsCreate")
        let csm = document.getElementById("customer_id")
        let prd = document.getElementById("product_id")
        let rate = document.getElementById("rating")
        let cmnt = document.getElementById("comment")

        function save(){
            let pesan = ""
            if(csm.value == "") {
                csm.focus()
                swal("Incomplete data", "Please choose a customer!", "error")
            } else if(prd.value == "") {
                prd.focus()
                swal("Incomplete data", "Please choose a product!", "error")
            } else if(rate.value == "") {
                rate.focus()
                swal("Incomplete data", "Rate the product from 1 to 10 ", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
    </script>
@endsection
