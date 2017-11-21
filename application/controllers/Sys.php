<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url');
                $this->load->library('session');
                $this->load->model('Materias_model');
                $this->load->model('Horario_model');
                $this->load->model('Nrc_model');
                
                if(!$this->session->has_userdata('horario')) {
                    $this->session->set_userdata('horario', $this->Horario_model->get());
                    $this->session->set_userdata('creditos', 0);
                    $this->session->set_userdata(
                            'materias_habilitadas', $this->Materias_model->get_materias_habilitadas()
                    );
                }
        }
    

	public function index()
	{
                $data = new stdClass();
                $data->materias = $this->Materias_model->get();
                $data->horario = $this->session->horario;
                $data->creditos = $this->session->creditos;
                $data->materias_habilitadas = $this->session->materias_habilitadas;
                
                if($data->creditos <= 0) {
                    $data->disabled_btn = 'disabled';
                } else {
                    $data->disabled_btn = null;
                }
                
                $data->creditos = $this->session->creditos;
                            
		$this->load->view('overall/head');
		$this->load->view('overall/header');
                $this->load->view('home/content', $data);
		$this->load->view('overall/footer');
	}
        
        public function materia($id)
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
        
        public function eliminar() 
        {            
                $data = new stdClass();
                $data->horario = $this->session->horario;
            
                $this->load->view('overall/head');
		$this->load->view('overall/header');
                $this->load->view('eliminar/content', $data);
		$this->load->view('overall/footer');
        }
        
        public function eliminarNRC() 
        {        
                $nrc = $this->input->post('nrc');
                
                if($nrc) {
                    $bloques = $this->Nrc_model->get($nrc);
                    $horario = $this->session->horario;
                    $materias = $this->Materias_model->get();

                    foreach($materias as $materia) {
                        foreach($materia['secciones'] as $seccion) {
                            if($seccion['nrc'] == $nrc) {
                                $creditos = $materia['creditos']; 
                                $id = $materia['id'];
                                break 2;
                            }
                        }
                    }

                    foreach ($bloques as $bloque) {
                        $horario[$bloque[0]][$bloque[1]] = null;
                    }

                    $this->toggle_enabled($id);
                    $this->session->set_userdata('horario', $horario);
                    $this->session->set_userdata('creditos', $this->session->creditos - $creditos);
                }                
                
        }
        
        public function observaciones()
        {
                $data = new stdClass();
                $data->horario = $this->session->horario;
            
                $this->load->view('overall/head');
		$this->load->view('overall/header');
                $this->load->view('observaciones/content', $data);
		$this->load->view('overall/footer');
        }
        
        public function form_nrc()
        {
                $nrcs = array();
                for($i = 1; $i < 11; $i++)
                    $nrcs[] = $this->input->post('nrc-' . $i);
                
                $nrcs = array_unique($nrcs);
                
                $bloques = $this->Nrc_model->get_all();
                $horario = $this->session->horario;
                $materias = $this->Materias_model->get();
                $creditos = 0;
                $todo_bien = true;
                
                foreach($nrcs as $nrc) 
                {
                    if(!isset($nrc))
                        continue;
                    
                    foreach($materias as $materia) {
                        foreach($materia['secciones'] as $seccion) {
                            if($seccion['nrc'] == $nrc) {
                                $nombre = $materia['materia'];
                                $creditos = $materia['creditos'];                                
                                $id = $materia['id'];
                                break 2;
                            }
                        }
                    }
                    
                    if(!isset($nombre))
                        continue;
                    
                    if(!$this->session->materias_habilitadas[$id])
                        $todo_bien = false;
                    
                    $span = '<span data-nrc="' . $nrc . '">' . $nombre . '</span>';

                    foreach ($bloques[$nrc] as $bloque) {
                        if(!isset($horario[$bloque[0]][$bloque[1]])) {
                            $horario[$bloque[0]][$bloque[1]] = $span;
                        } else {
                            //Alerta de error
                            $todo_bien = false;
                        }
                    }
                    
                    if($todo_bien) {
                        $this->toggle_enabled($id);
                        $this->session->set_userdata('creditos', $this->session->creditos + $creditos);
                        $this->session->set_userdata('horario', $horario);
                    } else {
                        $horario = $this->session->horario;
                        $creditos = 0;
                        $todo_bien = true;                       
                    }
                    
                    unset($nombre, $id);
                    
                }
                
                $this->index();
        }


        public function fin() 
        {            
                $this->load->view('overall/head');
		$this->load->view('overall/header');
                $this->load->view('fin/content');
		$this->load->view('overall/footer');
        }
        
        public function salir()
        {
            $this->session->unset_userdata('horario');
            $this->session->unset_userdata('creditos', 0);
            $this->session->unset_userdata('materias_habilitadas');
            $this->session->set_userdata('horario', $this->Horario_model->get());
            $this->session->set_userdata('creditos', 0);
            $this->session->set_userdata('materias_habilitadas', $this->Materias_model->get_materias_habilitadas());

            $this->load->view('overall/head');
            $this->load->view('overall/header');
            $this->load->view('overall/footer');
        }
        
        public function toggle_enabled($id) {
            
            $materias = $this->session->materias_habilitadas;
            
            if($materias[$id]) {
                $materias[$id] = false;
            } else {
                $materias[$id] = true;
            }
            
            $this->session->set_userdata('materias_habilitadas', $materias);
            
        }
}