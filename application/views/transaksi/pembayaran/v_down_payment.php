<?php
date_default_timezone_set("Asia/Bangkok");
$uniqid = uniqid();
?>

<section class="content-header">
	<h1>Data Pembayaran <small>Pembayaran Down Payment</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li class="active">
			Pembayaran Down Payment
		</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-widget">
				<div class="box-body">
					<table width="100%">
						<tr>
							<td style="vertical-align: top;">
								<label for="Date">Tanggal</label>
							</td>
							<td>
								<div class="form-group">
									<input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="Date">Kasir</label>
							</td>
							<td>
								<div class="form-group">
									<input type="text" value="<?= $row->nama ?>" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="Date">Customer</label>

							</td>
							<td>
								<div class="form-group">
									<input type="text" class="form-control" value="<?= $row->name_customers ?>" readonly="true">
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<!--  -->
		<div class="col-md-3">
			<div class="box box-widget">
				<div class="box-body">
					<div class="text-right">
						<input type="hidden" id="invoice" name="invoice" value="<?= $row->no_urut_invoice ?>">
						<h4>Invoice <b><span id="invoice"><?= $row->invoice  . '' . $row->no_urut_invoice ?></span></b></h4>
						<h3><b><span style="font-size: 30pt;">Rp</span> <span style="font-size: 30pt;"><?= indo_qty($row->total_price)  ?></span></b></h3>
					</div>
					<small style="color: red;">* Grand Total </small>
				</div>
			</div>
		</div>
		<div class="col-md-3" id="key_dp_hide">
			<div class="box box-widget">
				<div class="box-body">
					<div class="text-right">
						<input type="hidden" id="down_payment_id" name="down_payment_id" value="<?= date('Ymd') . '' . $uniqid ?>">
						<h4>DP <b><span id="dp"><?= date('Ymd') . '' . $uniqid ?></span></b></h4>
						<?php
						$result_dp = $row->total_price - $row_dp->result_dp
						?>
						<h3><b><span style="font-size: 30pt;">Rp</span> <span style="font-size: 30pt;" id="result"><?= indo_qty($result_dp) ?></span></b></h3>
						<input type="hidden" id="grand_total_dp" value="<?= $row->total_price - $row_dp->result_dp ?>">
					</div>
					<small style="color: red;">* Sisa Pembayaran </small>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Product Item</th>
								<th class="text-center">Price (Rp)</th>
								<th class="text-center">Stock</th>
								<th class="text-center" style="width: 10%;">Total</th>
							</tr>
						</thead>
						<tbody id="cart_table">
							<?php $no = 1;  ?>
							<?php foreach ($result as $key => $data) { ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $data->name_items ?></td>
									<td><?= indo_currency($data->harga_pembayaran)  ?></td>
									<td class="text-center">
										<?= $data->type_qty == 'Kg' ? indo_kg($data->qty_kg) . '/' . $data->type_qty : indo_qty($data->qty) . '/' . $data->type_qty ?>
									</td>
									<td id="total"><?= indo_currency($data->harga_pembayaran * $data->pembayaran_qty) ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div class="row">
		<div class="col-md-3">
			<div class="box">
				<div class="box-body">
					<table style="width: 100%;">
						<tr>
							<td>
								<div class="form-group">
									<input type="hidden" id="sub_total" value="<?= $row->total_price ?>" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width: 29%">
								<label for="status">Pembayaran </label>
							</td>
							<td>
								<div class="form-group">
									<input type="text" class="form-control" value="<?= $row->status == 2 ? 'Down Payment' : 'DP' ?>" readonly>
								</div>
							</td>
						</tr>
						<?php if ($row_dp->total_price - $row_dp->result_dp == 0) { ?>
							<tr id="down_payment_hide">
								<td style="vertical-align: top;">
									<label for="">Down Payment</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" name="down_payment" id="down_payment" min="0" class="form-control" placeholder="Down Payment" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width: 29%">
									<label for="">Payment</label>
								</td>
								<td>
									<div class="form-group">
										<select name="type" id="" name="" class="form-control select2" style="width: 100%;" disabled>
											<option value=""> --Pilih-- </option>
											<option value="1">Cash</option>
											<option value="2">Debit</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width: 29%">
									<label for="cash">Cash</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" id="cash" min="0" class="form-control" placeholder="Cash" readonly>
									</div>
								</td>
							</tr>
						<?php } else { ?>
							<tr id="down_payment_hide">
								<td style="vertical-align: top;">
									<label for="">Down Payment</label>
								</td>
								<td>
									<div class="form-group">
										<input type="text" name="down_payment" onkeyup="splitInDots(this)" id="down_payment" min="0" class="form-control" placeholder="Down Payment">
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width: 29%">
									<label for="">Payment</label>
								</td>
								<td>
									<div class="form-group">
										<select name="type" id="payment" name="payment" class="form-control select2" style="width: 100%;">
											<option value=""> --Pilih-- </option>
											<option value="1">Cash</option>
											<option value="2">Debit</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width: 29%">
									<label for="cash">Cash</label>
								</td>
								<td>
									<div class="form-group">
										<input type="text" id="cash" min="0" onkeyup="splitInDots(this)" class="form-control" placeholder="Cash">
									</div>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
		<?php if ($row_dp->total_price - $row_dp->result_dp == 0) { ?>
			<div class="col-md-3">
				<div class="box">
					<div class="box-body">
						<table style="width: 100%;">
							<tr>
								<td>
									<div class="form-group">
										<input type="hidden" name="sub_total" id="sub_total" value="" class="form-control" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width: 15%">
									<label for="status">Note </label>
								</td>
								<td>
									<div class="form-group">
										<textarea name="noted" id="noted" cols="30" rows="3" class="form-control" placeholder="Note Pembayaran" readonly></textarea>
										<small><span class="text-danger">* Biarkan Kosong Jika Tidak Diisi </span></small>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="col-md-3">
				<div class="box">
					<div class="box-body">
						<table style="width: 100%;">
							<tr>
								<td>
									<div class="form-group">
										<input type="hidden" name="sub_total" id="sub_total" value="" class="form-control" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width: 15%">
									<label for="status">Note </label>
								</td>
								<td>
									<div class="form-group">
										<textarea name="noted" id="noted" cols="30" rows="3" class="form-control" placeholder="Note Pembayaran"></textarea>
										<small><span class="text-danger">* Biarkan Kosong Jika Tidak Diisi </span></small>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="col-md-3">
			<div class="box">
				<div class="box-body">
					<button id="cancel_payment" class="btn btn-warning" style="width: 100%;" onclick="location.reload();">
						<i class="fa fa-refresh"></i>
					</button>
					<hr style="width: 70%;">
					<?php if ($row_dp->total_price - $row_dp->result_dp == 0) { ?>
						<button id="process_payment" class="btn btn-success" style="width: 100%;" disabled='disabled'>
							<i class="fa fa-plus"></i>
						</button>
					<?php } else { ?>
						<button id="process_payment" class="btn btn-success" style="width: 100%;">
							<i class="fa fa-plus"></i>
						</button>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	function calculate() {

		var numeric_format = new Intl.NumberFormat('id-ID', {
			currencyDisplay: 'symbol'
		});

		var grand_total_dp = $('#grand_total_dp').val()
		console.log(grand_total_dp);

		var down_payment = $('#down_payment').val()
		var result = down_payment.replace(/[^a-zA-Z0-9]/g, '');
		var grand_total = grand_total_dp - result

		document.getElementById('result').innerHTML = numeric_format.format(grand_total);
	}

	$(document).on('keyup mouseup', '#down_payment', function() {
		calculate();
	})

	$(document).ready(function() {
		calculate()
	})

	$(document).on('click', '#process_payment', function() {
		var customers_id = $('#customers_id').val()
		var subtotal = $('#sub_total').val()
		var down_payment = $('#down_payment').val()
		var down_payment_id = $('#down_payment_id').val()
		var grandtotal = $('#grand_total').val()
		var payment = $('#payment').val()
		var cash = $('#cash').val()
		var invoice = $('#invoice').val()
		var status = $('#status').val()
		var date = $('#date').val()
		var noted = $('#noted').val()

		if (subtotal < 1) {
			swal("Error!", "Belum Ada Product Item Yang Dipilih!", "error");
		} else if (customers_id == '') {
			swal("Error!", "Data Customers Belum Diinput!", "error");
			$('#customers_id').focus();
		} else if (status == '') {
			swal("Error!", "Data Status Pembayaran Belum Diinput!", "error");
			$('#customers_id').focus();
		} else if (down_payment == '') {
			swal("Error!", "Nominal Down Payment Belum Diinput!", "error");
			$('#down_payment').focus();
		} else if (cash < 1) {
			swal("Error!", "Jumlah Uang Cash Belum Diinput!", "error");
			$('#cash').focus();

		} else {
			if (confirm('Data akan disimpan, apakah yakin ?')) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('pembayaran/process_dp') ?>',
					data: {
						'process_payment': true,
						'customers_id': customers_id,
						'subtotal': subtotal,
						'down_payment': down_payment,
						'down_payment_id': down_payment_id,
						'grandtotal': grandtotal,
						'cash': cash,
						'payment': payment,
						'noted': noted,
						'invoice': invoice,
						'date': date
					},
					dataType: 'json',
					success: function(result) {
						if (result.success == true) {
							alert('Data Behasil Disimpan');
							location.href = '<?= site_url('pembayaran') ?>'
						} else {
							swal("Error!", "Transaksi Gagal!", "error");
						}
						location.href = '<?= site_url('pembayaran') ?>'
					}
				})
			}
		}
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