@extends('user.master')
@section('title', 'Edit Section')
@section('page', 'Edit Customers')
@section('main')
    @include('user.main')

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
                    <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-customer.svg') }}" alt="Card image cap">

                    <h5 class="card-title">Welcome to Customer Edit!</h5>

                    <p class="card-text"><q>We are what we repeatedly do. Excellence, then, is not an act, but a habit.</q></p>
                    
                    <form action="{{ route('customers.update', $customers->id) }}" method="POST" id="frmCustomerEdit">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" value="{{ $customers->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Name@example.com" name="email" value="{{ $customers->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter new password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Enter your phone number" name="phone" value="{{ $customers->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label for="address1" class="form-label">Address 1</label>
                                    <textarea class="form-control" id="address1" rows="3" name="address1" placeholder="Enter your address">{{ $customers->address1 }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <textarea class="form-control" id="address2" rows="3" name="address2" placeholder="(Optional)">{{ $customers->address2 }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="address3" class="form-label">Address 3</label>
                                    <textarea class="form-control" id="address3" rows="3" name="address3" placeholder="(Optional)">{{ $customers->address3 }}</textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('customers.index') }}" class="btn btn-default">Cancel</a>
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
        const form = document.getElementById("frmCustomerEdit")
        let nm = document.getElementById("name")
        let mail = document.getElementById("email")
        let passwd = document.getElementById("password")
        let phn = document.getElementById("phone")
        let addr = document.getElementById("address1")

        function save(){
            let pesan = ""
            if (nm.value == ""){
                nm.focus()
                swal("Incomplete data", "Name must be filled", "error")
            } else if (mail.value == ""){
                mail.focus()
                swal("Incomplete data", "Email must be filled", "error")
            } else if (passwd.value == ""){
                passwd.focus()
                swal("Incomplete data", "Password must be filled", "error")
            } else if (phn.value == ""){
                phn.focus()
                swal("Incomplete data", "Phone number must be filled", "error")
            } else if (addr.value == ""){
                addr.focus()
                swal("Incomplete data", "One address must be filled at least", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
 </script>
@endsection
