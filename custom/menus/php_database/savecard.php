<?php
	require_once('../../includes/config.inc.php');

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
    mysqli_select_db($link, DB_DATABASE)  or die("could not find db.");

    $sellno = $_POST['sellerno'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $transno = $_POST['transno'];

    $sql = "UPDATE cardstatement SET sellerno = '$sellno' , product= '$product', price = '$price' WHERE transno=$transno";

    if (mysqli_query($link, $sql)) {
    echo "Save record successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    mysqli_close($link);

