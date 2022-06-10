<form class="form-horizontal product-tab">
  <div class="form-group form-group-sm">
    <label for="FECI_Id" class="col-sm-4 control-label">FECI ID</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="FECI_Id" name="FECI_Id" placeholder="FECI ID" value="<?php echo $product['FECI_Id']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ManufacturerPart_Id" class="col-sm-4 control-label">Manufacturer Part ID</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="ManufacturerPart_Id" name="ManufacturerPart_Id" placeholder="Manufacturer Part ID" value="<?php echo $product['ManufacturerPart_Id']; ?>">
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="GroovedFittingType_Idn" class="col-sm-4 control-label">Grooved Fitting Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="GroovedFittingType_Idn" name="GroovedFittingType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['GroovedFittingTypes'] as $id => $grooved_fitting_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['GroovedFittingType_Idn']) echo 'selected'; ?>><?php echo $grooved_fitting_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ThreadedFittingType_Idn" class="col-sm-4 control-label">Threaded Fitting Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="ThreadedFittingType_Idn" name="ThreadedFittingType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['ThreadedFittingTypes'] as $id => $threaded_fitting_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['ThreadedFittingType_Idn']) echo 'selected'; ?>><?php echo $threaded_fitting_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="HangerType_Idn" class="col-sm-4 control-label">Hanger Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="HangerType_Idn" name="HangerType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['HangerTypes'] as $id => $hanger_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['HangerType_Idn']) echo 'selected'; ?>><?php echo $hanger_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="HangerSubType_Idn" class="col-sm-4 control-label">Hanger Sub Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="HangerSubType_Idn" name="HangerSubType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['HangerSubTypes'] as $id => $hanger_sub_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['HangerSubType_Idn']) echo 'selected'; ?>><?php echo $hanger_sub_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="SubcontractCategory_Idn" class="col-sm-4 control-label">Subcontract Category</label>
    <div class="col-sm-8">
        <select class="form-control" id="SubcontractCategory_Idn" name="SubcontractCategory_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['SubcontractCategories'] as $id => $subcontract_category): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['SubcontractCategory_Idn']) echo 'selected'; ?>><?php echo $subcontract_category; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="DefaultQuantity" class="col-sm-4 control-label">Default Quantity</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="DefaultQuantity" name="DefaultQuantity" placeholder="Default Quantity" value="<?php echo $product['DefaultQuantity']; ?>">
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="ResponseType" class="col-sm-4 control-label">Description</label>
    <div class="col-sm-8">
      <textarea id="Description" name="Description" class="form-control" rows="2" placeholder="Description"></textarea>
     </div>
  </div>

  <div class="form-group form-group-sm form-checkbox">
    <label for="ApplyToAdjustmentFactorsFlag" class="col-sm-4 control-label">Apply To Adjustment Factors?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ApplyToAdjustmentFactorsFlag" id="ApplyToAdjustmentFactorsFlag" type="checkbox" <?php if ($product['ApplyToAdjustmentFactorsFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="ApplyToContingencyFlag" class="col-sm-4 control-label">Apply To Contingency?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ApplyToContingencyFlag" id="ApplyToContingencyFlag" type="checkbox" <?php if ($product['ApplyToContingencyFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="IsMainComponent" class="col-sm-4 control-label">Main Component?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="IsMainComponent" id="IsMainComponent" type="checkbox" <?php if ($product['IsMainComponent'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="DomesticFlag" class="col-sm-4 control-label">Domestic?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="DomesticFlag" id="DomesticFlag" type="checkbox" <?php if ($product['DomesticFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="LoadFlag" class="col-sm-4 control-label">Load?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="LoadFlag" id="LoadFlag" type="checkbox" <?php if ($product['LoadFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="AutoLoadFlag" class="col-sm-4 control-label">Auto Load?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="AutoLoadFlag" id="AutoLoadFlag" type="checkbox" <?php if ($product['AutoLoadFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="ShoppableFlag" class="col-sm-4 control-label">Shoppable?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ShoppableFlag" id="ShoppableFlag" type="checkbox" <?php if ($product['ShoppableFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>

  <div class="form-group form-group-sm form-checkbox">
  <label for="ResponseType" class="col-sm-4 control-label">Response Type</label>
    <div class="col-sm-8">
        <label class="radio-inline">
            <input type="radio" name="ResponseType" id="ResponseTypeQR" value="QR" <?php if($product['ResponseType'] == "Q") echo "checked";?>> QR
        </label>
        <label class="radio-inline">
            <input type="radio" name="ResponseType" id="ResponseTypeSR" value="SR" <?php if($product['ResponseType'] == "S") echo "checked";?>> SR
        </label>    
    </div>
  </div>



</form>