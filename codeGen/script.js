


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
        console.log("QR code image loaded.");
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

$(document).ready(function(){
    $("#download").on('click', function(){
        var qrImgElement = $("#trytry")[0]; // Get the raw image element
        html2canvas(qrImgElement, {
            onrendered: function(canvas){
                var imageData = canvas.toDataURL("image/png");
                var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#download").attr("download", "qr-code.png").attr("href", newData);
            }
        });
    });
});