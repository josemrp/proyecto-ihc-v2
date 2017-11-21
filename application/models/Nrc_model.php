<?php

class Nrc_model extends CI_Model {
    
    private $NRCs = array(
        //Calculo
        '001' =>  array(
            array(2, 1),
            array(3, 1),
            array(2, 3),
            array(3, 3),
            array(2, 5),
        ),
        '002' =>  array(
            array(0, 1),
            array(1, 1),
            array(2, 4),
            array(0, 5),
            array(1, 5),
        ),
        '003' =>  array(
            array(7, 2),
            array(8, 2),
            array(7, 3),
            array(8, 3),
            array(5, 5),
        ),
        '004' =>  array(
            array(3, 2),
            array(4, 2),
            array(7, 3),
            array(8, 3),
            array(4, 4),
        ),
        //Circuitos
        '011' =>  array(
            array(0, 2),
            array(1, 2),
            array(0, 3),
            array(1, 3),
        ),
        '012' =>  array(
            array(9, 1),
            array(10, 1),
            array(9, 4),
            array(10, 4),
        ),
        //Sistemsa Operativos
        '021' =>  array(
            array(0, 3),
            array(1, 3),
            array(0, 4),
            array(1, 4),
        ),
        '022' =>  array(
            array(3, 1),
            array(4, 1),
            array(6, 3),
            array(7, 3),
        ),
        //Bases de datos
        '031' =>  array(
            array(10, 3),
            array(11, 3),
            array(10, 4),
            array(11, 4),
        ),
        '032' =>  array(
            array(6, 3),
            array(7, 3),
            array(2, 5),
            array(3, 5),
        ),
        //Ecologia
        '111' =>  array(
            array(10, 2),
            array(11, 2),
        ),
        '112' =>  array(
            array(2, 5),
            array(3, 5),
        ),
        '113' =>  array(
            array(2, 1),
            array(3, 1),
        ),
        '114' =>  array(
            array(8, 4),
            array(9, 4),
        ),
        '115' =>  array(
            array(7, 2),
            array(8, 2),
        ),
    );
    
    public function get_all()
    {
        return $this->NRCs;
    }
    
    public function get($nrc)
    {
        return $this->NRCs[$nrc];
    }
}

