@extends('owner.master')
@section('title', 'DASHBOARD')
@section('nav')
    @include('owner.nav')
@endsection
@section('main')
    @include('owner.main')
    @include('owner.dashboard')
@endsection