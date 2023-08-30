const wrapper = document.querySelector(".wrapper"),
    qrInput = wrapper.querySelector(".form input"),
    generateBtn = wrapper.querySelector(".form button"),
    downloadBtn = wrapper.querySelector("#downloadButton"), // Select the download button
    qrImg = wrapper.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
    let qrValue = qrInput.value.trim();
    if (!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Generating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener("load", async () => {
        wrapper.classList.add("active");
        generateBtn.innerText = "Generate QR Code";

        // Fetch the QR code image data
        const response = await fetch(qrImg.src);
        const blob = await response.blob();

        // Create a download link
        const url = URL.createObjectURL(blob);
        downloadBtn.href = url;
        downloadBtn.download = "qr-code.png";
        downloadBtn.style.display = "block";
    });
});

qrInput.addEventListener("keyup", () => {
    if (!qrInput.value.trim()) {
        wrapper.classList.remove("active");
        preValue = "";
        downloadBtn.style.display = "none"; // Hide the download button if no QR code is displayed
    }
});
