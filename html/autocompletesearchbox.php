<?php

//Connect to the database
$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");

//Chech if the connection was successful
if(!$connection){
    die('MySQL connection error');
}

// Checj if the 'SearchInput' parameter is set in the GET request
if (isset($_GET['SearchInput'])){

    //Escapes special characters in a string for use in a SQL statement
    $searchWord = mysqli_real_escape_string ($connection, $_GET['SearchInput']);

    //The SQL query to be executed
    $query = "SELECT parts.Partname, parts.PartID FROM parts WHERE Partname LIKE '".$searchWord."%' OR PartID LIKE '".$searchWord."%' ORDER BY LENGTH (Partname) ASC, PartID ASC LIMIT 5";

    //Execute the query
    $result = mysqli_query ($connection, $query);
    
    //Check if there are any rows in the result
    if (mysqli_num_rows($result) > 0) {
        //Loop through each row in the result
        while ($row = mysqli_fetch_array($result)) {
            // Add the part name to the array
            $resultingPartnames[] = $row['Partname'];
        };
    } else {
        //If no results are found set the resultingPartnames to empty array
        $resultingPartnames = array();
    }
    //Return the resulting part names a a JSON encoded string
    echo json_encode($resultingPartnames);
}
//echo "AA";
?>




