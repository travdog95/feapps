<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Positions
$positions = $this->m_reference_table->get_fields("Positions", "Position_Idn AS Value, Name", "ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/radio_group.php", array("id" => $id, "options" => $positions, "element_id" => "Position", "label" => "Position", "filter" => true, "default" => 2)); 

//Fire Pump Types
$fire_pump_types = $this->m_reference_table->get_fields("FirePumpTypes", "FirePumpType_Idn AS Value, Name", "ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/radio_group.php", array("id" => $id, "options" => $fire_pump_types, "element_id" => "FirePumpType", "label" => "Fire Pump Type", "filter" => true, "default" => 1)); 
?>
<div id="DieselFuelContainer<?php echo $id; ?>" style="display:none;">
    <label class="bold">Diesel Fuel Cost (per gallon)</label>
    <input type="text" name="DieselFuel<?php echo $id; ?>" id="DieselFuel<?php echo $id; ?>" class="form-control input-xs check_num1" />
</div>
<?php
//GPM
$gpms = $this->m_reference_table->get_fields("GPMs", "GPM_Idn AS Value, Name", "ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $gpms, "element_id" => "GPM", "label" => "GPM", "filter" => 1)); 
?>

<label class="bold">Backflow Types</label>
<div>
    <label>
        <input type="radio" name="BackflowFlag<?php echo $id; ?>" id="BackflowFlagYes" class="filter-results toggle-cart-subgroup" value="Y" title="Yes" checked="checked" /> Yes
    </label> 
    <label>
        <input type="radio" name="BackflowFlag<?php echo $id; ?>" id="BackflowFlagNo" class="filter-results toggle-cart-subgroup" value="N" title="No" /> No
    </label>
<span id="GroupBackflow<?php echo $id; ?>">
<?php $backflow_types = $this->m_reference_table->get_where("BackflowTypes", "ActiveFlag = 1", "Rank ASC"); ?>
<?php foreach ($backflow_types as $backflow_type): ?>
    <label>
			<input type="radio" name="Backflow<?php echo $id; ?>" id="Backflow<?php echo $id."-".$backflow_type['BackflowType_Idn']; ?>" class="filter-results" value="<?php echo $backflow_type['BackflowType_Idn']; ?>" title="<?php echo quotes_to_entities($backflow_type['Name']); ?>" <?php if ($backflow_type['Rank'] == 1) echo 'checked="checked"'; ?> />
	    <?php echo quotes_to_entities($backflow_type['Name']); ?>
    </label>
<?php endforeach; ?>
</span>
</div>

<?php
//Fire Attribute Radio Groups
$fire_attributes = $this->m_reference_table->get_where("FirePumpAttributes", "ActiveFlag = 1", "Rank ASC");
foreach($fire_attributes as $f)
{
    $default = ($f['DefaultFlag'] == 1) ? $f['FirePumpAttribute_Idn'] : 0;
    $data = array(
        "id" => $id, 
        "options" => array(
            0 => array("Name" => "Yes", "Value" => $f['FirePumpAttribute_Idn']),
            1 => array("Name" => "No", "Value" => "0")
            ),
        "element_id" => str_replace(" ", "", $f['Name']), 
        "label" => $f['Name'], 
        "filter" => true, 
        "default" => $default
        ); 
    $this->load->view("job/shopping_cart/parms/parm_components/radio_group.php", $data);
}
?>

<button id="ShowFirePumpsTable" class="btn btn-info btn-xs" type="button">Show Table</button>