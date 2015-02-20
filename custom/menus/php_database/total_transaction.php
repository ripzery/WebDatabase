<?php

require_once('../../includes/config.inc.php');


$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
mysqli_select_db($link, DB_DATABASE) or die("could not find db.");

$max_q = "SELECT MAX(transno) AS max FROM cardstatement";
$max_transno = mysqli_query($link, $max_q) or die("Data not found");
$maxx = mysqli_fetch_array($max_transno);
$max = $maxx['max'];

echo $max;
