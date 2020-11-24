<nav id="navbar-example2" class="navbar navbar-light text-white" style="background: #555565;">
  <a class="navbar-brand text-white" href="#"><?php echo $title; ?></a>
  <?php $menus = $this->db->get_where('menus', ['acct_type' => 'buyer'])->result(); ?>
  <ul class="nav nav-pills">
    <?php foreach ($menus as $key => $menu) { ?>
      <?php $submenu_s = $this->db->get_where('submenu', ['menu_id' => $menu->id])->result(); ?>
      <li class="nav-item <?php echo ($submenu_s) ? ' dropdown' : '' ; ?>">
        <a class="nav-link text-white" href="#fat"><?php echo $menu->name; ?></a>
        <?php if ($submenu_s) { ?>
          <div class="dropdown-menu">
          <!-- <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a> -->
            <?php foreach ($submenu_s as $key => $submenu) { ?>
              <a class="dropdown-item" href="<?php echo site_url($submenu->url) ?>"><?php echo $submenu->name; ?></a>
            <?php } ?>
          </div>
        <?php } ?>
      </li>
    <?php } ?>
    <!-- <li class="nav-item">
      <a class="nav-link" href="#mdo"></a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#one">one</a>
        <a class="dropdown-item" href="#two">two</a>
        <div role="separator" class="dropdown-divider"></div>
        <a class="dropdown-item" href="#three">three</a>
      </div>
    </li> -->
  </ul>
</nav>