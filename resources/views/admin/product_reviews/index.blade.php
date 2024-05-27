@extends('admin.master')
@section('title', 'Main Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Product Reviews')
@section('main')
    @include('admin.main')

    <!-- Container -->
    <div class="container-fluid py-4">
        <a href="{{ route('admin.product-reviews.create') }}" class="btn btn-info mb-2">Add Review</a>
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
                        <h6>PRODUCT REVIEWS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rating</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comment</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productReviews as $index => $productReview)
                                        <tr>
                                            <td>{{ $index + 1 . ". "}}</td>
                                            <td>{{ $productReview->name }}</td>
                                            <td>{{ $productReview->product_name }}</td>
                                            <td>{{ $productReview->rating }}</td>
                                            <td>{{ $productReview->comment }}</td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('admin.product-reviews.edit', $productReview->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                <form action="{{ route('admin.product-reviews.destroy', $productReview->id) }}" method="POST" style="display: inline;" id="frmDeleteProductReview{{ $productReview->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteProductReviews( '{{ $productReview->id }}' )">Delete</button>
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

    <!-- Hidden Inputs for Status and Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />


    <!-- Success Message Update -->

    <!-- Delete Messages -->
    <script>
        function deleteProductReviews(id) {
            const form = document.getElementById('frmDeleteProductReview' + id);
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
