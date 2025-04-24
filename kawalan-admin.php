<?php
# Menyemak nilai pembolehubah session['tahap']
if(!empty($_SESSION['tahap'])){
    if($_SESSION['tahap'] != "ADMIN")
    {
        # jika nilainya tidak sama dengan admin.
        die("<script>alert('sila login');
        window.location.href='logout.php';</script>");

    }
}else{
    # jika nilai session empty.
    die("<script>alert('sila login');
    window.location.href='logout.php';</script>");
}
?>
