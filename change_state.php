<?php

require "required.php";

// Exception if file does not exist
if(!file_exists(Paths::json)){
    $file = Paths::json;
    throw new Exception("There is no $file file", 2);
}

$ordinal = (int)$_POST['ordinal'];
$state = (int)$_POST['state'];

// get contents
$json = file_get_contents(Paths::json);

// no orders
if($json === "" || $json === "[]"){
    throw new Exception("There is no order number $ordinal", 3);
}

// find order and change state, kill if necessary
$orders = json_decode($json);
$found = false;
foreach ($orders as $key => $order) {
    if($order->ordinal === $ordinal){
        // change state
        $order->state = $state;
        // kill order
        if($order->state === States::entregado){
            array_splice($orders,$key,1);
        }
        $found = true;
        break;
    }
}

// order not found
if(!$found){
    throw new Exception("There is no order number $ordinal", 3);
}

// write to file
file_put_contents(Paths::json,json_encode($orders));

echo "true"
?>
