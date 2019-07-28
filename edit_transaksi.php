<?php
    session_start();

    require_once 'core/connection.php';
    require_once 'templates/header.php';
    require_once 'core/functions.php';


    $id    = $_GET['id'];

    // Get Data
    $data_transaksi = get_data("*", "id=$id", "transaksi", $connect);


    foreach($data_transaksi as $data){
        $jumlah_transaksi   = $data['jumlah_transaksi'];
        $id_produk          = $data['id_produk'];
        $status             = $data['status'];
        //die(print_r($data));
    }

    if ( isset($_POST['ubah-data']) ) {

        $data = [
            "id"               => $connect->real_escape_string($_POST['id']),
            "id_produk"        => $connect->real_escape_string($_POST['id_produk']),
            "jumlah"           => $connect->real_escape_string($_POST['jumlah_produk']),
        ];
        //die($data);

        $edit = edit_data("transaksi", $data, $connect);

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
        <form action="edit_transaksi.php" method="POST" class="form">
            <input type="number" class="form-control" name="id" hidden value="<?=$id?>">
            <input type="number" class="form-control" name="id_produk" hidden value="<?=$id_produk?>">
            <div class="form-group">
                <label>Jumlah yang dipesan</label>
                <input type="number" class="form-control" name="jumlah_produk" value="<?=$jumlah_transaksi?>">
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