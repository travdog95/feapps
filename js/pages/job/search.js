// JavaScript Document
$(function () {
	//Set global variables
	FECI.source_page = "search";
	FECI.source_modal = "";

	const url = new URL(window.location.href);
	const segments = url.pathname.split("/");
	const filter = segments[3] ? segments[3] : "active";

	$(".filter-search").on("click", function (e) {
		const id = e.target.id;
		if (id == "filterSearchActive") {
			window.location.href = FECI.base_url + "job/search/active";
		}

		if (id === "filterSearchArchived") {
			window.location.href = FECI.base_url + "job/search/archived";
		}

		if (id === "filterSearchDeleted") {
			window.location.href = FECI.base_url + "job/search/deleted";
		}
	});

	// Setup - add a text input to each footer cell
	$("#JobSearchResults tfoot th").each(function () {
		const title = $(this).text();;
		//Exclude copy column
		if (title != "") {
			$(this).html('<input type="text" placeholder="Search ' + title + '" />');
		}
	});

	//Initialize table
	const table = $("#JobSearchResults").DataTable({
		processing: true,
		serverSide: true,
		// saveState: true,
		pageLength: 25,
		ajax: {
			url: FECI.base_url + "job/get_jobs",
			type: "POST",
			data: {
				department_idn: FECI.user.department_idn,
				filter: filter,
			},
		},
		columns: [
			{
				data: null,
				className: "text-center",
				render: function (data, type, row, meta) {
					return `<input name="delete_job[]" type="checkbox" class="delete-job" data-job_number="${row.JobNumber}" />`;
				},
				orderable: false,
				searchable: false,
			},
			{
				data: null,
				className: "text-center",
				render: function (data, type, row, meta) {
					return `<button type="button" class="btn btn-default btn-xs copy-job" data-job_number="${row.JobNumber}" data-job_name="${row.JobName}" title="Copy Job"><span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span></button>`;
				},
				orderable: false,
				searchable: false,
			},
			{ data: "JobNumber" },
			{
				data: "JobName",
				render: function (data, type, row, meta) {
					let link = "";
					const maxLength = 50;
					const name =
						data.length > maxLength
							? data.substring(0, maxLength) + "..."
							: data;
					link = `<a class="job-recap" href="${
						FECI.base_url + "job/recap/" + row.JobNumber
					}" title="${data}">${name}</a>`;
					return link;
				},
			},
			{ data: "FolderName" },
			{ data: "DepartmentName" },
			{ data: "Contractor" },
			{ data: "CreatedByFirstName" },
			{ data: "JobDate" },
			{ data: "UpdateDateTime" },
			{ data: "UpdatedByFirstName" },
			{ data: "JobStatus" },
		],
		order: [[3, "asc"]], //default to order by name
		// stateSave: true,
		// createdRow: function (row, data, dataIndex) {
		// 	$(row).attr("data-job_number", data.job_number);
		// 	$(row).attr("data-job_name", data.name);
		// },
		// responsive: true
	});

	// // Restore state
	// let state = table.state.loaded();
	// if (state) {
	// 	table
	// 		.columns()
	// 		.eq(0)
	// 		.each(function (colIdx) {
	// 			var colSearch = state.columns[colIdx].search;
	// 			if (colSearch.search) {
	// 				$("input", table.column(colIdx).footer()).val(colSearch.search);
	// 			}
	// 		});

	// 	table.draw();
	// }

	// // Apply the search
	// table
	// 	.columns()
	// 	.eq(0)
	// 	.each(function (colIdx) {
	// 		$("input", table.column(colIdx).footer()).on("keyup change", function () {
	// 			table.column(colIdx).search(this.value).draw();
	// 		});
	// 	});

	//Delete job(s) handlers

	//Check to see if element is already bound to event
	if ($._data($(".delete_jobs")[0], "events") == undefined) {
		//Event handler for delete button on copy job modal dialog
		$(".delete_jobs").click(function () {
			let jobs_checked = $(".delete-job:checked").length;

			if (jobs_checked > 0) {
				$("#delete_jobs_modal .modal-header .modal-title").html("Delete Jobs");

				//Load dialog body
				$("#delete_jobs_modal .modal-body p").html("Delete selected jobs?");

				//Button text
				$("#delete_jobs").html("Delete");

				//Show modal dialog
				$("#delete_jobs_modal").modal("show");
			} else {
				displayMessageBox("No jobs are selected for deletion!");
			}
		});
	}

	if ($._data($("#delete_jobs")[0], "events") == undefined) {
		//Event handler for copy button on copy job modal dialog
		$("#delete_jobs").click(function () {
			//Get token for post submission
			let job_data = [];

			//Get checked job numbers
			$("input.delete-job:checked").each(function (i, el) {
				// job_data[i] = $(el).closest("tr").data("job_number");
				job_data[i] = $(el).data("job_number");
			});

			//abort any pending request
			if (FECI.request) {
				FECI.request.abort();
			}

			const action = $(this).html() === "Delete" ? "delete"
				: $(this).html() === "Archive" ? "archive"
				: "unarchive";
			const messageText = $(this).html() === "Delete" ? "delete"
				: $(this).html() === "Archive" ? "archive"
				: "unarchived";

			FECI.request = $.ajax({
				url: `${FECI.base_url}job/${action}/1`,
				type: "POST",
				dataType: "json",
				data: { job_numbers: job_data },
			});

			// callback handler that will be called on success
			FECI.request.done(function (response) {
				if (response !== null) {
					if (response.return_code === 1) {
						//Job(s) deleted successfully
						displayMessageBox(`Job(s) ${messageText} successfully.`, 1);

						var plural = "";
						plural = response.num_jobs_deleted > 1 ? "s" : "";

						switch (FECI.source_modal) {
							case "child_jobs":
								//Close modal
								$("#delete_jobs_modal").hide();

								//Remove tr element from Child Jobs modal
								$.each(response.job_numbers_deleted, function (i, job_number) {
									$("#child" + job_number).remove();
								});

								$(".modal_message")
									.text(`Job${plural} ${messageText}.`)
									.addClass("bg-info")
									.show();
								break;
							default:
								//Go to Job Search page
								table
									.row($("input.delete-job:checked").closest("tr"))
									.remove()
									.draw(false);
								$("#delete_jobs_modal").modal("hide");
								break;
						}
					} else {
						$("#delete_jobs_modal .modal-body p").html(`Error saving job(s).`);
					}
				}
			});

			// callback handler that will be called on failure
			FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
				// log the error to the console
				console.error(
					"The following error occured: " + textStatus,
					errorThrown
				);
			});
		});
	}

	//Copy Job handlers
	table.on("click", "button.copy-job", function (e) {
		show_copy_job_modal(
			undefined,
			$(this).data("job_number"),
			$(this).data("job_name")
		);
		e.preventDefault();
	});

	//Archive jobs
	$("#archiveJobs").on("click", function () {
		let jobs_checked = $(".delete-job:checked").length;

		if (jobs_checked > 0) {
			$("#delete_jobs_modal .modal-header .modal-title").html("Archive Jobs");

			//Load dialog body
			$("#delete_jobs_modal .modal-body p").html("Archive selected jobs?");

			//Button text
			$("#delete_jobs").html("Archive");

			//Show modal dialog
			$("#delete_jobs_modal").modal("show");
		} else {
			displayMessageBox("No jobs are selected!");
		}
	});

	//Unarchive jobs
	$("#unarchiveJobs").on("click", function () {
		let jobs_checked = $(".delete-job:checked").length;

		if (jobs_checked > 0) {
			$("#delete_jobs_modal .modal-header .modal-title").html("Unarchive Jobs");

			//Load dialog body
			$("#delete_jobs_modal .modal-body p").html("Unarchive selected jobs?");

			//Button text
			$("#delete_jobs").html("Unarchive");

			//Show modal dialog
			$("#delete_jobs_modal").modal("show");
		} else {
			displayMessageBox("No jobs are selected!");
		}
	});
});
