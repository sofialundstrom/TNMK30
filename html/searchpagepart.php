<?php

session_start();

$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}

$offset = 0;
if(isset($_GET["offset"])){
    $offset = $_GET["offset"];
}

$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';
$search = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['search'] = mysqli_real_escape_string($connection, $_POST['search']);
}

if (isset($_SESSION['search'])) {
    $search = $_SESSION['search'];
}

?>

<?php include('../txt/header.txt'); ?>
    <div class="searchContainer">
        <form class="searchform" action="searchpagepart.php" method="POST">
            <input class="search" type="search" name="search" placeholder="Search..." required>
            <button class="button" type="submit">Search</button>
        </form>
    </div>

<?php



$sql_qurry = "SELECT DISTINCT * FROM parts WHERE (Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%')
ORDER BY length(Partname) ASC LIMIT $offset, 5";


$contents = mysqli_query ($connection, $sql_qurry );
/*
if(mysqli_fetch_array($contents) == null){
    echo("<p>There is no result, check your spelling or check help!</p>");
}
 */
$contents = mysqli_query ($connection, $sql_qurry );
print "<div class='container'>";
$counter = 0;
while($row = mysqli_fetch_array($contents)) {
    
    $counter++;
    

    $parts = $row['PartID'];
    $partname = $row['Partname'];
    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'P' AND ItemID = '$parts'";

    $imagesearch = mysqli_query($connection, $sqlImg);

    $info = mysqli_fetch_array($imagesearch);
    $imagecolor = $info['ColorID'];
    $itemtype = $info['ItemTypeID'];


    if($info['has_jpg'] == 1) {
        $filename = "$prefix$itemtype/$imagecolor/$parts.jpg";
    }
    else if($info['has_gif'] == 1) {
        $filename = "$prefix$itemtype/$imagecolor/$parts.gif";
    }
    else {
        $filename = "../bilder/itemnotfound.jpg";
    } 
    
    

    print("
        <a href='searchpagecolor.php?part=$parts'>
            <div class='part'>
                <img src='$filename' alt='legopart' id='legopartpic'><br><div class='partinfo'>$partname</div><br><p>ID: $parts</p>  
            </div>
        </a>");
}
print "</div>";

print "<div id='pagination'>";
if ($offset > 0) {
    $offsetPrev = $offset - 5;
    print("<a id='prev' href='searchpagepart.php?search=$search&offset=$offsetPrev'> Prev </a>");
}
if ($counter == 5) {
    $offsetNext = $offset + 5;
    print("<a id='next' href='searchpagepart.php?search=$search&offset=$offsetNext'> Next </a>");
}
print "</div>";
mysqli_close($connection);




include('../txt/footer.txt'); ?>
 