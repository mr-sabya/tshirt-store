@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Shop"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.shop.index />
<!-- End Shop page -->
@endsection