<?php

class States {
    const preparacion = 0;
    const listo = 1;
    const entregado = 2;
}

class Paths{
    const json = "data.json";
}

class Order{

    const limit = 999;

    public $ordinal;
    public $state;

    /**
     * @param int $order
     */
    public function __construct(int $order){
        $this->ordinal = $order;
        $this->state = 0;
    }
    
    /**
     * @param int $state
     */
    private function validate(int $state){
        if ($state < 0){
          return 0;
        }
        if ($state > 2){
          return 2;
        }
        return $state;
    } 
    
}

?>
