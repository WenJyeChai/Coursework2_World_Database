<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
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
            <form id="Choose_Update_City_Form" method="get" action="Update/UpdateCity.php">
                <div class="outer" >
                    <fieldset>
                        <legend style="padding:20px;font-size:40px;">Choose City</legend>
                                <label for="city_name" style="padding:10px;font-size:30px;">City Name :</label></br></br></br>
                                    <?php
                                        $sql = "SELECT city.CityID,city.CityName FROM `city` ORDER BY `CityID` ASC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            echo    "<select id='CityID' form='Choose_Update_City_Form' name='CityID' required>"	;
                                            echo    "<option value='' disabled selected>Select your option</option>"    ;
                                            while($row = $result->fetch_assoc())
                                            {
                                                echo "<option value=". utf8_encode($row["CityID"]).">"
                                                                        . utf8_encode($row["CityName"]).
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


