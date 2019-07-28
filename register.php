<?php 
    session_start();

    define("TITLE", 'Register | ');

    require_once 'templates/header-auth.php';
    require_once 'core/functions.php';

    if(isset($_POST['register'])) {
        $nama           = $_POST['nama'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $role           = $_POST['role'];
        $jenis_kelamin  = $_POST['jenis_kelamin'];
        $alamat         = $_POST['alamat'];

        $data = [
            "nama"     => $nama,
            "username" => $username,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "role"     => $role,
            "jk"       => $jenis_kelamin,
            "alamat"   => $alamat
        ];

        if($username != '' AND $password != '') {
            $res = register("users", $data, $connect); 
        } else {
            $res = "Form username dan/atau password tidak boleh kosong";
        }

    }
    
?>

    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card o-hidden my-5 p-4 border-0 shadow-lg">
                <div class="text-center">
                    <h2>Register</h2>
                </div>
                <?php
                    if(isset($_POST['register'])){
                        if($res) {
                            echo "<div class='alert alert-danger mt-4'>$res</div>";
                        }
                    }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="nama pelanggan" class="form-control py-4">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="username" class="form-control py-4">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="password" class="form-control py-4">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="pelanggan">Pelanggan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="register">register</button>
                    </div>
                </form>
                <div class="text-center">
                    Sudah punya akun? <a href="login.php">Login disini</a>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'templates/footer.php' ?>
