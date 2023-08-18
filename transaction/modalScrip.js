document.addEventListener("DOMContentLoaded", function () {
    const confirmDropModal = new bootstrap.Modal(document.getElementById("confirmDropModal"));
    const confirmDropLink = document.getElementById("confirmDropLink");

    confirmDropModal._element.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const transactionId = button.getAttribute("data-transaction-id"); // Extract transaction ID from button

        // Update the "Drop" link in the modal with the correct transaction ID
        confirmDropLink.href = `drop.php?id=${transactionId}`;
    });
});