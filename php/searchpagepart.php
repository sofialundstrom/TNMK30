<?php

    // Start session
    session_start();

    // Connect to database
    $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
    if(!$connection){
        die('MySQL connection error');
    }

    // To keep track on which page and what items should be displayed
    $offset = 0;
    if(isset($_GET["offset"])){
        $offset = $_GET["offset"];
    }

    // Define variabels
    $prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';
    $search = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $_SESSION['search'] = mysqli_real_escape_string($connection, $_POST['search']);
    }

    if (isset($_SESSION['search'])) {
        $search = $_SESSION['search'];
    }

// Include css, javascript, head and start of body
include('../txt/header.txt'); ?>

<!-- Code for search box -->    
<div class="searchContainer">
    <form class="searchForm" action="searchpagepart.php" method="POST">
        <!-- Required means user can't search if search bar empty -->
        <input class="search" type="search" name="search" placeholder="Search..." required>
        <button class="button" id="searchButton" type="submit">Search</button>
    </form>
</div>

<?php

    // Selects distinct parts and information related to search
    $sqlQuery = "SELECT DISTINCT * FROM parts WHERE (Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%')
    ORDER BY length(Partname) ASC LIMIT $offset, 5";

    $contents = mysqli_query ($connection, $sqlQuery);

    // Ask for information to be able to count how many parts there are
    $sqlCounter = "SELECT DISTINCT * FROM parts WHERE (Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%')
    ORDER BY length(Partname) ASC";

    $contentsCounter = mysqli_query ($connection, $sqlCounter);

    // Writes an error message if there are no results
    if (!$contents || mysqli_num_rows($contents) == 0) {
        print("
            <div class=error>
                <p class='headerError'>There are no results!</p>
                <p class='pError'>Try checking your spelling</p>
            </div>
        ");
    }

    // Container to use flex box on the information boxes
    print "<div class='container'>";

        $counter = 0;
        $notDisplayed = 0;

        // Does this loop while there is content to display
        while($row = mysqli_fetch_array($contents)) {
            
            // Define variabels
            $parts = $row['PartID'];
            $partname = $row['Partname'];

            // Ask to see each color for the current part
            $sqlColor = "SELECT DISTINCT ColorID FROM inventory WHERE ItemID = '$parts'";
            $colorContents = mysqli_query($connection, $sqlColor);

            // Selects everything from images
            $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'P' AND ItemID = '$parts'";
            $imagesearch = mysqli_query($connection, $sqlImg);
            $info = mysqli_fetch_array($imagesearch);

            // Define variabels
            $imagecolor = $info['ColorID'];
            $itemtype = $info['ItemTypeID'];

            // Create link to each parts picture on another website, depending on if it is gif or jpg
            if($info['has_jpg'] == 1) {
                $filename = "$prefix$itemtype/$imagecolor/$parts.jpg";
            }
            else if($info['has_gif'] == 1) {
                $filename = "$prefix$itemtype/$imagecolor/$parts.gif";
            }
            // If there is no picture show thisas a standard picture
            else {
                $filename = "../bilder/noneitem.lego.png";
            } 
            
            // If there are no colors for current parts do not display
            if(!$contents || mysqli_num_rows($colorContents) != 0)  {
                
                // Counts how many objects are displayed to help with pagination
                $counter++;


                // Prints out a information box with info about PartID and partname, and a picture of the part
                // There is also a link on the whole box to new site where color for part is chosen
                print("
                    <a href='searchpagecolor.php?part=$parts'>
                        <div class='part'>
                            <img src='$filename' alt='legopart' id='legoPartPic'><br><div id='partInfo'>$partname</div><br><p>ID: $parts</p>  
                        </div>
                    </a>");
            }
            // Counts items not showed to help pagination
            else {
                $notDisplayed++;
            }
        } 
    print "</div>";

    // So you can press prev or next if it exists
    print "<div id='pagination'>";
        
        // Only show previous if there are previous
        if ($offset > 0) {
            $offsetPrev = $offset - 5;
            print("<a id='prev' href='searchpagepart.php?search=$search&offset=$offsetPrev'> Prev </a>");
        }
        // Only show next on the page if there are more parts left than used previous 
        if (mysqli_num_rows($contentsCounter) - ($offset + $counter + $notDisplayed) > 0) {
            $offsetNext = $offset + 5;
            print("<a id='next' href='searchpagepart.php?search=$search&offset=$offsetNext'> Next </a>");
        }
    print "</div>";

    // Close database connection
    mysqli_close($connection);

// Include footer where body is closed
include('../txt/footer.txt'); ?>
 