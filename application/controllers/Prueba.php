<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materia_model');
        $this->load->model('Seccion_model');
    }

    public function index($param = 1)
    {     
        
    }
    
    
    /*
     * Probar al final con base de datos llena
     */
    public function depurador_de_horarios()
    {
        $mem_ini = memory_get_usage();
        $inicio = date("s") + explode(' ', microtime())[0];
        echo $inicio;
        echo '<br>';

        /*
         * Funcion
         */
        $this->load->model('Seccion_model');
        $D = $this->Seccion_model->get_horarios_1(1);
        var_dump($D);
        /*
         * Fin
         */

        echo '<br>';
        $fin = date("s") + explode(' ', microtime())[0];
        $mem_fin = memory_get_usage();
        echo $fin;

        echo '<br><br>';
        echo 'tiempo transcurrido: ';
        echo $fin - $inicio;
        echo '<br>';
        echo 'memoria ocupada: ' . ($mem_fin - $mem_ini);
    }

}
