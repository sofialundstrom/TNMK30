<?php include('../txt/header.txt'); ?>

<div class="searchContainer">
        <form class="searchForm" action="searchpagepart.php" method="POST">
            <input class="search" type="search" name="search" placeholder="Search..." required>
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
$offset = 0;
if(isset($_GET["offset"])){
    $offset = $_GET["offset"];
}


$sql_qurry = "SELECT inventory.ColorID, inventory.SetID, inventory.Quantity, inventory.ItemtypeID, inventory.ItemID, sets.Setname FROM inventory, sets
WHERE inventory.ItemID='$part' AND inventory.ColorID='$color' AND sets.SetID=inventory.SetID
ORDER BY Quantity DESC LIMIT $offset,  5";



$contents = mysqli_query ($connection, $sql_qurry );
$counter = 0;
print "<div class='container'>";
while($row = mysqli_fetch_array($contents)) {
    $itemtype = $row['ItemtypeID'];
    $item = $row['ItemID'];
    $set = $row['SetID'];
    $setname = $row['Setname'];
    $quantity = $row['Quantity'];
    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'SL' AND ItemID = '$sets'";

    $imagesearch = mysqli_query($connection, $sqlImg);

    $counter++;


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
                <img id='setImg' src='$prefix/SL/$set.jpg' alt='image'><br><div id='setName'>$setname</div><br><p>Amount:$quantity<br> ID: $set</p>
            </div>
        </a>");
  
}
print "</div>";

print "<div id='pagination'>";
if ($offset > 0) {
    $offsetPrev = $offset - 5;
    print("<a id='prev' href='searchset.php?part=$item&color=$color&offset=$offsetPrev'> Prev </a>");
}
if ($counter == 5) {
    $offsetNext = $offset + 5;
    print("<a id='next' href='searchset.php?part=$item&color=$color&offset=$offsetNext'> Next </a>");
}
print "</div>";
mysqli_close($connection);


include('../txt/footer.txt'); ?>
    

    