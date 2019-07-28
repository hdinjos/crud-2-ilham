<?php 
     if($user_role == 'pelanggan') { 
?>
    <div class="modal fade" tabindex="-1" role="dialog" id="beliProduk" aria-hidden="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaki</h5>
                </div>
                <div class="modal-body">
                    <form action="tambah.php?table_ref=transaksi" method="POST" class="form">
                        <input type="hidden" name="id_pelanggan" value="<?=$user_id?>" required>
                        <div class="form-group">
                            <label>Produk</label>
                            <select name="id_produk" class="form-control">
                            <?php 
                                $res_produk = get_data("id, nama_produk", null, "produk", $connect);
                                foreach($res_produk as $produk) {
                            ?>
                                <option value="<?php echo $produk['id']; ?>"><?php echo $produk['nama_produk']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Produk</label>
                            <input type="number" class="form-control" name="jumlah_produk" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-primary" type="submit" name="tambah_data">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else {?>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambahProduk" aria-hidden="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                </div>
                <div class="modal-body">
                    <form action="tambah.php?table_ref=produk" method="POST" class="form">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Warna Produk</label>
                            <input type="text" class="form-control" name="warna_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Produk</label>
                            <input type="number" class="form-control" name="jumlah_produk" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Harga Produk</label>
                            <input type="number" class="form-control" name="harga_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Merk</label>
                            <select name="id_merk" class="form-control" required>
                            <?php 
                                $data_merk = get_data("*", null, "merk", $connect);
                                foreach($data_merk as $merk) {
                            ?>
                                <option value="<?php echo $merk['id']; ?>"><?php echo $merk['nama_merk']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                            <?php 
                                $data_kategori = get_data("*", null, "kategori", $connect);
                                foreach($data_kategori as $kategori) {?>
                                <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-primary" type="submit" name="tambah_data">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambahKategori" aria-hidden="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                </div>
                <div class="modal-body">
                    <form action="tambah.php?table_ref=kategori" method="POST" class="form">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" required>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-primary" type="submit" name="tambah_data">Tambah Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambahMerk" aria-hidden="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Merk</h5>
                </div>
                <div class="modal-body">
                    <form action="tambah.php?table_ref=merk" method="POST" class="form">
                        <div class="form-group">
                            <label>Nama Merk</label>
                            <input type="text" class="form-control" name="nama_merk" required>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-primary" type="submit" name="tambah_data">Tambah Merk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

    
<div class="modal fade" tabindex="-1" role="dialog" id="modalhapus" aria-hidden="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data?</h5>
            </div>
            <div class="modal-body">
                    <p>Yakin Mau menghapus data?</p>

                    <div class="form-group">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-danger" type="submit"><a href="" class="hapus-data-modal text-white">Hapus</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>