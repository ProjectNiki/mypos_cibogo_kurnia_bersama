<section class="content-header">
    <h1>Edit Biaya Pengurusan <small>Biaya Pengurusan</small></h1>
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
                Biaya Pengurusan
            </a>
        </li>
        <li class="active">
            Edit
        </li>
    </ol>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header">
            <h4>Edit Biaya Pengurusan
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
                        <input type="hidden" name="bpd_id" id="bpd_id" class="form-control" value="<?= $row->bpd_id ?>" readonly>
                        <div class="form-group">
                            <label for="">ID Biaya Pengurusan <i class="text-danger">*</i></label>
                            <input type="text" name="bp_key" id="bp_key" class="form-control" value="<?= $row->bp_key ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pt_customers">Perusahaan <i class="text-danger">*</i></label>
                            <div class="input-group <?= form_error('pt_customers') == TRUE ? 'has-error' : null ?>">
                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                <input type="text" name="pt_customers" id="pt_customers" class="form-control" placeholder="Perusahaan" value="<?= $row->pt_customers ?>" autocomplete="off" readonly>
                            </div>
                            <?= form_error('pt_customers', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <label for="fee">Fee <i class="text-danger">*</i></label>
                        <div class="input-group <?= form_error('fee_oprasional') == TRUE ? 'has-error' : null ?>">
                            <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                            <input type="text" onkeyup="splitInDots(this)" id="fee_oprasional" name="fee_oprasional" class="form-control" placeholder="Fee" value="<?= $this->input->post('fee_oprasional') ?? indo_qty($row->fee_oprasional) ?>" autocomplete="off">
                        </div>
                        <?= form_error('fee_oprasional', '<div class="text-danger">', '</div>'); ?>
                        <br>
                        <!--  -->
                        <label for="oprasional">Oprasional <i class="text-danger">*</i></label>
                        <div class="input-group <?= form_error('oprasional') == TRUE ? 'has-error' : null ?>">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" onkeyup="splitInDots(this)" id="oprasional" name="oprasional" class="form-control" placeholder="Oprasional" value="<?= $this->input->post('oprasional') ?? indo_qty($row->oprasional) ?>" autocomplete="off">
                        </div>
                        <?= form_error('oprasional', '<div class="text-danger">', '</div>'); ?>
                        <br>
                        <!--  -->
                        <label for="pajak_tax">Pajak/tax <i class="text-danger">*</i></label>
                        <div class="input-group <?= form_error('pajak_tax') == TRUE ? 'has-error' : null ?>">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" onkeyup="splitInDots(this)" id="pajak_tax" name="pajak_tax" class="form-control" placeholder="Pajak/tax" value="<?= $this->input->post('pajak_tax') ?? indo_qty($row->pajak_tax) ?>" autocomplete="off">
                        </div>
                        <?= form_error('pajak_tax', '<div class="text-danger">', '</div>'); ?>
                        <br>
                        <label for="lab">Ls/Lab <i class="text-danger">*</i></label>
                        <div class="input-group <?= form_error('lab') == TRUE ? 'has-error' : null ?>">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" onkeyup="splitInDots(this)" id="lab" name="lab" class="form-control" placeholder="Ls/Lab" value="<?= $this->input->post('lab') ?? indo_qty($row->lab) ?>" autocomplete="off">
                        </div>
                        <?= form_error('lab', '<div class="text-danger">', '</div>'); ?>
                        <br>
                        <label for="jasa_perushaan">Jasa Perusahaan <i class="text-danger">*</i></label>
                        <div class="input-group <?= form_error('jasa_perushaan') == TRUE ? 'has-error' : null ?>">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" onkeyup="splitInDots(this)" id="jasa_perushaan" name="jasa_perushaan" class="form-control" placeholder="Jasa Perusahaan" value="<?= $this->input->post('jasa_perushaan') ?? indo_qty($row->jasa_perushaan) ?>" autocomplete="off">
                        </div>
                        <?= form_error('jasa_perushaan', '<div class="text-danger">', '</div>'); ?>
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
                            <th class="text-center">ID Biaya Pengurusan</th>
                            <th class="text-center">Prushaan (Rp)</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($existing as $key => $data) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $data->bp_key ?></td>
                                <td><?= $data->pt_customers ?></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" id="select" data-bp_key="<?= $data->bp_key ?>" data-pt_customers="<?= $data->pt_customers ?>">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {

            $('#bp_key').val($(this).data('bp_key'));
            $('#pt_customers').val($(this).data('pt_customers'));

            $('#exampleModal').modal('hide');
        });
    });
</script>



<script type="text/javascript">
    function reverseNumber(input) {
        return [].map.call(input, function(x) {
            return x;
        }).reverse().join('');
    }

    function plainNumber(number) {
        return number.split('.').join('');
    }

    function splitInDots(input) {
        var value = input.value,
            plain = plainNumber(value),
            reversed = reverseNumber(plain),
            reversedWithDots = reversed.match(/.{1,3}/g).join('.'),
            normal = reverseNumber(reversedWithDots);
        input.value = normal;
    }
</script>