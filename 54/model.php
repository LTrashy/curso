<?php

    include_once 'db.php';

    class Model extends DB{
        function getAll(){
            $alumnos = array();
            $alumnos['items'] = array();

            $query= $this->connect()->query('SELECT * FROM alumnos');

            while($row = $query->fetch()){
                array_push($alumnos['items'],array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre']
                ));
            }
            return $alumnos;
        }
    }