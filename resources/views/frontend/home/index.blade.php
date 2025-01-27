@extends('frontend.layouts.app')

@section('content')

<!-- Main Slider Start -->
<livewire:frontend.home.banner />
<!-- Main Slider End -->

<!-- Product tab Area Start -->
<livewire:frontend.home.products />
<!-- ec Product tab Area End -->



<!--  Category Section Start -->
<livewire:frontend.home.categories />
<!-- Category Section End -->



<!--  services Section Start -->
<livewire:frontend.home.services />
<!--services Section End -->

<!--  offer Section Start -->
<livewire:frontend.home.offer />
<!-- offer Section End -->

<!-- New Product Start -->
<livewire:frontend.home.new-prodcuts />
<!-- New Product end -->

<!-- ec testmonial Start -->
<livewire:frontend.home.testimonial />
<!-- ec testmonial end -->

@endsection