<form class="form-horizontal product-tab">
  <div class="form-group form-group-sm">
    <label for="CoverageType_Idn" class="col-sm-4 control-label">Coverage Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="CoverageType_Idn" name="CoverageType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['CoverageTypes'] as $id => $coverage_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['CoverageType_Idn']) echo 'selected'; ?>><?php echo $coverage_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="HeadType_Idn" class="col-sm-4 control-label">Head Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="HeadType_Idn" name="HeadType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['HeadTypes'] as $id => $head_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['HeadType_Idn']) echo 'selected'; ?>><?php echo $head_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="FinishType_Idn" class="col-sm-4 control-label">Finish Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="FinishType_Idn" name="FinishType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['FinishTypes'] as $id => $finish_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['FinishType_Idn']) echo 'selected'; ?>><?php echo $finish_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="Outlet_Idn" class="col-sm-4 control-label">Outlet</label>
    <div class="col-sm-8">
        <select class="form-control" id="Outlet_Idn" name="Outlet_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['Outlets'] as $id => $outlet): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['Outlet_Idn']) echo 'selected'; ?>><?php echo $outlet; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="RiserType_Idn" class="col-sm-4 control-label">Riser Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="RiserType_Idn" name="RiserType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['RiserTypes'] as $id => $riser_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['RiserType_Idn']) echo 'selected'; ?>><?php echo $riser_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="BackflowType_Idn" class="col-sm-4 control-label">Back Flow Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="BackflowType_Idn" name="BackflowType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['BackflowTypes'] as $id => $backflow_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['BackFlowType_Idn']) echo 'selected'; ?>><?php echo $backflow_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="ControlValve_Idn" class="col-sm-4 control-label">Control Valve</label>
    <div class="col-sm-8">
        <select class="form-control" id="ControlValve_Idn" name="ControlValve_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['ControlValves'] as $id => $control_valve): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['ControlValve_Idn']) echo 'selected'; ?>><?php echo $control_valve; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="CheckValve_Idn" class="col-sm-4 control-label">Check Valve</label>
    <div class="col-sm-8">
        <select class="form-control" id="CheckValve_Idn" name="CheckValve_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['CheckValves'] as $id => $check_valve): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['CheckValve_Idn']) echo 'selected'; ?>><?php echo $check_valve; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="FDCType_Idn" class="col-sm-4 control-label">FDC Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="FDCType_Idn" name="FDCType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['FDCTypes'] as $id => $fdc_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['FDCType_Idn']) echo 'selected'; ?>><?php echo $fdc_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="BellType_Idn" class="col-sm-4 control-label">Bell Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="BellType_Idn" name="BellType_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['BellTypes'] as $id => $bell_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['BellType_Idn']) echo 'selected'; ?>><?php echo $bell_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="TappingTee_Idn" class="col-sm-4 control-label">Tapping Tee</label>
    <div class="col-sm-8">
        <select class="form-control" id="TappingTee_Idn" name="TappingTee_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['TappingTees'] as $id => $tapping_tee): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['TappingTee_Idn']) echo 'selected'; ?>><?php echo $tapping_tee; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="UndergroundValve_Idn" class="col-sm-4 control-label">Underground Valve</label>
    <div class="col-sm-8">
        <select class="form-control" id="UndergroundValve_Idn" name="UndergroundValve_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['UndergroundValves'] as $id => $underground_valve): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['UndergroundValve_Idn']) echo 'selected'; ?>><?php echo $underground_valve; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="LiftDuration_Idn" class="col-sm-4 control-label">Lift Duration</label>
    <div class="col-sm-8">
        <select class="form-control" id="LiftDuration_Idn" name="LiftDuration_Idn">
            <option value="0">PLEASE SELECT</option>
            <?php foreach($product['LiftDurations'] as $id => $lift_duration): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['LiftDuration_Idn']) echo 'selected'; ?>><?php echo $lift_duration; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

<div class="form-group form-group-sm form-checkbox">
    <label for="TrimPackageFlag" class="col-sm-4 control-label">Trim Package?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="TrimPackageFlag" id="TrimPackageFlag" type="checkbox" <?php if ($product['TrimPackageFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm form-checkbox">
    <label for="ListedFlag" class="col-sm-4 control-label">Listed?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ListedFlag" id="ListedFlag" type="checkbox" <?php if ($product['ListedFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="BoxWireLength" class="col-sm-4 control-label">Box Wire Length</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="BoxWireLength" name="BoxWireLength" placeholder="Box Wire Length" value="<?php echo $product['BoxWireLength']; ?>">
    </div>
  </div>

</form>