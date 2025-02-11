@extends('backend.layouts.app')

@section('title', 'Orders')

@section('content')

<livewire:backend.order.show orderId="{{ $order->id }}" />

@endsection