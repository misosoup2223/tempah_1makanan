<?php
# Memulakan fungsi session
session_start();
include('connection.php');

# mengambil data GET
$no_resit = $_GET['no_resit'];

# Menukar status tempahan siap
$sql = "update resit set status_tempah ='DONE' where no_resit = '$no_resit'";
$lak = mysqli_query($condb,$sql);

# Menyemak proses menukar status tempahan

if(mysqli_affected_rows($condb) == 1){
    die("<script>
        alert('Update Successful');
        window.location.href='laporan.php';
    </script>");
}else{
    die("<script>
        alert('Update Failed');
        window.location.href='laporan.php';
    </script>");
}
?>
