//Elements
const $childComponentsTable = $("#childComponentsTable");
const $searchResultsTable = $("#searchResultsTable");
const $deleteChildrenButton = $("#deleteChildrenButton");
const $saveChildrenButton = $("#saveChildrenButton");
const $addChildrenButton = $("#addChildrenButton");
const $searchButton = $("#searchButton");
const $searchInput = $("#searchInput");
const $searchResultsMessage = $("#searchResultsMessage");
const $childRows = $(".child-row");
const $childCheckboxes = $("[data-child-checkbox]");
const $searchResultsRows = $(".search-results-row");
const $searchResultsCheckboxes = $("[data-search-results-checkbox]");
const $childQuantityInputs = $(".childQuantity");
const $childMaterialUnitPrices = $(".childMaterialUnitPrice");
const $childFieldUnitPrices = $(".childFieldUnitPrice");


//Event handlers
$deleteChildrenButton.on("click", e => {
    e.preventDefault();

    deleteChildren();
});

$saveChildrenButton.on("click", e => {
    e.preventDefault();

    saveChildren();
});

$addChildrenButton.on("click", e => {
    e.preventDefault();

    addChildren();
});

$searchButton.on("click", e => {
    e.preventDefault();
    if ($searchInput.val() !== "") {
        search();
    }
});

$childQuantityInputs.each(function(index){
    $(this).on("change", e => {
        calculateParentPricing();
    })
});

const registerChildRowClick = (row) => {
    const $row = $(row);
    $row.on("click", function (e) {
        //Ignore if use clicks in quantity field
        if ($(e.target).closest('.childQuantity').length === 0) {
            const $checkbox = $(this).find("input:checkbox");
            //toggle checkbox
            $checkbox.prop("checked", !$checkbox.prop("checked"));
            handleButtonState("data-child-checkbox", "#deleteChildrenButton");
        }
    });
};

const registerChildCheckboxClick = (checkbox) => {
    const $checkbox = $(checkbox);
    $checkbox.on("click", function () {
        //toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-child-checkbox", "#deleteChildrenButton");
    });
};

const registerSearchResultsRowClick = (row) => {
    const $row = $(row);
    $row.on("click", function () {
        const $checkbox = $(this).find("input:checkbox");
        //toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-search-results-checkbox", "#addChildrenButton");
    });
};

const registerSearchResultsCheckboxClick = (checkbox) => {
    const $checkbox = $(checkbox);
    $checkbox.on("click", e => {
        //toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-search-results-checkbox", "#addChildrenButton");
    });
};

$childRows.each((index, childRow) => {
    registerChildRowClick(childRow);
});

$childCheckboxes.each((index, childCheckbox) => {
    registerChildCheckboxClick(childCheckbox);
});

$searchResultsRows.each((index, searchResultsRow) => {
    registerSearchResultsRowClick(searchResultsRow);
});

$searchResultsCheckboxes.each((index, searchResultsCheckbox) => {
    registerSearchResultsCheckboxClick(searchResultsCheckbox);
});

//Functions
const handleButtonState = (checkboxSelector, buttonSelector) => {
    //Button disabled state
    if ($(`[${checkboxSelector}]:checked`).length > 0) {
        $(buttonSelector).prop("disabled", false);
    } else {
        $(buttonSelector).prop("disabled", true);
    }

    //Button text
    if ($(`[${checkboxSelector}]:checked`).length <= 1) {
        buttonSelector === "#addChildrenButton" ? $(buttonSelector).text("Add Child") : $(buttonSelector).text("Delete Child");
    } else {
        buttonSelector === "#addChildrenButton" ? $(buttonSelector).text("Add Children") : $(buttonSelector).text("Delete Children");
    }
};

const addChildren = () => {
    $addChildrenButton.prop("disabled", true);
    const form = document.getElementById("searchResultsForm");
    const formData = formToJSON(form.elements);

    //AJAX request
    FECI.request = $.ajax({
        url: FECI.base_url + "product/add_children",
        type: "POST",
        dataType: "json",
        data: formData
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
        // console.log(response);
        if (response.return_code == 1) {
            //Send update message
            displayMessageBox(`${response.added.length} child component(s) added!`, "success");

            response.added.forEach(product => {
                //remove from search results table
                $(`[data-search-results-row="${product.Product_Idn}"]`).remove();

                //add to child components table
                $childComponentsTable.append(product.Html);

                //Add row click handler
                registerChildRowClick($(`[data-child-row="${product.Product_Idn}"]`));
                registerChildCheckboxClick($(`[data-child-checkbox="${product.Product_Idn}"]`));
            });

            calculateParentPricing();

        } else {
            //Error
            displayMessageBox("Error adding child component.", "danger");
        }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
        //Log the error message
        displayMessageBox("Error adding child component.", "danger");
    });

    //Always callback handler
    FECI.request.always(function() {
        //Enable inputs
        handleButtonState("data-search-results-row", "#addChildrenButton");
    });
};

const deleteChildren = () => {
    $deleteChildrenButton.prop("disabled", true);
    const form = document.getElementById("childComponentsForm")
    // const formData = formToJSON(form.elements);
    const formData = $(form).serialize();

    //AJAX request
    FECI.request = $.ajax({
        url: FECI.base_url + "product/delete_children",
        type: "POST",
        dataType: "json",
        data: formData
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
        // console.log(response);
        if (response.return_code == 1) {
            //Send update message
            displayMessageBox(`${response.deleted.length} child component(s) deleted!`, "success");

            response.deleted.forEach(product => {
                //remove from child component table
                $(`[data-child-row="${product.Product_Idn}"]`).remove();
            });
            
            calculateParentPricing();

        } else {
            //Error
            displayMessageBox("Error deleting child component.", "danger");
        }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
        //Log the error message
        displayMessageBox("Error deleting child component.", "danger");
    });

    //Always callback handler
    FECI.request.always(function() {
        //Enable inputs
        handleButtonState("data-child-row", "#deleteChildrenButton");
    });
};

const saveChildren = () => {
    $saveChildrenButton.prop("disabled", true);
    const form = document.getElementById("childComponentsForm")
    const formData = $(form).serialize();

    //AJAX request
    FECI.request = $.ajax({
        url: FECI.base_url + "product/save_children",
        type: "POST",
        dataType: "json",
        data: formData
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
        // console.log(response);
        if (response.return_code == 1) {
            //Send update message
            displayMessageBox("Child component quantity updated!", "success");

        } else {
            //Error
            displayMessageBox("Error saving child component.", "danger");
        }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
        //Log the error message
        displayMessageBox("Error saving child component.", "danger");
    });

    //Always callback handler
    FECI.request.always(function() {
        //Enable inputs
    $saveChildrenButton.prop("disabled", false);
    });
};

const search = () => {
    $searchButton.prop("disabled", true);
    $searchInput.prop("disabled", true);
    form = document.getElementById("searchForm");
    const formData = formToJSON(form.elements);

    //AJAX request
    FECI.request = $.ajax({
        url: FECI.base_url + "product/search",
        type: "POST",
        dataType: "json",
        data: formData
    });

    //Success callback handler
    FECI.request.done(function(response, textStatus, jqXHR) {
        // console.log(response);
        if (response.return_code == 1) {
            //Clear existing search results
            $("#searchResultsTable tbody").empty();

            //Display results summary
            $searchResultsMessage.text(`${response.data.length} products found.`);

            //Display new search results
            displaySearchResults(response.data);
        } else {
            //Error
            displayMessageBox("Error searching products.", "danger");
        }
    });

    //Failure callback handler
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
        //Log the error message
        displayMessageBox("Error searching products.", "danger");
    });

    //Always callback handler
    FECI.request.always(function() {
        //Enable inputs
        $searchButton.prop("disabled", false);
        $searchInput.prop("disabled", false);
    });
};

const displaySearchResults = (data) => {
    data.forEach(product => {
        //add to search results table
        $searchResultsTable.append(product.Html);

        //Add row click handler
        registerSearchResultsRowClick($(`[data-search-results-row="${product.Product_Idn}"]`));
        registerSearchResultsCheckboxClick($(`[data-search-results-checkbox="${product.Product_Idn}"]`))
    });
};

const calculateParentPricing = () => {
    let parentMaterialUnitPrice = 0;
    let parentFieldUnitPrice = 0;
    let fieldUnitPrice = 0;
    let materialUnitPrice = 0;
    let quantity = 0;

    for(let i = 0; i < $childMaterialUnitPrices.length; i++)
    {
        console.log()
        materialUnitPrice = $($childMaterialUnitPrices[i]).val()
        fieldUnitPrice = $($childFieldUnitPrices[i]).val()
        quantity = $($childQuantityInputs[i]).val()

    }

};