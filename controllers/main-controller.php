<?php

if (!empty($_GET['controller'])){
    echo $_GET['controller'];die;
    $controller = $_GET['controller'];
    switch ($controller){

        case "room" :
            require_once '../room/room.php';
        break;
    }
}
