@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Cart" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.cart.index />
<!-- End Shop page -->


<!-- New Product Start -->
<livewire:frontend.home.new-prodcuts />
<!-- New Product end -->

@endsection