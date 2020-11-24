

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/product/all') ?>">Settings Menu</a>
      </li>
      <li class="breadcrumb-item active">Edit Menu</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        <?php echo $men->name ?></div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-4 offset-4">
                <form class="form" action="<?php echo site_url('/admin/settings/header_menu/update') ?>" method="POST" msg="Updating Activity Log">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Menu Display Name" value="<?php echo $men->name ?>"/>
                        <input type="hidden" name="id" value="<?php echo $men->id ?>"/>
                    </div>

                    <div class="form-group">
                        <input type="number" max="225" min="0" name="position" class="form-control" placeholder="Input Menu Position" value="<?php echo $men->position ?>"/>
                    </div>

                    <div class="form-group">
                        <select name="parent_id" class="form-control">
                            <option selected disabled>No Parent</option>
                            <?php $headerMenu = $this->db->order_by('position', 'ASC')->get_where('header_menu', ['parent_id' => 0])->result(); ?>
                            <?php foreach($headerMenu as $menu){ ?>
                                <option <?php echo ($menu->id == $men->parent_id) ? 'selected' : '' ?> value="<?php echo $menu->id ?>"><?php echo $menu->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="url" class="form-control" id="url">
                            <option selected disabled>Select Where To Link To</option>
                            <option value="other">Custom Url</option>
                            <?php $categories = $this->db->get('category')->result(); ?>
                            <?php $pages = $this->db->get('pages')->result(); ?>
                            <optgroup label="Categories">
                                <?php foreach($categories as $category){ ?>
                                    <?php $url = site_url('/product/category/'.str_replace([' '], ['-'], strtolower($category->name))); ?>
                                    <option 
                                      <?php echo ($men->url == $url) ? 'selected' : ''; ?>
                                      value="<?php echo $url;?>"><?php echo $category->name?></option>
                                <?php } ?>
                            </optgroup>

                            <optgroup label="Pages">
                                <?php foreach($pages as $page){ ?>
                                  <?php $url = $page->url.strtolower(str_replace([' '], ['-'], $page->name)); ?>
                                    <option 
                                      <?php echo ($men->url == $url) ? 'selected' : ''; ?>
                                      value="<?php echo $url; ?>"><?php echo $page->name." Page"; ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                        <input type="text" name="url" id="custom_url" disabled placeholder="Input Custom Url" class="form-control"/>
                    </div>

                    <div class="form-group">
                      <label>Multiple Panel?</label>
                      <input type="radio" name="multipanel" value="1" <?php echo ($men->multipanel == 1) ? 'checked' : ''; ?>/> Yes
                      <input type="radio" name="multipanel" value="0" <?php echo ($men->multipanel == 0) ? 'checked' : ''; ?>/> No
                    </div>

                    <div class="form-group">
                      <label>Has Sub Menu?</label>
                      <input type="radio" name="has_sub_menu" value="1" <?php echo ($men->multipanel == 1) ? 'checked' : ''; ?>/> Yes
                      <input type="radio" name="has_sub_menu" value="0" <?php echo ($men->multipanel == 0) ? 'checked' : ''; ?>/> No
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Update Header Menu"/>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
<script>
  $(document).ready(function () {
    $("#url").change(function() {
      // alert($(this).val());
      let val = $(this).val();
      if (val == 'other') {
        $("#custom_url").attr('disabled', false);
      } else {
        $("#custom_url").attr('disabled', true);
      }
    })
  });
</script>