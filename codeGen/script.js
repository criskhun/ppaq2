document.getElementById("generateButton").addEventListener("click", function () {
    var qrValue = document.getElementById("codeHere").value.trim();
    
    if (!qrValue) {
        alert("Please enter a value for QR code generation.");
        return;
    }

    var qrImg = document.getElementById("qrImage");
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
});

document.getElementById("downloadButton").addEventListener("click", function () {
    var qrImg = document.getElementById("qrImage");
    var qrValue = document.getElementById("codeHere").value.trim();

    if (!qrValue) {
        alert("No QR code image available to download.");
        return;
    }

    var a = document.createElement("a");
    a.href = qrImg.src;
    a.download = "qr-code.png";
    a.click();
});