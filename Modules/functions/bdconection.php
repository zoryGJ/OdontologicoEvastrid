<?php

    $connect = new mysqli('localhost', 'root', '', 'smile', 3306);

    if ($connect->connect_errno) {
        echo "Lo sentimos, el sitio web está experimentando problemas";
    }
    
    
?>