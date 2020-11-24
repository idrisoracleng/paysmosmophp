
<body>




<!-- start :: breadcrumb   -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <!-- <a href="#">Home</a> -->
      <a href="http://www.cmacbeth.com/cm/index.php?route=common/home">
        <i class="fa fa-home"></i>
      </a>
    </li>
    <li class="breadcrumb-item active">
      <!-- Library -->
      <a href="http://www.cmacbeth.com/cm/index.php?route=product/category&amp;path=79">
        <!-- Search result for <?php //echo $key; ?> -->
      </a>
    </li>
  </ol>


<!-- end :: breadcrumb   -->


<!-- START :: FIRST ROW -->

<div class="container-fluid" style="margin-bottom:20px;">
  <div class="row">

    <!-- start :: second column -->
    <div class="col-lg-12">

      <div class="bd-example bd-example-tabs">
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home1" role="tab" aria-controls="home" aria-expanded="true">
            <b style="color:black;">
                <!-- <?php //echo $page_title; ?> -->
				Gift Shop Items: Pay With Your Point
            </b>
        </a>

        </nav>
        <div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade active show" id="nav-home1" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
				<div class="row">
					<?php if ($gift_items) { ?>
						<?php foreach ($gift_items as $key => $product) { ?>
							<?php $whoCanBuy = $this->db->get_where('reward_stages', ['id' => $product['reward_stage']])->row(); ?>
							<div class="col-lg-2">
								<div class="card product-top card-top">
								<a href="<?php echo site_url('gift_shop/item/'.$product['id']);?>">
									<img class="card-img-top" src="<?php echo site_url('public/images/products/'.$product['code'].'/01.jpg') ?>" alt="<?php echo $product['name'] ?>">
								</a>

								<div class="card-body">
									<h4 class="text-center" title="<?php echo$product['name']; ?>">
										<a href="<?php echo site_url('gift_shop/item/'.$product['id']);?>">
										<?php echo substr_replace($product['name'],"......",32); ?>
										</a>
									</h4>
									<p class="item-price text-center"> <span style="color:blue;"><b><?php echo $product['reward_point'] ?> Points</b></span>
									<p class="item-price text-center"> <span style=""><b><?php echo ($whoCanBuy) ? $whoCanBuy->name : ''; ?></b></span>
									</p>
									<div class="star-rating text-center">
									<ul class="list-inline">
										<li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
										<li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
										<li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
										<li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
										<li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
									</ul>
									</div>

								</div>
								</div>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="alert alert-info text-center col-md-12">
							No Product Found on <?php echo 'Gift Shop'; ?>
						</div>
					<?php } ?>
				</div>
			</div>
        </div>

      </div>
      <!-- END :: SECOND TAB -->

      <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <nav aria-label="Page navigation example">
              <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link " href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
              </ul>
          </nav>
      </div> -->











    </div>
    <!-- end :: second column -->



  </div>


</div>






<!-- END :: FIRST ROW -->
