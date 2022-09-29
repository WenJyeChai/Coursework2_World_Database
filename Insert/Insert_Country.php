<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Insert Country</title>';
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
            <h1 style="text-align:left;width:75%;margin: 0 auto;">Insert Country</h1>
            </div>
            <form id="CountryForm" action="Insert_Country.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="outer_insert" >
                    <div style="text-align:center;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                    <fieldset class="tab">
                            <legend style="padding:15px;font-size:40px;line-height: 1.0;">Name</legend>
                                <label for="country_code_3">Country Code in 3 Alphabets:&emsp;&emsp;</label>
                                <input type="text" name="country_code_3" id="country_code_3" maxlength="3" required></br></br></br>
                                <label for="country_code_2">Country Code in 2 Alphabets:&emsp;&emsp;</label>
                                <input type="text" name="country_code_2" id="country_code_2" maxlength="2"></br></br></br>
                                <label for="country_name">Country Name :&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</label>
                                <input type="text" name="country_name" id="country_name" required></br></br></br>
                                <label for="country_name_local">Local Name of the Country:&emsp;&emsp;&emsp;</label>
                                <input type="text" name="country_name_local" id="country_name_local"></br></br></br>
                    </fieldset>
                    <fieldset class="tab">
                        <legend style="padding:15px;font-size:40px;line-height: 1.0;">Geographical Information</legend>
                           <label for="country_continent"></br></br>Country Continent :</label>&emsp;
                                                <?php
                                                    $sql = "SELECT geographical_information.Continent FROM geographical_information GROUP by geographical_information.Continent";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        echo    "<select id='country_continent' form='CountryForm' name='country_continent' required>"	;
                                                        echo    "<option value='' disabled selected>Select your option</option>"    ;
                                                        while($row = $result->fetch_assoc())
                                                        {
                                                            echo "  <option value=". utf8_encode($row["Continent"]).">"
                                                                                    . utf8_encode($row["Continent"]).
                                                                    "</option>";
                                                        }
                                                        echo "</select></br></br>";
                                                    }
                                                ?>
                            <label for="country_region"></br></br>Country Region :</label>&emsp;
                                                <?php
                                                $sql = "SELECT country_region.RegionID,country_region.RegionName FROM country_region";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    echo    "<select id='country_region' form='CountryForm' name='country_region' required>"	;
                                                    echo    "<option value='' disabled selected>Select your option</option>"    ;
                                                    while($row = $result->fetch_assoc())
                                                    {
                                                        echo "  <option value=". utf8_encode($row["RegionID"]).">"
                                                                                . utf8_encode($row["RegionName"]).
                                                                "</option>";
                                                    }
                                                    echo "</select></br></br>";
                                                }
                                                ?>
                            <label for="country_surface_area"></br></br>Surface Area of the country :&emsp;&emsp;</label>
                            <input type="number" name="country_surface_area" id="country_surface_area"></br></br>
                    </fieldset>
                    <fieldset class="tab">
                        <legend style="padding:15px;font-size:35px;line-height: 1.0;">Population / Economy status</legend>
                            <label for="country_GNP_before_2000">GNP/GDP of the Country before 2000 :&emsp;</br></br></label>
                            <input type="number" name="country_GNP_before_2000" id="country_GNP_before_2000"></br></br>
                            <label for="country_GNP_2000">GNP/GDP of the Country in 2000 :&emsp;&emsp;</br></br></label>
                            <input type="number" name="country_GNP_2000" id="country_GNP_2000"></br></br>
                            <label for="country_LExpectancy">Life Expectancy of the Country :&emsp;&emsp;</label>
                            <input type="number" name="country_LExpectancy" id="country_LExpectancy"></br></br>
                            <label for="country_population">Population of the Country :&emsp;&emsp;&emsp;</label>
                            <input type="number" name="country_population" id="country_population"></br></br>
                    </fieldset>
                    <fieldset class="tab">
                        <legend style="padding:15px;font-size:40px;line-height: 1.0;">General Information</legend>
                            <label for="country_InderYear">Independent Year of the Country :&emsp;</label>
                            <input type="number" name="country_InderYear" id="country_InderYear"></br></br>
                            <label for="country_form_government">Form of Government in the Country :</label></br></br>
                            <input type="text" name="country_form_government" id="country_form_government"></br></br>
                            <label for="country_ruler">Ruler of the Country :&emsp;&emsp;</label>
                            <input type="text" name="country_ruler" id="country_ruler"></br></br>
                            <label for="country_capital">Capital City of the Country :</label></br></br>
                            <?php
                                $sql = "SELECT city.CityID,city.CityName FROM city Order BY CityName ASC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    echo    "<select id='country_capital' form='CountryForm' name ='country_capital'>"	;
                                    echo    "<option value='0'selected>none</option>"    ;
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "  <option value=". utf8_encode($row["CityID"]).">"
                                                                . utf8_encode($row["CityName"]).
                                                "</option>";
                                    }
                                    echo "</select></br></br>";
                                }
                            ?>
                    </fieldset>
                    <fieldset class="tab">
                        <legend style="padding:15px;font-size:40px;line-height: 1.0;">Language Used</legend>
                        <label for="Language_input">How many language need to be input ?</label></br></br>
                        <input id='Language_input' type="number" size="20" onblur="getLanguageInput()" name="iterarion_o_input"></br></br>
                        <hr style='border:0.25px solid'></br>
                        <div id="L_INPUT"></div>
                    </fieldset>
                    <div class='prevnextbutton'style="overflow:auto;">
                        <div style="margin:0 auto;min-width:300px;">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)" style="padding:15px;border:1px solid white;font-family: 'Open Sans', sans-serif;font-size:20px;float:left;">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)" style="padding:15px;border:1px solid white;font-family: 'Open Sans', sans-serif;font-size:20px;float:right;">Next</button>
                        </div>
                    </div>

            </div>
            </form>
            
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $c_code_3 = $_POST['country_code_3'];
                    $c_code_2 = $_POST['country_code_2'];
                    $c_name = $_POST['country_name'];
                    $c_name_local = $_POST['country_name_local'];
                    $c_continent = $_POST['country_continent'];
                    $c_region = $_POST['country_region'];
                    $c_GNP_before_2000 = $_POST['country_GNP_before_2000'];
                    $c_GNP_2000 = $_POST['country_GNP_2000'];
                    $c_LExpectancy = $_POST['country_LExpectancy'];
                    $c_population = $_POST['country_population'];
                    $c_surface_area = $_POST['country_surface_area'];
                    $c_InderYear = $_POST['country_InderYear'];
                    $c_form_government = $_POST['country_form_government'];
                    $c_ruler = $_POST['country_ruler'];
                    $c_capital = $_POST['country_capital'];
                    $c_iteration_of_input = $_POST['iterarion_o_input'];
            
                    $statement = $conn -> prepare("INSERT INTO `general_information` (`CountryCode`, `IndepYear`, `GovernmentForm`, `HeadOfState`, `Capital`) VALUES (?, ?, ?, ?,?)"); 
                    $statement -> bind_param("sissi",$c_code_3,$c_InderYear,$c_form_government,$c_ruler,$c_capital);
                    $statement -> execute();
            
                    $statement = $conn -> prepare("INSERT INTO `country_name` (`CountryCode`, `CountryCode2`, `CountryName`, `LocalName`) VALUES (?, ?, ?, ?)"); 
                    $statement -> bind_param("ssss",$c_code_3,$c_code_2,$c_name,$c_name_local);
                    $statement -> execute();
            
                    $statement = $conn -> prepare("INSERT INTO `geographical_information` (`CountryCode`, `Continent`, `RegionID`, `SurfaceArea`) VALUES (?, ?, ?, ?)"); 
                    $statement -> bind_param("ssii",$c_code_3,$c_continent, $c_region,$c_surface_area);
                    $statement -> execute();
            
                    $statement = $conn -> prepare("INSERT INTO `economic_status` (`CountryCode`, `GNP`, `GNPOld`) VALUES (?, ?, ?)"); 
                    $statement -> bind_param("sii",$c_code_3,$c_GNP_2000,$c_GNP_before_2000);
                    $statement -> execute();
            
                    $statement = $conn -> prepare("INSERT INTO `population` (`CountryCode`, `PopulationCountry`, `LifeExpectancy`) VALUES (?, ?, ?)"); 
                    $statement -> bind_param("sii", $c_code_3, $c_population, $c_LExpectancy);
                    $statement -> execute();
            
                    
                    while ($c_iteration_of_input  > 0) {
                      $true_V=$c_iteration_of_input-1;
                      $c_Language_N=$_POST["country_language_$true_V"];
                      $c_Language_O=$_POST["country_L_Official_$true_V"];          
                      $c_Language_P=$_POST["country_L_Percentage_$true_V"];
                      $c_iteration_of_input=$c_iteration_of_input - 1;
                      $statement = $conn -> prepare("INSERT INTO `country_language` (`CountryCode`, `Language`, `IsOfficial`, `PercentageLanguage`) VALUES (?, ?, ?, ?)"); 
                      $statement -> bind_param("sssi", $c_code_3, $c_Language_N, $c_Language_O, $c_Language_P);
                      $statement -> execute();
                      }
                              
                    echo "<script> alert('Data is inserted'); </script> ";
                    $statement -> close();
                    $conn -> close();
            
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
      document.getElementById("CountryForm").submit();
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
      document.getElementById('L_INPUT').innerHTML+="<select id='country_language_official' form='CountryForm' name='country_L_Official_"+i+"'> <option value='T' selected>True</option> <option value='F'>False</option> </select></br></br>";
      document.getElementById('L_INPUT').innerHTML+="<label for='country_L_Percentage_"+i+"'>Percentage of the Language : </label></br></br>";
      document.getElementById('L_INPUT').innerHTML+="<input type='number' name='country_L_Percentage_"+i+"' id='country_L_Percentage_"+i+"' max='100'></br></br><hr style='border:0.25px solid'> ";
      i++;
    }
  }

</script>


