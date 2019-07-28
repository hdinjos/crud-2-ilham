<?php

    require_once 'core/connection.php';
    require_once 'templates/header.php';
    require_once 'core/functions.php';

    $id     = $_GET['id'];

    // Get Data
    $data_user   = get_data("*", "id=$id", "users", $connect);

    foreach($data_user as $data){
        $nama              = $data['nama'];
        $alamat            = $data['alamat'];
        $jenis_kelamin     = $data['jenis_kelamin'];
        $role              = $data['role_id'];
    }

    if ( isset($_POST['ubah-data']) ) {
        $data = [
            "id"             => $connect->real_escape_string($_POST['id']),
            "nama"           => $connect->real_escape_string($_POST['nama']),
            "alamat"         => $connect->real_escape_string($_POST['alamat']),
            "jk"             => $connect->real_escape_string($_POST['jenis_kelamin']),
            "role"           => $connect->real_escape_string($_POST['role']),
            "password"       => $_POST['password']
        ];    

        
        $edit = edit_data("users", $data, $connect);
        //die(print_r($data));

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
        <form action="edit_user.php" method="POST" class="form">
            <input type="number" class="form-control" name="id" hidden value="<?=$id?>">
            <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" name="nama" value="<?=$nama?>">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?=$alamat?>">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option  value="L">Laki - Laki</option>
                    <option  value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <?php 
                        $data_role = get_data("*", null, "role", $connect);
                        foreach($data_role as $data) {?>
                        <option <?php echo $data['id'] == $role ? "selected" : "" ?> value="<?php echo $data['id']; ?>"><?php echo $data['role']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password">
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