<?php
    $mensaje = "Hoy me trague una cipote nucita";

    echo strlen($mensaje). "<br>";

    echo str_word_count($mensaje). "<br>";
    
    echo strrev($mensaje). "<br>";
    
    echo strpos($mensaje,"cipote"). "<br>";
    
    echo str_replace("trague", "comi",$mensaje). "<br>";
    
    echo strtolower($mensaje). "<br>";

    echo strtoupper($mensaje). "<br>";

    echo strcmp("a","b"). "<br>";

    echo substr($mensaje,10,10). "<br>";

    echo trim("      hey hola      jaja        xd");







