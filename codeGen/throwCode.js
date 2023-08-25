document.getElementById("generateButton").addEventListener("click", function () {
    var port = document.getElementById("port").value;
    var codeS = document.getElementById("codeS").value;
    var year = document.getElementById("year").value;
    
    var generatedCode = port + "-" + codeS + "-" + year;
    document.getElementById("codeHere").value = generatedCode;
});