<!-- Include css, javascript,head and start of body -->
<?php include('../txt/header.txt'); ?>

<!-- Code for search box -->   
<div class="searchContainer">
    <form class="searchform" action="searchpagepart.php" method="POST">
        <!-- Required means user can't search if search bar empty -->
        <input class="search" type="search" name="search" placeholder="Search..." required>
        <button class="button" type="submit">Search</button>
    </form>
</div>

<?php

    // Connect to the database
    $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
    if(!$connection){
        die('MySQL connection error');
    }

    // Get information from url
    if(isset($_GET["part"]) && isset($_GET["color"])) {
        $part = $_GET["part"];
        $color = $_GET["color"];
    }

    // Define variabels
    $prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';
    $offset = 0;

    // Keep track on which page should be displayed
    if(isset($_GET["offset"])){
        $offset = $_GET["offset"];
    }

    // Ask for information about parts and sets orded by quantity of parts
    $sql_qurry = "SELECT inventory.ColorID, inventory.SetID, inventory.Quantity, inventory.ItemtypeID, inventory.ItemID, sets.Setname FROM inventory, sets
    WHERE inventory.ItemID='$part' AND inventory.ColorID='$color' AND sets.SetID=inventory.SetID
    ORDER BY Quantity DESC LIMIT $offset,  5";

    $contents = mysqli_query ($connection, $sql_qurry );

    // Container to use flex box on information boxes
    print "<div class='container'>";

        $counter = 0; 
        
        // Does this loop while there is content to display
        while($row = mysqli_fetch_array($contents)) {

            // Define current variabels
            $itemtype = $row['ItemtypeID'];
            $item = $row['ItemID'];
            $set = $row['SetID'];
            $setname = $row['Setname'];
            $quantity = $row['Quantity'];

            //Select information for images
            $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'SL' AND ItemID = '$sets'";
            $imagesearch = mysqli_query($connection, $sqlImg);
            $info = mysqli_fetch_array($imagesearch);
            
            // Counts how many objects are displayed
            $counter++;

            // Create link to each colors picture on another website, depending on if it is a gif or jpg
            if($info['has_jpg'] == 1) {
                $filename = "SL/$set.jpg";
                echo("$prefix$filename");
            }
            else if($info['has_gif'] == 1) {
                $filename = "SL/$set.gif";
            }
            // If there is no picture show this as a standard lego picture
            else {
                $filename = "noimage_small.png";
            } 
            
            // Print out information box with info about current set
            // There is a link on the whole box to a site with information about the specific set
            print("
                <a href='setpage.php?set=$set&quantity=$quantity&part=$part'>
                    <div class='set'>
                        <img id='setImg' src='$prefix/SL/$set.jpg' alt='image'><br><div id='setname'>$setname</div><br><p>Amount:$quantity<br> ID: $set</p>
                    </div>
                </a>");
        
        }
    print "</div>";

    // So you can press prev or next if it exists
    print "<div id='pagination'>";
    
        // Only show previous if there are previous
        if ($offset > 0) {
            $offsetPrev = $offset - 5;
            print("<a id='prev' href='searchset.php?part=$item&color=$color&offset=$offsetPrev'> Prev </a>");
        }
        // Only show next if the page is "full" of information boxes
        if ($counter == 5) {
            $offsetNext = $offset + 5;
            print("<a id='next' href='searchset.php?part=$item&color=$color&offset=$offsetNext'> Next </a>");
        }
    print "</div>";

    // Close database connection
    mysqli_close($connection);

// Include footer where body is closed
include('../txt/footer.txt'); ?>
    

    