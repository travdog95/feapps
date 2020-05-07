<table id="table_child_jobs" class="table table-striped table-hover" summary="Child Jobs.">
	<colgroup>
	    <col id="add_col" />
	    <col id="job_number_col" />
	    <col id="name_col" />
	    <col id="contractor_col" />
	    <col id="prepared_by_col" />
	    <col id="job_date_col" />
	    <col id="amount_col" />
	</colgroup>
	<thead>
	    <tr>
		<th scope="col">Add</th>
		<th scope="col">ID</th>
		<th scope="col">Name</th>
		<th scope="col">Contractor</th>
		<th scope="col">Prepared By</th>
		<th scope="col">Job Date</th>
		<th scope="col">Amount</th>
	    </tr>
	</thead>
    <tbody>
		<?php if (empty($parent_jobs)): ?>
			<tr><td colspan="7">No parent jobs found!</td></tr>
		<?php endif; ?>
    <?php foreach ($parent_jobs as $parent_job): ?>
        <?php
        $prepared_bys = (!empty($parent_job->job['prepared_by_names'])) ? $parent_job->job['prepared_by_names'] : $parent_job->job['created_by_name'];
        $job_date = date("M j, Y", get_timestamp($parent_job->job['job_date']));
        $i = 0;
        ?>
		<tr id="child<?php echo $parent_job->job_number; ?>" class="<?php echo ($i++ % 2 == 1) ? "odd" : "even"; ?>">
			<td >
					<button id="add_parent[<?php echo $parent_job->job_number; ?>]" type="button" class="btn btn-default btn-xs add_parent" title="Add Parent Job" data-job_number="<?php echo $parent_job->job_number; ?>" data-job_name="<?php echo quotes_to_entities($parent_job->job['name']); ?>"><span class="glyphicon glyphicon-plus glyphicon-xs" aria-hidden="true"></span></button>
			</td>
			<td><?php echo $parent_job->job_number; ?></td>
			<td><a href="<?php echo base_url(); ?>job/recap/<?php echo $parent_job->job_number; ?>" title="View Recap"><?php echo quotes_to_entities($parent_job->job['name']); ?></a></td>
			<td><?php echo quotes_to_entities($parent_job->job['contractor']); ?></td>
			<td><?php echo $prepared_bys; ?></td>
			<td><?php echo $job_date; ?></td>
			<td>$<?php echo number_format(0,0); ?></td>
		</tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p>
    <span class="message modal_message display_none"></span>
</p>

<script>
    //copy_job_handlers();
    add_parent_modal_handlers();
    FECI.source_modal = "add_parent";
</script>