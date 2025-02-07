@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Terms & Conditions" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<div class="terms_condition_page">
    <livewire:frontend.page.terms-page />
</div>
<!-- End Shop page -->
@endsection