<?php include('../txt/header.txt'); ?>
    <h1>LEGO BANK</h1>
    <p class="undertext">Hej</p>
    
    <div id="overlay-search">
            <form action="searchpage.php" method="POST">
                <input type="search" name="search" id="search" placeholder="Search your lego piece">
                <button type="submit">Search</button>
            </form>
 
    </div>
           <button id="help_btn">?</button>

    <div id="mymodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Press help for help</h2>
            <img src="../bilder/pil.png" alt="bil">
        </div>
    </div>
    <script src="../js/main.js"></script>
<?php


$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
$contents = mysqli_query ($connection, "SELECT SELECT parts.Partname, parts.PartID FROM parts WHERE Partname LIKE '%".$searchWord."%' OR PartID LIKE '%".$searchWord."%' ORDER BY LENGTH(Partname) ASC, PartID ASC LIMIT 5");

print ("<table>\n<tr>");

    print("<th>Part ID</th>");
    print("<th>Part name</th>");

print "</tr>\n";

while($row = mysqli_fetch_array($contents)) {

    $parts = $row['PartID'];
    $partname = $row['Partname'];
    
     print "<tr>";
    
        print("<td>$parts</td>");
        print("<td>$partname</td>");
        
    print "</tr>\n";
}
mysqli_close($connection);
// $contents = mysqli_query ($connection, "SELECT inventory.Quantity, colors.Colorname, parts.Partname, inventory.ColorID, inventory.ItemtypeID, inventory.ItemID FROM inventory, colors, parts WHERE inventory.SetID='5891-1' AND inventory.ItemtypeID='P' AND colors.ColorID=inventory.ColorID AND parts.PartID=inventory.ItemID");

    
  //  $contents = "  SELECT parts.Partname, parts.PartID
      //          FROM parts
        //        WHERE Partname LIKE '%".$searchWord."%' OR PartID LIKE '%".$searchWord."%'
          //      ORDER BY LENGTH(Partname) ASC, PartID ASC LIMIT 5";
 
        
 include('../txt/footer.txt'); ?>