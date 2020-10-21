<section class="content-header">
	<h1>Data Stock Out <small>Stock Out</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li class="active">
			Stock Out
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Stock Out
				<div class="pull-right">
					<button type="button" class="btn btn-primary cetak" data-toggle="modal" title="Cetak"><i class="fa fa-plus"></i></button>
				</div>
			</h4>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nama Items</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Detail</th>
						<th class="text-center">Admin</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td><?= $data->name_items ?></td>
							<td class="text-center">
								<?= $data->type_qty == 'Kg' ? indo_kg($data->qty_stock_out_kg) . '/' . $data->type_qty : indo_qty($data->qty_stock_out) . '/' . $data->type_qty ?>
							</td>
							<td class="text-center"><?= indo_date($data->date); ?></td>
							<td><?= $data->detail ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center">
								<a href="<?= site_url('Stock_out/del/' . $data->stock_out_id . '/' . $data->items_id .'/'. $data->type_qty) ?>" class="btn btn-danger" onclick="return confirm('Data <?= $data->name_items ?> akan dihapus secara permanen, apakah anda yakin  ?');">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog  modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Stock Out</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= site_url('stock_out/add') ?>">
					<div class="form-group">
						<label for="type">Satuan <i class="text-danger">*</i></label>
						<select name="type" id="type" class="form-control select2" style="width: 100%;">
							<option value=""> --Pilih-- </option>
							<option value="kg">Kg</option>
							<option value="pcs">pcs</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger " data-toggle="tooltip" title="Back" onclick="location.reload();" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i></button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(".cetak").click(function() {
			$("#exampleModal").modal({
				backdrop: 'static',
				keyboard: false
			});
		});
	});
</script>
