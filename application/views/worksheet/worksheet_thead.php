<thead>
    <tr class="bold">
    <?php // 7 -> SH engineering worksheet ?>
    <?php if ($worksheet_master['WorksheetMaster_Idn'] == 7): ?>
        <th width="6%">&nbsp;</th>
        <th width="14%">Qty</th>
        <th width="40%">Product</th>
        <th width="20%">Man Hours Per Unit</th>
        <th width="20%">Total Man Hours</th>
    <?php else: ?>
        <th width="4%" rowspan="2">&nbsp;</th>
        <th width="7%" rowspan="2">Qty</th>
        <th width="25%" rowspan="2">Product</th>
        <th width="4%" rowspan="2">&nbsp;</th>
        <th width="10%" rowspan="2">UnitPrice</th>
        <th width="10%" rowspan="2">Ext Price</th>
        <th colspan="2">Field Labor</th>
        <th colspan="2">Shop Labor</th>
    <?php endif; ?>

    </tr>
    <?php if ($worksheet_master['WorksheetMaster_Idn'] != 7): ?>
        <tr class="bold">
            <th width="10%">Unit Value</th>
            <th width="10%">Ext Value</th>
            <th width="10%">Unit Value</th>
            <th width="10%">Ext Value</th>
        </tr>
    <?php endif; ?>
</thead>