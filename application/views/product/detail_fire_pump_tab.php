<form class="form-horizontal product-tab">
<div class="form-group form-group-sm">
    <label for="IsFirePump" class="col-sm-4 control-label">Fire Pump?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="IsFirePump" id="IsFirePump" type="checkbox" <?php if ($product['IsFirePump'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="FirePumpType_Idn" class="col-sm-4 control-label">Fire Pump Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="FirePumpType_Idn">
            <?php foreach($product['FirePumpTypes'] as $id => $fire_pump_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['FirePumpType_Idn']) echo 'selected'; ?>><?php echo $fire_pump_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="FirePumpAttribute_Idn" class="col-sm-4 control-label">Fire Pump Attribute</label>
    <div class="col-sm-8">
        <select class="form-control" id="FirePumpAttribute_Idn">
            <?php foreach($product['FirePumpAttributes'] as $id => $fire_pump_attribute): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['FirePumpAttribute_Idn']) echo 'selected'; ?>><?php echo $fire_pump_attribute; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm form-checkbox">
    <label for="IsDieselFuel" class="col-sm-4 control-label">Diesel Fuel?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="IsDieselFuel" id="IsDieselFuel" type="checkbox" <?php if ($product['IsDieselFuel'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="IsSolution" class="col-sm-4 control-label">Solution?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="IsSolution" id="IsSolution" type="checkbox" <?php if ($product['IsSolution'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="Position_Idn" class="col-sm-4 control-label">Position</label>
    <div class="col-sm-8">
        <select class="form-control" id="Position_Idn">
            <?php foreach($product['Positions'] as $id => $position): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['Position_Idn']) echo 'selected'; ?>><?php echo $position; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
</form>