<?php
    require "../../database_linking.php";
    echo '<link rel="stylesheet" href="../../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../../css/big-device.css" />';
    echo '<link rel="icon" href="../../css/globe.png">';
    echo '<title>Update District</title>';
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Update District</h1>
            </div>
            <form id="Update_District_Form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "GET") 
                            {
                                // collect value of input field
                                $d_ID = $_GET['DistrictID'];
                                $sql = "SELECT * FROM `district` WHERE district.DistrictID = '$d_ID'";
                                $conn->query($sql);
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $d_name= $row["DistrictName"];
                                $d_country = $row["CountryCode"];
                                $d_population= $row["PopulationDistrict"];
                                $sql = "SELECT country_name.CountryCode,country_name.CountryName FROM country_name WHERE CountryCode='$d_country'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $d_country_name = $row["CountryName"];
                                echo "<div class='outer_insert' >
                                        <fieldset>
                                        <legend style='padding:20px;font-size:40px;'>Update District</legend>
                                                <label for='district_name'>District Name :</label></br></br>
                                                <input type='text' name='district_name' id='district_name' value='$d_name'></br></br>
                                                <label for='countryCODE'>Country Name :</label></br></br>";
                                $sql = "SELECT country_name.CountryCode,country_name.CountryName FROM country_name";
                                $result = $conn->query($sql);
                                    if ($result->num_rows > 0)
                                     {
                                        echo     "<select id='District_country' form='Update_District_Form' name='District_country'>"	;
                                        echo     "<option value='".utf8_encode($d_country)."' selected>".utf8_encode($d_country_name)."</option>"    ;
                                        while($row = $result->fetch_assoc())
                                        {
                                            echo "  <option value=". utf8_encode($row["CountryCode"]).">"
                                                                        . utf8_encode($row["CountryName"]).
                                                 "</option>";
                                        }
                                            echo "</select></br></br>";
                                    }
                                echo "              <label for='district_population'style='line-height:1.0;'>District Population :</label></br></br>
                                                    <input type='number' name='district_population' id='district_population' value='$d_population'></br></br>
                                                    <input type='number' name='District_ID' id='District_ID' value='$d_ID' style='display:none;'>
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
                            $d_ID = $_POST['District_ID'];
                            $d_name = $_POST['district_name'];
                            $d_population = $_POST['district_population'];
                            $d_country_code= $_POST['District_country'];
                            $sql="UPDATE district SET DistrictName = '$d_name', CountryCode = '$d_country_code', PopulationDistrict = $d_population WHERE district.DistrictID = $d_ID;";
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
