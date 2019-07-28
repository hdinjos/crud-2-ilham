<?php

    function get_data($data, $clausa, $table, $connect) {

        if($clausa != ''|| $clausa != null) {
            $sql = "SELECT $data FROM $table WHERE $clausa";
        }else {
            $sql = "SELECT $data FROM $table";
        }
        return $connect->query($sql);
    }

    function insert_data($table, $data = [], $connect) {
        switch ($table) {
            case 'produk':
                $nama        = $data['nama'];
                $warna       = $data['warna'];
                $jumlah      = $data['jumlah'];
                $harga       = $data['harga'];
                $id_merk     = $data['id_merk'];
                $id_kategori = $data['id_kategori'];
    
                $sql = "INSERT INTO $table (nama_produk,warna,jumlah,harga,id_merk,id_kategori)
                        VALUES('$nama','$warna',$jumlah,$harga,$id_merk,$id_kategori)";
                break;
            
            case 'kategori':
                $nama   = $data['nama'];
                $sql    = "INSERT INTO $table (nama_kategori)
                           VALUES('$nama')";
                break;
    
            case 'merk':
                $nama       = $data['nama'];
                $sql        = "INSERT INTO $table (nama_merk)
                               VALUES('$nama')";
                break;

            case 'users':
                $nama           = $data['nama'];
                $username       = $data['username'];
                $password       = $data['password'];
                $role           = $data['role'];
                $jk             = $data['jk'];
                $alamat         = $data['alamat'];
                
                $sql = "INSERT INTO $table (nama, username, password, jenis_kelamin, role_id, alamat)
                        VALUES('$nama', '$username', '$password', '$jk', '$role', '$alamat')";
                //die($sql);
                break;

            case 'transaksi':
                $id_user        = $data['id_user'];
                $id_produk      = $data['id_produk'];
                $jumlah         = $data['jumlah_produk'];

                $harga = get_data("harga", "id=$id_produk", "produk", $connect)->fetch_assoc()['harga'];
                $total = $jumlah * $harga;
                //die($total);
                
                $sql = "INSERT INTO $table (id_produk, id_user, jumlah_transaksi, total_transaksi)
                        VALUES('$id_produk', '$id_user', '$jumlah', '$total')";
                //die($sql);
                break;
    
            default:
                Echo "Error";
                break;
        }

        //die($sql);
    
        return $connect->query($sql);
    }

    function delete_data($id, $table, $connect) {
        $sql = "DELETE FROM $table WHERE id=$id";
        return $connect->query($sql);
    }

    function edit_data($table, $data = [], $connect){
        switch ($table) {
            case 'produk':
                $id          = $data['id'];
                $nama        = $data['nama'];
                $warna       = $data['warna'];
                $jumlah      = $data['jumlah'];
                $id_merk     = $data['id_merk'];
                $id_kategori = $data['id_kategori'];
                
                $sql    = "UPDATE $table SET 
                           nama_produk='$nama', 
                           warna='$warna', 
                           jumlah='$jumlah', 
                           id_merk='$id_merk', 
                           id_kategori='$id_kategori' 
                           WHERE id=$id";
    
                break;
    
            case 'kategori':
                $id     = $data['id'];
                $nama   = $data['nama'];
                
                $sql    = "UPDATE $table SET 
                        nama_kategori='$nama' 
                        WHERE id=$id";
                break;
    
            case 'merk':
                $id     = $data['id'];
                $nama   = $data['nama'];
                
                $sql    = "UPDATE $table SET 
                           nama_merk='$nama'
                           WHERE id=$id";
                break;

            case 'users':
                $id            = $data['id'];
                $nama          = $data['nama'];
                $alamat        = $data['alamat'];
                $jk            = $data['jk'];
                $role          = $data['role'];
                $password      = $data['password'];

                if ($password) {
                    $pw_hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql    = "UPDATE $table SET 
                               alamat='$alamat', 
                               nama='$nama', 
                               jenis_kelamin='$jk', 
                               role_id='$role', 
                               password='$pw_hash' 
                               WHERE id=$id";
                    
                }else {
                    $sql    = "UPDATE $table SET 
                              alamat='$alamat', 
                              nama='$nama', 
                              jenis_kelamin='$jk', 
                              role_id='$role' 
                              WHERE id=$id";
                //die($sql);
                }
                break;

            case 'transaksi':

                if($data['ref'] == "konfirmasi") {
                    
                    $id        = $data['id'];
                    $status    = $data['status'];

                    $sql       = "UPDATE $table SET status='$status'
                                  WHERE id=$id";
                } else {
                    $id        = $data['id'];
                    $id_produk = $data['id_produk'];
                    $jumlah    = $data['jumlah'];
    
                    $get_harga  = get_data("harga", "id=$id_produk", "produk", $connect);
                    $harga      = $get_harga->fetch_assoc()['harga'];
                    $total      = $jumlah*$harga;
                    
                    $sql    = "UPDATE $table SET 
                               jumlah_transaksi='$jumlah',
                               total_transaksi='$total'
                               WHERE id=$id";
                }

                //die($sql);
                break;
            
            default:
                echo "Error, table $table not found";
                break;
        }
        //die($sql);
        return $connect->query($sql);
    }
    

    function login($username, $password, $connect){
        $result = get_data("*", "username='$username'", "users", $connect);

        if($result->fetch_assoc() > 0) {
            foreach($result as $data) {
                $uname  = $data['username'];
                $nama   = $data['nama'];
                $id     = $data['id'];
                $role   = $data['role_id'];
                $pw     = password_verify($password, $data['password']);
            }

            if($username == $uname AND $pw) {
                $_SESSION['nama']   = $nama;
                $_SESSION['id']     = $id;
                $_SESSION['role']   = $role;
                header('Location: index.php');
            }else {
                return 'Gagal login, Pastikan username dan password benar!';
            }
        }
    }

    function register($table, $data, $connect) {
        // $data_ref = "username, password, nama_pelanggan, role, jenis_kelamin, alamat";
        // $data = "'$username', '$password', '$name', '$role', '$jenis_kelamin', '$alamat'";
        insert_data($table, $data, $connect);
        header("Location: login.php");
     
    }