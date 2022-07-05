<tr class="child-row" data-child-row="<?php echo $child['Product_Idn']; ?>">
    <td class="text-center">
        <input type="checkbox" name="Child_Idn" data-child-checkbox value="<?php echo $child['Product_Idn']; ?>" />
    </td>
    <td><?php echo $child['Product_Idn']; ?></td>
    <td><?php echo $child['Name']; ?></td>
    <td><?php echo $child['Department']; ?></td>
    <td><?php echo $child['WorksheetMaster']; ?></td>
    <td><?php echo $child['WorksheetCategory']; ?></td>
    <td><?php echo $child['Manufacturer']; ?></td>
    <td data-material-unit-price="<?php echo $child['MaterialUnitPrice']; ?>"><?php echo number_format($child['MaterialUnitPrice'], 2); ?></td>
    <td data-field-unit-price="<?php echo $child['FieldUnitPrice']; ?>"><?php echo number_format($child['FieldUnitPrice'], 2); ?></td>
</tr>
