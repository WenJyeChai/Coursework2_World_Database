<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/insert_style.css">';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/phonetesting.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/normal.css" />';
    echo '<title>Country Detail</title>';
?>

<?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") 
                {
                    $c_code = $_GET['CountryCode'];

                    $sql = "SELECT country_name.CountryCode2 from country_name where country_name.CountryCode = '$c_code'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $datamap = $row["CountryCode2"];
                    $datamap=json_encode($datamap);

                    $sql = "SELECT round(population.PopulationCountry/ (SELECT MAX(population.PopulationCountry)FROM population)*100) AS 'Percentage',population.PopulationCountry FROM population WHERE population.CountryCode = '$c_code'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $P_P =  $row["Percentage"];
                    $P = $row["PopulationCountry"];

                    $sql = "SELECT round(population.LifeExpectancy/ (SELECT MAX(population.LifeExpectancy)FROM population)*100) AS 'Percentage',population.LifeExpectancy FROM population WHERE population.CountryCode = '$c_code'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $L_P =  $row["Percentage"];
                    $LE = $row["LifeExpectancy"];

                    $sql = "SELECT round(geographical_information.SurfaceArea/ (SELECT MAX(geographical_information.SurfaceArea)FROM geographical_information)*100) AS 'Percentage',geographical_information.SurfaceArea FROM geographical_information WHERE geographical_information.CountryCode = '$c_code'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $SA_P =  $row["Percentage"];
                    $SA = $row["SurfaceArea"];

                    $sql = "SELECT round(economic_status.GNP/ (SELECT MAX(economic_status.GNP)FROM economic_status)*100) AS 'Percentage',economic_status.GNP FROM economic_status WHERE economic_status.CountryCode = '$c_code'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $GNP_P =  $row["Percentage"];
                    $GNP = $row["GNP"];
                    $data[0]=array('category'=>"Population",'value'=>$P_P,'full'=>'100','actualvalue'=>$P);
                    $data[1]=array('category'=>"Life Expectancy",'value'=>$L_P,'full'=>'100','actualvalue'=>$LE);
                    $data[2]=array('category'=>"Surface Area",'value'=>$SA_P,'full'=>'100','actualvalue'=>$SA);
                    $data[3]=array('category'=>"GNP in 2000",'value'=>$GNP_P,'full'=>'100','actualvalue'=>$GNP);
                    $data=json_encode($data);

                    $sql = "SELECT * FROM `country_name` WHERE CountryCode='$c_code'";
                    $conn->query($sql);
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $c_name = $row["CountryName"];
                    $c_local_name = $row["LocalName"];

                    $sql = "SELECT * FROM `geographical_information` WHERE CountryCode='$c_code'";
                    $conn->query($sql);
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $c_continent = $row["Continent"];

                    $sql = "SELECT * FROM `general_information` WHERE CountryCode='$c_code'";
                    $conn->query($sql);
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $c_indep_year = $row["IndepYear"];
                    $c_government_form = $row["GovernmentForm"];
                    $c_capital = $row["Capital"];

                    $sql = "SELECT city.CityName FROM `city` WHERE city.CityID='$c_capital'";
                    $conn->query($sql);
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $c_capital_name= $row["CityName"];

                    $sql = "SELECT * FROM country_language WHERE ((country_language.CountryCode='$c_code')AND(country_language.IsOfficial='T'))";
                    $conn->query($sql);
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $O_L= $row["Language"];
                    $O_L_P= $row["PercentageLanguage"];

                }
            ?>

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/maps.js"></script>
<script src="https://www.amcharts.com/lib/4/geodata/worldHigh.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>

<!-- Chart code -->
<script>
  am4core.ready(function() {

  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  var chart = am4core.create("radardiv", am4charts.RadarChart);

  // Add data
  chart.data =  <?php echo $data; ?>;

  // Make chart not full circle
  chart.startAngle = -90;
  chart.endAngle = 180;
  chart.innerRadius = am4core.percent(20);

  // Set number format
  chart.numberFormatter.numberFormat = "#.#'%'";

  // Create axes
  var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "category";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.grid.template.strokeOpacity = 0;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.fontWeight = 500;
  categoryAxis.renderer.labels.template.fill = am4core.color("#D6E7FF");
  categoryAxis.renderer.minGridDistance = 10;

  var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.grid.template.strokeOpacity = 0;
  valueAxis.renderer.labels.template.fill = am4core.color("#D6F4FF");
  valueAxis.min = 0;
  valueAxis.max = 100;
  valueAxis.strictMinMax = true;

  // Create series
  var series1 = chart.series.push(new am4charts.RadarColumnSeries());
  series1.dataFields.valueX = "full";
  series1.dataFields.categoryY = "category";
  series1.clustered = false;
  series1.columns.template.fill = am4core.color("#fff");
  series1.columns.template.fillOpacity = 0.2;
  series1.columns.template.cornerRadiusTopLeft = 20;
  series1.columns.template.strokeWidth = 0;
  series1.columns.template.radarColumn.cornerRadius = 20;

  var series2 = chart.series.push(new am4charts.RadarColumnSeries());
  series2.dataFields.valueX = "value";
  series2.dataFields.categoryY = "category";
  series2.clustered = false;
  series2.columns.template.strokeWidth = 0;
  series2.columns.template.tooltipText = "{category}: [bold]{actualvalue}[/]";
  series2.columns.template.radarColumn.cornerRadius = 20;
  series2.heatRules.push({ target: series2.columns.template, property: "fill", dataField: "valueX", min: am4core.color("#E1B382"), max: am4core.color("#FFF9F0") });
  chart.logo.height = -1222225;
  // Add cursor
  chart.cursor = new am4charts.RadarCursor();

  /* Create map instance */
  var chart = am4core.create("chartdiv", am4maps.MapChart);

  /* Set map definition */
  chart.geodata = am4geodata_worldHigh;

  /* Set projection */
  chart.projection = new am4maps.projections.Miller();

  /* Create map polygon series */
  var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

  /* Make map load polygon (like country names) data from GeoJSON */
  polygonSeries.useGeodata = true;
  polygonSeries.exclude = ["AQ"];

  /* Configure series */
  var polygonTemplate = polygonSeries.mapPolygons.template;
  polygonTemplate.applyOnClones = true;
  polygonTemplate.togglable = true;
  polygonTemplate.tooltipText = "{name}";
  polygonTemplate.nonScalingStroke = true;
  polygonTemplate.stroke = am4core.color("#141e30");
  polygonTemplate.strokeOpacity = 1;
  polygonTemplate.strokeWidth = 1;
  polygonTemplate.fill = am4core.color("#e1b382");

  var lastSelected;
  polygonTemplate.events.on("hit", function(ev) {
    if (lastSelected) {
      // This line serves multiple purposes:
      // 1. Clicking a country twice actually de-activates, the line below
      //    de-activates it in advance, so the toggle then re-activates, making it
      //    appear as if it was never de-activated to begin with.
      // 2. Previously activated countries should be de-activated.
      lastSelected.isActive = false;
    }
    ev.target.series.chart.zoomToMapObject(ev.target);
    if (lastSelected !== ev.target) {
      lastSelected = ev.target;
    }
  })


  /* Create selected and hover states and set alternative fill color */
  var ss = polygonTemplate.states.create("active");
  ss.properties.fill = am4core.color("#c89666");

  var hs = polygonTemplate.states.create("hover");
  hs.properties.fill = am4core.color("#c89666");

  chart.events.on("ready", function(ev) {
    var country = polygonSeries.getPolygonById(<?php echo $datamap ?>);
    chart.zoomToMapObject(country);
    country.isActive = true;
  });




  chart.logo.height = -15;

  }); // end am4core.ready()
</script>

<!-- HTML -->
<button style="position:absolute;top:10px;left:10px;font-size:20px;font-family: 'Open Sans', sans-serif;" onclick="window.location.href='javascript:window.history.back()'">BACK</button>
<h1 class= "countryname">
    <?php echo $c_name ?>
    
</h1>
<div class= "column">

    <div class= "countrymap" id="chartdiv">
    </div>

    <div class= "chartdesc">
    
      <div class="countrychart" id="radardiv">
      </div>
     
      <div class="countrydesc">
          <p class="desc">
          <?php echo $c_name ?> (<?php echo utf8_encode($c_code) ?>) is a <?php echo utf8_encode($c_continent) ?> country which has a surface area of <?php echo utf8_encode($SA) ?>km<sup>2</sup>. 
          This country achieved independence in the year of <?php echo utf8_encode($c_indep_year) ?> and the form of government since then is <?php echo utf8_encode($c_government_form) ?>. 
          <?php echo $c_name ?> has a population of <?php echo utf8_encode($P) ?> with life expectancy of <?php echo utf8_encode($LE) ?>. 
          The official language in this country is <?php echo utf8_encode($O_L) ?> and the percentage of this language used in the country is <?php echo utf8_encode($O_L_P) ?>%. 
          Capital city of <?php echo utf8_encode($c_name) ?> is <?php echo utf8_encode($c_capital_name) ?>  that usually physically encompasses the government’s offices and meeting places; the status as capital is often designated by its law or constitution. 
          In the year 2000, the Gross National Product (GNP) / Gross Domestic Product (GDP) of the <?php echo utf8_encode($c_name) ?> is <?php echo utf8_encode($GNP) ?>.
          </p>
      </div>
    </div>

</div>

