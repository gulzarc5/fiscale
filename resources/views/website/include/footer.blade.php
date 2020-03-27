    <footer class="footer" style="border-top: 1px solid #f1f1f1;">
        <div class="bottom-footer light-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-last order-lg-first">
                        <div class="copyright text-center text-lg-left">
                            <p class="m-0 pt-sans"><a style="color: #0075bb;font-weight: 700;">FISCALE BUSINESS SOLUTIONS</a> | All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 order-first order-lg-last">
                        <ul class="accepted-payments pt-sans nav align-items-center justify-content-center justify-content-lg-end">
                            <li><span>Developed By <a style="color: #0075bb;font-weight: 700;" href="https://webinfotech.net.in/" target="_blank">Webinfotech</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="back-to-top">
        <a href="#" class="d-flex align-items-center justify-content-center"> <img src="{{asset('web/img/icons/up-arrow.svg')}}" alt="" class="svg"> </a>
    </div>
    <script src="{{asset('web/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('web/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('web/plugins/waypoints/sticky.min.js')}}"></script>
    <script src="{{asset('web/plugins/swiper/swiper.min.js')}}"></script>
    <script src="{{asset('web/plugins/parsley/parsley.min.js')}}"></script>
    {{-- <script src="{{asset('web/plugins/color-switcher/color-switcher.js')}}"></script> --}}
    <script src="{{asset('web/plugins/retinajs/retina.min.js')}}"></script>
    {{-- <script src="{{asset('web/plugins/isotope/isotope.pkgd.min.js')}}"></script> --}}
    <script src="{{asset('web/plugins/ui-slider/jquery-ui.min.js')}}"></script>
    {{-- <script src="{{asset('web/plugins/light-box/lightbox.min.js')}}"></script> --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK9f7sXWmqQ1E-ufRXV3VpXOn_ifKsDuc"></script> --}}
    <script src="{{asset('web/js/menu.min.js')}}"></script>
    <script src="{{asset('web/js/scripts.js')}}"></script>
    <script src="{{asset('select2/js/select2.min.js')}}"></script>
    {{-- <script src="{{asset('web/js/custom.js')}}"></script> --}}
    <script>
       $(function(){
        var url = window.location.pathname, 
            urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); 
            $('.my a').each(function(){
                if(urlRegExp.test(this.href.replace(/\/$/,''))){
                    $(this).addClass('active');
                }
            });
        });
    </script>
</body>
</html>