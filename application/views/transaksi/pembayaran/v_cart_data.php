<?php $no = 1;  ?>
<?php if ($cart->num_rows() > 0) { ?>
    <?php foreach ($cart->result() as $c => $data) { ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= $data->item_name ?></td>
            <td><?= indo_currency($data->cart_price)  ?></td>
            <td class="text-center"><?= $data->qty ?></td>
            <td><?= indo_currency($data->discount_item) ?></td>
            <td id="total"><?= $data->total ?></td>
            <td class="text-center">
                <button id="update_cart" data-toggle="modal" data-target="#modal-item-edit" data-cartid="<?= $data->cart_id ?>" data-item_name="<?= $data->item_name ?>" data-price="<?= $data->price ?>" data-qty="<?= $data->qty ?>" data-discount_item="<?= $data->discount_item ?>" data-total="<?= $data->total ?>" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                </button>
                <button id="del_cart" data-cartid="<?= $data->cart_id ?>" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <td colspan="8" class="text-center">Tidak ada data di table cart!</td>
<?php } ?>