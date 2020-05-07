<tbody>
<?php
//Load Worksheet Categories
//echo "<pre>";
//print_r($worksheet_master['WorksheetMasterCategories']);
//echo "</pre>";
foreach ($worksheet_master['WorksheetMasterCategories'] as $category)
{
    //echo "<pre>";
    //print_r($products);
    //echo "</pre>";

    //$category['Colspan'] = 10;

    $this->load->view('worksheet/worksheet_category_row', array("Row" => $category));

    //Display worksheet details for current category
    if (!empty($products[$category['WorksheetCategory_Idn']]))
    {
        foreach ($products[$category['WorksheetCategory_Idn']] as $product)
        {
            $this->load->view('worksheet/worksheet_products', array("Row" => $product));
        }
    }

    //Display child worksheet details for current category
    if (!empty($child_worksheet_details[$category['WorksheetCategory_Idn']]))
    {
        foreach ($child_worksheet_details[$category['WorksheetCategory_Idn']] as $child_worksheet)
        {
            $child_worksheet['ProductAssembly_Idn'] = 0;
			$child_worksheet['CategoryName'] = "";
            $this->load->view('worksheet/worksheet_products', array("Row" => $child_worksheet));
        }
    }

    //Display miscellaneous details for current category
    if(!empty($miscellaneous_products[$category['WorksheetCategory_Idn']]))
    {
        foreach ($miscellaneous_products[$category['WorksheetCategory_Idn']] as $miscellaneous_product)
        {
			$miscellaneous_product['CategoryName'] = ($miscellaneous_product['IsHead'] == 1) ? $category['Name'] : "";
            $this->load->view('worksheet/worksheet_products', array("Row" => $miscellaneous_product));
        }
    }
}
	?>
</tbody>