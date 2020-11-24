<!-- end container -->
<!-- ============================================================================ -->
<!-- START :: FOOTER -->
<!-- ============================================================================ -->
<!-- <div class="jumbotron text-center" style="margin-top:30px; margin-bottom:0px; background-color:white; height:200px;">
  <p>Footer</p>
</div> -->
<!-- ============================================================================ -->
<!-- END :: FOOTER -->
<!-- ============================================================================ -->
<script src="<?php echo base_url();?>resources/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>resources/js/popper.min.js"></script>
<script src="<?php echo base_url();?>resources/js/bootstrap.min.js"></script>
<script src="<?php echo site_url('public/vendor/notify/notify.js') ?>"></script>
<script src="<?php echo base_url();?>public/js/forms.js"></script>


<div class="w3l-middlefooter-sec" id="content-desktop">
			<div class="container py-md-5 py-sm-4 py-3">
				<div class="row footer-info w3-agileits-info">

					<!-- footer categories -->
					<div class="col-md-4 col-sm-6 footer-grids">



            <h3 class="text-white font-weight-bold">Details</h3>

            <span style="color:#bdbdbd;">Cmacbeth is your number one online shopping site in Nigeria. <a class="read-more-show hide" href="#"><span style="color:white;">Read More...</span></a> <span class="read-more-content"> We are an online store where you can purchase all your electronics, as well as books, home appliances, kiddies items, fashion items for men, women, and children; cool gadgets, computers, groceries, and more on the go. <a class="read-more-hide hide" href="#"><span style="color:white;">Read Less...</span></a></span></span>

            <?php //$cats = $this->db->order_by('RAND()', 'ASC')->limit('6')->get('category')->result(); ?>
						<!-- <ul>
              <?php //foreach ($cats as $key  => $cat) { ?>
							<li class="">
                <a href="<?php //echo site_url('/product/category/'.str_replace([' '], ['-'], strtolower($cat->name)))?>">
                  <?php //echo $cat->name; ?>
                </a>
              </li>
              <?php //} ?>
						</ul> -->
					</div>
					<!-- //footer categories -->
					<!-- quick links -->
					<div class="col-md-4 col-sm-6 footer-grids mt-sm-0 mt-4">
						<h3 class="text-white font-weight-bold">Quick Links</h3>
						<ul>
							<li class="">
								<a href="about.html">About Us</a>
							</li>
							<li class="">
								<a href="contact.html">Contact Us</a>
							</li>
							<li class="">
								<a href="help.html">Help</a>
							</li>
							<li class="">
								<a href="faqs.html">Faqs</a>
							</li>
							<li class="">
								<a href="terms.html">Terms of use</a>
							</li>
							<li>
								<a href="privacy.html">Privacy Policy</a>
							</li>
						</ul>
					</div>

					<div class="col-md-4 col-sm-6 footer-grids mt-md-0 mt-4">
						<h3 class="text-white font-weight-bold">Get in Touch</h3>
						<ul>
							<li class="">
								<i class="fa fa-map-marker"></i> 123 Sebastian, USA.</li>
							<li class="">
								<i class="fa fa-mobile"></i> 333 222 3333 </li>
							<li class="">
								<i class="fa fa-phone"></i> +222 11 4444 </li>
							<li class="">
								<i class="fa fa-envelope-open"></i>
								<a href="mailto:example@mail.com"> mail 1@example.com</a>
							</li>
							<li>
								<i class="fa fa-envelope-open"></i>
								<a href="mailto:example@mail.com"> mail 2@example.com</a>
							</li>
						</ul>
					</div>


					<!-- <div class="col-md-3 col-sm-6 footer-grids mt-md-0 mt-4">
						
						<iframe width="200" height="150" src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1">
						</iframe>
					</div> -->

				</div>
				<!-- //quick links -->
			</div>
		</div>




    <!-- =====================================third segment=======================================-->
    <div class="copy-right py-3" id="content-desktop">
      <div class="container">
        <p class="text-center text-white">© 2019 All rights reserved
        </p>
      </div>
    </div>
    <!-- =====================================third segment=======================================-->



    <!-- =================================START ::  MOBILE CONTENT=====================================-->
    <div class="copy-right py-3" id="content-mobile">
			<div class="container">
				<div class="row">
          <div class="col text-white">
            <span style="font-size:10px;">About Us</span>
          </div>

					<div class="col text-white">
						<span style="font-size:10px;">Help Center</span>
					</div>

          <div class="col text-white">
						<span style="font-size:10px;">Terms & Condition</span>
					</div>
					
					
				</div>


				<div style="border:solid 1px white" class="my-2">

				</div>

				<div class="row">
					<div class="col">
						<p class="text-center text-white">All rights reserved
						</p>
					</div>
				</div>

			</div>
		</div>
    <!-- ==================================END ::  MOBILE CONTENT=====================================-->














<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/public/vendor/slick/slick.min.js"></script>




	<script>
		$(document).ready(function(){

      //Start :: Read More Read Less Content ********************************
			$('.read-more-content').addClass('hide')
			$('.read-more-show, .read-more-hide').removeClass('hide')

			// Set up the toggle effect:
			$('.read-more-show').on('click', function(e) {
			  $(this).next('.read-more-content').removeClass('hide');
			  $(this).addClass('hide');
			  e.preventDefault();
			});

			// Changes contributed by @diego-rzg
			$('.read-more-hide').on('click', function(e) {
			  var p = $(this).parent('.read-more-content');
			  p.addClass('hide');
			  p.prev('.read-more-show').removeClass('hide'); // Hide only the preceding "Read More"
			  e.preventDefault();
			});
		//End  :: Read More Read Less Content ********************************





			$(".b-white").css({
				"background":"black",
				"border-radius":"50px"
			});
			$(".brand").css("color","black");
			$("#header-style").css("color","black");
			$(".card-top").css("padding","10px");
			$("#tcheck").css("color","black");

			$(".sty").mouseover(function(){
				$(this).css("background-color","lightgray");
			});
			$(".sty").mouseout(function(){
		    $(this).css("background-color", "");
		  });

			// =============set border countdown timer==============
			// $(".tmer").css({
			// 	"font-size":"16px",
			// 	"border":"solid 1px #dcdde1",
			// 	"padding":"10px",
			// 	"background":"#f7f8fa",
			// 	"color":"#0367d2",
			// 	"border-radius":"5px"
			// });

			// $("#bttn").click(function(){
			// 	$(this).slideToggle();
			// });


		});

		$(document).ready(function(){
			$("black").css({
				"color":"black",
				"font-weight":"bold"
			});
		});
	</script>

	<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();

    });
</script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery.flexisel.js"></script>

<script type="text/javascript">

$(window).load(function() {
  var $jqFlex = jQuery.noConflict(true);
    $jqFlex("#flexiselDemo1").flexisel(
      {
          visibleItems: 1,
          itemsToScroll: 1,
          autoPlay: {
              enable: true,
              interval: 11000,
              pauseOnHover: true
          },
          responsiveBreakpoints: {
              portrait: {
                  changePoint:480,
                  visibleItems: 1,
                  itemsToScroll: 1
              },
              landscape: {
                  changePoint:640,
                  visibleItems: 1,
                  itemsToScroll: 1
              },
              tablet: {
                  changePoint:768,
                  visibleItems: 1,
                  itemsToScroll: 1
              }
          },
      }
    );

    $jqFlex("#flexiselDemo2").flexisel({
        visibleItems: 4,
        itemsToScroll: 3,
        animationSpeed: 200,
        infinite: true,
        navigationTargetSelector: null,
        autoPlay: {
            enable: false,
            interval: 4000,
            pauseOnHover: true
        },
        responsiveBreakpoints: {
            portrait: {
                changePoint:480,
                visibleItems: 1,
                itemsToScroll: 1
            },
            landscape: {
                changePoint:640,
                visibleItems: 2,
                itemsToScroll: 2
            },
            tablet: {
                changePoint:768,
                visibleItems: 3,
                itemsToScroll: 3
            }
        },
        loaded: function(object) {
            console.log('Slider loaded...');
        },
        before: function(object){
            console.log('Before transition...');
        },
        after: function(object) {
            console.log('After transition...');
        },
        resize: function(object){
            console.log('After resize...');
        }
    });

    $jqFlex("#flexiselDemo3").flexisel({
        visibleItems: 3,
        itemsToScroll: 1,
        autoPlay: {
            enable: true,
            interval: 6000,
            pauseOnHover: true
        }
    });

    $jqFlex("#flexiselDemo4").flexisel({
        infinite: false
    });

    $jqFlex("#flexiselDemo11").flexisel(
			{
          visibleItems: 4,
          itemsToScroll: 1,
          autoPlay: {
              enable: true,
              interval: 11000,
              pauseOnHover: true
          },
          responsiveBreakpoints: {
              portrait: {
                  changePoint:480,
                  visibleItems: 2,
                  itemsToScroll: 1
              },
              landscape: {
                  changePoint:640,
                  visibleItems: 3,
                  itemsToScroll: 1
              },

              tablet: {
                  changePoint:768,
                  visibleItems: 3,
                  itemsToScroll: 1
              }
          },
      }
    );

    $jqFlex("#flexiselDemo12").flexisel(
			{
          visibleItems: 4,
          itemsToScroll: 1,
          autoPlay: {
              enable: true,
              interval: 8000,
              pauseOnHover: true
          },
          responsiveBreakpoints: {
              portrait: {
                  changePoint:480,
                  visibleItems: 2,
                  itemsToScroll: 1
              },
              landscape: {
                  changePoint:640,
                  visibleItems: 3,
                  itemsToScroll: 1
              },
              tablet: {
                  changePoint:768,
                  visibleItems: 3,
                  itemsToScroll: 1
              }
          },
      }
    );

    $jqFlex("#flexiselDemo13").flexisel(
			{
          visibleItems: 4,
          itemsToScroll: 1,
          autoPlay: {
              enable: true,
              interval: 10000,
              pauseOnHover: true
          },
          responsiveBreakpoints: {
              portrait: {
                  changePoint:480,
                  visibleItems: 2,
                  itemsToScroll: 1
              },
              landscape: {
                  changePoint:640,
                  visibleItems: 3,
                  itemsToScroll: 1
              },
              tablet: {
                  changePoint:768,
                  visibleItems: 3,
                  itemsToScroll: 1
              }
          },
      }
    );

    $jqFlex(".flexiselDemo144").flexisel(
			{
					visibleItems: 1,
					itemsToScroll: 1,
					autoPlay: {
							enable: true,
							interval: 7000,
							pauseOnHover: true
					}
			}
		);
    // var $jsSlick = jQuery.noConflict(true);
    // $jsSlick(".flexiselDemo144").slick({
    // 	slidesToShow: 1,
  	// 	slidesToScroll: 1,
  	// 	autoplay: true,
  	// 	autoplaySpeed: 2000,
    // });
    
    var $j = jQuery.noConflict(true);
    $j(".flexiselDemo14").slick({
    	slidesToShow: 1,
  		slidesToScroll: 1,
  		autoplay: true,
  		autoplaySpeed: 2000,
    });
    

    $jqFlex("#flexiselDemo15").flexisel(
			{
          visibleItems: 4,
          itemsToScroll: 1,
          autoPlay: {
              enable: true,
              interval: 7000,
              pauseOnHover: true
          },
          responsiveBreakpoints: {
              portrait: {
                  changePoint:480,
                  visibleItems: 2,
                  itemsToScroll: 1
              },
              landscape: {
                  changePoint:640,
                  visibleItems: 3,
                  itemsToScroll: 1
              },
              tablet: {
                  changePoint:768,
                  visibleItems: 3,
                  itemsToScroll: 1
              }
          },
      }
    );

		$jqFlex("#flexiselDemo16").flexisel(
			{
					visibleItems: 5,
					itemsToScroll: 1,
					autoPlay: {
							enable: true,
							interval: 7000,
							pauseOnHover: true
					}
			}
		);

		$jqFlex("#flexiselDemo17").flexisel(
			{
					visibleItems: 5,
					itemsToScroll: 1,
					autoPlay: {
							enable: true,
							interval: 7000,
							pauseOnHover: true
					}
			}
		);


		$jqFlex("#flexiselDemo18").flexisel(
      {
          visibleItems: 3,
          itemsToScroll: 1,
          autoPlay: {
              enable: true,
              interval: 11000,
              pauseOnHover: true
          },
          responsiveBreakpoints: {
              portrait: {
                  changePoint:480,
                  visibleItems: 2,
                  itemsToScroll: 1
              },
              landscape: {
                  changePoint:640,
                  visibleItems: 3,
                  itemsToScroll: 1
              },
              tablet: {
                  changePoint:768,
                  visibleItems: 3,
                  itemsToScroll: 1
              }
          },
      }
    );

});


$(document).ready(function(){
  $(".dropdown").hover(
      function() {
          $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
          $(this).toggleClass('open');
      },
      function() {
          $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
          $(this).toggleClass('open');
      }
  );

  // $("#demo").hide();
  //
  // $("#trest").click(function() {
  //   $(this).next().slideToggle(300);
  // });

// start :: first segment
  $("#demo").show();
    $("#trest").click(function() {
  	$("#demo").slideToggle(300);
  });
// end :: first segment

// start :: second segment
  $("#demo1").show();
    $("#trest1").click(function() {
  	$("#demo1").slideToggle(300);
  });
// end :: second segment

// start :: third segment
  $("#demo2").show();
    $("#trest2").click(function() {
  	$("#demo2").slideToggle(300);
  });
// end :: third segment

// start :: fourth segment
  $("#demo3").show();
    $("#trest3").click(function() {
  	$("#demo3").slideToggle(300);
  });
// end :: fourth segment








// COUNTDOWN TIMER
  function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
    // return time;
    console.log(date);

    $("#timer #days").html("<span>Days</span>" + date);
    $("#timer #hours").html("<span>Hours</span>" + hour);
    $("#timer #minutes").html("<span>Minutes</span>" + min);
    $("#timer #seconds").html("<span>Seconds</span>" + sec);
  }

  function makeTimer() {

    var endTime = new Date("September 01, 2020 00:00:00");
    var endTime = (Date.parse(endTime)) / 1000; //replace these two lines with the unix timestamp from the server

    var now = new Date();
    var now = (Date.parse(now) / 1000);

    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var Xmas95 = new Date('December 25, 1995 23:15:30');
    // console.log(Xmas95);
    // console.log(Date.parse(timeLeft * 1000));
    var hour = Xmas95.getHours();
    // console.log(hour);

    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));


    if (hours < "10") {
      hours = "0" + hours;
    }
    if (minutes < "10") {
      minutes = "0" + minutes;
    }
    if (seconds < "10") {
      seconds = "0" + seconds;
    }

    $("#timer #days").html("" + days);
    $("#timer #hours").html("" + hours);
    $("#timer #minutes").html("" + minutes);
    $("#timer #seconds").html("" + seconds);

  }

  setInterval(function() {
    makeTimer();
  }, 1000);

  // COUNTDOWN TIMER

});
</script>




<!-- popup modal (for location)-->
<script src="<?php echo base_url() ?>resources/js/jquery.magnific-popup.js"></script>
<script>
  $(document).ready(function () {
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

  });
</script>
<!-- //popup modal (for location)-->

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



<!-- imagezoom -->
<script src="<?php echo base_url();?>resources/js/imagezoom.js"></script>
<!-- //imagezoom -->

<!-- flexslider -->
<link rel="stylesheet" href="<?php echo base_url();?>resources/css/flexslider.css" type="text/css" media="screen" />

<script src="<?php echo base_url();?>resources/js/jquery.flexslider.js"></script>
<script>
  // Can also be used with $(document).ready()
  $(window).load(function () {
    $('.flexslider').flexslider({
      animation: "slide",
      controlNav: "thumbnails"
    });
  });
</script>
<!-- //FlexSlider-->

<!-- smoothscroll -->
<script src="<?php echo base_url();?>resources/js/SmoothScroll.min.js"></script>
<!-- //smoothscroll -->

<!-- start-smooth-scrolling -->
<script src="<?php echo base_url();?>resources/js/move-top.js"></script>
<script src="<?php echo base_url();?>resources/js/easing.js"></script>
<script>
  jQuery(document).ready(function ($) {
    $(".scroll").click(function (event) {
      event.preventDefault();

      $('html,body').animate({
        scrollTop: $(this.hash).offset().top
      }, 1000);
    });
  });
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
  $(document).ready(function () {
    /*
    var defaults = {
      containerID: 'toTop', // fading element id
      containerHoverID: 'toTopHover', // fading element hover id
      scrollSpeed: 1200,
      easingType: 'linear'
    };
    */
    $().UItoTop({
      easingType: 'easeOutQuart'
    });

  });
</script>


<script>
	$(document).ready(function() {
		$("#search_btn").click(function() {
			let key = $("#q").val();
			// alert(key);
			if (key === '') {
				alert("Query Must Not Be Empty");
			} else {
				window.location.assign('<?php echo site_url('product/search/'); ?>'+key);
			}
		});
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


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Added to cart (<?php echo count($this->cart->contents()); ?>) </small></b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="list-group">
          <?php foreach($this->cart->contents() as $item){ ?>
            <div class="list-group-item list-group-item-action">
              <a href="#">
                <div class="d-flex w-100">
                  <h5 class="mb-1"><?php echo $item['name'] ?> </h5>
                </div>
              </a>
              <div>
                <p>N<?php echo $this->cart->format_number($item['price']); ?></p>
                <a class="fa fa-trash remove_from_cart btn btn-sm btn-danger" href="<?php echo site_url('buyer/deletefromcart/'.$item['rowid']) ?>"></a>
                <form action="<?php echo site_url('buyer/updatecart'); ?>" class="form-row justify-content-center" msg="Updating Cart Content..." method="POST">
                  <input type="number" id="newqty" class="form-control col-sm-2" name="qty" value="<?php echo $item['qty'] ?>"/>
                  <input type="hidden" id="newoto" name="oto" value="<?php echo json_encode($item['options']['other_options']) ?>"/>
                  <input type="hidden" name="rowid" value="<?php echo $item['rowid'] ?>"/>
                  <input type="hidden" name="owner_id" value="<?php echo $item['options']['seller_id'] ?>"/>
                  <input type="hidden" name="product_id" value="<?php echo $item['options']['product_id'] ?>"/>
                  <button class="fas fa-upload btn btn-sm btn-warning col-sm-2"></button>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
        
        <br/>
        <div class="row">
          <div class="col">
          <button type="button" class="btn btn-warning btn-sm btn-block" data-dismiss="modal" aria-label="Close">CONTINUE SHOPPING</button>
          </div>

          <div class="col">
          <!-- <button type="button" class="btn btn-primary btn-sm btn-block">VIEW CART AND CHECKOUT</button> -->
          <a href="<?php echo base_url('buyer/cart/my_cart');?>" class="btn btn-primary btn-sm btn-block">VIEW CART</a>
          </div>

          <div class="col">
          <!-- <button type="button" class="btn btn-primary btn-sm btn-block">VIEW CART AND CHECKOUT</button> -->
          <a href="<?php echo base_url('buyer/check_out/');?>" class="btn btn-primary btn-sm btn-block">CHECKOUT <small class="float-right">N<?php echo $this->cart->format_number($this->cart->total());?></a>
          </div>
        </div>
        
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

