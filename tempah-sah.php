<?php
# Memulakan fungsi session dan memanggil fail header.php

session_start();
include('connection.php');

if(!isset($_SESSION['orders'])){
    die("<script>
        alert('Ur cart is empty!');
        window.location.href='menu.php';
    </script>");
}
else {

# dapatkan bilangan setiap elemen 
$frekuensi = array_count_values($_SESSION['orders']);
# Filter elemen yang muncul lebih dari satu kali
$sama = array_filter($frekuensi, function($count)
{
return $count >= 1;
});
# Menjana no resit ( gabung 3 digit notel + tarikh masa)
$no_resit = substr($_SESSION['notel'],0,3).date("jnyHis");

# Memasukkan data ke dalam jadual resit
$sqlresit = "insert into resit (no_resit, notel,jenis_tempah,status_tempah) values
('$no_resit','".$_SESSION['notel']."','".$_POST['jenis_tempahan']."','Processing..')
";
$lakresit = mysqli_query($condb, $sqlresit);

# Mendapatkan data menu dan menyimpankannya dalam jadual tempahan
foreach($sama as $key => $bil) {
    $sqlcari = "select* from menu where id_menu = '$key'";
    $lak = mysqli_query($condb,$sqlcari);
    $m = mysqli_fetch_array($lak);
    $sqltempah = "insert into tempahan set no_resit = '$no_resit', id_menu = '$key', harga_asal = '".$m['harga']."', kuantiti = '$bil'
";
$laktempah = mysqli_query($condb,$sqltempah);
}

# Memadam nilai pembolehubah session
unset($_SESSION['orders']);

echo "<script>
alert('Order has been placed successfully!');
    window.location.href='tempah-resit.php?noresit=$no_resit';
</script>";
}
?>