<?php

require "required.php";

// create file if not exists
if(!file_exists(Paths::json)){
    $f = fopen(Paths::json, 'w');
    fclose($f);
}

// get contents
$json = file_get_contents(Paths::json);
$orders = [];

// create first order if there's nothing
if($json === "" || $json === "[]"){
    $orders[] = new Order();
    $data = new Data(0,$orders);
    file_put_contents(Paths::json,json_encode($data));
    print json_encode($data);
    exit(0);
}

// add new order with the next available number
$data = json_decode($json);
$data->orders[] = new Order($data->lastOrder);
$data->lastOrder = ($data->lastOrder + 1) % Order::limit;

// write to file
file_put_contents(Paths::json,json_encode($data));
?>