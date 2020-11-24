<!-- Logout Modal-->
<?php $menues = $this->db->get('menus')->result(); ?>

<?php if($this->session->userdata('user')){ ?>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Do you want to logout</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo site_url('/account/logout') ?>">Logout</a>
        </div>
        </div>
    </div>
</div>



<?php if($this->session->userdata('user')->loggedinas == 'admin'){ ?>
<!-- New Menu Modal-->
<div class="modal fade" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="<?php echo site_url('/admin/settings/menus/store') ?>" method="POST" msg="Creating new menu...">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Menu Display Name"/>
                    </div>

                    <div class="form-group">
                        <input type="text" name="url" class="form-control" placeholder="Menu url"/>
                    </div>

                    <div class="form-group">
                        <input type="text" name="fafa" class="form-control" placeholder="Icon: font awesome icon: fa-exit"/>
                    </div>

                    <div class="form-group">
                        <input type="text" name="acct_type" class="form-control" placeholder="admin,seller,buyer"/>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Create Menu"/>
                    </div>
                </form>
            </div>
       
        </div>
    </div>
</div>

<div class="modal fade" id="newHeaderMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Header Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="<?php echo site_url('/admin/settings/header_menu/store') ?>" method="POST" msg="Creating new menu...">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Header Menu Display Name"/>
                    </div>

                    <!-- <div class="form-group">
                        <input type="text" name="url" class="form-control" placeholder="Header Menu url"/>
                    </div> -->

                    <div class="form-group">
                        <input type="number" name="position" class="form-control" placeholder="Header Menu Position" max="225" min="1"/>
                    </div>

                    <div class="form-group">
                        <select name="url" class="form-control url">
                            <option selected disabled>Select Where To Link To</option>
                            <option value="other">Custom Url</option>
                            <?php $categories = $this->db->get('category')->result(); ?>
                            <?php $pages = $this->db->get('pages')->result(); ?>
                            <optgroup label="Categories">
                                <?php foreach($categories as $category){ ?>
                                    <option value="<?php echo site_url('/product/category/'.str_replace([' '], ['-'], strtolower($category->name)))?>"><?php echo $category->name?></option>
                                <?php } ?>
                            </optgroup>

                            <optgroup label="Pages">
                                <?php foreach($pages as $page){ ?>
                                    <option value="<?php echo $page->url.strtolower(str_replace([' '], ['-'], $page->name)); ?>"><?php echo $page->name." Page"; ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                        <input type="text" name="url" id="custom_url" disabled placeholder="Input Custom Url" class="form-control custom_url"/>
                    </div>

                    <div class="form-group">
                        <label>Multiple Panel?</label>
                        <input type="radio" name="multipanel" value="1"/> Yes
                        <input type="radio" name="multipanel" value="0"/> No
                    </div>

                    <div class="form-group">
                      <label>Has Sub Menu?</label>
                      <input type="radio" name="has_sub_menu" value="1"/> Yes
                      <input type="radio" name="has_sub_menu" value="0"/> No
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Create Menu"/>
                    </div>
                </form>
            </div>
       
        </div>
    </div>
</div>

<!-- Sub me Menu Modal-->
<div class="modal fade" id="newSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Sub Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="<?php echo site_url('/admin/settings/submenu/store') ?>" method="POST" msg="Creating new menu...">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Menu Display Name"/>
                    </div>

                    <div class="form-group">
                        <input type="text" name="url" class="form-control" placeholder="Menu url"/>
                    </div>
                    
                    <div class="form-group">
                        <select name="menu_id" class="form-control">
                            <option seleted disables>Select menu</option>
                            <?php foreach($menues as $menu){ ?>
                                <option value="<?php echo $menu->id ?>"><?php echo $menu->name?> &gt; <?php echo $menu->acct_type?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Create Menu"/>
                    </div>
                </form>
            </div>
       
        </div>
    </div>
</div>


<div class="modal fade" id="newHeaderSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Header Sub Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="<?php echo site_url('/admin/settings/header_menu/store') ?>" method="POST" msg="Creating new menu...">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Sub Header Menu Display Name"/>
                    </div>

                    <!-- <div class="form-group">
                        <input type="text" name="url" class="form-control" placeholder="Sub Header Menu url"/>
                    </div> -->

                    <div class="form-group">
                        <select name="parent_id" class="form-control">
                            <option selected disabled>Select Parent Menu</option>
                            <option value="other">Custom Url</option>
                            <?php $headerMenu = $this->db->order_by('position', 'ASC')->get_where('header_menu', ['parent_id' => 0])->result(); ?>
                            <?php foreach($headerMenu as $menu){ ?>
                                <option value="<?php echo $menu->id ?>"><?php echo $menu->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="url" class="form-control url">
                            <option selected disabled><option selected disables>Select Where To Link To</option></option>
                            <?php $categories = $this->db->get('category')->result(); ?>
                            <?php $pages = $this->db->get('pages')->result(); ?>
                            <optgroup label="Categories">
                                <?php foreach($categories as $category){ ?>
                                    <option value="<?php echo site_url('/product/category/'.str_replace([' '], ['-'], strtolower($category->name)))?>"><?php echo $category->name?></option>
                                <?php } ?>
                            </optgroup>

                            <optgroup label="Pages">
                                <?php foreach($pages as $page){ ?>
                                    <option value="<?php echo $page->url.strtolower(str_replace([' '], ['-'], $page->name)); ?>"><?php echo $page->name." Page"; ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                        <input type="text" name="url" id="custom_url" disabled placeholder="Input Custom Url" class="form-control custom_url"/>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Create Menu"/>
                    </div>
                </form>
            </div>
       
        </div>
    </div>
</div>

<script>
  $(document).ready(function () {
    $(".url").change(function() {
      // alert($(this).val());
      let val = $(this).val();
      if (val == 'other') {
        $(".custom_url").attr('disabled', false);
      } else {
        $(".custom_url").attr('disabled', true);
      }
    })
  });
</script>
<?php } ?>
<?php } ?>