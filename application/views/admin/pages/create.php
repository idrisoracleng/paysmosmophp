
<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/page/all') ?>">Pages</a>
      </li>
      <li class="breadcrumb-item active">#</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a href="#" class="back-btn fas fa-arrow-left"> back</a>
        <i class="fas fa-product"></i>
        Create Page <a href="<?php echo site_url('admin/page/') ?>" style="float: right" class="btn btn-sm btn-danger"> <span class="fa fa-window-close"></span> Cancel</a> &nbsp;
        
      </div>
      <div class="card-body">
          <form class="form row" action="<?php echo site_url('admin/page/store'); ?>" method="POST" msg="Creating New Page">
            <div class="form-group col-md-3">
                <label>Page Name</label>
                <input name="name" class="form-control" type="text" placeholder="Input Page Name" />
            </div>
            <div class="col-md-9"></div>
            <div class="form-group col-md-12">
                <label>Page Content</label>
                <textarea name="content" placeholder="Page Content Here" class="form-control" rows="10" id="editor"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Page</button>
            </div>
          </form>
      </div>
    </div>

  </div>

  <script>
        $(document).ready(function() {
            // alert("hello");
            // $("#editor").keyup(function () {
            //     // let content = $(this).val();
            //     var desc = CKEDITOR.instances.DSC.getData();
            //     alert(desc);

            //     // $("#content_preview").html(content);
            // });
        });
  </script>
