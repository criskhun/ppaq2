<script>
    // Handle Radio Change
    document.addEventListener("DOMContentLoaded", function() {
        function handleRadioChange(radio) {
        console.log("Radio Clicked:", radio);
        var otherInput = radio.parentNode.querySelector(".optionOtherInputOpta");
        console.log("Other input:", otherInput);
        var submitButton = document.getElementById("submitButton");
        var hiddenDiv = document.getElementById("hiddenDiv");
        
        if (radio.value === "otherOption") {
            otherInput.removeAttribute("disabled");
        } else {
            otherInput.setAttribute("disabled", "disabled");
        }
        
        submitButton.removeAttribute("disabled");
        hiddenDiv.hidden = true;
    }
});
    

    // Toggle Div Visibility
    function toggleDivVisibility() {
        var hiddenDiv = document.getElementById("hiddenDiv");
        hiddenDiv.hidden = !hiddenDiv.hidden; // Toggle the visibility of the div
    }

    // Hide Div
    function toggleDivHide() {
        var hiddenDiv = document.getElementById("hiddenDiv");
        hiddenDiv.hidden = true;
    }

    // Display Selected Value
    function displaySelectedValue() {
    var selectedValue = document.querySelector('input[name="option"]:checked').value;
    var otherInputValue = document.querySelector(".optionOtherInputOpta").value;
    var displayInput = document.getElementById("selectedValueInput");

    if (selectedValue === "otherOption") {
        displayInput.value = "OO: " + otherInputValue;
        toggleDivVisibility(); // Call the toggleDivVisibility function here
    } else {
        displayInput.value = selectedValue;
        toggleDivVisibility(); // Call the toggleDivVisibility function here
    }

    }
</script>

</body>
</html>
