<?php
    class nuevoModel extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function insert($data){
            
            try{
            $query = $this->db->connect()->prepare('INSERT INTO alumnos (matricula,nombre,apellido)               VALUES(:matricula, :nombre, :apellido) ');

            $query->execute(['matricula' => $data['matricula'],
                                'nombre' => $data['nombre'],
                              'apellido' => $data['apellido']]);
            return true;
            }catch(PDOException $e){
                //echo $e->getMessage();
                //echo "Matricula ya existe";
                return false;
            }
        }
    }