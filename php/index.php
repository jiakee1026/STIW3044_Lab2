

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/menu.js" defer></script>
    <script src="../js/login.js" defer></script>

    <title>WELCOME TO MY TUTOR</title>
</head>

<body id="main" style="max-width:1200px;margin:0 auto;">
    <div class="w3-sidebar w3-bar-block w3-border" style="display:none;" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <div class="w3-container w3-card w3-padding w3-margin w3-center" style="max-height:350px;max-width:350px">
        </div>
        <hr>
        <a href="index.php" class="w3-bar-item w3-button">Profile</a>
        <a href="tutorlistpage.php" class="w3-bar-item w3-button">Tutors</a>
        <a href="subjectlistpage.php" class="w3-bar-item w3-button">Courses</a>
        <a href="subscriptionpage.php" class="w3-bar-item w3-button">Subscription</a>
        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>Subject</h3>
            <div>Welcome <?php echo $user_name ?></div>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
    </div>

    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h3>Subject Search</h3>
        <form>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search term" /></p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p> <select class="w3-input w3-block w3-round w3-border" name="option">
                        <option value="All">All</option>
                            <option value="Baby">Baby</option>
                            <option value="Bread">Bread</option>
                            <option value="Beverage">Beverage</option>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Condiment">Condiment</option>
                            <option value="Care Product">Care Product</option>
                            <option value="Canned Food">Canned Food</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Dried Food">Dried Food</option>
                            <option value="Grain">Grain</option>
                            <option value="Frozen">Frozen</option>
                            <option value="Health">Health</option>
                            <option value="Meat">Meat</option>
                            <option value="Miscellanaeous">Miscellanaeous</option>
                            <option value="Snack">Snack</option>
                            <option value="Pet">Pet</option>
                            <option value="Produce">Produce</option>
                            <option value="Household">Household</option>
                            <option value="Beverage">Vegetables</option>
                        </select>
                    </p>
                </div>
            </div>
            <button class="w3-button w3-yellow w3-round w3-right" type="submit" name="submit" value="search">search</button>
        </form>

    </div>
    <div class="w3-grid-template">
        <?php
        $i = 0;
        foreach ($rows as $products) {
            $i++;
            $prid = $products['product_id'];
            $prname = truncate($products['product_name'],15);
            $prtype = $products['product_type'];
            $prqty = $products['product_qty'];
            $prprice = number_format((float)$products['product_price'], 2, '.', ''); // $products['product_price'];
            $prst = $products['product_status'];
            echo "<div class='w3-card-4 w3-round' style='margin:4px'>
            <header class='w3-container w3-blue'><h5><b>$prname</b></h5></header>";
            echo "<a href='productdetails.php?prid=$prid' style='text-decoration: none;'> <img class='w3-image' src=../../assets/products/$prid.jpg" .
                " onerror=this.onerror=null;this.src='../../admin/res/newproduct.jpg'"
                . " style='width:100%;height:200px'></a><hr>";
            echo "<div class='w3-container'><p>Type: $prtype<br>Price: RM $prprice<br>Quantity: $prqty<br><div class='w3-button w3-yellow w3-round w3-block' onClick='addCart($prid)'>Add to Cart</div></p></div>
            </div>";
            
        }
        ?>
    </div>
    <br>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "index.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <br>
    
    <footer>
        <p class="w3-container w3-padding-32 w3-center" style="background-color: #D6EAF8">Copyright MYTutor&copy;</p>
    </footer>

</body>

</html>