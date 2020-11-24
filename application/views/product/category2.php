       <!-- start :: second column -->
    <div class="col-lg-9">

     
      <div class="bd-example bd-example-tabs">
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home1" role="tab" aria-controls="home" aria-expanded="true"><b style="color:black;"><?php echo str_replace(['-'], [' '], strtoupper($cat)); ?></b></a>
          <?php if($cat != 'all'){ ?>
            <a class="nav-item nav-link" id="nav-subcat-tab" data-toggle="tab" href="#nav-subcat" role="tab" aria-controls="subcat" aria-expanded="true"><b style="color:black;">Sub Categories</b></a>
          <?php } ?>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-home1" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">

                <div class="row">
                <?php if($cat == 'all'){ ?>
                    <?php foreach($cats as $category){ ?>
                    <div class="col-lg-3">
                        <div class="card product-top card-top">
                            <a href="<?php echo base_url('product/category/'.str_replace([' '], ['-'], strtolower($category->name)));?>">
                            <img 
                                class="card-img-top" 
                                src="<?php echo base_url('public/images/system/categories/'.str_replace([' '], ['-'], strtolower($category->name)).'.jpg');?>" alt="Card image"></a>

                            <div class="card-body">
                                <div class="thumb-content">
                                    <hr>
                                        <h4 class="text-center" style="font-variant: small-caps;"><?php echo $category->name ?></h4>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php } ?>


                <?php if($cat != 'all'){ ?>
                    <?php if($cat_products){ ?>
                        <?php foreach($cat_products as $product){ ?>
                            <div class="col-lg-3">
                                <div class="card product-top card-top">
                                <a href="<?php echo base_url('product/'.str_replace([' '], ['-'], strtolower($product->name)));?>">
                                <img 
                                    class="card-img-top" 
                                    src="<?php echo base_url('public/images/products/'.$product->code.'/01.jpg');?>" alt="Card image"></a>
                                    <div class="card-body">
                                        <div class="thumb-content">
                                            <hr>
                                            <h4 class="text-center"><?php echo $product->name ?></h4>
                                            <hr>
                                            <p class="item-price text-center"> <span style="color:blue;"><b>₦<?php echo $product->price ?></b></span></p>
                                            <hr>
                                            <div class="star-rating text-center">
                                                <ul class="list-inline">
                                                <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <!-- end :: first column -->
                </div>
                <!-- end :: first row -->

            </div>

            <div class="tab-pane fade show" id="nav-subcat" role="tabpanel" aria-labelledby="nav-subcat-tab" aria-expanded="true">
                <div class="row">
                    <?php if($subcats){ ?>
                        <?php foreach($subcats as $category){ ?>
                            <div class="col-lg-3">
                                <div class="card product-top card-top">
                                    <a href="<?php echo base_url( "product/category/".str_replace([" "], ["-"], strtolower($category["name"])) );?>">
                                    <img 
                                        class="card-img-top" 
                                        src="<?php echo base_url('public/images/system/categories/'.str_replace([' '], ['-'], strtolower($category['name'])).'.jpg');?>" alt="Card image"></a>
                                    <div class="card-body">
                                        <div class="thumb-content">
                                            <hr>
                                                <h4 class="text-center" style="font-variant: small-caps;"><?php echo $category['name'] ?></h4>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        </div>

      </div>
      <!-- END :: SECOND TAB -->

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <nav aria-label="Page navigation example">
              <ul class="pagination pagination-sm">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link " href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
              </ul>
          </nav>
      </div>











    </div>
    <!-- end :: second column -->



        </div>


       </div>
     </div>
    </div>
  </div>
</div>





