<?php

require "required.php";

// create file if not exists
if(!file_exists(Paths::json)){
    $file = Paths::json;
    throw new Exception("There is no $file file", 2);
}

// input (change to POST)
$change = (int)fgets(STDIN);

// get contents
$json = file_get_contents(Paths::json);
$orders = [];

// no orders
if($json === "" || $json === "[]"){
    throw new Exception("There is no order number $change", 3);
}

// find order and change state, kill if necessary
$data = json_decode($json);
$found = false;
foreach ($data->orders as $key => $order) {
    if($order->ordinal == $change){
        // change state
        $order->state = States::next($order->state);
        // kill order
        if($order->state === States::entregado){
            array_splice($data->orders,$key,1);
        }
        $found = true;
        break;
    }
}

// order not found
if(!$found){
    throw new Exception("There is no order number $change", 3);
}

// write to file
file_put_contents(Paths::json,json_encode($data));

?>