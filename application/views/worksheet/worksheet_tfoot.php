<?php
$exceptions = array(
    "num_col_adjustment" => 0,
    "labor_label" => "FMH",
);

if ($worksheet_master['WorksheetMaster_Idn'] == 7)
{
    $exceptions = array(
        "num_col_adjustment" => 2,
        "labor_label" => "DMH",
    );
}
?>

<tfoot>
<?php if ($worksheet_master['DisplayAdjustmentFactors'] == 1): ?>
    <tr class="worksheet-total">
        <td colspan="5" class="text-center thick-border-top thick-border-bottom">
            ADJUSTMENT FACTORS
            <?php //if ($this->session->userdata('read_only') == 0): ?>
            <?php if ($job['is_locked'] == 0): ?>
                <span class="pull-right"><a href="#" id="AddAdjustmentFactor" title="Add Adjustment Factor" data-worksheet_idn="<?php echo $worksheet['Worksheet_Idn']; ?>">Add</a></span>
            <?php endif; ?>
        </td>
        <td colspan="2" class="thick-border-top thick-border-bottom">
            <span class="pull-right bold">FMH</span>
        </td>
        <td class="whitebgfill thick-border-right thick-border-top thick-border-bottom">
            &lt;<span id="FieldHoursSubtotal" class="bold"></span>&gt;
        </td>
        <td colspan="2">&nbsp;</td>
    </tr>
<?php endif; ?>

<?php
if ($worksheet_master['DisplayAdjustmentFactors'] == 1)
{
    //Use Pipe & Fittings adjustment factors for all worksheets except Conduit & Wire
    $adjustment_factors_worksheet_master_idn = ($worksheet_master['WorksheetMaster_Idn'] == 2) ? 2 : 4;
    foreach($worksheet['WorksheetFactorDetails'] as $WAF)
    {
        $WAF['AdjustmentFactors'] = get_adjustment_factors($adjustment_factors_worksheet_master_idn, $WAF['Rank']);
        $WAF['AdjustmentSubFactors'] = array();
        $this->load->view("worksheet/adjustment_factor_row", array("Row" => $WAF));
    }
}
?>

<?php //MANHOUR ADJUSTMENTS ?>
<?php if ($worksheet_master['DisplayManhourAdjustment'] == 1): ?>

    <?php //Crossmains and Lines Recap ?>
    <?php if ($worksheet_master['WorksheetMaster_Idn'] == 32): ?>
        <tr class="worksheet-total">
            <td colspan="2"><span class="pull-left">SUBTOTALS</span><span class="pull-right">Total Heads</span></td>
            <td><span id="TotalHeads">0</span></td>
            <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 6; ?>">&nbsp;</td>
            <td class="">&lt;<span id="FieldHoursSubtotal"></span>&gt;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
    <?php else: ?>
        <?php if ($worksheet_master['DisplayAdjustmentFactors'] != 1): ?>
            <tr class="worksheet-total">
                <td colspan="3"><span class="pull-left">SUBTOTALS</span></td>
                <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 6; ?>">&nbsp;</td>
                <td class="">&lt;<span id="FieldHoursSubtotal"></span>&gt;</td>
                <td colspan="2">&nbsp;</td>
            </tr>
        <?php endif; ?>
    <?php endif; ?>

    <tr class="worksheet-total">
        <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 3; ?>" class="text-left">
            <span class="pull-left">Manhour Adjustment</span>
            <span class="pull-right">
                <span class="form-horizontal">
                    <span class="checkbox">
                        <label for="OverrideDefaultManhourAdjustment">
                            <input type="checkbox" id="OverrideDefaultManhourAdjustment" name="OverrideDefaultManhourAdjustment" class="calc-worksheet"  <?php if ($worksheet['OverrideVolumeCorrection'] == 1) echo "checked"; ?> />Override Default
                        </label>
                        <select id="VolumeAdjustment" name="VolumeAdjustment" class="calc-worksheet input-xs print-my-value">
                        <?php foreach ($VolumeCorrections as $V): ?>
                            <option value="<?php echo $V['VolumeCorrection_Idn']; ?>" data-value="<?php echo $V['Value']; ?>" data-hours="<?php echo $V['Hours']; ?>" <?php if ($V['VolumeCorrection_Idn'] == $worksheet['VolumeCorrection_Idn']) echo 'selected="selected"'; ?>><?php echo quotes_to_entities($V['Name']); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </span>
                </span>
            </span>
        </td>
        <td><span id="ManhourAdjustmentFactor"></span></td>
        <td colspan="3">&nbsp;</td>
    </tr>
<?php endif; ?>

<?php if ($worksheet_master['WorksheetMaster_Idn'] != 9): ?>

    <tr class="worksheet-total">
        <?php if ($worksheet_master['DisplayFieldHoursOverride'] == 1): ?>
            <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 4 + $exceptions['num_col_adjustment']; ?>" class="left-aligned">Labor Hour Totals</td>
            <td>
                <input type="checkbox" name="OverrideFieldHours" id="OverrideFieldHours" value="1" <?php if ($worksheet['OverrideFieldHours'] == 1) echo "checked"; ?> />
                <label for="OverrideFieldHours">Override <?php echo $exceptions['labor_label']; ?></label>
            </td>
        <?php else: ?>
            <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 3 + $exceptions['num_col_adjustment']; ?>">
                <span class="pull-left">Labor Hour Totals</span>
                <span class="pull-right"><?php echo $exceptions['labor_label']; ?></span>
            </td>
        <?php endif; ?>
                                    
        <td class="thick-border-right">
            <div id="FieldHoursTotalWrapper" <?php if ($worksheet['OverrideFieldHours'] == 1) echo 'style="display: none;"'; ?>>
                &lt;<span id="FieldHoursTotal"></span>&gt;
            </div>
            <div id="UserFieldHoursWrapper" <?php if ($worksheet['OverrideFieldHours'] == 0) echo 'style="display: none;"'; ?>>
                <div class="input-group">
                    <span class="input-group-addon input-xs">&lt;</span>
                    <input type="text" name="UserFieldHours" id="UserFieldHours" class="check_num0 input-xs form-control monitor-change calc-worksheet print-my-value" value="<?php echo number_format($worksheet['UserFieldHours'], 0); ?>" data-recent-value="<?php echo $worksheet['UserFieldHours']; ?>" />                    <span class="input-group-addon input-xs">&gt;</span>
                </div>
            </div>
        </td>
        <?php if ($worksheet_master['WorksheetMaster_Idn'] != 7): ?>
            <td>
                <?php if ($worksheet_master['DisplayShopHoursOverride'] == 1): ?>
                    <input type="checkbox" name="OverrideShopHours" id="OverrideShopHours" value="1"  <?php if ($worksheet['OverrideShopHours'] == 1) echo "checked"; ?> />
                    <label for="OverrideShopHours">Override SMH</label>
                <?php else: ?>
                    &nbsp;
                <?php endif; ?>
            </td>
            <?php if ($worksheet_master['DisplayShopHoursOverride'] == 1 || $worksheet_master['DisplayShopHours'] == 1 || $worksheet_master['DisplayUserShopHoursOnly'] == 1): ?>
                <td class="">
                    <?php if ($worksheet_master['DisplayUserShopHoursOnly'] == 0 && ($worksheet_master['DisplayShopHoursOverride'] == 1 || $worksheet_master['DisplayShopHours'] == 1)) : ?>
                        <div id="ShopHoursTotalWrapper" <?php if ($worksheet_master['DisplayShopHoursOverride'] == 1 && $worksheet['OverrideShopHours'] == 1) echo 'style="display: none;"'; ?>>
                            &lt;<span id="ShopHoursTotal"></span>&gt;
                        </div>
                    <?php endif; ?>

                    <?php if ($worksheet_master['DisplayUserShopHoursOnly'] == 1 || $worksheet_master['DisplayShopHoursOverride'] == 1): ?>
                        <div id="UserShopHoursWrapper" <?php if ($worksheet_master['DisplayShopHoursOverride'] == 1 && $worksheet['OverrideShopHours'] == 0) echo 'style="display: none;"'; ?>>
                            <div class="input-group">
                                <span class="input-group-addon input-xs">&lt;</span>
                                <input type="text" name="UserShopHours" id="UserShopHours" class="check_num0 calc-worksheet input-xs form-control monitor-change print-my-value" value="<?php echo number_format($worksheet['UserShopHours'], 0); ?>" data-recent-value="<?php echo $worksheet['UserShopHours']; ?>" />
                                <span class="input-group-addon input-xs">&gt;</span>
                            </div>


                        </div>
                    <?php endif; ?>
                </td>
            <?php else: ?>
                <td>&nbsp;</td>
            <?php endif; ?>
        <?php endif; ?>
    </tr>
    <tr class="worksheet-total">
        <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 3 + $exceptions['num_col_adjustment']; ?>" class="left-aligned">Hourly Rates</td>
        <?php if ($worksheet_master['WorksheetMaster_Idn'] == 7): ?>
            <td class="thick-border-right">$<span id="EngineerLaborRate">
                <?php echo number_format($job['design_labor_rate'], 2); ?></span>
            </td>
        <?php else: ?>
            <td class="thick-border-right">$<span id="FieldLaborRate">
                <?php echo number_format($job['field_labor_rate'], 2); ?></span>
            </td>
            <td>&nbsp;</td>
            <?php if ($worksheet_master['DisplayShopHoursOverride'] == 1 || $worksheet_master['DisplayShopHours'] == 1 || $worksheet_master['DisplayUserShopHoursOnly'] == 1): ?>
                <td class="">$<span id="ShopLaborRate"><?php echo number_format($job['shop_labor_rate'], 2); ?></span></td>
            <?php else: ?>
                <td>&nbsp;</td>
            <?php endif; ?>
        <?php endif; ?>
    </tr>

<?php endif; ?>

<tr class="worksheet-total grand-total thick-border-top thick-border-bottom">

    <?php if ($worksheet_master['WorksheetMaster_Idn'] == 7): ?>
        <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 1; ?>" class="left-aligned">
            <span class="pull-left">TOTALS</span> 
        </td>
        <td>
            $<span id="EngineerTotal"></span>
        </td>
    <?php else: ?>
        <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 5; ?>" class="left-aligned"><span class="pull-left">TOTALS</span> <span class="pull-right">MATERIAL</span></td>
        <td class="whitebgfill thick-border-right">$<span id="MaterialTotal"></span></td>
        <td>FIELD</td>
        <td class="whitebgfill thick-border-right">
            <?php if ($worksheet_master['WorksheetMaster_Idn'] == 9): ?>
                &lt;<span id="FieldHoursTotal"></span>&gt;
            <?php else: ?>
                $<span id="FieldTotal"></span>
            <?php endif; ?>
        </td>

        <?php if ($worksheet_master['DisplayShopFabrication'] == 1): ?>
            <td colspan="2">
                <select id="ShopFabrication" name="ShopFabrication" class="input-xs print-my-value">
                    <?php foreach($ShopFabrications as $s): ?>
                        <option value="<?php echo $s['ShopFabrication_Idn']; ?>" data-factor="<?php echo $s['Value']; ?>"<?php if ($worksheet['ShopFabrication_Idn'] == $s['ShopFabrication_Idn']) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($s['Name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="ShopFabricationMultiplier" name="ShopFabricationMultiplier" class="input-xs print-my-value">
                    <option value="0" data-multiplier="0">
                    <?php foreach($ShopFabricationMultipliers as $m): ?>
                        <option value="<?php echo $m['ShopFabricationMultiplier_Idn']; ?>" data-multiplier="<?php echo $m['Multiplier']; ?>"<?php if ($worksheet['ShopFabricationMultiplier_Idn'] == $m['ShopFabricationMultiplier_Idn']) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($m['Name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        <?php else: ?>
            <td>SHOP</td>
            <?php if ($worksheet_master['DisplayShopHoursOverride'] == 1 || $worksheet_master['DisplayShopHours'] == 1 || $worksheet_master['DisplayUserShopHoursOnly'] == 1): ?>
                <td class="whitebgfill">$<span id="ShopTotal"></span></td>
            <?php else: ?>
                <td>&nbsp;</td>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</tr>

<?php //BRANCH LINE HEADS ?>
<?php if ($worksheet_master['WorksheetMaster_Idn'] == 9): ?>
    <tr class="worksheet-total">
        <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 6; ?>" class="left-aligned"># of HEADS = <span id="NumHeads"></span></td>
        <td colspan="2" class="whitebgfill">$<span id="MaterialPerHead"></span>&nbsp;/ HD</td>
        <td colspan="2" class="whitebgfill">&lt;<span id="FieldHoursPerHead"></span>&gt;&nbsp;/ HD</td>
        <td colspan="2" class="whitebgfill">
            <label for="OverrideShopHours"><strong>Override Shop per Head</strong></label>
            <input type="checkbox" id="OverrideShopHours" name="OverrideShopHours" value="1" <?php if ($worksheet['OverrideShopHours'] == 1) echo "checked"; ?> /><br />
            <span id="ShopHoursTotalWrapper" <?php if ($worksheet['OverrideShopHours'] == 1) echo 'style="display: none;"'; ?>>
                &lt;<span id="ShopHoursPerHead"></span>&gt;&nbsp;/ HD
            </span>
            <div id="UserShopHoursWrapper" class="input-group" <?php if ($worksheet['OverrideShopHours'] == 0) echo 'style="display: none;"'; ?>>
                <span class="input-group-addon input-xs">&lt;</span>
                <input type="text" name="UserShopHours" id="UserShopHours" class="check_num2 input-xs monitor-change print-my-value form-control" value="<?php echo number_format($worksheet['UserShopHours'], 2); ?>" data-recent-value="<?php echo $worksheet['UserShopHours']; ?>" />
                <span class="input-group-addon input-xs">&gt;</span>
            </div>
        </td>
    </tr>
<?php endif; ?>
</tfoot>