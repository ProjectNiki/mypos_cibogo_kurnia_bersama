<?php
date_default_timezone_set("Asia/Bangkok");
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
									<input type="hidden" id="price">
									<input type="hidden" id="stock">
									<input type="hidden" id="item_id">
									<input type="text" id="item_name" class="form-control" autofocus readonly>
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
								<label for="Date">Qty</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" name="qty" id="qty" value="1" min="1" class="form-control">
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
						<h4>Invoice <b><span id="invoice"></span></b></h4>
						<h1><b><span id="grand_total2" style="font-size: 50pt;">0</span></b></h1>
					</div>
					<small style="color: red;">* Grand Total </small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="box box-widget">
				<div class="box-body">
					<div class="text-right">
						<h4>DP <b><span id="dp"></span></b></h4>
						<h1><b><span id="grand_total2" style="font-size: 50pt;">0</span></b></h1>
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
								<th class="text-center">Price</th>
								<th class="text-center">Qty</th>
								<th class="text-center">Discount Item</th>
								<th class="text-center" style="width: 10%;">Total</th>
								<th class="text-center" style="width: 15%;">Action</th>
							</tr>
						</thead>
						<tbody id="cart_table">
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
							<td style="vertical-align: top; width: 30%">
								<label for="sub_total">Sub Total</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" name="sub_total" id="sub_total" value="" class="form-control" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="discount">Discount</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" name="discount" id="discount" min="0" class="form-control" placeholder="Discount">
								</div>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;">
								<label for="grand_total">Grand Total</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" name="grand_total" id="grand_total" class="form-control" readonly>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!--  -->
		<div class="col-md-3">
			<div class="box">
				<div class="box-body">
					<table style="width: 100%;">
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
						<tr>
							<td style="vertical-align: top; width: 29%">
								<label for="change">Change</label>
							</td>
							<td>
								<div class="form-group">
									<input type="number" id="change" value="0" min="0" class="form-control" readonly>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!--  -->
		<div class="col-md-3">
			<div class="box">
				<div class="box-body">
					<table style="width: 100%;">
						<tr>
							<td style="vertical-align: top; width: 29%">
								<label for="note">Status Pembayaran</label>
							</td>
							<td>
								<div class="form-group">
									<select name="note" id="note" class="form-control select2">
										<option value="">-- Pilih --</option>
										<option value="1">Lunas</option>
										<option value="0">Belum Lunas</option>
									</select>
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
							<th class="text-center">Nama Items</th>
							<th class="text-center">Price (Rp)</th>
							<th class="text-center">Stock</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal  Edit Product -->
<div class="modal fade" id="modal-item-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Update Product Items</h4>
			</div>
			<div class="modal-body table-responsive">
				<input type="hidden" id="cartid_item">
				<div class="form-group">
					<label for="product_item">Product Item</label>
					<input type="text" name="product_item" id="product_item" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="price_item">Price</label>
					<input type="number" name="price_item" id="price_item" min="0" class="form-control">
				</div>
				<div class="form-group">
					<label for="qty_item">Qty</label>
					<input type="number" name="qty_item" id="qty_item" min="1" class="form-control">
				</div>
				<div class="form-group">
					<label for="total_before">Total Before Discount</label>
					<input type="number" name="total_before" id="total_before" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="discount_item">Discount Per Item</label>
					<input type="number" name="discount_item" id="discount_item" min="0" class="form-control">
				</div>
				<div class="form-group">
					<label for="total_item">Total After Discount</label>
					<input type="number" name="total_item" id="total_item" min="0" class="form-control" readonly>
				</div>
			</div>
			<div class="modal-footer">
				<div class="pull-right">
					<button type="button" id="edit_cart" class="btn btn-success">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
