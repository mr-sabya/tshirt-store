@extends('frontend.layouts.app')

@section('content')
<!-- Ec breadcrumb start -->
<livewire:frontend.components.breadcrumb title="Design" />
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
                
                @if(Auth::user()->is_designer == 0 || Auth::user()->is_approved == 0)
                <livewire:frontend.user.design.apply />
                @elseif(Auth::user()->is_designer == 1)
                <livewire:frontend.user.design.index />
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End User profile section -->
@endsection