@extends('frontend.layouts.app')

@section('title', 'Blog')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Blog"  />
<!-- Ec breadcrumb end -->

<!-- Ec Shop page -->
<livewire:frontend.blog.show blogId="{{ $blog->id }}" />
<!-- End Shop page -->
@endsection