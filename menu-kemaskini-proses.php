<?php
# Memulakan fungsi session
session_start();
include('connection.php');
include('kawalan-admin.php');

# Menyemak kewujudan data POST
if(!empty($_POST)){

    # Mengambil data daripada borang (form)
    $id_menu     = $_GET['id_menu'];
    $nama_menu   = $_POST['nama_menu'];
    $keterangan  = $_POST['keterangan'];
    $id_kategori = $_POST['id_kategori'];
    $harga       = $_POST['harga'];
    $tambahan   = '';

    # Dapatkan data gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $timestmp   = date('Y-m-d-His');
        $nama_fail   = $_FILES['gambar']['name'];
        $lokasi      = $_FILES['gambar']['tmp_name'];
        $format_gambar = pathinfo($nama_fail,PATHINFO_EXTENSION);
        $nama_baru   = $timestmp.".".$format_gambar;
        $tambahan    = $tambahan."gambar = '".$nama_baru."',";
        move_uploaded_file($lokasi,"gambar/".$nama_baru);
    } 

    # Data validation : had atas
    if(!is_numeric($harga) and $harga > 0){
        die("<script>
            alert('Ralat Harga');
            location.href='daftar-menu.php';
        </script>"
);
    }

    # proses kemaskini data
    $sql_kemaskini = "update menu set 
                        $tambahan
                        nama_menu = '$nama_menu',
                        id_kategori = '$id_kategori',
                        keterangan = '$keterangan',
                        harga = '$harga'
                        where 
                        id_menu = '$id_menu' ";

    $laksana = mysqli_query($condb,$sql_kemaskini);

    # Pengujian proses menyimpan data
    if($laksana){
        #jika berjaya
        echo " <script>
            alert('Kemaskini Berjaya');
            location.href='menu-senarai.php';
            </script>";
    }else{
        #jika gagal papar punca error
        echo "<p style='color:red;'>Update failed</p>";
        echo $sql_kemaskini.mysqli_error($condb);
    }
} ?>
