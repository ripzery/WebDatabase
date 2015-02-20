<?php

require_once('../../includes/config.inc.php');

session_start();
$userid = $_SESSION['uid'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
mysqli_select_db($link, DB_DATABASE) or die("could not find db.");

$query = $userid == 1 ? "SELECT * FROM cardstatement" : "SELECT * FROM cardstatement WHERE uid = $userid";
$result = mysqli_query($link, $query);

header('Content-Type: text/xml');

$dom = new DOMDocument();

$response = $dom->createElement('response');
$dom->appendChild($response);

$transactions = $dom->createElement('transactions');
$response->appendChild($transactions);

while ($row = mysqli_fetch_array($result)) {
//    $transaction = $transactions->addChild("$transaction");
//    $transaction->addChild("transno");
//    $transaction->addChild("uid");
//    $transaction->addChild("date");
//    $transaction->addChild("sellerno");
//    $transaction->addChild("product");
//    $transaction->addChild("price");
//    $transaction->addChild("number");
    $transno = $dom->createElement('transno');
    $transnoText = $dom->createTextNode($row['transno']);
    $transno->appendChild($transnoText);
    
    $uid = $dom->createElement('uid');
    $uidText = $dom->createTextNode($row['uid']);
    $uid->appendChild($uidText);
    
    $date = $dom->createElement('date');
    $dateText = $dom->createTextNode($row['date']);
    $date->appendChild($dateText);
    
    $sellerno = $dom->createElement('sellerno');
    $sellernoText = $dom->createTextNode($row['sellerno']);
    $sellerno->appendChild($sellernoText);
    
    $product = $dom->createElement('product');
    $productText = $dom->createTextNode($row['product']);
    $product->appendChild($productText);
    
    $price = $dom->createElement('price');
    $priceText = $dom->createTextNode($row['price']);
    $price->appendChild($priceText);
    
    $number = $dom->createElement('number');
    $numberText = $dom->createTextNode($row['number']);
    $number->appendChild($numberText);
    
    $transaction = $dom->createElement("transaction");
    $transaction->appendChild($transno);
    $transaction->appendChild($uid);
    $transaction->appendChild($date);
    $transaction->appendChild($sellerno);
    $transaction->appendChild($product);
    $transaction->appendChild($price);
    $transaction->appendChild($number);
    
    $transactions->appendChild($transaction);
}

$xmlString = $dom->saveXML();

$xmlString = ltrim(substr($xmlString, strpos($xmlString, '?'.'>')+2)); // removing <?xml

echo $xmlString;



