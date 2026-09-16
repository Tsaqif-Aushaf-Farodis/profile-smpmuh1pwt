        <footer class="main-footer">
            <div class="main-footer__bg" style="background-image: url(assets/images/shapes/footer-bg-1.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-5 wow fadeInUp" data-wow-delay="100ms">
                        <div class="main-footer__about">
                            <a href="/" class="main-footer__logo">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="SMPMuOne"  height="55">
                            </a><!-- /.footer-logo -->
                            <p class="main-footer__about__text">Beriman | Mandiri | Berprestasi | Berjiwa Pemimpin</p>
                            <div class="main-footer__social">
                                <a href="https://www.facebook.com/smpmuh1pwt" target="_blank" ><i class="fab fa-facebook"></i></a>                        
                                <a href="https://www.instagram.com/smpmuhammadiyah1pwt" target="_blank" ><i class="fab fa-instagram"></i></a>         
                                <a href="https://www.tiktok.com/@smpmuonepwt"  target="_blank"><i class="fab fa-tiktok"></i></a>
                                <a href="https://wa.me/6285877535383"  target="_blank"><i class="fab fa-whatsapp"></i></a>   
                            </div><!-- /.footer-social -->
                        </div><!-- footer-top -->
                    </div>
                    <div class="col-xl-3 col-md-4 wow fadeInUp" data-wow-delay="200ms">
                        <div class="main-footer__navmenu main-footer__widget01">
                            <h3 class="main-footer__title">Tautan</h3>
                            <ul>
                                <li><a href="https://ppdb.smpmuh1pwt.my.id/">PPDB</a></li>
                                <!--<li><a href="kontak.html">Kontak Kami</a></li>-->
                              
                            </ul><!-- /.list-unstyled -->
                        </div><!-- /.footer-menu -->
                    </div>
                    <div class="col-xl-2 col-md-3 wow fadeInUp" data-wow-delay="300ms">
                        <div class="main-footer__navmenu main-footer__widget02">
                            <h3 class="main-footer__title">Jelajah</h3>
                            <ul>
                                <li><a href="/program">Program</a></li>
                                <li><a href="/prestasi">Prestasi</a></li>
                                <li><a href="/berita">Artikel</a></li>
                                <li><a href="/tenaga-pendidik">Guru & Staff</a></li>
                                <li><a href="/galeri">Galeri</a></li>
                                
                            </ul><!-- /.list-unstyled -->
                        </div><!-- /.footer-menu -->
                    </div>
                    <div class="col-xl-4 col-md-12 wow fadeInUp" data-wow-delay="400ms">
                        <div class="main-footer__newsletter">
                            <h3 class="main-footer__title">Kontak Kami</h3>
                            <ul class="main-footer__info-list">
                                <li><span class="icon-Location"></span>Jln. Perintis Kemerdekaan No. 6 Purwokerto</li>
                                <li><span class="icon-Telephone"></span><a href="tel:+62281637782">(0281) 637782</a></li>
                                <li><span class="icon-Email"></span><a href="mailto:smpmuh1pwt@yahoo.com">smpmuh1pwt@yahoo.com</a></li>
                            </ul>
                           
                        </div><!-- /.footer-mailchimp -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </footer><!-- /.main-footer -->

        <section class="copyright text-center">
            <div class="container wow fadeInUp" data-wow-delay="400ms">
                <p class="copyright__text">Copyright <span class="dynamic-year"></span><!-- /.dynamic-year --> | SMP Muhammadiyah 1 Purwokerto. All Rights Reserved</p>
            </div><!-- /.container -->
        </section><!-- /.copyright -->

    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="/" aria-label="logo image"><img src="{{ asset('assets/images/logo.png') }}" width="183" alt="eduact" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->
            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:smpmuh1pwt@yahoo.com">smpmuh1pwt@yahoo.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:+62281637782">(0281) 637782</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__social">
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>            
                <a href="https://www.instagram.com/smpmuhammadiyah1pwt/"><i class="fab fa-instagram"></i></a>
            </div><!-- /.mobile-nav__social -->
        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <!-- back-to-top-start -->
    <a href="#" class="scroll-top">
        <svg class="scroll-top__circle" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </a>
    <!-- back-to-top-end -->


    <script src="{{ asset('assets/vendors/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/odometer/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circleType/jquery.circleType.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-lettering/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tilt/tilt.jquery.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('assets/vendors/countdown/countdown.min.js') }}"></script>
    <!-- template js -->
    <script src="{{ asset('assets/js/eduact.js') }}"></script>
</body>

</html>