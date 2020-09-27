<section class="content-header">
	<h1>Add Kategori <small>Kategori</small></h1>
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
			<a href="<?= site_url('categories') ?>">Kategori</a>
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
				Add Kategori
				<div class="pull-right">
					<a href="<?= site_url('categories') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="" method="POST">
						<label for="name_categories">Kategori <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_categories') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-server" aria-hidden="true"></i></span>
							<input type="text" id="name_categories" name="name_categories" class="form-control" value="<?= set_value('name_categories') ?>" placeholder="Kategori" autofocus autocomplete="off">
						</div>
						<?= form_error('name_categories', '<div class="text-danger">', '</div>'); ?>
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
