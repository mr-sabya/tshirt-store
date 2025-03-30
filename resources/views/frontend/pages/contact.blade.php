@extends('frontend.layouts.app')

@section('title')
{{ $page->title }}
@endsection

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="{{ $page->title }}" />
<!-- Ec breadcrumb end -->
 
<!-- Ec Shop page -->
<livewire:frontend.page.contact-page />
<!-- End Shop page -->
@endsection