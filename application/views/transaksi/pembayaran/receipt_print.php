<html moznomarginboxes mozdisallowselctionprint>

<head>
	<title>My Pos - Print Nota</title>
	<style type="text/css">
		html {
			font-family: "Verdana, Arial";
		}

		.content {
			width: 80mm;
			font-size: 12px;
			padding: 5px;
		}

		.title {
			text-align: center;
			font-size: 13px;
			padding-bottom: 5px;
			border-bottom: 1px dashed;
		}

		.head {
			margin-top: 5px;
			margin-bottom: 10px;
			padding-bottom: 10px;
			border-bottom: 1px solid;
		}

		table {
			width: 100%;
			font-size: 12px;
		}

		.thanks {
			margin-top: 10px;
			padding-top: 10px;
			text-align: center;
			border-top: 1px dashed;
		}

		@media print {
			@page {
				width: 80mm;
				margin: 0mm;
			}
		}
	</style>
</head>

<body onload="window.print()">
	<div class="content">
		<div class="title">
			<b>@danina.official</b>
			<br>
			Jl. Swadaya RT.03/04 No.08
		</div>

		<div class="head">
			<table cellspacing="0" cellpading="0">
				<tr>
					<td style="width: 200px;">
						<?= Date("d/m/Y", strtotime($sales->date)) . " " . Date("H:i", strtotime($sales->sales_created)) ?>
					</td>
					<td>Cashier</td>
					<td style="text-align: center; width: 10px;">:</td>
					<td style="text-align: right;">
						<?= $sales->level == 1 ? 'Admin' : 'Member' ?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $sales->invoice ?>
					</td>
					<td>
						Customers
					</td>
					<td style="text-align: center;">:</td>
					<td style="text-align: right;">
						<?= $sales->customers_sales ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="transaction">
			<table class="transaction-table" cellspacing="0" cellpadding="0">
				<?php
				$arr_discount = array();
				foreach ($sales_detail as $key => $data) { ?>
					<tr>
						<td style="width: 165px;"><?= $data->item_name ?></td>
						<td><?= $data->qty ?></td>
						<td style="text-align: right; width: 60px;"><?= indo_currency($data->price) ?></td>
						<td style="text-align: right; width: 60px;"><?= indo_currency(($data->price - $data->discount_item) * $data->qty) ?></td>
					</tr>

					<?php
					if ($data->discount_item > 0) {
						$arr_discount[] = $data->discount_item;
					}
				}

				foreach ($arr_discount as $key => $value) { ?>
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right;">Disc. <?= ($key + 1) ?></td>
						<td style="text-align: right;"><?= indo_currency($value); ?></td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="4" style="border-bottom: 1px dashed; padding-top: 5px; width: 20%;"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: right; padding-top: 5px;">Sub Total</td>
					<td style="text-align: right; padding-top: 5px;">
						<?= indo_currency($sales->total_price) ?>
					</td>
				</tr>
				<?php if ($sales->discount > 0) { ?>
					<tr>
						<td colspan=" 2"></td>
						<td style="text-align: right; padding-bottom: 5px;">Disc. Sale</td>
						<td style="text-align: right; padding-bottom: 5px;"><?= indo_currency($sales->discount) ?></td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: right; padding-bottom: 5px;">Grand Total</td>
					<td style="text-align: right; padding-bottom: 5px;">
						<?= indo_currency($sales->final_price) ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: right; padding-bottom: 5px;">Cash</td>
					<td style="text-align: right; padding-bottom: 5px;">
						<?= indo_currency($sales->cash)  ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: right; padding-bottom: 5px;">Change</td>
					<td style="text-align: right; padding-bottom: 5px;">
						<?= indo_currency($sales->remaining) ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="thanks">
			&nbsp; ~~~ Thank You ~~~
			<br>
			@danina.official
		</div>
	</div>
</body>

</html>
