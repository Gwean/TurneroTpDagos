<?php

require "required.php";

// create file if not exists
if(!file_exists(Paths::json)){
    $f = fopen(Paths::json, 'w');
    fclose($f);
}

$ordinal = $_POST['ordinal'];

// get contents
$json = file_get_contents(Paths::json);
$orders = [];

// add new order with the next available number
if ($json !== ""){
  $orders = json_decode($json);
}
$orders[] = new Order($ordinal);

// write to file
file_put_contents(Paths::json,json_encode($orders));
?>
