@extends('admin.master')
@section('title', 'Order Details')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Order Details Section')
@section('main')
    @include('admin.main')

    <!-- Add Order Detail Button -->
    <div class="container-fluid py-4">
        <a href="{{ route('admin.order_details.create') }}" class="btn btn-info mb-2">Add Order Detail</a>

        <!-- Order Details Table -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>ORDER DETAILS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <!-- Define table headers -->
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image Example 1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image Example 2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image Example 3</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image Example 4</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image Example 5</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer's Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer's Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer's Phone Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer's Address 1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer's Address 2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer's Address 3</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $index => $orderDetail)
                                        <tr>
                                            <td>{{ $index + 1 . ". "}}</td>
                                            <td>{{ $orderDetail->category_name }}</td>
                                            <td>{{ $orderDetail->product_name }}</td>
                                            <td>{{ $orderDetail->description }}</td>
                                            <td>{{ $orderDetail->price }}</td>
                                            <td><img src="{{ asset('storage/' . $orderDetail->image1_url) }}" class="img-thumbnail"></td>
                                            <td><img src="{{ asset('storage/' . $orderDetail->image2_url) }}" class="img-thumbnail"></td>
                                            <td><img src="{{ asset('storage/' . $orderDetail->image3_url) }}" class="img-thumbnail"></td>
                                            <td><img src="{{ asset('storage/' . $orderDetail->image4_url) }}" class="img-thumbnail"></td>
                                            <td><img src="{{ asset('storage/' . $orderDetail->image5_url) }}" class="img-thumbnail"></td>
                                            <td>{{ $orderDetail->name }}</td>
                                            <td>{{ $orderDetail->email }}</td>
                                            <td>{{ $orderDetail->phone }}</td>
                                            <td>{{ $orderDetail->address1 }}</td>
                                            <td>{{ $orderDetail->address2 }}</td>
                                            <td>{{ $orderDetail->address3 }}</td>
                                            <td>{{ $orderDetail->quantity }}</td>
                                            <td><span>${{ $orderDetail->price * $orderDetail->quantity }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
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
    </div>

    <!-- Script to Show Success Message -->
    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="psn" class="form-control" value="{{ $pesan ?? '' }}" />


    <script>
        const sts = document.getElementById("sts");
        const psn = document.getElementById("psn");
        function showMessage() {
            if (sts.value == "simpan") {
                swal('Success', psn.value, 'success');
            }
        }
        document.addEventListener('DOMContentLoaded', showMessage);
    </script>


    <!-- Success Message Update -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const success = params.get('success');

            if (success === 'update') {
                // Show SweetAlert for successful update
                swal('Success', 'Order Detail has been updated successfully!', 'success');
            } else if (success === 'delete') {
                // Show SweetAlert for successful delete
                swal('Success', 'Order Detail has been deleted successfully!', 'success');
            }
        });
    </script>

@endsection
