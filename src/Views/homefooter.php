<?php
$output = "
    <div class='mobile-menu-wrapper'>
        <div class='mobile-menu-overlay'></div>
        <!-- End of .mobile-menu-overlay -->

        <a href='#' class='mobile-menu-close'><i class='close-icon'></i></a>
        <!-- End of .mobile-menu-close -->

        <div class='mobile-menu-container scrollable'>
            <form action='#' method='get' class='input-wrapper'>
                <input type='text' class='form-control' name='search' autocomplete='off' placeholder='Search'
                    required />
                <button class='btn btn-search' type='submit'>
                    <i class='w-icon-search'></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <div class='tab'>
                <ul class='nav nav-tabs' role='tablist'>
                    <li class='nav-item'>
                        <a href='#main-menu' class='nav-link active'>Main Menu</a>
                    </li>
                    <li class='nav-item'>
                        <a href='#categories' class='nav-link'>Categories</a>
                    </li>
                </ul>
            </div>
            <div class='tab-content'>
                <div class='tab-pane active' id='main-menu'>
                    <ul class='mobile-menu'>
                        <li><a href=''>Home</a></li>
                        <li>
                            <a href=''>Shop</a>
                            
                        </li>
                        
                    </ul>
                </div>
                <div class='tab-pane' id='categories'>
                    <ul class='mobile-menu'>
                        
                </div>
            </div>
        </div>
    </div>
        <footer class='footer appear-animate'>
            <div class='footer-newsletter bg-primary'>
                <div class='container'>
                    <div class='row justify-content-center align-items-center'>
                        <div class='col-xl-5 col-lg-6'>
                            <div class='icon-box icon-box-side text-white'>
                                <div class='icon-box-icon d-inline-flex'>
                                    <i class='w-icon-envelop3'></i>
                                </div>
                                <div class='icon-box-content'>
                                    <h4 class='icon-box-title text-white text-uppercase font-weight-bold'>Subscribe To
                                        Our Newsletter</h4>
                                    <p class='text-white'>Get all the latest information on Events, Sales and Offers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class='col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 '>
                            <form action='#' method='get'
                                class='input-wrapper input-wrapper-inline input-wrapper-rounded'>
                                <input type='email' class='form-control mr-2 bg-white' name='email' id='email'
                                    placeholder='Your E-mail Address' />
                                <button class='btn btn-dark btn-rounded' type='submit'>Subscribe<i
                                        class='w-icon-long-arrow-right'></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class='container'>
                <div class='footer-top'>
                    <div class='row'>
                        <div class='col-lg-6 col-sm-12'>
                            <div class='widget widget-about' style='width:100% !important'>
                                <a href='{$this->page->link}/' class='logo-footer'>
                                    <img src='{$this->page->link}/vensle-assets/images/logo2.png' alt='logo-footer' width='144'
                                        height='45' />
                                </a>
                                <div class='widget-body' style='color:black !important'>
                                    <p class='' >{$this->page->metaDescription}
                                    </p>
                                    <p>You can visit our <a href='{$this->page->link}/faq'>frequently asked question FAQ </a> or you can click on the <a href='{$this->page->link}/sell-buy'>Sell/Buy Tutorial</a> link to have a comprehensive guide of all the functionalities and how you can take good advantage of them. Thank you for using <a href='{$this->page->link}/'> vensle.com </a></p>

                                    <div class='social-icons social-icons-colored'>
                                        <a href='https://www.facebook.com/VensleOfficial' class='social-icon social-facebook w-icon-facebook'></a>
                                        <a href='https://twitter.com/Vensle_Official' class='social-icon social-twitter w-icon-twitter'></a>
                                        <a href='https://www.instagram.com/vensleofficial' class='social-icon social-instagram w-icon-instagram'></a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6'>
                            <div class='widget'>
                                <h3 class='widget-title'>Company</h3>
                                <ul class='widget-body'>
                                    <li><a href='{$this->page->link}/about'>About Us</a></li>
                                    <li><a href='{$this->page->link}/sell-buy'>Tutorial</a></li>
                                    <li><a href='{$this->page->link}/policy/product-listing'>Product Listing Policy</a></li>
                                   
                                    <li><a href='{$this->page->link}/policy/privacy-policy'>Privacy Policy</a></li>
                                    <li><a href='{$this->page->link}/policy/terms-conditions'>Terms of Use</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class='col-lg-3 col-sm-6'>
                            <div class='widget'>
                                <h4 class='widget-title'>Help Center</h4>
                                <ul class='widget-body'>
                                    <li><a href='{$this->page->link}/contact'>Contact Us</a></li>
                                    <li><a href='{$this->page->link}/faq'>Frequently asked questions!</a></li>
                                    <li><a href='{$this->page->link}/contact'>Report Abuse</a></li>
                                    <li><a href='{$this->page->link}/contact'>Support Center</a></li>
                                    <li><a href='{$this->page->link}/sell-buy'>Sell\Buy Tutorial</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class='footer-bottom'>
                    <div class='footer-left'>
                        <p class='copyright'>Copyright © 2021 Vensle MarketPlace. All Rights Reserved.</p>
                    </div>
                    <div class='footer-right'>
                        <span class='payment-label mr-lg-8'>We're using safe payment for</span>
                        <figure class='payment'>
                            <img src='{$this->page->link}/vensle-assets/V11/images/payment.png' alt='payment' width='159' height='25' />
                        </figure>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Start of Scroll Top -->
    <a id='scroll-top' class='scroll-top' href='#top' title='Top' role='button'> <i class='w-icon-angle-up'></i> <svg
            version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 70 70'>
            <circle id='progress-indicator' fill='transparent' stroke='#000000' stroke-miterlimit='10' cx='35' cy='35'
                r='34' style='stroke-dasharray: 16.4198, 400;'></circle>
        </svg> </a>
    <!-- End of Scroll Top -->


        
";

if(!isset($remove_jquery)) {
    $output .="
    <script src='{$this->page->link}/vensle-assets/backend/js/lib/jquery/jquery.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/js/owl.carousel.min.js'></script>
    ";
}
$output .= "
    <script src='{$this->page->link}/vensle-assets/V11/vendor/jquery/jquery.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/V11/vendor/jquery.plugin/jquery.plugin.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/V11/vendor/imagesloaded/imagesloaded.pkgd.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/V11/vendor/zoom/jquery.zoom.js'></script>
    <script src='{$this->page->link}/vensle-assets/V11/vendor/jquery.countdown/jquery.countdown.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/V11/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>
    <script src='{$this->page->link}/vensle-assets/V11/vendor/skrollr/skrollr.min.js'></script>

    <!-- Swiper JS -->
    <script src='{$this->page->link}/vensle-assets/V11/vendor/swiper/swiper-bundle.min.js'></script>

    <!-- Main JS -->
    <script src='{$this->page->link}/vensle-assets/V11/js/main.min.js'></script>
    

    ";
$output .= isset($footer_custom_library) ? $footer_custom_library : "";


return $output;