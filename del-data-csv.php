<?php

$myFile = "data.csv";
unlink($myFile) or die("Couldn't delete file");
$my_file = fopen("data.csv", "w");

$myFile = "data1.csv";
unlink($myFile) or die("Couldn't delete file");
$my_file = fopen("data1.csv", "w");

header('Location: index.php');
