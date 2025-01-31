@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.product.show productId="{{ $product->id }}" />
<!-- End Shop page -->
@endsection