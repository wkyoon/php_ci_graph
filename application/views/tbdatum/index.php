<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="<?=base_url('assets/chartjs/Chart.min.js') ?>"></script>
	<script src="<?=base_url('assets/chartjs/samples/utils.js') ?>"></script>

	<style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
	
</head>
<body>

<div style="width:75%;">
		<canvas id="canvas"></canvas>
	</div>
	<script>
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var config = {
			type: 'line',
			data: {
				labels: [
					<?php foreach($tbdata as $t){ ?>
						"<?php echo $t->tinfo; ?>",
					<?php } ?>

				],
				datasets: [{
					label: 'F1 F2 F3 F4',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
						<?php foreach($tbdata as $t){ ?>
						"<?php echo  $t->thrhlder; ?>",
					<?php } ?>
					],
					fill: false,
				}, {
					label: 'Data',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						<?php foreach($tbdata as $t){ ?>
						"<?php echo  $t->val01; ?>",
					<?php } ?>
					],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'catmos test'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Time Info'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

		

		

		
	</script>
<p>
<h2>
<?php echo $links; ?>
</h2>
</p>
<table border="1" width="100%">
    <tr>
		<th>Idx</th>
		<th>Mac</th>
		<th>Thrhlder</th>
		<th>Val01</th>
		<th>Tinfo</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tbdata as $t){ ?>
    <tr>
		<td><?php echo $t->idx; ?></td>
		<td><?php echo $t->mac; ?></td>
		<td><?php echo $t->thrhlder; ?></td>
		<td><?php echo $t->val01; ?></td>
		<td><?php echo $t->tinfo; ?></td>
		<td>

        </td>
    </tr>
	<?php } ?>
</table>


</body>
</html>




