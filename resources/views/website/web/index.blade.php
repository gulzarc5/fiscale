@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

    <section class="">
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide position-relative"> <img src="{{asset('web/img/slides/slide1.jpg')}}" data-rjs="2" alt="Slider Img">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="slide-content">
                                    <h1 data-animate="fadeInUp" data-delay=".3" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Enter your <span>tracking</span> ID </h1>
                                    <div class="primary-form"> <form action="tracking_details.php" method="post" name=""  novalidate=""> <input type="text" name="tracking-id" class="theme-input-style home-search" placeholder="Enter your tracking id" required=""> <button class="btn" style="border:0;" type="submit">Search</button> </form> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection