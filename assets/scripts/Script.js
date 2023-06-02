function roles() {
  var form_role = document.getElementById("form_roles");
  var form_client = document.getElementById("form_clients");
  var form_report = document.getElementById("form_reports");
  var form_story = document.getElementById("form_history");
  
  if(form_role == null){
    location.replace("../main.php?role=")
  }

  
    form_role.style.display = "flex"; 
    form_client.style.display = "none";
    form_report.style.display = "none";
    form_story.style.display = "none";
  
}

function clients() {
  var form_role = document.getElementById("form_roles");
  var form_client = document.getElementById("form_clients");
  var form_report = document.getElementById("form_reports");
  var form_story = document.getElementById("form_history");
  if(form_role == null){
    location.replace("../main.php?client=")
  }
  
    form_client.style.display = "flex"; 
    form_role.style.display = "none";
    form_report.style.display = "none";
    form_story.style.display = "none";
  
}

function reports() {
  var form_role = document.getElementById("form_roles");
  var form_client = document.getElementById("form_clients");
  var form_report = document.getElementById("form_reports");
  var form_story = document.getElementById("form_history");
  if(form_role == null){
    location.replace("../main.php?reports=")
  }
  
    form_report.style.display = "flex";
    form_client.style.display = "none"; 
    form_role.style.display = "none";
    form_story.style.display = "none";

}

function history() {
  var form_role = document.getElementById("form_roles");
  var form_client = document.getElementById("form_clients");
  var form_report = document.getElementById("form_reports");
  var form_story = document.getElementById("form_history");
  if(form_role == null){
    location.replace("../main.php?history=")
  }
  
    form_story.style.display = "flex";
    form_client.style.display = "none"; 
    form_role.style.display = "none";
    form_report.style.display = "none";
  
}

function show_update(){
  var form_updateUser = document.getElementById("form_update_user");
  if (form_updateUser.style.display == "flex") {
    form_updateUser.style.display = "none";
  } else {
    form_updateUser.style.display = "flex";
  }
}
  



