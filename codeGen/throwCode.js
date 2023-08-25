document.getElementById('generateQR').addEventListener('click', function() {
    // Generate the desired text format
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const formattedText = `SSG000${year}`;

    // Set the value of the input field
    document.getElementById('codeHere').value = formattedText;
});

// You can use an actual QR code generation library to generate the QR code image
// For example, you can use the qrcode.min.js library
// This example assumes you're using this library
document.getElementById('documentFormCG').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Generate QR code using the text from the input field
    const qrText = document.getElementById('codeHere').value;
    const qrCode = new QRCode(document.getElementById('qrImage'), {
        text: qrText,
        width: 128,
        height: 128
    });
});