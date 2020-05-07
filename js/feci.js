$(function() {
  register_feci_handlers();

  check_url_message();
});

/*
 * register_feci_handlers
 *
 * Register all FECI event handlers
 *
 */
function register_feci_handlers() {
  sticky_page_header();
  select_event_handler();
  check_num_handlers();
  //form_change_handler();
  modal_handlers();
  original_value_handler();
  find_active_menu_item();
  monitor_change_handler();
  favorite_handler();
  print_handler();
  messageBox_handler();
  unsaved_changes_handler();
}

function favorite_handler() {
  $("i.favorite").click(function() {
    save_favorite(this);
  });
}

function save_favorite(el) {
  var flag = $(el).hasClass("fa-heart") ? 0 : 1;
  var message_text = "";
  //var feapps_token = $("input[name=" + FECI.token + "]").val();

  //abort any pending request
  if (FECI.request) {
    FECI.request.abort();
  }

  FECI.request = $.ajax({
    url:
      FECI.base_url +
      "job/save_favorite/" +
      FECI.job.job_number +
      "/" +
      FECI.user.user_idn +
      "/" +
      flag,
    type: "POST",
    dataType: "json",
    data: {}
  });

  // callback handler that will be called on success
  FECI.request.done(function(response) {
    if (response.return_code === 0) {
      displayMessageBox("Error saving favorite", "danger");
    } else {
      $(el).toggleClass("fa-heart fa-heart-o");

      message_text = flag == 1 ? "saved" : "deleted";
      //message("Favorite " + message_text + "!", 1);
    }
  });

  // callback handler that will be called on failure
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    // log the error to the console
    console.error(
      "The following error occured when saving job favorite: " + textStatus,
      errorThrown
    );
  });
}
function monitor_change_handler(elementId = "") {
  var selector = "";

  selector = elementId === "" ? ".monitor-change" : "#" + elementId;

  $(selector).change(function(e) {
    var $el = $(this);
    var recent_value = $el.data("recent-value");
    var value = $el.val();

    //If values are numeric, strip comma and convert to number
    if (!isNaN(recent_value)) {
      recent_value = parseFloat(recent_value);
      value = parseFloat(strip_comma(value));
    }

    //Comparison
    if (recent_value !== value) {
      if ($el.hasClass("unsaved-change") == false) {
        $el.addClass("unsaved-change");
      }
    } else {
      $el.removeClass("unsaved-change");
    }
  });
}

function refresh_saved_elements() {
  //Set recent value to saved value
  $.each($(".unsaved-change"), function(i, el) {
    var $el = $(this);
    var value = $el.val();

    $el.data("recent-value", value);
  });

  remove_unsaved_change();
}

function remove_unsaved_change() {
  $(".unsaved-change").removeClass("unsaved-change");
}

/*
 * original_value_handler
 *
 * Registers event handler to compare value to original value in database
 *
 */
function original_value_handler() {
  $.each($(".monitor-original"), function(index, el) {
    original_value(el);
  });

  $(".monitor-original").change(function(e) {
    original_value(this);
  });
}

function original_value(el) {
  var original_value = $(el).data("original-value");
  var value = $(el).val();

  //If values are numeric, strip comma and convert to number
  if (!isNaN(original_value)) {
    original_value = parseFloat(original_value);
    if (value === "") {
      value = parseFloat($(el).data("recent-value"));
    } else {
      value = parseFloat(strip_comma(value));
    }
  }
  //console.log("id: " + $(el).attr('id') + " value: " + value + " original_value: " + original_value);

  if (original_value > 0) {
    //Comparison
    if (original_value !== value) {
      if ($(el).hasClass("original-value-change") == false) {
        $(el).addClass("original-value-change");
      }
    } else {
      $(el).removeClass("original-value-change");
    }
  }
}

/*
 * select_event_handler
 *
 * Registers event handler to select contents of text input elements
 *
 */
function select_event_handler() {
  //Select contects of all select input fields when element receives focus
  $("input[type='text']").focus(function(e) {
    this.select();
  });
}

/*
 * check_num_handlers
 *
 * Binds change event to all element with check_num classes
 *
 */

function check_num_handlers() {
  //Change event handler for any element with 'check_num0' class
  $(".check_num0").blur(function(e) {
    check_num0(this, "highlight");
  });
  //Change event handler for any element with 'check_num1' class
  $(".check_num1").blur(function(e) {
    check_num1(this, "highlight");
  });
  //Change event handler for any element with 'check_num2' class
  $(".check_num2").blur(function(e) {
    check_num2(this, "highlight");
  });
}

/*
 * form_change
 *
 * Registers event handler to select contents of text input elements
 *
 */
function form_change_handler() {
  //Change event handler for any element with 'change' class
  $(".change").change(function(e) {
    //Set change_flag to active
    $(".change_flag").text("!");
  });
}

/*
 * number_format
 *
 *
 */
//Initialize these handlers on pages where copy job or delete jobs functionality exists

function modal_handlers() {
  //Allow for stacked modals
  //http://jsfiddle.net/CxdUQ/
  $(document).on("show.bs.modal", ".modal", function(event) {
    var zIndex = 1040 + 10 * $(".modal:visible").length;
    $(this).css("z-index", zIndex);
    setTimeout(function() {
      $(".modal-backdrop")
        .not(".modal-stack")
        .css("z-index", zIndex - 1)
        .addClass("modal-stack");
    }, 0);
  });

  $("div.modal").on("hide.bs.modal", function(event) {
    //Clear and hide all modal_message elements when any modal is closed
    $(".modal-body .modal_message")
      .html("")
      .hide();
    $(".modal-footer .modal-message").html("");
  });
}

function print_handler() {
  window.addEventListener("beforeprint", function(event) {
    //Print-me handler automatically updates hidden span that will be displayed only when printed
    $(".print-my-value").each(function() {
      //If input[text] or select element
      if ($(this).is("input[type=text") || $(this).is("select")) {
        var printID = this.id + "-print";
        var printText = "";

        if ($(this).is("select")) {
          printText = $(this)
            .find(":selected")
            .text();
        } else {
          printText = $(this).val();
        }

        if ($("#" + printID).length === 0) {
          //Create span element to use to display value
          $(this).after(
            '<span id="' +
              printID +
              '" class="print-me display_none">' +
              printText +
              "</span>"
          );
        } else {
          $("#" + printID).text(printText);
        }
      }
    });

    //Copy notes text on recap page for printing
    if ($("#notes").length > 0) {
      $("#notes-print").html($("#notes").text());
    }
  });
}

function arrow_navigation_controller() {
  const default_class_names = [
    "quantity",
    "material_unit_price",
    "field_unit_price",
    "shop_unit_price",
    "bonded_mark_up"
  ];

  $.each(default_class_names, function(index, class_name) {
    //Activate up/down arrows on fields with class name
    TKO_arrow_navigation($("input." + class_name));
  });
}

//Check to see if url parameter 'message' is passed to page and display it
function check_url_message() {
  if (url("?message") !== undefined && url("?message") != "") {
    displayMessageBox(url("?message"), url("?message_type"));
  }
}

function find_active_menu_item() {
  var url = window.location.href;
  var uri = "";
  var active_match = "";

  //If on worksheet page, match with worksheet_master_idn
  if (url.indexOf("worksheet") >= 0) {
    uri = FECI.worksheet_master.WorksheetMaster_Idn;
  } else {
    //strip out base_url
    uri = url.substring(FECI.base_url.length);
  }

  //Iterate through menu li elements to look for match
  $(".main-navigation-menu li").each(function() {
    active_match = $(this).data("activematch");
    if (active_match == uri) {
      $(this).addClass("active");
    }
  });
}

function format_numbers() {
  //Declare and initialize variables
  var formatted_number = "";
  var num_decimals = 0;
  var check = "check_num";
  var class_names = "";
  //Find all elements that have check_num* class
  $.each($('[class^="check_num"], [class*=" check_num"]'), function(i, el) {
    //Get all class names associated with element
    class_names = this.className;
    num_decimals = 0;
    formatted_number = "";
    //Iterate through all class names on element to find match with check_num
    $.each(class_names.split(" "), function(j, class_name) {
      if (class_name.indexOf(check) > -1) {
        //get number of decimals from the end of check_num class name
        num_decimals = parseInt(
          class_name.slice(check.length, class_name.length)
        );
      }
    });

    //Format the number
    if ($(el).is("input")) {
      formatted_number = number_format(
        strip_comma($(el).val()),
        num_decimals,
        ","
      );
      $(el).val(formatted_number);
    } else {
      formatted_number = number_format(
        strip_comma($(el).text()),
        num_decimals,
        ","
      );
      $(el).text(formatted_number);
    }
  });
}

function messageBox_handler() {
  $("#dismissMessageBox").on("click", function(e) {
    hideMessageBox();
  });
}

function displayMessageBox(message, type) {
  var alertType = "";
  var alertTypes = ["success", "info", "warning", "danger"];

  //Check to see if messageBox is already displayed
  if ($("#messageBox").is(":visible")) {
    hideMessageBox();
  }

  //Validate value of type variable
  if ($.inArray(type, alertTypes) >= 0) {
    alertType = type;
  } else {
    alertType = "info";
  }

  $("#messageBox .messageBoxText").html(message);
  $("#messageBox")
    .addClass("alert-" + alertType)
    .removeClass("hide");

  if (type !== "danger") {
    //Hide message after 5 seconds
    setInterval(hideMessageBox, 5000);
  }
}

function hideMessageBox() {
  $("#messageBox")
    .addClass("hide")
    .removeClass("alert-success alert-info alert-warning alert-danger");
  $("#messageBox .message").html("");
}

//Get message type text based on legacy message type numerical value
function getMessageType(type) {
  var messageType = "";

  switch (type) {
    case 0:
      messageType = "info";
      break;
    case 1:
      messageType = "success";
      break;
    case 2:
      messageType = "warning";
      break;
    case 3:
      messageType = "danger";
      break;
    default:
      messageType = "info";
  }

  return messageType;
}

function unsaved_changes_handler() {
  window.addEventListener("beforeunload", event => {
    if ($(".unsaved-change").length > 0) {
      event.returnValue =
        "You have some unsaved changes. Sure you want to leave?";
    }
  });
}

function sticky_page_header() {
  if ($(".sticky").length > 0) {
    var stickyOffset = $(".sticky").offset().top;

    $(window).scroll(function() {
      var sticky = $(".sticky"),
        scroll = $(window).scrollTop();

      if (scroll >= stickyOffset) {
        sticky.addClass("fixed");
      } else {
        sticky.removeClass("fixed");
      }
    });
  }
}
