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
			<?php //include APPPATH . '/views/layouts/admin/dashtabs.php' ?>

			<!-- DataTables Example -->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fab fa-product-hunt"></i>
					Upload Products</div>
				<div class="card-body">
					<form method="post" id="import_image" enctype="multipart/form-data" >
						<div class="form-group">
							<label><b>Upload Images</b></label>
							<input type="file" name="product_image" id="product_image" required accept=".zip" />
							Only zip file allowed
						</div>
						<br />
						<button type="submit" class="btn btn-info" id="import_image_btn">Upload Image</button>
					</form>

					<form method="post" id="import_csv" enctype="multipart/form-data" >
					<!--action="<?php //echo base_url(); ?>Admin/pay_import" -->
						<div class="form-group">
							<label><b>Select Excel File &nbsp&nbsp</b></label>
							<input type="file" name="csv_file" id="csv_file" required accept=".xls"/> 97/2003 Excel File allowed
						</div>
						<br />
						<button type="submit" class="btn btn-info" id="import_csv_btn">Import Product</button>
					</form>
					<br />
				</div>
				<div class="card-footer small text-muted"></div>
			</div>


		</div>
		<!-- /.container-fluid -->

		<!-- Sticky Footer -->
		<footer class="sticky-footer">
			<div class="container my-auto">
				<div class="copyright text-center my-auto">
					<span>Copyright © Paysmosmo <?php echo date("Y"); ?></span>
				</div>
			</div>
		</footer>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<script>
	$(document).ready(function() {
	
		$('#import_csv').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: "<?php echo base_url(); ?>Admin/pay_import",
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
					
				}
			})
		});
		
		$('#import_image').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: "<?php echo base_url(); ?>Admin/upload_image",
				method: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function() {
					$('#import_image_btn').html('Uploading...');
				},
				success: function(data) {
					$('#import_image')[0].reset();
					$('#import_image_btn').attr('disabled', false);
					$('#import_image_btn').html('Image Upload Done');
					
				}
			})
		});
	});
</script>