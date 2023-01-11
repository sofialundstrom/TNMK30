<!-- Include css, javascript,head and start of body -->
<?php include('../txt/header.txt'); ?>

<!-- Code for search box -->   
<div class="searchContainer">
    <form class="searchForm" action="searchpagepart.php" method="POST">
        <!-- Required means user can't search if search bar empty -->
        <input class="search" type="search" name="search" placeholder="Search..." required>
        <button class="button" type="submit">Search</button>
    </form>
</div>

<?php

    // Connect to database
    $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
    if(!$connection){
        die('MySQL connection error');
    }

    // Define variabels
    $prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';

    // Keep track on which page and what should be displayed
    $offset = 0;
    if(isset($_GET["offset"])){
        $offset = $_GET["offset"];
    }

    // Get information from url
    if(isset($_GET["part"])) {
        $part = $_GET["part"];
    }

    // Ask for information related to part orded by ColorID
    $sql_qurry = "SELECT inventory.Quantity, colors.Colorname, parts.Partname, inventory.ColorID, inventory.ItemtypeID, inventory.ItemID
    FROM inventory, colors, parts WHERE inventory.ColorID=colors.ColorID AND inventory.ItemID=parts.PartID AND inventory.ItemID='$part' AND inventory.ItemtypeID='P' AND parts.PartID=inventory.ItemID
    ORDER BY ColorID ASC";

    $contents = mysqli_query ($connection, $sql_qurry );
    $row = mysqli_fetch_array($contents);

    // Define current variabels
    $quantity = $row['Quantity'];
    $itemtype = $row['ItemtypeID'];
    $item = $row['ItemID'];
    $parts = $row['PartID'];
    $partname = $row['Partname'];

    // Container to use flex box on information boxes
    print "<div class='container'>";

        // Retrive all distinct colors that the part has
        $sqlColor = "SELECT DISTINCT ColorID FROM inventory WHERE ItemID = '$part' LIMIT $offset, 5";
        $colorContents = mysqli_query($connection, $sqlColor);

        $counter = 0;

        // Does this loop while there is content to display
        while($colorRow = mysqli_fetch_array($colorContents)) {
        
            $imagecolor = $colorRow['ColorID'];

            // Select information for images
            $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'P' AND ItemID = '$item' AND ColorID = '$imagecolor'";
            $imagesearch = mysqli_query($connection, $sqlImg);
            $info = mysqli_fetch_array($imagesearch);

            // Counts how many objects are displayed to help with pagination
            $counter++;
        
            // Create link to each colors picture on another website, depending on if it is gif or jpg
            if($info['has_jpg'] == 1) {
            
                $filename = "$prefix$itemtype/$imagecolor/$item.jpg";
            }
            else if($info['has_gif'] == 1) {
                $filename = "$prefix$itemtype/$imagecolor/$item.gif";
            }
            // If there is no picture show a standard lego picture
            else {
                $filename = "../bilder/donkey.jpg";
            } 
        
            // Prints out a information box with info about PartID and partname for each color
            // There is also a link on the whole box to a site with different sets that have the part
            print("
                <a href='searchset.php?part=$item&color=$imagecolor'>
                    <div class='part'>
                        <img src='$filename' alt='legopart' id='legopartpic'><br><div class='partinfo'>$partname</div><br><p> ID: $item</p>
                    </div>
                </a>");
        }
    print "</div>";

    // So you can press prev or next if it exists
    print "<div id='pagination'>";
        
        // Only show previous if there are previous
        if ($offset > 0) {
            $offsetPrev = $offset - 5;
            print("<a id='prev' href='searchpagecolor.php?part=$item&offset=$offsetPrev'> Prev </a>");
        }
        // Only show next if the page is "full" of information boxes
        if ($counter == 5) {
            $offsetNext = $offset + 5;
            print("<a id='next' href='searchpagecolor.php?part=$item&offset=$offsetNext'> Next </a>");
        }
    print "</div>";
    
    // Close database connection
    mysqli_close($connection);

// Include footer where body is closed
include('../txt/footer.txt'); ?>
 