@extends('admin.master')
@section('title', 'Edit Section')
@section('page', 'Edit Product Category')
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
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-product-category.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Product's Category Edit!</h5>

                        <p class="card-text"><q>When the product is right, you don't have to be a great Marketer.</q></p>

                        <form action="{{ route('admin.product-categories.update', $productCategories->id) }}" method="POST" id="frmProductCategoriesCreate">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Product Category's Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $productCategories->category_name }}">
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-default">Cancel</a>
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
        const form = document.getElementById("frmProductCategoriesCreate")
        let categoryName = document.getElementById("category_name")

        function save(){
            let pesan = ""
            if(categoryName.value == ""){
            categoryName.focus()
            swal("Incomplete data", "The product's category name must be filled!", "error")
            } else {
            form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
 </script>
@endsection
