@extends('admin.master')
@section('title', 'Create Section')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Create Product Category')
@section('main')
    @include('admin.main')

<!--  Tabel -->

<div class="row">
  <div class="col-12">
    <div class="card">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product-categories.store') }}" id="frmProductCategoriesCreate" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="category_name">Product Category's Name</label>
            <input type="text" class="form-control" id="category_name" placeholder="Enter the category" name="category_name">
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary" id="save">Save</button>
            <a href="{{ route('admin.product-categories.index') }}" class="btn btn-default">Cancel</a>
        </div>
      </div>
      </form>
    </div>
</div>

<input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
<input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />


<script>
  const btnSave = document.getElementById("save");
  const form = document.getElementById("frmProductCategoriesCreate");
  let categoryName = document.getElementById("category_name");

  function save() {
    if (categoryName.value == "") {
      categoryName.focus();
      swal("Incomplete data", "The product's category name must be filled!", "error");
    } else {
      form.submit();
    }
  }
  btnSave.onclick = function() {
    save();
  }
</script>
@endsection