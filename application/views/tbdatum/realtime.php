<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

	<script>
	var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

function randomScalingFactor() {

	return Math.floor(Math.random() * 101);   

}
var lastdata;

var lasttinfo;


var temparr = Array();

function xxxxx(data) {

	//console.log('This is your data', data);

	// 2020-08-26 18:23:20
	lasttinfo = parseFloat(data['tinfo']);
	//console.log('This is your data', data['mvalue']);
	if(data['mvalue']!=false)
	{
		lastdata = [ data['val01'],data['thrhlder']];
		console.log('This is your data', lastdata);
	}
	else
	{
		lastdata = null;
	}
	
	
	
	
	
	
	


}

function onRefresh(chart) {

	
	var tinfo = Date.now();
	var temp1 = parseInt(tinfo/1000)*1000;
	console.log(temp1);
	//console.log(parseInt(temp1/1000)*1000);

	const apiUrl = '<?php echo base_url(); ?>/api/<?= $mac?>_'+temp1;
	//console.log("<?= $mac?>");
	//console.log(apiUrl);
    fetch(apiUrl)
      .then((response) => response.json())
      .then((data) => xxxxx(data));

	  if(lastdata!=null)
	{
		//console.log('This is your data', data['tbdatum'][0]['val01']);
		//console.log('This is your data', lastdata[0]);
		//console.log('This is your data', tinfo);
		//console.log('This is your data', lasttinfo);
		$( ".inner" ).append( "<p>"+tinfo+" , "+lastdata[0]+" , "+lastdata[1]+"</p>" );
		chart.config.data.datasets[0].data.push({
			x: lasttinfo,
			y: parseFloat(lastdata[0]) 
			});

			chart.config.data.datasets[1].data.push({
				x: lasttinfo,
				y:parseInt(lastdata[1]) 
			});
	}

	


}

var color = Chart.helpers.color;
var config = {
	type: 'line',
	data: {
		labels: [],
		datasets: [{
			label: 'value cal',
			yAxisID: 'A',
			backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
			borderColor: chartColors.red,
			fill: false,
			lineTension: 0,
		
			data: []
		}, {
			label: 'STEP F1 ~ F4',
			yAxisID: 'B',
			backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: true,
			text: '<?=$mac?>'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 60000,
					refresh: 1000,
					delay: 1000,
					onRefresh: onRefresh
				}
			},],
			yAxes: [{
				id: 'A',
				scaleLabel: {
					display: true,
					labelString: 'value'
				}
			},
			{
				id: 'B',
				scaleLabel: {
					display: true,
					labelString: 'STEP F1 ~ F4'
					
				},
				ticks: {
                            // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
                            suggestedMin: 0,

                            // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
                            suggestedMax: 5,
							
                        }
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		}
	}
};

window.onload = function() {
	var ctx = document.getElementById('myChart').getContext('2d');
	window.myChart = new Chart(ctx, config);
};



	</script>
	
</head>
<body>
<div style="width:100%;" >
	<canvas id="myChart"></canvas>
</div>
<div class="inner" style="width:75%;" >

</div>

</body>
</html>




