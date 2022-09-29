<?php
    require "../../database_linking.php";
    echo '<link rel="stylesheet" href="../../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../../css/big-device.css" />';
    echo '<link rel="icon" href="../../css/globe.png">';
    echo '<title>Update Country</title>';
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;">Update Country</h1>
            </div>
            <form id="Update_Country_Form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") 
                        { echo "<div class='outer_insert' >
                                    <div style='text-align:center;'>
                                        <span class='step'></span>
                                        <span class='step'></span>
                                        <span class='step'></span>
                                        <span class='step'></span>
                                        <span class='step'></span>
                                    </div>";
                        }
                ?>
                    
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") 
                        {
                            $c_code = $_GET['CountryCode'];
                            $sql = "SELECT * FROM `country_name` WHERE CountryCode='$c_code'";
                            $conn->query($sql);
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $c_code_3 = $row["CountryCode"];
                            $c_code_2 = $row["CountryCode2"];
                            $c_name = $row["CountryName"];
                            $c_local_name = $row["LocalName"];
                            echo "          <fieldset class='tab'>
                                            <legend style='padding:15px;font-size:40px;line-height: 1.0;'>Name</legend>
                                            <label for='country_code_3'>Country Code in 3 Alphabets:&emsp;&emsp;</label>
                                            <input type='text' name='country_code_3' id='country_code_3' maxlength='3' value='$c_code_3'></br></br></br>
                                            <input type='text' name='country_code_initial' id='country_code_initial' maxlength='3' value='$c_code' style='display:none;'>
                                            <label for='country_code_2'>Country Code in 2 Alphabets:&emsp;&emsp;</label>
                                            <input type='text' name='country_code_2' id='country_code_2' maxlength='2' value='$c_code_2'></br></br></br>
                                            <label for='country_name'>Country Name :&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</label>
                                            <input type='text' name='country_name' id='country_name' value='$c_name'></br></br></br>
                                            <label for='country_name_local'>Local Name of the Country:&emsp;&emsp;&emsp;</label>
                                            <input type='text' name='country_name_local' id='country_name_local' value='$c_local_name'></br></br></br>
                                            </fieldset>";                
                        }
                    ?>
                    
                        
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "GET") 
                            {   echo "<fieldset class='tab'><legend style='padding:15px;font-size:40px;line-height: 1.0;'>Geographical Information</legend>";
                                echo "<label for='country_continent'></br></br>Country Continent :</label>&emsp;";
                                $c_code = $_GET['CountryCode'];
                                $sql = "SELECT * FROM `geographical_information` WHERE CountryCode='$c_code'";
                                $conn->query($sql);
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $c_continent = $row["Continent"];
                                $c_s_area = $row["SurfaceArea"];
            
                                $c_region= $row["RegionID"];
                                $sql = "SELECT country_region.RegionName FROM `country_region` WHERE country_region.RegionID='$c_region'";
                                $conn->query($sql);
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $c_region_name= $row["RegionName"];
                            
                                $sql = "SELECT geographical_information.Continent FROM geographical_information GROUP by geographical_information.Continent";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    echo    "<select id='country_continent' form='Update_Country_Form' name='country_continent' required>"	;
                                    echo    "<option value='$c_continent' selected required>$c_continent</option>"    ;
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "  <option value=". utf8_encode($row["Continent"]).">"
                                                                . utf8_encode($row["Continent"]).
                                                "</option>";
                                    }
                                    echo "</select></br></br>";
                                }
                                echo "<label for='country_region'></br></br>Country Region :</label>&emsp;"; 
                                $sql = "SELECT country_region.RegionID,country_region.RegionName FROM country_region";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    echo    "<select id='country_region' form='Update_Country_Form' name='country_region' required>"	;
                                    echo    "<option value='$c_region' selected required>$c_region_name</option>"    ;
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "  <option value=". utf8_encode($row["RegionID"]).">"
                                                                . utf8_encode($row["RegionName"]).
                                                "</option>";
                                    }
                                    echo "</select></br></br>";
                                }
                                echo "      <label for='country_surface_area'></br></br>Surface Area of the country :&emsp;&emsp;</label>
                                            <input type='number' name='country_surface_area' id='country_surface_area' value='$c_s_area'></br></br>
                                            </fieldset>";
                            }
                        ?>
                    
                            
                                 <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "GET") 
                                        {   echo "
                                            <fieldset class='tab'><legend style='padding:15px;font-size:35px;line-height: 1.0;'>Population / Economy status</legend>";
                                            $c_code = $_GET['CountryCode'];
                                            $sql = "SELECT * FROM `economic_status` WHERE economic_status.CountryCode='$c_code'";
                                            $conn->query($sql);
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $c_GNP = $row["GNP"];
                                            $c_GNP_old = $row["GNPOld"];
                                            $sql = "SELECT * FROM `population` WHERE population.CountryCode='$c_code'";
                                            $conn->query($sql);
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $c_population = $row["PopulationCountry"];
                                            $c_l_expectancy = $row["LifeExpectancy"];
                                            echo "  <label for='country_GNP_before_2000'>GNP/GDP of the Country before 2000 :&emsp;</br></br></label>
                                                        <input type='number' name='country_GNP_before_2000' id='country_GNP_before_2000' value='$c_GNP_old'></br></br>
                                                    <label for='country_GNP_2000'>GNP/GDP of the Country in 2000 :&emsp;&emsp;</br></br></label>
                                                        <input type='number' name='country_GNP_2000' id='country_GNP_2000'  value='$c_GNP'></br></br>
                                                    <label for='country_LExpectancy'>Life Expectancy of the Country :&emsp;&emsp;</label>
                                                        <input type='number' name='country_LExpectancy' id='country_LExpectancy'  value='$c_l_expectancy'></br></br>
                                                    <label for='country_population'>Population of the Country :&emsp;&emsp;&emsp;</label>
                                                        <input type='number' name='country_population' id='country_population' value='$c_population'></br></br>
                                                        </fieldset>";                
                                        }
                                ?>
                    
                        
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "GET") 
                            {
                                echo "<fieldset class='tab'><legend style='padding:15px;font-size:40px;line-height: 1.0;'>General Information</legend>";
                                $c_code = $_GET['CountryCode'];
                                $sql = "SELECT * FROM `general_information` WHERE CountryCode='$c_code'";
                                $conn->query($sql);
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $c_indep_year = $row["IndepYear"];
                                $c_government_form = $row["GovernmentForm"];
                                $c_hos= $row["HeadOfState"];
            
                                $c_capital = $row["Capital"];
                                $sql = "SELECT city.CityName FROM `city` WHERE city.CityID='$c_capital'";
                                $conn->query($sql);
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $c_capital_name= utf8_encode($row["CityName"]);
            
                                echo "  <label for='country_InderYear'>Independent Year of the Country :&emsp;</label>
                                            <input type='number' name='country_InderYear' id='country_InderYear' value='$c_indep_year'></br></br>
                                        <label for='country_form_government'>Form of Government in the Country :</label></br></br>
                                            <input type='text' name='country_form_government' id='country_form_government' value='$c_government_form'></br></br>
                                        <label for='country_ruler'>Ruler of the Country :&emsp;&emsp;</label>
                                            <input type='text' name='country_ruler' id='country_ruler' value='$c_hos'></br></br>
                                        <label for='country_capital'>Capital City of the Country :</label></br></br>";   
                                $sql = "SELECT city.CityID,city.CityName FROM city Order BY CityName ASC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    echo    "<select id='country_capital' form='Update_Country_Form' name ='country_capital'>"	;
                                    echo    "<option value='$c_capital'selected>$c_capital_name</option>"    ;
                                    echo    "<option value='0'>none</option>"    ;
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "  <option value=". utf8_encode($row["CityID"]).">"
                                                                . utf8_encode($row["CityName"]).
                                                "</option>";
                                    }
                                    echo "</select></br></br></fieldset>";
                                }
                            }
                        ?>
                    
                        
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "GET") 
                            {   echo "<fieldset class='tab'><legend style='padding:15px;font-size:40px;line-height: 1.0;'>Language Used</legend>";
                                $c_code = $_GET['CountryCode'];
                                $sql = "SELECT * FROM `country_language` WHERE country_language.CountryCode='$c_code'";
                                $conn->query($sql);
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) 
                                {
                                    $i=0;
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "  <label for='country_language_".$i."'>Language Used in the Country : </label></br></br>
                                                        <input type='text' name='country_language_".$i."' id='country_language_".$i."' value='".$row['Language']."'></br></br>
                                                <input type='text' name='country_initial_language_".$i."' id='country_initial_language_".$i."' value='".$row['Language']."' style='display:none'>
                                                        <label for='country_L_Official_".$i."'>  Is it Official Language of the Country?</label>&emsp;";
                                        if ($row['IsOfficial'] == 'T')
                                        {
                                            echo "<select id='country_language_official' form='Update_Country_Form' name='country_L_Official_".$i."'> <option value='T' selected>True</option> <option value='F'>False</option> </select></br></br>";
                                        }
                                        else
                                        {
                                            echo "<select id='country_language_official' form='Update_Country_Form' name='country_L_Official_".$i."'> <option value='T'>True</option> <option value='F' selected>False</option> </select></br></br>";
                                        }
                                        echo "  <label for='country_L_Percentage_".$i."'>Percentage of the Language : </label></br></br>
                                                    <input type='number' name='country_L_Percentage_".$i."' id='country_L_Percentage_".$i."' max='100'  value='".$row['PercentageLanguage']."'></br></br><hr style='border:0.25px solid'>";
                                                $i=$i+1;
                                    }
                                }
                                echo "<input type='number' name='country_L_iteration' id='country_L_iteration' value='".$i."' style='display:none'></br></br> 
                                        </fieldset>
                                        <div class='prevnextbutton'style='overflow:auto;'>
                                            <div style='margin:0 auto;min-width:300px;'>
                                                <button type='button' id='prevBtn' onclick='nextPrev(-1)' style='padding:15px;border:1px solid white;font-family: 'Open Sans', sans-serif;font-size:20px;float:left;'>Previous</button>
                                                <button type='button' id='nextBtn' onclick='nextPrev(1)' style='padding:15px;border:1px solid white;font-family: 'Open Sans', sans-serif;font-size:20px;float:right;'>Next</button>
                                            </div>
                                        </div></fieldset>";
                            }
            
                        ?>
                        
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $c_code_i = $_POST["country_code_initial"];
                    $c_code_3 = $_POST["country_code_3"];
                    $c_code_2 = $_POST["country_code_2"];
                    $c_name = $_POST["country_name"];
                    $c_local_name = $_POST["country_name_local"];
                    $sql = "UPDATE `country_name` SET `CountryCode` = '$c_code_3', `CountryCode2` = '$c_code_2', `CountryName` = '$c_name', `LocalName` = '$c_local_name' WHERE `country_name`.`CountryCode` = '$c_code_i';";
                    $conn->query($sql);
                    
                    $c_continent = $_POST["country_continent"];
                    $c_s_area = $_POST["country_surface_area"];
                    $c_region= $_POST["country_region"];
                    $sql = "UPDATE `geographical_information` SET `CountryCode` = '$c_code_3', `Continent` = '$c_continent', `RegionID` = '$c_region', `SurfaceArea` = '$c_s_area' WHERE `geographical_information`.`CountryCode` = '$c_code_i';";
                    $conn->query($sql);
                    
                    $c_GNP = $_POST["country_GNP_2000"];
                    $c_GNP_old = $_POST["country_GNP_before_2000"];
                    $c_population = $_POST["country_population"];
                    $c_l_expectancy = $_POST["country_LExpectancy"];
                    $sql = "UPDATE `economic_status` SET `CountryCode` = '$c_code_3', `GNP` = '$c_GNP', `GNPOld` = '$c_GNP_old' WHERE `economic_status`.`CountryCode` = '$c_code_i';";
                    $conn->query($sql);

                    $sql = "UPDATE `population` SET `CountryCode` = '$c_code_3', `PopulationCountry` = '$c_population', `LifeExpectancy` = '$c_l_expectancy' WHERE `population`.`CountryCode` = '$c_code_i';";
                    $conn->query($sql);

                    $c_indep_year = $_POST["country_InderYear"];
                    $c_government_form = $_POST["country_form_government"];
                    $c_hos= $_POST["country_ruler"];
                    $c_capital = $_POST["country_capital"];
                    $sql = "UPDATE `general_information` SET `CountryCode` = '$c_code_3', `IndepYear` = '$c_indep_year', `GovernmentForm` = '$c_government_form', `HeadOfState` = '$c_hos', `Capital` = '$c_capital' WHERE `general_information`.`CountryCode` = '$c_code_i';";
                    $conn->query($sql);

                    $c_L_iteration = $_POST["country_L_iteration"];

                    while ( $c_L_iteration  > 0 ) {
                        $true_V=$c_L_iteration-1;
                        $c_Language_N=$_POST["country_language_$true_V"];
                        $c_Language_O=$_POST["country_L_Official_$true_V"];
                        $c_Language_I=$_POST["country_initial_language_$true_V"];
                        $c_Language_P=$_POST["country_L_Percentage_$true_V"];
                        $sql= "UPDATE `country_language` SET `CountryCode` = '$c_code_3 ', `Language` = '$c_Language_N', `IsOfficial` = '$c_Language_O', `PercentageLanguage` = '$c_Language_P' WHERE `country_language`.`CountryCode` = '$c_code_i' AND `country_language`.`Language` = '$c_Language_I';";
                        $conn->query($sql);
                        $c_L_iteration=$c_L_iteration - 1;
                        }
                    
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
<script>
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("Update_Country_Form").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, z ,valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    z = x[currentTab].getElementsByTagName("select");

    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if ((y[i].value == "" && y[i].required == true )){
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }
    for (i = 0; i < z.length; i++) {
      // If a field is empty...
      if ((z[i].value == "" && z[i].required == true )){
        // add an "invalid" class to the field:
        z[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }

  function getLanguageInput() {
    var x = document.getElementById("Language_input");
    document.getElementById('L_INPUT').innerHTML="";
    y=x.value;
    var i = 0;
    while (i<y)
    {
      document.getElementById('L_INPUT').innerHTML+="<label for='country_language_"+i+"'>Language Used in the Country : </label></br></br>";
      document.getElementById('L_INPUT').innerHTML+="<input type='text' name='country_language_"+i+"' id='country_language_"+i+"'></br></br>";
      document.getElementById('L_INPUT').innerHTML+="<label for='country_L_Official_"+i+"'>  Is it Official Language of the Country?</label>&emsp;";
      document.getElementById('L_INPUT').innerHTML+="<select id='country_language_official' form='Update_Country_Form' name='country_L_Official_"+i+"'> <option value='T' selected>True</option> <option value='F'>False</option> </select></br></br>";
      document.getElementById('L_INPUT').innerHTML+="<label for='country_L_Percentage_"+i+"'>Percentage of the Language : </label></br></br>";
      document.getElementById('L_INPUT').innerHTML+="<input type='number' name='country_L_Percentage_"+i+"' id='country_L_Percentage_"+i+"' max='100'></br></br><hr style='border:0.25px solid'> ";
      i++;
    }
  }

</script>
