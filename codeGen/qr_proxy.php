<?php
$qrImageUrl = $_GET['url']; // Get the QR code image URL from the query parameter

// Set appropriate headers
header("Content-Type: image/png");
header("Access-Control-Allow-Origin: *"); // Adjust this to the allowed origin if needed

// Fetch the image and output it
readfile($qrImageUrl);
?>