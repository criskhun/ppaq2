<?php
include("../database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="../images/fav.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
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
    .custom-margin {
            margin: 20px;
        }
        .custom-link {
            color: white;            /* Set font color to black */
            text-decoration: none;   /* Remove underline */
        }

        .custom-link:hover {
            text-decoration: underline; /* Add underline on hover */
        }
    </style>
    


</head>
<body>


<div class="header">
    <div class="p-3 text-white" style="background-color: rgba(0, 135, 255, 0.7);">
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="../index.php">
                <img src="../images/white-logo.png" alt="logo" width="70" height="70">
                </a>
            </div>
            <div class="col-auto">
                <h1>Customer Service Monitoring System</h1>
                <p>PPA PMO-SOCSARGEN QUEUING SYSTEM</p>
            </div>
            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center">
                    <span><a href="../LogReg/userLogin.php" class="custom-link custom-margin"><i class="fa-solid fa-user-astronaut"></i> Sign in</a></span>
                    <span><i class="fa-solid fa-grip-lines-vertical"></i></span>
                    <span><a href="../LogReg/userRegistration.php" class="custom-link custom-margin"><i class="fa-solid fa-user-plus"></i> Sign up</a></span>    
                </div>  
            </div>
        </div>
    </div>
  </div>

  </body>
</html>