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
						<th class="text-center">Nama Customers</th>
						<th class="text-center">PT. Customers</th>
						<th class="text-center">Tanggal Transaksi</th>
						<th class="text-center">A/N</th>
						<th class="text-center">Status Pembayaran</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++	 ?></td>
							<td class="text-center"><?= $data->invoice ?></td>
							<td><?= $data->name_customers ?></td>
							<td><?= $data->pt_customers ?></td>
							<td class="text-center"><?= indo_date($data->date)  ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center">
								<?php if ($data->status == 2) { ?>
									<span class="btn btn-danger">Down Payment</span>
								<?php } else { ?>
									<span class="btn btn-success">Lunas</span>
								<?php } ?>
							</td>
							<td class="text-center">
								<a href="<?= site_url('pembayaran/down_payment/' . $data->pembayaran_id) ?>" class="btn btn-success">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?= site_url('pembayaran/preview/' . $data->pembayaran_id) ?>" class="btn btn-default">
									<i class="fa fa-eye"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
