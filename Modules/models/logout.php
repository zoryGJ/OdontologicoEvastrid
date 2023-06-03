<?php

session_start();
session_destroy();
session_unset();

$respuesta = array('proceso' =>  'success');

echo json_encode($respuesta);