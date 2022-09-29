<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/insert_style.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
?>
<?php
if(isset($_GET["LifeExpectancy"]))
{
	$valueToSearch = $_GET["LifeExpectancy"];
	
}

?>
<meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
<title>Life Expectancy More Than <?php echo $valueToSearch;?></title>

<div class="toprow" style="display:flex;flex-direction: row;">
<button onclick="window.location.href='../SpecialQuery/Choose_Life_Expectancy_More_Than.php'" style="padding: 15px;">Back</button>
</div>

<div>
<h1 style="text-align:left;width:75%;margin: 10px auto;padding:20px;">Country with Life Expectancy More Than <?php echo $valueToSearch;?></h1>
</div>

<?php
if(isset($_GET["LifeExpectancy"]))
{
	$valueToSearch = $_GET["LifeExpectancy"];
	$sql = "SELECT country_name.CountryName, population.LifeExpectancy FROM country_name INNER JOIN population ON country_name.CountryCode = population.CountryCode WHERE (population.LifeExpectancy > $valueToSearch) ORDER BY population.LifeExpectancy DESC";
	$result = $conn->query($sql); 
	echo "<table class=container>";
	echo "<tr>
			<th>Country Name</th>
			<th>Life Expectancy</th>
	</tr>";
	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc())
			{
				echo "<tr> 
							<td>" . $row["CountryName"]. "</td>
							<td>" . $row["LifeExpectancy"].  "</td>
						</tr>";
			}
		}
	else {
		echo "0 results";
	}
	$conn->close();  
}
else
{
	echo "0 results";
	require "Choose_Life_Expectancy_More_Than.php";
}

?>

