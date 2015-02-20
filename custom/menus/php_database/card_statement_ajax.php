<?php

require_once('../../includes/config.inc.php');

session_start();
$userid = $_SESSION['uid'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
mysqli_select_db($link, DB_DATABASE) or die("could not find db.");


//$max_q = "SELECT MAX(transno) AS max FROM cardstatement";
//$max_transno = mysqli_query($link, $max_q) or die("Data not found");
//$maxx = mysqli_fetch_array($max_transno);
//$max = $maxx['max'];
//
//
//    $min_q = "SELECT MIN(transno) AS min FROM cardstatement";
//    $min_transno = mysqli_query($link, $min_q) or die("Data not found");
//    $minn = mysqli_fetch_array($min_transno);
//    $min = $minn['min'];

$transno = filter_input(INPUT_POST, 'transno');
$isNext = filter_input(INPUT_POST, 'isNext');
if ($isNext != null) {
    if ($userid == 1) {
        $transno = $isNext == "true" ? $transno + 1 : $transno - 1;
        $query = "SELECT * FROM cardstatement WHERE transno = $transno";
    } else {
        $query = $isNext == "true" ? "SELECT * FROM cardstatement WHERE transno > $transno AND uid = $userid" : "SELECT * FROM cardstatement WHERE transno < $transno AND uid = $userid ORDER BY transno DESC";
    }
} else {
    $query = "SELECT * FROM cardstatement WHERE transno = $transno";
}


$result = mysqli_query($link, $query) or die("Data not found");

while ($row = mysqli_fetch_array($result)) {
    die(json_encode(array(
//        'max' => $max,
        'transno' => $row['transno'],
        'uid' => $row['uid'],
        'number' => $row['number'],
        'date' => $row['date'],
        'sellerno' => $row['sellerno'],
        'product' => $row['product'],
        'price' => $row['price']
    )));
}
    