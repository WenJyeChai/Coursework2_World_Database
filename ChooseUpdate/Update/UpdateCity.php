<?php
    require "../../database_linking.php";
    echo '<link rel="stylesheet" href="../../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../../css/big-device.css" />';
    echo '<link rel="icon" href="../../css/globe.png">';
    echo '<title>Update City</title>';
?>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
    </head>
        <body style="padding:10px;width:100vw;margin:0 auto;">
            <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='javascript:window.history.back()'" style="padding: 15px;font-size:20px;">BACK</button>
            </div>
            <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Update City</h1>
            </div>
            <form id="Update_City_Form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET") 
                                {
                                    // collect value of input field
                                    $c_ID = $_GET['CityID'];
                                    $sql = "SELECT * FROM `city`  WHERE city.CityID = '$c_ID'";
                                    $conn->query($sql);
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $c_name= $row["CityName"];
                                    $c_district = $row["DistrictID"];
                                    $c_population= $row["PopulationCity"];
                                    $sql = "SELECT district.DistrictName FROM district WHERE DistrictID='$c_district'";
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $c_district_name = $row["DistrictName"];
                                    echo "<div class='outer_insert' >
                                            <fieldset>
                                            <legend style='padding:20px;font-size:40px;'>Update City</legend>
                                                    <label for='City_name'>City Name :</label></br></br>
                                                    <input type='text' name='City_name' id='City_name' value='$c_name'></br></br>
                                                    <label for='DistrictID'>District Name :</label></br></br>";
                                    $sql = "SELECT DistrictID,DistrictName,country_name.CountryName FROM district INNER JOIN country_name where district.CountryCode=country_name.CountryCode ORDER BY district.DistrictID ASC";
                                    $result = $conn->query($sql);
                                        if ($result->num_rows > 0)
                                         {
                                            echo     "<select id='City_district' form='Update_City_Form' name='city_district'>"	;
                                            echo     "<option value='".utf8_encode($c_district)."' selected>".utf8_encode($c_district_name)."</option>"    ;
                                            while($row = $result->fetch_assoc())
                                            {
                                                echo "<option value=". utf8_encode($row["DistrictID"]).">"
                                                            . utf8_encode($row["DistrictName"]).
                                                            "&emsp;[". utf8_encode($row["CountryName"])."]
                                                        </option>";
                                            }
                                                echo "</select></br></br>";
                                        }
                                    echo "              <label for='City_population' style='line-height:1.0;'>City Population :</label></br></br>
                                                        <input type='number' name='City_population' id='City_population' value='$c_population'></br></br>
                                                        <input type='number' name='City_ID' id='City_ID' style='display:none' value='$c_ID'>
                                                        <input type = 'submit' name = 'submit' value = 'Submit'>
                                                        </fieldset>
                                                        </div>";
                                }
                            ?>

            </form>
            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") 
                            {
                                // collect value of input field
                                $c_ID = $_POST['City_ID'];
                                $c_name = $_POST['City_name'];
                                $c_population = $_POST['City_population'];
                                $c_district= $_POST['city_district'];
                                $sql = "SELECT district.CountryCode FROM `district` WHERE district.DistrictID=$c_district";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $c_country = $row["CountryCode"];
                                $sql="UPDATE city SET CityName = '$c_name', CountryCode = '$c_country_code',DistrictID=$c_district, PopulationCity = $c_population WHERE city.CityID = $c_ID;";
                                $conn->query($sql);
                                echo "<div class='outer_insert'>
                                        <fieldset>
                                        <legend style='padding:20px;font-size:40px;'>Notice</legend>
                                        Successfully updated the data.
                                        </fieldset>
                                        </div>";
                            }
            ?>
        </div>
    </body>
</html>

