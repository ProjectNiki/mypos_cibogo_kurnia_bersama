<section class="content-header">
	<h1>Add Cash In Cash Out
		<small>Cash In Cash Out</small>
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
		<li>
			Stock In Stock Out
		</li>
		<li class="active">
			Add
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>Add Cash In Cash Out
				<div class="pull-right">
					<a href="<?= site_url('cash_in_and_out') ?>" class="btn btn-warning">
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
							<label for="name_categories">Pilih Type <i class="text-danger">*</i></label>
							<select name="type" id="type" class="form-control select2" style="width: 100%;">
								<option value="">Pilih</option>
								<option value="1">Cash In</option>
								<option value="2">Cash Out</option>
							</select>
						</div>
						<div class="form-group" style="display: none;" id="date_change">
							<label for="date">Tanggal <i class="text-danger">*</i></label>
							<input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
							<?= form_error('date', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="type_in_change">
							<label for="type_in">Type <i class="text-danger">*</i></label>
							<input type="text" name="type_in" id="type_in" class="form-control" value="In" readonly>
							<?= form_error('type_in', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="type_pic_change">
							<label for="pic">PIC <i class="text-danger">*</i></label>
							<input type="text" name="pic" id="pic" class="form-control" placeholder="PIC">
							<?= form_error('pic', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="payment_in_change">
							<label for="payment">Payment <i class="text-danger">*</i></label>
							<select name="type" id="payment_in" name="payment_in" class="form-control select2" style="width: 100%;">
								<option value=""> --Pilih-- </option>
								<option value="1">Cash</option>
								<option value="2">Debit</option>
							</select>
						</div>
						<div class="form-group" style="display: none;" id="type_total_in_change">
							<label for="total_in">Total <i class="text-danger">*</i></label>
							<input type="text" name="total_in" id="total_in" class="form-control" placeholder="Total In">
							<?= form_error('total_in', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!-- Out -->
						<div class="form-group" style="display: none;" id="type_out_change">
							<label for="type_out">Type <i class="text-danger">*</i></label>
							<input type="text" name="type_out" id="type_out" class="form-control" value="Out" readonly>
							<?= form_error('type_out', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="type_nama_change">
							<label for="nama">Nama <i class="text-danger">*</i></label>
							<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
							<?= form_error('nama', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="payment_out_change">
							<label for="payment">Payment <i class="text-danger">*</i></label>
							<select name="type" id="payment_out" name="payment_out" class="form-control select2" style="width: 100%;">
								<option value=""> --Pilih-- </option>
								<option value="1">Cash</option>
								<option value="2">Debit</option>
							</select>
						</div>
						<div class="form-group" style="display: none;" id="type_total_out_change">
							<label for="total_out">Total <i class="text-danger">*</i></label>
							<input type="text" name="total_out" id="total_out" class="form-control" placeholder="Total Out">
							<?= form_error('total_out', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="keterangan_change">
							<label for="note">Keterangan<i class="text-danger">*</i></label>
							<textarea name="note" id="note" cols="30" rows="4" class="form-control" placeholder="Keterangan"></textarea>
							<?= form_error('note', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div class="form-group" style="display: none;" id="button_change">
							<button type="reset" class="btn btn-danger"><i class="fa fa-rotate-left"></i></button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('#type').on('change', function() {
			if (this.value == 1) {
				$("#type_in_change").show();
				$("#date_change").show();
				$("#type_out_change").hide();
				$("#type_pic_change").show();
				$("#type_nama_change").hide();
				$("#payment_in_change").show();
				$("#payment_out_change").hide();
				$("#type_total_in_change").show();
				$("#type_total_out_change").hide();
				$("#keterangan_change").show();
				$("#button_change").show();
			} else if (this.value == 2) {
				$("#type_in_change").hide();
				$("#date_change").show();
				$("#type_out_change").show();
				$("#type_pic_change").hide();
				$("#type_nama_change").show();
				$("#payment_in_change").hide();
				$("#payment_out_change").show();
				$("#type_total_in_change").hide();
				$("#type_total_out_change").show();
				$("#keterangan_change").show();
				$("#button_change").show();
			} else {
				window.location.reload(true);
			}
		});
	});
</script>
