@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Discounts')
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
                    
                <form action="{{ route('admin.discounts.store') }}" id="frmDiscount" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_discount_id" class="form-label">Discount Category</label>
                            <select class="form-select" id="category_discount_id" name="category_discount_id">
                                <option value="" selected disabled>Choose a category...</option>
                                @foreach ($discountCategories as $data)
                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id" class="form-label">Product</label>
                            <select class="form-select" id="product_id" name="product_id">
                                <option value="" selected disabled>Choose a product...</option>
                                @foreach ($products as $data)
                                    <option value="{{ $data->id }}">{{ $data->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="percentage" class="form-label">Percentage (1-100)</label>
                            <input type="text" class="form-control" id="percentage" placeholder="Enter the discount percentage (e.g., 10 for 10%)" name="percentage">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="save">Save</button>
                        <a href="{{ route('admin.discounts.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmDiscount")
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
