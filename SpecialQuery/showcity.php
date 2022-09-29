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
            <button onclick="window.location.href='../Select/Select_Country_Name.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Show All Cities Within A Country</h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:30px;">Country</legend>
                    <div class = "box">
                    <label for = "CountryName">Country Name : </label>
                    <select name= "CountryName" required>
                        <option value='' disabled selected>Select your option</option>
                        <?php
                            $sql1 = "SELECT country_name.CountryName FROM country_name";
                            $data1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_assoc($data1);
                            
                            while($result1 = mysqli_fetch_assoc($data1))
                            {
                                $CountryName = utf8_encode($result1['CountryName']);
                                echo "<option value= '$CountryName'>$CountryName</option>";
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
                if(isset($_POST['CountryName']))
                {
                    $CountryName = $_POST['CountryName'];
                }
                else{
                    $CountryName = "Country name is not set in Post Method";
                }
            
                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else
                {
                    echo "</br>";
                

                    $sql = "SELECT city.CityName,country_name.CountryName FROM city INNER JOIN country_name WHERE (city.CountryCode = (SELECT country_name.CountryCode FROM country_name WHERE country_name.CountryName = '$CountryName')) AND (country_name.CountryName= '$CountryName')";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    $x =1;
                    echo "<table class=container>";
                    echo "<tr><th>No.</th><th>City Name</th>";
                    echo "<tr><td>";
                        echo $x;
                        echo "</td><td>";
                        echo utf8_encode($result['CityName']);
                        echo "</td></tr>";
                    while($result = mysqli_fetch_assoc($data))
                    {
                        echo "<tr><td>";
                        echo ++$x;
                        echo "</td><td>";
                        echo utf8_encode($result['CityName']);
                        echo "</td></tr>";
                    }

                    $conn -> close();
                }
            }
        ?>
        </div>
    </body>
</html>