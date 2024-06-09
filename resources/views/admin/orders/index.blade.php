@extends('admin.master')
@section('title', 'Orders')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Orders Section')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <a href="{{ route('admin.orders.create') }}" class="btn btn-info mb-2">Add Order</a>
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
                        <h6>ORDERS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Amount</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 . ". "}}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>Rp{{ number_format($order->total_amount, 0) }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline;" id="frmDeleteOrder{{ $order->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteOrder( '{{ $order->id }}' )">Delete</button>
                                                </form>
                                                <a href="{{ route('delivery.initiate', ['orderId' => $order->id]) }}" class="btn btn-sm btn-warning">Deliver</a>
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

<script>
        function deleteOrder(id) {
            const form = document.getElementById('frmDeleteOrder' + id);
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
