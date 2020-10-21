<section class="content-header">
	<h1>Data Biaya Pengurusan <small>Biaya Pengurusan</small></h1>
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
			Biaya Pengurusan
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Biaya Pengurusan
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
						<th class="text-center">ID Biaya Pengurusan</th>
						<th class="text-center">Perusahaan</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Fee</th>
						<th class="text-center">Oprasional</th>
						<th class="text-center">Pajak/Tax</th>
						<th class="text-center">Uang LS/Lab</th>
						<th class="text-center">Jasa Perusahaan</th>
						<th class="text-center">Admin</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $data) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td class="text-center"><?= $data->bp_key ?></td>
							<td class="text-center"><?= $data->pt_customers ?></td>
							<td class="text-center"><?= indo_date($data->date) . ' ' . $data->created ?></td>
							<td><?= indo_currency($data->fee_oprasional) ?></td>
							<td><?= indo_currency($data->oprasional) ?></td>
							<td><?= indo_currency($data->pajak_tax) ?></td>
							<td><?= indo_currency($data->lab) ?></td>
							<td><?= indo_currency($data->jasa_perushaan) ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center">
								<a href="<?= site_url('oprasional/edit/' . $data->bpd_id) ?>" class="btn btn-success">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?= site_url('oprasional/del/' . $data->bpd_id) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ? Transaksi Ini akan dihapus secara permanen!')">
									<i class=" fa fa-trash"></i>
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
				<h4 class="modal-title" id="exampleModalLabel">Biaya Oprasional</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= site_url('oprasional/oprasional_option') ?>">
					<div class="form-group">
						<label for="type">Pilih Type <i class="text-danger">*</i></label>
						<select name="type" id="type" class="form-control select2" style="width: 100%;">
							<option value=""> --Pilih-- </option>
							<option value="1">Biaya Oprasional Baru</option>
							<option value="2">Update Biaya Oprasional</option>
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