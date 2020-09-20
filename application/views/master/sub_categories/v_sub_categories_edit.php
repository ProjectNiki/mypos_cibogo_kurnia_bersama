<section class="content-header">
	<h1>Edit Sub Categories <small>Sub Categories</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Master
		</li>
		<li>
			<a href="<?= site_url('sub_categories') ?>">Sub Categories</a>
		</li>
		<li class="active">
			Edit
		</li>
	</ol>
</section>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4>
				Edit Sub Categories
				<div class="pull-right">
					<a href="<?= site_url('sub_categories') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="" method="POST">
						<input type="hidden" name="sub_categories_id" value="<?= $row->sub_categories_id ?>">
						<div class="form-group">
							<label for="categories_id">Nama Categories <i class="text-danger">*</i></label>
							<select name="categories_id" id="categories_id" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<?php $level = $this->input->post('categories_id') ?? $row->categories_id ?>
								<?php foreach ($categories as $key => $data) { ?>
									<option value="<?= $data->categories_id ?>" <?= $data->categories_id == $level ? 'selected' : null ?>><?= $data->name_categories ?></option>
								<?php } ?>
							</select>
							<?= form_error('categories_id', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
						<label for="name_sub_categories">Nama Sub Categories <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_sub_categories') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-tasks" aria-hidden="true"></i></span>
							<input type="text" id="name_sub_categories" name="name_sub_categories" class="form-control" value="<?= $this->input->post('name_sub_categories') ?? $row->name_sub_categories ?>" placeholder="Nama Sub Categories" autocomplete="off">
						</div>
						<?= form_error('name_sub_categories', '<div class="text-danger">', '</div>'); ?>
						<br>
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
