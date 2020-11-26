<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

	<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Increase contrast by taking evey second color
chart.colors.step = 2;

chart.paddingRight = 20;

chart.data = generateChartData();

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.baseInterval = {
  "timeUnit": "second",
  "count": 1
};
dateAxis.tooltipDateFormat = "HH:mm:ss, MM-dd ";

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.title.text = "calorie";

var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.dateX = "date";
series.dataFields.valueY = "calorie";
series.tooltipText = "calorie: [bold]{valueY}[/]";
series.fillOpacity = 0.3;


var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.dateX = "date";
series2.dataFields.valueY = "step";
series2.tooltipText = "step: [bold]{valueY}[/]";
series2.fillOpacity = 0.3;




chart.cursor = new am4charts.XYCursor();
chart.cursor.lineY.opacity = 0;
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series);


dateAxis.start = 0.8;
dateAxis.keepSelection = true;



function generateChartData() {
    var chartData = [];
    // current date
    var firstDate = new Date('<?=$tinfo?> 00:00:00');
    // now set 500 minutes back
    //firstDate.setMinutes(firstDate.getDate() - 500);
	firstDate.setSeconds(firstDate.getDate());
    // and generate 500 data items
    
	
	<?php foreach($tbdatum as $item) { ?>
		chartData.push({
            date: new Date('<?=$item['tinfo']?>'),
            calorie: <?=$item['val01']?>,
			step : <?=$item['thrhlder']?>
        });

<?php   }     ?>



    return chartData;
}

}); // end am4core.ready()
</script>

	<script>
  $( function() {
	$( "#datepicker" ).datepicker();
    $( "#datepicker" ).datepicker("option", "dateFormat", "yy-mm-dd");
	$( "#datepicker" ).val("<?=$tinfo?>");
	$( "#button1" ).click(function() {
		//
		if($( "#datepicker" ).val().length==0)
		{
			alert( "input date info !!!" );
		}
		else
		{
			location.href = "/Tbdatum/daily/<?=$mac?>/"+$( "#datepicker" ).val();
		}
		
	});
  } );
  </script>
	
</head>
<body>
<div > 


  

  <p>Date: <input type="text" id="datepicker" name="tinfo" > <input type="button" id="button1" value="button"> </p>


</div>
<div><h1><?=$mac ?></h1></div>
<div id="chartdiv"></div>


<div>
<table>
<tr>
<td width="400">tinfo</td>
<td width="100">calorie</td>
<td width="100">step</td>
</tr>

<?php 
foreach($tbdatum as $item) { ?>
<tr>
	<td><?= $item['tinfo'] ?> </td>
	<td>  <?= $item['val01'] ?> </td>
	<td> <?= $item['thrhlder'] ?></td>
</tr>
<?php   }     ?>
</table>
</div>
</body>
</html>




