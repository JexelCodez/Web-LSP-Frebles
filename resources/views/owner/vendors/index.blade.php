@extends('owner.master')
@section('title', 'Main Section')
@section('nav')
    @include('owner.nav')
@endsection
@section('page', 'Vendors')
@section('main')
    @include('owner.main')

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

                    <!-- Search Bar -->
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>VENDORS</h6>
                            <form action="#" method="GET" class="input-group" style="max-width: 300px;">
                                @csrf
                                <input type="text" name="search" class="form-control" placeholder="Search vendor...">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Phone</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">City</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">State</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Postal Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $index => $vendor)
                                        <tr>
                                            <td>{{ $index + 1 . ". "}}</td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->contact_name }}</td>
                                            <td>{{ $vendor->contact_phone }}</td>

                                            <!-- Bootstrap Tooltip If String Exceeds A Certain Length -->
                                            @if (strlen($vendor->address) > 18)
                                                <td data-toggle="tooltip" data-placement="top" title="{{ $vendor->address }}">
                                                {{ substr($vendor->address, 0, 18) . '...' }}
                                                </td>
                                            @else 
                                                <td>{{ $vendor->address }}</td>
                                            @endif
                                            <!-- End Tooltip -->

                                            <td>{{ $vendor->city }}</td>
                                            <td>{{ $vendor->state }}</td>
                                            <td>{{ $vendor->zip_code }}</td>
                                            <td>{{ $vendor->country }}</td>
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
    
@endsection
