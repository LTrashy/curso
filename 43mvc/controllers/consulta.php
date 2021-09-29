<?php

    class Consulta extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->alumnos = [];
            //echo "<p> Nuevo controller main</p>";
            
            
        }
        
        function render(){
            $alumnos = $this->model->get();
            $this->view->alumnos = $alumnos;
            $this->view->render('consulta/index');

        }

        function verAlumno($param = null){
            $idAlumno=$param[0];
            $alumno =$this->model->getById($idAlumno);

            session_start();
            $_SESSION['id_verAlumno'] = $alumno->matricula;
            $this->view->alumno = $alumno;
            $this->view->mensaje ="";
            $this->view->render('consulta/detalle');
        }

        function actualizarAlumno(){
            session_start();
            $matricula = $_SESSION['id_verAlumno'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            unset($_SESSION['id_verAlumno']);


            if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido])){
                //actualizar alumno
                $alumno = new Alumno();
                $alumno->matricula = $matricula;
                $alumno->nombre = $nombre;
                $alumno->apellido = $apellido;

                $this->view->alumno = $alumno;
                $this->view->mensaje ="Alumno actualizado con exito";
            }else{
                $this->view->mensaje ="Alumno no se pudo Actualizar";
                
            }
            $this->view->render('consulta/detalle');
        }

        function eliminarAlumno($param = null){
            $matricula = $param[0];
            if($this->model->delete($matricula)){
                $this->view->mensaje ="Alumno Eliminado con exito";
            }else{
                $this->view->mensaje ="Alumno no se pudo eliminar";
                
            }
            $this->render();
        }

        
    }