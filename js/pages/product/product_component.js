//Elements
const $saveProductButton = $("#saveProductButton");
const $cancelButton = $("#cancelProductButton");

//Event handlers
$saveProductButton.on("click", e => {
    e.preventDefault();

    //Validation
    if (validateForm()) {
    //Save product
        saveProduct();
    } 
});

$cancelButton.on("click", e => {
    e.preventDefault();
    //go back to product maintenance
    window.location = `${FECI.base_url}product/`;
});

//Functions
const validateForm = () => {
    let isValid = false;
    let errorMessage = "";

    if (!isValid) {
        displayMessageBox(errorMessage, "danger");
    }

    return isValid;
}

const saveProduct = async () => {
    const forms = document.querySelectorAll(".product-tab");
    const $productDetailUI = $("#productDetailUI");
    const formElements = $productDetailUI.find("input, select, button");

    let formData = {};

    formElements.prop("disabled", true);
    forms.forEach(form => {
        formData = {...formData, ...formToJSON(form.elements)}
    });

    // console.log(formData);

      //AJAX request
    FECI.request = $.ajax({
        url: FECI.base_url + "product/save_product",
        type: "POST",
        dataType: "json",
        data: formData
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
        // console.log(response);
        if (response.return_code == 1) {
            //Send update message
            displayMessageBox("Product saved!", "success");

            if (response.mode == "add" || response.mode == "copy") {
                window.location = `${FECI.base_url}product?message=Product%20(${response.NewProduct_Idn})%20added.&message_type=1`;
            }
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
        removeErrors();
    });
}