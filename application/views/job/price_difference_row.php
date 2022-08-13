<?php if ($p['NewWorksheet'] == 1): ?>
    <tr class="worksheet">
        <td colspan="10"><?php echo $p['WorksheetName']; ?></td>
    </tr>
<?php endif; ?>

<tr class="price-difference" data-assembly_idn="<?php echo $p['ProductAssembly_Idn']; ?>" data-worksheet_idn="<?php echo $p['Worksheet_Idn']; ?>" data-product_idn="<?php echo $p['Product_Idn']; ?>" data-miscellaneousdetail_idn="<?php echo $p['MiscellaneousDetail_Idn']; ?>">
	<td class="quantity">
		<?php echo number_format($p['Quantity'], 1); ?>
	</td>
	<td class="product-name">
		<?php echo $p['ProductName']." (".$p['Product_Idn'].")"; ?>
		<?php if ($p['IsRFPException']) echo ' <span class="em">RFP!</span>'; ?>
	</td>
	<td class="new-material-price price">
		<?php echo ($p['new_mup'] == 0) ? "-" : number_format($p['new_mup'], 2); ?>
	</td>
	<td class="old-material-price price">
		<?php echo ($p['old_mup'] == 0) ? "-" : number_format($p['old_mup'], 2); ?>
	</td>
	<td class="new-field-price price">
		<?php echo ($p['new_fup'] == 0) ? "-" : number_format($p['new_fup'], 2); ?>
	</td>
	<td class="old-field-price price">
		<?php echo ($p['old_fup'] == 0) ? "-" : number_format($p['old_fup'], 2); ?>
	</td>
	<td class="new-shop-price price">
		<?php echo ($p['new_sup'] == 0) ? "-" : number_format($p['new_sup'], 2); ?>
	</td>
	<td class="old-shop-price price">
		<?php echo ($p['old_sup'] == 0) ? "-" : number_format($p['old_sup'], 2); ?>
	</td>
	<td class="new-eng-price price">
		<?php echo ($p['new_eup'] == 0) ? "-" : number_format($p['new_eup'], 2); ?>
	</td>
	<td class="old-eng-price price">
		<?php echo ($p['old_eup'] == 0) ? "-" : number_format($p['old_eup'], 2); ?>
	</td>
</tr>
