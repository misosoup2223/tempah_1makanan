<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# Menyemak kewujudan data GET.
if(empty($_GET)) {
    die("<script>window.location.href='menu-senarai.php';</script>");
}

# Mendapatkan maklumat menu
$sql_menu = "select* from menu, kategori where
    menu.id_kategori = kategori.id_kategori 
    and menu.id_menu = '".$_GET['id_menu']."'";

$lak_menu = mysqli_query($condb,$sql_menu);
$m = mysqli_fetch_array($lak_menu);

# Mendapatkan data kategori
$sql_kat = "select* from kategori";
$lak_kat = mysqli_query($condb,$sql_kat);
?>

<h3>Update new menu</h3>
<form enctype="multipart/form-data" method='POST' 
    action='menu-kemaskini-proses.php?id_menu=<?= $_GET['id_menu'] ?>'
>
    <label>Menu name</label>
    <input required type='text' name='nama_menu' value='<?= $m['nama_menu'] ?>'>

    <label>Description</label>
    <input required type='text' name='keterangan' value='<?= $m['keterangan'] ?>'>

    <label>Price</label>
    <input required type='number' name='harga' step='0.01' value='<?= $m['harga']?>'>

    <label>Category</label>
    <select name='id_kategori'>
        <option value ='<?= $m['id_kategori'] ?>'><?= $m['kategori_menu'] ?></option>
        <?php while($k = mysqli_fetch_array($lak_kat)): 
            if($k['id_kategori'] != $m['id_kategori']): ?>
                <option value ='<?= $k['id_kategori'] ?>'>
                    <?= $k['kategori_menu'] ?>
                </option>
        <?php endif; endwhile; ?>
    </select>

    <label><Picture></Picture></label>
    <input type='file' name='gambar'>

    <input type='submit' value='Update'>
</form>

<?php include ('footer.php'); ?>
<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
        margin: 0;
        padding: 30px 15px;
    }

    h3 {
        text-align: center;
        color: #AA60C8;
        font-size: 1.8em;
        margin-bottom: 30px;
    }

    form {
        background-color: #EABDE6;
        max-width: 500px;
        margin: auto;
        padding: 25px 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(170, 96, 200, 0.2);
    }

    label,
    input[type="text"],
    input[type="number"],
    select,
    input[type="file"] {
        display: block;
        width: 100%;
        margin-bottom: 15px;
        font-size: 1em;
    }

    input[type="text"],
    input[type="number"],
    select,
    input[type="file"] {
        padding: 10px;
        border: 1px solid #D69ADE;
        border-radius: 8px;
        background-color: #FFDFEF;
        color: #AA60C8;
    }

    input[type="submit"] {
        background-color: #AA60C8;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    input[type="submit"]:hover {
        background-color: #8C48A8;
        transform: scale(1.03);
    }

    label {
        font-weight: bold;
        color: #AA60C8;
        margin-bottom: 6px;
    }
</style>
