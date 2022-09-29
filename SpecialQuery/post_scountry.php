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
        <title>Search for a Country</title>
    </head>

    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php 
            require "../database_linking.php";
        ?>
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_City.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Capital City Searcher</h1>
        </div>
        
        <form method = "post" action = "post_scountry.php">
            <div class="outer">
            <fieldset>
                <legend style="padding:10px;font-size:30px;">Capital City</legend>
                <div class="box">
                    <label for = "CityName">City Name : </label>
                    </br>
                    </br>
                        <select name = "CityID" required>
                            <option value='' disabled selected>Select your option</option>
                            <?php
                                $sql1= "SELECT city.cityID, city.CityName FROM city INNER JOIN general_information ON general_information.Capital = city.CityID ORDER BY city.CityName ASC";
                                $data1 = mysqli_query($conn, $sql1);
                                $result1 = mysqli_fetch_assoc($data1);
                                while($result1 = mysqli_fetch_assoc($data1))
                                {
                                    $City = utf8_encode($result1['CityName']);
                                    $CityID = $result1['cityID'];
                                    echo "<option value= '$CityID'>$City</option>";
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
                    $City = $_POST['CityID']; 
                }else
                {
                    $City = "City not set in POST Method";
                }

                if($conn -> connect_error)
                {
                    die("Connection failed: ".$conn -> connect_error);
                }

                else
                {
                    $sql = "SELECT country_name.CountryName,city.CityName FROM country_name INNER JOIN general_information ON country_name.CountryCode = general_information.CountryCode INNER JOIN city ON general_information.CountryCode=city.CountryCode WHERE city.CityID = '$City'";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    echo "</br></br>";
                    echo "<fieldset>";
                    echo "<legend style='padding:10px;font-size:30px;'>Result </legend>";
                    echo utf8_encode($result['CityName']) ;
                    echo " is located in ";
                    echo "<span style='font-weight:bold;'>";
                    echo utf8_encode($result['CountryName']);
                    echo "</span>";
                    echo "</fieldset>";
                    
                    $conn -> close();
                }
            }
        ?>

    </div>
    </body>
</html>
