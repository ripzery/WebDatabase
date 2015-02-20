<?php

    require_once('../../includes/config.inc.php');

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
    mysqli_select_db($link, DB_DATABASE)  or die("could not find db.");

    $sellno = $_POST['sellerno'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $transno = $_POST['transno'];
    $cardno = $_POST['cardno'];
    $userid = $_POST['userid'];
    $date = $_POST['date'];

    $sql = "INSERT INTO cardstatement (transno, uid, number, date, sellerno, product, price) VALUES('$transno','$userid','$cardno','$date','$sellno','$product', '$price')";

    if (mysqli_query($link, $sql)) {
    echo "Save record successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    mysqli_close($link);
