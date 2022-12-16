<?php include('../txt/header.txt');?>

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
    <div class='setinfo'>
    <h4 class='settitle'> Set: $setname</h4><br><p> ID: $set</p><br><p> Released $year</p><br><p> Category: $catName</p><br><p> Amount of $partname pieces needed: $quantity</p>
    
    </div>
    </div>
    ");

include('../txt/footer.txt'); ?>
    

    