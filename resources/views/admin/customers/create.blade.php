@extends('admin.master')
@section('title', 'Create Section')
@section('page', 'Create New Customer')
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

      <!-- Frebles Logo -->
      <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

      <div class="card-body">
      <!-- Cool Tip and SVG -->
      <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-customer.svg') }}" alt="Card image cap">

      <h5 class="card-title">Selamat Datang!</h5>

      <p class="card-text"><q>Untuk <strong>melanjutkan</strong>, pertama Anda perlu membuat data pelanggan Anda sendiri. Tidak perlu sama dengan data pengguna Anda. Silahkan gunakan nama samaran atau nama menarik lainnya bila Anda ingin. Dengan tulus hati, PenggunaSetiaBudi01</q></p>

      <form action="{{ route('customers.store') }}" id="frmCustomerCreate" method="POST">
        @csrf
        <div class="card-body">
          
          <!-- USER ID -->
          <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}" readonly>
          <!-- HIDDEN -->

          <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda" name="name">
            </div>
            <div class="form-group">
              <label for="phone">No Telp</label>
              <input type="text" class="form-control" id="phone" placeholder="Nomor telpon di sini" name="phone">
            </div>
            <div class="mb-3">
              <label for="address1" class="form-label">Alamat 1</label>
              <textarea class="form-control" id="address1" rows="3" name="address1" placeholder="Masukkan alamat Anda (untuk pengiriman)"></textarea>
            </div>
            <div class="mb-3">
              <label for="address2" class="form-label">Alamat 2</label>
              <textarea class="form-control" id="address2" rows="3" name="address2" placeholder="(opsional)"></textarea>
            </div>
            <div class="mb-3">
              <label for="address3" class="form-label">Alamat 3</label>
              <textarea class="form-control" id="address3" rows="3" name="address3" placeholder="(opsional)"></textarea>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" id="save">Simpan</button>
              <a href="{{ route('landingpage') }}" class="btn btn-default">Batal</a>
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
      const form = document.getElementById("frmCustomerCreate")
      let nm = document.getElementById("name")
      let phn = document.getElementById("phone")
      let addr = document.getElementById("address1")

      function save(){
          if (nm.value == ""){
          nm.focus()
          swal("Tidak memadai", "Nama harus diisi", "error")
          } else if (phn.value == ""){
          phn.focus()
          swal("Tidak memadai", "No telp harus diisi", "error")
          } else if (addr.value == ""){
          addr.focus()
          swal("Tidak memadai", "Setidaknya alamat 1 harus diisi", "error")
          } else {
          form.submit()
          }
      }
      btnSave.onclick = function(){
          save()
      }
  </script>
  @endsection