<section class="content-header">
	<h1>Add Biaya Pengurusan <small>Biaya Pengurusan</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li>
			<a href="<?= site_url('oprasional') ?>">
				Biaya Pengurusan
			</a>
		</li>
		<li class="active">
			add
		</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h4>Add Biaya Pengurusan
				<div class="pull-right">
					<a href="<?= site_url('oprasional') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="" method="POST">
						<div class="form-group">
							<label for="">Date <i class="text-danger">*</i></label>
							<input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
						</div>
						<label for="">No Invoice<i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('invoice') == TRUE ? 'has-error' : null ?>">
							<input type="text" id="invoice" name="invoice" value="<?= set_value('invoice') ?>" class="form-control" readonly>
							<input type="hidden" id="no_urut_invoice" name="no_urut_invoice" class="form-control" required>
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
						<br>
						<label for="fee">Fee <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('fee_oprasional') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="fee_oprasional" name="fee_oprasional" class="form-control" placeholder="Fee" value="<?= set_value('fee_oprasional') ?>" autocomplete="off">
						</div>
						<?= form_error('fee_oprasional', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<label for="oprasional">Oprasional <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('oprasional') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="oprasional" name="oprasional" class="form-control" placeholder="Oprasional" value="<?= set_value('oprasional') ?>" autocomplete="off">
						</div>
						<?= form_error('oprasional', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<label for="pajak_tax">Pajak/tax <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('pajak_tax') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" onkeyup="splitInDots(this)" id="pajak_tax" name="pajak_tax" class="form-control" placeholder="Pajak/tax" value="<?= set_value('pajak_tax') ?>" autocomplete="off">
						</div>
						<?= form_error('pajak_tax', '<div class="text-danger">', '</div>'); ?>
						<br>
						<label for="lab">Ls/Lab <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('lab') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" onkeyup="splitInDots(this)" id="lab" name="lab" class="form-control" placeholder="Ls/Lab" value="<?= set_value('lab') ?>" autocomplete="off">
						</div>
						<?= form_error('lab', '<div class="text-danger">', '</div>'); ?>
						<br>
						<label for="jasa_perushaan">Jasa Perusahaan <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('jasa_perushaan') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" onkeyup="splitInDots(this)" id="jasa_perushaan" name="jasa_perushaan" class="form-control" placeholder="Jasa Perusahaan" value="<?= set_value('jasa_perushaan') ?>" autocomplete="off">
						</div>
						<?= form_error('jasa_perushaan', '<div class="text-danger">', '</div>'); ?>
						<br>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Data Pembayaran</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="datatable">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">No Invoice</th>
							<th class="text-center">Customer </th>
							<th class="text-center">Perusahaan </th>
							<th class="text-center">Tgl Pembelian</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($row as $key => $data) { ?>
							<tr>
								<td class="text-center"><?= $no++; ?></td>
								<td class="text-center"><?= $data->invoice . '' . $data->no_urut_invoice ?></td>
								<td><?= $data->name_customers ?></td>
								<td><?= $data->pt_customers ?></td>
								<td><?= $data->created_pembelian ?></td>
								<td class="text-center">
									<button class="btn btn-success btn-sm" id="select" data-invoice="<?= $data->invoice . '' . $data->no_urut_invoice ?>" data-no_urut_invoice="<?= $data->no_urut_invoice ?>">
										<i class=" fa fa-check"></i>
									</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click', '#select', function() {
			$('#invoice').val($(this).data('invoice'));
			$('#no_urut_invoice').val($(this).data('no_urut_invoice'));

			$('#exampleModal').modal('hide');
		});
	});
</script>

<script type="text/javascript">
	function reverseNumber(input) {
		return [].map.call(input, function(x) {
			return x;
		}).reverse().join('');
	}

	function plainNumber(number) {
		return number.split('.').join('');
	}

	function splitInDots(input) {
		var value = input.value,
			plain = plainNumber(value),
			reversed = reverseNumber(plain),
			reversedWithDots = reversed.match(/.{1,3}/g).join('.'),
			normal = reverseNumber(reversedWithDots);
		input.value = normal;
	}
</script>
