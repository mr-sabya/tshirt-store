@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Checkout"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.checkout.index />
<!-- End Shop page -->


<!-- New Product Start -->
<livewire:frontend.home.new-prodcuts />
<!-- New Product end -->

@endsection