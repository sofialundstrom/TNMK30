<?php include('../txt/header.txt'); ?>
    <div class="searchContainer">
        <form action="searchpage.php" method="POST">
            <input class="searchBox" type="search" name="search" placeholder="Search...">
        </form>
    </div>

<?php
$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $search = mysqli_real_escape_string($connection, $_POST['search']);
}
$sql_qurry = "SELECT inventory.SetID, inventory.Quantity, colors.Colorname, parts.Partname, inventory.ColorID, inventory.ItemtypeID, inventory.ItemID 
FROM inventory, colors, parts WHERE (Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%') AND inventory.ItemtypeID='P' AND colors.ColorID=inventory.ColorID AND parts.PartID=inventory.ItemID 
ORDER BY length(Partname) ASC, PartID ASC LIMIT 5";

$contents = mysqli_query ($connection, $sql_qurry );



print "<div class='container'>";
while($row = mysqli_fetch_array($contents)) {
    $quantity = $row['Quantity'];
    $imagecolor = $row['ColorID'];
    $itemtype = $row['ItemtypeID'];
    $item = $row['ItemID'];
    $parts = $row['PartID'];
    $partname = $row['Partname'];
    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'P' AND ItemID = '$item' AND ColorID = '$imagecolor'";

    $imagesearch = mysqli_query($connection, $sqlImg);

    $info = mysqli_fetch_array($imagesearch);

    if($info['has_jpg'] == 1) {
    
        $filename = "$itemtype/$imagecolor/$item.jpg";
    }
    else if($info['has_gif'] == 1) {
        $filename = "$itemtype/$imagecolor/$item.gif";
    }
    else {
        $filename = "noimage_small.png";
    } 
    
    

    print("
        <a href='searchset.php?part=$item&color=$imagecolor'>
            <div class='part'>
                <img src='$prefix$filename' alt='legopart' class='legopartpic'>$partname<br>$item  
            </div>
        </a>");
}
print "</div>";
mysqli_close($connection);


include('../txt/footer.txt'); ?>
 