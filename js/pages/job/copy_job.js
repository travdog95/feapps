$(function () {
	copy_job_init();
});

function copy_job_init() {
	copy_job_handlers();
}

function show_copy_job_modal(
	row = undefined,
	jobNumber = undefined,
	jobName = undefined
) {
	//Get job attributes
	let job_number = "";
	let job_name = "";
	if (row !== undefined) {
		let $row = $(row).parents("tr");
		job_number = $row.data("job_number");
		job_name = $row.data("job_name");
	} else {
		job_number = jobNumber;
		job_name = jobName;
	}

	//Load dialog body
	$("#copy_job_modal .modal-body p").html(
		"Copy Job " + job_number + " '" + job_name + "'?"
	);

	//Load data into hidden elements
	$("#copy_job_number").val(job_number);
	$("#copy_job_name").val(job_name);

	//Show modal dialog
	$("#copy_job_modal").modal("show");
}

function copy_job_handlers() {
	if ($._data($("#copy_job")[0], "events") == undefined) {
		//Event handler for copy button on copy job modal dialog
		$("#copy_job").click(function () {
			//Disable buttons
			$("button").attr("disabled", true);

			//Get job attributes
			let job_number = $("#copy_job_number").val();
			let job_name = $("#copy_job_name").val();

			//Display message
			$("#copy_job_modal .modal-body p").html(
				"Copying Job " + job_number + " '" + job_name + "'..."
			);

			//Get token for post submission
			let feapps_token = $("input[name=" + FECI.token + "]").val();

			//abort any pending request
			if (FECI.request) {
				FECI.request.abort();
			}

			FECI.request = $.ajax({
				url: FECI.base_url + "job/copy/1",
				type: "POST",
				dataType: "json",
				data: {
					job_number: job_number,
					job_name: encodeURIComponent(job_name),
					feapps_token: feapps_token,
				},
			});

			// callback handler that will be called on success
			FECI.request.done(function (response) {
				if (response !== null) {
					if (response.return_code === 1) {
						$("#copy_job_modal .modal-body p").html(
							`'${job_name}' copied successfully. Refreshing page...`
						);

						//Refresh screen
						window.location =
							FECI.base_url + "job/recap/" + response.new_job_idn;
					} else {
						$("#copy_job_modal .modal-body p").html(
							`Error copying Job ${job_number} '${job_name}'.`
						);
					}
				}
				//Enable buttons
				$("button").attr("disabled", false);
			});

			// callback handler that will be called on failure
			FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
				// log the error to the console
				console.log("The following error occured: " + textStatus, errorThrown);
			});
		});
	}
}
