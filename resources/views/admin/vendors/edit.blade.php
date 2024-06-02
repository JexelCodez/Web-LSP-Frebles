@extends('admin.master')
@section('title', 'Edit Section')
@section('page', 'Edit Vendor')
@section('main')
    @include('admin.main')

    <link rel="stylesheet" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}">

    <!-- Main page -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">

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

                    <!-- Frebles Logo -->
                    <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

                    <div class="card-body">
                    <!-- Cool Tip and SVG -->
                    <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-vendor.svg') }}" alt="Card image cap">

                    <h5 class="card-title">Welcome to Vendor's Edit!</h5>

                    <p class="card-text"><q>Only recently have people begun to recognize that working with suppliers is just as important as listening to customers.</q></p>
                    
                    <form action="{{ route('admin.vendors.update', $vendors->id) }}" method="POST" id="frmVendorEdit">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter vendor's name" name="name" value="{{ $vendors->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="contact_name">Contact Name</label>
                                    <input type="text" class="form-control" id="contact_name" placeholder="Enter vendor's contact name" name="contact_name" value="{{ $vendors->contact_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="contact_phone">Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" placeholder="Enter vendor's contact number" name="contact_phone" value="{{ $vendors->contact_phone }}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address" placeholder="Enter vendor's address">{{ $vendors->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="Enter vendor's city location" name="city" value="{{ $vendors->city }}">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" placeholder="Enter vendor's state location" name="state" value="{{ $vendors->state }}">
                                </div>
                                <div class="form-group">
                                    <label for="zip_code">Postal Code</label>
                                    <input type="text" class="form-control" id="zip_code" placeholder="Enter vendor's postal/zip code" name="zip_code" value="{{ $vendors->zip_code }}">
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" placeholder="Enter vendor's country location" name="country" value="{{ $vendors->country }}">
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmVendorEdit")
        let nm = document.getElementById("name")


        function save(){
            if (nm.value == ""){
                nm.focus()
                swal("Incomplete data", "Name must be filled", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
 </script>
@endsection
