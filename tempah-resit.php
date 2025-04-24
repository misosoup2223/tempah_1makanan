<?php
# Memulakan fungsi session
session_start();

include('header.php');
include('connection.php');
$jumlah_harga = 0 ;

# Mendapatkan data tempahan
$sql_pilih = "select* from tempahan, menu, resit
where
    tempahan.no_resit = resit.no_resit
    AND tempahan.id_menu = menu.id_menu
    AND tempahan.no_resit = '".$_GET['noresit']."' ";
$laksana = mysqli_query($condb,$sql_pilih);
?>
<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
        margin: 0;
        padding: 20px;
    }

    h3 {
        text-align: center;
        color: #AA60C8;
        font-size: 2em;
        margin-bottom: 30px;
    }

    #saiz {
    width: 60%;
    margin: auto;
    border-collapse: collapse;
    background-color: #EABDE6;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#saiz th,
#saiz td {
    border-right: 1px solid #AA60C8; /* vertical lines between columns */
    padding: 14px 12px;
    font-size: 1em;
    color: #AA60C8;
}

/* Remove the right border from the last column */
#saiz th:last-child,
#saiz td:last-child {
    border-right: none;
}

/* Table row colors */
#saiz tr:nth-child(even) {
    background-color: #FFDFEF;
}

#saiz tr:nth-child(odd) {
    background-color: #FFF5FA;
}

#saiz tr:first-child td {
    background-color: transparent;
    border: none;
    text-align: center;
}

#saiz tr:nth-child(2) {
    background-color: #D69ADE;
    color: white;
    font-weight: bold;
    text-align: center;
}

#saiz tr:last-child {
    background-color: #D69ADE;
    color: white;
    font-weight: bold;
    text-align: right;
}

</style>


<!-- Memaparkan data tempahan pada resit -->
<h3>Order Receipt</h3>

<table id= 'saiz' align='center' border='1' width='50%'>
    <tr>
        <td colspan ='4'><?php include('butang-saiz.php'); ?></td>
    </tr>
    <tr align='center' bgcolor='#f4f87e'>
        <td>Menu</td>
        <td>Quantity</td>
        <td>Price<br>/unit</td>
        <td>Price</td>
    </tr>

<?php while($m=mysqli_fetch_array($laksana)){ ?>
    <tr>
        <td> <?= $m['nama_menu'] ?></td>
        <td align='center'> <?= $m['kuantiti'] ?></td>
        <td align='right'> <?= $m['harga_asal'] ?></td>
        <td align='right'>
        <?php
            $harga = $m['kuantiti'] * $m['harga_asal'];
            $jumlah_harga = $jumlah_harga + $harga;
            echo number_format($harga,2)
        ?></td>
    </tr>
<?php } ?>

<tr align='right' bgcolor='#f4f87e'>
    <td colspan='3' >Total Payment (RM) </td>
    <td ><?= number_format($jumlah_harga,2) ?></td>
</tr>
</table>
