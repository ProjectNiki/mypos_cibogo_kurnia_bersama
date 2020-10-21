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
	<div class="text-center">
		<h3><?= $row->bp_key ?></h3>
		<hr width="20%">
	</div>
	<b>Perusahaan</b> : <?= $row->pt_customers ?>
	<br>
	<table class="table table-bordered table-responsive" style="padding-top: 10px;">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Tanggal</th>
				<th class="text-center">Admin</th>
				<th class="text-center">Fee (Rp)</th>
				<th class="text-center">Oprasional (Rp)</th>
				<th class="text-center">Pajak/tax (Rp)</th>
				<th class="text-center">Uang Ls/lab (Rp)</th>
				<th class="text-center">Jasa Perusahaan</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($result as $key => $data) { ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td class="text-center"><?= indo_date($data->date) . ' ' . $data->created ?></td>
					<td class="text-left"><?= $data->nama ?></td>
					<td class="text-left"><?= indo_currency($data->fee_oprasional) ?></td>
					<td class="text-left"><?= indo_currency($data->oprasional) ?></td>
					<td class="text-left"><?= indo_currency($data->pajak_tax) ?></td>
					<td class="text-left"><?= indo_currency($data->lab) ?></td>
					<td class="text-left"><?= indo_currency($data->jasa_perushaan) ?></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" class="text-right">
					<b>Grand Total</b>
				</td>
				<td colspan="1" style="text-align: left;">
					<?= indo_currency($row_sum->sum_fee) ?>
				</td>
				<td colspan="1" style="text-align: left;">
					<?= indo_currency($row_sum->sum_oprasional) ?>
				</td>
				<td colspan="1" style="text-align: left;">
					<?= indo_currency($row_sum->sum_pajak) ?>
				</td>
				<td colspan="1" style="text-align: left;">
					<?= indo_currency($row_sum->sum_lab) ?>
				</td>
				<td colspan="1" style="text-align: left;">
					<?= indo_currency($row_sum->sum_jasa_perushaan) ?>
				</td>
			</tr>
		</tfoot>
		<tfoot>
			<tr>
				<td colspan="8" class="text-center">
					<b>Total Keseluruhan</b>
				</td>
			</tr>
			<tr>
				<td colspan="8" style="text-align: center;">
					<?= indo_currency($row_sum->sum_fee + $row_sum->sum_oprasional + $row_sum->sum_pajak + $row_sum->sum_lab + $row_sum->sum_jasa_perushaan) ?>
				</td>
			</tr>
		</tfoot>
	</table>
	Print On : <?= date('Y-m-d H:i:s'); ?>
</body>

</html>