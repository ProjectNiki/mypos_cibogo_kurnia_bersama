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
				<h3>INVOICE : <?= $row->invoice . '' . $row->no_urut_invoice ?></h3>
				<hr width="35%">
			</div>
			Print On : <?= date('Y-m-d H:i:s'); ?>
		</div>
		<div class="box-body">
			<table class=" table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nama Items</th>
						<th class="text-center">Sub Katagori</th>
						<th class="text-center">Katagori</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Payment</th>
						<th class="text-center">Price (Rp)</th>
						<th class="text-center">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($result as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $data->name_items ?></td>
							<td><?= $data->name_sub_categories ?></td>
							<td><?= $data->name_categories ?></td>
							<td class="text-center">
								<?= $data->type_qty == 'Kg' ? indo_kg($data->qty_kg) . '/' . $data->type_qty : indo_qty($data->qty) . '/' . $data->type_qty ?>
							</td>
							<td class="text-center"><?= $data->payment == 1 ? 'Cash' : 'Debit' ?></td>
							<td><?= indo_currency($data->harga_pembayaran) ?></td>
							<td><?= indo_currency($data->total)  ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="7" class="text-right">
							<b>Grand Total</b>
						</td>
						<td colspan="1" style="text-align: left;">
							<?= indo_currency($row->total_price) ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>
