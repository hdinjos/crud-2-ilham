<?php
    session_start();

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
    }

    require_once 'templates/header.php';
    require_once 'core/functions.php';

    $user_id    = $_SESSION['id'];
    $user_role  = $_SESSION['role'];
    

    $nama = $_SESSION['nama'];

?>
    <div class="container mt-5">
        <nav class="navbar p-0">
            <h2>
                Halo, <?=$nama?>
            </h2>
            <div class="nav justify-content-end">
                <a href="logout.php" role="button" class="btn btn-danger" name="logout">Logout</a>
            </div>
        </nav>

        <main class="mt-4">
            <?php
                if($user_role == 'pelanggan') {

                    require_once 'modal.php';
                    require_once 'dashboard/pelanggan.php';

                    
                } else {

                    require_once 'dashboard/admin.php';
                    require_once 'modal.php';
                }
            ?>
        </main>
    </div>

<?php
    require_once 'templates/footer.php';
?>