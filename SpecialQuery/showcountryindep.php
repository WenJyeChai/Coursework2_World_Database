<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>

        <link rel="stylesheet" href="../css/Select_Style.css">
        <link rel="stylesheet" href="../css/insert_style.css">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
        <link rel="icon" href="../css/globe.png">
        <title>Countries Achieve Indepedence</title>
    </head>

    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php 
            require "../database_linking.php";
        ?>
        
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_Country_Name.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Countries Achieving Independence within A Period of Time</h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:25px;">Independence Year</legend>
                    <label for="Year 1">Year 1 : </label>
                    <input type = "text" name = "Year1" id = "Year1" required>
                    <br>
                    <br>
                    <label for = "Year 2"> Year 2 : </label>
                    <input type = "text" name = "Year2" if = "Year2" required>
                    <br>
                    <br>
                    <input type = "submit" name = "submit" value = "Submit">
                </fieldset>
            </div>
        </form>
        
        <?php
            if(isset($_POST['submit']))
            {
                if(isset($_POST['Year1'])&& isset($_POST['Year2']))
                {
                    $Year1 = $_POST['Year1'];
                    $Year2 = $_POST['Year2'];
                }

                else{
                    $Year1 = "Year 1 is not set in Post Method";
                    $Year2 = "Year 2 is not set in Post Method";
                }

                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else{
                    echo"<h1 style='text-align:left;width:75%;margin: 0 auto;padding:20px;'>Countries Achieving Independence within $Year1 to $Year2 </h1><br>";
                    $sql = "SELECT country_name.CountryName, general_information.IndepYear FROM country_name INNER JOIN general_information ON country_name.CountryCode = general_information.CountryCode WHERE general_information.IndepYear>= '$Year1' AND general_information.IndepYear<='$Year2' ORDER BY general_information.IndepYear ASC";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    $x =1;
                    echo "<table class=container>";
                    echo "<tr><th>No.</th><th>Country Name</th><th>Independence Year</th></tr>";
                    echo "<tr><td>";
                        echo $x;
                        echo "</td><td>";
                        echo utf8_encode($result['CountryName']);
                        echo "</td><td>";
                        echo utf8_encode($result['IndepYear']);
                        echo "</td></tr>";
                    while($result = mysqli_fetch_assoc($data))
                    {
                        echo "<tr><td>";
                        echo ++$x;
                        echo "</td><td>";
                        echo utf8_encode($result['CountryName']);
                        echo "</td><td>";
                        echo utf8_encode($result['IndepYear']);
                        echo "</td></tr>";
                    }
                    $conn ->close();
                }
            }
        ?>
    </body>
</html>