<!-- Ec About Us page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">{{ $page->title }}</h2>
                    <h2 class="ec-title">{{ $page->title }}</h2>
                    <p class="sub-title mb-3">{{ $page->sub_heading }}</p>
                </div>
            </div>
            <div class="ec-common-wrapper">
                <div class="row">
                    <div class="col-md-12 ec-cms-block ec-abcms-block mb-5">
                        <div class="ec-cms-block-inner">
                            @if($page->image)
                            <img class="a-img" src="{{ url('storage/'. $page->image) }}" alt="about">
                            @else
                            <img class="a-img" src="{{ url('assets/frontend/images/offer-image/1.jpg') }}" alt="about">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 ec-cms-block ec-abcms-block">
                        <div class="ec-cms-block-inner">
                            {!! $page->text !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>