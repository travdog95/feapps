let wa = (function() {
    let debug = false;
    const self = this;

    //Cache DOM
    //const $cartModal = $("#cart_modal");

    //Initialize
    _init();

    function _init() {
        _handlers();
    }

    function _handlers() {

        if (FECI.copy_worksheet.includes(FECI.worksheet_master.WorksheetMaster_Idn)) {
            //Search Jobs button on Add Worksheet modal
            $("#SearchJobs").on("click", function (e) {

                $("#SelectJobModal").modal("show");
            })

            //Data table for simple job search
            const table = $("#SelectJobTable").DataTable({
                "ajax": FECI.base_url + "home_controller/get_jobs/" + FECI.job.department_idn,
                "lengthMenu": [10, 25],
                "columns": [
                    { "data": "JobName" },
                    { "data": "JobDate" },
                    { "data": "JobNumber" }
                ],
                order: [[0, 'asc']], //default to order by name
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-job_number', data.JobNumber);
                    $(row).attr('data-job_name', data.JobName);
                }

            });

            $('#SelectJobTable tbody').on('click', 'tr', function () {
                const $checkbox = $(this).find("input:checkbox");

                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $("#SelectJob").on("click", function (e) {
                e.preventDefault();

                const selected_job_number = table.$("tr.selected").data("job_number");
                const selected_job_name = TKO_decode_entities(table.$("tr.selected").data("job_name"));

                if ($("#SelectJobTable tr.selected").length === 0) {
                    $(".modal-message").html("Please select a job");
                } else {
                    //Add selected job number to CopyToJob field
                    $("#CopyFromJob").val(selected_job_number);
                    $("#CopyJobName").text(selected_job_name);

                    //Close SelectJobModal
                    $("#SelectJobModal").modal("hide");

                    //remove has-error
                    $("#CopyFromJobDiv").removeClass("has-error");

                    load_worksheets();
                }
            });

            $("#CopyFromJob").on("change", function (e) {
                let job_number = $(this).val();

                if (job_number == "") {
                    $("#CopyJobName").text('\xa0');
                    $("#CopyFromJobWorksheet").empty();
                } else {
                    check_job_number(job_number).then(update_message);
                }
            });

            $("#CopyWorksheetCheckbox").on("click", function (e) {
                const worksheet_master_idn = $("#AddWorksheetModal_ChildWorksheetMaster_Idn").val();
                const is_checked = $(this).prop("checked");

                //Toggle copy from job fields
                if (is_checked) {
                    $(".copy-from-job").show();
                    $(".AddWorksheetModal_Action").text("Copy");

                } else {
                    $(".copy-from-job").hide();
                    $(".AddWorksheetModal_Action").text("Add");
                }

                //Default current job, if copy worksheet is checked and Copy From Job is empty
                if (is_checked && $("#CopyFromJob").val() == "") {
                    $("#CopyFromJob").val(FECI.job.job_number);
                    $("#CopyFromJob").trigger("change");
                } else {
                    if (is_checked) {
                        load_worksheets();
                    }
                }

                //If copying branchline worksheet
                if (worksheet_master_idn == 9) {
                    if (is_checked) {
                        $(".copy-from-job-branch-line").hide();
                    } else {
                        $(".copy-from-job-branch-line").show();
                    }
                }
            });
        }

        function check_job_number(job_number) {

            return $.ajax({
                url: FECI.base_url + "job/check_job_number/" + job_number,
                type: "GET",
                dataType: "json"
            });

        }

        function update_message(response, textStatus, jqXHR) {

            let message = "";

            if (response.return_code == 1) {
                $("#CopyFromJobDiv").removeClass("has-error");
                message = response.job_name;

                load_worksheets();
    
            } else {
                $("#CopyFromJobDiv").addClass("has-error");
                $("#CopyFromJobWorksheet").empty();
                message = "Not a valid Job Number!";
            }

            $("#CopyJobName").text(message);
        }

        function load_worksheets() {
            let form = $("#AddWorksheetForm");
            let data = $(form).serialize();
            let message = "";

            FECI.request = $.ajax({
                url: FECI.base_url + "worksheet_actions_controller/get_worksheets/",
                type: "POST",
                dataType: "json",
                data: data
            });

            FECI.request.done(function (response, textStatus, jqXHR) {

                if (response.return_code == 1) {

                    message = "";
                    $("#CopyFromJobWorksheet").empty();

                    $.each(response.worksheets, function (index, w) {
                        worksheet_name = w.Name;
                        worksheet_idn = w.Worksheet_Idn;

                        //Add worksheet option to select element
                        $("#CopyFromJobWorksheet").append($("<option></option>").val(worksheet_idn).html(worksheet_name));
                    });

                } else {
                    message = "Error loading worksheets.";
                }
            });

            //Failure callback handler 
            FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
                message = "Failure loading worksheets.";
            });

            //Always callback handler
            FECI.request.always(function () {
                $(".modal-message").text(message);
            });

        }
    }

    return {
        //shopping_cart_handlers: shopping_cart_handlers,
        //cart_filter: cart_filter,
        //hanger_usability: hanger_usability
    };
})();
