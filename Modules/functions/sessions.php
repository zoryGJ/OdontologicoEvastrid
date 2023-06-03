<?php 

function controllSession() {
    session_start();

    if (isset($_SESSION['idAdmin'])) {
       return true;
    }

    return false;
}