<table id="table_child_jobs" class="table table-striped table-hover" summary="Child Jobs.">
	<colgroup>
	    <col id="delete_col" />
	    <col id="job_number_col" />
	    <col id="name_col" />
	    <col id="contractor_col" />
	    <col id="prepared_by_col" />
	    <col id="job_date_col" />
	</colgroup>
	<thead>
	    <tr>
		<th scope="col">&nbsp;</th>
		<th scope="col">ID</th>
		<th scope="col">Name</th>
		<th scope="col">Contractor</th>
		<th scope="col">Prepared By</th>
		<th scope="col">Job Date</th>
	    </tr>
	</thead>
    <tbody>
    <?php foreach ($child_jobs as $child): ?>
        <?php
        $prepared_bys = (!empty($child->job['prepared_by_names'])) ? $child->job['prepared_by_names'] : $child->job['created_by_name'];
        $job_date = date("M j, Y", get_timestamp($child->job['job_date']));
        $i = 0;
        ?>
		<tr id="child<?php echo $child->job_number; ?>" class="<?php echo ($i++ % 2 == 1) ? "odd" : "even"; ?>">
			<td style="text-align:center;">
			    <input name="remove_child_job[]" type="checkbox" class="remove_child_job" value="<?php echo $child->job_number; ?>" />
			</td>
			<td><?php echo $child->job_number; ?></td>
			<td><a href="<?php echo base_url(); ?>job/recap/<?php echo $child->job_number; ?>" title="View Recap"><?php echo quotes_to_entities($child->job['name']); ?></a></td>
			<td><?php echo quotes_to_entities($child->job['contractor']); ?></td>
			<td><?php echo $prepared_bys; ?></td>
			<td><?php echo $job_date; ?></td>
		</tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p>
    <button type="button" class="btn btn-default remove_child_jobs" title="Remove Selected Child Jobs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
    <span class="message modal_message display_none"></span>
</p>

<script>
    recap_modal_handlers();
    FECI.source_modal = "child_jobs";
</script>