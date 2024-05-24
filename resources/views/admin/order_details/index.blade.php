@extends('admin.master')
@section('title', 'Order Details')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Order Details Section')
@section('main')
    @include('admin.main')

    <!-- Main Outer Card -->
    <div class="container-fluid py-4">
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
    </div>

    <!-- Script to Show Success Message -->

    <!-- Success Message Update -->
    

@endsection
