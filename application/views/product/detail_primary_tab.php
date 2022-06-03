<form class="form-horizontal product-tab">
  <div class="form-group form-group-sm">
    <label for="Product_Idn" class="col-sm-4 control-label">ID</label>
    <div class="col-sm-8">
        <p class="form-control-static"><?php echo $product['Product_Idn']; ?></p>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="Department_Idn" class="col-sm-4 control-label">Department</label>
    <div class="col-sm-8">
        <select class="form-control" id="Department_Idn">
            <?php foreach($product['Departments'] as $id => $department): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['Department_Idn']) echo 'selected'; ?>><?php echo $department['Description']; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="WorksheetMaster_Idn" class="col-sm-4 control-label">Worksheet Master</label>
    <div class="col-sm-8">
        <select class="form-control" id="WorksheetMaster_Idn">
            <?php foreach($product['WorksheetMasters'] as $id => $worksheet_master): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['WorksheetMaster_Idn']) echo 'selected'; ?>><?php echo $worksheet_master; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="WorksheetCategory_Idn" class="col-sm-4 control-label">Worksheet Category</label>
    <div class="col-sm-8">
        <select class="form-control" id="WorksheetCategory_Idn">
            <?php foreach($product['WorksheetCategories'] as $id => $worksheet_category): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['WorksheetCategory_Idn']) echo 'selected'; ?>><?php echo $worksheet_category; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="Manufacturer_Idn" class="col-sm-4 control-label">Manufacturer</label>
    <div class="col-sm-8">
        <select class="form-control" id="Manufacturer_Idn">
            <?php foreach($product['Manufacturers'] as $id => $manufacturer): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['Manufacturer_Idn']) echo 'selected'; ?>><?php echo $manufacturer; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="Rank" class="col-sm-4 control-label">Rank</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="Rank" placeholder="Rank" value="<?php echo $product['Rank']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="Name" class="col-sm-4 control-label">Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="Name" placeholder="Name" value="<?php echo $product['Name']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="MaterialUnitPrice" class="col-sm-4 control-label">Material Unit Price</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="MaterialUnitPrice" placeholder="Material Unit Price" value="<?php echo $product['MaterialUnitPrice']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="FieldUnitPrice" class="col-sm-4 control-label">Field Unit Price</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="FieldUnitPrice" placeholder="Field Unit Price" value="<?php echo $product['FieldUnitPrice']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ShopUnitPrice" class="col-sm-4 control-label">Shop Unit Price</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="ShopUnitPrice" placeholder="Shop Unit Price" value="<?php echo $product['ShopUnitPrice']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="EngineerUnitPrice" class="col-sm-4 control-label">Engineer Unit Price</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="EngineerUnitPrice" placeholder="Engineer Unit Price" value="<?php echo $product['EngineerUnitPrice']; ?>">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ProductSize_Idn" class="col-sm-4 control-label">Product Size</label>
    <div class="col-sm-8">
        <select class="form-control" id="ProductSize_Idn">
            <?php foreach($product['ProductSizes'] as $id => $size): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['ProductSize_Idn']) echo 'selected'; ?>><?php echo $size; ?>"</option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="PipeType_Idn" class="col-sm-4 control-label">Pipe Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="PipeType_Idn">
            <?php foreach($product['PipeTypes'] as $id => $pipe_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['PipeType_Idn']) echo 'selected'; ?>><?php echo $pipe_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="ScheduleType_Idn" class="col-sm-4 control-label">Schedule Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="ScheduleType_Idn">
            <?php foreach($product['ScheduleTypes'] as $id => $schedule_type): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['ScheduleType_Idn']) echo 'selected'; ?>><?php echo $schedule_type; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>
  
  <div class="form-group form-group-sm">
    <label for="Fitting_Idn" class="col-sm-4 control-label">Fitting</label>
    <div class="col-sm-8">
        <select class="form-control" id="Fitting_Idn">
            <?php foreach($product['Fittings'] as $id => $fitting): ?>
            <option value="<?php echo $id; ?>" <?php if ($id == $product['Fitting_Idn']) echo 'selected'; ?>><?php echo $fitting; ?></option>
            <?php endforeach; ?>
        </select>    
    </div>
  </div>

  <div class="form-group form-group-sm form-checkbox">
    <label for="ActiveFlag" class="col-sm-4 control-label">Active?</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ActiveFlag" id="ActiveFlag" type="checkbox" <?php if ($product['ActiveFlag'] == 1) echo "checked"; ?>> 
        </label>
      </div>
    </div>
  </div>
</form>