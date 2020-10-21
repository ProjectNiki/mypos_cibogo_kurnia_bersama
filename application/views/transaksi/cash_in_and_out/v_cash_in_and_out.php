<section class="content-header">
	<h1>Data Cash In & Cash Out
		<small>Cash In & Cash Out</small>
	</h1>
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
			Cash In & Cash Out
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Cash In & Cash Out
				<div class="pull-right">
					<div class="pull-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
					</div>
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
						<th class="text-center">Action</th>
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
							<td class="text-center"><?= indo_date($data->date) . ' ' . $data->created ?></td>
							<td><?= indo_currency($data->total) ?></td>
							<td><?= $data->noted ?></td>
							<td class="text-center">
								<a href="<?= site_url('cash_in_and_out/edit/' . $data->cico_id . '/' . $data->type) ?>" class="btn btn-success">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?= site_url('cash_in_and_out/del/' . $data->cico_id) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ? Transaksi Ini akan dihapus secara permanen!')">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>

			</table>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog  modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Product Item</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= site_url('cash_in_and_out/add_cash_in_and_out') ?>">
					<div class="form-group">
						<label for="type">Pilih Type <i class="text-danger">*</i></label>
						<select name="type" id="type" class="form-control select2" style="width: 100%;">
							<option value=""> --Pilih-- </option>
							<option value="1">Cash In</option>
							<option value="2">Cash Out</option>
						</select>
					</div>
					<div class="form-group">
						<button type="reset" class="btn btn-danger"><i class="fa fa-rotate-left"></i></button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
