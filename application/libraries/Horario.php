<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Horario
{

    protected $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
    }
    
    /*
     * Crea la matriz del horario del alumno
     * @return       Array Horario
     */
    public function inicializar_horario()
    {
        $dias = array(
            'Lunes' => null,
            'Martes' => null,
            'Miercoles' => null,
            'Jueves' => null,
            'Viernes' => null,
            'Sabado' => null,
        );
        $horario = array();
        for($hora = 7; $hora <= 20; $hora++)
        {
            $horario[$hora] = $dias;
        }
        return $horario;
    }

}
