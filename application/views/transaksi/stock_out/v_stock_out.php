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
					<a href="<?= site_url('stock_out/stock_out_add') ?>" class="btn btn-primary">
						<i class="fa fa-plus"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nama Items</th>
						<th class="text-center">Qty</th>
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
							<td class="text-center"><?= indo_qty($data->qty_stock_out) ?></td>
							<td class="text-center"><?= indo_date($data->date); ?></td>
							<td><?= $data->detail ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center">
								<a href="<?= site_url('Stock_out/del/' . $data->stock_out_id . '/' . $data->items_id) ?>" class="btn btn-danger" onclick="return confirm('Data <?= $data->name_items ?> akan dihapus secara permanen, apakah anda yakin  ?');">
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
