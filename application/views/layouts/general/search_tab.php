<form class="navbar-search" method="get" action="<?php echo site_url('product/search'); ?>" msg="Searching..." autocomplete='off'>
    <label class="sr-only screen-reader-text" for="search">Search for:</label>
    <div class="input-group">
        <input type="text" id="q" class="form-control search-field product-search-field" dir="ltr" value="" name="" placeholder="Search for products" />
        <!-- .input-group-addon -->
        <div class="input-group-btn input-group-append">
            <!-- <input type="hidden" value="<?php //echo (isset($key)) ? $key : ''; ?>" name="key" id="q"/> -->
            <button type="submit" class="btn btn-primary" id="search_btn">
                <i class="fa fa-search"></i>
                <span class="search-btn">Search</span>
            </button>
        </div>
        <!-- .input-group-btn -->
    </div>
    <!-- .input-group -->
</form>
<!-- <div class="col-md-12">
    kskjjsj
</div> -->
