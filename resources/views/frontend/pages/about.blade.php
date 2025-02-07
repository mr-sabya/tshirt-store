@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="About Us" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.page.about-page />
<!-- End Shop page -->

<!-- ec testmonial Start -->
<livewire:frontend.home.testimonial />
<!-- ec testmonial end -->


@endsection