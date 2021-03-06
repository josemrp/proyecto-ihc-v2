<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materia_model');
    }

    /*
     * Carga la pagina principal
     */

    public function index()
    {
        $data = new stdClass();
        $data->materias = $this->Materia_model->get_all();
        $data->horario = $this->session->horario;

        $this->template('home/content', $data);
    }

    /*
     * Muestra la ventana de eliminacion de materias
     */

    public function eliminar()
    {
        $data = new stdClass();
        $data->horario = $this->session->horario;

        $this->load->view('overall/head');
        $this->load->view('overall/header');
        $this->load->view('eliminar/content', $data);
        $this->load->view('overall/footer');
    }

    /*
     * Elimina una materia del horario
     */

    public function eliminarNRC()
    {
        $nrc = $this->input->post('nrc');

        if ($nrc)
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
                        $creditos = $materia['creditos'];
                        $id = $materia['id'];
                        break 2;
                    }
                }
            }

            foreach ($bloques as $bloque)
            {
                $horario[$bloque[0]][$bloque[1]] = null;
            }

            $this->toggle_enabled($id);
            $this->session->set_userdata('horario', $horario);
            $this->session->set_userdata('creditos', $this->session->creditos - $creditos);
        }
    }

    /*
     * Muestra el panel de observaciones
     */

    public function observaciones()
    {
        $data = new stdClass();
        $data->horario = $this->session->horario;

        $this->load->view('overall/head');
        $this->load->view('overall/header');
        $this->load->view('observaciones/content', $data);
        $this->load->view('overall/footer');
    }

    /*
     * Formulario para inscripcion de materias por NRC en las cajas de texto
     */

    public function form_nrc()
    {
        $nrcs = array();
        for ($i = 1; $i < 11; $i++)
            $nrcs[] = $this->input->post('nrc-' . $i);

        $nrcs = array_unique($nrcs);

        $bloques = $this->Nrc_model->get_all();
        $horario = $this->session->horario;
        $materias = $this->Materias_model->get();
        $creditos = 0;
        $todo_bien = true;

        foreach ($nrcs as $nrc)
        {
            if (!isset($nrc))
                continue;

            foreach ($materias as $materia)
            {
                foreach ($materia['secciones'] as $seccion)
                {
                    if ($seccion['nrc'] == $nrc)
                    {
                        $nombre = $materia['materia'];
                        $creditos = $materia['creditos'];
                        $id = $materia['id'];
                        break 2;
                    }
                }
            }

            if (!isset($nombre))
                continue;

            if (!$this->session->materias_habilitadas[$id])
                $todo_bien = false;

            $span = '<span data-nrc="' . $nrc . '">' . $nombre . '</span>';

            foreach ($bloques[$nrc] as $bloque)
            {
                if (!isset($horario[$bloque[0]][$bloque[1]]))
                {
                    $horario[$bloque[0]][$bloque[1]] = $span;
                }
                else
                {
                    //Alerta de error
                    $todo_bien = false;
                }
            }

            if ($todo_bien)
            {
                $this->toggle_enabled($id);
                $this->session->set_userdata('creditos', $this->session->creditos + $creditos);
                $this->session->set_userdata('horario', $horario);
            }
            else
            {
                $horario = $this->session->horario;
                $creditos = 0;
                $todo_bien = true;
            }

            unset($nombre, $id);
        }

        $this->index();
    }

    /*
     * Muestra la ultima presentacion
     */

    public function fin()
    {
        $this->load->view('overall/head');
        $this->load->view('overall/header');
        $this->load->view('fin/content');
        $this->load->view('overall/footer');
    }

    /*
     * Borra la sesion, con ello el horario que llevaba 
     */

    public function salir()
    {
        $this->session->unset_userdata('horario');
        $this->session->unset_userdata('creditos');
        $this->session->unset_userdata('secciones');

        echo 'Sesiones eliminadas';
    }

    /*
     * Habilitar materias
     */

    public function toggle_enabled($id)
    {

        $materias = $this->session->materias_habilitadas;

        if ($materias[$id])
        {
            $materias[$id] = false;
        }
        else
        {
            $materias[$id] = true;
        }

        $this->session->set_userdata('materias_habilitadas', $materias);
    }

}
