<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $page_title ?></title>

<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap.min.css"/>
<link href="<?php echo base_url();?>resources/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>resources/css/style1.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>resources/css/blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>resources/css2/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/vendor/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/vendor/slick/slick-theme.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo site_url('public/fonts/awesome/css/all.css')?>" rel="stylesheet">
<link href="<?php echo base_url();?>resources/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />


<script src="<?php echo base_url();?>resources/js/jquery.min.js"></script>
<script src="<?php echo site_url('public/vendor/notify/notify.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url();?>resources/css/jquery.countdown.css" /> <!-- countdown -->
<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" > -->


<!-- web fonts -->
<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
    rel="stylesheet">
<!-- //web fonts -->
<style>

body{
	overflow-x:hidden;
}


.content {
position: relative;
width: 90%;
max-width: 400px;
margin: auto;
overflow: hidden;
}

.content .content-overlay {
/* background: rgba(0,0,0,0.7); */
position: absolute;
height: 99%;
width: 100%;
left: 0;
top: 0;
bottom: 0;
right: 0;
opacity: 0;
-webkit-transition: all 0.4s ease-in-out 0s;
-moz-transition: all 0.4s ease-in-out 0s;
transition: all 0.4s ease-in-out 0s;
}

.content:hover .content-overlay{
opacity: 1;
}

.content-image{
width: 100%;
}

.content-details {
position: absolute;
text-align: center;
padding-left: 1em;
padding-right: 1em;
width: 100%;
top: 50%;
left: 50%;
opacity: 0;
-webkit-transform: translate(-50%, -50%);
-moz-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
-webkit-transition: all 0.3s ease-in-out 0s;
-moz-transition: all 0.3s ease-in-out 0s;
transition: all 0.3s ease-in-out 0s;
}

.content:hover .content-details{
top: 50%;
left: 50%;
opacity: 1;
}

/* Read more Read less Content*/
.hide {
  display: none;
}
/* Read more Read less Content*/

/* .content-details h3{
color: #fff;
font-weight: 500;
letter-spacing: 0.15em;
margin-bottom: 0.5em;
text-transform: uppercase;
}

.content-details p{
color: #fff;
font-size: 0.8em;
} */

/* .fadeIn-bottom{
top: 80%;
} */

.fadeIn-top{
top: 20%;
}

#timer li {
  display:inline;
}

.tcheck li{
  display:inline-block;
  padding:5px;
}


@media screen and (min-width:768px){
  #content-mobile{
    display:none;
  }
}


@media screen and (max-width:425px){
  #content-desktop{
    display:none;
  }
  #header-style-mobile{
    font-size:16px;
  }


}
</style>
</head>
<body>

  <!-- <nav class="navbar navbar-dark justify-content-between sticky-top" style="background:#004186;">
      <div class="col-lg-2">
        <a class="navbar-brand">
          <img src="<?php //echo base_url();?>resources/images/logo.png" alt=" " class="img-fluid">
        </a>
      </div>

        <div class="input-group col-lg-5">
			<input value="<?php //echo (isset($key)) ? $key : ''; ?>" type="text" class="form-control input-sm" placeholder="search products, brands and categories">
			<div class="input-group-append">
				<button class="btn btn-secondary btn-sm" id="search_btn">
					<i class="fa fa-search"></i>
				</button>
			</div>
		</div>

      <div class="col-lg-3">
		<?php //if ($this->session->userdata('user')) { ?>
			<?php //if ($this->session->userdata('user')->loggedinas == 'seller') { ?>
				<a class="btn btn-primary btn-sm" href="<?php //echo site_url('seller/home'); ?>">Dashboard</a>
			<?php //} ?>

			<?php //if ($this->session->userdata('user')->loggedinas == 'buyer') { ?>
				<a class="btn btn-sm btn-primary" href="<?php //echo site_url('buyer/home'); ?>">My Account</a>
			<?php //} ?>
			<a class="btn-sm btn-danger" href="<?php //echo site_url('account/logout'); ?>">logout</a>
		<?php //} else { ?>

			<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
				<span class="text-light mr-2">Login as </span>
				<div class="btn-group btn-group-sm mr-2" role="group" aria-label="First group">
					<a type="button" class="btn btn-secondary" href="<?php //echo site_url('buyer/login'); ?>">Buyer</a>
				</div>
				<span class="text-primary">OR</span>
				<div class="ml-2 btn-group btn-group-sm mr-2" role="group" aria-label="Second group">
					<a type="button" class="btn btn-secondary" href="<?php //echo site_url('seller/login'); ?>">Seller</a>
				</div>
			</div>
		<?php //} ?>
        <a class="navbar-brand" href="<?php //echo site_url('buyer/index'); ?>">
          Carts (<?php //echo$this->cart->total_items(); ?>) (N <?php //echo $this->cart->format_number($this->cart->total()); ?>)
        </a>
      </div>
  </nav> -->











  <nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark bg-white sticky-top">
        <a class="navbar-brand flex-grow-1" href="<?php echo base_url();?>">
          <!-- <img src="<?php //echo base_url();?>resources/images/logo.png" alt=" " class="img-fluid"> -->
          <img src="<?php echo base_url();?>resources/images/Cmacbeth4.png" alt=" " class="img-fluid">
        </a>
        <div class="flex-grow-1 d-flex">
            <div class="form-inline flex-nowrap bg-white mx-0 mx-lg-auto rounded p-1" method="GET">
				<input 
					value="<?php echo (isset($key)) ? $key : ''; ?>" 
					class="form-control mr-sm-2" type="search" 
					name="q" id="q" 
					placeholder="search products, brands and categories" aria-label="Search">
                <button class="btn btn-warning" type="submit" id="search_btn">Search</button>
            </div>
        </div>



        <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse bg-white" id="navbarNavAltMarkup">
          <ul class="navbar-nav ml-auto">
			<?php if ($this->session->userdata('user')) { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarNavAltMarkup" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<b style="color:black;"> <i class="fas fa-user"></i> My Account</b> </a>
					<div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarNavAltMarkup">
						<a class="dropdown-item" href="<?php echo site_url('buyer/profile/view_profile') ?>"><i class="fas fa-user"></i> Profile </a>
						<a class="dropdown-item" href="<?php echo site_url('buyer/cart/my_cart') ?>"><i class="fas fa-shopping-cart"></i> My Cart </a>
						<a class="dropdown-item" href="<?php echo site_url('buyer/profile/edit_profile') ?>"><i class="fas fa-cog"></i> Settings </a>
					</div>
				</li>
			<?php } else { ?>
				<!-- <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarNavAltMarkup" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<b style="color:black;"> <i class="fas fa-user"></i> Login</b> </a>
					<div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarNavAltMarkup">

						<button type="button" name="button" class="btn btn-block btn-warning text-center">LOGIN</button>
						<hr>
						<a class="dropdown-item" href="#"><b class="text-warning">CREATE AN ACCOUNT</b></a>
						<hr>
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Merchant </a>
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Register </a>
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Sign in </a>
					</div>
				</li> -->
        <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarNavAltMarkup" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<b style="color:black;"> <i class="fas fa-user"></i> Login</b> </a>
					<div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarNavAltMarkup">

						<button type="button" name="button" class="btn btn-block btn-warning text-center">LOGIN</button>
						<hr>
						<a class="dropdown-item" href="#"><b class="text-warning">CREATE AN ACCOUNT</b></a>
            <a class="dropdown-item"><i class="fas fa-user"></i> &nbsp Customer </a>
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Register </a>
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Sign in </a>
						<hr>
						<a class="dropdown-item"><i class="fas fa-user"></i> &nbsp Merchant </a>
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Register </a>
            <!-- Sign in for customers shud link to why sell on cmacbeth page-->
						<a class="dropdown-item" href="#"><i class="fas fa-user"></i> &nbsp Sign in </a>
					</div>
				</li>
			<?php } ?>
            <li class="nav-item">
              	<a class="nav-link" href="#" data-toggle="modal" data-target="#modal-default">
                <b style="color:black;">
                <i class="fas fa-shopping-cart"></i> Cart  (<?php echo count($this->cart->contents()); ?>)</b></a>
            </li>

          </ul>
        </div>


    </nav>





  <nav class="navbar navbar-expand-sm" style="background:#104E8B;">
    <div class="container">

		<ul class="navbar-nav ml-auto text-center mr-xl-5">
			<?php $header_menu = $this->db->order_by('position', 'ASC')->where(['parent_id' => 0])->get('header_menu')->result(); ?>
			<?php foreach ($header_menu as $key => $headerMenu) { ?>
				<li class="nav-item <?php echo ($headerMenu->has_sub_menu == 1) ? 'dropdown' : ''; ?> mr-lg-2 mb-lg-0 mb-2">
					<a
						class="nav-link <?php echo ($headerMenu->has_sub_menu == 1) ? 'dropdown-toggle' : ''; ?>"
						href="<?php echo ($headerMenu->has_sub_menu == 1) ? '#' : $headerMenu->url; ?>">
						<b><?php echo $headerMenu->name; ?></b>
					</a>
					<?php if ($headerMenu->has_sub_menu == 1 && $headerMenu->multipanel == 1) { ?>
						<div class="dropdown-menu">
							<div class="agile_inner_drop_nav_info p-4">
								<h5 class="mb-3"><?php echo $headerMenu->name; ?></h5>
								<?php $headerSubMenu = $this->db->get_where('header_menu', ['parent_id' => $headerMenu->id])->result(); ?>
								<div class="row">
									<?php if ($headerSubMenu) { ?>
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">
												<?php foreach ($headerSubMenu as $key => $subMenu) { ?>
													<li>
														<a href="<?php echo $subMenu->url; ?>"><?php echo $subMenu->name; ?></a>
													</li>
												<?php } ?>
											</ul>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if ($headerMenu->has_sub_menu == 1 && $headerMenu->multipanel == 0) { ?>
						<?php $headerSubMenu = $this->db->get_where('header_menu', ['parent_id' => $headerMenu->id])->result(); ?>
						<div class="dropdown-menu">
							<?php foreach ($headerSubMenu as $key => $subMenu) { ?>
								<a class="dropdown-item" href="<?php echo $subMenu->url; ?>"><?php echo $subMenu->name; ?></a>
							<?php } ?>
							<!-- <a class="dropdown-item" href="product.html">Product 1</a> -->
						</div>
					<?php } ?>
				</li>
			<?php } ?>
		</ul>
    </div>

</nav>
