@extends('admin.master')
@section('title', 'Main Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Vendors')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <a href="{{ route('admin.vendors.create') }}" class="btn btn-info mb-2">Add Vendor</a>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
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
                                            <td class="text-center">
                                                <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST" style="display: inline;" id="frmDeleteVendor{{ $vendor->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteVendor( '{{ $vendor->id }}' )">Delete</button>
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

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

    <!-- Success Message Update -->
    <script>
        const masterBody = document.getElementById("master");
        const sts = document.getElementById("sts");
        const msg = document.getElementById("msg");

        function saveMessage() {
            if (sts.value == "save") {
                swal('Success!', msg.value, 'success');
            }
        }

        masterBody.onload = function() {
            saveMessage();
        };
    </script>

    <!-- Delete Messages -->
    <script>
        function deleteVendor(id) {
            const form = document.getElementById('frmDeleteVendor' + id);
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
