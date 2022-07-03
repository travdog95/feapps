<tr class="search-results-row" data-product-idn="<?php echo $search_result['Product_Idn']; ?>">
    <td class="text-center"><input type="checkbox" name="Child_Idn" value="<?php echo $search_result['Product_Idn']; ?>" data-search-results-checkbox /></td>
    <td><?php echo $search_result['Product_Idn']; ?></td>
    <td><?php echo $search_result['Name']; ?></td>
    <td><?php echo $search_result['Department']; ?></td>
    <td><?php echo $search_result['WorksheetMaster']; ?></td>
    <td><?php echo $search_result['WorksheetCategory']; ?></td>
    <td><?php echo $search_result['Manufacturer']; ?></td>
    <td data-material-unit-price="<?php echo $search_result['MaterialUnitPrice']; ?>"><?php echo number_format($search_result['MaterialUnitPrice'], 2); ?></td>
    <td data-field-unit-price="<?php echo $search_result['FieldUnitPrice']; ?>"><?php echo number_format($search_result['FieldUnitPrice'], 2); ?></td>
</tr>
