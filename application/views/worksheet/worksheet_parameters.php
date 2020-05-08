<div id="WorksheetParms" class="row hidden-print">
	<div id="LeftParms" class="col-md-6">
		<?php if ($worksheet_master['WorksheetMaster_Idn'] == 3): //Tanks and Nozzles ?>
			<div class="text-center">Manufacturer</div>
			<div class="col-md-6 col-md-offset-3">
				<select name="Manufacturer" id="Manufacturer" class="form-control input-xs">
					<option value="0">-ALL-</option>
					<?php foreach($manufacturers as $m): ?>
						<?php $selected = ($worksheet['Manufacturer_Idn'] == $m['Manufacturer_Idn']) ? 'selected="selected"' : ""; ?>
						<option value="<?php echo $m['Manufacturer_Idn']; ?>" <?php echo $selected; ?>><?php echo quotes_to_entities($m['Name']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php else: ?>
			<!-- SIZES -->
			<span><strong>Pipe Sizes</strong></span>
			<p>
				<?php 
				$size_type = ($worksheet_master['UseRadioButtonsForSizes'] == 1) ? "radio" : "checkbox"; 
				$worksheet_sizes = (isset($worksheet['WorksheetParms']['ParmIdns']['ProductSizes'])) ? $worksheet['WorksheetParms']['ParmIdns']['ProductSizes'] : array();
				$worksheet_masters_sizes = ($worksheet_master['Department_Idn'] == 1) ? $worksheet_master['WorksheetMasterSizes'] : $worksheet_master_parameters['sizes'];  
				?>
				
				<?php foreach ($worksheet_masters_sizes as $size): ?>
					<?php 
					$id = $size['ProductSize_Idn']; 
					$checked = (in_array($id, $worksheet_sizes)) ? "checked" : "";
					?>
					<input type="<?php echo $size_type; ?>" name="size_ids[]" id="size_id<?php echo $id; ?>" value="<?php echo $id; ?>" class="sizes worksheet-parm-size" data-size_value="<?php echo $size['Value']; ?>" <?php echo $checked; ?> />
					<label for="size_id<?php echo $id; ?>"><?php echo quotes_to_entities($size['Name']); ?>&quot;</label>
				<?php endforeach; ?>
			</p>
			<!-- /END SIZES -->
		<?php endif; ?>

		<?php if ($worksheet_master['WorksheetMaster_Idn'] == 9): ?>
			<?php $pipe_exposures = $this->m_reference_table->get_where("PipeExposures", "ActiveFlag = 1", "Rank ASC"); ?>
			<div class="text-center">
				<label for="PipeExposure"><strong>Pipe Exposure</strong></label>
				<select id="PipeExposure" name="PipeExposure" class="input-xs print-my-value">
					<?php foreach($pipe_exposures as $p): ?>
						<?php $selected = ($p['PipeExposure_Idn'] == $worksheet['WorksheetParms']['ParmIdns']['PipeExposure'][0]) ? ' selected="selected"' : ""; ?>
						<option value="<?php echo $p['PipeExposure_Idn']; ?>" <?php echo $selected; ?>><?php echo quotes_to_entities($p['Name']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>
	</div>

	<div id="RightParms" class="col-md-6">
		<?php if ($worksheet_master['WorksheetMaster_Idn'] == 3): //Tanks and Nozzles ?>
				
		<?php else: ?>
			<!-- PIPE TYPE -->
			<div class="row">
				<div class="col-md-2">
					<label for="pipe_type_id" class="bold"><?php $worksheet_pipe_type = (isset($worksheet['WorksheetParms']['ParmIdns']['PipeType'][0])) ? $worksheet['WorksheetParms']['ParmIdns']['PipeType'][0] : 0; ?>
					Pipe Type
					</label>
				</div>
				<div class="col-md-3">
					<select name="pipe_type_id" id="pipe_type_id" class="worksheet_parms intput-sm"><?php foreach ($worksheet_master_parameters['pipe_types'] as $pipe_type): ?><?php $selected = ($worksheet_pipe_type == $pipe_type['PipeType_Idn']) ? 'selected="selected"' : ""; ?>
						<option value="<?php echo $pipe_type['PipeType_Idn']; ?>" <?php echo $selected; ?>><?php echo quotes_to_entities($pipe_type['Name']); ?></option><?php endforeach; ?>
					</select>
				</div>
				
				<?php if ($worksheet_master['Department_Idn'] == 2): ?>
					<!-- PIPE FITTINGS RADIO GROUP -->
					<div class="col-md-7">
						<?php $worksheet_pipe_option = (isset($worksheet['WorksheetParms']['ParmIdns']['PipeOption'][0])) ? $worksheet['WorksheetParms']['ParmIdns']['PipeOption'][0] : 1; ?>
										<input type="radio" name="pipe_options" id="pipes_fittings" value="1" class="worksheet_parms" <?php echo ($worksheet_pipe_option == 1) ? "checked" : ""; ?> /> 
						<label for="pipes_fittings">Pipes &amp; Fittings</label>
										
										<input type="radio" name="pipe_options" id="pipe_only" value="0" class="worksheet_parms" <?php echo ($worksheet_pipe_option == 0) ? "checked" : ""; ?> /> 
						<label for="pipe_only">Pipe Only</label>
					</div>
					<!-- end: PIPE FITTINGS RADIO GROUP -->
				<?php endif; ?>
			</div>

			<?php if ($worksheet_master['WorksheetMaster_Idn'] != 11): //Not Underground ?>

			<!-- SCHEDULE TYPE -->
			<div class="row">
				<div class="col-md-2">
					<?php $worksheet_schedule_type = (isset($worksheet['WorksheetParms']['ParmIdns']['ScheduleType'][0])) ? $worksheet['WorksheetParms']['ParmIdns']['ScheduleType'][0] : 2; ?>
					<label for="schedule_type_id" class="bold">Schedule</label>
				</div>
				<div class="col-md-4">
					<select name="schedule_type_id" id="schedule_type_id" class="worksheet_parms intput-xs"><?php foreach ($worksheet_master_parameters['schedule_types'] as $schedule_type): ?><?php $selected = ($worksheet_schedule_type == $schedule_type['ScheduleType_Idn']) ? 'selected="selected"' : ""; ?>
						<option value="<?php echo $schedule_type['ScheduleType_Idn']; ?>" <?php echo $selected; ?>><?php echo quotes_to_entities($schedule_type['Name']); ?>
						</option><?php endforeach; ?>
					</select>
				</div>
			</div>
			<!-- END: SCHEDULE TYPE -->
			
			<?php if ($worksheet_master['Department_Idn'] == 2): ?>
				<!-- FITTING TYPE -->
				<div class="row">
					<div class="col-md-2">
						<?php $worksheet_fitting_type = (isset($worksheet['WorksheetParms']['ParmIdns']['FittingType'][0])) ? $worksheet['WorksheetParms']['ParmIdns']['FittingType'][0] : 0; ?>
						<label for="fitting" class="bold">Fitting</label>
					</div>
					<div class="col-md-4">
						<select name="fitting_id" id="fitting_id" class="worksheet_parms intput-xs"><?php foreach ($worksheet_master_parameters['fittings'] as $id => $name): ?><?php $selected = ($worksheet_fitting_type == $id) ? 'selected="selected"' : ""; ?>
							<option value="<?php echo $id; ?>" <?php echo $selected; ?>><?php echo quotes_to_entities($name); ?>
							</option><?php endforeach; ?>
						</select>
					</div>
				</div>
				<!-- END: FITTING TYPE -->

				<!-- FITTING MATERIAL -->
				<div class="row">
					<div class="col-md-2">
						<?php $worksheet_fitting_material = (isset($worksheet['WorksheetParms']['ParmIdns']['FittingMaterial'][0])) ? $worksheet['WorksheetParms']['ParmIdns']['FittingMaterial'][0] : 1; ?>
						<label for="fitting_material_id" class="bold">Fitting Material</label>
					</div>
					<div class="col-md-4">
						<select name="fitting_material_id" id="fitting_material_id" class="worksheet_parms intput-xs"><?php foreach ($worksheet_master_parameters['fitting_materials'] as $fitting_material): ?><?php $selected = ($worksheet_fitting_material == $fitting_material['ThreadedFittingType_Idn']) ? 'selected="selected"' : ""; ?>
							<option value="<?php echo $fitting_material['ThreadedFittingType_Idn']; ?>" <?php echo $selected; ?>><?php echo quotes_to_entities($fitting_material['Name']); ?>
							</option><?php endforeach; ?>
						</select>
									
					</div>
				</div>
				<!-- END: FITTING MATERIAL -->
			<?php endif; ?>
		<?php endif; ?>

        <div class="row">
				<?php if ($this->session->userdata('read_only') == 0): ?>

					<div class="col-md-12 text-center">
						<input type="button" name="load_worksheet_parameters" id="load_worksheet_parameters" class="btn btn-primary btn-xs" value="Load Worksheet Parameters">
					</div>
				<?php endif; ?>
        </div>
		<?php endif; ?>

	</div>
</div>
