<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Update Country</title>';
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Update Country</h1>
            </div>
            <form id="Choose_Update_Country_Form" method="get" action="Update/UpdateCountry.php">
                <div class="outer" >
                    <fieldset>
                        <legend style="padding:20px;font-size:40px;">Choose Country</legend>
                            <label for="city_name" style="padding:10px;font-size:30px;">Country Name :</label></br></br></br>
                                <?php
                                    $sql = "SELECT country_name.CountryCode,country_name.CountryName FROM country_name ORDER BY country_name.CountryCode ASC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        echo    "<select id='CountryCode' form='Choose_Update_Country_Form' name='CountryCode' required>"	;
                                        echo    "<option value='' disabled selected>Select your option</option>"    ;
                                        while($row = $result->fetch_assoc())
                                        {
                                            echo "<option value=". utf8_encode($row["CountryCode"]).">"
                                                                    . utf8_encode($row["CountryName"]).
                                                    "</option>";
                                        }
                                        echo "</select></br></br>";
                                    }
                                ?>
                            <input type = "submit" name = "submit" value = "Submit">
                    </fieldset>
                </div>
            </form>
        </div>
    </body>
</html>
