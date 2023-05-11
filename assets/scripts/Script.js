function roles() {
  var form_role = document.getElementById("form_roles");
  var form_table = document.getElementById("form_create-table");
  if (form_role.style.display == "flex") {
    form.style.display = "none";
  } else {
    form_role.style.display = "flex"; 
    form_table.style.display = "none";
  }
}

function createTable() {
  var form_table = document.getElementById("form_create-table");
  var form_role = document.getElementById("form_roles");
  if (form_table.style.display == "flex") {
    form_table.style.display = "none";
  } else {
    form_table.style.display = "flex"; 
    form_role.style.display = "none";
  }
}

function click(){
  console.log('cllick'); 
}
  



