<?php
$exceptions = array(
    "primary_unit_price" => "MaterialUnitPrice",
    "original_primary_unit_price" => "OriginalMaterialUnitPrice",
    "class" => "material_unit_price"
);

$id = $Row['RowType']."_".$Row['Product_Idn'];

$row_classes = array("WorksheetCategory".$Row['WorksheetCategory_Idn']);

$product_name_classes = array();
if (isset($Row['AddedFromShoppingCart']) && $Row['AddedFromShoppingCart'] == 1)
{
    array_push($product_name_classes, "text-highlight");
}

if ($Row['ProductAssembly_Idn'] > 0)
{
    array_push($product_name_classes, "assembly");
}

if (isset($Row['IsParent']) && $Row['IsParent'] == 1)
{
    array_push($product_name_classes, "product-assembly");
}

if ($Row['IsHead'])
{
    array_push($row_classes, "head");
}

if ($Row['IsHead'] || $Row['ProductAssembly_Idn'] > 0 || $Row['IsMiscellaneousDetail'] == 1 || $Row['IsChildWorksheet'] == 1 || $Row['ApplyToAdjustmentFactorsFlag'] == 1)
{
    $apply_to_adjustment_factors_flag = 1;
}
else
{
    $apply_to_adjustment_factors_flag = 0;
}

$category_name = (isset($Row['CategoryName']) ? $Row['CategoryName'] : "");

if ($worksheet_master['WorksheetMaster_Idn'] == 7)
{
    $exceptions = array(
        "primary_unit_price" => "EngineerUnitPrice",
        "original_primary_unit_price" => "OriginalEngineerUnitPrice",
        "class" => "engineer_unit_price"
    );
}

//logic for EQ Brace product detail (IDN 2489)
$eq_brace_link = "";
if ($Row['Product_Idn'] == 2489)
{
    $eq_brace_link = '&nbsp;<span id="EQPopover" class="eq-brace text-highlight" rel="popover" data-title="EQ Brace Details">Show details</span>';
}
?>

<tr id="<?php echo $id; ?>" class="worksheet_line <?php echo implode(" ", $row_classes); ?>" data-Product_Idn="<?php echo $Row['Product_Idn']; ?>" data-IsMiscellaneousDetail="<?php echo $Row['IsMiscellaneousDetail']; ?>" data-ProductSize_Idn="<?php echo $Row['ProductSize_Idn']; ?>" data-ApplyToAdjustmentFactorsFlag="<?php echo $apply_to_adjustment_factors_flag; ?>" data-IsHead="<?php echo $Row['IsHead']; ?>" data-IsChildWorksheet="<?php echo $Row['IsChildWorksheet']; ?>" data-ProductAssembly_Idn="<?php echo $Row['ProductAssembly_Idn']; ?>" data-CategoryProductRank="<?php echo $Row['CategoryProductRank']; ?>">

	<td>
        <input type="hidden" name="Id[]" class="product_id" value="<?php echo $Row['Product_Idn']; ?>" />
        <input type="hidden" name="RowType[]" value="<?php echo $Row['RowType']; ?>" />
		<input type="checkbox" name="Delete[]" id="Delete<?php echo $id; ?>" class="delete" value="<?php echo $id; ?>" title="Delete Item" />
	</td>
	<td>
        <div class="input-group">
            <input type="text" name="Qty[<?php echo $id; ?>]" id="Qty<?php echo $id; ?>" class="check_num1 quantity calc-worksheet form-control input-xs monitor-change print-my-value text-center" value="<?php echo number_format($Row['Quantity'], 1); ?>" title="Quantity" data-recent-value="<?php echo $Row['Quantity']; ?>" />

            <?php if ($Row['WorksheetCategory_Idn'] == 89): ?>
                <span class="input-group-addon input-xs">ft.</span>
            <?php endif; ?>
        </div>
	</td>
	<td class="left-aligned product-name">
        <?php $Row['Name'] = (empty($Row['Name'])) ? "No Name" : $Row['Name']; ?>

        <?php if (empty($Row['Description'])):
            $name_title = ($Row['ProductAssembly_Idn'] > 0 || (isset($Row['IsParent']) && $Row['IsParent'] == 1)) ? "Details" : "Name";
			$title_attr = "data-title";
        else:
            //Strip out tabs, line and carriage returns
		    $name_title = str_replace(array("\n", "\t", "\r"), ' ', quotes_to_entities($Row['Description']));
			$title_attr = "title";
        endif; ?>

		<?php if ($Row['IsChildWorksheet'] == 1):
            $worksheet_idn = $Row['Product_Idn'];
            $product_name = '<a href="'.base_url().'job/worksheet/'.$worksheet_idn.'" class="worksheet" data-worksheet_idn="'.$worksheet_idn.'">'.quotes_to_entities($Row['Name']).'</a>';
			$copy_worksheet = '<button id="Copy'.$id.'" class="btn btn-default btn-xs copy-worksheet" data-worksheet_name="" data-worksheet_idn="'.$worksheet_idn.'" data-worksheet_master_idn="'.$Row['WorksheetMaster_Idn'].'" data-worksheet_area_idn="'.$Row['WorksheetArea_Idn'].'" data-worksheet_category_idn="'.$Row['WorksheetCategory_Idn'].'" title="Copy Worksheet" type="button">
                <span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span>
            </button>&nbsp;';
        else:
            $product_name = quotes_to_entities($Row['Name']);
            if ($Row['IsMiscellaneousDetail'] != 1) {
                $product_name .= ' <span class="show-product-idn">('.$Row['Product_Idn'].')</span>';
            }
			$copy_worksheet = "";
        endif;
		?>

        <?php 
        if (isset($Row['IsRFPException']) && $Row['IsRFPException'] == 1): 
            $product_name .= ' <span class="em">RFP!</span>';
        endif; 
        ?>
        <span id="Name<?php echo $id; ?>" class="name <?php echo implode(' ', $product_name_classes); ?>" <?php echo $title_attr; ?>="<?php echo $name_title; ?>"><?php echo $product_name; ?></span>
        <?php echo $eq_brace_link; ?>
        <span class="category-watermark hidden-print"><?php echo $category_name; ?></span>
	</td>

    <?php if ($worksheet_master['WorksheetMaster_Idn'] != 7): ?>
        <td>
            <?php if ($Row['IsMiscellaneousDetail'] == 1 || $Row['IsChildWorksheet'] == 1): ?>
                &nbsp;
            <?php else: ?>
                <span id="DomesticFlag<?php echo $id; ?>" class="domestic_flag"><?php echo ($Row['DomesticFlag'] == 1) ? "D" : "F"; ?></span>
            <?php endif; ?>
        </td>
    <?php endif; ?>
    
	<td>
        <?php if ($Row['IsChildWorksheet'] == 1): ?>
            $<span id="<?php echo $exceptions['primary_unit_price'].$id; ?>"><?php echo number_format($Row[$exceptions['primary_unit_price']], 2); ?></span>
        <?php else: ?>
			<div class="input-group">
                <span class="input-group-addon input-xs"><?php echo ($worksheet_master['WorksheetMaster_Idn'] == 7) ? "&lt;" : "$"; ?></span>

				<input type="text" name="<?php echo $exceptions['primary_unit_price']; ?>[<?php echo $id; ?>]" id="<?php echo $exceptions['primary_unit_price'].$id; ?>" class="<?php echo $exceptions['class']; ?> monitor-original monitor-change check_num2 calc-worksheet form-control input-xs print-my-value" value="<?php echo number_format($Row[$exceptions['primary_unit_price']], 2); ?>" data-original-value="<?php echo $Row[$exceptions['original_primary_unit_price']]; ?>" data-recent-value="<?php echo $Row[$exceptions['primary_unit_price']]; ?>" />

                <?php if ($worksheet_master['WorksheetMaster_Idn'] == 7): ?>
                    <span class="input-group-addon input-xs">&gt;</span>
                <?php endif; ?>
			</div>

        <?php endif; ?>
	</td>
	<td class="thick-border-right">
        <?php echo ($worksheet_master['WorksheetMaster_Idn'] == 7) ? "&lt;" : "$"; ?><span id="<?php echo $exceptions['primary_unit_price']; ?>Extended<?php echo $id; ?>" class="important-value"></span><?php echo ($worksheet_master['WorksheetMaster_Idn'] == 7) ? "&gt;" : ""; ?>
	</td>

    <?php if ($worksheet_master['WorksheetMaster_Idn'] != 7): ?>
        <td>
            <?php if ($Row['IsChildWorksheet'] == 1): ?>
                &lt;<span id="FieldUnitPrice<?php echo $id; ?>"><?php echo number_format($Row['FieldUnitPrice'], 2); ?></span>&gt;
            <?php else: ?>
                <?php $num_decimals = ($worksheet_master['WorksheetMaster_Idn'] == 2) ? 3 : 2; //Conduit and wire needs 3 decimal places ?>
            <div class="input-group">
                <span class="input-group-addon input-xs">&lt;</span>
                <input type="text" name="FieldUnitPrice[<?php echo $id; ?>]" id="FieldUnitPrice<?php echo $id; ?>" class="field_unit_price monitor-original monitor-change check_num<?php echo $num_decimals; ?> calc-worksheet form-control input-xs print-my-value" value="<?php echo number_format($Row['FieldUnitPrice'], $num_decimals); ?>" data-original-value="<?php echo $Row['OriginalFieldUnitPrice']; ?>" data-recent-value="<?php echo $Row['FieldUnitPrice']; ?>" />
                <span class="input-group-addon input-xs">&gt;</span>
            </div>

            <?php endif; ?>
        </td>
        <td class="thick-border-right">
            &lt;<span id="FieldUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;
        </td>

        <?php if (isset($worksheet_master) && $worksheet_master['DisplayShopHours'] == 1): ?>
            <td>
                <?php if ($Row['IsChildWorksheet'] == 1): ?>
                    &lt;<span id="ShopUnitPrice<?php echo $id; ?>"><?php echo number_format($Row['ShopUnitPrice'], 2); ?></span>&gt;
                <?php else: ?>
                <div class="input-group">
                    <span class="input-group-addon input-xs">&lt;</span>
                    <input type="text" name="ShopUnitPrice[<?php echo $id; ?>]" id="ShopUnitPrice<?php echo $id; ?>" class="shop_unit_price check_num2 monitor-original monitor-change calc-worksheet form-control input-xs print-my-value" value="<?php echo number_format($Row['ShopUnitPrice'], 2); ?>" data-original-value="<?php echo $Row['OriginalShopUnitPrice']; ?>" data-recent-value="<?php echo $Row['ShopUnitPrice']; ?>" />
                    <span class="input-group-addon input-xs">&gt;</span>
                </div>

                <?php endif; ?>
            </td>
            <td class="bold">
                &lt;<span id="ShopUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;
            </td>
        <?php else: ?>
            <td colspan="2">&nbsp;</td>
        <?php endif; ?>
    <?php endif; ?>
</tr>