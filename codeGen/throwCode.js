document.addEventListener('DOMContentLoaded', function() {
    // Get references to the elements
    const generateButton = document.querySelector('.btn.btn-primary');
    const codeHereInput = document.getElementById('codeHere');

    // Add an event listener to the "Generate" button
    generateButton.addEventListener('click', function() {
        // Create the desired text
        const generatedText = 'SSG - filename - 2023'; // You can modify this as needed

        // Set the generated text as the value of the input field
        codeHereInput.value = generatedText;
    });
});
