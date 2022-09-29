<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../css/Select_Style.css">
    <link rel="stylesheet" href="../css/insert_style.css">	
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />
    <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
    <title>Input City Population</title>
    <link rel="icon" href="../css/globe.png">
  </head>

  <body style="padding:10px;width:100vw;margin:0 auto;">

<?php
    require "../database_linking.php";
?>
    
    <div class="toprow" style="display:flex;flex-direction: row;">
        <button onclick="window.location.href='../Select/Select_City.php'" style="padding: 15px;">Back</button>
    </div>
    <div>
        <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Population of City</h1>
    </div>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<form action="Query_City1.php" method="post">
    <div class="outer">
    <fieldset>
    <legend style="padding:10px;font-size:30px;">Population</legend>

        <label for="population">Population Smaller than :<br><br></label>
        <input type="text" name="population" required>
        <br><br>

    <button type="Submit" style="border:1px solid white;font-family: 'Open Sans', sans-serif;" >SUBMIT</button>
    </fieldset>
    </div>
</form>

  </body>
</html>
