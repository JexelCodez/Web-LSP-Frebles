@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Order Details')
@section('main')
    @include('admin.main')

    <!-- Form Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.order_details.store') }}" id="frmOrderDetail" method="post">
                    @csrf
                    <div class="card-body">
                        <!-- Product Selection -->
                        <div class="form-group">
                            <label for="product_id" class="form-label">Product Name</label>
                            <select class="form-select" id="product_id" name="product_id">
                                <option selected disabled>Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Order Selection -->
                        <div class="form-group">
                            <label for="order_id" class="form-label">Order ID</label>
                            <select class="form-select" id="order_id" name="order_id">
                                <option selected disabled>Select Order</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->id }} (Customer: {{ $order->customer->name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity Input -->
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
                        </div>

                        <!-- Subtotal Input -->
                        <div class="form-group">
                            <label for="subtotal">Subtotal</label>
                            <input type="number" class="form-control" id="subtotal" placeholder="Enter subtotal" name="subtotal">
                        </div>

                        <!-- Form Actions (Save and Cancel) -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="save">Save</button>
                            <a href="{{ route('admin.order_details.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
