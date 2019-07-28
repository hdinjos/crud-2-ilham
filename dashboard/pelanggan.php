<button class="btn btn-primary" data-toggle="modal" data-target="#beliProduk" >Beli Produk</button>
            
<h3 class="mt-5" id="transaksi">Daftar Transaksi</h3>
<table class="table table-bordered table-hover mt-4">
    <thead class="thead-dark">
        <tr>
            <th>#ID Transaksi</th>
            <th>Nama Produk</th>
            <th>Warna</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th class="text-center" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php

        
                    
        $sql = "SELECT transaksi.id, transaksi.tanggal_transaksi, produk.nama_produk, 
                transaksi.jumlah_transaksi, transaksi.total_transaksi, transaksi.status
                FROM `transaksi` JOIN produk ON transaksi.id_produk=produk.id 
                JOIN users ON transaksi.id_user=users.id 
                WHERE users.id=$user_id
                ORDER BY transaksi.id DESC";

        $transaksi = $connect->query($sql);

        if ($transaksi->fetch_assoc() > 0) {
            // output data of each row
            foreach($transaksi as $data) {
               // die(print_r($data));

                $id                 = $data['id'];
                $nama_produk        = $data['nama_produk'];
                $tanggal_transaksi  = $data['tanggal_transaksi'];
                $jumlah_transaksi   = $data['jumlah_transaksi'];
                $total_transaksi    = "Rp " . number_format($data['total_transaksi'], 0, ',', '.');
                $status             = $data['status'];

                echo "<tr>";
                echo "<td> $id </td>";
                echo "<td> $nama_produk </td>";
                echo "<td> $jumlah_transaksi </td>";
                echo "<td> $total_transaksi </td>";
                echo "<td> $status </td>";
                echo "<td> $tanggal_transaksi </td>";
                if($status == "dipesan") {
                    echo "<td class='text-center'>
                        <a role='button' class='btn btn-primary edit' href='edit_transaksi.php?id=$id&table_ref=transaksi'>&#9998;</a>
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