//https://getbootstrap.com/docs/3.4/javascript/#tabs-examples

//Elements
const $saveProductButton = $("#saveProductButton");
const $cancelButton = $("#cancelProductButton");

//Event handlers
$saveProductButton.on("click", e => {
    e.preventDefault();
    console.log("Save product");
});

$cancelButton.on("click", e => {
    e.preventDefault();
    console.log("Cancel product");
});
