<?php
    include_once 'pelicula.php';

    class Apipeliculas{

        private $imagen;
        private $error;
        function getAll(){
            $pelicula = new Pelicula();
            $peliculas = array();
            $peliculas["items"] = array();

            $res = $pelicula->obtenerPeliculas();

            if($res->rowCount()){
                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    $item = array(
                        'id' => $row['id'],
                        'nombre' => $row['nombre'],
                        'imagen' => $row['imagen']
                    );
                    array_push($peliculas['items'],$item);
                }

                //echo json_encode($peliculas);
                $this->printJSON($peliculas);
            }else{
                //echo json_encode(array('mensaje' => 'No hay elementos registrados'));
                $this->error('No hay elementos registrados');
            }
        }

        function getById($id){
            $pelicula = new Pelicula();
            $peliculas = array();
            $peliculas["items"] = array();

            $res = $pelicula->obtenerPelicula($id);
            
            if($res->rowCount() == 1){
                    $row = $res->fetch();
                    $item = array(
                        'id' => $row['id'],
                        'nombre' => $row['nombre'],
                        'imagen' => $row['imagen']
                    );
                    array_push($peliculas['items'],$item);
                

                //echo json_encode($peliculas);
                $this->printJSON($peliculas);
            }else{
                //echo json_encode(array('mensaje' => 'No hay elementos registrados'));
                $this->error('No hay elementos registrados');
            }
        }
        function add($item){
            $pelicula=new Pelicula();

            $res = $pelicula->nuevaPelicula($item);
            $this->exito('nueva pelicula registrada');
        }

        function exito($mensaje){
            echo '<code>' . json_encode(array('mensaje' => $mensaje)). '</code>';
        }
        function printJSON($array){
            echo '<code>' . json_encode($array) .'</code>';
        }
        function error($mensaje){
            echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>';
        }
        function subirImagen($file){
            $directorio= "imagenes/";
            $this->imagen = basename($file["name"]);
            $archivo = $directorio . basename($file["name"]);

            $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

            $checarSi = getimagesize($file["tmp_name"]);

            if($checarSi != false){
                $size = $file["size"];

                if($size > 500000){
                    $this->error = "el archivo teine que ser menos a 500 k";
                    return false;
                }else{
                    if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                        
                        if(move_uploaded_file($file["tmp_name"], $archivo)){
                            //echo "el archivo se subio correctamente";
                            return true;
                        }else{
                            $this->error = "hubo un error en la subida del archivo";
                            return false;
                        }
                    }else{
                        $this->error ="solo se acepta jpg/jpeg";
                        return false;
                    }
                }
            }else{
                $this->error = "el doc no es una imagen ";
                return false; 
            }
        }

        function getImagen(){
            return $this->imagen;
        }
        function getError(){
            return $this->error;
        }
    }