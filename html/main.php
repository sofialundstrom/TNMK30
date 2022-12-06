<?php include('../txt/header.txt'); ?>
    <h1>LEGO BANK</h1>
    <p class="undertext">Hej</p>
    <p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
    <div id="overlay-search">
            <form class="searchform" action="searchpage.php" method="POST">
                <input type="search" name="search" id="search" placeholder="Search your lego piece">
                <button class="button" type="submit">Search</button>
                <div class="button" id="help_btn">? </div>
            </form>
    </div>
           

    <div id="mymodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="helpbox">Press help for help</p>
            <img src="../bilder/pil.png" alt="bil">
        </div>
    </div>
    
<?php


$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}
$contents = mysqli_query ($connection, "SELECT SELECT parts.Partname, parts.PartID FROM parts WHERE Partname LIKE '%".$searchWord."%' OR PartID LIKE '%".$searchWord."%' ORDER BY LENGTH(Partname) ASC, PartID ASC LIMIT 5");


mysqli_close($connection);
// $contents = mysqli_query ($connection, "SELECT inventory.Quantity, colors.Colorname, parts.Partname, inventory.ColorID, inventory.ItemtypeID, inventory.ItemID FROM inventory, colors, parts WHERE inventory.SetID='5891-1' AND inventory.ItemtypeID='P' AND colors.ColorID=inventory.ColorID AND parts.PartID=inventory.ItemID");

    
  //  $contents = "  SELECT parts.Partname, parts.PartID
      //          FROM parts
        //        WHERE Partname LIKE '%".$searchWord."%' OR PartID LIKE '%".$searchWord."%'
          //      ORDER BY LENGTH(Partname) ASC, PartID ASC LIMIT 5";
 
        
 include('../txt/footer.txt'); ?>