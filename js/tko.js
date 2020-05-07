/*
 * check_num
 *
 * Only allow numbers in input field
 *
 * @param	field(object) - element object
 * @param	add_class(string) - class to apply to field if field value is not a number
 * @param	decimals(number) - number of decimal places to format
 * @return	bool
 */

function check_num(field, add_class, decimals) {
    var title = "";
    var message = "";
    var field_value = "";
    var formatted_value = "";

    //Strip comma from value
    field_value = strip_comma(field.value);

    if (isNaN(field_value)) {
		//Add class if add_class is not empty
        //if (add_class != "" && $(field).hasClass(add_class) == false) {
		//	field.className += " " + add_class;
		//}
	
		//Set title
		title = field.title;
		
        //Craft message
		message = (title != "") ? "Only numbers allowed in '" + title + "' field." : "Only numbers allowed in field";

	    //Display message
		alert(message);

		//Select field content
		setTimeout(function(){field.select();}, 1);
		
		return false;
	} else {
		//Format value
        formatted_value = number_format(field_value, decimals, ",");

        if ($(field).is("input")) {
            $(field).val(formatted_value);
        } else {
            $(field).text(formatted_value);
        }
	}
	
	return true;
}

/*
 * check_num0
 *
 * Calls check_num function and sets decimals to 0
 *
 * @param	field(object) - element object
 * @param	add_class(string) - class to apply to field if field value is not a number
 */

function check_num0(field, add_class) {
	return check_num(field, add_class, 0);
}

/*
 * check_num1
 *
 * Calls check_num function and sets decimals to 1
 *
 * @param	field(object) - element object
 * @param	add_class(string) - class to apply to field if field value is not a number
 */

function check_num1(field, add_class) {
	return check_num(field, add_class, 1);
}

/*
 * check_num2
 *
 * Calls check_num function and sets decimals to 2
 *
 * @param	field(object) - element object
 * @param	add_class(string) - class to apply to field if field value is not a number
 */

function check_num2(field, add_class) {
	return check_num(field, add_class, 2);
}

/*
 * check_num2
 *
 * Calls check_num function and sets decimals to 2
 *
 * @param	field(object) - element object
 * @param	add_class(string) - class to apply to field if field value is not a number
 */

function check_num3(field, add_class) {
	return check_num(field, add_class, 3);
}

/*
 * number_format_field
 *
 * Set object value to formatted value using the number_format function
 *
 * @param	field(object) - element object
 * @param	decimals(number) - number of decimal places
 * @param	separator(string) - number separator, usually a comma (12,234.87)
 * @return ()
 */

function number_format_field (field, decimals, separator) {
	field.value = number_format(field.value, decimals, separator);
}

/*
 * number_format
 *
 * generic positive number decimal formatting function
 *
 * @param	expr(string) - value function will format
 * @param	decplaces(number) - number of decimal places to format
 * @param	separator(string) - number separator, usually a comma (12,234.87)
 * @return	string - formatted string
 */

function number_format(expr, decplaces, separator) {
    if (expr !== undefined && decplaces !== undefined && separator !== undefined) {
        //Delcare and initialize variables
        var prefix = "";

        if (expr === '') {
            expr = 0;
        }

        if (parseFloat(expr) < 0) {
            prefix = "-";
            expr = (-1 * parseFloat(expr));
        }

        var str = "" + Math.round(eval(expr) * Math.pow(10, decplaces)) / Math.pow(10, decplaces);
        //Position of decimal point
        var decpoint = str.indexOf('.');

        var decimal_value = "";
        if (decpoint != -1) {
            decimal_value = str.substr(decpoint);
        }

        var num = "" + Math.floor(eval(str));

        //Insert a separator
        if (num.length > 3 && separator != "") {
            var num_separators = Math.floor((num.length - 1) / 3);

            var mod = num.length % 3;
            if (mod == 0) {
                mod = 3;
            }

            var wk_num = "";
            for (s = 0; s <= num_separators; s++) {
                var str_pos = 0;
                var str_len = mod;
                if (s > 0) {
                    str_pos = mod + ((s - 1) * 3);
                    str_len = mod + (s * 3);
                }
                wk_num += num.substring(str_pos, str_len);
                if (s != num_separators) {
                    wk_num += separator;
                }
            }
            num = wk_num;
        }

        if (decplaces > 0) {
            //Pad zeros to the right of decimal
            var decplaces_length = decplaces + 1;
            var actual_decplaces_length = 0;
            if (decimal_value == "") {
                decimal_value = ".";
            }
            actual_decplaces_length = decimal_value.length;
            if (actual_decplaces_length < decplaces_length) {
                for (actual_decplaces_length; actual_decplaces_length < decplaces_length; actual_decplaces_length++) {
                    decimal_value += "0";
                }
            }
        }

        return prefix + "" + num + "" + decimal_value;
    }

    return "";
}

function strip_comma(string) {
    return string.replace(/,/g, "");
}

function precise_round(num, decimals) {
    var sign = num >= 0 ? 1 : -1;
    return parseFloat((Math.round((num * Math.pow(10, decimals)) + (sign * (10 / Math.pow(100, decimals)))) / Math.pow(10, decimals)).toFixed(decimals));
}

/*
 * message
 *
 * Message handler for elements with ".message" class. Inserts, displays and formats message
 *
 * @param	text (message_text)
 * @param	number (message_type -> 0 = info, 1 = success, 2 = warning, 3 = danger)
 * @return  void
 */

function message(message_text, message_type) {
    //var close_button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    message_text = (message_text == "") ? "Oops, something was supposed to happen, but I don't think it did!" : message_text;

    //Remove existing alert classes
    $(".message").removeClass("alert-info alert-success alert-warning alert-danger");

    $(".message").html(message_text).trigger('change');
    $(".message").show();

    switch (message_type) {
        case 0:
        case "0":
            $(".message").addClass("alert-info");
            break;
        case 1:
        case "1":
            $(".message").addClass("alert-success");
            break;
        case 2:
        case "2":
            $(".message").addClass("alert-warning");
            break;
        case 3:
        case "3":
            $(".message").addClass("alert-danger");
            break;
        default:
            $(".message").addClass("alert-info");
    }
}

function TKO_decode_entities(encodedString) {
    var translate_re = /&(nbsp|amp|quot|lt|gt);/g;
    var translate = {
        "nbsp": " ",
        "amp": "&",
        "quot": "\"",
        "lt": "<",
        "gt": ">"
    };
    return encodedString.replace(translate_re, function (match, entity) {
        return translate[entity];
    }).replace(/&#(\d+);/gi, function (match, numStr) {
        var num = parseInt(numStr, 10);
        return String.fromCharCode(num);
    });
}

/**********************************************************************/
//  Function that allows use of up and down arrows to move from element 
//	to element based on order of an associative array of input objects 
//	with index starting at zero passed to function. 
//	For example $("input.qty")
//	jQuery is required.
/**********************************************************************/
function TKO_arrow_navigation(sibling_elements) {
    sibling_elements.keydown(function (e) {
        //only enter logic if up or down arrow is pressed
        if (e.which === 38 || e.which === 40) {
            //initiate variables
            var element = e.target.id;
            var direction = "";
            var count_elements = sibling_elements.length;
            var target_index = 0;

            //Determine which key was pressed
            direction = (e.which === 38) ? 'up' : 'down';

            $.each(sibling_elements, function (index, value) {
                if (direction === 'up') {
                    //Up arrow was pressed with focus on first element, so focus is set on last element in array
                    if (element === sibling_elements[0].id) {
                        target_index = count_elements - 1;
                    }
                    else if (element === sibling_elements[index].id) {
                        target_index = index - 1;
                    }
                }
                else if (direction === 'down') {
                    //Down arrow pressed with focus on the last element, so focus is set to first element in array
                    if (element === sibling_elements[count_elements - 1].id) {
                        target_index = 0;
                    }
                    else if (element === sibling_elements[index].id) {
                        target_index = index + 1;
                    }
                }
                sibling_elements[target_index].focus();
            });
            e.preventDefault(); // prevent the default action
        }
    });
}
