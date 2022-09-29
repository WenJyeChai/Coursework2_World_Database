<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/insert_style.css">';	
?>
	
	<head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
    </head>
	
	<title>Life Expectancy More Than</title>
	
	<body style="padding:10px;width:100vw;margin:0 auto;">
    <div class="toprow" style="display:flex;flex-direction: row;">
    <button onclick="window.location.href='../Select/Select_Population.php'" style="padding: 15px;">Back</button>
    </div>
    <div>
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Country That Has Life Expectancy More Than</h1>
    </div>
	
	<form action = "Select_Life_Expectancy_More_Than.php" method = "get">
	<div class="outer">
            <fieldset>
                    <legend style="padding:10px;font-size:30px;">Life Expectancy</legend>
                    <label for="city_name">Life Expectancy More Than:</label></br></br>
	                <input type = "text" name = "LifeExpectancy" id="search-input">
	                <button type="Submit" id="search-btn" style="border:1px solid white;font-family: 'Open Sans', sans-serif;" >SUBMIT</button>
	</fieldset>
    </div>
    </form>
    </div>
</body>