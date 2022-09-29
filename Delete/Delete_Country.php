<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Delete Country</title>';
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // collect value of input field
        $c_name = $_GET['CountryCode'];
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Delete Country</h1>
            </div>
            <form id="DeleteCountryForm" action="Delete_Country.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                            <?php
                            echo "<div class='outer'>
                    <fieldset>
                            <legend style='padding:20px;font-size:40px;'>Delete Country</legend>
                            <label for='country_name' style='padding:10px;font-size:30px;'>Country Name :</label></br></br></br>";
                            $sql = "SELECT country_name.CountryCode,country_name.CountryName FROM `country_name` ORDER BY `CountryCode` ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo    "<select id='CountryCode' form='DeleteCountryForm' name='CountryCode' required>"	;
                                echo    "<option value='' disabled selected>Select your option</option>"    ;
                                if ($c_name!=NULL)
                                {
                                    $query="SELECT country_name.CountryCode,country_name.CountryName FROM `country_name` where CountryCode='$c_name'";
                                    $s_result = $conn->query($query);
                                    $s_row = $s_result->fetch_assoc();
                                    echo    "<option value='". utf8_encode($s_row["CountryCode"])."' selected>". utf8_encode($s_row["CountryName"])."</option>"    ;
                                }
                                else
                                    echo    "<option value='' disabled selected>Select your option</option>"    ;
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option value=". utf8_encode($row["CountryCode"]).">"
                                                            . utf8_encode($row["CountryName"]).
                                            "</option>";
                                }
                                echo "</select></br></br>
                                <input type = 'submit' name = 'submit' value = 'Submit'>
                    </fieldset>
                </div>";
                            }
                            ?>
                            
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $c_name = $_POST['CountryCode'];
                    $sql = "DELETE general_information, country_name,city,district,geographical_information,population,economic_status,country_language FROM general_information LEFT JOIN country_name ON country_name.CountryCode=general_information.CountryCode LEFT JOIN city ON city.CountryCode=general_information.CountryCode LEFT JOIN district ON district.CountryCode=general_information.CountryCode LEFT JOIN geographical_information ON geographical_information.CountryCode=general_information.CountryCode LEFT JOIN population ON population.CountryCode=general_information.CountryCode LEFT JOIN economic_status ON general_information.CountryCode=economic_status.CountryCode LEFT JOIN country_language ON country_language.CountryCode=general_information.CountryCode WHERE general_information.CountryCode = '$c_name'";
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
