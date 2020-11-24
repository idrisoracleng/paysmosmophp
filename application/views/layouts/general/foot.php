 <section class="brands-carousel mt-3">
                                    <h2 class="sr-only">Brands Carousel</h2>
                                    <div class="col-full" data-ride="tm-slick-carousel" data-wrap=".brands" data-slick="{&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;responsive&quot;:[{&quot;breakpoint&quot;:400,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:800,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
                                        <div class="brands">
                                            <?php $brands = $this->BrandsModel->getBrands(); ?>
                                             <?php foreach ($brands as $Key => $brand) { ?>
                                            <div class="item">
                                                <a href="<?php echo site_url('product/brand/'.$brand['name']) ?>">
                                                    <figure>
                                                        <figcaption class="text-overlay">
                                                            <div class="info">
                                                                <h4>apple</h4>
                                                            </div>
                                                            <!-- /.info -->
                                                        </figcaption>
                                                        <img width="145" height="50" class="img-responsive desaturate" alt="apple" src="<?php echo $brand['image_path']; ?>">
                                                    </figure>
                                                </a>
                                            </div>
                                            <?php } ?>
                                            <!-- .item -->
                                            
                                        </div>
                                    </div>
                                    <!-- .col-full -->
                                </section>
                                <!-- .brands-carousel -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .col-full -->
            </div>
            <!-- #content -->
<!-- END :: OF CONTENT PAGE brands  ========================================================================  -->










<!-- START :: START OF FOOTER =================================================================================  -->
 <footer class="site-footer footer-v1">
                <div class="col-full">
                    <div class="before-footer-wrap">
                        <div class="col-full">
                            <div class="footer-newsletter">
                                <div class="media">
                                    <i class="footer-newsletter-icon tm tm-newsletter"></i>
                                    <div class="media-body">
                                        <div class="clearfix">
                                            <div class="newsletter-header">
                                                <h5 class="newsletter-title">Sign up to Newsletter</h5>
                                                <!-- <span class="newsletter-marketing-text">...and receive
                                                    <strong>$20 coupon for first shopping</strong>
                                                </span> -->
                                            </div>
                                            
                                            <div class="newsletter-body">
                                                <form msg="Subscribing to news letter..." class="newsletter-form" action="<?php echo site_url('page/subscription/news_letter_subscription') ?>" method="POST">
                                                    <input type="text" name="name" placeholder="Enter your name">
                                                    <input type="text" name="email" placeholder="Enter your email address">
                                                    <button class="button" type="submit">Sign up</button>
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <!-- .footer-newsletter -->
                            <div class="footer-social-icons">
                                <ul class="social-icons nav">
                                    <li class="nav-item">
                                        <a class="sm-icon-label-link nav-link" href="#">
                                            <i class="fa fa-facebook"></i> Facebook</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="sm-icon-label-link nav-link" href="#">
                                            <i class="fa fa-instagram"></i> Instagram</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- .footer-social-icons -->
                        </div>
                        <!-- .col-full -->
                    </div>
                    <!-- .before-footer-wrap -->
                    <div class="footer-widgets-block">
                        <div class="row">
                            <div class="footer-contact">
                                <div class="footer-logo">
                                    <a href="<?php echo base_url();?>" class="custom-logo-link" rel="home">
                                       <!-- <img style=" width:100%;" src="<?php //echo site_url('public/images/system/sys/paysmosmo.png'); ?>" alt=""> -->
                                       <img src="<?php echo site_url('public/images/pss.png'); ?>" />
                                    </a>
                                </div>
                                <!-- .footer-logo -->
                                <div class="contact-payment-wrap">
                                    <div class="footer-contact-info">
                                        <div class="media">
                                            <span class="media-left icon media-middle">
                                                <i class="tm tm-call-us-footer"></i>
                                            </span>
                                            <div class="media-body">
                                                <span class="call-us-title">Got Questions ? Call us 24/7</span>
                                                <span class="call-us-text">0700PAYSMOSMO</span>
                                                <address class="footer-contact-address">40, SEINDE CALLISTO CRESCENT,<br />
                                                  OFF AIRPORT ROAD, OSHODI, LAGOS<br />
                                                  PHONE NO: 0700PAYSMOSMO (0700 729 766 766)<br />
                                                  E-MAIL: info@paysmosmo.com<br />
                                                </address>
                                                <!-- <a href="#" class="footer-address-map-link">
                                                    <i class="tm tm-map-marker"></i>Find us on map</a> -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .footer-contact-info -->
                                    <!-- <div class="footer-payment-info">
                                        <div class="media">
                                            <span class="media-left icon media-middle">
                                                <i class="tm tm-safe-payments"></i>
                                            </span>
                                            <div class="media-body">
                                                <h5 class="footer-payment-info-title">We are using safe payments</h5>
                                                <div class="footer-payment-icons">
                                                    <ul class="list-payment-icons nav">
                                                        <li class="nav-item">
                                                            <img class="payment-icon-image" src="<?php echo base_url();?>assets/images/credit-cards/mastercard.svg" alt="mastercard" />
                                                        </li>
                                                        <li class="nav-item">
                                                            <img class="payment-icon-image" src="<?php echo base_url();?>assets/images/credit-cards/visa.svg" alt="visa" />
                                                        </li>
                                                        <li class="nav-item">
                                                            <img class="payment-icon-image" src="<?php echo base_url();?>assets/images/credit-cards/paypal.svg" alt="paypal" />
                                                        </li>
                                                        <li class="nav-item">
                                                            <img class="payment-icon-image" src="<?php echo base_url();?>assets/images/credit-cards/maestro.svg" alt="maestro" />
                                                        </li>
                                                    </ul>
                                                </div>
                                                
                                                <div class="footer-secure-by-info">
                                                    <h6 class="footer-secured-by-title">Secured by:</h6>
                                                    <ul class="footer-secured-by-icons">
                                                        <li class="nav-item">
                                                            <img class="secure-icons-image" src="<?php echo base_url();?>assets/images/secured-by/norton.svg" alt="norton" />
                                                        </li>
                                                        <li class="nav-item">
                                                            <img class="secure-icons-image" src="<?php echo base_url();?>assets/images/secured-by/mcafee.svg" alt="mcafee" />
                                                        </li>
                                                    </ul>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div> -->
                                    
                                </div>
                                
                            </div>
                            <!-- .footer-contact -->
                            <div class="footer-widgets">
                                <div class="columns">
                                    <aside class="widget clearfix">
                                        <div class="body">
                                            <h4 class="widget-title">Find it Fast</h4>
                                            <?php $featuredCategories = $this->db->order_by('RAND()', 'ASC')->get_where('category', ['featured' => 1])->result(); ?>
                                            <div class="menu-footer-menu-1-container">
                                                <ul id="menu-footer-menu-1" class="menu">
                                                    <?php foreach ($featuredCategories as $key => $category) { ?>
                                                        <li class="menu-item">
                                                            <a href="<?php echo site_url('product/category/'.str_replace([' '], ['-'], strtolower($category->name))); ?>"><?php echo $category->name; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <!-- .menu-footer-menu-1-container -->
                                        </div>
                                        <!-- .body -->
                                    </aside>
                                    <!-- .widget -->
                                </div>
                                <!-- .columns -->
                                <!-- <div class="columns">
                                    <aside class="widget clearfix">
                                        <div class="body">
                                            <h4 class="widget-title">&nbsp;</h4>
                                            <div class="menu-footer-menu-2-container">
                                                <ul id="menu-footer-menu-2" class="menu">
                                                    <li class="menu-item">
                                                        <a href="shop.html">Printers &#038; Ink</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="shop.html">Audio &amp; Music</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="shop.html">Home Theaters</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="shop.html">PC Components</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="shop.html">Ultrabooks</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="shop.html">Smartwatches</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                        
                                    </aside>
                                    
                                </div> -->
                                <!-- .columns -->
                                <div class="columns">
                                    <aside class="widget clearfix">
                                        <div class="body">
                                            <h4 class="widget-title">Customer Care</h4>
                                            <div class="menu-footer-menu-3-container">
                                                <ul id="menu-footer-menu-3" class="menu">
                                                    <li class="menu-item">
                                                        <a href="login-and-register.html">My Account</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="track-your-order.html">Track Order</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="shop.html">Shop</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="wishlist.html">Wishlist</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="about.html">About Us</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="terms-and-conditions.html">Returns/Exchange</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="faq.html">FAQs</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- .menu-footer-menu-3-container -->
                                        </div>
                                        <!-- .body -->
                                    </aside>
                                    <!-- .widget -->
                                </div>
                                <!-- .columns -->
                            </div>
                            <!-- .footer-widgets -->
                        </div>
                        <!-- .row -->
                    </div>
                    <!-- .footer-widgets-block -->
                    <div class="site-info">
                        <div class="col-full">
                            <div class="copyright">Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url();?>"></a>  All rights reserved.</div>
                            <!-- .copyright -->
                            <div class="credit">TECHEND</div>
                            <!-- .credit -->
                        </div>
                        <!-- .col-full -->
                    </div>
                    <!-- .site-info -->
                </div>
                <!-- .col-full -->
            </footer>
            <!-- .site-footer -->
        </div>
        <script src="<?php echo site_url('public/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/tether.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery-migrate.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/hidemaxlistitem.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/hidemaxlistitem.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/scrollup.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.waypoints.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/waypoints-sticky.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/pace.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/slick.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url();?>public/js/forms.js"></script>
        <script src="<?php echo base_url();?>public/js/sb-admin.js"></script>
        <script src="<?php echo base_url();?>public/js/add_to_cart.js"></script>
        <script src="<?php echo site_url('public/vendor/yall/yall.min.js') ?>"></script>
        <script src="<?php echo site_url('public/vendor/swal/sweetalert2.all.min.js') ?>"></script>

         <script src="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>


          <!-- popup modal (for location)-->
        <script src="<?php echo base_url() ?>resources/js/jquery.magnific-popup.js"></script>
         <script>
        $(document).ready(function () {


            $('.owl-carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    nav:false,
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:3
                        },
                        1000:{
                            items:4
                        }
                    }
            })

            $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
            });

        })
    </script>






     <!-- cart-js -->
        <script src="<?php echo base_url();?>resources/js/minicart.js"></script>
        <script>
        paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js

        paypals.minicarts.cart.on('checkout', function (evt) {
            var items = this.items(),
            len = items.length,
            total = 0,
            i;

            // Count the number of each item in the cart
            for (i = 0; i < len; i++) {
            total += items[i].get('quantity');
            }

            if (total < 3) {
            alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
            evt.preventDefault();
            }
        });
        </script>
        <!-- //cart-js -->


        <script>
            $(document).ready(function() {
                $("#search_btn").click(function() {
                    let key = $("#q").val();
                    let cat = $("#cat").val();
                    // alert(key);
                    if (key === '') {
                        alert("Query Must Not Be Empty");
                    } else {
                        window.location.assign('<?php echo site_url('product/search/'); ?>'+key);
                    }
                });

                $("#q").keyup(function () {
                    let key = $("#q").val();
                    if (key == '') {
                        $("#search_bar_result").html('');
                    } else {
                        $.get('<?php echo site_url('product/live_search/') ?>'+key, {}, (data) => {
                            console.log(data);
                            $("#search_bar_result").html(data);
                        });
                    }
                })
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#search_btn_s").click(function() {
                    let key = $("#q_s").val();
                    // alert(key);
                    if (key === '') {
                        alert("Query Must Not Be Empty");
                    } else {
                        window.location.assign('<?php echo site_url('product/search/'); ?>'+key);
                    }
                });
            });
        </script>
        
    </body>
</html>
    <script>
        $(document).ready(function () {
            $('.product').mouseover(function() {
                // alert($(this).attr('id'));
                // var id = $(this).attr('id');
                // $(`#${id}`).addClass(' shadow-lg ');
                $(this).addClass('shadow-lg rounded-lg border border-dark');
            });

            $('.product').mouseleave(function () {
                $(this).removeClass('shadow-lg rounded-lg border border-dark');
            });
            
        });
    </script>
    <script src="https://polyfill.io/v2/polyfill.min.js?features=IntersectionObserver"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        yall({
          observeChanges: true,
          events: {
            load: function (event) {
              if (!event.target.classList.contains("lazy") && event.target.nodeName == "IMG") {
                event.target.classList.add("yall-loaded");
              }
            },
            play: function (event) {
              if (event.target.nodeName == "VIDEO") {
                event.target.nextElementSibling.classList.add("visible");
              }
            },
            error: {
              listener: function (event) {
                if (!event.target.classList.contains("lazy") && event.target.nodeName == "IMG") {
                  event.target.classList.add("yall-error");
                  event.target.nextElementSibling.classList.add("visible");
                }
              },
              options: {
                once: true
              }
            }
          }
        });
      });

      document.addEventListener("DOMContentLoaded", function() {
        var markupContainer = document.getElementById("dynamic-markup-container");
        var addMarkupButton = document.getElementById("add-markup");
        var serverMarkup = document.getElementById("server-markup").innerHTML;

        addMarkupButton.addEventListener("click", function() {
          document.body.removeChild(addMarkupButton);
          markupContainer.innerHTML = serverMarkup;
        });
      });
    </script>

    <?php if ($this->session->flashdata('msg')) { 
        $type = '';
        if ($this->session->flashdata('flag') == 'danger') {
            $type = 'error';
        } else {
            $type = $this->session->flashdata('flag');
        }
        ?>
		
        <script>
            $(document).ready(function () {
                Swal.fire(
                    {
                        title: 'Message',
                        text: '<?php echo $this->session->flashdata('msg') ?>',
                        icon: '<?php echo $type; ?>',
                    }
                )
            });
        </script>
    <?php } ?>