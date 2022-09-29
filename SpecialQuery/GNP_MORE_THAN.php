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
        <title>Countries with GNP </title>
    </head>
    
<?php
if(isset($_POST["GNP"]))
{
	$valueToSearch = $_POST["GNP"];
	
}

?>

    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php 
            require "../database_linking.php";
        ?>
        
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_Economic_Status.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Countries with GNP More than <?php echo $valueToSearch;?> </h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:25px;">Economy Status</legend>
                    <label for="Year 1">GNP in 2000 : </label>
                    <input type = "text" name = "GNP" id = "GNP" required>
                    <br>
                    <br>
                    <input type = "submit" name = "submit" value = "Submit">
                </fieldset>
            </div>
        </form>
        
        <?php
            if(isset($_POST['submit']))
            {
                if(isset($_POST['GNP']))
                {
                    $GNP = $_POST['GNP'];
                }

                else{
                    $GNP = "GNP is not set in Post Method";
                }

                if($conn -> connect_error)
                {
                    die("Connection failed: .$conn->connect_error");
                }
                else{
                    echo"<h1 style='text-align:left;width:75%;margin: 0 auto;padding:20px;'>Countries with GNP More than $GNP </h1><br>";
                    $sql = "Select country_name.CountryName,economic_status.GNP FROM country_name INNER JOIN economic_status WHERE (economic_status.CountryCode=country_name.CountryCode) AND (economic_status.GNP>$GNP) ORDER BY economic_status.GNP ASC";
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    $x =1;
                    echo "<table class=container>";
                    echo "<tr><th>No.</th><th>Country Name</th><th>GNP in 2000</th></tr>";
                    echo "<tr><td>";
                        echo $x;
                        echo "</td><td>";
                        echo utf8_encode($result['CountryName']);
                        echo "</td><td>";
                        echo $result['GNP'];
                        echo "</td></tr>";
                    while($result = mysqli_fetch_assoc($data))
                    {
                        echo "<tr><td>";
                        echo ++$x;
                        echo "</td><td>";
                        echo utf8_encode($result['CountryName']);
                        echo "</td><td>";
                        echo $result['GNP'];
                        echo "</td></tr>";
                    }
                    $conn ->close();
                }
            }
        ?>
    </body>
</html>