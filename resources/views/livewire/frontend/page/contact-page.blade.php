<!-- Ec Contact Us page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">

            <div class="ec-common-wrapper d-flex">
                <div class="ec-contact-leftside">
                    <div class="col-md-12 text-center">
                        <div class="section-title">
                            <h2 class="ec-bg-title">{{ $page->title }}</h2>
                            <h2 class="ec-title">{{ $page->title }}</h2>
                            <p class="sub-title mb-3">{{ $page->sub_heading }}</p>
                        </div>
                    </div>
                    <div class="ec-contact-container">
                        <div class="ec-contact-form">
                            <form action="#" method="post">
                                <span class="ec-contact-wrap">
                                    <label>Full Name*</label>
                                    <input type="text" name="firstname" placeholder="Enter your first name"
                                        required />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Phone Number*</label>
                                    <input type="text" name="phonenumber" placeholder="Enter your phone number"
                                        required />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Comments/Questions*</label>
                                    <textarea name="address"
                                        placeholder="Please leave your comments here.."></textarea>
                                </span>

                                <span class="ec-contact-wrap ec-contact-btn">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </span>
                            </form>
                        </div>
                    </div>
               

                    <div class="ec_contact_info">
                        <h1 class="ec_contact_info_head">Contact us</h1>
                        <ul class="align-items-center">
                            <li class="ec-contact-item"><i class="ecicon eci-map-marker"
                                    aria-hidden="true"></i><span>Address :</span>{{ $settings['address']}}</li>
                            <li class="ec-contact-item align-items-center"><i class="ecicon eci-phone"
                                    aria-hidden="true"></i><span>Call Us :</span><a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a></li>
                            <li class="ec-contact-item align-items-center"><i class="ecicon eci-envelope"
                                    aria-hidden="true"></i><span>Email :</span><a
                                    href="mailto:example@ec-email.com">{{ $settings['email'] }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>