@extends('user.master')
@section('title', 'Create Section')
@section('page', 'Create New Customer')
@section('main')
    @include('user.main')

<!--  Tabel -->

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

    <form action="{{ route('customers.store') }}" id="frmCustomerCreate" method="POST">
      @csrf

      <div class="card-body">

      <!-- Connecting to USERS TABLE -->
      <div class="form-group">
        <label for="user_id" class="form-label">User ID</label>
        <input type="text" class="form-control" id="user_id" value="{{ auth()->id() }}" name="user_id" readonly>
        <!-- This input field will be hidden and readonly, automatically filled with the authenticated user's ID -->
      </div>
      
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Name@example.com" name="email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
          </div>  
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" placeholder="Enter your phone number" name="phone">
          </div>
          <div class="mb-3">
            <label for="address1" class="form-label">Address 1</label>
            <textarea class="form-control" id="address1" rows="3" name="address1" placeholder="Enter your address"></textarea>
          </div>
          <div class="mb-3">
            <label for="address2" class="form-label">Address 2</label>
            <textarea class="form-control" id="address2" rows="3" name="address2" placeholder="(opsional)" name="phone"></textarea>
          </div>
          <div class="mb-3">
            <label for="address3" class="form-label">Address 3</label>
            <textarea class="form-control" id="address3" rows="3" name="address3" placeholder="(opsional)"></textarea>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary" id="save">Save</button>
            <a href="{{ route('landingpage') }}" class="btn btn-default">Cancel</a>
        </div>
      </div>
      </form>
    </div>
</div>  

 <script>
    const btnSave = document.getElementById("save")
    const form = document.getElementById("frmCustomerCreate")
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