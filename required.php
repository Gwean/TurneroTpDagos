<?php

class States {
    const preparacion = "En preparación";
    const listo = "Listo";
    const entregado = "Entregado";

    /**
     * Convert index of state to the state itself.
     * 
     * @param int $index
     * @return string The state.
     */
    public static function stateAt(int $index){
        switch ($index) {
            case 1:
                return States::preparacion;
                break;
            case 2:
                return States::listo;
                break;
            case 3:
                return States::entregado;
                break;
            default:
                throw new Exception("There is no state $index", 1);    
                break;
        }
    }

    /**
     * Returns next state.
     * 
     * Note: if the last state is provided, returns the same state.
     * 
     * @param string $state
     * @return string The state.
     */
    public static function next(string $state){
        switch ($state) {
            case States::preparacion:
                return States::listo;
                break;
            case States::listo:
                return States::entregado;
                break;
            case States::entregado:
                trigger_error("This order has already been delivered", E_USER_WARNING);
                return States::entregado;
                break;
            default:
                throw new Exception("There is no state $state", 1);    
                break;
        }
    }

    /**
     * Validates if a state exists. if not, returns empty string.
     * 
     * @param string $state
     * @return string Validated state or empty string.
     */
    public static function validate(string $state){
        if(States::preparacion == $state || States::listo == $state || States::entregado == $state){
            return $state;
        }
        return "";
    }
}

class Paths{
    const json = "data.json";
}

class Order{

    const limit = 999;

    public $ordinal;
    public $state;

    /**
     * @param int $incremental (optional) The order number in which it starts to count from.
     */
    public function __construct(int $last = null){
        $this->ordinal = $last === null ? 0 : ($last + 1) % Order::limit;
        $this->state = States::preparacion;
    }
}

class Data{
    public $lastOrder;
    public $orders;

    public function __construct(int $lastOrder, array $orders){
        $this->lastOrder = $lastOrder;
        $this->orders = $orders;
    }
}

?>