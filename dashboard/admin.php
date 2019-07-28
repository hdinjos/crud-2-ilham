<?php
    $produk = "SELECT produk.id, produk.nama_produk, produk.harga, produk.warna, produk.jumlah, kategori.nama_kategori, merk.nama_merk 
               FROM produk INNER JOIN kategori ON produk.id_kategori=kategori.id 
               INNER JOIN merk ON produk.id_merk=merk.id 
               ORDER BY id DESC";

    $res_produk = $connect->query($produk);
    //die(print_r($res_produk));
    
    
    $sql = "SELECT transaksi.id, transaksi.tanggal_transaksi, produk.nama_produk, users.nama, transaksi.jumlah_transaksi, transaksi.total_transaksi,
            transaksi.status
            FROM `transaksi` JOIN produk ON transaksi.id_produk=produk.id 
            JOIN users ON transaksi.id_user=users.id 
            ORDER BY transaksi.id DESC";

    $transaksi = $connect->query($sql);
?>

<ul class="nav">
    <li class="nav-item mr-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProduk">Tambah Produk</button>
    </li>
    <li class="nav-item mr-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKategori">Tambah Kategori</button>
    </li>
    <li class="nav-item mr-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahMerk">Tambah Merk</button>
    </li>
</ul>
            
<h3 class="mt-5">Daftar Transaksi</h3>
<table class="table table-bordered table-hover mt-4">
    <thead class="thead-dark">
        <tr>
            <th>#ID Transaksi</th>
            <th>Pelanggan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Tanggal Transaksi</th>
            <th class="text-center" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if ($transaksi->fetch_assoc() > 0) {
            // output data of each row
            foreach($transaksi as $data) {

                $id                 = $data['id'];
                $nama               = $data['nama'];
                $nama_produk        = $data['nama_produk'];
                $tanggal_transaksi  = $data['tanggal_transaksi'];
                $jumlah_transaksi   = $data['jumlah_transaksi'];
                $total_transaksi    = "Rp " . number_format($data['total_transaksi'], 0, ',', '.');
                $status             = $data['status'];

                //die(print_r($data));

                echo "<tr>";
                echo "<td> $id </td>";
                echo "<td> $nama </td>";
                echo "<td> $nama_produk </td>";
                echo "<td> $jumlah_transaksi </td>";
                echo "<td> $total_transaksi </td>";
                echo "<td> $status </td>";
                echo "<td> $tanggal_transaksi </td>";
                if($status == 'dipesan') {
                    echo "<td class='text-center'>
                        <a role='button' class='btn btn-success edit' href='confirm.php?id=$id&table_ref=transaksi'>&#10004;</a>
                    </td>";   
                }
                echo "<td class='text-center' colspan='2'>
                        <a role='button' class='btn btn-danger hapus' href='delete.php?id=$id&table_ref=transaksi' data-toggle='modal' data-target='#modalhapus'>&#215;</a>
                    </td>";
                echo "<tr>";

                
            }
        } else {
            echo " <td colspan='7'><center> 0 results </center></td>";
        }
    ?>
    </tbody>
</table>


<h3 class="mt-5" id="produk">Daftar Produk</h3>
<table class="table table-bordered table-hover mt-4">
    <thead class="thead-dark">
        <tr>
            <th>#ID Produk</th>
            <th>Produk</th>
            <th>Warna</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Merk</th>
            <th class="text-center" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if ($res_produk->fetch_assoc() > 0) {
            // output data of each row
            foreach($res_produk as $data) {

                $id         = $data['id'];
                $produk     = $data['nama_produk'];
                $warna      = $data['warna'];
                $jumlah     = $data['jumlah'];
                $harga      = "Rp " . number_format($data['harga'], 0, ',','.');
                $kategori   = $data['nama_kategori'];
                $merk       = $data['nama_merk'];

                echo "<tr>";
                echo "<td> $id </td>";
                echo "<td> $produk </td>";
                echo "<td> $warna </td>";
                echo "<td> $jumlah </td>";
                echo "<td> $harga </td>";
                echo "<td> $kategori </td>";
                echo "<td> $merk </td>";
                echo "<td class='text-center'>
                        <a role='button' class='btn btn-primary edit' href='edit.php?id=$id&table_ref=produk'>&#9998;</a>
                    </td>";
                echo "<td class='text-center'>
                        <a role='button' class='btn btn-danger hapus' href='delete.php?id=$id&table_ref=produk' data-toggle='modal' data-target='#modalhapus'>&#215;</a>
                    </td>";
                echo "<tr>";

                
            }
        } else {
            echo " <td colspan='7'><center> 0 results </center></td>";
        }
    ?>
    </tbody>
</table>

<div class="row">
    <div class="col" id="kategori">
        <h3 class="mt-5">Daftar Kategori</h3>
        <table class="table table-bordered table-hover mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>#ID Kategori</th>
                    <th>Kategori</th>
                    <th class="text-center" colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $kategori = get_data("*", null, "kategori", $connect);

                if ($kategori->fetch_assoc() > 0) {
                    // output data of each row
                    foreach($kategori as $data) {

                        $id           = $data['id'];
                        $kategori     = $data['nama_kategori'];

                        echo "<tr>";
                        echo "<td> $id </td>";
                        echo "<td> $kategori </td>";
                        echo "<td class='text-center'>
                                <a role='button' class='btn btn-primary edit' href='edit_kategori.php?id=$id&table_ref=kategori'>&#9998;</a>
                            </td>";
                        echo "<td class='text-center'>
                                <a role='button' class='btn btn-danger hapus' href='delete.php?id=$id&table_ref=kategori' data-toggle='modal' data-target='#modalhapus'>&#215;</a>
                            </td>";
                        echo "<tr>";

                        
                    }
                } else {
                    echo " <td colspan='7'><center> 0 results </center></td>";
                }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col" id="merk">
        <h3 class="mt-5">Daftar Merk</h3>
        <table class="table table-bordered table-hover mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>#ID Merk</th>
                    <th>Merk</th>
                    <th class="text-center" colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $merk = get_data("*", null, "merk", $connect);

                if ($merk->fetch_assoc() > 0) {
                    // output data of each row
                    foreach($merk as $data) {

                        $id       = $data['id'];
                        $merk     = $data['nama_merk'];

                        echo "<tr>";
                        echo "<td> $id </td>";
                        echo "<td> $merk </td>";
                        echo "<td class='text-center'>
                                <a role='button' class='btn btn-primary edit' href='edit_merk.php?id=$id&table_ref=merk'>&#9998;</a>
                            </td>";
                        echo "<td class='text-center'>
                                <a role='button' class='btn btn-danger hapus' href='delete.php?id=$id&table_ref=merk' data-toggle='modal' data-target='#modalhapus'>&#215;</a>
                            </td>";
                        echo "<tr>";

                        
                    }
                } else {
                    echo " <td colspan='7'><center> 0 results </center></td>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<h3 class="mt-5" id="users">Daftar User</h3>
<table class="table table-bordered table-hover mt-4">
    <thead class="thead-dark">
        <tr>
            <th>#ID User</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th class="text-center" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $user = "SELECT users.*, role.role FROM users
                 JOIN role ON users.role_id=role.id";

        $res_user = $connect->query($user);

        if ($res_user->fetch_assoc() > 0) {
            // output data of each row
            foreach($res_user as $data) {

                $id                 = $data['id'];
                $user               = $data['nama'];
                $username           = $data['username'];
                $role               = $data['role'];
                $jenis_kelamin      = $data['jenis_kelamin'];
                $alamat             = $data['alamat'];

                echo "<tr>";
                echo "<td> $id </td>";
                echo "<td> $user </td>";
                echo "<td> $username </td>";
                echo "<td> $role </td>";
                echo "<td> $jenis_kelamin </td>";
                echo "<td> $alamat </td>";
                echo "<td class='text-center'>
                        <a role='button' class='btn btn-primary edit' href='edit_user.php?id=$id&table_ref=users'>&#9998;</a>
                    </td>";
                echo "<td class='text-center'>
                        <a role='button' class='btn btn-danger hapus' href='delete.php?id=$id&table_ref=users' data-toggle='modal' data-target='#modalhapus'>&#215;</a>
                    </td>";
                echo "<tr>";

                
            }
        } else {
            echo " <td colspan='7'><center> 0 results </center></td>";
        }
    ?>
    </tbody>
</table>