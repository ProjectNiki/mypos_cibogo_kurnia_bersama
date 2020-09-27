<section class="content-header">
	<h1>Add Sub Kategori <small>Sub Kategori</small></h1>
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
			<a href="<?= site_url('sub_categories') ?>">Sub Kategori</a>
		</li>
		<li class="active">
			Add
		</li>
	</ol>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>
				Add Sub Kategori
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
						<div class="form-group">
							<label for="categories_id">Kategori <i class="text-danger">*</i></label>
							<select name="categories_id" id="categories_id" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<?php foreach ($row as $key => $data) { ?>
									<option value="<?= $data->categories_id ?>" <?= set_value('categories_id') == $data->categories_id ? "selected" : null ?>><?= $data->name_categories ?></option>
								<?php } ?>
							</select>
							<?= form_error('categories_id', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
						<label for="name_sub_categories">Sub Kategori <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_sub_categories') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-tasks" aria-hidden="true"></i></span>
							<input type="text" id="name_sub_categories" name="name_sub_categories" class="form-control" value="<?= set_value('name_sub_categories') ?>" placeholder="Sub Kategori" autofocus autocomplete="off">
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
