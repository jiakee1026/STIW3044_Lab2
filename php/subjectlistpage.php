<?php
session_start();
include_once("dbconnect.php");
if ($_SESSION["session_id"]) {
    if (isset($_GET['subject_id'])) {
        $subject_id = $_GET['subject_id'];
        $sqldelete = "DELETE FROM tbl_subjects WHERE subject_id = '$subject_id'";
        $stmt = $conn->prepare($sqldelete);
        if ($stmt->execute()) {
            echo "<script> alert('Delete Success')</script>";
        } else {
            echo "<script> alert('Delete Failed')</script>";
        }
    }
    if (isset($_GET['button'])) {
        $option = $_GET['option'];
        $search = $_GET['search'];
        if ($option == "id") {
            $sqlsubjects = "SELECT * FROM tbl_subjects WHERE subject_id LIKE '%$search%'";
        }
        if ($option == "name") {
            $sqlsubjects = "SELECT * FROM tbl_subjects WHERE subject_name LIKE '%$search%'";
        }
 
    } else {
        $sqlsubjects = "SELECT * FROM tbl_subjects ORDER BY date_reg DESC";
    }
    $results_per_page = 10;
    if (isset($_GET['pageno'])) {
        $pageno = (int)$_GET['pageno'];

        $page_first_result = ($pageno - 1) * $results_per_page;
    } else {
        $pageno = 1;
        $page_first_result = ($pageno - 1) * $results_per_page;
    }


    $stmt = $conn->prepare($sqlsubjects);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    $number_of_page = ceil($number_of_result / $results_per_page);

    $sqlsubjects = $sqlsubjects . " LIMIT $page_first_result , $results_per_page";
    $stmt = $conn->prepare($sqlsubjects);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
} else {
    echo "<script> alert('Session not available. Please login')</script>";
    echo "<script> window.location.replace('../loginpage.php')</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>WELCOME TO MY TUTOR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/myscript.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <h1>My Tutor</h1>
    </div>
    <div class="topnavbar" id="myTopnav">
        <a href="../loginpage.php?status=logout" onclick="logout()" class="right">Logout</a>
    </div>
    <center>
        <h2>Subject List</h2>
        <div class="container">
            <form action="subjectlistpage.php" align="center">
                <div class="selectsearch">
                    <input type="search" id="idsearch" name="search" placeholder="Enter search term" />
                    <select name="option" id="srcid">
                        <option value="subject_name">By Subject Name</option>
                        <option value="subject_id">By Id</option>
                    </select>
                    <button type="submit" name="button" value="search">search</button>
                </div>
            </form>
        </div>
    </center>
    <div class="main-landing">
        <center>
            <?php

            echo "<div class='card-names'>";
            foreach ($rows as $subject) {
                $subject_id = $subject['subject_id'];
                echo "<div class='card' style='overflow-x:auto;text-align:center;'>";
                echo "<table><tr><td style='width:35%'; ><img class='profileimg' src=../../assets/courses/" . $subject['subject_id'] . ".png" . " "></td>";
                echo "<td style='width:65%'>";
                echo "<table style='width:100%'>";
                echo "<tr><td style='width:30%'>ID: </td><td style='width:70%'>" . ($subject['subject_id']) . "</td></tr>";
                echo "<tr><td style='width:30%'>Name: </td><td style='width:70%'>" . ($subject['subject_name']) . "</td></tr>";
                echo "<tr><td style='width:30%'>Description: </td><td style='width:70%'>" . ($subject['subject_description']) . "</td></tr>";
                echo "<tr><td style='width:30%'>Price: </td><td style='width:70%'>" . ($subject['subject_price']) . "</td></tr>";
                echo "<tr><td style='width:30%'>Session: </td><td style='width:70%'>" . ($subject['subject_sessions']) . "</td></tr>";
                echo "<tr><td style='width:30%'>Rating: </td><td style='width:70%'>" . ($subject['subject_rating']) . "</td></tr>";
                echo "<tr><td colspan='2'><button onclick='return deleteDialog()'><a href='subjectlistpage.php?subject_id=$subject_id'>Delete</a></button>&nbsp&nbsp
                echo "</table>";
                echo "</td></tr></table>";
                echo "</div>";
            }
            echo "</div>";
            ?>
        </center>
        <?php
        $num = 1;
        if ($pageno == 1) {
            $num = 1;
        } else if ($pageno == 2) {
            $num = ($num) + 10;
        } else {
            $num = $pageno * 10 - 9;
        }
        echo "<div class='row-pages'>";
        echo "<center>";
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a href = "subjectlistpage.php?pageno=' . $page . '">&nbsp&nbsp' . $page . ' </a>';
        }
        echo " ( " . $pageno . " )";
        echo "</center>";
        echo "</div>";
        ?>
    </div>

    <footer>
        <p class="w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">Copyright MYTutor&copy;</p>
    </footer>

</body>

</html>