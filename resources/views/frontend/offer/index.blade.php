@extends('frontend.layouts.app')

@section('title', 'Hot Offers')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Hot Offers"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.offer.index />
<!-- End Shop page -->
@endsection