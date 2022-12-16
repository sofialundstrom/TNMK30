<?php include('../txt/header.txt'); ?>

<div class="searchContainer">
        <form class="searchform" action="searchpagepart.php" method="POST">
            <input class="search" type="search" name="search" placeholder="Search...">
            <button class="button" type="submit">Search</button>
        </form>
    </div>



<?php

$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
if(isset($_GET["part"]) && isset($_GET["color"])) {
    $part = $_GET["part"];
    $color = $_GET["color"];
}

$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';

$sql_qurry = "SELECT inventory.ColorID, inventory.SetID, inventory.Quantity, inventory.ItemtypeID, inventory.ItemID, sets.Setname FROM inventory, sets
WHERE inventory.ItemID='$part' AND inventory.ColorID='$color' AND sets.SetID=inventory.SetID
ORDER BY Quantity DESC LIMIT 5";



$contents = mysqli_query ($connection, $sql_qurry );

print "<div class='container'>";
while($row = mysqli_fetch_array($contents)) {
    $itemtype = $row['ItemtypeID'];
    $item = $row['ItemID'];
    $set = $row['SetID'];
    $setname = $row['Setname'];
    $quantity = $row['Quantity'];
    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'SL' AND ItemID = '$sets'";

    $imagesearch = mysqli_query($connection, $sqlImg);




    $info = mysqli_fetch_array($imagesearch);

    if($info['has_jpg'] == 1) {
        $filename = "SL/$set.jpg";
        echo("$prefix$filename");
    }
    else if($info['has_gif'] == 1) {
        $filename = "SL/$set.gif";
    }
    else {
        $filename = "noimage_small.png";
    } 
    
    
    print("
        <a href='setpage.php?set=$set&quantity=$quantity&part=$part'>
            <div class='set'>
                <img id='setImg' src='$prefix/SL/$set.jpg' alt='image'><br><div id='setinfo'>$setname</div><br><p>Amount:$quantity<br> ID: $item</p>
            </div>
        </a>");
  
}
print "</div>";

mysqli_close($connection);


include('../txt/footer.txt'); ?>
    

    