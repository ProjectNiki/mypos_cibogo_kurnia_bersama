<section class="content-header">
	<h1>Add Oprasional <small>Oprasional</small></h1>
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
				Oprasional
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
			<h4>Add Oprasional
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
						<div class="input-group">
							<input type="text" id="items_key" name="items_key" value="" class="form-control" readonly>
							<input type="hidden" id="items_id" name="items_id" class="form-control" readonly>
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
						<br>
						<label for="name_items">Fee <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
							<input type="text" id="name_items" name="name_items" class="form-control" value="" placeholder="Fee">
						</div>
						<br>
						<!--  -->
						<label for="qty_items">Oprasional <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" id="qty_items" name="qty_items" class="form-control" placeholder="Oprasional" value="">
						</div>
						<br>
						<!--  -->
						<label for="qty_stock_in">Pajak/tax <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" id="qty_stock_in" name="qty_stock_in" class="form-control" placeholder="Pajak/tax" value="" autocomplete="off">
						</div>
						<br>
						<label for="qty_stock_in">Ls/Lab <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" id="qty_stock_in" name="qty_stock_in" class="form-control" placeholder="Ls/Lab" value="" autocomplete="off">
						</div>
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Items</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="datatable">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">No Invoice</th>
							<th class="text-center">Customers </th>
							<th class="text-center">Nama PT </th>
							<th class="text-center">Tgl Pembelian</th>
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

<script>
	$(document).ready(function() {
		$(document).on('click', '#select', function() {

			$('#items_key').val($(this).data('items_key'));
			$('#items_id').val($(this).data('items_id'));
			$('#name_items').val($(this).data('name_items'));
			$('#qty_items').val($(this).data('qty_items'));

			$('#exampleModal').modal('hide');
		});
	});
</script>
