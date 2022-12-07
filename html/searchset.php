<?php include('../txt/header.txt'); ?>

<div class="searchContainer">
    <form action="searchpage.php" method="POST">
        <input class="searchBox" type="search" name="search" placeholder="Search...">
    </form>
</div>


<?php

$prefix = 'https://weber.itn.liu.se/~stegu/img.bricklink.com/';

$sql_qurry = "SELECT inventory.ColorID, inventory.SetID, inventory.Quantity, inventory.ItemtypeID, inventory.ItemID sets.Setname FROM inventory, sets WHERE $_GET['part']=inventory.ItemID AND $_GET['color']=inventory.ColorID AND inventory.ItemtypeID='SL'
ORDER BY SetID ASC LIMIT 5";


$contents = mysqli_query ($connection, $sql_qurry );

print "<div class='container'>";
while($row = mysqli_fetch_array($contents)) {
    $itemtype = $row['ItemtypeID'];
    $item = $row['ItemID'];
    $sets = $row['SetÏD']
    $setname = $row['Setname']
    $sqlImg = "SELECT * FROM images WHERE ItemtypeID = 'SL' AND ItemID = '$item'";

    $imagesearch = mysqli_query($connection, $sqlImg);

    $info = mysqli_fetch_array($imagesearch);

    if($info['has_jpg'] == 1) {
    
        $filename = "$itemtype/$item.jpg";
    }
    else if($info['has_gif'] == 1) {
        $filename = "$itemtype/$item.gif";
    }
    else {
        $filename = "noimage_small.png";
    } 
    
    

    print("
        <a href='setpage.php'>
            <div class='part'>
                <img src='$prefix$filename' alt='set' class='legopartpic'>$setname<br>Amount:$quantity<br>$item  
            </div>
        </a>");
}
print "</div>";
mysqli_close($connection);


include('../txt/footer.txt'); ?>
    

    