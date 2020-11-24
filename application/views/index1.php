<?php $activeDealsOfTheDay = $this->DealsOfTheDayModel->getActiveDealsOfTheDay(); ?>
<?php $featuredProducts = $this->ProductModel->getFeaturedProducts(); ?>
            <div id="content" class="site-content">
                <div class="col-full">
                    <div class="row">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <!-- <div class="home-v1-slider home-slider">
                                   
                                    <?php //$banners = $this->BannersModel->getBanners(); ?>
                                    <?php //$i = 1; foreach ($banners as $key => $banner) { ?>
                                        <div class="<?php //echo ($i != 1) ? 'slider-1 ' : '' ?>slider-<?php //echo $i; ?>" style="background-image: url(<?php //echo base_url();?>assets/images/slider/home-v1-background.jpg);">
                                                
                                            <img src="<?php //echo $banner['image_path'];?>" alt="<?php //echo $banner['name']; ?>">
                                            
                                            <div class="caption">
                                                <div class="title">Turn. Click. Expand. Smart modular design simplifies adding storage for growing media.</div>
                                                <div class="sub-title">Powerful Six Core processor, vibrant 4KUHD display output and fast SSD elegantly cased in a soft alloy design.</div>
                                                <a class="button" href="#">Get Yours now
                                                    <i class="tm tm-long-arrow-right"></i>
                                                </a>
                                                <div class="bottom-caption"></div>
                                            </div>
                                        </div>
                                    <?php  //$i++; } ?> 
                                    
                                   
                                </div> -->
                              




<div class="container-fluid" style="margin-top:20px;margin-bottom:40px;">
                
           <!--  <div class= "container-fluid"> -->

            <div class="row">
            <div class="card col-lg-2" style="border-radius:0px;">
                    <ul class="cat_menu">
                        <div class="" style="padding-bottom: 5px;">
                            <?php $parentCategories = $this->CategoryModel->getParentCategories(); ?>
                                <?php 
                                    $sty = array('fa fa-desktop','fas fa-tv','fas fa-mobile','fas fa-paint-brush','fas fa-home');

                                    $count_icon = 0;
                                    foreach ($parentCategories as $key => $category) { ?>
                                     <li class ="hassubs" style="height:32px; font-size:.75rem;">
                                        <a title="<?php echo $category->name; ?>" style="font-size:.75rem;" href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))?>"> 
                                            <i class="<?php echo $sty[$count_icon];?>"></i>
                                                <?php echo $category->name; ?> <i class="ml-auto"></i>
                                        </a>
                                    </li>

                                <?php $count_icon++;} ?>
                            
                           <!--  <li class ="hassubs" style="height:32px;"><a style="font-size:.75rem;" href="#">Phones and Tablets<i class="fas fa-mobile"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Electronics<i class="fas fa-tv"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Home & Kitchen<i class="fas fa-home"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Fashion<i class="fas fa-female"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Baby, Kids & Toys<i class="fas fa-paint-brush"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Car Electronics<i class="fas fa-car"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Fashion<i class="fas fa-female"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Baby, Kids & Toys<i class="fas fa-paint-brush"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Car Electronics<i class="fas fa-car"></i></a></li>
                            <li class ="hassubs" style="height:32px;"><a href="#" style="font-size:.75rem;">Accessories<i class="fas fa-headphones"></i></a></li>
                            <li class="hassubs"  style="height:32px; padding-bottom: 5px;;"><a href="#" style="font-size:.75rem;"> <i class="fa fa-ellipsis-h"></i> Other items <i class="ml-auto"></i></a></li> -->
                        </div>
                        </ul>
               </div>
               <div class="card col-lg-10" style="border: none; background: none; padding-right: 0px;  height: 384px;">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                      </ol>
                        <div class="carousel-inner" style=" height: 384px;">
                          <div class="carousel-item active">
                            <img src="<?php echo base_url();?>assetz/images/newyear PSS.jpg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="<?php echo base_url();?>assetz/images/promopss.jpg" class="d-block w-100" alt="...">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                </div>
               </div>
               </div>

           <!--  </div> -->
            </div>


















                                <div class="features-list">
                                    <div class="features">
                                        <div class="feature">
                                            <div class="media">
                                                <i class="feature-icon d-flex mr-3 tm tm-free-delivery"></i>
                                                <div class="media-body feature-text">
                                                    <h5 class="mt-0">Free Delivery</h5>
                                                    <span>from 100,000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .feature -->
                                        <div class="feature">
                                            <div class="media">
                                                <i class="feature-icon d-flex mr-3 tm tm-feedback"></i>
                                                <div class="media-body feature-text">
                                                    <h5 class="mt-0">99% Customer</h5>
                                                    <span>Feedbacks</span>
                                                </div>
                                            </div>
                                            <!-- .media -->
                                        </div>
                                        <!-- .feature -->
                                        <div class="feature">
                                            <div class="media">
                                                <i class="feature-icon d-flex mr-3 tm tm-free-return"></i>
                                                <div class="media-body feature-text">
                                                    <h5 class="mt-0">365 Days</h5>
                                                    <span>for free return</span>
                                                </div>
                                            </div>
                                            <!-- .media -->
                                        </div>
                                        <!-- .feature -->
                                        <div class="feature">
                                            <div class="media">
                                                <i class="feature-icon d-flex mr-3 tm tm-safe-payments"></i>
                                                <div class="media-body feature-text">
                                                    <h5 class="mt-0">Payment</h5>
                                                    <span>Secure System</span>
                                                </div>
                                            </div>
                                            <!-- .media -->
                                        </div>
                                        <!-- .feature -->
                                        <div class="feature">
                                            <div class="media">
                                                <i class="feature-icon d-flex mr-3 tm tm-best-brands"></i>
                                                <div class="media-body feature-text">
                                                    <h5 class="mt-0">Only Best</h5>
                                                    <span>Brands</span>
                                                </div>
                                            </div>
                                            <!-- .media -->
                                        </div>
                                        <!-- .feature -->
                                    </div>
                                    <!-- .features -->
                                </div>
                                <!-- /.features list -->








<!-- <div class="row">
<div class="card-body bg-gray">
    <div class="row">
        <div class="col">
            <img class="card-img-top" src="<?php //echo base_url();?>assets/images/banner/b.png" alt="Photo of sunset">
        </div>
        <div class="col">
            <img class="card-img-top" src="<?php //echo base_url();?>assets/images/banner/b1.png" alt="Photo of sunset">
        </div>
        <div class="col">
            <img class="card-img-top" src="<?php //echo base_url();?>assets/images/banner/b2.png" alt="Photo of sunset">
        </div>
        <div class="col">
            <img class="card-img-top" src="<?php //echo base_url();?>assets/images/banner/b3.png" alt="Photo of sunset">
        </div>
        <div class="col">
            <img class="card-img-top" src="<?php //echo base_url();?>assets/images/banner/b4.png" alt="Photo of sunset">
        </div>

    </div>

</div>
</div> -->

<!-- END :: /.second row -->





<!-- ============================================ ./ END FIRST SEGMENT ========================================= -->




<div class="">
    


               


            <div>

<!-- ==================================================== ./ END SECOND SEGMENT ==================================== -->









       





<!-- ==================================================== ./ END FIFTH SEGMENT ==================================== -->  





<!-- ends here ======================================================================================================-->







<div class="row mt-3">
  <div class="col-lg-12">
        <div class="card">
    <div class="card-header text-white" style="background: #fff;">
    
      <h5 class="card-title" style="font-size: 1.25rem;"><b>Top selling items</b> <span style="float: right; color: #4fa748">View all<i class="fa fa-angle-right"></i></span></h5>

     <!--  <a href="#">
         <span class="pull-right text-white">view all</span> 
      </a> -->
      
    </div>
    <div class="card-body">

        <div class="row">
            <?php foreach($products as $product){ ?>
                <?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); ?>
             
                <div class="col-md-2 text-center rounded shadow" style="border: 1px solid lemon;">
                    <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
                    <img
                        style="height: 150px; width: 150px;"
                        src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" alt="First slide">
                    </a>

                    <div class="thumb-content">
                        <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
                            <p class="black" style="margin-bottom:0px;font-size:12px;"><?php echo $product['name']; ?></p>
                        </a>
                        <p class="black text-center" style="margin-bottom:0px;font-size: 1.20rem;color:black;">
                            ₦ <?php echo ($variants) ? number_format($variants[0]->price/4) : number_format($product['price']/4); ?>


                            <!--  ₦ <?php //echo ($variants) ? ($variants[0]->price/4).' Paid Monthly' : ($product['price']/4).' Paid Monthly'; ?> -->
                        </p>
                        <p style="font-size:12px;margin-bottom:10px;margin-top:0px;">Per Month</p>
                        <?php //$this->load->view('layouts/product/addToCartIcon', $product); ?>
                    </div>
                </div>
              
            <?php } ?>
        </div>

        

    </div>

    </div>
  </div>
</div>
<!-- end first row -->




<!-- Popular Categories -->
    <div class="popular_categories mt-3" style="padding-bottom:0px; padding-top: 8px;">
        <div class="card h-100">
            <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title"><h5 style="color:black;"><b>Popular Categories</b></h5></div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                        <div class="popular_categories_link" ><a href="#">full catalog</a></div>
                    </div>
                </div>
                
                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="<?php echo base_url();?>assetz/images/popular_1.png" alt=""></div>
                                    <div class="popular_category_text">Smartphones & Tablets</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="<?php echo base_url();?>assetz/images/popular_2.png" alt=""></div>
                                    <div class="popular_category_text">Computers & Laptops</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="<?php echo base_url();?>assetz/images/popular_3.png" alt=""></div>
                                    <div class="popular_category_text">Gadgets</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="<?php echo base_url();?>assetz/images/popular_4.png" alt=""></div>
                                    <div class="popular_category_text">Video Games & Consoles</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="<?php echo base_url();?>assetz/images/popular_5.png" alt=""></div>
                                    <div class="popular_category_text">Accessories</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div>



<!-- ==================================================== ./ END FOURTH SEGMENT ==================================== --> 




<div style="padding-top: 16px;" class="mt-3">
                    
        <div class="card">
                    <div class="card-body bg-danger" style="padding-top: 8px; padding-bottom: 0px;">
                      <h5 class="card-title" style="font-size: 1.25rem;"><b>Deals of the day</b> <span style="float: right; color: #4fa748">View all <i class="fa fa-angle-right"></i></span></h5>  
                    </div>
                <?php
                 // $url = "https://api.paysmosmo.com/inventory?limit=3&offset=0&category=5c82bebd8c68e3615a48ac63";
                 // $pr = getinfo($url);
                ?>

                <div class="card-deck">
                            <?php foreach($activeDealsOfTheDay as $key => $product){ ?>
                                <div class="card col-lg-2" style="border: 0px;" >
                                <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>?from=deal">
                                    <img style="padding:0px; margin-bottom: 10px;" src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" class="card-img-top" alt="...">
                                </a>
                                <div>  
                                <a href="">
                                <div class="card-body" style="padding:0px">
                                    <p class="" style="margin-bottom:0px; font-size: .75rem;"><?php //echo mb_strimwidth ($prod["name"], 0, 25, ".."); ?></p>
                                </div>
                                  <b style="font-size: 1.55rem; margin-bottom:0px;">₦ <?php //echo ($prod["price"])/4; ?> <p class="text-muted" style="font-size: .55rem;">Per Month</p></b>
                                </a> 
                                </div>
                                </div>
                            <?php } ?>
                    </div>
            </div>


            <div class="modal" tabindex="-1" role="dialog" id="myModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php //echo $prod['name'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4"><img  src="<?php //echo $img; ?>" style="height:150px; width:150px;"  alt="..."></div>
                        <div class="col-md-4 ml-auto"><b style="font-size:1.55rem">₦<?php //echo ($prod["price"])/4; ?></b></div>
                        <p class="text-muted" style="font-size: .55rem">Monthly</p>
                    </div>
                    <p><?php //echo ($prod["description"]); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning">Add to cart</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            
            
    </div>

            <!-- <div class="container" style="padding-top: 16px;">
                    <div class=" row card-group">
                    <div class="card col-lg-6" style="padding: 0%; border: none;">
                      <img src="<?php echo base_url();?>assetz/images/1100x500ii.jpg" class="card-img-top" style="padding: 10px;" alt="...">
                      
                    </div>
                    
                    <div class="card col-lg-6" style="padding:0%; border: none;">
                      <img src="<?php echo base_url();?>assetz/images/1100x500ii.jpg" class="card-img-top" style="padding: 10px;" alt="...">
                      </div>
                    </div>
                    </div> -->
                  </div>
            </div>

<!-- ==================================================== ./ END FIFTH SEGMENT ==================================== -->  










<!-- 2020 remove the style attribute n added a new class called new-style-->
<?php $pos = 1; $parentCategories = $this->CategoryModel->getParentCategories(); ?>

<?php foreach ($parentCategories as $key  => $parentCategory) { ?>
    <div class="mt-3" id="content-desktop">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
            <div class="card-header text-white" style="background:#b3b300;">
                 <h4 class="card-title" style="font-size: 1.25rem;"><b><?php echo $parentCategory->name; ?> 


                <?php //echo $parentCategory->name; ?>
                <a href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($parentCategory->name)))?>">
                    <span style="float: right; color: #4fa748">View all<i class="fa fa-angle-right"></i></span>
                </a>
                </b>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $parentSubCategories = $this->CategoryModel->getSubCategories($parentCategory->id); ?>
                    <?php foreach ($parentSubCategories as $key => $parentSubCategory) { ?>
                    <?php $products = $this->db->get_where('products', ['category_id' => $parentSubCategory['id'], 'status' => 'approved'])->result(); ?>
                    <?php foreach ($products as $key => $product) { ?>
                        <?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product->product_id])->result(); ?>
                        <div class="col-md-2 text-center shadow rounded" style="border:solid 1px lemon;">
                            <a href="<?php echo site_url('/product/'.str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($product->name)))?>">
                            <img src="<?php echo site_url('/public/images/products/'.$product->code.'/01.jpg'); ?>"  style="height: 150px; width: 150px;"/>
                            </a>
                            <div>
                            <p style="font-size: 12px;margin-bottom: 0px;"><?php echo $product->name; ?></p>
                            <?php if ($variants && $variants[0]->price != 0) { $product->price = $variants[0]->price; ?>
                                <span class="">
                                    <?php if ($variants[0]->discount_price) { ?>
                                        <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($variants[0]->discount_price/4); ?></span><br>
                                        <strike style="font-size: 12px;">₦<?php echo ($variants[0]->price/4); ?></strike>
                                        <small style="margin-bottom:10px;">Per Month</small>
                                    <?php } else { ?>
                                        <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($variants[0]->price/4); ?></span><br>
                                        <small style="margin-bottom:10px;">Per Month</small>
                                    <?php } ?>
                                </span>
                            <?php } else { ?>
                                <span class="">
                                    <?php if ($product->discount_price) { ?>
                                        <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($product->discount_price/4); ?></span><br>
                                        <strike style="font-size: 12px;">₦<?php echo $product->price ?></strike>
                                        <small style="margin-bottom:10px;">Per Month</small>
                                    <?php } else { ?>
                                        <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($product->price/4); ?></span><br>
                                        <small style="margin-bottom:10px;">Per Month</small>
                                    <?php } ?>
                                </span>
                            <?php } ?>
                            </div>
                            <?php //$this->load->view('layouts/product/product_rating', (array)$product); ?>
                            <?php //$this->load->view('layouts/product/addToCartIcon', (array)$product); ?>
                        </div>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>

            </div>
            </div>
        </div>
    </div>

<?php $ads = $this->AdsBannersModel->getAdsBannersBy(['position' => $pos]); ?>
  <?php if ($ads)  { ?>
    <div class="container-fluid"  style="margin-top:10px;margin-bottom:3px;" id="content-desktop">
            <!-- <div class="card-header bg-white"> -->
                <div class="row">
                    <?php foreach ($ads as $key => $ad) { ?>
                        <div class="col-lg-6 col-md-6 col-12 py-2 px-1">
                            <a href="<?php echo $ad['link'];?>">
                                <img src="<?php echo $ad['image_path'];?>" class="card-img-top" alt="...">
                            </a>
                        </div>
                    <?php } ?>
                </div>
     <!--  </div> -->
    </div>
    


<?php  } ?>



  <?php $pos++;} ?>







<div class="row mt-3" style="margin-bottom: 0px;">
  <div class="col-lg-12">
        <div class="card">
   <!--  <div class="card-header text-white" style="background: #b3b300;">
      Popular brands
    </div> -->
    <div class="card-body">
            <div class="row">
                <?php $brands = $this->BrandsModel->getBrands(); ?>
              <?php foreach ($brands as $Key => $brand) { ?>
                <div class="col"><a href="<?php echo site_url('product/brand/'.$brand['name']) ?>"><img src="<?php echo $brand['image_path']; ?>" /></a></div>
              <?php } ?>
            </div>
        </div>

    </div>
  </div>
</div>
<!-- end first row -->
             
                                
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



            




            