<div id="cart_num_results<?php echo $category['WorksheetCategory_Idn']; ?>" class="text-center text-primary">&nbsp;</div>
<table id="cart_table<?php echo $category['WorksheetCategory_Idn']; ?>" class="table table-striped table-hover table-condensed cart-results-table table-bordered" summary="Shopping Cart results.">
    <thead>
        <tr id="cart_column_headers<?php echo $category['WorksheetCategory_Idn']; ?>">
			<?php //ColumnNames is loaded from get_cart_columns in feci_helper.php ?>
            <?php foreach($category['ColumnTitles'] as $title): ?>
                <th><?php echo $title; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<?php if ($category['IsAssembly'] == 1): ?>
    <div id="cart_results_footer<?php echo $category['WorksheetCategory_Idn']; ?>" class="cart-results-footer">
        <span class="assembly-name"></span><span class="assembly-price"></span>
        <div style="clear:both;"></div>
    </div>
    <input type="hidden" id="AssemblyName<?php echo $category['WorksheetCategory_Idn']; ?>" name="AssemblyName<?php echo $category['WorksheetCategory_Idn']; ?>" value="" />
    <input type="hidden" id="AssemblyFieldHours<?php echo $category['WorksheetCategory_Idn']; ?>" name="AssemblyFieldHours<?php echo $category['WorksheetCategory_Idn']; ?>" value="0" />
    <input type="hidden" id="AssemblyPrice<?php echo $category['WorksheetCategory_Idn']; ?>" name="AssemblyPrice<?php echo $category['WorksheetCategory_Idn']; ?>" value="0" />
<?php endif; ?>