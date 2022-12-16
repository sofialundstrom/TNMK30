<?php
$tableName = htmlspecialchars($_GET['table']);
if (isset($_GET['page'])) {
  $currentPage = htmlspecialchars($_GET['page']);
}else {
  $currentPage = 1;//default page
}

if (isset($_GET['itemsperpage'])) {
  $itemsPerPage = htmlspecialchars($_GET['itemsperpage']);
}else {
  $itemsPerPage = 5;//default limit
}

$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';
$search = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $search = mysqli_real_escape_string($connection, $_POST['search']);
}

?>


<?php include('../txt/header.txt'); ?>
    <div class="searchContainer">
        <form action="searchpagepart.php" method="POST">
            <input class="searchBox" type="search" name="search" placeholder="Search...">
        </form>
    </div>

<?php



$sql_qurry = "SELECT * FROM parts WHERE (Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%')
ORDER BY length(Partname) ASC LIMIT $itemsPerPage";


$contents = mysqli_query ($connection, $sql_qurry );


print "<div class='container'>";
while($row = mysqli_fetch_array($contents)) {
    //$quantity = $row['Quantity'];

    //$imagecolor = $row['ColorID'];

    //$itemtype = $row['ItemtypeID'];

    //$item = $row['ItemID'];
    
    $parts = $row['PartID'];
    $partname = $row['Partname'];
    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'P' AND ItemID = '$parts'";

    $imagesearch = mysqli_query($connection, $sqlImg);

    $info = mysqli_fetch_array($imagesearch);
    $imagecolor = $info['ColorID'];
    $itemtype = $info['ItemTypeID'];


    if($info['has_jpg'] == 1) {
        $filename = "$itemtype/$imagecolor/$parts.jpg";
    }
    else if($info['has_gif'] == 1) {
        $filename = "$itemtype/$imagecolor/$parts.gif";
    }
    else if($info['has_largejpg'] == 1) {
        $filename = "$itemtype/$parts.jpg";
    }
    else if($info['has_largegif'] == 1) {
        $filename = "$itemtype/$parts.gif";
    }
    else {
        $filename = "noimage_small.png";
    } 
    
    

    print("
        <a href='searchpagecolor.php?part=$parts'>
            <div class='part'>
                <img src='$prefix$filename' alt='legopart' id='legopartpic'><br><div class='partinfo'>$partname</div><br><p>ID: $parts</p>  
            </div>
        </a>");
}
print "</div>";

mysqli_close($connection);


include('../txt/footer.txt'); ?>
 