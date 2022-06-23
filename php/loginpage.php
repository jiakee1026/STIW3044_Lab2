<?php

if (isset($_POST['submit'])) {

    include 'dbconnect.php';

    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $sqllogin = "SELECT * FROM tbl_user WHERE user_email = '$email' AND user_password = '$password'";

    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();

    if ($number_of_rows  > 0) {

        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email;

        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('loginpage.php')</script>";
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
    <script src="../js/login.js" defer></script>

    <title>Login</title>
</head>

<body onload="loadCookies()"style="max-width:1200px;margin:0 auto;">

    <header class="w3-header w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">
        <h1 class="W3-center" style="text-shadow:1px 1px 0 #444">MY TUTOR</h1>   
    </header>

    <div style="display:flex; justify-content:center">
        <div class="w3-container w3-padding w3-margin" style="max-width:1200px;">

            <form name="loginForm" class="w3-container" action="loginpage.php" method="post">

            <div class="w3-container w3-padding-64 w3-center">
                <div class="w3-card-4 w3-round">
                    <h2><b>Login</b></h2>
                </div>
            

                    <div class="w3-display-container w3-padding w3-margin w3-center">
                        <img src="logo.jpg" style="height: 300px; width: 300px;">
                    </div>

                    <p>
                        <label class="w3-text-black"><b>Email</b></label>
                        <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" placeholder="Enter Email" required>
                    </p>
                    <p>
                        <label class="w3-text-black"><b>Password</b></label>
                        <input class="w3-input w3-border w3-round" name="password" type="password" id="idpass" placeholder="Enter Password"required>
                    </p>
                    <p>
                        <input class="w3-check" type="checkbox" id="idremember">
                        <label>Remember Me</label>
                    </p>

                    <p><input class="w3-button w3-round w3-border" style="background-color: #133764 ; color:white" type="submit" name="submit" id="idsubmit"></p>
                    <p>No Have Account? <a href="registerpage.php" style="text-decoration:none;"><u>Register here.</u></a></p>
                    <br>
        
                </div>
            </form>
        </div>
    </div>
    
    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-red">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>

<footer>
    <p class="w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">Copyright MYTutor&copy;</p>
</footer>

</body>

<script>
    let cookie_consent = getCookie("user_cookie_consent");
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }
</script>

</html>