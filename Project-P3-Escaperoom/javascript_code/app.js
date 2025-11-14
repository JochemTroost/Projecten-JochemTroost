
function addNumber(num) {
  let inputField = document.getElementById("codeInput");

  if (inputField.value.length < 4) {
    inputField.value += num;
  }
}

function clearInput() {
  document.getElementById("codeInput").value = "";
}

function checkCode() {
  let code = document.getElementById("codeInput").value;
  if (code === "6276") {

  
      window.location.href = "notitie.php";
  

  
  
  } else {
    window.location.href = "touchpadKast.php";
    clearInput();
  }
}