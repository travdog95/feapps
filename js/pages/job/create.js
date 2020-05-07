// JavaScript Document
$(function() {
    //Set global variables
    FECI.source_page = "create";
    FECI.source_modal = "";

    //Event handler for create_sprinkler button
	$("#create_sprinkler").click(function(e) {
		window.location = FECI.base_url + "job/create_job/2";
	});
	
	//Event handler for create_special_hazard button
	$("#create_special_hazard").click(function(e) {
		window.location = FECI.base_url + "job/create_job/1";
	});
});
