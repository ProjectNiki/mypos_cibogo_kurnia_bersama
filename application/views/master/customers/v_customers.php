<section class="content-header">
	<h1>Data Customers <small>Customers</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Master
		</li>
		<li class="active">
			Customers
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box">
		<div class="box-header">
			<h4>Data Customers
				<div class="pull-right">
					<a href="<?= site_url('customers/add') ?>" class="btn btn-primary">
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
						<th class="text-center">ID Customers</th>
						<th class="text-center">Nama PT</th>
						<th class="text-center">Nama Customers</th>
						<th class="text-center">Jenis Kelamin</th>
						<th class="text-center">Tlp</th>
						<th class="text-center">Email</th>
						<th class="text-center">Alamat</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $row) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $row->customers_key ?></td>
							<td><?= $row->pt_customers ?></td>
							<td><?= $row->name_customers ?></td>
							<td class="text-center"><?= $row->gander_customers == 1 ? 'Laki-Laki' : 'Perempuan' ?></td>
							<td class="text-center"><?= $row->phone_customers ?></td>
							<td><?= $row->email_customers ?></td>
							<td><?= $row->address_customers ?></td>
							<td class="text-center">
								<a href="<?= site_url('customers/edit/' . $row->customers_id) ?>" class="btn btn-success">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?= site_url('customers/del/' . $row->customers_id) ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin ? Data <?= $row->name_customers ?> akan dihapus secara permanen')">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						<?php } ?>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
