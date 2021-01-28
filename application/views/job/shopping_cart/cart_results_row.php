<?php
//Declare variables
$worksheet_category_idn = $product_row['WorksheetCategory_Idn'];
$product_idn = $product_row['Product_Idn'];
$id = $worksheet_category_idn."-".$product_idn;

$title = "";
//$tooltip = "";
if (!empty($product_row['Description']))
{
    $title = ' title="'.quotes_to_entities($product_row['Description']).'"';
    //$tooltip = "tooltip";
}
//$filtered = ($column_types[$i] == 'name' && @$results['match'] == 1) ? '<span class="filtered"> *</span>' : '';
$filtered = "";

//Remove from array
unset($product_row['WorksheetCategory_Idn']);
unset($product_row['Description']);
$i = 0;
?>

<tr class="cart-results-row cart-results-row<?php echo $worksheet_category_idn; ?>" data-product_idn="<?php echo $product_idn; ?>">
    <?php for($i = 0; $i < sizeof($columns['names']); $i++): ?>
        <?php $column_value = $product_row[$columns['names'][$i]]; ?>

        <td width="<?php echo $columns['widths'][$i]; ?>%"><?php //print_r($columns); ?>

        <?php 
            switch($columns['names'][$i]):
            case "Product_Idn": 
                //Check checkbox if quantity is greater than zero
                $checked = "";
                if (isset($product_row['Quantity']) && $product_row['Quantity'] != NULL 
                    || ($product_row['IsAssembly'] == 1 && $worksheet_category_idn != 106)
                    || ($worksheet_category_idn == 106 && $product_row['TrimPackageFlag'] != 1)) 
                {
                    $checked = 'checked="checked"';
                } 
                ?>
                <span class="span-center">
                    <input type="checkbox" class="results-product<?php echo $worksheet_category_idn; ?>" id="Product<?php echo $id; ?>" name="Products[<?php echo $product_idn; ?>]" value="<?php echo $product_idn; ?>" <?php echo $checked; ?> />
                </span>

                <?php
                break;
            case 'PipeLength': 
                $quantity = 1;
                //If product is pipe, set class to results_assembly_pipe
                $assembly_pipe = ($worksheet_category_idn == 89) ? "results-assembly-pipe" : "";
                ?>
   			    <input type="text" class="results-assembly-qty original check_num1 input-xs <?php echo $assembly_pipe; ?>" id="Quantity<?php echo $id; ?>" name="Quantities[<?php echo $product_idn; ?>]" title="Quantity" value="<?php echo number_format($column_value, 1); ?>" />
                <input type="hidden" id="OriginalQuantity<?php echo $id; ?>" name="OriginalQuantities[<?php echo $product_idn; ?>]" value="<?php echo number_format($column_value, 1); ?>" />
			    <?php
			    break;
            case 'Quantity': ?>
                <span class="span-center">
  			        <input type="text" class="results-qty arrow-qty-<?php echo $worksheet_category_idn; ?> original check_num1 input-xs" id="Quantity<?php echo $id; ?>" name="Quantities[<?php echo $product_idn; ?>]" title="Quantity" value="<?php echo number_format($column_value, 1); ?>" data-originalamount="<?php echo number_format($column_value, 1); ?>" />
                    <input type="hidden" id="OriginalQuantity<?php echo $id; ?>" name="OriginalQuantities[<?php echo $product_idn; ?>]" value="<?php echo number_format($column_value, 1); ?>" />
                </span>
                <?php
                break;
		    case 'MaterialUnitPrice': ?>
			    <span id="MaterialUnitPrice<?php echo $id; ?>" class="results-material span-right"><?php echo number_format($column_value,2); ?></span>
                <input type="hidden" name="MaterialUnitPrice[<?php echo $id; ?>]" value="<?php echo $column_value; ?>" />
			    <?php
			    break;
            case 'FieldUnitPrice': 
                $num_decimals = ($product_row['WorksheetMaster_Idn'] == 2) ? 3 : 2;
                ?>
			    <span id="FieldUnitPrice<?php echo $id; ?>" class="results-field span-right"><?php echo number_format($column_value,$num_decimals); ?></span>
                <input type="hidden" name="FieldUnitPrice[<?php echo $id; ?>]" value="<?php echo $column_value; ?>" />
			    <?php
			    break;
		    case "ShopUnitPrice": ?>
			    <span id="ShopUnitPrice<?php echo $id; ?>" class="results-shop span-right"><?php echo number_format($column_value,2); ?></span>
                <input type="hidden" name="ShopUnitPrice[<?php echo $id; ?>]" value="<?php echo $column_value; ?>" />
			    <?php
			    break;
		    case "DesignUnitPrice": ?>
			    <span id="DesignUnitPrice<?php echo $id; ?>" class="results-design span-right"><?php echo number_format($column_value,2); ?></span>
                <input type="hidden" name="DesignUnitPrice[<?php echo $id; ?>]" value="<?php echo $column_value; ?>" />
			    <?php
			    break;
		    case "Name": ?>
			    <span class="cart-results-name"<?php echo $title; ?>><?php echo (empty($column_value)) ? "-" : quotes_to_entities($column_value).$filtered; ?></span>
			    <?php
			    break;
            case "Type": 
            case "Grade":
            case "Domestic":
            case "FittingType":
            case "SubType":
            case "PipeTypeName":
            case "Size":
            case "CoverageType":
            case "FinishType":
            case "HeadType":
                if ($columns['names'][$i] == "Domestic")
                {
                    $column_value = ($column_value == 1) ? "Y" : "N";
                }
                ?>
                <span class="<?php echo strtolower($columns['names'][$i]); ?>" id="<?php echo $columns['names'][$i].$id; ?>"><?php echo $column_value; ?></span>
                <?php
                break;
            /* default:?>
                <span class="<?php echo strtolower($column_name); ?>" id="<?php echo $column_name.$product_idn; ?>"><?php echo (empty($column_value)) ? "-" : $column_value; ?></span>
                <?php
                break;
                */
        endswitch; ?>
        </td>
    <?php endfor; ?>
</tr>
