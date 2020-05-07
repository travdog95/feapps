//get departments
let FIRE;

const getDepartments = $.ajax({
  url: FECI.baseUrl + "/home_controller/get_departments/",
  dataType: "json"
}).done(response => {
  return response;
});

$.when(getDepartments).done(departments => {
  FIRE.departments = departments;
});

export default FIRE;
