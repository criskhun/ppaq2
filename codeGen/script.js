


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
    qrImg.src = `https://ppaq2.pmosocsargen.com/codeGen/codeGen.php?data=${encodeURIComponent(qrValue)}`;
    
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

