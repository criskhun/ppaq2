const wrapper = document.querySelector(".wrapper"),
  qrInput = wrapper.querySelector(".form input"),
  generateBtn = wrapper.querySelector(".form button"),
  qrImg = wrapper.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
  let qrValue = qrInput.value.trim();
  if (!qrValue || preValue === qrValue) return;
  preValue = qrValue;
  generateBtn.innerText = "Generating QR Code...";
  qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;

  qrImg.addEventListener("load", () => {
    console.log("QR code image loaded.");
    wrapper.classList.add("active");
    generateBtn.innerText = "Generate QR Code";
    // Automatically trigger the download
    downloadQRImage();
  });
});

qrInput.addEventListener("keyup", () => {
  if (!qrInput.value.trim()) {
    wrapper.classList.remove("active");
    preValue = "";
  }
});

function downloadQRImage() {
  const downloadLink = document.createElement("a");
  downloadLink.href = qrImg.src;
  downloadLink.download = "qr_code.png";
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);
}