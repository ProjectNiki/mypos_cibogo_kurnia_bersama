<section class="content-header">
	<h1>Data Laporan Pengurusan <small>Laporan Pengurusan</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Laporan
		</li>
		<li class="active">
			Laporan Pengurusan
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Laporan Pengurusan
				<div class="pull-right">
					<a href="<?= site_url('oprasional/add') ?>" class="btn btn-primary">
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
						<th class="text-center">No Invoice</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Admin</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td class="text-center"><?= $data->invoice_pembayaran . '' . $data->invoice ?></td>
							<td class="text-center"><?= indo_date($data->created) ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center">
								<a href=" <?= site_url('lap_oprasional/cetak_lap_oprasional/' . $data->pembayaran_id) ?>" class="btn btn-success" target="_blank">
									<i class="glyphicon glyphicon-print"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
