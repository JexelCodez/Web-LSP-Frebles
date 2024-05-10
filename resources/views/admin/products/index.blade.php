@extends('admin.master')
@section('title', 'Products')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Products Section')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <a href="{{ route('admin.products.create') }}" class="btn btn-info mb-2">Add Product</a>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

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
                    
                    <div class="card-header pb-0">
                        <h6>PRODUCTS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Quantity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 3</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 4</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 5</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 . ". "}}</td>
                                            <td class="text-center">{{ $product->category_name }}</td>

                                            <!-- Bootstrap Tooltip If String Exceeds A Certain Length -->
                                            @if (strlen($product->product_name) > 18)
                                                <td data-toggle="tooltip" data-placement="top" title="{{ $product->product_name }}">
                                                {{ substr($product->product_name, 0, 18) . '...' }}
                                                </td>
                                            @else 
                                                <td class="text-center">{{ $product->product_name }}</td>
                                            @endif
                                            <!-- End Tooltip -->

                                            <!-- Bootstrap Tooltip If String Exceeds A Certain Length -->
                                            @if (strlen($product->description) > 18)
                                                <td data-toggle="tooltip" data-placement="top" title="{{ $product->description }}">
                                                {{ substr($product->description, 0, 18) . '...' }}
                                                </td>
                                            @else 
                                                <td class="text-center">{{ $product->description }}</td>
                                            @endif
                                            <!-- End Tooltip -->

                                            <td class="text-center">${{ $product->price }}</td>
                                            <td class="text-center">{{ $product->stock_quantity }}</td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image1_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto1_{{ $product->image1_url }}"></td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image2_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto2_{{ $product->image2_url }}"></td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image3_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto3_{{ $product->image3_url }}"></td>

                                            <!-- <td><img src="{{ asset('storage/' . $product->image1_url) }}" class="img-thumbnail"></td> -->
                                            <!-- <td><img src="{{ asset('storage/' . $product->image2_url) }}" class="img-thumbnail"></td>
                                            <td><img src="{{ asset('storage/' . $product->image3_url) }}" class="img-thumbnail"></td> -->
                                            <td><img src="{{ asset('storage/' . $product->image4_url) }}" class="img-thumbnail"></td>
                                            <td><img src="{{ asset('storage/' . $product->image5_url) }}" class="img-thumbnail"></td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;" id="frmDeleteProduct{{ $product->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteProduct( '{{ $product->id }}' )">Delete</button>
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

    @foreach ($products as $product)
    <!-- Modal Foto1 -->
    <div class="modal fade" id="foto1_{{ $product->image1_url }}" tabindex="-1" aria-labelledby="foto1_{{ $product->image1_url }}label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $product->image1_url) }}" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Foto1 -->

    <!-- Modal Foto2 -->
    <div class="modal fade" id="foto2_{{ $product->image2_url }}" tabindex="-1" aria-labelledby="foto2_{{ $product->image2_url }}label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $product->image2_url) }}" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Foto2 -->

    <!-- Modal Foto3 -->
    <div class="modal fade" id="foto3_{{ $product->image3_url }}" tabindex="-1" aria-labelledby="foto3_{{ $product->image3_url }}label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $product->image3_url) }}" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Foto3 -->
    @endforeach

    <footer class="footer pt-5">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>document.write(new Date().getFullYear())</script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="psn" class="form-control" value="{{ $pesan ?? '' }}" />


    <!-- Success Message Update -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const success = params.get('success');

            if (success === 'update') {
                // Show SweetAlert for successful update
                swal('Success', 'Products has been updated successfully!', 'success');
            } else if (success === 'delete') {
                // Show SweetAlert for successful delete
                swal('Success', 'Products has been deleted successfully!', 'success');
            }
        });
    </script>

    <!-- Delete Messages -->
    <script>
        function deleteProduct(id) {
            const form = document.getElementById('frmDeleteProduct' + id);
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
