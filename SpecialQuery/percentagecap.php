<!DOCTYPE html>
<html>
    <head><meta charset="utf-8">
        
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
        <link rel="icon" href="../css/globe.png">
        <link rel="stylesheet" href="../css/insert_style.css">
        <link rel="stylesheet" href="../css/Select_Style.css">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
        <title>Percentage of the capital</title>
    </head>
    
    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php
            require "../database_linking.php";
        ?>
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_City.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Percentage of Population Living in the Capital</h1>
        </div>
        
        <form method = "post" action="">
        
        <div class="outer">
            <fieldset>
                <legend style="padding:10px;font-size:30px;">Capital City</legend>
                <div class="box">
                    <label for = "Capital City">Name : </label>
                    
                        <select name="CityID" required>
                            <option value='' disabled selected>Select your option</option>
                            <?php
                                $sql1 = "SELECT city.cityID, city.CityName FROM city INNER JOIN general_information ON city.CityID = general_information.Capital ORDER BY CityName ASC";
                                $data1 = mysqli_query($conn, $sql1);
                                $result1 = mysqli_fetch_assoc($data1);
                                while($result1 = mysqli_fetch_assoc($data1))
                                {
                                    $CapitalCity = utf8_encode($result1['CityName']);
                                    $CityID = $result1['cityID'];
                                    echo "<option value= '$CityID'>$CapitalCity</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <br>
                    <input type = "submit" name = "submit" value = "Submit">
                </fieldset>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                if(isset($_POST['CityID']))
                {
                    $CapitalCity = $_POST['CityID'];
                }
                else
                {
                    $CapitalCity = "Capital city is not set in Post Method";
                }

                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else{
                    $sql = "SELECT general_information.Capital ,city.CityName, (city.PopulationCity / population.PopulationCountry) * 100 FROM general_information INNER JOIN city ON general_information.Capital = city.CityID INNER JOIN population ON general_information.CountryCode = population.CountryCode WHERE city.CityID = '$CapitalCity'";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    echo "</br></br>";
                    echo "<fieldset>";
                    echo "<legend style='padding:10px;font-size:30px;'>Result </legend>";
                    echo "The percentage of people living in ";
                    $cityName = utf8_encode($result['CityName']);
                    echo "$cityName is ";
                    echo "<span style='font-weight:bold;'>";
                    echo utf8_encode($result['(city.PopulationCity / population.PopulationCountry) * 100']);
                    echo " %";
                    echo "</span>";
                    echo "</fieldset>";
                }
            }
        ?>
        </div>
    </body>
</html>