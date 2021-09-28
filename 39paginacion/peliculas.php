<?php
    include_once 'db.php';

    class Peliculas extends DB{

        private $paginaActual;
        private $totalPag;
        private $nResultados;
        private $resultadosPorPagina;
        private $indice;

        private $error = false;

        public function __construct($nporpagina){
            parent::__construct();

            $this->resultadosPorPagina = $nporpagina;
            $this->indice = 0;
            $this->paginaActual = 1;

            $this->calcularPaginas();
        }

        function calcularPaginas(){
            $query = $this->connect()->query('SELECT COUNT(*) AS total FROM pelicula');
            $this->nResultados = $query->fetch(PDO::FETCH_OBJ)->total;
            $this->totalPag = round($this->nResultados / $this->resultadosPorPagina);

            if(isset($_GET['pagina'])){

                if(is_numeric($_GET['pagina'])){
                    if($_GET['pagina'] >= 1  && $_GET['pagina'] <= $this->totalPag){
                        $this->paginaActual = $_GET['pagina'];
                        $this->indice = ($this->paginaActual - 1 ) * ($this->resultadosPorPagina);

                    }else{
                        echo "no existe esa pagina";
                        $this->error = true;
                    }
                }else{
                    echo "error al mostrar la pag";
                    $this->error = true;
                }
            }
        }

        function mostrarPeliculas(){
            if(!$this->error){
                $query = $this->connect()->prepare('SELECT * FROM pelicula LIMIT :pos , :n');
                $query->execute(['pos' => $this->indice , 'n'=> $this->resultadosPorPagina]);

                foreach($query as $pelicula){
                    include 'vista-peliculas.php';
                }
            }else{

            }
        }
        function mostrarPaginas(){
            $actual ='';
            echo "<ul>";
            
            for($i=0;$i<$this->totalPag;$i++){
                if(($i+1)==$this->paginaActual){
                    $actual = ' class="actual" ';
                }else{
                    $actual = '';                    
                }
                echo "<li><a ".$actual. " href='?pagina=".($i+1)."'>" . ($i + 1) . "</a></li>";
            }

            echo "</ul>";
        }
    }