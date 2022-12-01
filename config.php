<?php
    $conx = mysqli_connect("localhost","root","","User");
    if(!$conx){
        echo 'Connection Failed';
    }
