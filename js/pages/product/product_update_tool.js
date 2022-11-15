var product_update_tool = (function () {

    init();

    function init() {
        initDataTable();
        handlers();
    }

    function initDataTable() {
        $('#data').DataTable({
            processing: true,
            serverSide: true,
            // ajax:  {
            //     url: FECI.base_url + "DataTable_SSP",
            //     type: "POST",
            // },
            ajax:  {
                url: `${FECI.base_url}product_update_tool/get_product_staging`,
                type: "POST"
            },
            stateSave: true,
            pageLength: 25,
            rowCallback: function (row, data) {
                //Product Name
                if (data[1] !== data[12]) {
                    $("td:eq(1)", row).addClass("em");
                }
                //Material Unit Price
                if (parseFloat(data[2]) !== parseFloat(data[13])) {
                    $("td:eq(2)", row).addClass("em");
                }
                //Field Unit Price
                if (parseFloat(data[3]) !== parseFloat(data[14])) {
                    $("td:eq(3)", row).addClass("em");
                }
                //Shop Unit Price
                if (parseFloat(data[4]) !== parseFloat(data[15])) {
                    $("td:eq(4)", row).addClass("em");
                }
                //Design/Engineer Unit Price
                if (parseFloat(data[5]) !== parseFloat(data[16])) {
                    $("td:eq(5)", row).addClass("em");
                }
                //FECI ID
                if (data[6] !== data[17]) {
                    $("td:eq(6)", row).addClass("em");
                }
                //Manufacturer Part ID
                if (data[7] !== data[18]) {
                    $("td:eq(7)", row).addClass("em");
                }
                //RFP
                const stagingRFP = data[8] == 1 ? 1 : 0;
                const productRFP = data[19] == 1 ? 1 : 0;
                if (stagingRFP !== productRFP) {
                    $("td:eq(8)", row).addClass("em");
                }
            }
        });       
    }

    function handlers() {
        //Upload button 
        $("#upload").on("click", function (e) {
            $(this).prop('disabled', true);
            parse_data();
        });

        //Delete staging records handlers
        $("#ConfirmDeleteStagingRecords").on("click", function (e) {
            $("#DeleteStagingRecordsDialog").modal("show");
        })

        $("#DeleteStagingRecords").on("click", (e) => delete_staging_records());

        //Update products handlers
        $("#ConfirmUpdateProducts").on("click", function (e) {
            if ($("#data tbody tr").length > 1) {
                $("#UpdateProductsConfirmation").modal("show");
            } else {
                displayMessageBox("First, you need to upload a file!", "warning");
            }
        });

        $("#UpdateProducts").on("click", (e) => update_products());

        $("#UpdatePriceDateTime").on("click", (e) => update_pricedatetime());
    }

    function parse_data() {

        if (!$('#fileUpload')[0].files.length) {
            alert("Please choose at least one file to parse.");
            return enableButton();
        }

        $('#fileUpload').parse({
            config: {
                header: true,
                complete: completeFn
            },
            before: function (file, inputElem) {
                $('#fileUpload').val("");
            },
            error: function (err, file) {
                console.log("ERROR:", err, file);
                firstError = firstError || err;
                errorCount++;
            },
            complete: function () {
            }
        });
    }

    function enableButton() {
        $('#upload').prop('disabled', false);
    }

    function completeFn(results, file) {
        if (results && results.errors) {
            
            if (results.errors) {
                errorCount = results.errors.length;
                firstError = results.errors[0];
            }

            if (results.data && results.data.length > 0) {
                rowCount = results.data.length;
            }
        }

        //Save results.data to ProductStaging table
        if (results.data.length > 0 && validate_data(results)) {
            save_staging_data(results.data);
        }

        // icky hack
        setTimeout(enableButton, 100);
    }

    function save_staging_data(data) {

        //Abort any pending Ajax Requests
        if (FECI.request) {
            FECI.request.abort();
        }

        displayMessageBox("File is uploading...", "info");

        //AJAX request
        FECI.request = $.ajax({
            url: FECI.base_url + "product_update_tool/save_staging_data",
            type: "POST",
            dataType: "json",
            data: { 'json': JSON.stringify(data) }
        });

        //Success callback handler
        FECI.request.done(function (response, textStatus, jqXHR) {
            if (response.errors == 0) {

                //Redraw table
                $("#data").DataTable().destroy();
                initDataTable();

                displayMessageBox(response.inserts + " products loaded into staging.", "success");

            } else {
                displayMessageBox("Error loading staging!", "danger");
            }
        });

        //Failure callback handler 
        FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
            displayMessageBox("Fatal error loading staging:" + textStatus + " " + errorThrown, "danger");
        });
    }

    function validate_data(results) {
        var errorFields = [];

        if ($.inArray("ID", results.meta.fields) === -1) {
            errorFields.push("ID");
        }

        if ($.inArray("Material", results.meta.fields) === -1) {
            errorFields.push("Material");
        }

        if ($.inArray("Field", results.meta.fields) === -1) {
            errorFields.push("Field");
        }

        if ($.inArray("Shop", results.meta.fields) === -1) {
            errorFields.push("Shop");
        }

        if ($.inArray("Engineer", results.meta.fields) === -1) {
            errorFields.push("Engineer");
        }

        if (errorFields.length > 0) {
            displayMessageBox("File not uploaded. You are missing the following column headers: <strong>" + errorFields.join(", ") + "</strong>", "warning");
            return false;
        }

        return true;
    }

    function update_products() {
        $("#UpdateProductsConfirmation button").prop("disabled", true);

        update_product_table().then(finish_up);
    }

    function backup_product_table() {
        //Message
        $(".modal-message").html("Backing up Product table...");
        console.log("backing up products...");
        return $.ajax({
            url: FECI.base_url + "product/backup_product_table",
            type: "POST",
            dataType: "json"
        });
    }

    function update_product_table() {
        // console.log("updating...");

        //Message
        $(".modal-message").html("Updating products...");

        return $.ajax({
            url: FECI.base_url + "product_update_tool/update_products",
            type: "POST",
            dataType: "json"
        });
    }

    function finish_up(response, textStatus, jqXHR) {
        // console.log(response);

        //Enable buttons
        $("#UpdateProductsConfirmation button").prop("disabled", false);

        var s = (response.updates == 1) ? "" : "s";

        //Update message
        // $(".modal-message").html(response.updates + " product" + s + " updated!");
        $("#UpdateProductsConfirmation").modal("hide");
        displayMessageBox(response.updates + " product" + s + " updated!", "success");

    }

    function delete_staging_records() {
        //Abort any existing ajax requests
        if (FECI.request) {
            FECI.request.abort();
        }

        //Message
        $(".modal-message").html("Deleting staging products...");

        //AJAX request
        FECI.request = $.ajax({
            url: FECI.base_url + "product_update_tool/delete_staging_records",
            dataType: "json",
            type: "POST"
        });

        //Success callback handler
        FECI.request.done(function (response, textStatus, jqXHR) {
            if (response.status == 1) {
                //Clear contents of dataTable
                $("#data").DataTable().destroy();
                initDataTable();

                // $(".modal-message").html("Staging products deleted.");
                $("#DeleteStagingRecordsDialog").modal("hide");
                displayMessageBox("Staging products deleted.", "success");


            } else {
                $(".modal-message").html("Error deleting products.");
            }
        });

        //Failure callback handler 
        FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
            $(".modal-message").html("Error deleting products.");
        });
    }

    function update_pricedatetime() {

        FECI.request = $.ajax({
            url: FECI.base_url + "product_update_tool/update_price_datetime",
            dataType: "json"
        });

        FECI.request.done(function (response, textStatus, jqXHR){
            if (response.status == 1) {
                displayMessageBox("System price update date & time saved successfully!", "success");
                $("#SystemPriceUpdateDateTime").html(response.formatted_update_datetime);
            } else {
                displayMessageBox("Error updating system price date & time!", "error");
            }
        });
    }

    return {
        initDataTable: initDataTable
    };

})();