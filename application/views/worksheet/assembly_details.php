<table class="assembly-details table table-striped table-condensed table-bordered custom-table table-centered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Material</th>
            <th>Field Labor</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($details as $detail): ?>
        <tr>
            <td class="text-left"><?php echo quotes_to_entities($detail['Name']); ?></td>
            <td class="text-right"><?php echo number_format($detail['Quantity'],1); ?></td>
            <td class="text-right"><?php echo number_format($detail['MaterialUnitPrice'],2); ?></td>
            <td class="text-right"><?php echo number_format($detail['FieldUnitPrice'],2); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>