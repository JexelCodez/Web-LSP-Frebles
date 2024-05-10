@extends('user.master')
@section('title', 'DASHBOARD')
@section('nav')
    @include('user.nav')
@endsection
@section('main')
    @include('user.main')
    @include('user.dashboard')
@endsection