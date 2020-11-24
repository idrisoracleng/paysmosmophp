<style>
    @media (max-width:499px) {
        .ht {
            height: 230px;
        }
    }
</style>
<?php $headerBanners = $this->db->get('banners')->result_array(); ?>
<div class="card h col-lg-10 col-xs-12 col-sm-10" style="border: none; background: none; padding-right: 0px;">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($headerBanners as $key => $headerBanner) { ?>
                <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0) ? 'active' : ''; ?>"></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($headerBanners as $key => $headerBanner) { ?>
                <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
                    <a href="<?php echo site_url($headerBanner['link']); ?>">
                        <img src="<?php echo $headerBanner['image_path']; ?>" class="h d-block w-100" alt="<?php echo $headerBanner['name']; ?>">
                    </a>
                </div>
            <?php } ?>
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