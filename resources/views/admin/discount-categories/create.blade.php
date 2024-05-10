@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Discount Category')
@section('main')
    @include('admin.main')

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

    <form action="{{ route('admin.discount-categories.store') }}" id="frmDiscountCategories" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="discount-categories">Discount Category's Name</label>
            <input type="text" class="form-control" id="category_name" placeholder="Enter the category" name="category_name">
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary" id="save">Save</button>
            <a href="{{ route('admin.discount-categories.index') }}" class="btn btn-default">Cancel</a>
        </div>
      </div>
      </form>
    </div>
</div>  

<script>
  const btnSave = document.getElementById("save")
  const form = document.getElementById("frmDiscountCategories")
  let categoryName = document.getElementById("category_name")

  function store(){
    let pesan = ""
    if(categoryName.value == ""){
      categoryName.focus()
      swal("Incomplete data", "The discount's category name must be filled!", "error")
    } else {
      form.submit()
    }
  }
      
  btnSave.onclick = function(){
      store()
  }
 </script>
@endsection