<section class="content-header">
	<h1>Data Pembayaran <small>Pembayaran</small></h1>
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
			Pembayaran
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Pembayaran
				<div class="pull-right">
					<a href="<?= site_url('pembayaran/add') ?>" class="btn btn-primary">
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
						<th class="text-center">Customer</th>
						<th class="text-center">Perusahaan</th>
						<th class="text-center">Tanggal Transaksi</th>
						<th class="text-center">Admin</th>
						<th class="text-center">Status Pembayaran</th>
						<th class="text-center">Preview</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++	 ?></td>
							<td class="text-center"><?= $data->invoice . '' . $data->no_urut_invoice ?></td>
							<td><?= $data->name_customers ?></td>
							<td><?= $data->pt_customers ?></td>
							<td class="text-center"><?= indo_date($data->date)  ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center">
								<?php if ($data->status == 2) { ?>
									<span class="btn btn-primary">Down Payment</span>
								<?php } else { ?>
									<span class="btn btn-success">Lunas</span>
								<?php } ?>
							</td>
							<td class="text-center">
								<?php if ($data->lunas_down_payment == 1) { ?>
									<a href="<?= site_url('pembayaran/preview/' . $data->pembayaran_id . '/' . $data->status) ?>" class="btn btn-default">
										<i class="fa fa-eye"></i>
									</a>
								<?php } else if ($data->status == 2) { ?>
									<a href="<?= site_url('pembayaran/preview/' . $data->pembayaran_id . '/' . $data->status) ?>" class="btn btn-danger">
										<i class="fa fa-eye"></i>
									</a>
								<?php } else { ?>
									<a href="<?= site_url('pembayaran/preview/' . $data->pembayaran_id . '/' . $data->status) ?>" class="btn btn-default">
										<i class="fa fa-eye"></i>
									</a>
								<?php } ?>

							</td>
							<td class="text-center">
								<?php if ($data->status == 1) { ?>
									<a href="#" class="btn btn-success" disabled='disabled' id='submitBtn'>
										<i class="fa fa-edit"></i>
									</a>
								<?php } else if ($data->lunas_down_payment == 1) { ?>
									<a href="#" class="btn btn-success" disabled='disabled' id='submitBtn'>
										<i class="fa fa-edit"></i>
									</a>
								<?php } else { ?>
									<a href="<?= site_url('pembayaran/down_payment/' . $data->pembayaran_id) ?>" class="btn btn-success">
										<i class="fa fa-edit"></i>
									</a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<script>
	$('#submitBtn').prop('disabled', true);
</script>
