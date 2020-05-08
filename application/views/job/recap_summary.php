<!-- Budget Summary table -->
<table class="table table-striped table-condensed table-bordered custom-table" id="recap_summary_table">
  <tr>
    <th colspan="2" class="text-center">Budget Summary</th>
  </tr>
  <tr>
    <td class="bold">Total Heads</td>
    <td><span id="bs_total_heads"><?php echo number_format($total_heads, 1); ?></span></td>
  </tr>
  <tr>
    <td class="bold">Total Sqft</td>
    <td><div style="float:right;"><input type="text" id="bs_total_sqft" name="bs_total_sqft" class="form-control change input-xs width-90 text-right check_num0" title="Total Sqft" value="<?php echo number_format($total_sqft, 0); ?>" /></div></td>
  </tr>
  <tr>
    <td class="bold">Sqft/Head</td>
    <td><span id="bs_sqft_per_head"></span></td>
  </tr>
  <tr>
    <td class="bold">Material/Head</td>
    <td>$<span id="bs_material_per_head"></span></td>
  </tr>
  <tr>
    <td class="bold">Field Hours/Head</td>
    <td><span id="bs_field_per_head"></span></td>
  </tr>
  <tr>
    <td class="bold">Eng Hours/Head</td>
    <td><span id="bs_eng_per_head"></span></td>
  </tr>
  <tr>
    <td class="bold">Shop Hours/Head</td>
    <td><span id="bs_shop_per_head"></span></td>
  </tr>
  <tr>
    <td class="bold">Cost/Sqft</td>
    <td>$<span id="bs_cost_per_sqft"></span></td>
  </tr>
  <tr>
    <td class="bold">Price/Sqft</td>
    <td>$<span id="bs_price_per_sqft"></span></td>
  </tr>
</table>