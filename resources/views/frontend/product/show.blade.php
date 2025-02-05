@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="{{ $product->name }}"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.product.show productId="{{ $product->id }}" />
<!-- End Shop page -->
@endsection