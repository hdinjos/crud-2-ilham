<?php
    session_start();

    require_once 'core/connection.php';
    require_once 'templates/header.php';
    require_once 'core/functions.php';


    $id    = $_GET['id'];

    // Get Data
    $data_merk = get_data("*", "id=$id", "merk", $connect);

    foreach($data_merk as $data){
        $nama_merk = $data['nama_merk'];
    }

    if ( isset($_POST['ubah-data']) ) {

        $data = [
            "id"             => $connect->real_escape_string($_POST['id_merk']),
            "nama"           => $connect->real_escape_string($_POST['nama_merk']),
        ];

        $edit = edit_data("merk", $data, $connect);

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
        <form action="edit_merk.php" method="POST" class="form">
            <input type="number" class="form-control" name="id_merk" hidden value="<?=$id?>">
            <div class="form-group">
                <label>Nama merk</label>
                <input type="text" class="form-control" name="nama_merk" value="<?=$nama_merk?>">
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