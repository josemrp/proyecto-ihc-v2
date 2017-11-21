<?php

class Materias_model extends CI_Model {

        private $materias = array(
            array(
                'materia' => 'Calculo II',
                'id' => 'calculo-ii',
                'creditos' => 9,
                'enabled' => true,
                'secciones' => array(
                    array(
                        'nrc' => '001',
                        'profesor' => 'Juan Perez',
                        'numero_seccion' => 1,
                        'cupos' => 8,
                        'horario_string' => 'Lunes: 9am a 11am / Miércoles: 9am a 11am / Viernes: 9am a 10am',
                    ),
                    array(
                        'nrc' => '002',
                        'profesor' => 'Ana C. Onda',
                        'numero_seccion' => 2,
                        'cupos' => 4,
                        'horario_string' => 'Lunes: 7am a 9am / Jueves: 9am a 10am / Viernes: 7am a 9am',
                    ),
                    array(
                        'nrc' => '003',
                        'profesor' => 'Rafael Guevara',
                        'numero_seccion' => 3,
                        'cupos' => 11,
                        'horario_string' => 'Martes: 2pm a 4pm / Miercoles: 2pm a 4pm / Viernes: 12m a 1pm',
                    ),
                    array(
                        'nrc' => '004',
                        'profesor' => 'Andres Valero',
                        'numero_seccion' => 4,
                        'cupos' => 1,
                        'horario_string' => 'Martes: 10am a 12m / Miercoles: 2pm a 3pm / Jueves: 11am a 12m',
                    ),
                ),
            ),
            array(
                'materia' => 'Circuitos Electronicos',
                'id' => 'circuitos-electronicos',
                'creditos' => 9,
                'enabled' => true,
                'secciones' => array(
                    array(
                        'nrc' => '011',
                        'profesor' => 'Alan Costoya',
                        'numero_seccion' => 1,
                        'cupos' => 6,
                        'horario_string' => 'Martes: 7am a 9am / Miércoles: 7am a 9am',
                    ),
                    array(
                        'nrc' => '012',
                        'profesor' => 'Rebeca Turing',
                        'numero_seccion' => 2,
                        'cupos' => 2,
                        'horario_string' => 'Lunes: 4pm a 6pm / Jueves: 4pm a 6pm',
                    ),
                ),
            ),
            array(
                'materia' => 'Sistemas Operativos',
                'id' => 'sistemas-operativos', 
                'creditos' => 5,
                'enabled' => true,
                'secciones' => array(
                    array(
                        'nrc' => '021',
                        'profesor' => 'Mack Simpsom',
                        'numero_seccion' => 1,
                        'cupos' => 3,
                        'horario_string' => 'Miercoles: 7am a 9am / Jueves: 7am a 9am',
                    ),
                    array(
                        'nrc' => '022',
                        'profesor' => 'Robert Musk',
                        'numero_seccion' => 2,
                        'cupos' => 3,
                        'horario_string' => 'Lunes: 10am a 12m / Miercoles: 1pm a 3pm',
                    ),
                ),
            ),
            array(
                'materia' => 'Bases de Datos I',
                'id' => 'bases-datos-i',
                'creditos' => 5,
                'enabled' => true,
                'secciones' => array(
                    array(
                        'nrc' => '031',
                        'profesor' => 'Juliana Guedez',
                        'numero_seccion' => 1,
                        'cupos' => 7,
                        'horario_string' => 'Martes: 5pm a 7pm / Jueves: 5pm a 7pm',
                    ),
                    array(
                        'nrc' => '032',
                        'profesor' => 'Ricardo Herrera',
                        'numero_seccion' => 2,
                        'cupos' => 3,
                        'horario_string' => 'Miercoles: 1pm a 3pm / Viernes: 9am a 11am',
                    ),
                ),
            ),
            array(
                'materia' => 'Ecologia',
                'id' => 'ecologia',
                'creditos' => 2,
                'enabled' => true,
                'secciones' => array(
                    array(
                        'nrc' => '111',
                        'profesor' => 'Edgar Simancas',
                        'numero_seccion' => 1,
                        'cupos' => 7,
                        'horario_string' => 'Martes: 5pm a 7pm',
                    ),
                    array(
                        'nrc' => '112',
                        'profesor' => 'Juan Rodriguez',
                        'numero_seccion' => 2,
                        'cupos' => 6,
                        'horario_string' => 'Viernes: 9am a 11am',
                    ),
                    array(
                        'nrc' => '113',
                        'profesor' => 'Gustavo Ibarra',
                        'numero_seccion' => 3,
                        'cupos' => 8,
                        'horario_string' => 'Lunes: 8am a 10am',
                    ),
                    array(
                        'nrc' => '114',
                        'profesor' => 'Gledys Escobar',
                        'numero_seccion' => 4,
                        'cupos' => 5,
                        'horario_string' => 'Jueves: 3pm a 5pm',
                    ),
                    array(
                        'nrc' => '115',
                        'profesor' => 'Elba Camara',
                        'numero_seccion' => 5,
                        'cupos' => 7,
                        'horario_string' => 'Martes: 2pm a 4pm',
                    ),
                ),
            ),
        );
        
        private $materias_habilitdas = array(
            'calculo-ii' => true,
            'circuitos-electronicos' => true,
            'sistemas-operativos' => true, 
            'bases-datos-i' => true,
            'ecologia' => true
        );
        
        public function get() {
            return $this->materias;
        }
        
        public function get_materias_habilitadas() {
            return $this->materias_habilitdas;
        }

}