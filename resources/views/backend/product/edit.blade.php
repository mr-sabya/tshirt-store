@extends('backend.layouts.app')

@section('title', 'Edit Product')

@section('content')

<livewire:backend.product.manage id="{{ $product->id }}" />

@endsection