<section class="content-header">
	<h1>Items <small>Edit Items</small></h1>
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
			Edit
		</li>

	</ol>
</section>

<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4>
				Edit Items
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
					<form action="<?= site_url('items/process_edit_pcs'); ?>" method="POST">
						<input type="hidden" name="items_id" value="<?= $items->items_id ?>">
						<label for="">ID Items <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" name="items_key" id="items_key" class="form-control" placeholder="ID Items" value="<?= $items->items_key ?>" readonly required>
						</div>
						<?= form_error('items_key', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="name_items">Nama Items <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
							<input type="text" id="name_items" name="name_items" class="form-control" value="<?= $items->name_items ?>" placeholder="Nama Items" autocomplete="off" required>
						</div>
						<br>
						<div class="form-group">
							<label for="categories_id">Kategori <i class="text-danger">*</i></label>
							<select name="categories_id" id="categories_id" class="form-control select2" style="width: 100%;" required>
								<option value="">-- Pilih --</option>
								<?php $level = $this->input->post('categories_id') ?? $items->categories_id ?>
								<?php foreach ($categories as $key => $data) { ?>
									<option value="<?= $data->categories_id ?>" <?= $data->categories_id == $level ? 'selected' : null ?>><?= $data->name_categories ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="sub_categories_id">Sub Kategori <i class="text-danger">*</i></label>
							<select name="sub_categories_id" id="sub_categories_id" class="form-control select2" style="width: 100%;" required>
								<option value="<?= $items->sub_categories_id ?>"><?= $items->name_sub_categories ?></option>
							</select>
						</div>
						<div>
							<label for="harga_items">Harga <i class="text-danger">*</i></label>
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" id="harga_items" onkeyup="splitInDots(this)" name="harga_items" class="form-control" placeholder="Harga Items" value="<?= indo_qty($items->harga_items) ?>" autocomplete="off" required>
						</div>
						<br>
						<div class="form-group">
							<label for="type_qty">Satuan <i class="text-danger">*</i></label>
							<input type="text" name="type_qty" id="type_qty" class="form-control" value="<?= $items->type_qty ?>" readonly>
						</div>
						<div>
							<label for="qty_items">pcs <i class="text-danger">*</i></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dropbox"></i></span>
								<input type="text" id="qty_items" onkeyup="splitInDots(this)" name="qty_items" class="form-control" placeholder="pcs" value="<?= indo_qty($items->qty_items) ?>" autocomplete="off">
							</div>
						</div>
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

<script type="text/javascript">
	function reverseNumber(input) {
		return [].map.call(input, function(x) {
			return x;
		}).reverse().join('');
	}

	function plainNumber(number) {
		return number.split('.').join('');
	}

	function splitInDots(input) {
		var value = input.value,
			plain = plainNumber(value),
			reversed = reverseNumber(plain),
			reversedWithDots = reversed.match(/.{1,3}/g).join('.'),
			normal = reverseNumber(reversedWithDots);
		input.value = normal;
	}
</script>