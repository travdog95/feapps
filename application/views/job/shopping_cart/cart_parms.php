<?php
$this->load->model('m_reference_table');

//$category = $cart_parms['category'];
$id = $category['WorksheetCategory_Idn'];
$cart_parm_data = array(
    "category" => $category,
    "worksheet_parms" => $worksheet_parms,
    "job_parms" => $job_parms
    );
$cart_parm = "";
?>

<?php //Hidden field for IsAssembly ?>
<input type="hidden" id="IsAssembly<?php echo $id; ?>" name="IsAssembly<?php echo $id; ?>" value="<?php echo $category['IsAssembly']; ?>" />

<?php
switch($id)
{
    case 89: //Sprinkler
    case 36: //Special Hazard
        $cart_parm = "pipe";
        break;
    case 90: //Sprinkler
    case 37: //Special Hazard
        $cart_parm = "threaded_fittings";
        break;
    case 91:
        $cart_parm = "hangers";
        break;
    case 92:
        $cart_parm = "heads";
        break;
    case 96:
        $cart_parm = "riser_nipples";
        break;
    case 97: //Sprinkler
    case 39: //Special Hazard
        $cart_parm = "grooved_fittings";
        break;
    case 98:
        $cart_parm = "cpvc_fittings";
        break;
    case 99:
        $cart_parm = "other_fittings";
        break;
    case 106:
    case 109:
        $cart_parm = "riser";
        break;
    case 114:
        $cart_parm = "fire_pumps";
        break;
    case 118:
        $cart_parm = "valves";
        break;
    case 120:
        $cart_parm = "fc_assemblies";
        break;
    case 125:
        $cart_parm = "ug_pipe";
        break;
    case 126:
        $cart_parm = "ug_fittings";
        break;
    case 127:
        $cart_parm = "tapping_tees";
        break;
    case 128:
        $cart_parm = "ug_valves";
        break;
    case 141:
        $cart_parm = "products";
        break;
    default:
        break;
}

if ($category['WorksheetMaster_Idn'] == 3)
{
	$cart_parm = "tanks";
}

if (!empty($cart_parm))
{
    $this->load->view("job/shopping_cart/parms/{$cart_parm}.php", $cart_parm_data);
}
?>

<?php //Lift Durations ?>
<?php if ($id == 100): ?>
    <label>Lift Durations</label>
    <div class="checkbox">
        <?php $lift_durations = $this->m_reference_table->get_all("LiftDurations"); ?>
        <?php foreach ($lift_durations as $lift_duration): ?>
            <label for="LiftDuration<?php echo $id."-".$lift_duration['LiftDuration_Idn']; ?>" class="checkbox-inline">
                <input type="checkbox" id="LiftDuration<?php echo $id."-".$lift_duration['LiftDuration_Idn']; ?>" name="LiftDuration[<?php echo $id."-".$lift_duration['LiftDuration_Idn']; ?>]" class="lift-duration filter-results" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $lift_duration['LiftDuration_Idn']; ?>" />
                <?php echo quotes_to_entities($lift_duration['Name']); ?>

            </label>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Miscellaneous product -->
<?php if ($category['AddMiscFlag'] == 1): ?>
    <div style="margin-top: 15px;">
        <label for="CartMiscellaneousProduct<?php echo $id; ?>" class="bold">Miscellaneous Product</label>
        <input type="text" id="CartMiscellaneousProduct<?php echo $id; ?>" name="CartMiscellaneousProduct<?php echo $id; ?>" class="cart_misc_product form-control input-xs" />
    </div>
	<?php if ($id == 92): //Heads ?>
		<div>
			<input type="checkbox" id="IsHead<?php echo $id; ?>" name="IsHead<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" value="1" checked="checked" />
            <label for="IsHead<?php echo $id; ?>" class="bold"> Count as Head?</label>
		</div>
	<?php endif; ?>
<?php endif; ?>

<!-- Conduit and Wire -->
<?php if ($worksheet_master['WorksheetMaster_Idn'] == 2): ?>
    <div>
        Total panels and power supplies is <span id="TotalPanels<?php echo $id; ?>"><?php echo $total_panels; ?></span>. 
    </div>
    <div>With a factor of <input type="text" id="TotalPanelsFactor<?php echo $id; ?>" name="TotalPanelsFactor<?php echo $id; ?>" class="input-xs width-35" value="1" /> equals <span id="RecommendedPanels<?php echo $id; ?>"></span></div>
    <div>
        Total devices is <span id="TotalDevices<?php echo $id; ?>"><?php echo $total_devices; ?></span>. 
    </div>
    <div>With a factor of <input type="text" id="TotalDevicesFactor<?php echo $id; ?>" name="TotalDevicesFactor<?php echo $id; ?>" class="input-xs width-35" value="1" /> equals <span id="RecommendedDevices<?php echo $id; ?>"></span></div>

<?php endif; ?>

