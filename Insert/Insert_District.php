<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../../css/globe.png">';
    echo '<title>Insert District</title>';
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Insert District</h1>
            </div>
            <form id="DistrictForm" action="Insert_District.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="outer_insert" >
                    <fieldset>
                            <legend style="padding:20px;font-size:40px;">District</legend>
                            <label for="district_name">District Name :</label></br></br>
                            <input type="text" name="district_name" id="district_name" required></br></br>
                            <label for="countryCODE">Country Name :</label></br></br>
                            <?php
                            $sql = "SELECT country_name.CountryCode,country_name.CountryName FROM country_name";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo     "<select id='countryCODE' form='DistrictForm' name ='district_country' required>"	;
                                echo    "<option value='' disabled selected>Select your option</option>"    ;
                                while($row = $result->fetch_assoc())
                                {
                                    echo "  <option value=". utf8_encode($row["CountryCode"]).">"
                                                            . utf8_encode($row["CountryName"]).
                                            "</option>";
                                }
                                echo "</select></br></br>";
                            }
                            ?>
                            <label for="district_population"style="line-height:1.0;">District Population :</label></br></br>
                            <input type="number" name="district_population" id="district_population"></br></br>
                            <input type = "submit" name = "submit" value = "Submit">
                    </fieldset>
                </div>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $d_name = $_POST['district_name'];
                    $d_country = $_POST['district_country'];
                    $d_population = $_POST['district_population'];
                    $statement = $conn -> prepare("INSERT INTO `district` (`DistrictID`, `DistrictName`, `CountryCode`, `PopulationDistrict`) VALUES (NULL, ?, ?, ?)"); 
                    $statement -> bind_param("ssi",$d_name,$d_country,$d_population);
                    $statement -> execute();
                    echo "<script> alert('Data is inserted'); </script> ";
                    $statement -> close();
                    $conn -> close();
                }
            ?>
        </div>
    </body>
</html>



