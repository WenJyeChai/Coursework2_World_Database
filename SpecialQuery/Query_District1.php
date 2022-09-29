
<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="../css/Select_Style.css">
    <link rel="stylesheet" href="../css/insert_style.css">	
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
    <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />	
    <title>District Population</title>
    <link rel="icon" href="../css/globe.png">

  </head>

  <body>
    <?php $input = $_POST["population"]?>
    
    <div class="toprow" style="display:flex;flex-direction: row;">
        <button onclick="window.location.href='../SpecialQuery/Input_District1.php'" style="padding: 15px;">Back</button>
    </div>
    
    <div>
        <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">District Population Below <?php echo "$input"?></h1>
    </div>
    </br>
    
<?php

    require "../database_linking.php";
    $input = $_POST["population"];

    $sql = "SELECT district.DistrictName, district.CountryCode, district.PopulationDistrict FROM district WHERE district.PopulationDistrict <= $input ORDER BY district.DistrictName ASC;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        echo "<table class = 'container'>";
        echo "<tr>                              
            <th>District Name</th>
            <th>Country Code</th>
            <th>Population</th>
            </tr>";

     while($row = mysqli_fetch_assoc($result)) {     //insert data into each row as array
        echo "<tr> 
                    <td>" . utf8_encode($row["DistrictName"]). "</td>                
                    <td>" . $row["CountryCode"].  "</td>
                    <td>" . $row["PopulationDistrict"].  "</td>";
        echo "</tr>";
                 
     }
     echo "</table>";

    } else {
      echo "0 results<br>";
    }

?>


</body>
</html>