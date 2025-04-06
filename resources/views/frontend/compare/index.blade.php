@extends('frontend.layouts.app')

@section('title', 'Compare')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Compare"  />
<!-- Ec breadcrumb end -->


<!-- Ec Shop page -->
<livewire:frontend.compare.index />
<!-- End Shop page -->

@endsection