<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once 'model.php';

    $alumnos = new Model();

    $lista = $alumnos->getAll();

    //echo var_dump($lista);

    $html = '<img src="icon.png" width="300"/>
            <h1>Tabla de alumnos</h1>
            <table> 
                <tr>
                    <td>Id</td><td>Nombre</td>
                </tr>';

    foreach($lista['items'] as $item){
        //echo $item['nombre'];
        $html .= '<tr>
                        <td>'.$item['id'].'</td><td>'.$item['nombre'].'</td>
                    </tr>';
    }

    $html .='</table>';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    