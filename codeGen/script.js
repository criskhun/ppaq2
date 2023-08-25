document.getElementById("generateButton").addEventListener("click", async function () {
    var qrValue = document.getElementById("codeHere").value.trim();
    
    if (!qrValue) {
        alert("Please enter a value for QR code generation.");
        return;
    }

    var qrImg = document.getElementById("qrImage");
    var qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrValue)}`;
    qrImg.src = qrImageUrl;
});

document.getElementById("downloadButton").addEventListener("click", async function () {
    var qrValue = document.getElementById("codeHere").value.trim();
    
    if (!qrValue) {
        alert("No QR code image available to download.");
        return;
    }

    var qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrValue)}`;
    
    const response = await fetch(qrImageUrl);
    const blob = await response.blob();
    
    var a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "qr-code.png";
    a.click();
});