@extends('admin.master')
@section('title', 'Main Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Product Categories')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <a href="{{ route('admin.product-categories.create') }}" class="btn btn-info mb-2">Add Category</a>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Search Bar -->
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>PRODUCT CATEGORIES</h6>
                            <form action="{{ url('search_admin_product_categories') }}" method="GET" class="input-group" style="max-width: 300px;">
                                @csrf
                                <input type="text" name="search" class="form-control" placeholder="Search a category...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- End of Search Bar -->

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productCategories as $index => $productCategory)
                                        <tr>
                                            <td>{{ $index + 1 . ". "}}</td>
                                            <td>{{ $productCategory->category_name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.product-categories.edit', $productCategory->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('admin.product-categories.destroy', $productCategory->id) }}" method="POST" style="display: inline;" id="frmDeleteProductCategories{{ $productCategory->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteProductCategory( '{{ $productCategory->id }}' )">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Input Fields for Status and Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />
    
    <!-- Success Message Update -->
    <script>
        const masterBody = document.getElementById("master");
        const sts = document.getElementById("sts");
        const msg = document.getElementById("msg");

        function saveMessage() {
            if (sts.value == "save") {
                swal('Good job!', msg.value, 'success');
            }
        }

        masterBody.onload = function() {
            saveMessage();
        };
    </script>
    
    <!-- Delete Messages -->
    <script>
        function deleteProductCategory(id) {
            const form = document.getElementById('frmDeleteProductCategories' + id);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    form.submit();
                    swal("Deleted", "Data has been successfully deleted!", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            });
        }
    </script>
@endsection
