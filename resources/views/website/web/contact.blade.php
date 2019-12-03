@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 
    <section class="pt-120 pb-90">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="map" id="map" data-map-latitude="23.790546" data-map-longitude="90.375583" data-map-zoom="16" data-map-marker="[[23.790546, 90.375583]]"></div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-info mb-30" data-animate="fadeInUp" data-delay=".3">
                        <h1>Contact Information</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elite sed do eiusmod tempor aliqua.</p>
                        <ul class="list-unstyled mb-0">
                            <li class="address">
                                <h4>Address:</h4> <span class="address">3224 Junkins Avenue West Fitzgerald,<br>GA 31750, United States</span> </li>
                            <li class="email">
                                <h4>E-mail Address:</h4> <a href="mailto:contact.callto@demo.com">contact.callto@demo.com</a>
                                <br><a href="mailto:career@callto.com">career@callto.com</a> </li>
                            <li class="phone">
                                <h4>Telephone:</h4> <a href="tel:+12294287778">(+1) 229-428-7778 - 83</a>
                                <br><a href="%2b17577029456.html">(+1) 757-702-9456</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-120">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="contact-form contact-page-form parsley-validate" data-animate="fadeInUp">
                        <h4>Say Hello!</h4> <span>Your e-mail address will not be published. Required fields are marked with *</span>
                        <div class="form-response"></div>
                        <form action="http://themelooks.org/demo/calldee/html/preview/sendmail.php">
                            <div class="row half-gutter">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" name="name" placeholder="Enter your name" class="theme-input-style" required> </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>E-mail *</label>
                                        <input type="email" name="email" placeholder="Enter e-mail address" class="theme-input-style" required> </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" placeholder="Enter subject" class="theme-input-style"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Message *</label>
                                <textarea name="message" placeholder="Write Message" class="theme-input-style" required></textarea>
                            </div>
                            <button class="btn" type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection