<?php

class Horario_model extends CI_Model {

        private $horario = array(
            array(
                '7:00', null, null, null, null, null, null
            ),
            array(
                '8:00', null, null, null, null, null, null
            ),
            array(
                '9:00', null, null, null, null, null, null
            ),
            array(
                '10:00', null, null, null, null, null, null
            ),
            array(
                '11:00', null, null, null, null, null, null
            ),
            array(
                '12:00', null, null, null, null, null, null
            ),
            array(
                '13:00', null, null, null, null, null, null
            ),
            array(
                '14:00', null, null, null, null, null, null
            ),
            array(
                '15:00', null, null, null, null, null, null
            ),
            array(
                '16:00', null, null, null, null, null, null
            ),
            array(
                '17:00', null, null, null, null, null, null
            ),
            array(
                '18:00', null, null, null, null, null, null
            ),
            array(
                '19:00', null, null, null, null, null, null
            ),
            array(
                '20:00', null, null, null, null, null, null
            ),
        );
        
        public function get() {
            return $this->horario;
        }

}
