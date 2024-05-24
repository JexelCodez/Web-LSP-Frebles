@extends('admin.master')
@section('title', 'Edit Section')
@section('page', 'Edit Discount Category')
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
                        <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-discount-category.svg') }}" alt="Card image cap">

                        <h5 class="card-title">Welcome to Discount Category's Edit!</h5>

                        <p class="card-text"><q>Friends will ask for discount prices. True friends will pay full price, to support you, your time and your work.</q></p>

                        <form action="{{ route('admin.discount-categories.update', $discountCategories->id) }}" method="POST" id="frmDiscountCategoriesEdit">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Discount Category's Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $discountCategories->category_name }}">
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('admin.discount-categories.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Input Fields for Status and Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

    <script>

        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmDiscountCategoriesEdit")
        let cname = document.getElementById("category_name")
        
        function store(){
        if (cname.value == ""){
            cname.focus()
            swal("Incomplete data", "The discount's category name must be filled!", "error")
        }  else {
            form.submit()
        }
    }
        
    btnSave.onclick = function(){
        store()
    }
    </script>
@endsection
