<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';	
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Population Density Ranking</title>';
?>


<?php
        // collect value of input field
        $sql = "SELECT country_name.CountryName,round((population.PopulationCountry)/(geographical_information.SurfaceArea))AS 'Population density' FROM geographical_information INNER JOIN country_name INNER JOIN population ON (country_name.CountryCode=geographical_information.CountryCode) AND (country_name.CountryCode=population.CountryCode) GROUP BY country_name.CountryName ORDER BY (population.PopulationCountry)/(geographical_information.SurfaceArea) DESC LIMIT 6";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0)
            {
                $i=0;
                while($row = $result->fetch_assoc())
                {
                    $data[$i]=array('Country'=>$row["CountryName"],'Population density'=>$row["Population density"]);
                    $i++;
                }
            }
        $data=json_encode($data);
        $conn->close();
?>

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    /**
    * Chart design taken from Samsung health app
    */

    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.paddingRight = 40;

    chart.data = <?php echo $data; ?>;

    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "Country";
    categoryAxis.renderer.labels.template.fill= am4core.color("white");
    categoryAxis.renderer.fontSize = 20;
    categoryAxis.renderer.grid.template.strokeOpacity = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.renderer.labels.template.dx = -20;
    categoryAxis.renderer.minWidth = 120;
    categoryAxis.cursorTooltipEnabled = false;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.inside = true;
    valueAxis.renderer.labels.template.fillOpacity = 1;
    valueAxis.renderer.labels.template.fill= am4core.color("white");
    valueAxis.renderer.grid.template.strokeOpacity = 0;
    valueAxis.min = 0;
    valueAxis.cursorTooltipEnabled = false;
    valueAxis.renderer.baseGrid.strokeOpacity = 0;
    valueAxis.renderer.labels.template.dy = 20;

    var series = chart.series.push(new am4charts.ColumnSeries);
    series.dataFields.valueX = "Population density";
    series.dataFields.categoryY = "Country";
    series.tooltipText = "{valueX.value}";
    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.dy = - 20;
    series.tooltip.fontSize = 20;
    series.columnsContainer.zIndex = 100;

    var columnTemplate = series.columns.template;
    columnTemplate.height = am4core.percent(50);
    columnTemplate.maxHeight = 30;
    columnTemplate.column.cornerRadius(60, 10, 60, 10);
    columnTemplate.strokeOpacity = 0;

    series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueX", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
    series.mainContainer.mask = undefined;

    var cursor = new am4charts.XYCursor();
    chart.cursor = cursor;
    cursor.lineX.disabled = true;
    cursor.lineY.disabled = true;
    cursor.behavior = "none";

    var bullet = columnTemplate.createChild(am4charts.CircleBullet);
    bullet.circle.radius = 12;
    bullet.valign = "middle";
    bullet.align = "left";
    bullet.isMeasured = true;
    bullet.interactionsEnabled = false;
    bullet.horizontalCenter = "right";
    bullet.interactionsEnabled = false;

    var hoverState = bullet.states.create("hover");
    var outlineCircle = bullet.createChild(am4core.Circle);
    outlineCircle.adapter.add("radius", function (radius, target) {
        var circleBullet = target.parent;
        return circleBullet.circle.pixelRadius + 10;
    })

    var previousBullet;
    chart.cursor.events.on("cursorpositionchanged", function (event) {
        var dataItem = series.tooltipDataItem;

        if (dataItem.column) {
            var bullet = dataItem.column.children.getIndex(1);

            if (previousBullet && previousBullet != bullet) {
                previousBullet.isHover = false;
            }

            if (previousBullet != bullet) {

                var hs = bullet.states.getKey("hover");
                hs.properties.dx = dataItem.column.pixelWidth;
                bullet.isHover = true;

                previousBullet = bullet;
            }
        }
    })
    chart.logo.height = -1005;

    }); // end am4core.ready()
</script>
<button style="position:absolute;top:10px;left:10px;font-size:20px;" onclick="window.location.href='javascript:window.history.back()'">BACK</button>
<h1 style="width:70%;margin:5% auto;">Population Density of Country Chart</h1>
<div id="chartdiv" style="width:80%;margin:auto;height:80%;"></div>