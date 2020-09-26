<?php
date_default_timezone_set("Asia/Bangkok");
$uniqid = uniqid();
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
								<label for="Date">Date</label>
							</td>
							<td>
								<div class="form-group">
									<input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>" class="form-control">
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="Date">Kasir</label>
							</td>
							<td>
								<div class="form-group">
									<input type="text" name="" id="" value="" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="Date">Customers</label>

							</td>
							<td>
								<div class="form-group">
									<select name="customers_id" id="customers_id" class="form-control select2" style="width: 100%;">
										<option value="">-- Pilih --</option>
										<?php foreach ($customers as $key => $data) { ?>
											<option value="<?= $data->customers_id ?>"><?= $data->name_customers . ' - ' . $data->pt_customers ?></option>
										<?php } ?>
									</select>
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
								<label for="Date">ID Items</label>
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
						<h4>Invoice <b><span id="invoice"><?= $invoice ?></span></b></h4>
						<h1><b><span id="grand_total2" style="font-size: 50pt;">0</span></b></h1>
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
						<h1><b><span id="grand_total_dp" style="font-size: 50pt;">0</span></b></h1>
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
									<input type="number" name="down_payment" id="down_payment" min="0" class="form-control" placeholder="Down Payment">
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width: 29%">
								<label for="cash">Cash</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" id="cash" min="0" class="form-control" placeholder="Cash">
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

			$('#cart_table tr').each(function() {
				subtotal += parseInt($(this).find('#total').text())
			})

			isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

			var grand_total2 = subtotal

			if (isNaN(grand_total2)) {
				$('#grand_total2').text(0)
			} else {
				$('#grand_total2').text(grand_total2)
			}

			var down_payment = $('#down_payment').val()
			var grand_total = subtotal - down_payment

			if (isNaN(grand_total)) {
				$('#grand_total').val(0)
				$('#grand_total_dp').text(0)
			} else {
				$('#grand_total').val(grand_total)
				$('#grand_total_dp').text(grand_total)
			}


			var cash = $('#cash').val();
			cash != 0 ? $('#change').val(cash - down_payment) : $('#change').val(0);

		}

		$(document).on('keyup mouseup', '#down_payment, #cash', function() {
			calculate();
		})

		$(document).ready(function() {
			calculate()
		})

		// Proses payment
		$(document).on('click', '#process_payment', function() {
			var customers_id = $('#customers_id').val()
			var subtotal = $('#sub_total').val()
			var down_payment = $('#down_payment').val()
			var down_payment_id = $('#down_payment_id').val()
			var grandtotal = $('#grand_total').val()
			var cash = $('#cash').val()
			var change = $('#change').val()
			var status = $('#status').val()
			var date = $('#date').val()

			if (subtotal < 1) {
				swal("Error!", "Belum Ada Product Item Yang Dipilih!", "error");
			} else if (cash < 1) {
				swal("Error!", "Jumlah Uang Cash Belum Diinput!", "error");
				$('#cash').focus();
			} else if (customers_id == '') {
				swal("Error!", "Data Customers Belum Diinput!", "error");
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
							'date': date
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
		// $("#key_dp_hide").hide();
		// $("#down_payment_hide").hide();

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
