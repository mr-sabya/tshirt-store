@extends('frontend.layouts.app')

@section('title', 'Order Track')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="History" />
<!-- Ec breadcrumb end -->

<!-- User profile section -->
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                <livewire:frontend.user.menu />
            </div>

            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <livewire:frontend.user.order-track.index orderID="{{ $order->order_id }}" />
            </div>
        </div>
    </div>
</section>
<!-- End User profile section -->
@endsection