<section class="content-header">
	<h1>Data Laporan Cash In & Cash Out
		<small>Laporan Cash In & Cash Out</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Laporan
		</li>
		<li class="active">
			Laporan Cash In & Cash Out
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Laporan Cash In & Cash Out
				<div class="pull-right">
					<button type="button" class="btn btn-success cetak" data-toggle="modal" title="Cetak"><i class="glyphicon glyphicon-print"></i></button>
				</div>
			</h4>
		</div>
		<div class="box-body table-responsive">

			<table class="table table-bordered table-striped" id="datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">PIC</th>
						<th class="text-center">Type</th>
						<th class="text-center">Payment</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Total</th>
						<th class="text-center">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $data->pj ?></td>
							<td class="text-center">
								<?php if ($data->type == 'In') { ?>
									<a href="#" class="btn btn-success">
										In
									</a>
								<?php } else { ?>
									<a href="#" class="btn btn-danger">
										Out
									</a>
								<?php }  ?>
							</td>
							<td class="text-center"><?= $data->payment == 1 ? 'Cash' : 'Debit' ?></td>
							<td class="text-center"><?= indo_date($data->date)  . ' ' . $data->created ?></td>
							<td><?= indo_currency($data->total) ?></td>
							<td><?= $data->noted ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success">
					<center><b>Laporan Cash In Cash Out</b></center>
				</div>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= site_url('lap_cash_in_and_out/get_data') ?>" target="_blank">
					<div class="form-group">
						<label class="control-label">Start Date</label>
						<input type="date" name="start" value="<?= date('Y-m-d'); ?>" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">End Date</label>
						<input type="date" name="end" value="<?= date('Y-m-d', strtotime('+30 days')); ?>" class=" form-control">
					</div>
					<hr style="border: none;border-bottom: 1px solid black;width: 80%;">
					<div class="text-center">
						<button type="submit" class="btn btn-danger " data-toggle="tooltip" title="Back" onclick="location.reload();" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i></button>
						<button class="btn btn-primary" type="submit" name="submit" value="proses" data-toggle="tooltip" title="Print" onclick="return valid();"><i class="glyphicon glyphicon-print"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(".cetak").click(function() {
			$("#exampleModal").modal({
				backdrop: 'static',
				keyboard: false
			});
		});
	});
</script>
