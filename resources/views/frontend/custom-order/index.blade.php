@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Checkout"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.custom-order.index categoryName="{{ $category->name }}" />
<!-- End Shop page -->


<!-- New Product Start -->
<livewire:frontend.home.new-prodcuts />
<!-- New Product end -->

@endsection