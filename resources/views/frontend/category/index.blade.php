@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Categories"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.category.index />
<!-- End Shop page -->
@endsection