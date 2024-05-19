@extends('backend.layout.master')
@section('title', 'Admin || Product List')
@section('breadcum', 'Product List')
@section('content')
    @include('backend.components.product.index')
@endsection