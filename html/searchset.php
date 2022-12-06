<?php include('../txt/header.txt');

$sql_qurry = "SELECT inventory.SetID, inventory.Quantity FROM inventory, colors, parts WHERE (Partname LIKE '%".$search."%' OR PartID LIKE '%".$search."%') AND inventory.ItemtypeID='P' AND colors.ColorID=inventory.ColorID AND parts.PartID=inventory.ItemID 
ORDER BY length(Partname) ASC, PartID ASC LIMIT 5";

include('../txt/footer.txt'); ?>
    

    