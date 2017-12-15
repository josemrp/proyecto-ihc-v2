<?php

class Seccion_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Retorna todas las secciones
     */

    public function get_all()
    {
        $this->db->select('seccion.nrc, seccion.cupos');
        $this->db->select('profesor.nombre AS profesor, materia.nombre AS materia');
        $this->db->from('seccion');
        $this->db->join('profesor', 'profesor.id = seccion.profesor_id');
        $this->db->join('materia', 'materia.id = seccion.materia_id ');
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Retorna todas las secciones de una materia
     */

    public function get_where_materia($materia_id)
    {
        $this->db->select('seccion.nrc, seccion.cupos');
        $this->db->select('profesor.nombre AS profesor');
        $this->db->from('seccion');
        $this->db->join('profesor', 'profesor.id = seccion.profesor_id');
        $this->db->join('materia', 'materia.id = seccion.materia_id ');
        $this->db->where('materia.id', $materia_id);
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Retorna una sola seccion
     */

    public function get($nrc)
    {
        $this->db->select('seccion.nrc, seccion.cupos');
        $this->db->select('profesor.nombre AS profesor, materia.nombre AS materia');
        $this->db->from('seccion');
        $this->db->join('profesor', 'profesor.id = seccion.profesor_id');
        $this->db->join('materia', 'materia.id = seccion.materia_id ');
        $this->db->where('seccion.nrc', $nrc);
        $query = $this->db->get();
        $result = $query->result();
        return isset($result[0]) ? $result[0] : null;
    }

    /*
     * Retorna el horario de una seccion
     */

    public function get_horario_where_seccion($seccion_nrc)
    {
        $this->db->select('hora.dia, hora.hora');
        $this->db->from('rel_horario_seccion');
        $this->db->join('hora', 'hora.id = rel_horario_seccion.hora_id');
        $this->db->where('rel_horario_seccion.seccion_nrc', $seccion_nrc);
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Retrona todos los horarios de todas las secciones de una materia
     * METODO 1, acceso recurrente a la base de datos sin valores duplicados
     */

    public function get_horarios($materia_id)
    {
        $secciones = $this->get_where_materia($materia_id);
        foreach ($secciones as &$seccion)
        {
            $seccion->horario = $this->get_horario_where_seccion($seccion->nrc);
        }
        return $secciones;
    }

    /*
     * Retrona todos los horarios de todas las secciones de una materia
     * METODO 2, acceso unico a la base de datos con valores duplicados
     */

    public function get_horarios_2($materia_id)
    {
        $this->db->select('seccion.nrc, seccion.cupos, hora.dia, hora.hora');
        $this->db->select('profesor.nombre AS profesor, materia.nombre AS materia');
        $this->db->from('rel_horario_seccion');
        $this->db->join('seccion', 'seccion.nrc = rel_horario_seccion.seccion_nrc');
        $this->db->join('hora', 'hora.id = rel_horario_seccion.hora_id');
        $this->db->join('profesor', 'profesor.id = seccion.profesor_id');
        $this->db->join('materia', 'materia.id = seccion.materia_id ');
        $this->db->where('materia.id', $materia_id);
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Disminuye un cupo, por SQL
     * Usado al agregar una materia por el usuario
     */

    public function disminuir_cupo($seccion_nrc)
    {
        //FALSE para que lo tome como operacion y no como string
        $this->db->set('seccion.cupos', 'seccion.cupos-1', FALSE);
        $this->db->where('seccion.nrc', $seccion_nrc);
        $this->db->where('seccion.cupos >', 0);
        $this->db->update('seccion');
        return $this->db->affected_rows();
    }

    /*
     * Disminuye un cupo, por SQL
     * Usado al quitar una materia por el usuario
     */

    public function aumentar_cupo($seccion_nrc)
    {
        //FALSE para que lo tome como operacion y no como string
        $this->db->set('seccion.cupos', 'seccion.cupos+1', FALSE);
        $this->db->where('seccion.nrc', $seccion_nrc);
        $this->db->update('seccion');
        return $this->db->affected_rows();
    }

}
