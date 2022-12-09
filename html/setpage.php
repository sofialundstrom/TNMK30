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

//$sql_qurry = "SELECT inventory.SetID, inventory.ItemtypeID, inventory.ItemID, sets.Setname, sets.Year FROM inventory, sets WHERE inventory.ItemID='$set' AND sets.SetID=inventory.SetID";

$sql_qurry = "SELECT sets.Setname, sets.Year, sets.CatID parts.Partname FROM sets, parts WHERE parts.Partname = '$part' AND sets.SetID='$set'";

$contents = mysqli_query ($connection, $sql_qurry );
$row = mysqli_fetch_array($contents);

$partname = $row['Partname'];
$sets = $row['SetID'];
$setname = $row['Setname'];
$year = $row['Year'];
$catID = $row['CatID'];

$sql_qurry2 = "SELECT categories.Categoryname FROM categories WHERE categories.CatID='$catID'";
$contents2 = mysqli_query ($connection, $sql_qurry2 );
$row2 = mysqli_fetch_array($contents2);
$catName = $row2['Categoryname']; 
print("
    <div class='container-setpage'>
        <div class='setimage'>
            <img src='$prefix/SL/$set.jpg' alt='Set picture'>
        </div> 
    </div>
    <div class='setinfo'>
    $setname<br>$set<br>$year<br>$catName<br>Amount of $partname needed: $quantity
    </div>
    ");

include('../txt/footer.txt'); ?>
    

    