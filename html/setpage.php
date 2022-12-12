<?php include('../txt/header.txt');

$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
if(isset($_GET["set"])) {
    $set = $_GET["set"];
    $quantity = $_GET["quantity"];
    $part = $_GET["part"];
}

$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';

$sql_qurry = "SELECT sets.Setname, sets.Year, sets.CatID FROM sets WHERE sets.SetID='$set'";

$contents = mysqli_query ($connection, $sql_qurry );
$row = mysqli_fetch_array($contents);


$setname = $row['Setname'];
$year = $row['Year'];
$catID = $row['CatID'];

$sql_qurry2 = "SELECT categories.Categoryname FROM categories WHERE categories.CatID='$catID'";

$contents2 = mysqli_query ($connection, $sql_qurry2 );
$row2 = mysqli_fetch_array($contents2);
$catName = $row2['Categoryname']; 

$sql_qurry3 = "SELECT inventory.ItemID, parts.Partname FROM parts, inventory WHERE inventory.ItemID=parts.PartID AND parts.PartID='$part'";
$contents3 = mysqli_query ($connection, $sql_qurry3 );
$row3 = mysqli_fetch_array($contents3);
$partname = $row3['Partname'];
print("
    <div class='container-setpage'>
        <div class='setimage'>
            <img src='$prefix/SL/$set.jpg' class='setpic' alt='Set picture'>
        </div> 
    </div>
    <div class='setinfo'>
    $setname<br>$set<br>$year<br>$catName<br>Amount of $partname needed: $quantity
    </div>
    ");

include('../txt/footer.txt'); ?>
    

    