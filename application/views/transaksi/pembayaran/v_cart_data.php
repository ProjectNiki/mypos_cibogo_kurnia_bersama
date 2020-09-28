<?php $no = 1;  ?>
<?php if ($cart->num_rows() > 0) { ?>
	<?php foreach ($cart->result() as $c => $data) { ?>
		<tr>
			<td class="text-center"><?= $no++ ?></td>
			<td><?= $data->name_items ?></td>
			<td><?= indo_currency($data->cart_price)  ?></td>
			<td class="text-center"><?= $data->qty ?></td>
			<td id="total" style="display:none;"><?= $data->total ?></td>
			<td><?= indo_currency($data->total) ?></td>
			<td class="text-center">
				<button data-cartid="<?= $data->cart_id ?>" class="btn btn-danger" id="del_cart">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
	<?php } ?>
<?php } else { ?>
	<td colspan="8" class="text-center">Tidak ada data di table cart!</td>
<?php } ?>
