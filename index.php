<!DOCTYPE html>
<html>
<head>
<title>Patient Data</title>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
</head>
<body class="container-fluid">

<h2>Patient Data</h2>

<form class="py-2">
  <button type="submit"><a href="http://13.233.111.90/graph1.php">Live ECG Waves</a></button>
</form>

<form class="py-2">
  <button type="submit"><a href="http://13.233.111.90/del-data-csv.php">Clear Data</a></button>
</form>

<br><br><br>


<?php 
echo "<html><body><table class=\"table table-bordered\">";
$f = fopen("data.csv", "r");
$fr = fread($f, filesize("data.csv"));
fclose($f);
$lines = array();
$lines = explode("\n",$fr); // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of... 

echo "<tr>";
echo "<td>Timestamp</td>";
echo "<td>BPM</td>";
echo "<td>Temperature(F)</td>";
echo "</tr>";

for($i=0;$i<count($lines);$i++)
{
    echo "<tr>";
    $cells = array();
    $cells = explode(",",$lines[$i]); // use the cell/row delimiter what u need!

  if (empty($cells[0]))
  	continue;
echo "<td>" . date("d/m/Y H:i:s", ($cells[0]/1000)) . "</td>";

for($k=1;$k<count($cells);$k++)
    {
       echo "<td>".$cells[$k]."</td>";
    }
    // for k end
    echo "</tr>";
}
// for i end
echo "</table></body></html>";
?>

</body>
</html>
