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
$contents = mysqli_query ($connection, "SELECT parts.Partname, parts.PartID FROM parts WHERE Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%' ORDER BY LENGTH(Partname) ASC, PartID ASC LIMIT 5");

print "<div class='container'>";
while($row = mysqli_fetch_array($contents)) {

    $parts = $row['PartID'];
    $partname = $row['Partname'];
    print("<div class='part'>$parts$partname</div>");
        
}
print "</div>";
mysqli_close($connection);

include('../txt/footer.txt'); ?>
 