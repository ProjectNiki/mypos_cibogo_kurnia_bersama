<section class="content-header">
	<h1>Data Stock Out <small>Stock Out</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li>
			<a href="<?= site_url('stock_out') ?>">
				Stock Out
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
			<h4>Add Stock Out
				<div class="pull-right">
					<a href="<?= site_url('stock_out') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="<?= site_url('stock_out/stock_out_add_kg')?>" method="POST">
						<div class="form-group">
							<label for="">Tanggal <i class="text-danger">*</i></label>
							<input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
							<?= form_error('date', '<div class="text-danger">', '</div>'); ?>
						</div>
						<label for="">Key Items <i class="text-danger">*</i></label>
						<div class="input-group">
							<input type="text" id="items_key" name="items_key" value="<?= set_value('items_key') ?>" class="form-control" readonly>
							<input type="hidden" id="items_id" name="items_id" class="form-control" readonly>
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
						<?= form_error('barcode', '<div class="text-danger">', '</div>'); ?>
						<br>
						<label for="name_items">Nama Items <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_items') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
							<input type="text" id="name_items" name="name_items" class="form-control" value="<?= set_value('name_items') ?>" placeholder="Nama Items" readonly>
						</div>
						<?= form_error('name_items', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<label for="qty_items_kg">Initial Stock <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('qty_items_kg') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-dropbox"></i></span>
							<input type="text" id="qty_items_kg" name="qty_items_kg" class="form-control" placeholder="Qty Saat Ini" value="<?= set_value('qty_items_kg') ?>" readonly>
						</div>
						<?= form_error('qty_items_kg', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<label for="qty_stock_out">Kg <i class="text-danger">* Perhatikan ( . ) padaa saat input Kg</i></label>
						<div class="input-group <?= form_error('qty_stock_out') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-dropbox"></i></span>
							<input type="text" id="qty_stock_out" name="qty_stock_out" class="form-control" placeholder="Kg Keluar/Rusak/Hilang" value="<?= set_value('qty_stock_out') ?>" autocomplete="off">
						</div>
						<?= form_error('qty_stock_out', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<div class="form-group <?= form_error('detail') == TRUE ? 'has-error' : null ?>">
							<label for="">Detail <i class="text-danger">*</i></label>
							<textarea name="detail" id="detail" cols="30" rows="4" class="form-control" placeholder="Detail Product Name" autocomplete="off"></textarea>
							<?= form_error('detail', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Items</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="datatable">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Nama Items</th>
							<th class="text-center">Harga (Rp)</th>
							<th class="text-center">Stock</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($row as $key => $data) { ?>
							<?php if($data->type_qty == 'Kg'){ ?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $data->name_items ?></td>
								<td><?= indo_currency($data->harga_items) ?></td>
								<td class="text-center">
									<?= $data->type_qty == 'Kg' ? indo_kg($data->qty_items_kg) . '/' . $data->type_qty : indo_qty($data->qty_items) . '/' . $data->type_qty ?>
								</td>
								<td class="text-center">
									<button class="btn btn-success btn-sm" id="select" data-items_key="<?= $data->items_key ?>" data-items_id="<?= $data->items_id ?>" data-name_items="<?= $data->name_items ?>" data-qty_items_kg="<?= $data->qty_items_kg ?>">
										<i class="fa fa-check"></i>
									</button>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click', '#select', function() {

			$('#items_key').val($(this).data('items_key'));
			$('#items_id').val($(this).data('items_id'));
			$('#name_items').val($(this).data('name_items'));
			$('#qty_items_kg').val($(this).data('qty_items_kg'));

			$('#exampleModal').modal('hide');
		});
	});
</script>

<script>
	$(document).on('keyup mouseup', '#qty_stock_out', function() {

		var qty_show = $('#qty_items_kg').val();
		var qty_input = $('#qty_stock_out').val();

		count = qty_show - qty_input;

		console.log(count)

		if (count < 0) {
			alert('Qty Stock Out tidak boleh melebihi Initial Stock');
			$(':input[type="submit"]').prop('disabled', true);
		} else {
			$(':input[type="submit"]').prop('disabled', false);
		}
	})
</script>
