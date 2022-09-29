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
            <button onclick="window.location.href='../Select/Select_Geographical_Information.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Show Country Code, Capital City and Ruler for all Countries within a Continent</h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:30px;">Continent</legend>
                    <div class = "box">
                    <label for = "ContinentName">Continent : </label>
                    <select name= "ContinentName" required>
                        <option value='' disabled selected>Select your option</option>
                        <?php
                            $sql1 = "SELECT DISTINCT geographical_information.Continent FROM geographical_information";
                            $data1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_assoc($data1);
                            $ContinentName = $result1['Continent'];
                            echo "<option value= '$ContinentName'>".utf8_encode($ContinentName)."</option>";                            
                            while($result1 = mysqli_fetch_assoc($data1))
                            {
                                $ContinentName = $result1['Continent'];
                                echo "<option value= '$ContinentName'>".utf8_encode($ContinentName)."</option>";
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
                if(isset($_POST['ContinentName']))
                {
                    $ContinentName = $_POST['ContinentName'];
                }
                else{
                    $ContinentName = "Continent name is not set in Post Method";
                }
            
                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else
                {
                    echo "</br>";
                    $sql = "SELECT general_information.CountryCode, general_information.Capital, general_information.HeadOfState FROM general_information INNER JOIN geographical_information ON general_information.CountryCode = geographical_information.CountryCode WHERE geographical_information.Continent = '$ContinentName'";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    $capital = $result['Capital'];
                    $sql1 = "SELECT city.CityName FROM city WHERE city.CityID='$capital'";
                    $data1 = mysqli_query($conn, $sql1);
                    $result1 = mysqli_fetch_assoc($data1);
                    echo "<table class=container>";
                    echo "<tr><th>Country Code</th><th>Capital City</th><th>Ruler</th>";
                    echo "<tr><td>";
                        echo utf8_encode($result['CountryCode']);
                        echo "</td><td>";
                        echo utf8_encode($result1['CityName']);
                        echo "</td><td>";
                        echo utf8_encode($result['HeadOfState']);
                        echo "</td></tr>";
                    while($result = mysqli_fetch_assoc($data))
                    {
                        $capital = $result['Capital'];
                        $sql1 = "SELECT city.CityName FROM city WHERE city.CityID='$capital'";
                        $data1 = mysqli_query($conn, $sql1);
                        $result1 = mysqli_fetch_assoc($data1);
                        echo "<tr><td>";
                        echo utf8_encode($result['CountryCode']);
                        echo "</td><td>";
                        echo utf8_encode($result1['CityName']);
                        echo "</td><td>";
                        echo utf8_encode($result['HeadOfState']);
                        echo "</td></tr>";
                    }

                    $conn -> close();
                }
            }
        ?>
        </div>
    </body>
</html>