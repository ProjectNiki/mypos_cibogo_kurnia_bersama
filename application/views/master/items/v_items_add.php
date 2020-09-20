<section class="content-header">
	<h1>Items <small>Add Items</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Master
		</li>
		<li>
			<a href="<?= site_url('items') ?>">
				Items
			</a>
		</li>
		<li class="active">
			Add
		</li>

	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>
				Add Items
				<div class="pull-right">
					<a href="<?= site_url('items') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="" method="POST">
						<label for="">ID Items <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" name="items_key" id="items_key" class="form-control" placeholder="ID Items" value="P_<?= sprintf("%04s", $row) ?>" readonly>
						</div>
						<?= form_error('items_key', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="name_items">Nama Items <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_items') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
							<input type="text" id="name_items" name="name_items" class="form-control" value="<?= set_value('name_items') ?>" placeholder="Nama Items" autofocus autocomplete="off">
						</div>
						<?= form_error('name_items', '<div class="text-danger">', '</div>'); ?>
						<br>
						<div class="form-group">
							<label for="categories_id">Nama Categories <i class="text-danger">*</i></label>
							<select name="categories_id" id="categories_id" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<?php foreach ($categories as $key => $data) { ?>
									<option value="<?= $data->categories_id ?>" <?= set_value('categories_id') == $data->categories_id ? "selected" : null ?>><?= $data->name_categories ?></option>
								<?php } ?>
							</select>
							<?= form_error('categories_id', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
						<div class="form-group">
							<label for="sub_categories_id">Nama Sub Categories <i class="text-danger">*</i></label>
							<select name="sub_categories_id" id="sub_categories_id" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
							</select>
							<?= form_error('sub_categories_id', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div>
							<label for="harga_items">Harga <i class="text-danger">*</i></label>
						</div>
						<div class="input-group  <?= form_error('harga_items') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
							<input type="text" id="harga_items" name="harga_items" class="form-control" placeholder="Harga Items" value="<?= set_value('harga_items') ?>" autocomplete="off">
						</div>
						<?= form_error('harga_items', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="qty_items">Qty <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('qty_items') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-dropbox"></i></span>
							<input type="text" id="qty_items" name="qty_items" class="form-control" placeholder="Qty" value="<?= set_value('qty_items') ?>" autocomplete="off">
						</div>
						<?= form_error('qty_items', '<div class="text-danger">', '</div>'); ?>

						<br>
						<div class="form-group">
							<button type="reset" class="btn btn-danger"><i class="fa fa-rotate-left"></i></button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		$('#categories_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?= base_url('items/get_subkategori') ?>",
				method: "POST",
				data: {
					id: id
				},
				async: false,
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].sub_categories_id + '">' + data[i].name_sub_categories + '</option>';
					}
					$('#sub_categories_id').html(html);

				}
			});
		});
	});
</script>
