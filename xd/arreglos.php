<?php
    $frutas = array("platano","manzana", "uvas","fresa");
    echo "<pre>" . print_r($frutas,true) . "</pre>";
    
    echo $frutas[1] . "<br>";
    
    echo count($frutas) ." elementos". "<br>";
    
    
    for($i=0;$i<count($frutas);$i++){
        echo $frutas[$i] . "<br>";
    }
    
    echo "<br>";
    
    $edades = array("ander" => 20,"xd"=>22,"wtf"=>78);
    echo "<pre>" . print_r($edades,true) . "</pre>";
    
    echo $edades['xd'] . "<br>";

    foreach($edades as $key => $value){
        echo $key . " tiene el valor de " . $value ."<br />";
    }