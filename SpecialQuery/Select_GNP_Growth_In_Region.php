<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/insert_style.css">';	
?>
<?php
if(isset($_GET['regionID']))
{
	$valueToSearch = $_GET['regionID'];
	$sql1 = "SELECT country_region.RegionName FROM country_region where country_region.RegionID=$valueToSearch";
    $data1 = mysqli_query($conn, $sql1);
    $result1 = mysqli_fetch_assoc($data1);
    $RegionName = $result1['RegionName'];
	
}

?>

<title>GNP Growth In Region</title>

<div class="toprow" style="display:flex;flex-direction: row;">
<button onclick="window.location.href='../SpecialQuery/Choose_GNP_Growth_In_Region.php'" style="padding: 15px;">Back</button>
</div>

<div>
<h1 style="text-align:left;width:75%;margin: 10px auto;padding:20px;">GNP Growth In <?php echo $RegionName;?></h1>
</div>

<?php
if(isset($_GET['regionID']))
{
	$valueToSearch = $_GET["regionID"];
	$sql = "SELECT country_name.CountryName, (economic_status.GNP-economic_status.GNPOld) AS \"GNP Growth\" FROM economic_status INNER JOIN country_name ON country_name.CountryCode = economic_status.CountryCode INNER JOIN geographical_information ON geographical_information.CountryCode = country_name.CountryCode WHERE geographical_information.RegionID = $valueToSearch ORDER BY (economic_status.GNP-economic_status.GNPOld) DESC";
	$result = $conn->query($sql); 
	echo "<br>";
	
	echo "<table class=container>";
	
	if ($result->num_rows > 0) {
			echo "<tr>
					<th>Country Name</th>
					<th>GNP Growth</th>
				</tr>";
			echo "<br>";
				
			while($row = $result->fetch_assoc())
			{
				echo "<tr> 
							<td>" . utf8_encode($row["CountryName"]). "</td>
							<td>" . $row["GNP Growth"].  "</td>
						</tr>";
				echo "<br>";
			}
		}
	else {
		echo "0 results";
	}
	$conn->close();  
}
else
{
	require "Choose_GNP_Growth_In_Region.php";
}

?>

