@extends('admin.master')
@section('title', 'DASHBOARD')
@section('nav')
    @include('admin.nav')
@endsection
@section('main')
    @include('admin.main')
    @include('admin.dashboard')
@endsection