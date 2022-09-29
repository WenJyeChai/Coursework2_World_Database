<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Geographical Information</title>';
?>
<?php
    require "../nav_.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
?>
<meta name = "viewport" content = "width = device-width, initial-scale = 0.5"/>
<body style="padding:10px;width:100vw;margin:0 auto;">
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">GEOGRAPHICAL INFORMATION</h1>
    <div class="search-div" style="display:flex;flex-direction: row ;">
        <div style="width:70%">
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/country_surface_area.php';">Which Country Is The Largest ?</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/population_density.php';">Which Country Has the Highest Population Density ?</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/rankingarea.php';">Ranking Of Surface Area</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../Insert/Insert_Country.php';">Insert New Country Data</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/showcountrycode.php';">Show Country within Continent</button>
        </div>
        <form id="content" action="Select_Geographical_Information.php" method="get" style="width:30%">
            <input type="text" name="input" class="input" id="search-input" value="<?php if (!empty($_GET["input"])) echo $_GET["input"];?>" placeholder="Country Name">
            <button type="submit" class="search" id="search-btn" name="search">FILTER</button>
        </form>
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
            $sql = "SELECT * FROM `geographical_information` INNER JOIN country_name ON country_name.CountryCode=geographical_information.CountryCode AND country_name.CountryName='$valueToSearch'";
            $result = $conn->query($sql);  
        }
        else
        {
    
            $total_pages_sql = "SELECT COUNT(*) FROM geographical_information ";
            $result = mysqli_query($conn,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $sql = "SELECT * FROM geographical_information  LIMIT $offset, $no_of_records_per_page";
            $result = $conn->query($sql);
    
        }
    	echo "<table class=container>";
    
    	if ($result->num_rows > 0) {
    		echo "<tr>
    				<th>Country Name</th>
    				<th>Continent of the Country</th>
                    <th>Region in the Country</th>
                    <th>Surface Area of the Country (km²)</th>
                    <th>Action</th>
    			  </tr>";
    			
            while($row = $result->fetch_assoc())
            {   $countrycode=$row["CountryCode"];
                $sql1 = "SELECT country_name.CountryName from country_name WHERE country_name.CountryCode='$countrycode'";
                $data1 = mysqli_query($conn, $sql1);
                $result1 = mysqli_fetch_assoc($data1);
                $CountryName = $result1['CountryName'];
                $valueToSearch = $row["RegionID"];
            	$sql1 = "SELECT country_region.RegionName FROM country_region where country_region.RegionID=$valueToSearch";
                $data1 = mysqli_query($conn, $sql1);
                $result1 = mysqli_fetch_assoc($data1);
                $RegionName = $result1['RegionName'];
                echo "<tr> 
                            <td><a href='http://hfyyl2.mercury.nottingham.edu.my/SpecialQuery/Country_Detail.php?CountryCode=".$row["CountryCode"]."'><div>" . utf8_encode($CountryName). "</div></a></td>
                            <td>" . utf8_encode($row["Continent"]).  "</td>
                            <td>" . utf8_encode($RegionName).  "</td>
                            <td>" . utf8_encode($row["SurfaceArea"]).  "</td>
                            <td><button type='submit' class='search_delete_update' style='margin:2px;' id='search-btn' name='search' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/Delete/Delete_Country.php?CountryCode=". $row["CountryCode"]."`'>Delete Data</button>
                                <button type='submit' class='search_delete_update' id='search-btn' name='search' style='margin:2px;' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/ChooseUpdate/Update/UpdateCountry.php?CountryCode=". $row["CountryCode"]."`'>Update Data</button>
                            </td>";
    			echo "</tr>";
    		}
    		echo "</table>";
    	}
    	else {
            echo "<tr>
                    <th>Country Name</th>
                    <th>Continent of the Country</th>
                    <th>Region in the Country</th>
                    <th>Surface Area of the Country (km²)</th>
                 </tr>";
            echo "</br></br>";
            echo "<tr><th  colspan='4' style='background-color:#323C50'>0 Result</th><tr>";
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