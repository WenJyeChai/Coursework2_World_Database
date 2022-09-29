<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
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
            <form id="Choose_Update_District_Form" method="get" action="Update/UpdateDistrict.php">
                <div class="outer" >
                    <fieldset>
                        <legend style="padding:20px;font-size:40px;">Choose District</legend>
                            <label for="city_name" style="padding:10px;font-size:30px;">District Name :</label></br></br>
                                <?php
                                    $sql = "SELECT district.DistrictID,district.DistrictName FROM `district` ORDER BY `DistrictID` ASC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        echo    "<select id='DistrictID' form='Choose_Update_District_Form' name='DistrictID' required>"	;
                                        echo    "<option value='' disabled selected>Select your option</option>"    ;
                                        while($row = $result->fetch_assoc())
                                        {
                                            echo "<option value=". utf8_encode($row["DistrictID"]).">"
                                                                    . utf8_encode($row["DistrictName"]).
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

