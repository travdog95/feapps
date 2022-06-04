//https://getbootstrap.com/docs/3.4/javascript/#tabs-examples

//Elements
const $saveProductButton = $("#saveProductButton");
const $cancelButton = $("#cancelProductButton");

//Event handlers
$saveProductButton.on("click", e => {
    e.preventDefault();

    //Validation

    //Save product
    save_product();
});

$cancelButton.on("click", e => {
    e.preventDefault();
    console.log("Cancel product");
});


const save_product = () => {
    const forms = document.querySelectorAll(".product-tab");
    const $productDetailUI = $("#productDetailUI");
    const formElements = $productDetailUI.find("input, select, button");

    let formData = {};

    formElements.prop("disabled", true);
    forms.forEach(form => {
        formData = {...formData, ...formToJSON(form.elements)}
    });

    console.log(formData);

      //AJAX request
    FECI.request = $.ajax({
        url: FECI.base_url + "product/save_product",
        type: "POST",
        dataType: "json",
        data: formData
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
        if (response.return_code == 1) {
            //Send update message
            displayMessageBox("Product saved!", "success");
        } else {
        //Error
        displayMessageBox("Error saving product.", "danger");
        }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
        //Log the error message
        displayMessageBox("Error saving product.", "danger");
    });

    //Always callback handler
    FECI.request.always(function() {
        //Enable inputs
        formElements.prop("disabled", false);

    });

}