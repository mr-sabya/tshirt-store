@extends('frontend.layouts.app')

@section('title', 'Categories')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Categories"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.category.index />
<!-- End Shop page -->
@endsection