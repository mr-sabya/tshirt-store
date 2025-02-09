@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Login" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.auth.login />
<!-- End Shop page -->
@endsection