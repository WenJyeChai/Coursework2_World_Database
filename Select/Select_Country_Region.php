<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Region</title>';
?>
<?php
    require "../nav_.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
?>
<meta name = "viewport" content = "width = device-width, initial-scale = 0.5"/>
<body style="padding:10px;width:100vw;margin:0 auto;">
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">REGION</h1>
    <div class="search-div" style="display:flex; flex-direction: row;">
        <div style="width:70%">
            <button type= "submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/countryname.php';">Which country has the most people?</button>
            <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../Insert/Insert_Region.php';">Insert New Region Data</button>
        </div>
        <form id="content" action="Select_Country_Region.php" method="get">
        <input type="text" name="input" class="input" id="search-input" value="<?php if (!empty($_GET["input"])) echo $_GET["input"];?>" placeholder="Region Name">
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
        $sql = "SELECT * FROM `country_region` WHERE RegionName = '$valueToSearch' ORDER BY 'RegionID' ASC";
        $result = $conn->query($sql);   
    }
    else
    {

        $total_pages_sql = "SELECT COUNT(*) FROM country_region";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $sql = "SELECT * FROM country_region LIMIT $offset, $no_of_records_per_page";
        $result = $conn->query($sql);

    }
	echo "<table class=container>";

	if ($result->num_rows > 0) {
		echo "<tr>
				<th>Region ID</th>
				<th>Name of the Region</th>
				<th>Population of the region</th>
				<th>Action</th>
			  </tr>";
			
        while($row = $result->fetch_assoc())
        {
            echo "<tr> 
                        <td>" . utf8_encode($row["RegionID"]). "</td>
                        <td>" . utf8_encode($row["RegionName"]).  "</td>
                        <td>" . utf8_encode($row["PopulationRegion"]).  "</td>
                        <td><button type='submit' class='search_delete_update' style='margin:2px;' id='search-btn' name='search' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/Delete/Delete_Region.php?Region_ID=". $row["RegionID"]."`'>Delete Data</button>
                            <button type='submit' class='search_delete_update' id='search-btn' name='search' style='margin:2px;' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/ChooseUpdate/Update/UpdateRegion.php?regionID=". $row["RegionID"]."`'>Update Data</button>
                        </td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
        echo "<tr>
                <th>Region ID</th>
                <th>Name of the Region</th>
                <th>Population of the region</th>
             </tr>";
        echo "</br></br>";
        echo "<tr><th  colspan='3' style='background-color:#323C50'>0 Result</th><tr>";
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