@extends('frontend.layouts.app')

@section('title', 'Register')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Register"/>
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.auth.register />
<!-- End Shop page -->
@endsection