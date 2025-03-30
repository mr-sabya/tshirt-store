@extends('frontend.layouts.app')

@section('title')
{{ $page->title }}
@endsection

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="{{ $page->title }}" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<div class="terms_condition_page">
    <livewire:frontend.page.refund-policy-page />
</div>
<!-- End Shop page -->
@endsection