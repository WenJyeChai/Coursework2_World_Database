<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/insert_style.css">';	
?>

<head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
</head>

<title>GNP Growth In Region</title>
<body style="padding:10px;width:100vw;margin:0 auto;">
    <div class="toprow" style="display:flex;flex-direction: row;">
    <button onclick="window.location.href='../Select/Select_Economic_Status.php'" style="padding: 15px;">Back</button>
    </div>
    <div>
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">GNP Growth In Region</h1>
    </div>
    <form id="Choose_Region_Form" method="get" action="Select_GNP_Growth_In_Region.php">
    
    <div class="outer">
    
    <fieldset>
            <legend style="padding:10px;font-size:30px;">Region</legend>
                <label for="city_name">Region Name :</label></br></br>
                    <?php
                        $sql = "SELECT country_region.RegionID,country_region.RegionName FROM `country_region` ORDER BY `RegionID` ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo    "<select id='regionID' form='Choose_Region_Form' name='regionID' required>"	;
                            echo    "<option value='' disabled selected>Select your option</option>"    ;
                            while($row = $result->fetch_assoc())
                            {
                                echo "<option value=". utf8_encode($row["RegionID"]).">"
                                                        . utf8_encode($row["RegionName"]).
                                        "</option>";
                            }
                            echo "</select></br></br>";
                        }
                    ?>
                    <button type="Submit" style="border:1px solid white;font-family: 'Open Sans', sans-serif;" >SUBMIT</button>
    </fieldset>
    </div>
</form>
</div>
</body>