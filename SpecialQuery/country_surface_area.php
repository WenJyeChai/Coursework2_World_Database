
<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';	
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Surface Area Ranking Percentage</title>';
?>


<?php
        // collect value of input field
        $sql = "SELECT country_name.CountryName,geographical_information.SurfaceArea FROM geographical_information INNER JOIN country_name ON country_name.CountryCode=geographical_information.CountryCode ORDER BY geographical_information.SurfaceArea DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0)
            {
                $i=0;
                $acc=0;
                while($row = $result->fetch_assoc())
                {
                    if ($i <=5)
                    {
                        $data[$i]=array('language_name'=>$row["CountryName"],'frequency'=>$row["SurfaceArea"]);
                        $i++;
                    }
                    else
                    {
                        $acc=$acc+$row["SurfaceArea"];
                        $data[$i]=array('language_name'=>'Others','frequency'=>$acc);
                    }

                }
            }
        $data=json_encode($data);
        $conn->close();
?>

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/spiritedaway.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart
var chart = am4core.create("chartdiv", am4charts.PieChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.data = <?php echo $data; ?>;

var series = chart.series.push(new am4charts.PieSeries());
series.dataFields.value = "frequency";
series.dataFields.category = "language_name";
series.labels.template.fill= am4core.color("white");
series.ticks.template.stroke= am4core.color("white");
series.ticks.template.strokeOpacity = 1;
series.slices.template.cornerRadius = 6;
series.slices.template.stroke = am4core.color("#fff");
series.slices.template.strokeWidth = 2;

var variable = series.slices.template;
series.heatRules.push({ target: variable, property: "fill", dataField: "value", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
series.mainContainer.mask = undefined;

series.hiddenState.properties.endAngle = -90;

chart.legend = new am4charts.Legend();
chart.legend.labels.template.fill= am4core.color("white");
chart.legend.valueLabels.template.fill= am4core.color("white");
chart.innerRadius = am4core.percent(30);
chart.logo.height = -1005;
}); // end am4core.ready()
</script>

<!-- HTML -->
<button style="position:absolute;top:10px;left:10px;font-size:20px;" onclick="window.location.href='javascript:window.history.back()'">BACK</button>
<h1 style="width:70%;margin:5% auto;">Surface Area of Country Chart</h1>
<div id="chartdiv" style="width:80%;margin:auto;height:80%;"></div>