<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('horario'))
        {
            $this->inicializar_session();
        }
    }

    /*
     * Carga el template generico de la pagina
     * 
     * @param   string  $view       directory of the view
     * @param   obj     $data       some data
     * @return  void
     */

    public function template($view, $data)
    {
        $this->load->view('overall/head');
        $this->load->view('overall/header');
        $this->load->view($view, $data);
        $this->load->view('overall/footer');
    }

    /*
     * Crea las variables de sesion del usuario, en caso de que no existan
     */

    protected function inicializar_session()
    {
        //  horario     matriz con el horaio del alumno.
        //  creditos    numero de creditos inscritos
        //  secciones   arreglo de secciones inscritas
        $user_data = array(
            'horario' => $this->horario->inicializar_horario(),
            'creditos' => 0,
            'secciones' => array(),
                //'materias_habilitadas', $this->Materias_model->get_materias_habilitadas(),
        );

        $this->session->set_userdata($user_data);
    }

}
