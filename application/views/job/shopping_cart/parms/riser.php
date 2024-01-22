<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];
?>

<label for="UndergroundSize<?php echo $id; ?>" class="bold">Underground Size</label>
<select name="UndergroundSize<?php echo $id; ?>" id="UndergroundSize<?php echo $id; ?>" class="form-control input-xs filter-results">
<?php
$sql_sizes = ($id == 106) ? "Value >= 1.5 AND Value <= 8" : "Value >= 4 AND Value <= 12";
$underground_sizes = $this->m_reference_table->get_where("ProductSizes", $sql_sizes, "Value ASC");
?>			
<?php foreach ($underground_sizes as $underground_size): ?>
	<option value="<?php echo $underground_size['Value']; ?>"><?php echo quotes_to_entities($underground_size['Name']); ?>"</option>
<?php endforeach; ?>
</select>


<?php $riser_text = ($id == 109) ? "Manifold" : "Riser"; ?>
<label for="RiserSize<?php echo $id; ?>" class="bold"><?php echo $riser_text; ?> Size</label>
<select name="RiserSize<?php echo $id; ?>" id="RiserSize<?php echo $id; ?>" class="form-control input-xs filter-results">
<?php foreach ($underground_sizes as $riser_size): ?>
	<option value="<?php echo $riser_size['Value']; ?>"><?php echo quotes_to_entities($riser_size['Name']); ?>"</option>
<?php endforeach; ?>
</select>

<?php if ($id == 106): ?>
	<label class="bold">Riser Types</label>
    <?php $riser_types = $this->m_reference_table->get_where("RiserTypes", "ActiveFlag = 1", "Rank ASC"); ?>
	<?php foreach ($riser_types as $riser_type): ?>
        <div>
            <label>
			<input type="radio" name="RiserType<?php echo $id; ?>" id="RiserType<?php echo $id."-".$riser_type['RiserType_Idn']; ?>" class="filter-results riser-type" value="<?php echo $riser_type['RiserType_Idn']; ?>" title="<?php echo quotes_to_entities($riser_type['Name']); ?>" <?php if ($riser_type['Rank'] == 2) echo 'checked="checked"'; ?> />
			<?php echo quotes_to_entities($riser_type['Name']); ?>
            </label>
        </div>
	<?php endforeach; ?>
<?php endif; ?>

<label class="bold">Backflow Types</label>
<div>
    <label class="radio-inline">
        <input type="radio" name="BackflowFlag<?php echo $id; ?>" id="BackflowFlagYes" class="filter-results toggle-cart-subgroup" value="Y" title="Yes" checked="checked" /> Yes
    </label> 
    <label class="radio-inline">
        <input type="radio" name="BackflowFlag<?php echo $id; ?>" id="BackflowFlagNo" class="filter-results toggle-cart-subgroup" value="N" title="No" /> No
    </label>
<span class="" id="GroupBackflow<?php echo $id; ?>">
<?php $backflow_types = $this->m_reference_table->get_where("BackflowTypes", "ActiveFlag = 1", "Rank ASC"); ?>
<?php foreach ($backflow_types as $backflow_type): ?>
    <label class="radio-inline">
			<input type="radio" name="Backflow<?php echo $id; ?>" id="Backflow<?php echo $id."-".$backflow_type['BackflowType_Idn']; ?>" class="filter-results" value="<?php echo $backflow_type['BackflowType_Idn']; ?>" title="<?php echo quotes_to_entities($backflow_type['Name']); ?>" <?php if ($backflow_type['Rank'] == 1) echo 'checked="checked"'; ?> />
	    <?php echo quotes_to_entities($backflow_type['Name']); ?>
    </label>
<?php endforeach; ?>
</span>
</div>

<label class="bold">Control Valves</label>
<div>
    <label class="radio-inline">
        <input type="radio" name="ControlValveFlag<?php echo $id; ?>" id="ControlValveFlagYes" class="filter-results toggle-cart-subgroup" value="Y" title="Yes" /> Yes
    </label> 
    <label class="radio-inline">
        <input type="radio" name="ControlValveFlag<?php echo $id; ?>" id="ControlValveFlagNo" class="filter-results toggle-cart-subgroup" value="N" title="No" checked="checked" /> No
    </label> <br />
    <span class="" id="GroupControlValve<?php echo $id; ?>">
    <?php $control_valves = $this->m_reference_table->get_where("ControlValves", "ActiveFlag = 1 AND ControlValve_Idn <> 4", "Rank ASC"); ?>
    <?php foreach ($control_valves as $control_valve): ?>
        <label class="radio-inline">
			    <input type="radio" name="ControlValve<?php echo $id; ?>" id="Backflow<?php echo $id."-".$control_valve['ControlValve_Idn']; ?>" class="filter-results" value="<?php echo $control_valve['ControlValve_Idn']; ?>" title="<?php echo quotes_to_entities($control_valve['Name']); ?>" <?php if ($control_valve['Rank'] == 1) echo 'checked="checked"'; ?> />
	        <?php echo quotes_to_entities($control_valve['Name']); ?>
        </label>
    <?php endforeach; ?>
    </span>
</div>

	 
<?php if ($id == 109): ?>
    <label class="bold">Check Valves</label>
    <div>
        <label class="radio-inline">
            <input type="radio" name="CheckValveFlag<?php echo $id; ?>" id="CheckValveFlagYes" class="filter-results toggle-cart-subgroup" value="Y" title="Yes" checked="checked" /> Yes
        </label> 
        <label class="radio-inline">
            <input type="radio" name="CheckValveFlag<?php echo $id; ?>" id="CheckValveFlagNo" class="filter-results toggle-cart-subgroup" value="N" title="No" /> No
        </label>
        <span class="" id="GroupCheckValve<?php echo $id; ?>">
        <?php $check_valves = $this->m_reference_table->get_where("CheckValves", "ActiveFlag = 1", "Rank ASC"); ?>
        <?php foreach ($check_valves as $check_valve): ?>
            <label class="radio-inline">
			        <input type="radio" name="CheckValve<?php echo $id; ?>" id="CheckValve<?php echo $id."-".$check_valve['CheckValve_Idn']; ?>" class="filter-results" value="<?php echo $check_valve['CheckValve_Idn']; ?>" title="<?php echo quotes_to_entities($check_valve['Name']); ?>" <?php if ($check_valve['Rank'] == 1) echo 'checked="checked"'; ?> />
	            <?php echo quotes_to_entities($check_valve['Name']); ?>
            </label>
        <?php endforeach; ?>
        </span>
    </div>
<?php endif; ?>

<label class="bold">FDC Types</label>
<div>
    <label class="radio-inline">
        <input type="radio" name="FDCFlag<?php echo $id; ?>" id="FDCFlagYes" class="filter-results toggle-cart-subgroup" value="Y" title="Yes" checked="checked" /> Yes
    </label> 
    <label class="radio-inline">
        <input type="radio" name="FDCFlag<?php echo $id; ?>" id="FDCFlagNo" class="filter-results toggle-cart-subgroup" value="N" title="No" /> No
    </label>
    <span class="" id="GroupFDC<?php echo $id; ?>">
    <?php $fdc_types = $this->m_reference_table->get_where("FDCTypes", "ActiveFlag = 1", "Rank ASC"); ?>
    <?php foreach ($fdc_types as $fdc_type): ?>
        <label class="radio-inline">
			    <input type="radio" name="FDC<?php echo $id; ?>" id="FDC<?php echo $id."-".$fdc_type['FdcType_Idn']; ?>" class="filter-results" value="<?php echo $fdc_type['FdcType_Idn']; ?>" title="<?php echo quotes_to_entities($fdc_type['Name']); ?>" <?php if ($fdc_type['Rank'] == 1) echo 'checked="checked"'; ?> />
	        <?php echo quotes_to_entities($fdc_type['Name']); ?>
        </label>
    <?php endforeach; ?>
    </span>
</div>

<label class="bold">Bell Types</label>
<div>
    <label class="radio-inline">
        <input type="radio" name="BellFlag<?php echo $id; ?>" id="BellFlagYes" class="filter-results toggle-cart-subgroup" value="Y" title="Yes" checked="checked" /> Yes
    </label> 
    <label class="radio-inline">
        <input type="radio" name="BellFlag<?php echo $id; ?>" id="BellFlagNo" class="filter-results toggle-cart-subgroup" value="N" title="No" /> No
    </label>
    <span class="" id="GroupBell<?php echo $id; ?>">
    <?php $bell_types = $this->m_reference_table->get_where("BellTypes", "ActiveFlag = 1", "Rank ASC"); ?>
    <?php foreach ($bell_types as $bell_type): ?>
        <label class="radio-inline">
			    <input type="radio" name="Bell<?php echo $id; ?>" id="Bell<?php echo $id."-".$bell_type['BellType_Idn']; ?>" class="filter-results" value="<?php echo $bell_type['BellType_Idn']; ?>" title="<?php echo quotes_to_entities($bell_type['Name']); ?>" <?php if ($bell_type['Rank'] == 1) echo 'checked="checked"'; ?> />
	        <?php echo quotes_to_entities($bell_type['Name']); ?>
        </label>
    <?php endforeach; ?>
    </span>
</div>
