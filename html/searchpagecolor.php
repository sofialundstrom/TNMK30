<?php include('../txt/header.txt'); ?>
    <div class="searchContainer">
        <form action="searchpagepart.php" method="POST">
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

if(isset($_GET["part"])) {
    $part = $_GET["part"];
}


$sql_qurry = "SELECT inventory.Quantity, colors.Colorname, parts.Partname, inventory.ColorID, inventory.ItemtypeID, inventory.ItemID
FROM inventory, colors, parts WHERE inventory.ItemID='$part' AND inventory.ItemtypeID='P' AND parts.PartID=inventory.ItemID
ORDER BY Colorname ASC, ColorID ASC LIMIT 5";


$contents = mysqli_query ($connection, $sql_qurry );

$row = mysqli_fetch_array($contents);

$quantity = $row['Quantity'];
$itemtype = $row['ItemtypeID'];
$item = $row['ItemID'];
$parts = $row['PartID'];
$partname = $row['Partname'];

print "<div class='container'>";

$sqlColor = "SELECT DISTINCT ColorID FROM inventory WHERE ItemID = '$part' LIMIT 5";

$colorContents = mysqli_query($connection, $sqlColor);



while($colorRow = mysqli_fetch_array($colorContents)) {
   
    $imagecolor = $colorRow['ColorID'];

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
                <img src='$prefix$filename' alt='legopart' id='legopartpic'>$partname<br>$item  
            </div>
        </a>");
    }

print "</div>";
/*
$limit= 4;

$total_rows = $colorRow[0];
$total_pages = ceil($total_rows / $limit);

$pageURL="";

if(isset($_GET["page"])) {
    $page_number= $_GET["page"];
}
else {
    $page_number = 1;
}

if($page_number >= 2) {
    echo "<a href='searchpagecolor.php?page=''.($page_number-1).'> Prev </a>";
}
for($i=1;$i<$total_pages; $i++){
    if($i == $page_number) {
        $pageURL .="<a class='active' href='searchpagecolor.php?page=".$i.'">'.$i."</a>";
    }

    else {
        $pageURL .="<a href='searchpagecolor.php?page=".$i.'">'.$i."</a>";
    }
};

echo $pageURL;

if($page_number<$total_pages) {
    echo "<a href= 'searchpagecolor.php?page=".($page_number+1).'"> Next </a>';
}
*/
mysqli_close($connection);


include('../txt/footer.txt'); ?>
 