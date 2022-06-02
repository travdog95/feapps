<form class="form-horizontal product-tab">
  <div class="form-group form-group-sm">
    <label for="GradeType_Idn" class="col-sm-4 control-label">Grade Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="GradeType_Idn">
            <?php foreach($product['GradeTypes'] as $id => $grade_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['GradeType_Idn']) echo 'selected'; ?>><?php echo $grade_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="PressureType_Idn" class="col-sm-4 control-label">Pressure Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="PressureType_Idn">
            <?php foreach($product['PressureTypes'] as $id => $pressure_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['PressureType_Idn']) echo 'selected'; ?>><?php echo $pressure_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="SeamlessFlag" class="col-sm-4 control-label">Seamless Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="SeamlessFlag" id="SeamlessFlag" type="checkbox" <?php if ($product['SeamlessFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="FMJobFlag" class="col-sm-4 control-label">FM Job Flag</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="FMJobFlag" id="FMJobFlag" type="checkbox" <?php if ($product['FMJobFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>



</form>