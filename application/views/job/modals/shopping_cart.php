<div id="cart_modal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Shopping Cart</h4>
            </div>
            <div class="modal-body">

                <!-- Shopping Cart Tabs -->
                <ul id="cart_tabs" class="nav nav-tabs" role="tablist">
                <?php foreach ($worksheet_master['WorksheetMasterCategories'] as $category): ?>
                    <?php $tab_name = (isset($category['ShortName']) && !empty($category['ShortName'])) ? $category['ShortName'] : $category['Name']; ?>
                    <?php if ($category['CartFlag'] == 1): ?>
                        <?php $id = "tab".$category['WorksheetCategory_Idn']; ?>
                        <li role="presentation">
                            <a data-worksheetcategoryidn="<?php echo $category['WorksheetCategory_Idn']; ?>" href="#<?php echo $id; ?>" aria-controls="<?php echo $id; ?>" role="tab" data-toggle="tab">
                                <?php echo quotes_to_entities($tab_name); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>

                <!-- Shopping Cart Content -->
                <div class="tab-content">
                <?php foreach ($worksheet_master['WorksheetMasterCategories'] as $category): ?>
                    <?php if ($category['CartFlag'] == 1): ?>
                        <?php $id = "tab".$category['WorksheetCategory_Idn']; ?>
                        <div role="tabpanel" class="tab-pane" id="<?php echo $id; ?>">
                            <div id="cart_parms<?php echo $category['WorksheetCategory_Idn']; ?>" class="cart-parms">
                                <?php 
                                $form_attributes = array(
                                    'id' => 'cart_parms_form'.$category['WorksheetCategory_Idn'],
                                    "autocomplete" => "off"
                                );
                                echo form_open("#", $form_attributes);

                                $cart_parms = array(
                                    'category' => $category,
                                    'worksheet_parms' => $worksheet_parms,
                                    'job_parms' => $job_parms,
                                    'total_panels' => $total_panels,
                                    'total_devices' => $total_devices
                                    ); 
                                $this->load->view('job/shopping_cart/cart_parms.php', $cart_parms);
                                ?>
                                <input type="hidden" id="tab_viewed_flag<?php echo $category['WorksheetCategory_Idn']; ?>" value="0" />
                                <input type="hidden" id="Department_Idn" name="Department_Idn" value="<?php echo $job['department_idn']; ?>" />
                                <?php
                                echo form_close();
                                ?>
                            </div>
                            <div id="cart_results<?php echo $category['WorksheetCategory_Idn']; ?>" class="cart-results">

                                <?php 
                                $form_attributes = array(
                                    'id' => 'cart_results_form'.$category['WorksheetCategory_Idn']
                                );
                                echo form_open("#", $form_attributes);

                                //Get column names for shopping cart results table
                                $columns = get_cart_columns($category['WorksheetCategory_Idn']);
                                $category['ColumnTitles'] = $columns['titles'];

                                //Display Shopping cart results
                                $cart_results = array('category' => $category);
                                $this->load->view('job/shopping_cart/cart_results.php', $cart_results); 

                                echo form_close();
                                ?>

                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                </div>
            </div>
            <div class="modal-footer">
                <span class="shopping-cart-message"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="InsertProducts">Insert Products</button>
                <div style="clear:both;"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->