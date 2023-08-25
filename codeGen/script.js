const wrapper = document.querySelector(".wrapper"),
qrInput = wrapper.querySelector(".form input"),
generateBtn = wrapper.querySelector(".form button"),
qrImg = wrapper.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
    let qrValue = qrInput.value.trim();
    if(!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Generating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener("load", () => {
        wrapper.classList.add("active");
        generateBtn.innerText = "Generate QR Code";
    });
});

qrInput.addEventListener("keyup", () => {
    if(!qrInput.value.trim()) {
        wrapper.classList.remove("active");
        preValue = "";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const qrCanvas = document.getElementById("qrCanvas");
    const qrImage = document.getElementById("qrImage");
    const downloadButton = document.getElementById("downloadButton");

    downloadButton.addEventListener("click", function () {
        const qrCodeImg = document.querySelector(".qr-code img");
        const qrCodeImageUrl = qrCodeImg.src;

        if (!qrCodeImageUrl) {
            alert("No QR code image available to download.");
            return;
        }

        qrCanvas.width = qrCodeImg.width;
        qrCanvas.height = qrCodeImg.height;
        const canvasContext = qrCanvas.getContext("2d");
        canvasContext.drawImage(qrCodeImg, 0, 0);

        const a = document.createElement("a");
        a.href = qrCanvas.toDataURL("image/png");
        a.download = "qr-code.png";
        a.click();
    });
});
