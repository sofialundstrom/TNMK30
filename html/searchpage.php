<?php include('../txt/header.txt'); ?>
    <div class="searchContainer">
        <input class="searchBox" type="search" name="search" placeholder="Search...">
    </div>

<?php
$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
$contents = mysqli_query ($connection, "SELECT parts.Partname, parts.PartID FROM parts WHERE Partname LIKE '%".$searchWord."%' OR PartID LIKE '%".$searchWord."%' ORDER BY LENGTH(Partname) ASC, PartID ASC LIMIT 5");

while($row = mysqli_fetch_array($contents)) {

    $parts = $row['PartID'];
    $partname = $row['Partname'];
    
     print "<div class='container'>";
    
        print("<div class='part'>$parts$partname</div>");
        
    print "</div>";
}
mysqli_close($connection);

<?php include('../txt/footer.txt'); ?>
 