<?php

require_once 'core/connection.php';
require_once 'core/functions.php';

$table_ref = $_GET['table_ref'];

switch ($table_ref) {
    case 'produk':
        $data = [
            "nama"           => $connect->real_escape_string($_POST['nama_produk']),
            "warna"          => $connect->real_escape_string($_POST['warna_produk']),
            "jumlah"         => $connect->real_escape_string($_POST['jumlah_produk']),
            "harga"          => $connect->real_escape_string($_POST['harga_produk']),
            "id_merk"        => $connect->real_escape_string($_POST['id_merk']),
            "id_kategori"    => $connect->real_escape_string($_POST['id_kategori']),
        ]; 
        //die(print_r($data));
        break;

    case 'kategori':
        $data = [
            "nama" => $connect->real_escape_string($_POST['nama_kategori']),
        ];
        break;

    case 'merk':
        $data = [
            "nama" => $connect->real_escape_string($_POST['nama_merk']),
        ];
        break;

    case 'transaksi':
        $data = [
            "id_user" => $connect->real_escape_string($_POST['id_pelanggan']),
            "id_produk" => $connect->real_escape_string($_POST['id_produk']),
            "jumlah_produk" => $connect->real_escape_string($_POST['jumlah_produk']),
        ];
        break;

    default:
        # code...
        break;
};

//$result = $connect->query($sql);

$add_data = insert_data($table_ref, $data, $connect);

if ($add_data) {
    //echo 'Data berhasil ditambahkan';
    header('Location: index.php');
} else {
    echo 'Gagal menambah data: ' . $connect->error;
}

$connect->close();