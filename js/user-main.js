function validateUser() {
  var today = new Date();
  var dob = document.getElementById("dob").value;
  var mob = document.getElementById("mobile").value;
  var email = document.getElementById("email").value;
  var pass = document.getElementById("password").value;
  var cpass = document.getElementById("cpassword").value;

  var d1 = new Date(GetFormattedDate());
  var d2 = new Date(dob);
  if (d2 > d1) {
    document.getElementById("error_dob").innerHTML =
      "Please enter a valid Date of birth";
    return false;
  } else {
    document.getElementById("error_dob").innerHTML = "";
  }

  if (isNaN(mob) || mob.length != 10) {
    document.getElementById("error_mobile").innerHTML =
      "Please enter 10 digit valid mobile number";
    return false;
  } else {
    document.getElementById("error_mobile").innerHTML = "";
  }

  var atpos = email.indexOf("@");
  var dotpos = email.lastIndexOf(".");
  if (atpos < 1 || dotpos < atpos + 2) {
    document.getElementById("error_email").innerHTML =
      "Please enter a valid mail id";
    return false;
  } else {
    document.getElementById("error_email").innerHTML = "";
  }

  if (pass.length < 6 || pass.length > 15) {
    document.getElementById("error_password").innerHTML =
      "Password must be between 6 to 15 character";
    return false;
  } else {
    document.getElementById("error_password").innerHTML = "";
  }
  if (pass != cpass) {
    document.getElementById("error_cpassword").innerHTML =
      "Password and Confirm password must be same";
    return false;
  } else {
    document.getElementById("error_cpassword").innerHTML = "";
  }
}

function GetFormattedDate() {
  var todayTime = new Date();
  var month = todayTime.getMonth() + 1;
  var day = todayTime.getDate();
  var year = todayTime.getFullYear();
  return year + "-" + month + "-" + day;
}

