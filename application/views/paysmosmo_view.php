<div id="wrapper">

	<!-- Sidebar -->
	<?php include APPPATH . '/views/layouts/admin/side_nav.php' ?>

	<div id="content-wrapper">

		<div class="container-fluid">

			<!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="#">Dashboard</a>
				</li>
				<li class="breadcrumb-item active">Overview</li>
			</ol>

			<!-- Icon Cards-->
			<?php include APPPATH . '/views/layouts/admin/dashtabs.php' ?>

			<!-- DataTables Example -->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fab fa-product-hunt"></i>
					Recent Products</div>
				<div class="card-body">
					<form method="post" id="import_csv" enctype="multipart/form-data">

						<div class="form-group">
							<label>Select CSV File</label>
							<input type="file" name="csv_file" id="csv_file" required accept=".csv" />
						</div>

						<br />
						<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import Product</button>
						<?php //echo anchor("exam_staff/get_staff",'View All Staff',['class'=>'btn btn-primary']);
						?>

					</form>
					<br />
				</div>
				<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
			</div>


		</div>
		<!-- /.container-fluid -->

		<!-- Sticky Footer -->
		<footer class="sticky-footer">
			<div class="container my-auto">
				<div class="copyright text-center my-auto">
					<span>Copyright © Your Website 2019</span>
				</div>
			</div>
		</footer>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<script>
	$(document).ready(function() {

		//  load_data();

		//  function load_data()
		//  {
		//   $.ajax({
		//    url:"<?php //echo base_url(); 
					?>exam_staff/load_data",
		//    method:"POST",
		//    success:function(data)
		//    {
		//     $('#importedzz_csv_data').html(data);
		//    }
		//   })
		//  }

		$('#import_csv').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: "<?php echo base_url(); ?>exam_staff/pay_import",
				method: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function() {
					$('#import_csv_btn').html('Importing...');
				},
				success: function(data) {
					$('#import_csv')[0].reset();
					$('#import_csv_btn').attr('disabled', false);
					$('#import_csv_btn').html('Import Done');
					load_data();
				}
			})
		});

	});
</script>