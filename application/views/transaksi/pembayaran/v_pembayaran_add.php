<?php

use Sabberworm\CSS\Value\Value;

date_default_timezone_set("Asia/Bangkok");
$uniqid = uniqid();

$myOriginalDate = date("Y-m-d");
?>

<section class="content-header">
	<h1>Data Pembayaran <small>Pembayaran</small></h1>
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
			Pembayaran
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
									<input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>" class="form-control">
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="Date">Admin</label>
							</td>
							<td>
								<div class="form-group">
									<input type="text" value="<?= ucfirst($this->fungsi->user_login()->nama); ?>" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width: 27%">
								<label for="">Customer</label>
							</td>
							<td>
								<div class="form-group input-group">

									<input type="hidden" id="customers_id" id="customers_id">
									<input type="text" id="name_customers" id="name_customers" class="form-control" autofocus readonly>
									<span class="input-group-btn">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#show_customers">
											<i class="fa fa-search"></i>
										</button>
									</span>
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
					<table width="100%">
						<tr>
							<td style="vertical-align: top; width: 27%">
								<label for="">ID Items</label>
							</td>
							<td>
								<div class="form-group input-group">
									<input type="hidden" id="harga_items">
									<input type="hidden" id="qty_items">
									<input type="hidden" id="items_id">
									<input type="hidden" id="name_items">
									<input type="text" id="items_key" class="form-control" autofocus readonly>
									<span class="input-group-btn">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="qty">Qty</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" name="qty" id="qty" value="1" min="1" class="form-control" autocomplete="off">
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
							</td>
							<td>
								<div class="form-group">
									<button type="button" id="add_cart" class="btn btn-primary">
										<i class="fa fa-cart-plus"></i>
									</button>
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
						<h4>Invoice <b>INV/<?= date("dmy", strtotime($myOriginalDate)); ?>/CK/<span id="inisial_pt"></span>/<?= sprintf("%05s", $row) ?></b></h4>
						<input type="hidden" name="invoice" id="invoice" value="INV/<?= date("dmy", strtotime($myOriginalDate)); ?>/CK/">
						<input type="hidden" name="invoice_inisial" id="invoice_inisial">
						<input type="hidden" name="invoice_ai" id="invoice_ai" value="<?= sprintf("%05s", $row) ?>">
						<h3><b><span style="font-size: 30pt;">Rp</span> <span id="grand_total2" style="font-size: 30pt;">0</span></b></h3>
					</div>
					<small style="color: red;">* Grand Total </small>
				</div>
			</div>
		</div>
		<div class="col-md-3" id="key_dp_hide" style="display: none;">
			<div class="box box-widget">
				<div class="box-body">
					<div class="text-right">
						<input type="hidden" id="down_payment_id" name="down_payment_id" value="<?= date('Ymd') . '' . $uniqid ?>">
						<h4>DP <b><span id="dp"><?= date('Ymd') . '' . $uniqid ?></span></b></h4>
						<h3><b><span style="font-size: 30pt;">Rp</span> <span id="grand_total_dp" style="font-size: 30pt;">0</span></b></h3>
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
								<th class="text-center">Qty</th>
								<th class="text-center" style="width: 10%;">Total</th>
								<th class="text-center" style="width: 15%;">Action</th>
							</tr>
						</thead>
						<tbody id="cart_table">
							<?php $this->view('transaksi/pembayaran/v_cart_data') ?>
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
									<input type="hidden" name="sub_total" id="sub_total" value="" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width: 29%">
								<label for="status">Pembayaran </label>
							</td>
							<td>
								<div class="form-group">
									<select name="status" id="status" class="form-control select2">
										<option value="">-- Pilih --</option>
										<option value="1">Lunas</option>
										<option value="2">Down Payment</option>
									</select>
								</div>
							</td>
						</tr>
						<tr id="down_payment_hide" style="display: none;">
							<td style="vertical-align: top;">
								<label for="">Down Payment</label>
							</td>
							<td>
								<div class="form-group">
									<input type="text" name="down_payment" id="down_payment" onkeyup="splitInDots(this)" class="form-control" placeholder="Down Payment">
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width: 29%">
								<label for="cash">Cash</label>
							</td>
							<td>
								<div class="form-group">
									<input type="text" id="cash" onkeyup="splitInDots(this)" name="cash" class="form-control" placeholder="Cash" autocomplete="off">
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
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
			<div class="col-md-3">
				<div class="box">
					<div class="box-body">
						<button id="cancel_payment" class="btn btn-warning" style="width: 100%;">
							<i class="fa fa-refresh"></i>
						</button>
						<hr style="width: 70%;">
						<button id="process_payment" class="btn btn-success" style="width: 100%;">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
</section>

<!-- Modal  Add Product -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Product Items</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="datatable">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">ID Items</th>
							<th class="text-center">Nama Items</th>
							<th class="text-center">Price (Rp)</th>
							<th class="text-center">Stock</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($items as $key => $data) { ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $data->items_key ?></td>
								<td><?= $data->name_items ?></td>
								<td><?= indo_currency($data->harga_items) ?></td>
								<td class="text-center"><?= $data->qty_items ?></td>
								<td class="text-center">
									<button class="btn btn-success btn-sm" id="select" data-items_key=<?= $data->items_key ?> data-name_items="<?= $data->name_items ?>" data-harga_items="<?= $data->harga_items ?>" data-items_id="<?= $data->items_id ?>" data-product="<?= $data->name_items ?>" data-item="<?= $data->items_id ?>" data-qty_items="<?= $data->qty_items ?>">
										<i class="fa fa-check"></i>
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


<!-- Modal  Add Product -->
<div class="modal fade" id="show_customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Customer</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="datatables">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Customer</th>
							<th class="text-center">Prushaan</th>
							<th class="text-center">Phone (Rp)</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($customers as $key => $data) { ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $data->name_customers ?></td>
								<td><?= $data->pt_customers ?></td>
								<td><?= $data->phone_customers ?></td>
								<td class="text-center">
									<button class="btn btn-success btn-sm" id="customers_select" data-customers_id="<?= $data->customers_id ?>" data-inisial_pt="<?= $data->inisial_pt ?>" data-name_customers="<?= $data->name_customers ?>">
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
			$('#items_id').val($(this).data('items_id'));
			$('#harga_items').val($(this).data('harga_items'));
			$('#name_items').val($(this).data('name_items'));
			$('#qty_items').val($(this).data('qty_items'));
			$('#items_key').val($(this).data('items_key'));
			$('#exampleModal').modal('hide');
		});

		$(document).on('click', '#customers_select', function() {
			$('#name_customers').val($(this).data('name_customers'));
			$('#invoice_inisial').val($(this).data('inisial_pt'));
			$('#customers_id').val($(this).data('customers_id'));


			var inisial_pt = $(this).data('inisial_pt');
			document.getElementById("inisial_pt").innerHTML = inisial_pt;
			$('#show_customers').modal('hide');
		});


		$(document).on('click', '#add_cart', function() {
			var items_id = $('#items_id').val()
			var harga_items = $('#harga_items').val()
			var qty_items = $('#qty_items').val()
			var qty = $('#qty').val()

			if (items_id == '') {
				swal("Error!", "Product belum dipilih!", "error");
				$('#items_id').focus();
			} else if (qty_items < 1) {
				swal("Error!", "Stock tidak mencukupi!", "error");
				$('#items_id').val('')
			} else {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('pembayaran/process') ?>',
					data: {
						'add_cart': true,
						'items_id': items_id,
						'harga_items': harga_items,
						'qty': qty
					},
					dataType: 'json',
					success: function(result) {
						if (result.success == true) {
							$('#cart_table').load('<?= site_url('pembayaran/v_cart_data') ?>', function() {
								swal("Success!", "Data ditambahkan ke cart!", "success");
								calculate()
							})
							$('#name_items').val('');
							$('#items_id').val('');
							$('#qty').val(1);
							$('#items_key').val('');

						} else {
							swal("Error!", "Data Cart gagal disimpan!", "error");
						}
					}
				})
			}
		});

		$(document).on('click', '#del_cart', function() {
			if (confirm('Apakah Yakin?')) {
				var cart_id = $(this).data('cartid')
				$.ajax({
					type: 'POST',
					url: '<?= site_url('pembayaran/cart_del'); ?>',
					dataType: 'json',
					data: {
						'cart_id': cart_id
					},
					success: function(result) {
						if (result.success == true) {
							$('#cart_table').load('<?= site_url('pembayaran/v_cart_data') ?>', function() {
								swal("Success!", "Data berhasil dihapus!", "success");
								calculate()
							})
						} else {
							swal("Success!", "Data gagal dihapus!", "success");
						}
					}
				})
			} else {
				swal("Error!", "Data gagal dihapus!", "error");
			}
		})



		function calculate() {

			var subtotal = 0;

			var numeric_format = new Intl.NumberFormat('id-ID', {
				currencyDisplay: 'symbol'
			});

			$('#cart_table tr').each(function() {
				subtotal += parseInt($(this).find('#total').text())
			})

			isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

			document.getElementById('grand_total2').innerHTML = numeric_format.format(subtotal);
			document.getElementById('sub_total').innerHTML = numeric_format.format(subtotal);
			document.getElementById('grand_total_dp').innerHTML = numeric_format.format(subtotal);

			var down_payment = $('#down_payment').val()

			var result = down_payment.replace(/[^a-zA-Z0-9]/g, '');

			var grand_total = subtotal - result
			console.log(subtotal)

			document.getElementById('grand_total_dp').innerHTML = numeric_format.format(grand_total);
		}

		$(document).on('keyup mouseup', '#down_payment', function() {
			calculate();
		})

		$(document).ready(function() {
			calculate()
		})

		// Proses payment
		$(document).on('click', '#process_payment', function() {
			var customers_id = $('#customers_id').val()
			var noted = $('#noted').val()
			var subtotal = $('#sub_total').val()
			var down_payment = $('#down_payment').val()
			var down_payment_id = $('#down_payment_id').val()
			var grandtotal = $('#grand_total').val()
			var cash = $('#cash').val()
			var change = $('#change').val()
			var status = $('#status').val()
			var date = $('#date').val()
			var invoice_inisial = $('#invoice_inisial').val()
			var invoice_ai = $('#invoice_ai').val()
			var invoice = $('#invoice').val()

			if (subtotal < 1) {
				swal("Error!", "Belum Ada Product Item Yang Dipilih!", "error");
			} else if (cash < 1) {
				swal("Error!", "Jumlah Uang Cash Belum Diinput!", "error");
				$('#cash').focus();
			} else if (customers_id == '') {
				swal("Error!", "Data Customer Belum Diinput!", "error");
				$('#customers_id').focus();
			} else if (status == '') {
				swal("Error!", "Data Status Pembayaran Belum Diinput!", "error");
				$('#customers_id').focus();
			} else {
				if (confirm('Data akan disimpan, apakah yakin ?')) {
					$.ajax({
						type: 'POST',
						url: '<?= site_url('pembayaran/process') ?>',
						data: {
							'process_payment': true,
							'customers_id': customers_id,
							'subtotal': subtotal,
							'down_payment': down_payment,
							'down_payment_id': down_payment_id,
							'grandtotal': grandtotal,
							'cash': cash,
							'change': change,
							'status': status,
							'noted': noted,
							'date': date,
							'invoice_inisial': invoice_inisial,
							'invoice_ai': invoice_ai,
							'invoice': invoice
						},
						dataType: 'json',
						success: function(result) {
							if (result.success == true) {
								alert('Data Behasil Disimpan');
								location.href = '<?= site_url('pembayaran') ?>'
								// window.location.reload();
							} else {
								swal("Error!", "Transaksi Gagal!", "error");
							}
							location.href = '<?= site_url('pembayaran') ?>'
						}
					})
				}
			}
		});
	});
</script>

<script>
	$(document).ready(function() {

		$('#status').on('change', function() {
			if (this.value == '2') {
				$("#key_dp_hide").show();
				$("#down_payment_hide").show();
			} else {
				$("#down_payment_hide").hide();
				$("#key_dp_hide").hide();
			}
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
