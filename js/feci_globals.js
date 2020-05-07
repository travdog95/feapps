// FECI Global Variables
let FECI = {
  base_url: "",
  baseUrl: window.location.origin,
  user: {
    user_name: "",
    user_idn: 0,
    first_name: "",
    last_name: "",
    department_idn: 0
  },
  request: "", //Object that hold AJAX request
  token: "feapps-token",
  job: {},
  source_page: "",
  source_modal: "",
  css: {
    highlight_input: "#EDED9F"
  },
  submit_button: "",
  adjustment_sub_factors: [],
  home: {
    folder_idn: 0,
    source: ""
  },
  copy_worksheet: [32, 12, 31, 14,24,25,26,27], //WorksheetMaster_Idn's that use the copy worksheet functionality

  //Common confirmation modal
  confirmation_modal: {
    source: "",
    action: "",
    data: {}
  },
  departments: []
};
