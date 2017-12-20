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
        for ($hora = 7; $hora <= 20; $hora++)
        {
            $horario[$hora] = $dias;
        }
        return $horario;
    }

    /*
     * Agrega una seccion al horario
     * 
     * @param       obj     $seccion
     * @param       array   $horario    formato de la BD
     * @return      bool                modifica session
     */

    public function agregar_seccion($seccion, $horas)
    {
        $horario = $this->CI->session->horario;

        foreach ($horas as $d)
        {
            if (isset($horario[$d->hora][$d->dia]))
            {
                //  Existe una materia en esa hora, por lo tanto
                //  no puede inscribir esta seccion.
                return FALSE;
            }
            $horario[$d->hora][$d->dia] = $seccion->materia;
        }

        $this->CI->session->set_userdata('horario', $horario);

        return TRUE;
    }

    /*
     * Eliminar una seccion del horario
     * 
     * @param       obj     $seccion
     * @return      bool                modifica session
     */

    public function eliminar_seccion($seccion)
    {
        
    }

    /*
     * Organiza un horario metiendo las horas dentro de los dias.
     * 
     * @param       Array       $horario    formato que devuelve DB
     * @return      Array                   con formato dia => horas
     */

    public function organize($horario)
    {
        $horario_organizado = array();
        foreach ($horario as $hora)
        {
            $horario_organizado[$hora->dia][] = $hora->hora;
        }
        return $horario_organizado;
    }

    /*
     * Convierte un horario organizado en formato string de una linea.
     * 
     * @param       Array       $horario_organizado 
     * @return      String
     */

    public function parse_to_string($horario_organizado)
    {
        $string = '';
        foreach ($horario_organizado as $dia => $horas)
        {
            $hora_i = $horas[0];
            $hora_f = $horas[0] + count($horas);

            $string .= $dia . ' de ' . $hora_i . ':00 a ' . $hora_f . ':00';
            if (end($horario_organizado) != $horas)
            {
                $string .= ' | ';
            }
        }
        return $string;
    }

}
