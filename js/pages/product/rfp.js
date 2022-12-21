// //Elements
// const rfpRows = $("#rfpTable tr.rfpRow");

// //Event handler
// rfpRows.each(function (index) {
//     $(this).on("click", function (e) {
//         const productIdn = $(this).data("product-idn");

//         window.location = `${FECI.base_url}product/detail/edit/${productIdn}`;
//     });
// })

// initRfpDataTable();

// function initRfpDataTable() {
//     $('#rfpTable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: `${FECI.base_url}rfp/exceptions`,
//             type: "POST"
//         },
//         stateSave: true,
//         pageLength: 25,
//     });
// }
$(function() {

    // Setup - add a text input to each footer cell
    // $("#rfpTable tfoot th").each(function() {
    //     const title = $(this).text();
    
    //     //Add search input to searchable columns
    //     if ($(this).hasClass("searchable")) {
    //         $(this).html(`<input type="text" placeholder="Search ${title}" />`);
    //     }
    // });
      
    const rfpTable = $("#rfpTable").DataTable({
        ajax: {
            url: `${FECI.base_url}rfp/activeExceptions`,
        },
        dom: "Bfrtip",
        fixedColumns: true,
        columns: [
            { data: "RFPStatus", width: "50px" },
            { data: "JobNumber" },
            { data: "JobName" },
            { data: "EstimatorFullName" },
            { data: "FormattedJobDate", width: "110px" },
            { data: "WorksheetName" },
            { data: "Product_Idn" },
            { data: "ProductName"},
            { data: "Assembly" },
            { data: "FormattedCreateDate" },
            { data: "FormattedUpdateDate"},
        ],
        order: [[0, "asc"]], //default to order by RFP Statis
        stateSave: true,
        createdRow: function(row, data, dataIndex) {
            $(row).attr("data-product-idn", data.Product_Idn);
            $(row).attr("data-product-name", data.ProductName);
        },
        deferRender: true,
        initComplete: function () {
            this.api()
                .columns([0,1,2,3,6,8])
                .every(function () {
                    var column = this;
                    var select = $('<select><option value="">Show all</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
 
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                        $( select ).click( function(e) {
                            e.stopPropagation();
                      });
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });

                //Move footer below t
        },
    });

    // // Restore state
    // let state = rfpTable.state.loaded();
    // if (state) {
    //     rfpTable
    //     .columns()
    //     .eq(0)
    //     .each(function(colIdx) {
    //         var colSearch = state.columns[colIdx].search;
    //         if (colSearch.search) {
    //             $("input", rfpTable.column(colIdx).footer()).val(colSearch.search);
    //         }
    //     });

    //     rfpTable.draw();
    // }

    // Apply the search
    // rfpTable
    //     .columns()
    //     .eq(0)
    //     .each(function(colIdx) {
    //     $("input", rfpTable.column(colIdx).footer()).on("keyup change", function() {
    //         rfpTable
    //         .column(colIdx)
    //         .search(this.value)
    //         .draw();
    //     });
    // });
});