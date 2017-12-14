<?php

class Materia2_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Retorna todas las materias
     */

    public function get_all()
    {
        $this->db->select('id, nombre');
        $this->db->from('materia');
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Retorna una sola materia
     */

    public function get($id)
    {
        $this->db->select('id, nombre');
        $this->db->from('materia');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return isset($result[0]) ? $result[0] : null;
    }

}
