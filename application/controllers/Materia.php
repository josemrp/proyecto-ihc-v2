<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materia extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materia_model');
        $this->load->model('Seccion_model');
    }

    /*
     * Muestra las secciones de una materia seleccionada
     * 
     * @param       int     $materia_id
     * @return      void
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

    public function agregar()
    {
        $nrc = $this->input->post('nrc');

        if (isset($nrc))
        {
            $seccion = $this->Seccion_model->get($nrc);
            $horario = $this->Seccion_model->get_horario_where_seccion($nrc);

            $seccess = $this->horario->agregar_seccion($seccion, $horario);

            if ($seccess)
            {
                $this->Seccion_model->disminuir_cupo($nrc);

                //  Agrega un nrc al array de secciones
                $secciones = $this->session->secciones;
                $secciones[] = $seccion->nrc;
                $this->session->set_userdata('secciones', $secciones);

                //  Suma los creditos en creditos
                $creditos = $this->session->creditos;
                $creditos += $seccion->creditos;
                $this->session->set_userdata('creditos', $creditos);
            }
        }

        redirect(site_url());
    }

    /*
     * Trabaja sobre la variable de secciones y transforma sus horarios internos.
     * 
     * @param       Array(obj)      $secciones  
     * @return      void        
     */

    private function transform_horarios(&$secciones)
    {
        foreach ($secciones as &$seccion)
        {
            $horario_org = $this->horario->organize($seccion->horario);
            $seccion->horario = $this->horario->parse_to_string($horario_org);
        }
    }

}
