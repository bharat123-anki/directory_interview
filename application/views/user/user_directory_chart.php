<?php

$dataPoints = $data;

?>

<script>
	window.onload = function() {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			//theme: "light2",
			title: {
				text: "Pie Chart"
			},
			axisX: {
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			axisY: {
				title: "in Metric Tons",
				includeZero: true,
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			toolTip: {
				enabled: false
			},
			data: [{
				type: "area",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

	}
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>