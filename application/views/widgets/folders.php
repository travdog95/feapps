<h2>
	<?php echo quotes_to_entities($title); ?> 

	<?php if ($table_id == "MyFoldersTable"): ?>
	<span class="pull-right new-folder-wrapper">
		<button id="NewFolderButton" type="button" class="btn btn-primary btn-md new-folder">New Folder</button>
	</span>
	<?php endif; ?>
</h2>
<table class="table table-striped table-hover table-condensed table-bordered folders display nowrap responsive" id="<?php echo $table_id; ?>" style="width: 100%">
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
</table>