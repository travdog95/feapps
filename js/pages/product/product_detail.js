//https://getbootstrap.com/docs/3.4/javascript/#tabs-examples

const filters = {
    "Department_Idn": {
        table: "WorksheetMasters",
        key: "WorksheetMaster_Idn",
    },
    "WorksheetMaster_Idn": {
        table: "v_WorksheetMasterCategories",
        key: "WorksheetCategory_Idn",
    },
    "WorksheetCategory_Idn": {
        table: "Fittings",
        key: "Fitting_Idn",
    },
    "HangerType_Idn": {
        table: "HangerSubTypes",
        key: "HangerSubType_Idn",
    }
};


//Elements
const $saveProductButton = $("#saveProductButton");
const $cancelButton = $("#cancelProductButton");
const $parentSelectElements = $(".filter");
const $requredElements = $("select, input, textarea").filter('[required]');

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
    console.log("Cancel product");
});

//Select element filters
$parentSelectElements.each(function () {
    $(this).on("change", e => {
        filterSelect(e.target.id, e.target.value)
    });  
});

$requredElements.each(function() {
    const elem = this;
    $(elem).on("change", e => {
        validateElement(elem);
    });  
});

//Functions
const validateForm = () => {
    let isValid = true;
    let errorMessage = "<p>The following validation error(s) exist:</p>";

    $requredElements.each(function() {
        const elemValidation = validateElement(this);

        if (!elemValidation.isValid) {
            isValid = false;
            errorMessage += elemValidation.errorMessage;
        }
    });

    if (!isValid) {
        displayMessageBox(errorMessage, "danger");
    }

    return isValid;
}

const validateElement = (element) => {
    let isValid = true;
    let errorMessage = "";

    const fieldType = element.type;
    const value = $(element).val();
    const $formGroupElement = $(element).parents(".form-group");
    const labelName = $(`label[for="${element.id}"]`).text();

    switch (fieldType) {
        case "text":
            break;
        case "select-one":
            if (value == 0 || value == "" || value == null) {
                isValid = false;
                $formGroupElement.addClass("has-error");
                errorMessage += `<p>${labelName}</p>`
            } else {
                $formGroupElement.removeClass("has-error");
            }
            break;
        case "textarea":
            break;
    }

    return { isValid, errorMessage };
}

const filterSelect = (elementId, elementValue) => {
    elementValue = parseInt(elementValue);
    const $targetSelect = $(`#${filters[elementId].key}`);
    //Empty target select
    $targetSelect.empty();

    if (elementValue !== 0) {
        //Load child select with filtered options
        loadSelectOptions($targetSelect, elementId, elementValue);
    }
};

const loadSelectOptions = async ($selectElement, filterBy, filterByValue) => {
    const tableName = filters[filterBy].table;
    const tableId = filters[filterBy].key;

    const response = await fetch(`${FECI.base_url}utils/get_options/${tableName}/${tableId}/${filterBy}/${filterByValue}`);
  
    if (!response.ok) {
        throw new Error(`Could not fetch ${tableName}`);
    }

    const options = await response.json();

    // console.log(options)
    $selectElement.append($("<option></option>").attr("value", 0).text("PLEASE SELECT"));

    options.forEach(option => {
        $selectElement.append($("<option></option>").attr("value", option.value).text(option.name));
    });
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
        console.log(response);
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