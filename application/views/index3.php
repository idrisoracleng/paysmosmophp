<?php $activeDealsOfTheDay = $this->DealsOfTheDayModel->getActiveDealsOfTheDay(); ?>
<?php $featuredProducts = $this->ProductModel->getFeaturedProducts(); ?>

	<!--======================================================================= -->
	<!-- Content DESKTOP STARTS HERE -->
	<!-- ====================================================================== -->

	<div class="container-fluid" id="content-desktop" style="margin-bottom:20px;margin-top:20px;">
		<div class="row">
			<div class="col" style="background:white;border:1px solid silver; margin-left:20px;margin-right:20px;padding:10px;border-radius:20px;">
				<a href="<?php echo site_url('gift_shop'); ?>">
					<img src="<?php echo site_url();?>resources/images/ham.png" alt="" width='40px'>
					<span class="font-weight-bold text-center">Gift Shop</span>
				</a>
			</div>
			<div class="col" style="background:white;border:1px solid silver; margin-right:20px;padding:10px;border-radius:20px;">
			  <img src="<?php echo base_url();?>resources/images/ham.png" alt="" width='40px'>
			  <span class="font-weight-bold">paysmosmo</span>
			</div>
			<div class="col" style="background:white;border:1px solid silver; margin-right:20px;padding:10px;border-radius:20px;">
			  <img src="<?php echo base_url();?>resources/images/ham.png" alt="" width='40px'>
			  <span class="font-weight-bold">Global Shopping</span>
			</div>
		</div>
	</div>
	
	
	<ul class="flexiselDemo14 mt-2" id="content-desktop">
		<?php $banners = $this->BannersModel->getBanners(); ?>
		<?php foreach ($banners as $key => $banner) { ?>
		  <li>
			<a href="<?php echo $banner['link'] ?>">
			  <img src="<?php echo $banner['image_path']?>"/>
			</a>
		  </li>
		<?php } ?>
	</ul>
	
	
	
	
	<!-- <div class="container-fluid mt-3" id="content-desktop">
	  <div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		  <div class="card">
			<div class="card-body">
			  <h3 id="header-style">Featured Categories</h3>
			  <div class="row">
				<?php //$featuredCategories = $this->CategoryModel->getFeaturedCategory();?>
				<?php //foreach($featuredCategories as $key => $featuredCategory) { ?>
					<div class="col-sm-2 sty" style="border-top:solid 5px #D3D3D3;border-right:solid 5px #D3D3D3;border-bottom:solid 5px #D3D3D3;border-left:solid 5px #D3D3D3;">
						<a href="<?php //echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '-_'], strtolower($featuredCategory['name'])))?>">
							<img class="content-image" src="<?php //echo $featuredCategory['icon_image_path'];?>">
							<p class="text-center"><?php //echo $featuredCategory['name'] ?></p>
						</a>
					</div>
				<?php //} ?>
			  </div>

			</div>
		  </div>
		</div>
	  </div>
	</div> -->






  <div class="container-fluid mt-3" id="content-desktop">
	  <div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		  <div class="card rounded">
		  	<div class="card-header text-white font-weight-bold" style="background: #de0f05;">
		  		Featured Categories
		  	</div>
			<div class="card-body">
			  <div class="row">
				<?php $featuredCategories = $this->CategoryModel->getFeaturedCategory();?>
				<?php foreach($featuredCategories as $key => $featuredCategory) { ?>
					<div class="col-sm-2 sty" style="border-top:solid 5px #D3D3D3;border-right:solid 5px #D3D3D3;border-bottom:solid 5px #D3D3D3;border-left:solid 5px #D3D3D3;">
						<a href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '-_'], strtolower($featuredCategory['name'])))?>">
							<img class="content-image" src="<?php echo $featuredCategory['icon_image_path'];?>">
							<p class="text-center"><?php echo $featuredCategory['name'] ?></p>
						</a>
					</div>
				<?php } ?>
			  </div>

			</div>
		  </div>
		</div>
	  </div>
	</div>




  
<div class="container-fluid mt-3" id="content-desktop">
	<div class="row">
	  <div class="col-lg-12">
	        <div class="card">
	    <div class="card-header font-weight-bold text-white" style="background: #4a4a4a;">
	        Top collections
	        <a href="">
	        	<span class="pull-right text-white">view more</span>
	        </a>
	    </div>
	    <div class="card-body">
	    	<div class="row">
	    	<?php foreach($products as $product){ ?>
							<?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); ?>
             
             	<div class="col">
                <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
                  <img
                    class=""
                    style="height: 200px"
                    src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" alt="First slide">
                </a>

                <div class="thumb-content">
									<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
										<h4 class="black"><?php echo $product['name'] ?></h4>
									</a>
                  <p class="item-price black"><span class="price">₦ <?php echo ($variants) ? $variants[0]->price : $product['price'] ?></span></p>

                </div>
                </div>
              
            <?php } ?>
            </div>
	    </div>

	    </div>
	  </div>
	</div>
</div>
	
<!-- end first row -->


<div class="mt-3" style="margin-bottom:20px;background: #0063d1;">
    <div class="col-full">
        <p class="message text-center text-white" style="font-size: 20px;padding: 10px;">Download our new app today! Dont miss our mobile-only offers and shop with Android Play.</p>
    </div>
    
</div>





<div class="container-fluid mt-3" id="content-desktop">
	<div class="row">
	  <div class="col-lg-12">
	        <div class="card">
	    <div class="card-header font-weight-bold text-white" style="background: #de0f05;">
	    	<div class="row">
	    		<div class="col">
	    			Latest deal
	    		</div>

	    		<div id="timer" class="h5 col text-center">
					<ul>
					  <li>Time Left : </li>
					  <li id="days" class="tmer">. ..</li>:
					  <li id="hours" class="tmer">...</li>:
					  <li id="minutes" class="tmer">...</li>:
					  <li id="seconds" class="tmer">...</li>
					</ul>
				  </div>
				  <div class="col">
				  	<a href="">
			        	<span class="pull-right text-white">view more</span>
			        </a>
				  </div>
	    	</div>
	        
	        
	        
	    </div>
	    <div class="card-body">
	    	<div class="row">
	    		<?php //echo count($activeDealsOfTheDay); ?>
				<?php foreach($activeDealsOfTheDay as $key => $product){ ?>
					<div class="col">
						<div class="content">
							<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>?from=deal">
								<div class="content-overlay"></div>
								<img class="content-image" src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" style="height:200px;width:200px;">
							</a>

							<div class="thumb-content">
								<li>
									<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>?from=deal">
										<?php echo $product['name']; ?>
									</a><br>
									<?php $this->load->view('layouts/product/product_rating', $product); ?>
										<p><?php //echo character_limiter($product['short_description'], 75).'</p>';
										if($product['deal_price']){ 
									?>

									<strike>₦<?php echo $product['price'] ?></strike> <span class="price">₦<?php echo $product['deal_price'] ?></span>
									<?php }else{ ?>
										<span class="price">₦<?php echo $product['price'] ?></span>
									<?php } $this->load->view('layouts/product/addToCartIcon', $product);?>
								</li>
							</div>
						</div>
					</div>	
				<?php } ?>
            </div>
	    </div>

	    </div>
	  </div>
	</div>
</div>
	
<!-- end first row -->







<div class="container-fluid mt-3" id="content-desktop">
	<div class="row">
	  <div class="col-lg-12">
	        <div class="card">
	    <div class="card-header font-weight-bold text-white" style="background: #4a4a4a;">
	        Featured products
	        <a href="">
	        	<span class="pull-right text-white">view more</span>
	        </a>
	    </div>

	    <div class="card-body">
	    	<div class="row">
	    	<?php foreach ($featuredProducts as $key => $featuredProduct) { ?>
				<div class="col">
				  <div class="content">
					<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($featuredProduct['name'])));?>?from=market">
					  <div class="content-overlay"></div>
					  <img class="content-image" src="<?php echo base_url('public/images/products/'.$featuredProduct['code'].'/01.jpg');?>" style="width:200px;">
					  <div class="content-details fadeIn-top">
						<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($featuredProduct['name'])));?>?from=market"></a>
					  </div>
					</a>
					

					<div class="thumb-content" style="margin-bottom:10px;">
						
						<h4 class="">
							<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($featuredProduct['name'])));?>?from=market"><?php echo $featuredProduct['name'] ?></a>
								
							
						</h4>
						<span class="item-price">
						  <?php if ($featuredProduct['discount_price']) { ?>
						  <strike>₦<?php echo $featuredProduct['price'] ?></strike>
						  <span class="price">₦<?php echo $featuredProduct['discount_price'] ?></span>
						  <?php } else { ?>
						  <span class="price">₦<?php echo $featuredProduct['price'] ?></span>
						  <?php } ?>
						</span>
						<?php $this->load->view('layouts/product/product_rating', $featuredProduct); ?>
						<?php $this->load->view('layouts/product/addToCartIcon', $featuredProduct); ?>

					</div>
					</div>
				  </div>

					

				  
			  <?php } ?>
            </div>
	    </div>

	    </div>
	  </div>
	</div>
</div>
	
<!-- end first row -->












<!-- 2020 remove the style attribute n added a new class called new-style-->
<?php $pos = 1; $parentCategories = $this->CategoryModel->getParentCategories(); ?>

<?php foreach ($parentCategories as $key  => $parentCategory) { ?>



	<div class="container-fluid mt-3" id="content-desktop">
	<div class="row">
	  <div class="col-lg-12">
	        <div class="card">
	    <div class="card-header font-weight-bold text-white" style="background: #4a4a4a;">
	        <?php echo $parentCategory->name; ?>


	        <a href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($parentCategory->name)))?>">
	        	<span class="pull-right text-white">view more</span>
	        </a>

	    </div>
	    <div class="card-body">
	    	<div class="row">
	    		<?php $parentSubCategories = $this->CategoryModel->getSubCategories($parentCategory->id); ?>
              <?php foreach ($parentSubCategories as $key => $parentSubCategory) { ?>
                <div class="col" style="border:solid 10px silver;">
                  <a href="<?php echo site_url('/product/category/'.str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($parentSubCategory['name'])))?>">
                    <img src="<?php echo site_url('/public/images/system/categories/'.str_replace([' ', "'"], ['-', '_'], strtolower($parentSubCategory['name'].'.jpg'))); ?>"  height="200px"/>
                  </a>
                </div>
              <?php } ?>
            </div>
	    </div>

	    </div>
	  </div>
	</div>
</div>

<?php $ads = $this->AdsBannersModel->getAdsBannersBy(['position' => $pos]); ?>
  <?php if ($ads)  { ?>
    <div class="container-fluid"  style="margin-top:10px;margin-bottom:10px;" id="content-desktop">
			<div class="card-header bg-white">
				<div class="row">
					<?php foreach ($ads as $key => $ad) { ?>
						<div class="col-lg-6 col-md-6 col-12 py-2 px-1">
							<a href="<?php echo $ad['link'];?>">
								<img src="<?php echo $ad['image_path'];?>" class="card-img-top" alt="...">
							</a>
						</div>
					<?php } ?>
				</div>
      </div>
    </div>
	


<?php  } ?>



  <?php $pos++;} ?>







<div class="container-fluid mt-3" id="content-desktop">
	<div class="row">
	  <div class="col-lg-12">
	        <div class="card">
      <div class="card-header font-weight-bold text-white" style="background: #4a4a4a;">
	        Popular brands
	    </div>
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
</div>
	
<!-- end first row -->





	
	
	
	
	
	
	
	<!--======================================================================= -->
	<!-- Content DESKTOP ENDS HERE -->
	<!-- ====================================================================== -->
	













	
	
	
	
	
	
	<!--======================================================================= -->
	<!-- Content MOBILE STARTS HERE -->
	<!-- ====================================================================== -->
	
	<div class="container bg-white mt-2" id="content-mobile">

      <div class="card-body">
        <div class="row">
					<div class="col" style="background:white;">
					  <a href="<?php echo site_url('gift_shop'); ?>">
							<center>
								<img src="<?php echo site_url();?>resources/images/ham.png" alt="" class="img-fluid" width='30px'><br>
								FGIFT SHOP
							</center>
						</a>
          </div>
          <div class="col" style="background:white;">
            <center>
              <img src="<?php echo base_url();?>resources/images/ham.png" alt="" class="img-fluid" width='30px'><br>
              CMACBETH
            </center>
          </div>
          <div class="col" style="background:white;">
            <center>
              <img src="<?php echo base_url();?>resources/images/ham.png" alt="" class="img-fluid" width='30px'><br>
              SHOPPING
            </center>
          </div>
        </div>

      </div>

</div>
	
	
	
	<ul class="flexiselDemo14 mt-2" id="content-mobile">
		<?php $banners = $this->BannersModel->getBanners(); ?>
		<?php foreach ($banners as $key => $banner) { ?>
		  <li>
			<a href="<?php echo $banner['link'] ?>">
			  <img src="<?php echo $banner['image_path']?>"/>
			</a>
		  </li>
		<?php } ?>
	</ul>
	
	
	
	<div class="container-fluid mt-2 bg-white" id="content-mobile">
	  <div class="row">
		<div class="col">
		  <span id="header-style" style="font-size:18px;">Featured Categories</span>
		  <div class="row">
			<?php $featuredCategories = $this->CategoryModel->getFeaturedCategory();?>
			<?php foreach($featuredCategories as $key => $featuredCategory) { ?>
			  <div class="col-4 sty" style="border-top:solid 5px #D3D3D3;border-right:solid 5px #D3D3D3;border-bottom:solid 5px #D3D3D3;border-left:solid 5px #D3D3D3;">
				<a href="<?php echo site_url('/product/category/'.str_replace([' '], ['-'], strtolower($featuredCategory['name'])))?>">
				  <img class="content-image" src="<?php echo $featuredCategory['icon_image_path'];?>">
				  <!-- <p class="text-center" style="font-size: 10px;"><?php //echo $featuredCategory['name'] ?></p> -->
				</a>
			  </div>
			<?php } ?>
		  </div>
		</div>
	  </div>
	</div>
	
	
	
	
	<!-- DEALS OF THE DAY MOBILE CONTENT -->
<div class="container-fluid mt-10 bg-white" id="content-mobile" style="margin-top:10px;">
  <div class="row">
    <div class="col">
      <span id="header-style" style="font-size:18px;">Deals of The Day</span>

      <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php $max = 0;  foreach($activeDealsOfTheDay as $product){ ?>
            <div class="carousel-item <?php if($max == 0){echo "active"; }?>"  >

              <div class="row">
                <div class="col-6">
                  <div class="content">
                    <a href="#">
                      <div class="content-overlay"></div>
                      <img class="content-image" src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" width="200px">
                      <div class="content-details fadeIn-top">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" title=""><i class="fa fa-eye"></i></button>
                      </div>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div class="thumb-content">
                    <span><a><?php echo $product['name'] ?></a></span>

                    <?php $this->load->view('layouts/product/product_rating', $product); ?>
                    <span><?php echo $product['short_description'] ?></span>

                    <p class="item-price">
                      <?php if($product['deal_price']){ ?>
                        <strike>₦<?php echo $product['price'] ?></strike> <span class="price">₦<?php echo $product['deal_price'] ?></span>
                      <?php }else{ ?>
                        <span class="price">₦<?php echo $product['deal_price'] ?></span>
                      <?php } ?>
                    </p>
                        <?php $this->load->view('layouts/product/addToCartIcon', $product); ?>
                  </div>
          </div>

          <!-- timer countdown -->
          <div class="card" style="width: 18rem;border:none;">
            <div class="card-body" style="">
              <div id="timer" class="h5">
                <ul>
                  <li id="days" class="tmer">...</li>:
                  <li id="hours" class="tmer">...</li>:
                  <li id="minutes" class="tmer">...</li>:
                  <li id="seconds" class="tmer">...</li>
                </ul>
              </div>
            </div>
          </div>
              </div>
            </div>
          <?php
            if($max == 3){
              break;
            }else{
              $max++;
            }
          } ?>


          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>

          <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>


    </div>
  </div>
</div>
<!-- /.DEALS OF THE DAY MOBILE CONTENT -->


<div style="margin-top:10px;" id="content-mobile">
  <div class="row">
    <div class="col">
      <a href="<?php echo base_url();?>index.php/Categories">
        <img src="<?php echo base_url();?>resources/images/a4.jpg" alt="...">
      </a>
    </div>
  </div>
</div>



<!-- FEATURED PRODUCTS MOBILE CONTENT -->
<div class="container-fluid mt-10 bg-white" id="content-mobile" style="margin-top:10px;">
  <div class="row">
    <div class="col">
      <span id="header-style" style="font-size:18px;">Featured Products</span>
      <ul id="flexiselDemo188" style="background:white;">
        <?php foreach ($featuredProducts as $key => $featuredProduct) { ?>
          <li>
            <div class="content">
              <a href="#">
                <div class="content-overlay"></div>
                <img class="content-image" src="<?php echo base_url();?>resources/images/ade.jpg" width="200px">
                <div class="content-details fadeIn-top">
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" title=""><i class="fa fa-eye"></i></button>
                </div>
              </a>
            </div>

            <div class="thumb-content" style="margin-bottom:10px;">
              <h4>
								<a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($featuredProduct['name'])));?>">
									<?php echo $featuredProduct['name']; ?>
								</a>
							</h4>
              <?php if ($featuredProduct['discount_price']) { ?>
                <p class="item-price"><strike>₦<?php echo $featuredProduct['price'] ?></strike> <span class="price">₦<?php echo $featuredProduct['discount_price'] ?></span></p>
              <?php } else { ?>
                <p class="item-price"><span class="price">₦<?php echo $featuredProduct['price'] ?></span></p>
              <?php } ?>
              <?php $this->load->view('layouts/product/product_rating', $featuredProduct); ?>
                        <?php $this->load->view('layouts/product/addToCartIcon', $featuredProduct); ?>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<!-- /.FEATURED PRODUCTS MOBILE CONTENT -->

<div id="content-mobile" style="margin-top:10px;">
  <a href="<?php echo base_url();?>index.php/Categories">
    <img src="<?php echo base_url();?>resources/images/a1.jpg" alt="..." style="width:100%;">
  </a>
</div>








<!-- FEATURED TOP COLLECTIONS MOBILE CONTENT -->
<div class="container-fluid mt-10 bg-white" id="content-mobile" style="margin-top:10px;">
  <div class="row">
    <div class="col">
      <span id="header-style" style="font-size:18px;">Top Collections</span>
      <ul id="flexiselDemo111" style="background:white;">

       

				<?php foreach($products as $product) { ?>
					
					<?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); ?>
          <li>
            <a href="<?php echo base_url('index.php/product/'.str_replace([' '], ['-'], strtolower($product['name'])));?>">
              <img
                class=""
                style="height: 200px"
                src="<?php echo base_url('public/images/products/'.$product['code'].'/01.jpg');?>" alt="First slide">
            </a>

            <div class="thumb-content">
              <h4 class="black"><?php echo $product['name'] ?></h4>
              <p class="item-price black"><span class="price">₦ <?php echo ($variants) ? $variants[0]->price : $product['price'] ?></span></p>

            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>






















<div id="content-mobile" style="margin-top:10px;">
  <a href="<?php echo base_url();?>index.php/Categories">
    <img src="<?php echo base_url();?>resources/images/a3.jpg" alt="..." style="width:100%;">
  </a>
</div>




<?php $pos = 1; $parentCategories = $this->CategoryModel->getParentCategories(); ?>

<?php foreach ($parentCategories as $key  => $parentCategory) { ?>
  <div class="card" id="content-mobile" style="margin-top:10px;">
    <div class="card-header text-center bg-primary text-white" style="font-size:18px;">
    <?php echo $parentCategory->name; ?>
    </div>
    <div class="card-body">
      <ul id="flexiselDemo133" style="background:white;">
        <?php $parentSubCategories = $this->CategoryModel->getSubCategories($parentCategory->id); ?>
        <?php foreach ($parentSubCategories as $key => $parentSubCategory) { ?>
          <li>
            <a  href="<?php echo site_url('/product/category/'.str_replace([' '], ['-'], strtolower($parentSubCategory['name'])))?>">
              <img src="<?php echo site_url('/public/images/system/categories/'.str_replace([' '], ['-'], strtolower($parentSubCategory['name'].'.jpg'))); ?>"  height="150px"/>
            </a>
          </li>
        <?php } ?>

      </ul>
    </div>
  </div>

  


<?php $ads = $this->AdsBannersModel->getAdsBannersBy(['position' => $pos]); ?>
  <?php if ($ads)  { ?>

    <div class="container-fluid"  style="margin-top:5px;" id="content-desktop">
      <div class="row">
        <?php foreach ($ads as $key => $ad) { ?>
          <div id="content-mobile" style="margin-top:10px;">
            <a  href="<?php echo $ad['link'];?>">
              <img src="<?php echo $ad['image_path'];?>" alt="..." style="width:100%;">
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
<?php $pos++; } ?>





<div class="container-fluid mt-10 bg-white" id="content-mobile" style="margin-top:10px; margin-bottom:10px;">
  <div class="row">
    <div class="col">
      <span id="header-style" style="font-size:18px;">Popular Brands</span>
      <ul id="flexiselDemo155" style="background:white;">
        <?php $brands = $this->BrandsModel->getBrands(); ?>
        <?php foreach ($brands as $Key => $brand) { ?>
          <li><img src="<?php echo $brand['image_path']; ?>" /></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
	
	<!--======================================================================= -->
	<!-- Content MOBILE ENDS HERE -->
	<!-- ====================================================================== -->







<script src="<?php echo site_url('public/js/add_to_cart.js') ?>"></script>
