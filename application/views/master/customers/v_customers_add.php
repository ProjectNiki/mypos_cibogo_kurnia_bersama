<section class="content-header">
	<h1>Add Customer <small>Customer</small></h1>
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
			<a href="<?= site_url('Customers') ?>">Customer</a>
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
				Add Customer
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
						<label for="">ID Customer <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" name="customers_key" id="customers_key" class="form-control" placeholder="ID Customers" value="C_<?= sprintf("%04s", $row) ?>" readonly>
						</div>
						<?= form_error('customers_key', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<div class="row">
							<div class="col-md-10">
								<label for="pt_customers">Perusahaan <i class="text-danger">*</i></label>
								<div class="input-group <?= form_error('pt_customers') == TRUE ? 'has-error' : null ?>">
									<span class="input-group-addon"><i class="fa fa-building"></i></span>
									<input type="text" name="pt_customers" id="pt_customers" class="form-control" placeholder="Perusahaan" value="<?= set_value('pt_customers') ?>" autocomplete="off" autofocus="true">
								</div>
								<?= form_error('pt_customers', '<div class="text-danger">', '</div>'); ?>
							</div>
							<div class="col-md-2">
								<label for="inisial_pt">Inisial <i class="text-danger">*</i></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
									<input type="text" name="inisial_pt" id="inisial_pt" class="form-control" placeholder="Inisial" value="<?= set_value('inisial_pt') ?>" autocomplete="off" autofocus="true" maxlength="2" required>
								</div>
							</div>
						</div>
						<!--  -->
						<br>
						<label for="name_customers">Customer <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="name_customers" id="name_customers" class="form-control" placeholder="Customers" value="<?= set_value('name_customers') ?>" autocomplete="off">
						</div>
						<?= form_error('name_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<div class="form-group <?= form_error('gander_customers') == TRUE ? 'has-error' : null ?>">
							<label for="gander_customers">Gander <i class="text-danger">*</i></label>
							<select name="gander_customers" id="gander_customers" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<option value="1" <?= set_value('gander_customers') == 1 ? 'selectd' : null ?>>Laki-Laki</option>
								<option value="2" <?= set_value('gander_customers') == 2 ? 'selectd' : null ?>>Perempuan</option>
							</select>
							<?= form_error('gander_customers', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
						<label for="phone_customers">Phone <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('phone_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="phone_customers" id="phone_customers" value="<?= set_value('phone_customers') ?>" class="form-control" placeholder="Phone" autocomplete="off">
						</div>
						<?= form_error('phone_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="email_customers">E-Mail <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('email_customers') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" id="email_customers" name="email_customers" class="form-control" value="<?= set_value('email_customers') ?>" placeholder="E-Mail" autocomplete="off">
						</div>
						<?= form_error('email_customers', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<div class="form-group <?= form_error('address_customers') == TRUE ? 'has-error' : null ?>">
							<label for="address_customers">Alamat <i class="text-danger">*</i></label>
							<textarea name="address_customers" id="address_customers" rows="4" class="form-control" placeholder="Alamat Customers" autocomplete="off"><?= set_value('address_customers') ?></textarea>
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
