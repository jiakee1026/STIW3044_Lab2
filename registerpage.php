<?php

if (isset($_POST['submit'])) {
    include_once("dbconnect.php");

    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = sha1($_POST["password"]);
    $phonenum = $_POST["phonenum"];
    $address = $_POST["address"];

    $sqlregister = "INSERT INTO `tbl_user`(`user_name`, `user_email`, `user_password`, `user_phoneNum`, `user_address`) 
    VALUES ('$name','$email','$password','$phonenum','$address')";
    $stmt = $conn->prepare($sqlregister);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    
    if ($number_of_rows  > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email ;
        echo "<script>alert('Register Success');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    } else {
        echo "<script>alert('Register Fail');</script>";
        echo "<script> window.location.replace('registerpage.php')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <header class="w3-header w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">
      <h1 class="W3-center" style="text-shadow:1px 1px 0 #444">MY TUTOR</h1>   
    </header>

    <div style="display:flex; justify-content:center">
        <div class="w3-container w3-padding w3-margin" style="max-width:1200px;">

<form name="registerForm" action="registerpage.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">

  <div class="w3-container w3-padding-64 w3-center">
  <div class="w3-card-7 w3-round">
    <h2><b>Register</b></h2>
    <p>Please fill in this form to create an account.</p>
    <hr>
  </div>

    <label for="name"><b>Name</b></label>
    <input class="w3-input w3-round-large w3-border" type="text" placeholder="Enter Name" name="name" id="name" required>
    <br>

    <label for="email"><b>Email</b></label>
    <input class="w3-input w3-round-large w3-border" type="text" placeholder="Enter Email" name="email" id="email" required>
    <br>

    <label for="password"><b>Password</b></label>
    <input class="w3-input w3-round-large w3-border" type="password" placeholder="Enter Password" name="password" id="password" required>
    <br>

    <label for="phonenum"><b>Phone Number</b></label>
    <input class="w3-input w3-round-large w3-border" type="text" placeholder="Enter Phone Number" name="phonenum" id="phonenum" required>
    <br>

    <label for="address"><b>Home Address</b></label>
    <input class="w3-input w3-round-large w3-border" type="text" placeholder="Enter Home Address" name="address" id="address" required>
    <br>

    <p><input class="w3-button w3-round w3-border" style="background-color: #133764 ; color:white" type="submit" name="submit" id="idsubmit"></p>
    <p>Already Registered? <a href="registerpage.php" style="text-decoration:none;"><u>Login here.</u></a></p>
    <br>
    </div>
    </form>
    </div>
    </div>

<footer>
    <p class="w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">Copyright MYTutor&copy;</p>
</footer>

</body>
</html>
