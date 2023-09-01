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
  // Open the QR code image in a new window
  const newWindow = window.open("");
  newWindow.document.write(`<img src="${qrImg.src}" alt="QR Code">`);
  newWindow.document.close();

  // Delay the download to ensure the image has loaded in the new window
  setTimeout(() => {
    newWindow.document.querySelector("img").addEventListener("load", () => {
      newWindow.document.querySelector("img").style.display = "none"; // Hide the image
      newWindow.print(); // Trigger the browser's print functionality
      newWindow.close(); // Close the new window
    });
  }, 1000); // Adjust the delay if needed
}
