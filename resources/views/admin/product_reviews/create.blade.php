@extends('admin.master')
@section('title', 'Create Section')
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

                    <!-- Frebles Logo -->
                    <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

                    <div class="card-body">
                        <!-- Cool Tip and SVG -->
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-product-review.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Helo! Jangan ragu untuk memberikan komentar apapun!</h5>

                        <p class="card-text"><q>Ulasan adalah penting untuk evaluasi, yang merupakan kunci kemajuan.</q></p>

                        <form action="{{ route('product-reviews.store') }}" method="POST" id="frmProductReviewsCreate">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $customer->name }}" readonly>
                                    <input type="hidden" id="customer_id" name="customer_id" value="{{ $customer->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="product_id" class="form-label">Produk</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" readonly>
                                    <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                </div>

                                <div class="form-group">
                                    <label for="comment" class="form-label">Komen</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Bila boleh, tolong beritahu kami tanggapan Anda mengenai produk ini ^_^"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="rating" class="form-label rating-title">Rating</label>
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">&#9733;</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">&#9733;</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">&#9733;</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">&#9733;</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">&#9733;</label>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" id="save">Simpan</button>
                                <a href="{{ route('landingpage-items.shop') }}" class="btn btn-default">Batal</a>
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
        const btnSave = document.getElementById("save");
        const form = document.getElementById("frmProductReviewsCreate");
        let csm = document.getElementById("customer_id");
        let prd = document.getElementById("product_id");
        let rate = document.getElementById("rating");
        let cmnt = document.getElementById("comment");

        function save(){
            if(csm.value == "") {
                csm.focus();
                swal("Incomplete data", "Please choose a customer!", "error");
            } else if(prd.value == "") {
                prd.focus();
                swal("Incomplete data", "Please choose a product!", "error");
            } else {
                form.submit();
            }
        }

        btnSave.onclick = function(){
            save();
        }
    </script>
@endsection
