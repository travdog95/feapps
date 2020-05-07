<colgroup>
<?php for ($i=1; $i <= $worksheet_master['NumberOfColumns']; $i++): ?>
    <col id="Worksheet<?php echo $worksheet_master['WorksheetMaster_Idn']; ?>Col<?php echo $i; ?>" />
<?php endfor; ?>
</colgroup>
<thead>
    <tr class="bold">
        <th colspan="2" rowspan="2">Location of Sprinklers</th>
        <th colspan="5" rowspan="2">Material Costs</th>
        <th colspan="4">Labor Costs</th>
    </tr>
    <tr class="bold">
        <th colspan="2">Field</th>
        <th colspan="2">Shop</th>
    </tr>
</thead>