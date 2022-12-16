<?php
$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
if(!$connection){
    die('MySQL connection error');
}

if (isset($_GET['SearchInput'])){
    $searchWord = mysqli_real_escape_string ($connection, $_GET['SearchInput']);

    $query = "SELECT parts.Partname, parts.PartID FROM parts WHERE Partname LIKE '".$searchWord."%' OR PartID LIKE '".$searchWord."%' ORDER BY LENGTH (Partname) ASC, PartID ASC LIMIT 5";

    $result = mysqli_query ($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            
            $resultingPartnames[] = $row['Partname'];
        };
    } else {
        
        $resultingPartnames = array();
    }
    //echo $resultingPartnames;
    echo json_encode($resultingPartnames);
}
//echo "AA";
?>




