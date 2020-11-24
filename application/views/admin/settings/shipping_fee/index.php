

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/shipping_location') ?>">Shipping Locations</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			Set Shipping Fee For Each Location According To Weight
		</div>
		<div class="card-body">
            <div id="msg" class="">

            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>
                            Small Full Price
                        </th>
                        <th>
                            Medium Full Price
                        </th>
                        <th>
                            Large Full Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipping_fees as $key => $shipping_fee) { ?>
                        <?php $locationData = $this->db->get_where('shipping_location', ['loc_id' => $shipping_fee->loc_id])->row(); ?>
                        <tr>
                            <td>
                                <?php echo $this->db->get_where('states', ['id' => $locationData->state_id])->row()->name.' ' ?>
                                <?php echo $locationData->name; //$this->db->get_where('locals', ['local_id' => $locationData->local_id])->row()->local_name.' ' ?>
                            </td>
                            <td>
                                <input type="number" value="<?php echo $shipping_fee->small_price; ?>" name="small_price" class="form-control vars" placeholder="Small Size Shipping Fee" url="<?php echo site_url('admin/settings/shipping_fee/update/small_price/'.$shipping_fee->id) ?>"/>
                            </td>
                            <td>
                                <input type="number" name="medium_price" value="<?php echo $shipping_fee->medium_price; ?>" class="form-control vars" placeholder="Medium Size Shipping Fee" url="<?php echo site_url('admin/settings/shipping_fee/update/medium_price/'.$shipping_fee->id) ?>"/>
                            </td>
                            <td>
                                <input type="number" name="large_price" value="<?php echo $shipping_fee->large_price; ?>" class="form-control vars" placeholder="Large Size Shipping Fee" url="<?php echo site_url('admin/settings/shipping_fee/update/large_price/'.$shipping_fee->id) ?>"/>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>

  <script>
      $(document).ready(function() {
        $('.vars').keyup(function() {
            var url = $(this).attr('url');
            
            var data = {
                val: $(this).val(),
            }
            $('#msg').attr('class', '').addClass('text-center alert alert-info').text('Updating...');
            $.post(url, data, function(data) {
                console.log(data);
                $('#msg').attr('class', '').addClass('text-center alert '+data.class).text(data);
            });
            // alert(url);
        });
      });
  </script>