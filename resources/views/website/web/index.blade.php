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
    <div class="pt-30 pb-30" id="home-service">
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
                                        <h4>COMPLIANCES</h4>
                                        <a>Income Tax Filing</a>
                                        <a>GST Return Filing</a>
                                        <a>TDS Filing</a>
                                        <a>EPF & ESI Returns</a>
                                        <a>Increase Authorized Capital</a>
                                        <a>Share Transfer</a>
                                        <a>Winding Up</a>
                                        <a>Add/Remove Directors</a>
                                        <a>Change of Registered Office</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-service mt-30">
                                        <h4>STARTING A BUSINESS</h4>
                                        <a>Private Limited Company</a>
                                        <a>Public Limited Company</a>
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
                                        <a>Goods & Service Tax (GST)</a>
                                        <a>Import Export Code (IEC)</a>
                                        <a>TAN</a>
                                        <a>Professional Tax</a>
                                        <a>12A & 80G</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-service mt-30">
                                        <h4>ANCILLARY SERVICES</h4>
                                        <a>Digital Signature Certificates</a>
                                        <a>Projections & Estimates</a> 
                                        <a>Credit Monitoring Arrangement (CMA)</a> 
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
    <div class="pb-30 default-bg" style="background-color: #f7f7f7;">
        <div class="container">
            <div class="pt-60">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about-content" data-animate="fadeInUp">
                            <h1 class="text-uppercase">ABOUT <span>US</span></h1> 
                            <span class="subtitle" style="text-align: justify;"> 
                                We are a consultancy firm providing Compliance, Registration, Accounting, Taxation, Advisory and other services. Revered for our professional ethos and technical expertise, drawn on perspicacity of over last Seven years and a team of highly competent professionals, we provide efficacious solutions to our client’s needs, running into deep engagements. We recruit, train, motivate and retain highly capable and sharpest talent, who bring quality in their work and deliver the best solutions
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
                                <h4>Address:</h4> <span class="address">KOCHGAON, BISWANATH CHARIALI 784176, ASSAM.</span> </li>
                            <li class="email">
                                <h4>E-mail Address:</h4> <a href="mailto:fiscaleconnect@gmail.com">fiscaleconnect@gmail.com</a>
                            <li class="phone">
                                <h4>Telephone:</h4> <a href="tel:03715-222220">03715-222220</a>
                                <br><a href="https://api.whatsapp.com/send?phone=916901945275">6901945275 (Whatsapp)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-30 default-bg">
        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bussniess-content pb-30" data-animate="fadeInUp text-center">
                            <h1 class="text-uppercase">GOING TO START A BUSINESS? </h1> 
                            <img src="{{asset('web/img/connect-logo.png')}}" style="width: 40%;">
                            <h1 class="text-uppercase pb-0">WITH US </h1>
                            <h1 class="text-uppercase">STARTING A BUSINESS <span>MADE SIMPLIFIED</span> </h1>
                        </div>
                        <div class="bussniess-content pb-60" data-animate="fadeInUp text-center">
                            <h1 class="text-uppercase">ARE YOU STUCKED WITH TAX & COMPLIANCES FOR YOUR BUSINESS</h1> 
                            <img src="{{asset('web/img/connect-logo.png')}}" style="width: 40%;">
                            <h1 class="text-uppercase pb-0">WITH US </h1>
                            <h1 class="text-uppercase">TAX & COMPLIANCES <span>MADE SIMPLIFIED</span> </h1> 
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="about-content" data-animate="fadeInUp">
                            <h1 class="text-uppercase">WEBSITE <span>DISCLAIMER</span></h1>
                            <span class="subtitle" style="text-align: justify;"> 
                                Our philosophy is of partnering with our clients and not being a distant service provider. Since businesses are inherently different, we tailor our services to meet client’s specific needs and banish the ‘one-size-fits-all’ standardization and on the idea to provide business solution at ‘one stop’.

                                The information contained in this website is for general information purposes only. The information is provided by www.fiscale.in, a property of Fiscale Business Solutions. While we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk. <br>
                                In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.<br>
                                Through this website you are able to link to other websites which are not under the control of Fiscale Business Solutions. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.<br>
                                Every effort is made to keep the website up and running smoothly. However, Fiscale Business Solutions takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection