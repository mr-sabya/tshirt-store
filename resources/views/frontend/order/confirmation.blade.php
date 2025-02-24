@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Order Confirmation" />
<!-- Ec breadcrumb end -->

<livewire:frontend.checkout.order-confirmation :orderId="$order->id" />

@endsection