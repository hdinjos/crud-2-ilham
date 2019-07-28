<?php

    require_once 'core/connection.php';
    require_once 'core/functions.php';

    $id         = $_GET['id'];
    $table_ref  = $_GET['table_ref'];
    
    $edit = edit_data($table_ref, [
        "id"        => $id,
        "status"    => "dikirim",
        "ref"       => "konfirmasi"
    ], $connect);

    header("Location: index.php");