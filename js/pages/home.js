$(function() {
  let my_folders_table;
  let add_jobs_to_folder_table;
  let shared_folders_table;

  init();

  //Initialize tooltips
  $('[data-toggle="popover"]').popover();

  function init() {
    handlers();

    init_my_favorites();

    init_my_recents();

    init_my_folders();

    init_shared_folders();

    init_add_jobs_to_folder();

    new_folder_button_handlers();

    init_rfp_exceptions();
  }

  //Initialize functions
  function init_add_jobs_to_folder() {
    let selected = [];

    //Data table for simple job search
    add_jobs_to_folder_table = $("#AddJobsToFolderTable").DataTable({
      ajax: FECI.base_url + "home_controller/get_jobs/" + FECI.user.department_idn + "/1",
      lengthMenu: [10, 25],
      columns: [
        { data: "SelectJob" },
        {
          data: "JobName",
          render: function(data, type, row, meta) {
            const maxLength = 50;
            data =
              data.length > maxLength
                ? data.substring(0, maxLength) + "..."
                : data;

            return data;
          }
        },
        { data: "JobDate" },
        { data: "JobNumber" }
      ],
      rowCallback: function(row, data) {
        if ($.inArray(data.DT_RowId, selected) !== -1) {
          $(row).addClass("selected");
        }
      },
      columnDefs: [
        {
          targets: 0,
          orderable: false,
          searchable: false,
          className: "text-center"
        },
        {
          type: "numeric",
          targets: 3
        },
        {
          type: "date",
          targets: 2
        }
      ],
      deferRender: true
    });

    $("#AddJobsToFolderTable tbody").on("click", "tr", function() {
      var id = this.id;
      var index = $.inArray(id, selected);
      var $checkbox = $(this).find("input:checkbox");

      if (index === -1) {
        selected.push(id);
        $checkbox.prop("checked", true);
      } else {
        selected.splice(index, 1);
        $checkbox.prop("checked", false);
      }

      $(this).toggleClass("selected");
    });

    $("#AddJobs").on("click", function(e) {
      e.preventDefault();

      if ($("#AddJobsToFolderTable tr.selected").length === 0) {
        $(".modal-message").html("Please select a job");
      } else {
        add_jobs_to_folder();
      }
    });
  }

  function init_my_favorites() {
    const favorites_table = $("#MyFavoritesTable").DataTable({
      ajax: FECI.base_url + "home_controller/get_favorite_jobs",
      lengthMenu: [10, 25],
      columns: [
        { data: "JobNumber" },
        {
          data: "JobName",
          render: function(data, type, row, meta) {
            const maxLength = 50;
            const name =
              data.length > maxLength
                ? data.substring(0, maxLength) + "..."
                : data;

            data = `<a class="job-recap" href="" title="${data}">${name}</a>`;
            return data;
          }
        },
        { data: "JobDate" },
        { data: "LastUpdated" },
        {
          data: null,
          className: "text-center",
          defaultContent:
            '<button type="button" class="btn btn-default btn-xs copy-favorite-job" title="Copy Job"><span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span></button>',
          orderable: false,
          searchable: false
        }
      ],
      order: [[1, "asc"]], //default to Job Name
      createdRow: function(row, data, dataIndex) {
        $(row).attr("data-job_number", data.JobNumber);
        $(row).attr("data-job_name", data.JobName);
      }
    });

    //Click handler for job name
    favorites_table.on("click", "a.job-recap", function(e) {
      e.preventDefault();
      let job_number = $(this)
        .parents("tr")
        .data("job_number");

      window.location = FECI.base_url + "job/recap/" + job_number;
    });

    //Copy Job handlers
    favorites_table.on("click", "button.copy-favorite-job", function(e) {
      show_copy_job_modal(this);
      e.preventDefault();
    });
  }

  function init_my_recents() {
    const recents_table = $("#MyRecentsTable").DataTable({
      ajax: FECI.base_url + "home_controller/get_recent_jobs",
      lengthMenu: [10, 25],
      columns: [
        { data: "JobNumber" },
        {
          data: "JobName",
          render: function(data, type, row, meta) {
            const maxLength = 50;
            const name =
              data.length > maxLength
                ? data.substring(0, maxLength) + "..."
                : data;

            data = `<a class="job-recap" href="" title="${data}">${name}</a>`;
            return data;
          }
        },
        { data: "JobDate" },
        { data: "LastUpdated" },
        {
          data: null,
          className: "text-center",
          defaultContent:
            '<button type="button" class="btn btn-default btn-xs copy-recent-job" title="Copy Job"><span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span></button>',
          orderable: false,
          searchable: false
        }
      ],
      order: [[3, "desc"]], //default to order by last updated
      createdRow: function(row, data, dataIndex) {
        $(row).attr("data-job_number", data.JobNumber);
        $(row).attr("data-job_name", data.JobName);
      }
    });

    //Click handler for job name
    recents_table.on("click", "a.job-recap", function(e) {
      e.preventDefault();
      let job_number = $(this)
        .parents("tr")
        .data("job_number");

      window.location = FECI.base_url + "job/recap/" + job_number;
    });

    //Copy Job handlers
    recents_table.on("click", "button.copy-recent-job", function(e) {
      e.preventDefault();
      show_copy_job_modal(this);
    });
  }

  function init_my_folders() {
    my_folders_table = $("#MyFoldersTable").DataTable({
      ajax: FECI.base_url + "home_controller/get_folders_by_user",
      lengthMenu: [10, 25],
      columns: [
        {
          className: "jobs-details-control",
          orderable: false,
          data: null,
          defaultContent: ""
        },
        { data: "FolderName" },
        {
          data: null,
          defaultContent:
            '<button type="button" class="btn btn-default btn-xs add-jobs-to-folder" title="Add Jobs">' +
            '<span class="glyphicon glyphicon-plus-sign glyphicon-xs" aria-hidden="true"></span>' +
            "&nbsp;Add Jobs</button>" +
            '<button type="button" class="btn btn-default btn-xs share-folder" title="Share Job">' +
            '<span class="glyphicon glyphicon-share glyphicon-xs" aria-hidden="true"></span>' +
            "</button>" +
            '<button type="button" class="btn btn-default btn-xs delete-folder">' +
            '<span class="glyphicon glyphicon-trash glyphicon-xs" aria-hidden="true"></span>' +
            "</button>",
          orderable: false,
          searchable: false
        }
      ],
      order: [[1, "asc"]], //default to order by Folder Name
      createdRow: function(row, data, dataIndex) {
        const share_button = $(row).find("button.share-folder");

        $(row).attr("id", "MyFoldersFolder_Idn" + data.Folder_Idn);
        $(row).attr("data-folder_idn", data.Folder_Idn);
        $(row).attr("data-folder_name", data.FolderName);
        $(row).attr("data-is_public", data.IsPublic);
        $(row)
          .find("button.add-jobs-to-folder")
          .attr("id", "MyFoldersAddJobsToFolder" + data.Folder_Idn);
        share_button.attr("id", "MyFoldersShareJob" + data.Folder_Idn);
        $(row)
          .find("button.delete-folder")
          .attr("id", "MyFoldersDeleteFolder" + data.Folder_Idn);

        if (data.IsPublic == 1) {
          share_button.addClass("btn-primary");
          share_button.attr("title", "Unshare Job");
        }
      },
      rowCallback: function(row, data) {
        $(row).addClass("my-folder");
      }
    });

    my_folders_table.on("click", "button.delete-folder", function(e) {
      let $row = $(this).parents("tr");
      let folder_idn = $row.data("folder_idn");
      let folder_name = $row.data("folder_name");

      //Load dialog body
      $("#ConfirmationModal .modal-title").html("Confirm Delete Folder");
      $("#ConfirmationModal .modal-body p").html(
        "Delete folder '" + folder_name + "'?"
      );

      //Load data into FECI global object
      FECI.confirmation_modal = {
        source: "MyFoldersTable",
        action: "delete-folder",
        data: {
          Folder_Idn: folder_idn,
          FolderName: folder_name,
          Row: $row
        }
      };

      //Show modal dialog
      $("#ConfirmationModal").modal("show");
      e.preventDefault();
    });

    my_folders_table.on("click", "button.share-folder", function(e) {
      let $row = $(this).parents("tr");
      let folder_idn = $row.data("folder_idn");
      let folder_name = $row.data("folder_name");
      let is_public = $("#MyFoldersFolder_Idn" + folder_idn).data("is_public");

      //Toggle IsPublic value
      is_public = is_public == 1 ? 0 : 1;

      share_folder(folder_idn, folder_name, is_public);

      e.preventDefault();
    });

    my_folders_table.on("click", "button.add-jobs-to-folder", function(e) {
      //Refresh jobs data
      add_jobs_to_folder_table.ajax.reload();

      let $row = $(this).parents("tr");
      let folder_idn = $row.data("folder_idn");
      let folder_name = $row.data("folder_name");

      FECI.home = {
        folder_idn: folder_idn,
        source: "MyFolders"
      };

      $("#AddJobsToFolder_FolderName").html(folder_name);

      $("#AddJobsToFolderModal").modal("show");

      e.preventDefault();
    });

    // Add event listener for opening and closing details
    my_folders_table.on("click", "td.jobs-details-control", function() {
      let tr = $(this).closest("tr");
      let row = my_folders_table.row(tr);
      let row_data = {};

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass("shown");
      } else {
        // Get job data and Open this row
        row_data = row.data();

        get_jobs_by_folder(row_data.Folder_Idn).done(function(jobs) {
          row_data.Jobs = jobs;
          row.child(format(row_data)).show();
          job_row_handlers();
          tr.addClass("shown");
        });
      }
    });

    function format(d) {
      // `d` is the original data object for the row
      let job_rows = "";
      let job_data = {};
      let job_row = "";

      $.each(d.Jobs, function(index, job) {
        //Prep data to get HTML
        const maxLength = 50;
        const jobName =
          job.JobName.length > maxLength
            ? job.JobName.substring(0, maxLength) + "..."
            : job.JobName;

        job_data = {
          Folder_Idn: d.Folder_Idn,
          JobNumber: job.JobNumber,
          JobName: jobName,
          JobDate: job.JobDate,
          JobLastUpdatedDate: job.JobLastUpdatedDate
        };

        //Get job row HTML
        job_row = get_folder_job_row(job_data);

        //Build job rows for table
        job_rows = job_rows + job_row;
      });

      return (
        '<table id="MyFoldersJobsFolder_Idn' +
        d.Folder_Idn +
        '" class="table table-striped table-hover table-condensed table-bordered">' +
        "<thead>" +
        "<tr>" +
        "<th>Job Number</th>" +
        "<th>Name</th>" +
        "<th>Job Date</th>" +
        "<th>Last Updated</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        job_rows +
        "</tbody>" +
        "</table>"
      );
    }
  }

  function init_shared_folders() {
    shared_folders_table = $("#SharedFoldersTable").DataTable({
      ajax: {
        url:
          FECI.base_url +
          "home_controller/get_shared_folders/" +
          FECI.user.department_idn,
        type: "GET"
      },
      lengthMenu: [10, 25],
      columns: [
        {
          className: "jobs-details-control",
          orderable: false,
          data: null,
          defaultContent: ""
        },
        { data: "FolderName" },
        {
          data: null,
          defaultContent:
            '<button type="button" class="btn btn-default btn-xs add-jobs-to-folder" title="Add Jobs">' +
            '<span class="glyphicon glyphicon-plus-sign glyphicon-xs" aria-hidden="true"></span>' +
            "&nbsp;Add Jobs</button>" +
            '<button type="button" class="btn btn-default btn-xs share-folder" title="Share Job">' +
            '<span class="glyphicon glyphicon-share glyphicon-xs" aria-hidden="true"></span>' +
            "</button>" +
            '<button type="button" class="btn btn-default btn-xs delete-folder">' +
            '<span class="glyphicon glyphicon-trash glyphicon-xs" aria-hidden="true"></span>' +
            "</button>",
          orderable: false,
          searchable: false
        }
      ],
      order: [[1, "asc"]], //default to order by Folder Name
      createdRow: function(row, data, dataindex) {
        const share_button = $(row).find("button.share-folder");

        $(row).attr("id", "SharedFoldersFolder_Idn" + data.Folder_Idn);
        $(row).attr("data-folder_idn", data.Folder_Idn);
        $(row).attr("data-folder_name", data.FolderName);
        $(row).attr("data-is_public", data.IsPublic);
        $(row)
          .find("button.add-jobs-to-folder")
          .attr("id", "SharedFoldersAddJobsToFolder" + data.Folder_Idn);
        share_button.attr("id", "SharedFoldersShareJob" + data.Folder_Idn);
        $(row)
          .find("button.delete-folder")
          .attr("id", "SharedFoldersDeleteFolder" + data.Folder_Idn);

        if (data.IsPublic == 1) {
          share_button.addClass("btn-primary");
          share_button.attr("title", "Unshare Job");
        }
      },
      rowCallback: function(row, data) {
        $(row).addClass("my-folder");
      }
    });

    shared_folders_table.on("click", "button.delete-folder", function(e) {
      let $row = $(this).parents("tr");
      let folder_idn = $row.data("folder_idn");
      let folder_name = $row.data("folder_name");

      //Load dialog body
      $("#ConfirmationModal .modal-title").html("Confirm Delete Folder");
      $("#ConfirmationModal .modal-body p").html(
        "Delete folder '" + folder_name + "'?"
      );

      //Load data into FECI global object
      FECI.confirmation_modal = {
        source: "SharedFoldersTable",
        action: "delete-folder",
        data: {
          Folder_Idn: folder_idn,
          FolderName: folder_name,
          Row: $row
        }
      };

      //Show modal dialog
      $("#ConfirmationModal").modal("show");
      e.preventDefault();
    });

    shared_folders_table.on("click", "button.share-folder", function(e) {
      let $row = $(this).parents("tr");
      let folder_idn = $row.data("folder_idn");
      let folder_name = $row.data("folder_name");
      let is_public = $row.data("is_public");

      //Toggle IsPublic value
      is_public = is_public == 1 ? 0 : 1;

      share_folder(folder_idn, folder_name, is_public);

      e.preventDefault();
    });

    shared_folders_table.on("click", "button.add-jobs-to-folder", function(e) {
      //Refresh jobs data
      add_jobs_to_folder_table.ajax.reload();

      let $row = $(this).parents("tr");
      let folder_idn = $row.data("folder_idn");
      let folder_name = $row.data("folder_name");

      FECI.home = {
        folder_idn: folder_idn,
        source: "SharedFolders"
      };

      $("#AddJobsToFolder_FolderName").html(folder_name);

      $("#AddJobsToFolderModal").modal("show");

      e.preventDefault();
    });

    // Add event listener for opening and closing details
    shared_folders_table.on("click", "td.jobs-details-control", function() {
      let tr = $(this).closest("tr");
      let row = shared_folders_table.row(tr);
      let row_data = {};

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass("shown");
      } else {
        // Get job data and Open this row
        row_data = row.data();

        get_jobs_by_folder(row_data.Folder_Idn).done(function(jobs) {
          row_data.Jobs = jobs;
          row.child(format(row_data)).show();
          job_row_handlers();
          tr.addClass("shown");
        });
      }
    });

    function format(d) {
      // `d` is the original data object for the row
      let job_rows = "";
      let job_data = {};
      let job_row = "";

      $.each(d.Jobs, function(index, job) {
        //Prep data to get HTML
        const maxLength = 50;
        const jobName =
          job.JobName.length > maxLength
            ? job.JobName.substring(0, maxLength) + "..."
            : job.JobName;

        job_data = {
          Folder_Idn: d.Folder_Idn,
          JobNumber: job.JobNumber,
          JobName: jobName,
          JobDate: job.JobDate,
          JobLastUpdatedDate: job.JobLastUpdatedDate
        };

        //Get job row HTML
        job_row = get_folder_job_row(job_data);

        //Build job rows for table
        job_rows = job_rows + job_row;
      });

      return (
        '<table id="SharedFoldersJobsFolder_Idn' +
        d.Folder_Idn +
        '" class="table table-striped table-hover table-condensed table-bordered">' +
        "<thead>" +
        "<tr>" +
        "<th>Job Number</th>" +
        "<th>Name</th>" +
        "<th>Job Date</th>" +
        "<th>Last Updated</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        job_rows +
        "</tbody>" +
        "</table>"
      );
    }
  }

  function init_rfp_exceptions() {
    const rfp_table = $("#RFPExceptionsTable").DataTable({
      ajax: FECI.base_url + "home_controller/get_rfp_exceptions_by_user",
      lengthMenu: [10, 25],
      columns: [
        { data: "JobNumber" },
        {
          data: "JobName",
          render: function(data, type, row, meta) {
            const maxLength = 50;
            const name =
              data.length > maxLength
                ? data.substring(0, maxLength) + "..."
                : data;

            data = `<a class="job-recap" href="" title="${data}">${name}</a>`;
            return data;
          }
        },
        { data: "JobDate" },
        { data: "WorksheetName" },
        { data: "Product_Idn" },
        { data: "ProductName" },
      ],
      order: [[1, "asc"]], //default to Job Name
      createdRow: function(row, data, dataIndex) {
        $(row).attr("data-job_number", data.JobNumber);
        $(row).attr("data-job_name", data.JobName);
      }
    });

    //Click handler for job name
    rfp_table.on("click", "a.job-recap", function(e) {
      e.preventDefault();
      let job_number = $(this)
        .parents("tr")
        .data("job_number");

      window.location = FECI.base_url + "job/price_differences/" + job_number;
    });
  }

  //Handler function
  function handlers() {
    //OK button on Confirmation modal clicked
    $("#Confirmed").on("click", function(e) {
      //Delete folder
      if (FECI.confirmation_modal.action === "delete-folder") {
        delete_folder(FECI.confirmation_modal.data.Folder_Idn);
      }
    });
  }

  function new_job_folder_handlers() {
    //default focus to "Folder Name" input
    $("#NewFolderText").select();

    //Enable/Disable Save button
    $("#NewFolderText").on("keyup", function(e) {
      create_folder_button_accessibility();
    });

    //Save new folder
    $("#CreateNewFolder").on("click", function(e) {
      if ($("#NewFolderText").val() !== "") {
        create_new_folder();
      }
    });

    //Close popover on cancel
    $("#CancelNewFolder").on("click", function(e) {
      $("#NewFolderButton").click();
    });
  }

  function job_row_handlers() {
    $(".remove-job").on("click", function(e) {
      $row = $(this).closest("tr");
      remove_job($row);
    });
  }

  function new_folder_button_handlers() {
    $.ajax({
      url: FECI.baseUrl + "/home_controller/get_departments/",
      dataType: "json"
    }).done(response => {
      let departmentSelect = "";
      let departmentOptions = "";
      if (parseInt(FECI.user.department_idn) === 3) {
        $.each(response, function(index, department) {
          if (department.DepartmentId !== parseInt(3)) {
            departmentOptions += `<option value="${department.DepartmentId}">${department.Description}</option>`;
          }
        });

        departmentSelect = `
        <div class="form-group">
          <select name="NewFolderDepartment_Idn" id="NewFolderDepartment_Idn" class="input-sm">
            ${departmentOptions}
          </select>
        </div>
        `;
      }

      $("#NewFolderButton").popover({
        title: "",
        html: true,
        content: `
          <form id="NewFolderForm" class="form-inline">
            <input type="hidden" name="NewFolderUserDepartment_Idn" id="NewFolderUserDepartment_Idn" value="${FECI.user.department_idn}" />
            <div class="form-group">
              <input type="text" id="NewFolderText" name="NewFolderText" class="input-sm" placeholder="Folder name" value="" />
            </div>&nbsp;
            <div class="checkbox">
              <label><input type="checkbox" name="NewFolderIsPublic" id="NewFolderIsPublic" value="1" /> Shared? </label>
            </div>
            ${departmentSelect}
            <button type="submit" id="CreateNewFolder" class="btn btn-default btn-sm" title="Create Folder" disabled> 
              <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Create
            </button> 
            <button type="button" id="CancelNewFolder" class="btn btn-default btn-sm" title="Cancel"> 
              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Cancel
            </button>
          </form>`,
        placement: "left"
      });

      $("#NewFolderButton").on("shown.bs.popover", function(e) {
        new_job_folder_handlers();
      });
    });
  }

  function create_folder_button_accessibility() {
    if ($("#NewFolderText").val() === "") {
      $("#CreateNewFolder").attr("disabled", true);
    } else {
      $("#CreateNewFolder").attr("disabled", false);
    }
  }

  //Action funcitons
  function create_new_folder() {
    var $inputs = $("#NewFolderForm input, #NewFolderForm button");
    var serialized_data = $("#NewFolderForm").serialize();
    var new_folder_name = $("#NewFolderText").val();

    //Abort any pending Ajax Requests
    if (FECI.request) {
      FECI.request.abort();
    }

    //Disable form elements
    $inputs.prop("disabled", true);

    //AJAX request
    FECI.request = $.ajax({
      url: FECI.base_url + "home_controller/create_folder/",
      type: "POST",
      dataType: "json",
      data: serialized_data
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
      if (response.return_code == 1) {
        displayMessageBox(
          "'" + response.folder.Name + "' folder created.",
          "success"
        );

        $("#NewFolderText").val("");

        my_folders_table.row
          .add({
            FolderName: response.folder.Name,
            Folder_Idn: response.folder.Folder_Idn
          })
          .draw();
      } else {
        displayMessageBox("Error creating folder.", "danger");
      }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      displayMessageBox("Error creating folder.", "danger");
    });

    //Always callback handler
    FECI.request.always(function() {
      //Enable inputs
      $inputs.prop("disabled", false);
      create_folder_button_accessibility();
      $("#NewFolderText").select();
    });
  }

  function delete_folder(folder_idn) {
    let delete_message = "";

    //Abort any pending AJAX Requests
    if (FECI.request) {
      FECI.request.abort();
    }

    //AJAX request
    FECI.request = $.ajax({
      url: FECI.base_url + "home_controller/delete_folder/" + folder_idn,
      dataType: "json"
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
      if (response.return_code == 1) {
        //Remove folder(s)
        if (FECI.confirmation_modal.source === "SharedFoldersTable") {
          shared_folders_table
            .row(FECI.confirmation_modal.data.Row)
            .remove()
            .draw();

          //If folder exists in my folders table, remove it as well
          if (
            $("#MyFoldersTable").find("[data-folder_idn=" + folder_idn + "]")
          ) {
            my_folders_table
              .row(
                $("#MyFoldersTable").find(
                  "[data-folder_idn=" + folder_idn + "]"
                )
              )
              .remove()
              .draw();
          }
        }

        if (FECI.confirmation_modal.source === "MyFoldersTable") {
          my_folders_table
            .row(FECI.confirmation_modal.data.Row)
            .remove()
            .draw();

          //If folder exists in shared folders table, remove it as well
          if (
            $("#SharedFoldersTable").find(
              "[data-folder_idn=" + folder_idn + "]"
            )
          ) {
            shared_folders_table
              .row(
                $("#SharedFoldersTable").find(
                  "[data-folder_idn=" + folder_idn + "]"
                )
              )
              .remove()
              .draw();
          }
        }

        delete_message =
          "'" + FECI.confirmation_modal.data.FolderName + "' folder deleted!";

        displayMessageBox(delete_message, "success");
      } else {
        displayMessageBox(
          "Error deleting folder " +
            FECI.confirmation_modal.data.FolderName +
            ".",
          "danger"
        );
      }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      displayMessageBox(
        "Error deleting folder " +
          FECI.confirmation_modal.data.FolderName +
          ".",
        "danger"
      );
    });

    //Always callback handler
    FECI.request.always(function() {
      $("#ConfirmationModal").modal("hide");
    });
  }

  function share_folder(folder_idn, name, is_public) {
    //Abort any pending Ajax Requests
    if (FECI.request) {
      FECI.request.abort();
    }

    //AJAX request
    FECI.request = $.ajax({
      url: FECI.base_url + "home_controller/share_folder/",
      type: "POST",
      dataType: "json",
      data: {
        folder_idn: folder_idn,
        is_public: is_public
      }
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
      if (response.return_code == 1) {
        //Add to Shared Folders table
        if (is_public == 1) {
          //add to shared folders table
          shared_folders_table.row
            .add({
              FolderName: name,
              Folder_Idn: folder_idn,
              IsPublic: is_public
            })
            .draw();

          //If Folder is in My Folders table, toggle Share Job button
          if ($("#MyFoldersFolder_Idn" + folder_idn).length === 1) {
            //$("#MyFoldersFolder_Idn" + folder_idn).attr("data-is_public", 1);
            //$("#MyFoldersShareJob" + folder_idn).addClass("btn-primary");
            //$("#MyFoldersShareJob" + folder_idn).attr("title", "Unshare Job");

            my_folders_table.ajax.reload();
          }

          displayMessageBox("'" + name + "' folder is now shared.", "success");
        } else {
          //Remove from Shared Folders table
          shared_folders_table
            .row("#SharedFoldersFolder_Idn" + folder_idn)
            .remove()
            .draw();

          //Check to see if folder exists in My Folders Table
          if ($("#MyFoldersFolder_Idn" + folder_idn).length === 1) {
            //$("#MyFoldersFolder_Idn" + folder_idn).attr("data-is_public", 0);
            //$("#MyFoldersShareJob" + folder_idn).removeClass("btn-primary");
            //$("#MyFoldersShareJob" + folder_idn).attr("title", "Share Job");

            my_folders_table.ajax.reload();
          }

          displayMessageBox(
            "'" + name + "' folder is no longer shared.",
            "success"
          );
        }
      } else {
        displayMessageBox("Error sharing folder '" + name + "'.", "danger");
      }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      displayMessageBox("Error sharing folder '" + name + "'.", "danger");
    });
  }

  function add_jobs_to_folder() {
    var $inputs = $("#AddJobs");
    var serialized_data = $("#AddJobsToFolderForm").serialize();

    //Abort any pending Ajax Requests
    if (FECI.request) {
      FECI.request.abort();
    }

    //Disable form elements
    $inputs.prop("disabled", true);

    //AJAX request
    FECI.request = $.ajax({
      url:
        FECI.base_url +
        "home_controller/add_jobs_to_folder/" +
        FECI.home.folder_idn,
      type: "POST",
      dataType: "json",
      data: serialized_data
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
      if (response.return_code == 1) {
        const s = response.jobs.length == 1 ? "" : "s";
        let job_data = {};
        let job_row = "";
        let current_job_name = "";
        let next_job_name = "";
        let new_job_name = "";

        displayMessageBox(
          response.jobs.length + " job" + s + " added to folder.",
          "success"
        );

        //Iterate through jobs added to folder to inject into html table
        $.each(response.jobs, function(index, job) {
          let $tbody = $(
            "#" +
              FECI.home.source +
              "JobsFolder_Idn" +
              job.Folder_Idn +
              " tbody"
          );
          let $current_jobs = $(".parent-folder-idn-" + job.Folder_Idn);
          let num_jobs = $current_jobs.length;

          //Prep data to get job HTML
          job_data = {
            Folder_Idn: job.Folder_Idn,
            JobNumber: job.JobNumber,
            JobName: job.JobName,
            JobDate: job.JobDate,
            JobLastUpdatedDate: job.JobLastUpdatedDate
          };

          //Get row html
          job_row = get_folder_job_row(job_data);

          //Inject row into folder jobs table
          if (num_jobs == 0) {
            //If first job to folder

            $tbody.append(job_row);
          } else {
            //Insert row alphabetically

            //reload current_jobs to account for multiple jobs being added at a time
            $current_jobs = $(".parent-folder-idn-" + job.Folder_Idn);

            $.each($current_jobs, function(ci, current_job) {
              //Get current and next job name
              current_job_name = $(this)
                .find("td.child-job-name a")
                .text()
                .toLowerCase();
              next_job_name = $(this)
                .next("tr")
                .find("td.child-job-name a")
                .text()
                .toLowerCase();
              new_job_name = job.JobName.toLowerCase();

              if (new_job_name < current_job_name) {
                //add to top
                $(this).before(job_row);
                return false;
              } else if (
                new_job_name > current_job_name &&
                (next_job_name === "" || new_job_name < next_job_name)
              ) {
                //add in middle or bottom
                $(this).after(job_row);
                return false;
              }
            });
          }
        });

        job_row_handlers();

        $("#AddJobsToFolderModal").modal("hide");
      } else {
        displayMessageBox("Error adding jobs to folder.", "error");
      }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      displayMessageBox("Error adding jobs to folder.", "error");

      //Log the error message
      console.error("The following error occured: " + textStatus, errorThrown);
    });

    //Always callback handler
    FECI.request.always(function() {
      //Enable inputs
      $inputs.prop("disabled", false);
    });
  }

  function remove_job($row) {
    var job_number = $row.data("job-number");

    //Abort any pending Ajax Requests
    if (FECI.request) {
      FECI.request.abort();
    }

    //AJAX request
    FECI.request = $.ajax({
      url: FECI.base_url + "home_controller/remove_job/" + job_number,
      dataType: "json"
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
      if (response.return_code == 1) {
        //Remove job row
        $row.remove();

        displayMessageBox("Job removed from folder.", "success");
      } else {
        displayMessageBox("Error removing job.", "danger");
      }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      displayMessageBox("Error removing job.", "danger");
    });
  }

  function get_folder_job_row(j) {
    let html = "";

    html =
      '<tr class="parent-folder-idn-' +
      j.Folder_Idn +
      '" data-job-number="' +
      j.JobNumber +
      '">' +
      '<td class="child-job-number">' +
      j.JobNumber +
      "</td>" +
      '<td class="child-job-name"><a href="' +
      FECI.base_url +
      "job/recap/" +
      j.JobNumber +
      '">' +
      j.JobName +
      "</a></td>" +
      "<td>" +
      j.JobDate +
      "</td>" +
      "<td>" +
      j.JobLastUpdatedDate +
      '<span class="pull-right">' +
      '<button type= "button" id="RemoveJob' +
      j.JobNumber +
      '" class="btn btn-default btn-xs remove-job" >' +
      '<span class="glyphicon glyphicon-remove-sign glyphicon-xs" aria-hidden="true"></span> Remove job' +
      "</button>" +
      "</span>" +
      "</td>" +
      "</tr > ";

    return html;
  }

  function get_jobs_by_folder(folder_idn) {
    return $.ajax({
      url: FECI.base_url + "home_controller/get_jobs_by_folder/" + folder_idn,
      dataType: "json"
    });
  }
});
