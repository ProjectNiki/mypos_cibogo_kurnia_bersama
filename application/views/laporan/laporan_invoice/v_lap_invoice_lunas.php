<?php
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Laporan Pengeluaran_<?= date('Y-m-d') ?></title>
	<style>
		.line-title {
			border: 0;
			border-style: inset;
			border-top: 1px solid #000;
		}

		.table_header {
			border-collapse: collapse;
			width: 100%;
		}
	</style>
</head>

<body>
	<img src="<?= base_url('assets') ?>/dist/img/logo_pt.png" alt="" style="position: absolute; width: 90px; height: auto;">
	<table class="table_header" style="width: 100%;">
		<tr>
			<td align="center">
				<span style="line-height: 1.4;">
					PT.CIBOGO KURNIA BERSAMA
					<br>Garment & Kepengurusan Dokument(Custom)
					<br>Jual-Beli Ex Pabrik
					<br>Alamat : Jl.Paku Jaya Ruko Duta Bintaro Blok-AB.2 No.3 Tangerang
					<br>Telp : 081218837236
				</span>
			</td>
		</tr>
	</table>
	<hr class="line-title">

	<table>
		<tr>
			<td>Nama </td>
			<td>:</td>
			<td><?= $row->name_customers ?></td>
		</tr>
		<tr>
			<td>Nama PT </td>
			<td>:</td>
			<td><?= $row->pt_customers ?></td>
		</tr>
		<tr>
			<td>No Tlp</td>
			<td>:</td>
			<td><?= $row->phone_customers ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $row->address_customers ?></td>
		</tr>
	</table>
	<div class="text-center">
		<h3>INVOICE : <?= $row->invoice ?></h3>
		<hr width="35%">
	</div>
	Print On : <?= date('Y-m-d H:i:s'); ?>
	<table class="table table-bordered table-striped table-responsive" style="padding-top: 7px;">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Nama Items</th>
				<th class="text-center">Qty</th>
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
					<td class="text-center"><?= $data->qty ?></td>
					<td><?= indo_currency($data->harga_items) ?></td>
					<td><?= indo_currency($data->qty * $data->harga_items) ?></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right">
					<b>Grand Total</b>
				</td>
				<td colspan="1" style="text-align: left;">

				</td>
			</tr>
		</tfoot>
	</table>
</body>

</html>
