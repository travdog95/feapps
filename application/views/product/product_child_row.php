<tr class="child-row" data-child-row="<?php echo $child['Product_Idn']; ?>">
    <td class="text-center">
        <input type="checkbox" name="deleteChild_Idn[]" data-child-checkbox="<?php echo $child['Product_Idn']; ?>" value="<?php echo $child['Product_Idn']; ?>" />
        <input type="hidden" name="Child_Idn[]" value="<?php echo $child['Product_Idn']; ?>" />
        <input type="hidden" class="childMaterialUnitPrice" name="MaterialUnitPrice[]" value="<?php echo $child['MaterialUnitPrice']; ?>" />
        <input type="hidden" class="childFieldUnitPrice" name="FieldUnitPrice[]" value="<?php echo $child['FieldUnitPrice']; ?>" />


    </td>
    <td><?php echo $child['Product_Idn']; ?></td>
    <td><?php echo $child['Name']; ?></td>
    <td><input type='text' class='check_num1 input-xs form-control childQuantity' name='Quantity[]' value='<?php echo number_format($child['Quantity'],1); ?>'/></td>
    <td><?php echo $child['Department']; ?></td>
    <td><?php echo $child['WorksheetMaster']; ?></td>
    <td><?php echo $child['WorksheetCategory']; ?></td>
    <td><?php echo $child['Manufacturer']; ?></td>
    <td data-material-unit-price="<?php echo $child['MaterialUnitPrice']; ?>"><?php echo number_format($child['MaterialUnitPrice'], 2); ?></td>
    <td data-field-unit-price="<?php echo $child['FieldUnitPrice']; ?>"><?php echo number_format($child['FieldUnitPrice'], 2); ?></td>
</tr>