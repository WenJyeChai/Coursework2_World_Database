<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>City</title>';
?>
<?php
    require "../nav_.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
?>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width, initial-scale = 0.5"/>
<body style="padding:10px;width:100vw;margin:0 auto;">
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">CITY</h1>
    <div class="search-div" style="display:flex;flex-direction: row ;">
        <div style="width:70%">
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/percentagecap.php';">People Living in Capital</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/post_scountry.php';">Capital City Searcher</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../Insert/Insert_City.php';">Insert New City Data</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/Input_City1.php';">Population</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/Input_City2.php';">Independence Year</button>
        </div>
        <div>
        <form id="content" action="Select_City.php" method="get">
        <input type="text" name="input" class="input" id="search-input" value="<?php if (!empty($_GET["input"])) echo $_GET["input"];?>" placeholder="City Name">
        <button type="submit" class="search" id="search-btn" name="search">FILTER</button>
        </form>
        </div>
    </div>
    
    <?php
    
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
    
        $no_of_records_per_page = 50;
        $offset = ($pageno-1) * $no_of_records_per_page;
    
        if(isset($_GET['search']))
        {
            $valueToSearch = $_GET["input"];
            $sql = "SELECT * FROM `city` WHERE CityName = '$valueToSearch' ORDER BY 'CityID' ASC";
            $result = $conn->query($sql);   
        }
        else
        { 
            $total_pages_sql = "SELECT COUNT(*) FROM city";
            $result = mysqli_query($conn,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $sql = "SELECT * FROM city LIMIT $offset, $no_of_records_per_page";
            $result = $conn->query($sql);
        }
            echo "<table class=container>";	
            
            if ($result->num_rows > 0)
                {

                echo "<tr><th>City ID</th><th>City Name</th><th>Country</th><th>District</th><th>Population of the city</th><th>Action</th></tr>";
                    
                while($row = $result->fetch_assoc())
                {   $countrycode=$row["CountryCode"];
                    $sql1 = "SELECT country_name.CountryName from country_name WHERE country_name.CountryCode='$countrycode'";
                    $data1 = mysqli_query($conn, $sql1);
                    $result1 = mysqli_fetch_assoc($data1);
                    $CountryName = $result1['CountryName'];
                    $districtID=$row["DistrictID"];
                    $sql1 = "SELECT district.DistrictName from district WHERE district.DistrictID='$districtID'";
                    $data1 = mysqli_query($conn, $sql1);
                    $result1 = mysqli_fetch_assoc($data1);
                    $DistrictName = $result1['DistrictName'];
                    echo "<tr> 
                                <td>" . utf8_encode($row["CityID"]). "</td>
                                <td>" . utf8_encode($row["CityName"]).  "</td>
                                <td>" . utf8_encode($CountryName).  "</td>
                                <td>". utf8_encode($DistrictName)."</td>
                                <td>". utf8_encode($row["PopulationCity"])."</td>
                                <td><button type='submit' class='search_delete_update' style='margin:2px;' id='search-btn' name='search' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/Delete/Delete_City.php?city_ID=". $row["CityID"]."`'>Delete Data</button>
                                    <button type='submit' class='search_delete_update' id='search-btn' name='search' style='margin:2px;' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/ChooseUpdate/Update/UpdateCity.php?CityID=". $row["CityID"]."`'>Update Data</button>
                                </td>" ;
                    echo "</tr>";
                }
                echo "</table>";
            }
            else {
                echo "<tr><th>City ID</th><th>City Name</th><th>Country code</th><th>District ID</th><th>Population of the city</th></tr>";
                echo "</br></br>";
                echo "<tr><th  colspan='5' style='background-color:#323C50'>0 Result</th><tr>";
            }
            $conn->close();
    ?>
    
        <div class="pagination">
            <button><a href="?pageno=1">First</a></button>
            <button class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1);}?>" style='background-color: transparent;color:#fff'">Prev</a>
            </button>
            <h2>&emsp;<?php echo $pageno; ?>&emsp;</h2>
            <button class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" style='background-color: transparent;color:#fff'">Next</a>
            </button>
            <button><a href="?pageno=<?php echo $total_pages; ?>">Last</a></button>
        </div>
</body>