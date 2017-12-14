<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Materias_model');
        $this->load->model('Horario_model');
        $this->load->model('Nrc_model');
    }

    public function index($param)
    {
        $this->session->set_userdata('secciones', array(25));        
        $this->load->model('Alumno_model');
        $D = $this->Alumno_model->inscribir($param);
        var_dump($D);
    }
    
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
        $D = $this->Seccion_model->aumentar_cupo(2);
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
