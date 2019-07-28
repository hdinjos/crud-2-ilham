<?php
    require_once 'core/connection.php';
    require_once 'core/functions.php';

    $id_data   = $_GET['id'];
    $table_ref = $_GET['table_ref'];

    $delete = delete_data($id_data, $table_ref, $connect);

    if ($delete) {
        //echo 'Data berhasil dihapus';
        header("Location: index.php#$table_ref");
    } else {
        echo 'Gagal menghapus data: ' . $connect->error;
    }

    $connect->close();

?>