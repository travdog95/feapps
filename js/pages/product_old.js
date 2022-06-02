product_init();


function product_init() {
    //Fire pumps
    $("#RefreshProductsConfirmation").modal({
        show: false,
        backdrop: "static",
        keyboard: false
    });

    product_handlers();
}

function product_handlers() {
    $("#InitiateRefreshProducts").on("click", function (e) {
        e.preventDefault();

        $("#RefreshProductsConfirmation").modal("show");
    });

    $("#RefreshProducts").on("click", function (e) {
        refresh_products();
    });
}

function refresh_products() {

    backup_product_table().then(copy_products).then(finish_up);
}

function backup_product_table() {
    //Disable buttons
    $("#RefreshProductsConfirmation button").prop("disabled", true);

    //Message
    $(".modal-message").html("Backing up Product table...");

    return $.ajax({
        url: FECI.base_url + "product/backup_product_table",
        type: "POST",
        dataType: "json"
    });
}

function copy_products(response, textStatus, jqXHR) {
    //console.log(response);
    if (response.status == 0) {
        $(".modal-message").html("Error backing up Product table.");
        console.log("Error");
    } else {
        console.log("copying");
        //Message
        $(".modal-message").html("Copying products...");

        return $.ajax({
            url: FECI.base_url + "product/copy_products",
            type: "POST",
            dataType: "json"
        });
        //return response;
    }
}

function finish_up(response, textStatus, jqXHR) {
    //Enable buttons
    $("#RefreshProductsConfirmation button").prop("disabled", false);

    //Update message
    $(".modal-message").html("Process completed!");
}
