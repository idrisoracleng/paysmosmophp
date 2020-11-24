<style>
.scrolltop {
	display:none;
	width:100%;
	margin:0 auto;
	position:fixed;
	bottom:20px;
	right:10px;	
}
.scroll {
	position:absolute;
	right:20px;
	bottom:20px;
	background:#b2b2b2;
	background:rgba(178,178,178,0.7);
	padding:20px;
	text-align: center;
	margin: 0 0 0 0;
	cursor:pointer;
	transition: 0.5s;
	-moz-transition: 0.5s;
	-webkit-transition: 0.5s;
	-o-transition: 0.5s; 		
}
.scroll:hover {
	background:rgba(178,178,178,1.0);
	transition: 0.5s;
	-moz-transition: 0.5s;
	-webkit-transition: 0.5s;
	-o-transition: 0.5s; 		
}
.scroll:hover .fa {
	padding-top:-10px;
}
.scroll .fa {
	font-size:30px;
	margin-top:-5px;
	margin-left:1px;
	transition: 0.5s;
	-moz-transition: 0.5s;
	-webkit-transition: 0.5s;
	-o-transition: 0.5s; 	
}
</style>



<?php $activeDealsOfTheDay = $this->DealsOfTheDayModel->getActiveDealsOfTheDay(); ?>
<?php $featuredProducts = $this->ProductModel->getFeaturedProducts(); ?>
<div class="container" style="margin-top:20px;">
                
            <div class= "container">

            <div class="row">
            <div class="card col-lg-2" style="border-radius:0px;">
                    <ul class="cat_menu">
                        <div class="" style="padding-bottom: 5px;">
                            <?php $parentCategories = $this->CategoryModel->getParentCategories(); ?>
                                <?php 
                                    
                                    foreach ($parentCategories as $key => $category) { ?>
                                     <li class ="hassubs" style="height:32px; font-size:.75rem;">
                                        <a title="<?php echo $category->name; ?>" style="font-size:.75rem;" href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))?>"> 
                                            <i class="fa fa-desktop"></i>
                                                <?php echo $category->name; ?> <i class="ml-auto"></i>
                                        </a>
                                    </li>

                                    <!-- <li class="menu-item animate-dropdown">
                                        <a title="<?php //echo $category->name; ?>" href="<?php //echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))?>"><?php //echo $category->name; ?></a>
                                    </li> -->
                                <?php } ?>
                            
                           

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

            </div>
            </div>


            <div class='scrolltop'>
                <div class='scroll icon'><i class="fa fa-4x fa-angle-up"></i></div>
            </div>   
        <div class="container">

        <div>
        
        <div class="characteristics" style="padding-top:16px; padding-bottom:16px;" >
            <div class="">
                <div class="row">
    
                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col" >
                        
                        <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background-color:white; border-bottom-left-radius: 20px; ">
                            <div class="char_icon"><img style="height:50px; width:50px;" src="<?php echo base_url();?>assetz/images/delivery-man.png" alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Fast Delivery</div>
                                <div class="char_subtitle">from ₦750</div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col">
                        
                        <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background-color:white; border-bottom-left-radius: 20px;">
                            <div class="char_icon"><img style="height:50px; width:50px;" src="<?php echo base_url();?>assetz/images/box.png" alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Return Policy</div>
                                <div class="char_subtitle">100% Warranty</div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col">
                        
                        <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background-color:white; border-bottom-left-radius: 20px;">
                            <div class="char_icon"><img style="height:50px; width:50px;" src="<?php echo base_url();?>assetz/images/megaphone.png"alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Promo Prizes</div>
                                <div class="char_subtitle">Flashy Sales for you</div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col" >
                        
                        <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background-color:white; border-bottom-left-radius: 20px;">
                            <div class="char_icon"><img style="height:50px; width:50px;" src="<?php echo base_url();?>assetz/images/top.png"></div>
                            <div class="char_content">
                                <div class="char_title">Top Deals</div>
                                <div class="char_subtitle">Exciting deals</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<!-- ============================================ ./ END FIRST SEGMENT ========================================= -->




<div class="">
    <div class="card" style="margin-bottom: 16px;">
        <div class="card-body" style="padding-bottom:0px;">
          <h5 class="card-title" style="font-size: 1.25rem;"><b>Top selling items</b> <span style="float: right; color: #4fa748">View all<i class="fa fa-angle-right"></i></span></h5>
          <hr>
        </div>

        <div class="card-deck">
             <?php foreach($products as $product){ ?>
                <?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); ?>
             
            <div class="card col-lg-2" style="border: 0px;" >
                <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
                    <img style="padding:0px; margin-bottom: 10px;" src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" class="card-img-top" alt="...">
                </a>
                <div>  
                    <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
                        <div class="card-body" style="padding:0px">
                            <p class="" style="margin-bottom:0px; font-size: .75rem;"><?php echo mb_strimwidth ($product['name'], 0, 25, ".."); ?></p>
                        </div>
                        <b style="font-size: 1.55rem; margin-bottom:0px;color:black;">₦ <?php echo number_format(($product['price'])/4); ?> <p class="text-muted" style="font-size: .55rem;">Per Month</p></b>
                    </a> 
                </div>
            </div>
             <?php } ?>
        </div>
    </div>


                <!-- start modal -->
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
                <!-- end modal -->


            <div>

<!-- ==================================================== ./ END SECOND SEGMENT ==================================== -->









<!-- ==================================================== ./ END THIRD SEGMENT ==================================== -->


        
        
<!-- Popular Categories -->
    <div class="popular_categories" style="padding-bottom:0px; padding-top: 8px;">
        <div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
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
    </div>



<!-- ==================================================== ./ END FOURTH SEGMENT ==================================== -->        



<div style="padding-top: 16px;">
                    
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
            <div class="card-header bg-white" style="font-size: 1.25rem;">
                <b><?php echo $parentCategory->name; ?></b>

                <a href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($parentCategory->name)))?>">
                    <!-- <span class="pull-right text-white">view more</span> -->
                    <span style="float: right; color: #4fa748">View all<i class="fa fa-angle-right"></i></span>
                </a>
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
                                <p class="" style="margin-bottom:0px; font-size: .75rem;"><?php echo mb_strimwidth ($product->name, 0, 25, ".."); ?></p>
                            <!-- <p><?php //echo $product->name; ?></p> -->
                            

                            <?php if ($variants && $variants[0]->price != 0) { $product->price = $variants[0]->price; ?>
                                <span class="">
                                    <?php if ($variants[0]->discount_price) { ?>
                                    
                                        <b style="font-size: .95rem; margin-bottom:0px;" class="">₦ <?php echo ($variants[0]->discount_price/4); ?>
                                        <p class="text-muted" style="font-size: .55rem;">
                                        <strike style="font-size: .75rem;">₦ <?php echo number_format(($variants[0]->price/4)); ?></strike><br>
                                            Per Month
                                        </p>
                                        

                                        </b>
                                        
                                    <?php } else { ?>
                                        <b style="font-size: .95rem; margin-bottom:0px;" class="">₦ <?php echo ($variants[0]->price/4); ?><p class="text-muted" style="font-size: .55rem;">Per Month</p></b>
                                    <?php } ?>
                                </span>
                            <?php } else { ?>
                                <span class="">
                                    <?php if ($product->discount_price) { ?>
                                   
                                        <b style="font-size: .95rem; margin-bottom:0px;" class="">₦<?php echo number_format(($product->discount_price/4)); ?>
                                        <p class="text-muted" style="font-size: .55rem;">
                                    <strike  style="font-size: .75rem;">₦ <?php echo number_format($product->price); ?></strike><br>
                                            Per Month
                                        </p>  
                                        </b>
                                        
                                         
                                    <?php } else { ?>
                                        <b style="font-size: 1.00rem; margin-bottom:0px;" class="">₦<?php echo ($product->price/4); ?><p class="text-muted" style="font-size: .55rem;">Per Month</p></b>
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
    <div class="container"  style="margin-top:10px;margin-bottom:10px;" id="content-desktop">
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
      <!-- </div> -->
    </div>
    


<?php  } ?>



  <?php $pos++;} ?>


           

                <div class="adverts" style="padding-bottom: 16px; padding-top: 16px;">
                    <div class="">
                        <div class="row">
            
                            <div class="col-lg-4 advert_col" >
                                
                                <!-- Advert Item -->
            
                                <div class="advert d-flex flex-row align-items-center justify-content-start" style="background-color: white;">
                                    <div class="advert_content">
                                        <div class="advert_title"><a href="#">Trends 2020</a></div>
                                        <div class="advert_text">Get yourself in the mood with this B & O headset.</div>
                                    </div>
                                    <div class="ml-auto"><div class="advert_image"><img src="<?php echo base_url();?>assetz/images/adv_1.png" alt=""></div></div>
                                </div>
                            </div>
            
            
                            <div class="col-lg-4 advert_col">
                                
                                <!-- Advert Item -->
            
                                <div class="advert d-flex flex-row align-items-center justify-content-start" style="background-color: white;">
                                    <div class="advert_content">
                                        <div class="advert_title"><a href="#">Trends 2020</a></div>
                                        <div class="advert_text">Your house, Your party club. With this sony sound system experience magic.</div>
                                    </div>
                                    <div class="ml-auto"><div class="advert_image"><img src="<?php echo base_url();?>assetz/images/adv_3.png" alt=""></div></div>
                                </div>
                            </div>

                            <div class="col-lg-4 advert_col">
                                
                                <!-- Advert Item -->
            
                                <div class="advert d-flex flex-row align-items-center justify-content-start" style="background-color: white;">
                                    <div class="advert_content">
                                        <div class="advert_title"><a href="#">Trends 2020</a></div>
                                        <div class="advert_text">Ever though of the view from the sky? Get the drone now</div>
                                    </div>
                                    <div class="ml-auto"><div class="advert_image"><img src="<?php echo base_url();?>assetz/images/trends_3.jpg" alt=""></div></div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            

            <!-- Company Info -->

        <div class="jumbotron jumbotron-fluid bg-white" style="border-radius: 5px;">
            <div class="container">
              <h1 class="display-4" style="font-weight: 400; font-size: 1.5rem"><b>Paysmosmo</b></h1>
              <p class="lead" style="font-size: .75rem" >Paysmosmo is your number one online shopping site in Nigeria. We are an online store where you can purchase all your electronics, as well as books, home appliances, kiddies items, fashion items for men, women, and children; cool gadgets, computers, groceries, automobile parts, and more on the go. What more? You can have them delivered directly to you. Shop online with great ease as you pay with to Paysmosmo which guarantees you the safest online shopping payment method, allowing you to make stress free payments. 
                <br>
                <br> Whatever it is you wish to buy, Paysmosmo offers you all and lots more at prices which you can trust. Paysmosmo has payment options for everyone irrespective of taste, class, and preferences. Here, you also have the option to make your payment on delivery for extra convenience. Shopping online in Nigeria is easy and convenient with Paysmosmo. We provide you with a wide range of products you can trust. 
                <br>
                <br>Take part in the deals of the day and discover the best prices on a wide range of products.
                <br>
                <br>Step out in style with Paysmosmo Fashion and Style as we bring you awesome fashion collections from top brands such as Zara, Woodin, Fever London, St Genevieve, top quality shirts, vintage shirts and footwear from Nigerian indigenous designers like David Wej. Moreover, you can look through our wide selection of Ankara style and make your pick for that next event you have. Also, get classy women's shoes from top designers like Plum, Qupid as well as watches from Casio, Titan and more. 
                <br>
                <br> Paysmosmo makes online shopping fun with our new arrivals as well as huge discounts on a large selection of fashion items and more. Paysmosmo has the original New Look fashion brand online for you to shop.</p>
            </div>
    </div>

                                
</div>
</div>
</div>
                                
</div>
</div>
</div>

<!-- Newsletter -->

<script>
$(window).scroll(function() {
    if ($(this).scrollTop() > 50 ) {
        $('.scrolltop:hidden').stop(true, true).fadeIn();
    } else {
        $('.scrolltop').stop(true, true).fadeOut();
    }
});
$(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".thetop").offset().top},"1000");return false})})
</script>