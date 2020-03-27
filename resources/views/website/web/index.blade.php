@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

    <div>
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide position-relative"> <img src="{{asset('web/img/slides/slide1.jpg')}}" data-rjs="2" alt="Slider Img">
                    {{-- <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="slide-content">
                                    <h1 data-animate="fadeInUp" data-delay=".3" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Enter your <span>tracking</span> ID </h1>
                                    <div class="primary-form"> <form action="tracking_details.php" method="post" name=""  novalidate=""> <input type="text" name="tracking-id" class="theme-input-style home-search" placeholder="Enter your tracking id" required=""> <button class="btn" style="border:0;" type="submit">Search</button> </form> </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="swiper-slide position-relative"> <img src="{{asset('web/img/slides/slide2.jpg')}}" data-rjs="2" alt="Slider Img">
                </div>
            </div>
        </div>
    </div>
    <div class="pb-30 default-bg">
        <div class="container">
            <div class="pt-60">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about-content" data-animate="fadeInUp">
                            <h1 class="text-uppercase">ABOUT <span>US</span></h1> 
                            <span class="subtitle" style="text-align: justify;"> 
                                Founded in 2013, FISCALE BUSINESS SOLUTIONS is a Consultancy firm providing Assurance, Audit, Accounting, Taxation, Advisory and other services. Revered for our professional ethos and technical expertise, drawn on perspicacity of over last Seven years and a team of highly competent professionals, we provide efficacious solutions to our client’s needs, running into deep engagements. We recruit, train, motivate and retain highly capable and sharpest talent, who bring quality in their work and deliver the best solutions.
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="about-content" data-animate="fadeInUp">
                            <h1 class="text-uppercase">OUR<span> PHILOSOPHY</span></h1>
                            <span class="subtitle" style="text-align: justify;"> 
                                Our philosophy is of partnering with our clients and not being a distant service provider. Since businesses are inherently different, we tailor our services to meet client’s specific needs and banish the ‘one-size-fits-all’ standardization and on the idea to provide business solution at ‘one stop’.
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12"><br><br>
                        <div class="about-content" data-animate="fadeInUp">
                            <h1 class="text-uppercase">WHY<span> CHOOSE US?</span></h1>
                            <span class="subtitle" style="text-align: justify;"> 
                                Principles and values are so strongly weaved in our culture fabric that our beliefs are shared amongst all and which helps us earn our client’s trust and respect. Our Values, partnership instead of being a distant service provider, we collaborate with our clients in all our engagements, work with them as a team and take ownership and responsibility of things, to create long lasting partnerships. Integrity, our services are aimed at protecting our client’s interests. By adopting transparent processes and adhering to highest ethical standards, we ensure client confidentiality and our own credibility.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-30 pb-30" style="background-color: #f7f7f7;" id="home-service">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-8 col-md-9">
                    <div class="section-title" data-animate="fadeInUp"> 
                        <h1>Our <span>Services</span></h1>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-3">
                    <ul class="service-controls nav justify-content-end" data-animate="fadeInUp" data-delay=".3">
                        <li class="prev-service carousel-control d-flex align-items-center justify-content-center"> <img src="{{asset('web/img/icons/left-arrow.svg')}}" alt="" class="svg"> </li>
                        <li class="next-service carousel-control d-flex align-items-center justify-content-center"> <img src="{{asset('web/img/icons/right-arrow.svg')}}" alt="" class="svg"> </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="swiper-container-wrap" data-animate="fadeInUp" data-delay=".5">
                        <div class="service-carousel swiper-container">
                            <div class="swiper-wrapper" style="height: auto;">
                                <div class="swiper-slide">
                                    <div class="single-service mt-30">
                                        <h4>TAX & FINANCE</h4>
                                        <a>Income Tax Filing</a>
                                        <a>Goods & Service Tax (GST) Registration</a>
                                        <a>GST Return Filing</a>
                                        <a>Professional Tax</a>
                                        <a>Credit Monitoring Arrangements(CMA) Report</a>
                                        <a>Detailed Project Report (DPR)</a>
                                        <a>Projections & Estimates</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-service mt-30">
                                        <h4>STARTING A BUSINESS</h4>
                                        <a>Private Limited Company</a>
                                        <a>One Person Company (OPC)</a>
                                        <a>Producer Company</a>
                                        <a>Limited Liability Partnership (LLP)</a>
                                        <a>Partnership Firm</a>
                                        <a>Proprietorship Firm</a>
                                        <a></a>                                     
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-service mt-30">
                                        <h4>REGISTRATIONS</h4>
                                        <a>Trademark & Copyrights</a>  
                                        <a>ISO</a>  
                                        <a>MSME</a>  
                                        <a>Trust</a>  
                                        <a>Society (NGO)</a>  
                                        <a>FSSAI</a>
                                        <a>EPF/ESI</a>   
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-service mt-30">
                                        <h4>ANCILLARY SERVICES</h4>
                                        <a>Digital Signature Certificates</a>
                                        <a>Estimates & Drawings</a>
                                        <a>Structural Designs</a>
                                        <a>Building Plans</a>
                                        <a>Drafting of Agreements, Deeds & Affidavits</a>
                                        <a>Subsidies (Central & State)</a>
                                        <a>E-Tendering</a>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-30 pb-90" id="home-contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-9 pb-30">
                    <div class="section-title" data-animate="fadeInUp"> 
                        <h1>Contact <span>Us</span></h1>
                    </div>
                </div>
                <div class="col-lg-7 col">
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
                <div class="col-lg-5">
                    <div class="contact-info mb-30" data-animate="fadeInUp" data-delay=".3">
                        <h1>Contact Information</h1>
                        <p>Contact us on bellow given addresses, email & phone if you have any enquiry</p>
                        <ul class="list-unstyled mb-0">
                            <li class="address">
                                <h4>Address:</h4> <span class="address">KOCHGAON, BISWANATH CHARIALI, ASSAM.<br><strong style="color: #333">CITY OFFICE</strong>: BYE LANE 9, LACHIT NAGAR, GUWAHATI-07, ASSAM.</span> </li>
                            <li class="email">
                                <h4>E-mail Address:</h4> <a href="mailto:enquiryfiscale@gmail.com">enquiryfiscale@gmail.com</a>
                            <li class="phone">
                                <h4>Telephone:</h4> <a href="tel:03715-222220">03715-222220</a>
                                <br><a href="6901945275">6901945275</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection