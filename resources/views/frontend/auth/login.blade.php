@extends('frontend.layouts.app')

@section('title', 'Login')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Login" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.auth.login />
<!-- End Shop page -->
@endsection