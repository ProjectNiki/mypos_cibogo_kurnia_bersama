<?php
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Lap_pengurusan_<?= date('Y-m-d') ?></title>
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

<body style="background-image: url('<?= base_url('assets') ?>/dist/img/lunas.png'); background-repeat: no-repeat; background-position: center;">
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
	<table style="width:100%">
		<tr>
			<th style="width:70%;"><u>Customer</u></th>
			<th style="width:30%"><u>Admin</u></th>
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
			<td><?= $row->pt_customers ?></td>
			<td>
				<?= $row->created_pengurusan ?>
			</td>
		</tr>
		<tr>
			<td><?= $row->phone_customers ?></td>
		</tr>
		<tr>
			<td><?= $row->address_customers ?></td>
		</tr>
	</table>
	<div class="text-center">
		<h3>INVOICE : <?= $row->invoice_pembayaran . '' . $row->no_urut_invoice ?> </h3>
		<hr width="35%">
	</div>
	Print On : <?= date('Y-m-d H:i:s'); ?>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Fee (Rp)</th>
				<th class="text-center">Oprasional (Rp)</th>
				<th class="text-center">Pajak/tax (Rp)</th>
				<th class="text-center">Uang Ls/lab (Rp)</th>
				<th class="text-center">Jasa Perusahaan</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center">1</td>
				<td>
					<?= indo_currency($row_sum->sum_fee) ?>
				</td>
				<td>
					<?= indo_currency($row_sum->sum_oprasional) ?>
				</td>
				<td>
					<?= indo_currency($row_sum->sum_pajak) ?>
				</td>
				<td>
					<?= indo_currency($row_sum->sum_lab) ?>
				</td>
				<td>
					<?= indo_currency($row_sum->sum_jasa_perushaan) ?>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" class="text-right">
					<b>Grand Total</b>
				</td>
				<td colspan="1" style="text-align: left;">
					<?= indo_currency($row_sum->sum_fee + $row_sum->sum_oprasional + $row_sum->sum_pajak + $row_sum->sum_lab + $row_sum->sum_jasa_perushaan) ?>
				</td>
			</tr>
		</tfoot>
	</table>
</body>

</html>
