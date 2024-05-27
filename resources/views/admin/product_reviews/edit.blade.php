@extends('admin.master')
@section('title', 'Edit Product Review')
@section('page', 'Edit Product Review')
@section('main')
    @include('admin.main')

    <!-- Form for editing an existing product review -->
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
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-product-review.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Product Review's Edit!</h5>

                        <p class="card-text"><q>Review is essential to evaluation, which is essential to progress.</q></p>

                        <form action="{{ route('product-reviews.update', $productReviews->id) }}" method="POST" id="frmProductReviewsEdit">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select class="form-select" id="customer_id" name="customer_id">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ $customer->id == $productReviews->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_id" class="form-label">Product</label>
                                    <select class="form-select" id="product_id" name="product_id">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ $product->id == $productReviews->product_id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rating" class="form-label">Rating (1-10)</label>
                                    <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" value="{{ $productReviews->rating }}">
                                </div>
                                <div class="form-group">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3">{{ $productReviews->comment }}</textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('product-reviews.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Inputs for Status and Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmProductReviewsEdit")
        let csm = document.getElementById("customer_id")
        let prd = document.getElementById("product_id")
        let rate = document.getElementById("rating")
        let cmnt = document.getElementById("comment")

        function save(){
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
