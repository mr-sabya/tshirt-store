<!-- Ec FAQ page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">FAQ</h2>
                    <h2 class="ec-title">FAQ</h2>
                    <p class="sub-title mb-3">Customer service management</p>
                </div>
            </div>
            <div class="ec-faq-wrapper">
                <div class="ec-faq-container">
                    <h2 class="ec-faq-heading">What is ekka services?</h2>
                    <div id="ec-faq">
                        @foreach ($faqs as $faq)
                        <div class="col-sm-12 ec-faq-block">
                            <h4 class="ec-faq-title">{{ $faq->question}}</h4>
                            <div class="ec-faq-content">
                                <p>{{ $faq->answer }} </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>