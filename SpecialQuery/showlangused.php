<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale =0.8"/>
        <link rel="stylesheet" href="../css/Select_Style.css">
        <link rel="stylesheet" href="../css/insert_style.css">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
        <link rel="icon" href="../css/globe.png">
        <title>Language Used</title>
    </head>

    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php
            require "../database_linking.php";
        ?>
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button class="but" onclick="window.location.href='../Select/Select_Country_Language.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Languages Used within A Country</h1>
        </div>
        
        <form method = "post" action = "">
            <div class="outer">
            <fieldset>
                <legend style="padding:10px;font-size:30px;">Language</legend>
                <div class="box">
                    <label for = "Country Name">Country Name : </label>
                    <select name="CountryName" required>
                        <option value='' disabled selected>Select your option</option>
                        <?php
                            $sql1 = "SELECT country_name.CountryName FROM country_name ORDER BY CountryName ASC";
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
            </div>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                if(isset($_POST['CountryName']))
                {
                    $CountryNameSel = $_POST['CountryName'];
                }

                else
                {
                    $CountryNameSel = "Country Name is not set in Post Method";
                }

                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else
                {
                    echo"<h1 style='text-align:left;width:75%;margin: 0 auto;padding:20px;'>Languages Used in $CountryNameSel : </h1><br>";
                    $sql = "SELECT country_language.Language FROM country_language INNER JOIN country_name ON country_language.CountryCode=country_name.CountryCode WHERE country_name.CountryName= '$CountryNameSel'";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    $x =1;

                    echo "<table class=container>";
                    echo "<tr><th>No.</th><th>Language</th></tr>";
                    echo "<tr><td>";
                    echo $x;
                    echo "</td><td>";
                    echo utf8_encode($result['Language']);
                    echo "</td></tr>";
                    while($result = mysqli_fetch_assoc($data))
                    {
                        echo "<tr><td>";
                        echo ++$x;
                        echo "</td><td>";
                        echo utf8_encode($result['Language']);
                        echo "</td></tr>";
                    }
                    $conn ->close();
                }
            }
        ?>
    </body>
</html>