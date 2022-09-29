<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Insert City</title>';
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // collect value of input field
        $r_name = $_GET['Region_ID'];
    }
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Insert City</h1>
            </div>
            <form id="CityForm" action="Insert_City.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="outer_insert" >
                    <fieldset>
                            <legend style="padding:20px;font-size:40px;">City</legend>
                            <label for="region" style="padding:10px;font-size:30px;">City Name :</label></br></br></br>
                            <input type="text" name="city_name" id="city_name" required></br></br>
                            <label for="districtID" tyle="padding:10px;font-size:30px;">District Name :</label></br></br>
                            <?php
                            $sql = "SELECT DistrictID,DistrictName,country_name.CountryName FROM district INNER JOIN country_name where district.CountryCode=country_name.CountryCode ORDER BY district.DistrictID ASC";
                            $result = $conn->query($sql)
                              or die("Error: ".mysqli_error($conn));
                            if ($result->num_rows > 0) {
                                echo    "<select id='districtID' form='CityForm' name='city_district' required>"	;
                                echo    "<option value='' disabled selected>Select your option</option>"    ;
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option value=". utf8_encode($row["DistrictID"]).">"
                                                            . utf8_encode($row["DistrictName"]).
                                                            "&emsp;[". utf8_encode($row["CountryName"])."]
                                            </option>";
                                }
                                echo "</select></br></br>";
                            }
                            ?>
                            <label for="city_population" style="padding:10px;font-size:30px;">City Population :</label></br></br></br>
                            <input type="number" name="city_population" id="city_population"></br></br>
                            <input type = "submit" name = "submit" value = "Submit">
                    </fieldset>
                </div>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $c_name = $_POST['city_name'];
                    $c_district = $_POST['city_district'];
                    $c_population = $_POST['city_population'];
                    $sql = "SELECT district.CountryCode FROM `district` WHERE district.DistrictID=$c_district";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $c_country = $row["CountryCode"];
                    $statement = $conn -> prepare("INSERT INTO `city` (`CityID`, `CityName`, `CountryCode`, `DistrictID`, `PopulationCity`) VALUES (NULL, ?, ?, ?, ?)"); 
                    $statement -> bind_param("ssii",$c_name,$c_country,$c_district,$c_population);
                    $statement -> execute();
                    echo "<script>alert('Data is inserted');</script>";
                    $statement -> close();
                    $conn -> close();
                }
            ?>
        </div>
    </body>
</html>
