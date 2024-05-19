@extends('backend.layout.master')
@section('title', 'Admin || Dashboard Page')
@section('breadcum', 'Dashboard')
@section('content')
    @include('backend.components.dashboard.dashboard-form')
@endsection