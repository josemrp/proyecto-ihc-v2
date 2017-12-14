<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Materias_model');
        $this->load->model('Horario_model');
        $this->load->model('Nrc_model');

        if (!$this->session->has_userdata('horario'))
        {
            $this->session->set_userdata('horario', $this->Horario_model->get());
            $this->session->set_userdata('creditos', 0);
            $this->session->set_userdata(
                    'materias_habilitadas', $this->Materias_model->get_materias_habilitadas()
            );
        }
    }

    /*
     * Muestra las secciones de una materia seleccionada
     */
    public function index($id)
        {            
                $data = new stdClass();
                $materias = $this->Materias_model->get();
                $horario = $this->session->horario;
                $NRCs = $this->Nrc_model->get_all();
                
                foreach ($materias as $materia) {
                    if($materia['id'] == $id) {
                        $data->title = $materia['materia'];
                        $secciones = $materia['secciones'];
                        break;
                    }
                }
                
                $data->secciones = array();
                
                foreach ($secciones as $seccion) {
                    //Verificar que hayan cupos
                    if($seccion['cupos'] > 0) {
                        foreach ($NRCs[$seccion['nrc']] as $bloque) {
                            //Verificar que no choque el horario
                            if(isset($horario[$bloque[0]][$bloque[1]])) {
                                continue 2;
                            }
                        }
                        $data->secciones[] = $seccion;
                    }
                }
            
                $this->load->view('overall/head');
		$this->load->view('overall/header');
                $this->load->view('materia/content', $data);
		$this->load->view('overall/footer');
        }
        
        /*
         * Agrega una seccion al horario
         */
        public function inscribir()
        {
                $nrc = $this->input->post('nrc');
                
                if(isset($nrc)) 
                {
                    
                    $bloques = $this->Nrc_model->get($nrc);
                    $horario = $this->session->horario;
                    $materias = $this->Materias_model->get();

                    foreach($materias as $materia) {
                        foreach($materia['secciones'] as $seccion) {
                            if($seccion['nrc'] == $nrc) {
                                $nombre = $materia['materia'];
                                $id = $materia['id'];
                                $creditos = $materia['creditos'];
                                break 2;
                            }
                        }
                    }            

                    $span = '<span data-nrc="' . $nrc . '">' . $nombre . '</span>';

                    foreach ($bloques as $bloque) {
                        if(!isset($horario[$bloque[0]][$bloque[1]])) {
                            $horario[$bloque[0]][$bloque[1]] = $span;
                        }
                    }

                    $this->toggle_enabled($id);
                    $this->session->set_userdata('horario', $horario);
                    $this->session->set_userdata('creditos', $this->session->creditos + $creditos);

                }

                $this->index();               
                
        }

}
