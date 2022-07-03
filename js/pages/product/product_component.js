//Elements
const $deleteChildrenButton = $("#deleteChildrenButton");
const $addChildrenButton = $("#addChildrenButton");
const $searchButton = $("#searchButton");
const $childRows = $(".child-row");
const $childCheckboxes = $("[data-child-checkbox]");
const $searchResultsRows = $(".search-results-row");
const $searchResultsCheckboxes = $("[data-search-results-checkbox]");

//Event handlers
$deleteChildrenButton.on("click", e => {
    e.preventDefault();

    deleteChildren();
});

$addChildrenButton.on("click", e => {
    e.preventDefault();

    addChildren();
});

$searchButton.on("click", e => {
    e.preventDefault();

    search();
});

$childRows.each(function() {
    const $row = $(this);
    const $checkbox = $row.find("input:checkbox");
    $row.on("click", e => {
        //toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-child-checkbox", "#deleteChildrenButton");
    });
});

$childCheckboxes.each(function() {
    const $checkbox = $(this);
    $checkbox.on("click", e => {
        //toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-child-checkbox", "#deleteChildrenButton");
    });
});

$searchResultsRows.each(function() {
    const $row = $(this);
    const $checkbox = $row.find("input:checkbox");
    $row.on("click", e => {
        //Toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-search-results-checkbox", "#addChildrenButton");
    });
});

$searchResultsCheckboxes.each(function() {
    const $checkbox = $(this);
    $checkbox.on("click", e => {
        //toggle checkbox
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        handleButtonState("data-search-results-checkbox", "#addChildrenButton");
    });
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
}

const addChildren = async () => {
    console.log("Add Children button clicked");
    $addChildrenButton.prop("disabled", true);
    const form = document.getElementById("searchResultsForm")
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
            displayMessageBox("Child component added!", "success");
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
        $addChildrenButton.prop("disabled", false);
    });
};

const deleteChildren = () => {
    $deleteChildrenButton.prop("disabled", true);
    const form = document.getElementById("childComponentsForm")
    const formData = formToJSON(form.elements);

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
            displayMessageBox("Child component deleted!", "success");
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
        $deleteChildrenButton.prop("disabled", false);
    });
};

const search = async () => {
    console.log("Search button clicked");
}