//Elements
const rfpRows = $("#rfpTable tr.rfpRow");

//Event handler
rfpRows.each(function(index) {
    $(this).on("click", function(e) {
        const productIdn = $(this).data("product-idn");

        window.location = `${FECI.base_url}product/detail/edit/${productIdn}`;
    });
})