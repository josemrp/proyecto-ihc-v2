<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Materia_model');
        $this->load->model('Seccion_model');
        $this->load->model('Horario_model');
        $this->load->model('Nrc_model');

        if (!$this->session->has_userdata('horario'))
        {
            $this->session->set_userdata('horario', $this->Horario_model->get());
            $this->session->set_userdata('creditos', 0);
            //$this->session->set_userdata(
            //        'materias_habilitadas', $this->Materias_model->get_materias_habilitadas()
            //);
        }
    }

    /*
     * Muestra las secciones de una materia seleccionada
     */

    public function index($materia_id)
    {
        $data = new stdClass();
        $materia = $this->Materia_model->get($materia_id);
        $secciones = $this->Seccion_model->get_horarios($materia_id);
        $this->transform_horarios($secciones);

        $data->materia = $materia;
        $data->secciones = $secciones;

        $this->load->view('overall/head');
        $this->load->view('overall/header');
        $this->load->view('materia/content', $data);
        $this->load->view('overall/footer');
    }

    /*
     * Agrega una seccion al horario
     * Recibe de entrada POST
     */

    private function agregar()
    {
        $nrc = $this->input->post('nrc');

        if (isset($nrc))
        {

            $bloques = $this->Nrc_model->get($nrc);
            $horario = $this->session->horario;
            $materias = $this->Materias_model->get();

            foreach ($materias as $materia)
            {
                foreach ($materia['secciones'] as $seccion)
                {
                    if ($seccion['nrc'] == $nrc)
                    {
                        $nombre = $materia['materia'];
                        $id = $materia['id'];
                        $creditos = $materia['creditos'];
                        break 2;
                    }
                }
            }

            $span = '<span data-nrc="' . $nrc . '">' . $nombre . '</span>';

            foreach ($bloques as $bloque)
            {
                if (!isset($horario[$bloque[0]][$bloque[1]]))
                {
                    $horario[$bloque[0]][$bloque[1]] = $span;
                }
            }

            $this->toggle_enabled($id);
            $this->session->set_userdata('horario', $horario);
            $this->session->set_userdata('creditos', $this->session->creditos + $creditos);
        }

        $this->index();
    }
    
    /*
     * Organiza un horario metiendo las horas dentro de los dias
     * @horario     Array       formato que devuelve DB
     * return       Array       formato dia => horas
     */
    private function organizar_horario($horario)
    {
        $horario_organizado = array();
        foreach ($horario as $hora)
        {
            $horario_organizado[$hora->dia][] = $hora->hora;
        }
        return $horario_organizado;
    }
    
    /*
     * Convierte un horario organizado en formato string de una linea
     * @$horario_organizado     Array
     * return                   String
     */
    
    private function horario_2_string($horario_organizado)
    {
        $string = '';
        foreach ($horario_organizado as $dia => $horas)
        {
            $hora_i = $horas[0];
            $hora_f = $horas[0] + count($horas);
            
            $string .= $dia . ' de ' . $hora_i . ':00 a ' . $hora_f . ':00';
            if(end($horario_organizado) != $horas)
            {
                $string .= ' | ';
            }
        }
        return $string;
    }
    
    /*
     * Trabaja sobre la variable de secciones y transforma sus horarios internos
     * @secciones       Array(obj)
     * retorun          void
     */
    private function transform_horarios(&$secciones)
    {
        foreach ($secciones as &$seccion)
        {
            $horario_org = $this->organizar_horario($seccion->horario);
            $seccion->horario = $this->horario_2_string($horario_org);
        }
    }

}
