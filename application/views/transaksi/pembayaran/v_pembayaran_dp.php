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
			<table style="width:100%">
				<tr>
					<th style="width:70%;">
						<u>
							<h4>
								<b>
									Customer
								</b>
							</h4>
						</u>
					</th>
					<th style="width:30%">
						<u>
							<h4>
								<b>
									Admin
								</b>
							</h4>
						</u>
					</th>
				</tr>
				<tr>
					<td>
						<?= $row->name_customers ?>
					</td>
					<td>
						<?= $row->nama ?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $row->pt_customers ?>
					</td>
					<td>
						<?= $row->create_invoice ?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $row->phone_customers ?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $row->address_customers ?>
					</td>
				</tr>
			</table>
			<div class="text-center">
				<h3>INVOICE : <?= $row->invoice_pembayaran . '' . $row->invoice ?></h3>
				<hr width="35%">
			</div>
			Print On : <?= date('Y-m-d H:i:s'); ?>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">ID Down Payment</th>
						<th class="text-center">Price (Rp)</th>
						<th class="text-center">Note</th>
						<th class="text-center">A/N</th>
						<th class="text-center">Tanggal Dp</th>
						<th class="text-center">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($result as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->down_payment_id ?></td>
							<td class="text-left"><?= indo_currency($data->down_payment) ?></td>
							<td class="text-left"><?= $data->noted_dp ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center"><?= $data->created_dp ?></td>
							<td class="text-left"><?= indo_currency($data->down_payment) ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" class="text-right">
							<b>Jumlah Terbayar</b>
						</td>
						<td colspan="1" class="text-left">
							<?= indo_currency($get_sum_dp->result_dp) ?>
						</td>
					</tr>
					<tr>
						<td colspan="6" class="text-right">
							<b>Jumlah Transaksi</b>
						</td>
						<td colspan="1" class="text-left">
							<?= indo_currency($get_sum_dp->total_price) ?>
						</td>
					</tr>
					<tr>
						<td colspan="6" class="text-right">
							<b>Sisa Pembayaran</b>
						</td>
						<td colspan="1" class="text-left">
							<?= indo_currency($get_sum_dp->total_price - $get_sum_dp->result_dp) ?>
						</td>
					</tr>
				</tfoot>
			</table>
			<br>
			<?php if ($row->lunas_down_payment == 1) { ?>
				<div class="text-center">
					<input type='submit' value="Tersimpan" id='submitBtn' style="width: 50%;" class='btn btn-success' disabled='disabled' />
				</div>
			<?php } else if ($get_sum_dp->total_price - $get_sum_dp->result_dp == 0) { ?>
				<div class="text-center">
					<a href="<?= site_url('pembayaran/update_status_down_payment/' . $row->pembayaran_id) ?>" style="width: 50%;" class="btn btn-primary" onclick="return confirm('Apakah yakin ?')">Update Status</a>
				</div>
			<?php } else { ?>
				<div class="text-center">
					<input type='submit' value="Simpan" id='submitBtn' style="width: 50%;" class='btn btn-danger' disabled='disabled' />
				</div>
			<?php } ?>
			<div class="text-right">
				<a href="" class="btn btn-warning">
					<i class="fa fa-print"></i>
				</a>
			</div>
		</div>
	</div>
</section>

<script>
	$('#submitBtn').prop('disabled', true);
</script>
