@extends('admin.master')
@section('title', 'Frebles')
@section('page', 'Edit')
@section('main')
    @include('admin.main')

    <link rel="stylesheet" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}">

    <!-- Main page -->

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
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-product.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Products Edit!</h5>

                        <p class="card-text"><q>a product is something made in a factory; a brand is something that is bought by the customer. A product can be copied by a competitor; a brand is unique. A product can be quickly outdated; a successful brand is timeless.</q></p>
                        
                        <form action="{{ route('admin.products.update', $products->id) }}" method="POST" id="frmProductEdit" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_category_id" class="form-label">Product's Category</label>
                                    <select class="form-select" id="product_category_id" name="product_category_id">
                                        <option value="" selected disabled>Choose a category...</option>
                                        @foreach ($productCategories as $data)
                                            <option value="{{ $data->id }}" {{ $products->product_category_id == $data->id ? 'selected' : '' }}>{{ $data->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" placeholder="Enter the product name" name="product_name" value="{{ $products->product_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3" placeholder="A few things about this product" name="description">{{ $products->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" placeholder="0.00" name="price" value="{{ $products->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="stock_quantity">Stock Quantity</label>
                                    <input type="number" class="form-control" id="stock_quantity" placeholder="Enter stock" name="stock_quantity" value="{{ $products->stock_quantity }}">
                                </div>
                                <div class="form-group">
                                    <label for="image1_url" class="form-label">Image Example 1</label>
                                    <img src="{{ asset('storage/' . $products->image1_url) }}" class="img-thumbnail d-block" alt="Image 1" width="150">
                                    <input type="file" class="form-control" id="image1_url" name="image1_url">
                                </div>

                                <div class="form-group">
                                    <label for="image2_url" class="form-label">Image Example 2</label>
                                    <img src="{{ asset('storage/' . $products->image2_url) }}" class="img-thumbnail d-block" alt="Image 2" width="150">
                                    <input type="file" class="form-control" id="image2_url" name="image2_url">
                                </div>

                                <div class="form-group">
                                    <label for="image3_url" class="form-label">Image Example 3</label>
                                    <img src="{{ asset('storage/' . $products->image3_url) }}" class="img-thumbnail d-block" alt="Image 3" width="150">
                                    <input type="file" class="form-control" id="image3_url" name="image3_url">
                                </div>

                                <div class="form-group">
                                    <label for="image4_url" class="form-label">Image Example 4</label>
                                    <img src="{{ asset('storage/' . $products->image4_url) }}" class="img-thumbnail d-block" alt="Image 4" width="150">
                                    <input type="file" class="form-control" id="image4_url" name="image4_url">
                                </div>

                                <div class="form-group">
                                    <label for="image5_url" class="form-label">Image Example 5</label>
                                    <img src="{{ asset('storage/' . $products->image5_url) }}" class="img-thumbnail d-block" alt="Image 5" width="150">
                                    <input type="file" class="form-control" id="image5_url" name="image5_url">
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{ $products->type }}">
                                </div>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="status" style="visibility: hidden;">{{ $status ?? '' }}</div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmProductEdit")
        let productCategory = document.getElementById("product_category_id")
        let prd = document.getElementById("product_name")
        let desc = document.getElementById("description")
        let prc = document.getElementById("price")


        function save(){
            let pesan = ""
            if(productCategory.value == "") {
                productCategory.focus()
                swal("Incomplete data", "Please choose a the product's category", "error")
            } else if(prd.value == "") {
                prd.focus()
                swal("Incomplete data", "The product name must be filled!", "error")
            } else if(desc.value == "") {
                desc.focus()
                swal("Incomplete data", "Description must be filled!", "error")
            } else if(prc.value == "") {
                prc.focus()
                swal("Incomplete data", "Please set a price!", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }

    </script>

@endsection
