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
$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';

$offset = 0;
if(isset($_GET["offset"])){
    $offset = $_GET["offset"];
}

if(isset($_GET["part"])) {
    $part = $_GET["part"];
}


$sql_qurry = "SELECT inventory.Quantity, colors.Colorname, parts.Partname, inventory.ColorID, inventory.ItemtypeID, inventory.ItemID
FROM inventory, colors, parts WHERE inventory.ItemID='$part' AND inventory.ItemtypeID='P' AND parts.PartID=inventory.ItemID
ORDER BY ColorID ASC";


$contents = mysqli_query ($connection, $sql_qurry );

$row = mysqli_fetch_array($contents);

$quantity = $row['Quantity'];
$itemtype = $row['ItemtypeID'];
$item = $row['ItemID'];
$parts = $row['PartID'];
$partname = $row['Partname'];

print "<div class='container'>";

$sqlColor = "SELECT DISTINCT ColorID FROM inventory WHERE ItemID = '$part' LIMIT $offset, 5";

$colorContents = mysqli_query($connection, $sqlColor);



while($colorRow = mysqli_fetch_array($colorContents)) {
   
    $imagecolor = $colorRow['ColorID'];

    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'P' AND ItemID = '$item' AND ColorID = '$imagecolor'";

    $imagesearch = mysqli_query($connection, $sqlImg);

    $info = mysqli_fetch_array($imagesearch);
  

 
    if($info['has_jpg'] == 1) {
    
        $filename = "$prefix$itemtype/$imagecolor/$item.jpg";
    }
    else if($info['has_gif'] == 1) {
        $filename = "$prefix$itemtype/$imagecolor/$item.gif";
    }
    else {
        $filename = "../bilder/donkey.jpg";
    } 
    
   

    print("
        <a href='searchset.php?part=$item&color=$imagecolor'>
            <div class='part'>
                <img src='$filename' alt='legopart' id='legopartpic'><br><div class='partinfo'>$partname</div><br><p> ID: $item</p>
            </div>
        </a>");
    }

print "</div>";

print "<div id='pagination'>";
$offsetPrev = $offset - 5;
print("<a id='prev' href='searchpagecolor.php?part=$item&offset=$offsetPrev'> Prev </a>");
$offsetNext = $offset + 5;
print("<a id='next' href='searchpagecolor.php?part=$item&offset=$offsetNext'> Next </a>");
print "</div>";
mysqli_close($connection);




include('../txt/footer.txt'); ?>
 