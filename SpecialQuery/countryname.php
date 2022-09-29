<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
        <link rel="icon" href="../css/globe.png">
        <link rel="stylesheet" href="../css/Select_Style.css">
        <link rel="stylesheet" href="../css/insert_style.css">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
        <title>Country Name</title>
    </head>

    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php
            require "../database_linking.php";
        ?>
        
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_Country_Region.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">The Country within a Region with The Most People</h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:30px;">Region</legend>
                    <div class = "box">
                    <label for = "RegionName">Region Name : </label>
                    <select name= "RegionName" required>
                        <option value='' disabled selected>Select your option</option>
                        <?php
                            $sql1 = "SELECT country_region.RegionName FROM country_region";
                            $data1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_assoc($data1);
                            
                            while($result1 = mysqli_fetch_assoc($data1))
                            {
                                $RegionName = utf8_encode($result1['RegionName']);
                                echo "<option value= '$RegionName'>$RegionName</option>";
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
                if(isset($_POST['RegionName']))
                {
                    $RegionName = $_POST['RegionName'];
                }
                else{
                    $RegionName = "Region name is not set in Post Method";
                }
            
                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else
                {
                    echo "</br>";
                
                    $sql = "SELECT country_name.CountryName, population.PopulationCountry FROM country_name INNER JOIN general_information ON country_name.CountryCode = general_information.CountryCode INNER JOIN population ON general_information.CountryCode = population.CountryCode INNER JOIN geographical_information ON general_information.CountryCode = geographical_information.CountryCode INNER JOIN country_region ON geographical_information.RegionID = country_region.RegionID WHERE country_region.RegionName = '$RegionName' ORDER BY population.PopulationCountry DESC LIMIT 1";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    echo "</br></br>";
                    echo "<fieldset>";
                    echo "<legend style='padding:10px;font-size:30px;'>Result </legend>";
                    echo "Country Name:&emsp; ";
                    echo utf8_encode($result['CountryName']);
                    echo "<br><br>";
                    echo "Population in the country:&emsp; ";
                    echo "<span style='font-weight:bold;'>";
                    echo $result['PopulationCountry'];
                    echo "</span>";
                    echo "</fieldset>";

                    $conn -> close();
                }
            }
        ?>
        </div>
    </body>
</html>