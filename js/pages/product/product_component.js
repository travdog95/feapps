//Elements
const $deleteChildrenButton = $("#deleteChildrenButton");
const $addChildrenButton = $("#addChildrenButton");
const $searchButton = $("#searchButton");
const $childRows = $(".child-row");
const $searchResultsRows = $(".search-results-row");

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
    $row.on("click", e => {
        console.log("child row clicked", $row.data("product-idn"))
    });
});

$searchResultsRows.each(function() {
    const $row = $(this);
    $row.on("click", e => {
        console.log("search results row clicked", $row.data("product-idn"))
    });
});

//Functions
const addChildren = async () => {
    console.log("Add Children button clicked");
};

const deleteChildren = async () => {
    console.log("Delete Children button clicked");
};

const search = async () => {
    console.log("Search button clicked");
}