<?php
include_once("dbconnect.php");

if (isset($_SESSION['sessionid'])) {
    $user_email = $_SESSION['email'];
}else{
    $user_email = "jktan1026@gmail.com";
}

if (isset($_POST['submit'])){
    $ttid = $_POST['ttid'];
    if ($user_email == "jktan1026@gmail.com"){
        echo "<script>alert('Please register an account first.');</script>";
        echo "<script> window.location.replace('registerpage.php')</script>";
    }else{
       echo "<script> window.location.replace('tutorlistpage.php?ttid=$ttid')</script>";
        echo "<script>alert('OK.');</script>";
    }
}
if (isset($_GET['ttid'])) {
    $ttid = $_GET['ttid'];
    $sqltutor = "SELECT * FROM tbl_tutors WHERE tutor_id = '$ttid'";
    $stmt = $conn->prepare($sqltutor);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Tutor not found.');</script>";
        echo "<script> window.location.replace('subjectlistpage.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('subjectlistpage.php')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js" defer></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>WELCOME TO MY TUTOR</title>
</head>

<body style="max-width:1200px;margin:0 auto;">
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="subjectlistpage.php" class="w3-bar-item w3-button">Profile</a>
        <a href="#" class="w3-bar-item w3-button">Tutors</a>
        <a href="#" class="w3-bar-item w3-button">Courses</a>
        <a href="#" class="w3-bar-item w3-button">Subscription</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>Information of Tutor</h3>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="subjectlistpage.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div>
    <?php
        foreach ($rows as $tutor) {
            $ttid = $tutor['tutor_id'];
            $ttemail = $tutor['tutor_email'];
            $ttphone = $tutor['tutor_phone'];
            $ttname = $tutor['tutor_name'];
            $ttpassword = $tutor['tutor_password'];
            $ttdesc = $tutor['tutor_description'];
            $ttdatereg = $tutor['tutor_datereg'];
        }
        echo "<div class='w3-padding w3-center'><img class='w3-image resimg' src=../../assets/tutors/$ttid.png" .
        " ></div><hr>";
        echo "<div class='w3-container w3-padding-large'><h4><b>$ttname</b></h4>";
        echo " <div><p><b>Description</b><br>$ttdesc</p><p><b>Email:</b> $ttemail</p><p><b>Phone No.:</b>$ttphone</p>
        <form action='tutorlistpage.php' method='post'> 
            <input type='hidden'  name='ttid' value='$ttid'>
            <input class='w3-button w3-yellow w3-round' type='submit' name='submit' value='BUY'>
        </form>
        </div></div>";
    ?>
    </div>
    
    <footer>
        <p class="w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">Copyright MYTutor&copy;</p>
    </footer>

</body>

</html>