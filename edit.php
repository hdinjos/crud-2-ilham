<?php

    require_once 'core/connection.php';
    require_once 'templates/header.php';
    require_once 'core/functions.php';

    $id     = $_GET['id'];

    // Get Data
    $data_produk   = get_data("*", "id=$id", "produk", $connect);
    $data_kategori = get_data("*", null, "kategori", $connect);
    $data_merk     = get_data("*", null, "merk", $connect);


    foreach($data_produk as $data){
        $nama_produk    = $data['nama_produk'];
        $warna_produk   = $data['warna'];
        $jumlah_produk  = $data['jumlah'];
        $id_merk        = $data['id_merk'];
        $id_kategori    = $data['id_kategori'];
    }

    if ( isset($_POST['ubah-data']) ) {
        $data = [
            "id"             => $connect->real_escape_string($_POST['id_produk']),
            "nama"           => $connect->real_escape_string($_POST['nama_produk']),
            "warna"          => $connect->real_escape_string($_POST['warna_produk']),
            "jumlah"         => $connect->real_escape_string($_POST['jumlah_produk']),
            "id_merk"        => $connect->real_escape_string($_POST['id_merk']),
            "id_kategori"    => $connect->real_escape_string($_POST['id_kategori']),
        ];

        $edit = edit_data("produk", $data, $connect);

        if ($edit) {
            header('Location: index.php');
        } else {
            echo 'Gagal mengubah data: ' . $connect->error;
        }
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand">Beranda</a>
    </div>
</nav>

<main class="mt-5">
    <div class="container">
        <form action="edit.php" method="POST" class="form">
            <input type="number" class="form-control" name="id_produk" hidden value="<?=$id?>">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk"  value="<?=$nama_produk?>">
            </div>
            <div class="form-group">
                <label>Warna Produk</label>
                <input type="text" class="form-control" name="warna_produk" value="<?=$warna_produk?>">
            </div>
            <div class="form-group">
                <label>Jumlah Produk</label>
                <input type="number" class="form-control" name="jumlah_produk" value="<?=$jumlah_produk?>">
            </div>
            <div class="form-group">
                <label>Merk</label>
                <select name="id_merk" class="form-control">
                    <?php foreach($data_merk as $merk) { ?>
                        <option <?php echo $merk['id'] == $id_merk ? "selected" : "" ?> value="<?php echo $merk['id']; ?>"><?php echo $merk['nama_merk']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control">
                    <?php foreach($data_kategori as $kategori) { ?>
                        <option <?php echo $kategori['id'] == $id_kategori ? "selected" : "" ?> value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="ubah-data">Ubah Data</button>
            </div>
        </form>
    </div>
</main>

<?php
require_once 'templates/footer.php';
?>