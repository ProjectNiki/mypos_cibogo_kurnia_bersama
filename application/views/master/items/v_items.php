<section class="content-header">
	<h1>Data Items <small>Items</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Master
		</li>
		<li class="active">
			Items
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>
				Data Items
				<div class="pull-right">
					<a href="<?= site_url('items/add') ?>" class="btn btn-primary">
						<i class="fa fa-plus"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="datatable">
				<thead>
					<tr>
						<th>#</th>
						<th class="text-center">ID Items</th>
						<th class="text-center">Nama Items</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">Sub Kategori</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Harga (Rp)</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->items_key ?></td>
							<td><?= $data->name_items ?></td>
							<td><?= $data->name_categories ?></td>
							<td><?= $data->name_sub_categories ?></td>
							<td class="text-center"><?= $data->type_qty == 'Kg' ? indo_kg($data->qty_items_kg) . '/' . $data->type_qty : indo_qty($data->qty_items) . '/' . $data->type_qty ?></td>
							<td><?= indo_currency($data->harga_items) ?></td>
							<td class="text-center">
								<a href="<?= site_url('items/edit/' . $data->items_id . '/' . $data->type_qty) ?>" class="btn btn-success">
									<i class=" fa fa-edit"></i>
								</a>
								<a href="<?= site_url('items/del/' . $data->items_id) ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin ? Data <?= $data->name_items ?> akan dihapus secara permanen')">
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