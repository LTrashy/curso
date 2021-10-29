<?php
    $password = '123asd#"!';

    echo md5($password). '<br>';
    echo sha1($password). '<br>';

    //hash (algoritmo, string)

    //var_dump(hash_algos());
    foreach(hash_algos() as $algo){
        echo $algo .': '.hash($algo, $password).'<br>';

    }

    //pasword hash

    $hash =  password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    echo $hash . '<br>';

    //pasword_verify()

    if(password_verify($password,$hash)){
        echo 'PAsswors ok';
    }