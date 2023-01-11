<!-- Include css, javascript,head and start of body -->
<?php include('../txt/header.txt');?>

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

    // Get information from url
    if(isset($_GET["set"])) {
        $set = $_GET["set"];
        $quantity = $_GET["quantity"];
        $part = $_GET["part"];
    }

    // Ask for information about sets
    $sql_qurry = "SELECT sets.Setname, sets.Year, sets.CatID FROM sets WHERE sets.SetID='$set'";
    $contents = mysqli_query ($connection, $sql_qurry );
    $row = mysqli_fetch_array($contents);

    // Ask for information about categories
    $sql_qurry2 = "SELECT categories.Categoryname FROM categories WHERE categories.CatID='$catID'";
    $contents2 = mysqli_query ($connection, $sql_qurry2 );
    $row2 = mysqli_fetch_array($contents2);

    // Ask information about part
    $sql_qurry3 = "SELECT inventory.ItemID, parts.Partname FROM parts, inventory WHERE inventory.ItemID=parts.PartID AND parts.PartID='$part'";
    $contents3 = mysqli_query ($connection, $sql_qurry3 );
    $row3 = mysqli_fetch_array($contents3);
    
    // Define variabels
    $prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';
    $setname = $row['Setname'];
    $year = $row['Year'];
    $catID = $row['CatID'];
    $catName = $row2['Categoryname']; 
    $partname = $row3['Partname'];
    
    // Print a picture of set and information about category and year released amongst other things
    print("
        <div id='setPageContainer'>
            <div class='setPageBackground'>
                <div class='setimage'>
                    <img src='$prefix/SL/$set.jpg' id='setPic' alt='Set picture'>
                </div> 
                <div id='setInfo'>
                    <h4 class='settitle'> Set: $setname</h4><br><p> ID: $set</p><br><p> Released $year</p><br><p> Category: $catName</p><br><p> Amount of $partname pieces needed: $quantity</p>
                </div>
            </div>
        </div>
    ");

// Include footer where body is closed
include('../txt/footer.txt'); ?>
    

    