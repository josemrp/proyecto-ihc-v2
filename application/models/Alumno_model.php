<?php

class Alumno_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Retorna todos los alumnos
     */

    public function get_all()
    {
        $this->db->select('id, nombre, email, ci, comentario');
        $this->db->from('alumno');
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Retorna los datos de un alumno
     */

    public function get($id)
    {
        $this->db->select('id, nombre, email, ci, comentario');
        $this->db->from('alumno');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return isset($result[0]) ? $result[0] : null;
    }

    /*
     * Retorna los datos de un alumno y lo busca por su cedula
     */

    public function get_where_ci($ci)
    {
        $this->db->select('id, nombre, email, ci, comentario');
        $this->db->from('alumno');
        $this->db->where('ci', $ci);
        $query = $this->db->get();
        $result = $query->result();
        return isset($result[0]) ? $result[0] : null;
    }

    /*
     * Agrega un alumno
     * Cuando un alumno se inscribe empieza a formar parte del sistema
     * @alumno      object 
     * return       id
     */

    public function insert($alumno)
    {
        $alumno->id = NULL;
        if ($this->verify_ci($alumno->ci))
        {
            $this->db->insert('alumno', $alumno);
            return $this->db->insert_id();
        }
        return false;
    }

    /*
     * Verifica repeticiones de la cedula
     */

    public function verify_ci($ci)
    {
        return is_null($this->get_where_ci($ci));
    }

    /*
     * Inscribe las materias seleccionadas por el alumno
     * Nota: verificar que exista el alumno y las secciones
     */

    public function inscribir($alumno_id)
    {
        $this->load->library('session');
        $secciones = $this->session->secciones;
        $data = array();
        foreach ($secciones as $seccion)
        {
            $data[] = array(
                'alumno_id' => $alumno_id,
                'seccion_nrc' => $seccion
            );
        }
        $this->db->insert_batch('rel_seccion_alumno', $data);
        
        return $this->db->affected_rows();
    }

}
