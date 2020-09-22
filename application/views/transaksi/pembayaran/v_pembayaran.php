<section class="content-header">
	<h1>Data Pembayaran <small>Pembayaran</small></h1>
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
			Pembayaran
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>Data Pembayaran
				<div class="pull-right">
					<a href="<?= site_url('pembayaran/add') ?>" class="btn btn-primary">
						<i class="fa fa-plus"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">No Invoice</th>
						<th class="text-center">Nama Customers</th>
						<th class="text-center">PT. Customers</th>
						<th class="text-center">Tgl Pembelian</th>
						<th class="text-center">A/N</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td class="text-center"></td>
						<td></td>
						<td></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center">
							<a href="" class="btn btn-success">
								<i class="fa fa-plus"></i>
							</a>
							<a href="" class="btn btn-default">
								<i class="fa fa-eye"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
