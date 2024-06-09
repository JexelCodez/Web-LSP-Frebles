@extends('owner.master')
@section('title', 'Edit Section')
@section('page', 'Edit Users')
@section('main')
    @include('owner.main')

    <link rel="stylesheet" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}">

    <!-- Main page -->
    <div class="container-fluid py-4">
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

                    <!-- Frebles Logo -->
                    <img src="{{ asset('assets/img/logos/frebles1hd.png') }}" class="img-fluid float-start me-3" style="max-width: 40px;" alt="main_logo">

                    <div class="card-body">
                    <!-- Cool Tip and SVG -->
                    <img class="img-fluid float-start me-3" style="max-width: 80px;" src="{{ asset('assets/img/small-logos/logo-customer.svg') }}" alt="Card image cap">

                    <h5 class="card-title">Welcome to Users Edit!</h5>

                    <p class="card-text"><q>We are what we repeatedly do. Excellence, then, is not an act, but a habit.</q></p>
                    
                    <form action="{{ route('owner.users.update', $users->id) }}" method="POST" id="frmUsrEdit">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Usertype</label>
                                    <input type="text" class="form-control" id="usertype" placeholder="The available levels right now are: owner, User, and Owner (type in lowercase)" name="usertype" value="{{ $users->usertype }}">
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="save">Update</button>
                                    <a href="{{ route('owner.users.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="msg" class="form-control" value="{{ $message ?? '' }}" />

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmUsrEdit")
        let ustype = document.getElementById("usertype")

        function save(){
            if (ustype.value == ""){
                nm.focus()
                swal("Incomplete data", "Usertype must be filled", "error")
            } else {
                form.submit()
            }
        }
        btnSave.onclick = function(){
            save()
        }
 </script>
@endsection
