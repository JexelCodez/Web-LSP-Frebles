@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create New Vendor')
@section('main')
    @include('admin.main')

<!--  Tabel -->

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

      <form action="{{ route('admin.vendors.store') }}" id="frmVendorCreate" method="POST">
        @csrf
        <div class="card-body">

          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter vendor's name" name="name">
            </div>
            <div class="form-group">
              <label for="contact_name">Contact Name</label>
              <input type="text" class="form-control" id="contact_name" placeholder="Enter vendor's contact" name="contact_name">
            </div>
            <div class="form-group">
              <label for="contact_phone">Contact Phone</label>
              <input type="text" class="form-control" id="contact_phone" placeholder="Enter vendor's number" name="contact_phone">
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="Enter vendor's address"></textarea>
            </div>
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" placeholder="Enter vendor's city location" name="city">
            </div>
            <div class="form-group">
              <label for="city">State</label>
              <input type="text" class="form-control" id="state" placeholder="Enter vendor's state location" name="state">
            </div>
            <div class="form-group">
              <label for="city">Postal/Zip Code</label>
              <input type="text" class="form-control" id="zip_code" placeholder="Enter vendor's zip/postal code" name="zip_code">
            </div>
            <div class="form-group">
              <label for="city">Country</label>
              <input type="text" class="form-control" id="country" placeholder="Enter vendor's country" name="country">
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" id="save">Save</button>
              <a href="{{ route('admin.vendors.index') }}" class="btn btn-default">Cancel</a>
          </div>
        </div>
        </form>
      </div>
  </div>
</div> 

<!-- Hidden Input Fields for Status and Message -->
<input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
<input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

  <script>
      const btnSave = document.getElementById("save")
      const form = document.getElementById("frmVendorCreate")
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