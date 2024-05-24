@extends('admin.master')
@section('title', 'Main Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Customers')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
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
                        <h6>CUSTOMERS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email Address</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address 1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address 2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address 3</th>
                                        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 . ". "}}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>

                                            <!-- Bootstrap Tooltip If String Exceeds A Certain Length -->
                                            @if (strlen($customer->address1) > 18)
                                                <td data-toggle="tooltip" data-placement="top" title="{{ $customer->address1 }}">
                                                {{ substr($customer->address1, 0, 18) . '...' }}
                                                </td>
                                            @else 
                                                <td>{{ $customer->address1 }}</td>
                                            @endif
                                            <!-- End Tooltip -->

                                            <!-- Bootstrap Tooltip If String Exceeds A Certain Length -->
                                            @if (strlen($customer->address2) > 18)
                                                <td data-toggle="tooltip" data-placement="top" title="{{ $customer->address2 }}">
                                                {{ substr($customer->address2, 0, 18) . '...' }}
                                                </td>
                                            @else 
                                                <td>{{ $customer->address2 }}</td>
                                            @endif
                                            <!-- End Tooltip -->
                                            
                                            <!-- Bootstrap Tooltip If String Exceeds A Certain Length -->
                                            @if (strlen($customer->address3) > 18)
                                                <td data-toggle="tooltip" data-placement="top" title="{{ $customer->address3 }}">
                                                {{ substr($customer->address3, 0, 18) . '...' }}
                                                </td>
                                            @else 
                                                <td>{{ $customer->address3 }}</td>
                                            @endif
                                            <!-- End Tooltip -->

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
    <input type="hidden" id="psn" class="form-control" value="{{ $pesan ?? '' }}" />

    <!-- Success Message Update -->

    <!-- Delete Messages -->
    
@endsection
