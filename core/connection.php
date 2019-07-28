<?php

$HOST = 'localhost';
$USER = 'root';
$PW   = '';
$DB   = 'ecommerce';

$connect = new mysqli($HOST, $USER, $PW, $DB);

if($connect->connect_error) {
    return $connect->connect_error;
}