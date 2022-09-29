<?php
    require "../../database_linking.php";
    echo '<link rel="stylesheet" href="../../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../../css/big-device.css" />';
    echo '<link rel="icon" href="../../css/globe.png">';
    echo '<title>Update Region</title>';
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Update Region</h1>
            </div>
            <form id='UpdateRegionForm' method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
                                                    
                         <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET") 
                                {
                                    // collect value of input field
                                    $r_ID = $_GET['regionID'];
                                    $sql = "SELECT * FROM country_region WHERE country_region.RegionID = $r_ID";
                                    $conn->query($sql);
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $r_name= $row["RegionName"];
                                    $r_population= $row["PopulationRegion"];
                                    echo "      <div class='outer_insert'> 
                                                        <fieldset>
                                                            <legend style='padding:20px;font-size:40px;'>Update Region</legend>
                                                            <label for='region_name'style='line-height:1.3;'>Region Name :&emsp;&emsp;</label>
                                                            <input type='text' name='region_name' id='region_name' value='$r_name'></br></br>
                                                            <label for='region_population'style='line-height:1.3;'>Region Population :&emsp;&emsp;</label>
                                                            <input type='number' name='region_population' id='region_population' value='$r_population'></br></br>
                                                            <input type='number' name='region_ID' id='region_ID' value='$r_ID' style='display:none;'>
                                                            <input type = 'submit' name = 'submit' value = 'Submit'>
                                                        </fieldset>
                                                    </div>";
                                }
                            ?>
             
            </form>       
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    // collect value of input field
                    $r_ID = $_POST['region_ID'];
                    $r_name = $_POST['region_name'];
                    $r_population = $_POST['region_population'];
                    $sql="UPDATE country_region SET RegionName = '$r_name', PopulationRegion = $r_population WHERE country_region.RegionID = $r_ID ;";
                    $conn->query($sql);
                    echo "<div class='outer_insert'>
                            <fieldset>
                            <legend style='padding:20px;font-size:40px;'>Notice</legend>
                            Successfully updated the data.
                            </fieldset>
                          </div>";

                }
            ?>
        </div>
    </body>
</html>

