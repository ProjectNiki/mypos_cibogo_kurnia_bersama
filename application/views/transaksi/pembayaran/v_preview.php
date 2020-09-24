<section class="content-header">
	<h1>Preview Pembayaran <small>Pembayaran</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li>
			<a href="<?= site_url('pembayaran') ?>">
				Pembayaran
			</a>
		</li>
		<li class="active">
			Preview
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Pembayaran
				<div class="pull-right">
					<a href="<?= site_url('pembayaran') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<h2 class="text-center">No Invoice : MP2009230001 </h2>
			<table class=" table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">ID Down Payment</th>
						<th class="text-center">A/N</th>
						<th class="text-center">Tanggal Dp</th>
						<th class="text-center">Price (Rp)</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($result as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->down_payment_id ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center"><?= $data->created_dp ?></td>
							<td><?= indo_currency($data->down_payment) ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="text-right">
							<b>Jumlah Terbayar</b>
						</td>
						<td colspan="1" class="text-left">
							<?php foreach ($result_dp as $key => $data) { ?>
								<?= indo_currency($data->result_dp) ?>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="4" class="text-right">
							<b>Jumlah Transaksi</b>
						</td>
						<td colspan="1" class="text-left">
							<?php foreach ($result as $key => $data) { ?>
								<?= indo_currency($data->total_price) ?>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="4" class="text-right">
							<b>Sisa Pembayaran</b>
						</td>
						<td colspan="1" class="text-left">
							<?php foreach ($result as $key => $result) { ?>
								<?php foreach ($result_dp as $key => $result_dp) { ?>
									<?= indo_currency($result->total_price - $result_dp->result_dp) ?>
								<?php } ?>
							<?php } ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>
