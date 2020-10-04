<section class="content-header">
	<h1>Data Biaya Pengurusan <small>Biaya Pengurusan</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li class="active">
			Biaya Pengurusan
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Biaya Pengurusan
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
						<th class="text-center">Fee</th>
						<th class="text-center">Oprasional</th>
						<th class="text-center">Pajak/Tax</th>
						<th class="text-center">Uang LS/Lab</th>
						<th class="text-center">Jasa Perusahaan</th>
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
							<td><?= indo_currency($data->fee_oprasional) ?></td>
							<td><?= indo_currency($data->oprasional) ?></td>
							<td><?= indo_currency($data->pajak_tax) ?></td>
							<td><?= indo_currency($data->lab) ?></td>
							<td><?= indo_currency($data->jasa_perushaan) ?></td>
							<td class="text-center">
								<a href="<?= site_url('oprasional/del/' . $data->pengurusan_id) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ? Transaksi Ini akan dihapus secara permanen!')">
									<i class=" fa fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
