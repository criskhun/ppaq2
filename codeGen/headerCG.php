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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <title>Code Generator</title>
    <style>
        body {
            background-image: url("");
            background-size: cover;
            background-position: center;

        }
        .custom-row {
            padding: 15px; /* Adjust padding as needed */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow */
        }
        .custom-container {
            padding: 15px; /* Adjust padding as needed */
            border: 1px solid #ccc; /* Border style */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow */
        }
        /* Import Google Font - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

::selection{
  color: #fff;
  background: #3498DB;
}
.wrapper{
  height: 325px;
  max-width: 410px;
  background: #fff;
  border-radius: 7px;
  padding: 20px 25px 0;
  transition: height 0.2s ease;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.wrapper.active{
  height: 590px;
}
header h1{
  font-size: 21px;
  font-weight: 500;
}
header p{
  margin-top: 5px;
  color: #575757;
  font-size: 16px;
}
.wrapper .form{
  margin: 20px 0 25px;
}
.form :where(input, button){
  width: 100%;
  height: 55px;
  border: none;
  outline: none;
  border-radius: 5px;
  transition: 0.1s ease;
}
.form input{
  font-size: 18px;
  padding: 0 17px;
  border: 1px solid #999;
}
.form input:focus{
  box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.form input::placeholder{
  color: #999;
}
.form button{
  color: #fff;
  cursor: pointer;
  margin-top: 20px;
  font-size: 17px;
  background: #3498DB;
}
.qr-code{
  opacity: 0;
  display: flex;
  padding: 33px 0;
  border-radius: 5px;
  align-items: center;
  pointer-events: none;
  justify-content: center;
  border: 1px solid #ccc;
}
.wrapper.active .qr-code{
  opacity: 1;
  pointer-events: auto;
  transition: opacity 0.5s 0.05s ease;
}
.qr-code img{
  width: 170px;
}

@media (max-width: 430px){
  .wrapper{
    height: 255px;
    padding: 16px 20px;
  }
  .wrapper.active{
    height: 510px;
  }
  header p{
    color: #696969;
  }
  .form :where(input, button){
    height: 52px;
  }
  .qr-code img{
    width: 160px;
  }  
}
    </style>
    


</head>
<body>


