<?php
include("../database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>CSMS</title>
    <style>
        body {
            background-image: url("../images/mainbkg.jpg");
            background-size: cover;
            background-position: center;

        }

          .btn-group-vertical {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header {

            position: sticky;
            top: 0;
            z-index: 100;
        }
        .custom-container {
            max-width: 600px;
        }
        .login-container {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        padding: 20px;
    }
    .logo-image {
        width: 180px;
        height: 150px;
        object-fit: cover;
        border-radius: 2%;
        margin-bottom: 20px;
    }
    .alert {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .message {
        flex-grow: 1;
        margin-right: 10px; /* Adjust as needed */
    }
    </style>
    


</head>
<body>


<div class="header">
        <div class="p-3 text-white text-start" style="background-color: rgba(0, 135, 255, 0.7);">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="../images/white-logo.png" alt="logo" width="70" height="70">
                </div>
                <div class="col">
                    <h1>Customer Service Monitoring System</h1>
                    <p>PPA PMO-SOCSARGEN QUEUING SYSTEM</p>
                </div>
            </div>
        </div>
  </div>
  </body>
</html>