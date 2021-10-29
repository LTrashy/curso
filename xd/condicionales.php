<?php
    $hora=14;
    if($hora> 6 && $hora < 12){
        echo "<h1>BBuemnos dias</h1>";
    }else if($hora >=12 && $hora<=18){
        echo "<h1>BBuenas tardes</h1>";
    }else{
        echo "<h1>BBuenas noches</h1>";
        
    }