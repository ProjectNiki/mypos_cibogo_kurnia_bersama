<section class="content-header">
	<h1>Edit Customers <small>Customers</small></h1>
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
			<a href="<?= site_url('Customers') ?>">Customers</a>
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
				Edit Customers
				<div class="pull-right">
					<a href="<?= site_url('customers') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="" method="POST">
						<label for="">ID Customers <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" name="customers_key" id="customers_key" class="form-control" placeholder="ID Customers" value="<?= $row->customers_key ?>" readonly>
						</div>
						<?= form_error('customers_key', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="pt_customers">Nama PT <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('pt_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-building"></i></span>
							<input type="text" name="pt_customers" id="pt_customers" class="form-control" placeholder="Nama PT" value="<?= $this->input->post('pt_customers') ?? $row->pt_customers ?>" autocomplete="off">
						</div>
						<?= form_error('pt_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="name_customers">Nama Customers <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="name_customers" id="name_customers" class="form-control" placeholder="Nama Customers" value="<?= $row->name_customers ?>" autocomplete="off">
						</div>
						<?= form_error('name_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<div class="form-group <?= form_error('gander_customers') == TRUE ? 'has-error' : null ?>">
							<label for="gander_customers">Jenis Kelamin <i class="text-danger">*</i></label>
							<select name="gander_customers" id="gander_customers" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<option value="1" <?= $row->gander_customers == 1 ? 'selected' : null ?>>Laki-Laki</option>
								<option value="2" <?= $row->gander_customers == 2 ? 'selected' : null ?>>Perempuan</option>
							</select>
							<?= form_error('gander_customers', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
						<label for="phone_customers">Tlp <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('phone_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="phone_customers" id="phone_customers" value="<?= $row->phone_customers ?>" class="form-control" placeholder="No Tlp Customers" autocomplete="off">
						</div>
						<?= form_error('phone_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="email_customers">Email <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('email_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" id="email_customers" name="email_customers" class="form-control" value="<?= $row->email_customers ?>" placeholder="Email Customers" autocomplete="off">
						</div>
						<?= form_error('email_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<div class="form-group <?= form_error('address_customers') == TRUE ? 'has-error' : null ?>">
							<label for="address_customers">Alamat <i class="text-danger">*</i></label>
							<textarea name="address_customers" id="address_customers" rows="4" class="form-control" placeholder="Alamat Customers" autocomplete="off"><?= $row->address_customers ?></textarea>
							<?= form_error('address_customers', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
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
