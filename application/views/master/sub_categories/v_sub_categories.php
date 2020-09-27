<section class="content-header">
	<h1>Data Sub Kategori <small>Sub Kategori</small></h1>
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
			Sub Kategori
		</li>
	</ol>
</section>

<section class="content">
	<?= $this->session->flashdata('message'); ?>
	<div class="box">
		<div class="box-header">
			<h4>Data Sub Kategori
				<div class="pull-right">
					<a href="<?= site_url('sub_categories/add') ?>" class="btn btn-primary">
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
						<th class="text-center">Kategori</th>
						<th class="text-center">Sub Kategori</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($row as $key => $row) { ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $row->name_categories ?></td>
							<td><?= $row->name_sub_categories ?></td>
							<td class="text-center">
								<a href="<?= site_url('sub_categories/edit/' . $row->sub_categories_id) ?>" class="btn btn-success">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?= site_url('sub_categories/del/' . $row->sub_categories_id) ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin ? Data <?= $row->name_sub_categories ?> akan dihapus secara permanen')">
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
