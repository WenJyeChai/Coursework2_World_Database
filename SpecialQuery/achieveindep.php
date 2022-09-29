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
        
        <title>Number of People Achieve Indepedence</title>
    </head>

    <body style="padding:10px;width:100vw;margin:0 auto;">
    
        <?php
            require "../database_linking.php";
        ?>
        
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_General_Information.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Number of People Achieving Independence</h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:25px;">Independence Year</legend>
                    <label for = "Year 1"> Year 1 :</label>
                    <input type = "text" name = "Year1" id = "Year1" required>
                    <br>
                    <br>
                    <label for = "Year 2"> Year 2 :</label>
                    <input type = "text" name = "Year2" id = "Year2" required>
                    <br>
                    <br>
                    <input type = "submit" name = "submit" value = "Submit">
                </fieldset>
        </form>
        
        <?php
            if(isset($_POST['submit']))
            {
                if(isset($_POST['Year1']) && isset($_POST['Year2']))
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
                    $sql = "SELECT SUM(population.PopulationCountry)FROM population INNER JOIN general_information ON population.CountryCode = general_information.CountryCode INNER JOIN country_name ON general_information.CountryCode = country_name.CountryCode WHERE general_information.IndepYear >= '$Year1' AND general_information.IndepYear <= '$Year2'";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    echo "</br></br>";
                    echo "<fieldset>";
                    echo "<legend style='padding:10px;font-size:30px;'>Result </legend>";
                    echo "Number of people:&emsp; ";
                    echo "<span style='font-weight:bold;'>";
                    echo $result['SUM(population.PopulationCountry)'];
                    echo "</span>";
                    echo "</fieldset>";
                }
            }
        ?>
            </div>
    </body>
</html>