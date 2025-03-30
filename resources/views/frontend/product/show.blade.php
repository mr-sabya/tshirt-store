@extends('frontend.layouts.app')

@section('title')
{{ $product->name }}
@endsection

@section('seo')
<meta name="description" content="{{ $product->meta_description }}">
<meta name="keywords" content="{{ $product->meta_keywords }}">

<!-- Open Graph (OG) Meta Tags for Social Sharing -->
<meta property="og:title" content="{{ $product->og_title ?? $product->meta_title }}">
<meta property="og:description" content="{{ $product->og_description ?? $product->meta_description }}">

@if($product->og_image)
<meta property="og:image" content="{{ asset('storage/' . $product->og_image) }}">
@else
<meta property="og:image" content="{{ asset('storage/' . $product->image) }}">
@endif

<meta property="og:type" content="product">
<meta property="og:url" content="{{ url()->current() }}">
@endsection


@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="{{ $product->name }}" />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.product.show productId="{{ $product->id }}" />
<!-- End Shop page -->


<!-- Related Product Start -->
<livewire:frontend.product.related-products categoryId="{{ $product->category_id }}" />
<!-- Related Product End -->
@endsection