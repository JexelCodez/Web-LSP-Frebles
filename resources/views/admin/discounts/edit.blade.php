@extends('admin.master')
@section('title', 'Edit Section')
@section('page', 'Edit Discount')
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
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-discount.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Discount's Edit!</h5>

                        <p class="card-text"><q>Success is never on discount! Greatness is never on sale! Greatness is never half off! It's all or nothing! It's all day, every day!</q></p>

                        <form action="{{ route('admin.discounts.update', $discounts->id) }}" method="POST" id="frmDiscountEdit">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_discount_id" class="form-label">Discount Category</label>
                                    <select class="form-select" id="category_discount_id" name="category_discount_id">
                                        @foreach ($discountCategories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $discounts->category_discount_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_id" class="form-label">Product</label>
                                    <select class="form-select" id="product_id" name="product_id">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ $product->id == $discounts->product_id ? 'selected' : '' }}>
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ $discounts->start_date }}">
                                </div>

                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ $discounts->end_date }}">
                                </div>

                                <div class="form-group">
                                    <label for="percentage" class="form-label">Percentage (decimal)</label>
                                    <input type="text" class="form-control" id="percentage" name="percentage" value="{{ $discounts->percentage }}">
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('admin.discounts.index') }}" class="btn btn-default">Cancel</a>
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
        const form = document.getElementById("frmDiscountEdit")
        let discountCategory = document.getElementById("category_discount_id")
        let prd = document.getElementById("product_id")
        let stdate = document.getElementById("start_date")
        let endate = document.getElementById("end_date")
        let prc = document.getElementById("percentage")

        function save(){
            let pesan = ""
            if(discountCategory.value == "") {
                discountCategory.focus()
                swal("Incomplete data", "Please choose a category!", "error")
            } else if(prd.value == "") {
                prd.focus()
                swal("Incomplete data", "Please choose a product to be discounted", "error")
            } else if(stdate.value == "") {
                stdate.focus()
                swal("Incomplete data", "Start date for the discount must be filled!", "error")
            } else if(endate.value == "") {
                endate.focus()
                swal("Incomplete data", "End date for the discount must be filled!", "error")
            } else if(prc.value == "") {
                prc.focus()
                swal("Incomplete data", "Please fill the percentage of discount, note in decimal format!", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
        
    </script>
@endsection
