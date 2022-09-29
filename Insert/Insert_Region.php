<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Insert Region</title>';
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // collect value of input field
        $r_name = $_GET['Region_ID'];
    }
?>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
    </head>
        <body style="padding:10px;width:100vw;margin:0 auto;">
            <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='javascript:window.history.back()'" style="padding: 15px;font-size:20px;">BACK</button>
            </div>
            <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Insert Region</h1>
            </div>
            <form id="RegionForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="outer_insert" >
                    <fieldset>
                        <legend style="padding:20px;font-size:40px;">Region</legend>
                        <label for="region_name"style="line-height:1.3;">Region Name :&emsp;&emsp;</label>
                        <input type="text" name="region_name" id="region_name" required></br></br>
                        <label for="region_population"style="line-height:1.3;">Region Population :&emsp;&emsp;</label>
                        <input type="number" name="region_population" id="region_population"></br></br>
                        <input type = "submit" name = "submit" value = "Submit">
                    </fieldset>
                </div>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $r_name = $_POST['region_name'];
                    $r_population = $_POST['region_population'];
                    $statement = $conn -> prepare("INSERT INTO `country_region` (`RegionID`, `RegionName`,`PopulationRegion`) VALUES (NULL, ?, ?)"); 
                    $statement -> bind_param("si",$r_name,$r_population);
                    $statement -> execute();
                    echo "<script> alert('Data is inserted'); </script> ";
                    $statement -> close();
                    $conn -> close();
                }
            ?>
        </div>
    </body>
</html>
