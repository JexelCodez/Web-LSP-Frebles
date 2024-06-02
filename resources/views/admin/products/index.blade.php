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
                    
                    <!-- Search Bar -->
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>PRODUCTS</h6><i>"don't forget to add the stock!"</i>
                            <form action="{{ url('search_admin_product') }}" method="GET" class="input-group" style="max-width: 300px;">
                                @csrf
                                <input type="text" name="search" class="form-control" placeholder="Search a product...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- End of Search Bar -->

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vendor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Quantity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 3</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 4</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image 5</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 . ". "}}</td>
                                            <td class="text-center">{{ $product->category_name }}</td>
                                            <td class="text-center">{{ $product->name }}</td>

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

                                            <td class="text-center">Rp{{ $product->price }}</td>
                                            <td class="text-center">{{ $product->stock_quantity }}</td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image1_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto1_{{ $product->image1_url }}"></td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image2_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto2_{{ $product->image2_url }}"></td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image3_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto3_{{ $product->image3_url }}"></td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image4_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto4_{{ $product->image4_url }}"></td>

                                            <td class="text-center"><img src="{{ asset('storage/' . $product->image5_url) }}" class="w-30 img-thumbnail zoom" data-bs-toggle="modal" data-bs-target="#foto5_{{ $product->image5_url }}"></td>
                            
                                            <td class="text-center">{{ $product->type }}</td>
                                            
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

    <!-- Modal Foto4 -->
    <div class="modal fade" id="foto4_{{ $product->image4_url }}" tabindex="-1" aria-labelledby="foto4_{{ $product->image4_url }}label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $product->image4_url) }}" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Foto4 -->

    <!-- Modal Foto5 -->
    <div class="modal fade" id="foto5_{{ $product->image5_url }}" tabindex="-1" aria-labelledby="foto5_{{ $product->image5_url }}label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $product->image5_url) }}" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Foto5 -->
    @endforeach

    <!-- Hidden Input Fields for Status and Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />


    <!-- Success Message Update -->

    <script>
      const masterBody = document.getElementById("master")
      const sts = document.getElementById("sts")
      const msg = document.getElementById("msg")
      function save_message(){
        if (sts.value == "save") {
          swal('Good job', msg.value, 'success')
        }
      }
      masterBody.onload = function(){
        save_message()
      }
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
