@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Privacy & Policy" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<div class="terms_condition_page">
    <livewire:frontend.page.refund-policy-page />
</div>
<!-- End Shop page -->
@endsection