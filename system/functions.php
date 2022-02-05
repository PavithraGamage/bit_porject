<?php

// Data Cleaning Function-28/11/2021-----------------
// Last Modified at 28/11/2021

function data_clean($data = null){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

// End Data Cleaning Function------------------------

// Database Connection-------------------------------

function db_con(){

    $sever = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'bit';

    $con = new mysqli($sever, $user, $password, $db);

    if ($con->connect_error) {
        die("Database Connection" . $con->connect_error);
    }

    return $con;
}

// End Database Connection-------------------------------

function discount ($unit_price = null, $sale_price =null){

    $discount = (($unit_price - $sale_price) * 100) / $unit_price ;

    return $discount;

}