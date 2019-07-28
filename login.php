<?php 
    session_start();

    define("TITLE", 'Login | ');

    require_once 'templates/header-auth.php';
    require_once 'core/functions.php';

    if(isset($_POST['login'])) {
        $username_cred = $_POST['username'];
        $password_cred = $_POST['password'];

        if($username_cred != '' AND $password_cred != '') {
            $res = login($username_cred, $password_cred, $connect); 
        } else {
            $res = "Form username dan password tidak boleh kosong";
        }
    }
    
?>

    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card o-hidden my-5 p-4 border-0 shadow-lg">
                <div class="text-center">
                    <h2>Login</h2>
                </div>
                <?php
                    if( isset($_POST['login'])) {
                        if($res) {
                            echo "<div class='alert alert-danger mt-4'>$res</div>";
                        }
                    }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="username" class="form-control py-4">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="password" class="form-control py-4">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="login">Login</button>
                    </div>
                </form>
                <div class="text-center">
                    Belum punya akun? <a href="register.php">Daftar disini</a>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'templates/footer.php' ?>
