<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php
include('kawalan-admin.php');

# menyemak kewujudan data POST
if(!empty($_POST)) 
{
   # memanggil fail connection.php
    include('connection.php');

   # pengesahan data (validation) notel pengguna
    if(strlen($_POST['notel']) < 10 or strlen($_POST['notel']) > 13)
   {
       die("<script>alert('Phone Number Error');
       window.history.back();</script>");
   }


# arahan SQL (query) untuk kemaskini maklumat pengguna
$arahan = "update pengguna set
nama = '".$_POST['nama']."'
,
notel = '".$_POST['notel']."'
,
katalaluan = '".$_POST['katalaluan']."'
,
tahap = '".$_POST['tahap']."'
where 
notel = '".$_GET['notel_lama']."'
";

# melaksana dan menyemak proses kemaskini
if(mysqli_query($condb,$arahan))
{
    # kemaskini berjaya
    echo "<script>alert('Update Successful');
    window.location.href='pengguna-senarai.php';</script>";
}
else
{
    # kemaskini gagal
    # die(mysqli_error($condb); echo $arahan;
    echo "<script>alert('Update Failed');
    window.history.back();</script>";
    }
}
else
{
    # jika data GET tidak wujud. kembali ke fail pengguna-senarai.php
    die("<script>alert('Please fill in the form');
    window.location.href='pengguna-senarai.php';</script>");
}
?>