@extends('frontend.layouts.app')

@section('title', 'Products')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Shop"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.shop.index :categorySlug="request('category')"/>
<!-- End Shop page -->
@endsection