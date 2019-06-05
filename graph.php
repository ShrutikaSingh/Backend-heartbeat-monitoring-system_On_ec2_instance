<?php

$dataPoints1 = array();
$dataPoints2 = array();

$f = fopen("data.csv", "r");
$fr = fread($f, filesize("data.csv"));
fclose($f);
$lines = array();
$lines = explode("\n",$fr); // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of... 

for($i=0;$i<count($lines);$i++)
{
	$cell = array(); 
  $cell = explode(",",$lines[$i]); // use the cell/row delimiter what u need!
  
  if (empty($cell[1]) || empty($cell[2]))
  	continue;
  
  //echo $cell[0] ." ". $cell[1] ." ". $cell[2] . "<br>";
  
  $hbr = array("x" => (int)$cell[0], "y" => (float)$cell[1]);
  $tem = array("x" => (int)$cell[0], "y" => (float)$cell[2]);
  array_push($dataPoints1, $hbr);
  array_push($dataPoints2, $tem);
  
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Patient Stats"
	},
	subtitles: [{
		text: "Patient heart beats/minute and body temperature",
		fontSize: 18
	}],
	axisY: {
		includeZero: true,
		prefix: ""
	},
	legend:{
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	toolTip: {
		shared: true
	},
	data: [
	{
		type: "line",
		name: "Heart Rate(bpm)",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString: "MMM YYYY",
		yValueFormatString: "₹#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints1); ?>
	},
	{
		type: "line",
		name: "Temperature(F)",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString: "MMM YYYY",
		yValueFormatString: "₹#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints2); ?>
	}
	]
});
 
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 450px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
