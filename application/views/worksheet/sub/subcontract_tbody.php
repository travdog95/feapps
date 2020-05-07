<tbody>
<?php // Worksheet Categories ?>                           
                                    
<?php foreach ($worksheet_master['WorksheetMasterCategories'] as $index => $category): ?>

    <?php 
    //Worksheet category row
    $worksheet_category_row_data = $category;

    $worksheet_category_row_data['Colspan'] = 8;
    $worksheet_category_row_data['TotalFieldHours'] = $job['field_hours'];
    $worksheet_category_row_data['job_number'] = $job['job_number'];

    //Display Worksheet Category
    $this->load->view('worksheet/worksheet_category_row', array("Row" => $worksheet_category_row_data));
    ?>

    <?php //Product Details ?>

    <?php if (isset($products[$category['WorksheetCategory_Idn']])): ?>

        <?php foreach ($products[$category['WorksheetCategory_Idn']] as $product): ?>

            <?php
            //Load product data
            $subcontract_products_data = $product;
            $this->load->view('worksheet/worksheet_subcontract_products', $subcontract_products_data);
            ?>

        <?php endforeach; ?>

    <?php endif; ?>

    <?php //Miscellaneous Product Details ?>

    <?php if (isset($miscellaneous_products[$category['WorksheetCategory_Idn']])): ?>

        <?php foreach ($miscellaneous_products[$category['WorksheetCategory_Idn']] as $misc_product): ?>

            <?php
            //Load product data
            $subcontract_products_data = $misc_product;
            $this->load->view('worksheet/worksheet_subcontract_products', $subcontract_products_data);
            ?>

        <?php endforeach; ?>

    <?php endif; ?>

<?php endforeach; ?>
</tbody>