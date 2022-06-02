// JavaScript Document
$(function() {
    //Set global variables
    FECI.source_page = "search";
    FECI.source_modal = "";
  
    // Setup - add a text input to each footer cell
    $("#productsTable tfoot th").each(function() {
      const title = $(this).text();
      //Exclude copy column
      if (title != "") {
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      }
    });
  
    //Initialize table
    const table = $("#productsTable").DataTable({
      ajax: {
        url: FECI.base_url + "product/get_products",
        data: {
          department_idn: FECI.user.department_idn
        }
      },
      columns: [
        {
          data: null,
          className: "text-center",
          defaultContent:
            `
              <button type="button" class="btn btn-default btn-xs edit-product" title="Edit Product"><span class="glyphicon glyphicon-edit glyphicon-xs" aria-hidden="true"></span></button>
              <button type="button" class="btn btn-default btn-xs copy-product" title="Copy Product"><span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span></button>
            `,
          orderable: false,
          searchable: false
        },
        { data: "Product_Idn" },
        { data: "Department" },
        { data: "IsParent" },
        { data: "WorksheetMaster" },
        { data: "WorksheetCategory" },
        { data: "Name" },
        { data: "Manufacturer" },
        { data: "MaterialUnitPrice" },
        { data: "FieldUnitPrice" },
        { data: "ShopUnitPrice" },
        { data: "EngineerUnitPrice" },
      ],
      order: [[2, "asc"]], //default to order by Worksheet Master
      stateSave: true,
      createdRow: function(row, data, dataIndex) {
        $(row).attr("data-product-idn", data.Product_Idn);
        $(row).attr("data-product-name", data.Name);
      },
      deferRender: true
      // responsive: true
    });
  
    // Restore state
    let state = table.state.loaded();
    if (state) {
      table
        .columns()
        .eq(0)
        .each(function(colIdx) {
          var colSearch = state.columns[colIdx].search;
          if (colSearch.search) {
            $("input", table.column(colIdx).footer()).val(colSearch.search);
          }
        });
  
      table.draw();
    }
  
    // Apply the search
    table
      .columns()
      .eq(0)
      .each(function(colIdx) {
        $("input", table.column(colIdx).footer()).on("keyup change", function() {
          table
            .column(colIdx)
            .search(this.value)
            .draw();
        });
      });
  
    //Copy product handler
    const handleCopyProduct = (e) => {
      const confirmedButton = document.querySelector("#ConfirmationModal #Confirmed");

      console.log(FECI.confirmation_modal.data.productIdn)
      confirmedButton.removeEventListener("click", handleCopyProduct);

    }

    const show_copy_product_modal = (row) => {
      const $row = $(row).parents("tr");
      const productIdn = $row.data("product-idn");
      const productName = $row.data("product-name");
      const modalTitle = $("#ConfirmationModal .modal-title");
      const modalBody = $("#ConfirmationModal .modal-body p");
      const confirmedButton = document.querySelector("#ConfirmationModal #Confirmed");

      modalTitle.html(`Copy Product`);
      modalBody.html(`Copy product ${productIdn} - ${productName}?`);

      FECI.confirmation_modal = {
        source: "productsTable",
        action: "copy-product",
        data: {
          productIdn,
        }
      };

      confirmedButton.removeEventListener("click", handleCopyProduct);
      confirmedButton.addEventListener("click", handleCopyProduct);
    
      //Show modal dialog
      $("#ConfirmationModal").modal("show");
    }
    
    // Action handlers
    table.on("click", "button.copy-product", function(e) {
      show_copy_product_modal(this);
      e.preventDefault();
    });

    table.on("click", "button.edit-product", function(e) {
      const $row = $(this).parents("tr");
      const productIdn = $row.data("product-idn");
      
      window.location = `${FECI.base_url}product/detail/${productIdn}`;

      e.preventDefault();
    });

  });
  