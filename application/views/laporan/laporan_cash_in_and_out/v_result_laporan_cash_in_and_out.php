<?php
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Laporan Cash In and Out_<?= date('Y-m-d') ?></title>
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
	<h5 class="text-center">Filter : <?= indo_date($start) ?> s/d <?= indo_date($end) ?></h5>
	<h4><u>Cash In</u></h4>
	<table class="table table-bordered table-responsive" style="padding-top: 7px;">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Tanggal</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">PIC</th>
				<th class="text-center">Type</th>
				<th class="text-center">Payment</th>
				<th class="text-center">Total (Rp)</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($get_in as $key => $data) { ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td class="text-center"><?= indo_date($data->date)  . ' ' . $data->created ?></td>
					<td><?= $data->noted ?></td>
					<td><?= $data->pj ?></td>
					<td class="text-center"><?= $data->type ?></td>
					<td class="text-center"><?= $data->payment == 1 ? 'Cash' : 'Debit' ?></td>
					<td><?= indo_currency($data->total) ?></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6" class="text-right">
					<b>Grand Total</b>
				</td>
				<td colspan="1" class="text-left">
					<?= indo_currency($get_in_sum->grand_total_in) ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<h4><u>Cash Out</u></h4>
	<table class="table table-bordered table-responsive" style="padding-top: 7px;">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Tanggal</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Nama</th>
				<th class="text-center">Type</th>
				<th class="text-center">Payment</th>
				<th class="text-center">Total (Rp)</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($get_out as $key => $data) { ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td class="text-center"><?= indo_date($data->date)  . ' ' . $data->created ?></td>
					<td><?= $data->noted ?></td>
					<td><?= $data->pj ?></td>
					<td class="text-center"><?= $data->type ?></td>
					<td class="text-center"><?= $data->payment == 1 ? 'Cash' : 'Debit' ?></td>
					<td><?= indo_currency($data->total) ?></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6" class="text-right">
					<b>Grand Total</b>
				</td>
				<td colspan="1" class="text-left">
					<?= indo_currency($get_out_sum->grand_total_out) ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center text-success">Grand Total Cash In</th>
				<th class="text-center text-danger">Grand Total Cash Out</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center">
					<?= indo_currency($get_in_sum->grand_total_in) ?>
				</td>
				<td class="text-center">
					<?= indo_currency($get_out_sum->grand_total_out) ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-center">
					<b>Grand Total Keseluruhan</b>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2" class="text-center">
					<?= indo_currency($get_in_sum->grand_total_in - $get_out_sum->grand_total_out) ?>
				</td>
			</tr>
		</tfoot>
	</table>
	Print On : <?= date('Y-m-d H:i:s'); ?>
</body>

</html>
