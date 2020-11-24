
<body>

<!-- START :: FIRST ROW -->

<div class="container-fluid" style="margin-bottom:20px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo site_url(); ?>">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                Search result for <?php echo $key; ?>
            </a>
        </li>
    </ol>
  <div class="row">

    <div class="col-lg-10 offset-1 shadow-lg rounded-lg">

      <div class="bd-example bd-example-tabs">
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home1" role="tab" aria-controls="home" aria-expanded="true">
            <b style="color:black;">
                <?php echo $key; ?>
            </b>
        </a>

        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade active show" id="nav-home1" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
            <div class="row">
                <?php if ($result_products) { ?>
                    <?php foreach ($result_products as $key => $product) { ?>
                        <?php $prod = (array) $product; $this->load->view('layouts/product/one_product', $prod); ?>
                    <?php } ?>
                <?php } else { ?>
                    <div class="alert alert-info text-center col-md-12">
                        No Search Result For <?php echo $key; ?>
                    </div>
                <?php } ?>
            </div>
            <nav class="woocommerce-pagination">
                <?php echo $this->pagination->create_links(); ?>
            </nav>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>