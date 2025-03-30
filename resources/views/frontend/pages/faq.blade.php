@extends('frontend.layouts.app')

@section('title')
{{ $page->title }}
@endsection

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="{{ $page->title }}" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.page.faq-page />
<!-- End Shop page -->
@endsection