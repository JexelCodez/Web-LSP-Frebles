@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Products')
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

                <form action="{{ route('admin.products.store') }}" id="frmProductCreate" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_category_id" class="form-label">Product's Category</label>
                            <select class="form-select" id="product_category_id" name="product_category_id">
                                <option value="" selected disabled>Choose a category...</option>
                                @foreach ($productCategories as $data)
                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" placeholder="Enter the product name" name="product_name" value="{{ old('product_name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" placeholder="A few things about this product" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="0" name="price" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="stock_quantity">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" placeholder="0" name="stock_quantity" value="{{ old('stock_quantity') }}">
                        </div>
                        <div class="form-group">
                                <label for="image1_url" class="form-label">Image Example 1</label>
                                <input type="file" class="form-control" id="image1_url" name="image1_url">
                            </div>

                            <div class="form-group">
                                <label for="image2_url" class="form-label">Image Example 2</label>
                                <input type="file" class="form-control" id="image2_url" name="image2_url">
                            </div>

                            <div class="form-group">
                                <label for="image3_url" class="form-label">Image Example 3</label>
                                <input type="file" class="form-control" id="image3_url" name="image3_url">
                            </div>

                            <div class="form-group">
                                <label for="image4_url" class="form-label">Image Example 4</label>
                                <input type="file" class="form-control" id="image4_url" name="image4_url">
                            </div>

                            <div class="form-group">
                                <label for="image5_url" class="form-label">Image Example 5</label>
                                <input type="file" class="form-control" id="image5_url" name="image5_url">
                            </div>

                            <div class="form-group">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" placeholder="Fruit or Vegetables?" class="form-control" id="type" name="type">
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" id="save">Save</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <div id="status" style="visibility: hidden;">{{ $status ?? '' }}</div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmProductCreate")
        let productCategory = document.getElementById("product_category_id")
        let prd = document.getElementById("product_name")
        let desc = document.getElementById("description")
        let prc = document.getElementById("price")
        let pic = document.getElementById("image1_url")

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
            } else if(pic.value == "") {
                pic.focus()
                swal("Incomplete data", "At least one picture must be filled!", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
        
    </script>
@endsection
