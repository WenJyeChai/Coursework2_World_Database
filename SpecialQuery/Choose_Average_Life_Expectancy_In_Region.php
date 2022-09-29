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

<title>Average Life Expectancy In Region</title>

<body style="padding:10px;width:100vw;margin:0 auto;">
    
    <div class="toprow" style="display:flex;flex-direction: row;">
    <button onclick="window.location.href='../Select/Select_Population.php'" style="padding: 15px;">Back</button>
    </div>
    <div>
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Average Life Expectancy In Region</h1>
    </div>
    
<form id="Choose_Region_Form" method="POST" action="">
    
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
                    <button type="Submit" name='submit' value='submit' style="border:1px solid white;font-family: 'Open Sans', sans-serif;" >SUBMIT</button>
    </fieldset>
</form>
<?php
            if(isset($_POST['submit']))
            {
                $valueToSearch = $_POST["regionID"];
            	$sql = "SELECT country_region.RegionName, AVG(population.LifeExpectancy) AS 'AverageLifeExpectancy' FROM country_region INNER JOIN geographical_information ON country_region.RegionID= geographical_information.RegionID INNER JOIN general_information ON geographical_information.CountryCode=general_information.CountryCode INNER JOIN population ON general_information.CountryCode=population.CountryCode where country_region.RegionID= '$valueToSearch' GROUP BY country_region.RegionName";
                $data = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($data);
            	echo "</br></br>";
                echo "<fieldset>";
                echo "<legend style='padding:10px;font-size:30px;'>Result </legend>";
                echo "Average Life Expectancy In <span style='font-weight:bold'>";
                echo $result['RegionName'];
                echo "</span> is:<span style='font-weight:bold'>";
                echo $result['AverageLifeExpectancy'];
                echo "</span>";
                echo "</fieldset>";
            	$conn->close();  
            }
?>
</div>
</body>