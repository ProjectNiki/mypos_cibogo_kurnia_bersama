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
							<input type="text" id="invoice" name="invoice" value="" class="form-control" readonly>
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
						<br>
						<label for="fee">Fee <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
							<input type="text" id="fee" name="fee" class="form-control" value="" placeholder="Fee">
						</div>
						<br>
						<!--  -->
						<label for="oprasional">Oprasional <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" id="oprasional" name="oprasional" class="form-control" placeholder="Oprasional" value="">
						</div>
						<br>
						<!--  -->
						<label for="pajak_tax">Pajak/tax <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" id="pajak_tax" name="pajak_tax" class="form-control" placeholder="Pajak/tax" value="" autocomplete="off">
						</div>
						<br>
						<label for="lab">Ls/Lab <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" id="lab" name="lab" class="form-control" placeholder="Ls/Lab" value="" autocomplete="off">
						</div>
						<br>
						<label for="jasa perushaan">Jasa Perusahaan <i class="text-danger">*</i></label>
						<div class="input-group ">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="number" id="jasa perushaan" name="jasa perushaan" class="form-control" placeholder="Jasa Perusahaan" value="" autocomplete="off">
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
							<th class="text-center">Customer </th>
							<th class="text-center">Perusahaan </th>
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
