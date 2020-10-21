<section class="content-header">
	<h1>Edit Cash Out
		<small>Cash Out</small>
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
			Cash Out
		</li>
		<li class="active">
			Edit
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-danger">
		<div class="box-header">
			<h4>Edit Cash Out
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
					<form action="<?= site_url('cash_in_and_out/proses_edit') ?>" method="POST">
						<input type="hidden" name="cico_id" id="cico_id" class="form-control" value="<?= $row->cico_id ?>" required>
						<input type="hidden" name="date" id="date" class="form-control" value="<?= $row->date ?>" required>

						<div class="form-group">
							<label for="type_out">Type <i class="text-danger">*</i></label>
							<input type="text" name="type_out" id="type_out" class="form-control" value="<?= $row->type ?>" readonly required>
						</div>
						<div class="form-group">
							<label for="pic">PIC <i class="text-danger">*</i></label>
							<input type="text" name="pic" id="pic" class="form-control" placeholder="PIC" value="<?= $row->pj ?>" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="payment">Payment <i class="text-danger">*</i></label>
							<select id="payment_out" name="payment_out" class="form-control select2" style="width: 100%;" required>
								<option value=""> --Pilih-- </option>
								<option value="1" <?= $row->payment == 1 ? 'selected' : null ?>>Cash</option>
								<option value="2" <?= $row->payment == 2 ? 'selected' : null ?>>Debit</option>
							</select>
						</div>
						<div class="form-group">
							<label for="total_out">Total <i class="text-danger">*</i></label>
							<input type="text" onkeyup="splitInDots(this)" name="total_out" id="total_out" value="<?= indo_qty($row->total) ?>" class="form-control" placeholder="Total Out" required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="noted">Keterangan<i class="text-danger">*</i></label>
							<textarea name="noted" id="noted" cols="30" rows="4" class="form-control" placeholder="Keterangan" required><?= $row->noted ?></textarea>
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
</section>

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
