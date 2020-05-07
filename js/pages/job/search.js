// JavaScript Document
$(function() {
  //Set global variables
  FECI.source_page = "search";
  FECI.source_modal = "";

  // Setup - add a text input to each footer cell
  $("#JobSearchResults tfoot th").each(function() {
    const title = $(this).text();
    //Exclude copy column
    if (title != "") {
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    }
  });

  //Initialize table
  const table = $("#JobSearchResults").DataTable({
    ajax: {
      url: FECI.base_url + "job/get_jobs",
      data: {
        department_idn: FECI.user.department_idn
      }
    },
    columns: [
      {
        data: null,
        defaultContent:
          '<input name="delete_job[]" type="checkbox" class="delete-job" />',
        orderable: false,
        searchable: false
      },
      {
        data: null,
        className: "text-center",
        defaultContent:
          '<button type="button" class="btn btn-default btn-xs copy-job" title="Copy Job"><span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span></button>',
        orderable: false,
        searchable: false
      },
      { data: "job_number" },
      {
        data: "name",
        render: function(data, type, row, meta) {
          let link = "";
          const maxLength = 50;
          const name =
            data.length > maxLength
              ? data.substring(0, maxLength) + "..."
              : data;

          link = `<a class="job-recap" href="" title="${data}">${name}</a>`;
          return link;
        }
      },
      { data: "folder_name" },
      { data: "department" },
      { data: "contractor" },
      { data: "prepared_by" },
      { data: "job_date" },
      { data: "updated_date" },
      { data: "updated_by" }
    ],
    order: [[3, "asc"]], //default to order by name
    stateSave: true,
    createdRow: function(row, data, dataIndex) {
      $(row).attr("data-job_number", data.job_number);
      $(row).attr("data-job_name", data.name);
    },
    deferRender: true
    // responsive: true
  });

  // Restore state
  let state = table.state.loaded();
  if (state) {
    table
      .columns()
      .eq(0)
      .each(function(colIdx) {
        var colSearch = state.columns[colIdx].search;
        if (colSearch.search) {
          $("input", table.column(colIdx).footer()).val(colSearch.search);
        }
      });

    table.draw();
  }

  // Apply the search
  table
    .columns()
    .eq(0)
    .each(function(colIdx) {
      $("input", table.column(colIdx).footer()).on("keyup change", function() {
        table
          .column(colIdx)
          .search(this.value)
          .draw();
      });
    });

  //Click handler for job name
  table.on("click", "a.job-recap", function(e) {
    e.preventDefault();
    let job_number = $(this)
      .parents("tr")
      .data("job_number");

    window.location = FECI.base_url + "job/recap/" + job_number;
  });

  //Delete job(s) handlers

  //Check to see if element is already bound to event
  if ($._data($(".delete_jobs")[0], "events") == undefined) {
    //Event handler for delete button on copy job modal dialog
    $(".delete_jobs").click(function() {
      let jobs_checked = $(".delete-job:checked").length;

      if (jobs_checked > 0) {
        //Load dialog body
        $("#delete_jobs_modal .modal-body p").html("Delete selected jobs?");

        //Show modal dialog
        $("#delete_jobs_modal").modal("show");
      } else {
        displayMessageBox("No jobs are selected for deletion!");
      }
    });
  }

  if ($._data($("#delete_jobs")[0], "events") == undefined) {
    //Event handler for copy button on copy job modal dialog
    $("#delete_jobs").click(function() {
      //Get token for post submission
      let feapps_token = $("input[name=" + FECI.token + "]").val();
      let job_data = [];

      //Get checked job numbers
      $("input.delete-job:checked").each(function(i, el) {
        job_data[i] = $(el)
          .closest("tr")
          .data("job_number");
      });

      //abort any pending request
      if (FECI.request) {
        FECI.request.abort();
      }

      FECI.request = $.ajax({
        url: FECI.base_url + "job/delete/1",
        type: "POST",
        dataType: "json",
        data: { job_numbers: job_data }
      });

      // callback handler that will be called on success
      FECI.request.done(function(response) {
        if (response !== null) {
          if (response.return_code === 1) {
            //Job(s) deleted successfully
            displayMessageBox("Job(s) deleted successfully.", 1);

            var plural = "";
            plural = response.num_jobs_deleted > 1 ? "s" : "";

            switch (FECI.source_modal) {
              case "child_jobs":
                //Close modal
                $("#delete_jobs_modal").hide();

                //Remove tr element from Child Jobs modal
                $.each(response.job_numbers_deleted, function(i, job_number) {
                  $("#child" + job_number).remove();
                });

                $(".modal_message")
                  .text("Job" + plural + " deleted.")
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
            $("#delete_jobs_modal .modal-body p").html(
              "Error deleting job(s)."
            );
          }
        }
      });

      // callback handler that will be called on failure
      FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
        // log the error to the console
        console.error(
          "The following error occured: " + textStatus,
          errorThrown
        );
      });
    });
  }

  //Copy Job handlers
  table.on("click", "button.copy-job", function(e) {
    show_copy_job_modal(this);
    e.preventDefault();
  });
});
