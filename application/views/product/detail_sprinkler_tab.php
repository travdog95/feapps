<form class="form-horizontal product-tab">
  <div class="form-group form-group-sm">
    <label for="GroovedFittingType_Idn" class="col-sm-4 control-label">Grooved Fitting Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="GroovedFittingType_Idn">
            <?php foreach($product['GroovedFittingTypes'] as $id => $grooved_fitting_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['GroovedFittingType_Idn']) echo 'selected'; ?>><?php echo $grooved_fitting_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ThreadedFittingType_Idn" class="col-sm-4 control-label">Threaded Fitting Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="ThreadedFittingType_Idn">
            <?php foreach($product['ThreadedFittingTypes'] as $id => $grooved_fitting_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['ThreadedFittingType_Idn']) echo 'selected'; ?>><?php echo $threaded_fitting_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="HangerType_Idn" class="col-sm-4 control-label">Hanger Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="HangerType_Idn">
            <?php foreach($product['HangerTypes'] as $id => $hanger_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['HangerType_Idn']) echo 'selected'; ?>><?php echo $hanger_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="HangerSubType_Idn" class="col-sm-4 control-label">Hanger Sub Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="HangerSubType_Idn">
            <?php foreach($product['HangerSubTypes'] as $id => $hanger_sub_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['HangerSubType_Idn']) echo 'selected'; ?>><?php echo $hanger_sub_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="SubcontractCategory_Idn" class="col-sm-4 control-label">Subcontract Category</label>
    <div class="col-sm-8">
        <select class="form-control" id="SubcontractCategory_Idn">
            <?php foreach($product['SubcontractCategories'] as $id => $subcontract_category): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['SubcontractCategory_Idn']) echo 'selected'; ?>><?php echo $subcontract_category; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
        <label for="ResponseType" class="col-sm-4 control-label">Description</label>
        <div class="col-sm-8">
        <textarea class="form-control" rows="3" placeholder="Description"></textarea>
        </div>
    </div>

  <div class="form-group form-group-sm">
    <label for="ApplyToAdjustmentFactorsFlag" class="col-sm-4 control-label">Apply To Adjustment Factors Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ApplyToAdjustmentFactorsFlag" id="ApplyToAdjustmentFactorsFlag" type="checkbox" <?php if ($product['ApplyToAdjustmentFactorsFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ApplyToContingencyFlag" class="col-sm-4 control-label">Apply To Contingency Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ApplyToContingencyFlag" id="ApplyToContingencyFlag" type="checkbox" <?php if ($product['ApplyToContingencyFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="IsMainComponent" class="col-sm-4 control-label">Is Main Component</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="IsMainComponent" id="IsMainComponent" type="checkbox" <?php if ($product['IsMainComponent'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="DomesticFlag" class="col-sm-4 control-label">Domestic Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="DomesticFlag" id="DomesticFlag" type="checkbox" <?php if ($product['DomesticFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="LoadFlag" class="col-sm-4 control-label">Load Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="LoadFlag" id="LoadFlag" type="checkbox" <?php if ($product['LoadFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="AutoLoadFlag" class="col-sm-4 control-label">Auto Load Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="AutoLoadFlag" id="AutoLoadFlag" type="checkbox" <?php if ($product['AutoLoadFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
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