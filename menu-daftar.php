<?php
# Memulakan fungsi session dan memanggil fail header.php
session_start();
include('header.php');

# Memanggil fail connection
include('connection.php');

$sql_kat = "SELECT * FROM kategori";
$lak_kat = mysqli_query($condb, $sql_kat);
?>

<h2 class="page-title">Register new menu</h2>
<p class="page-subtitle">Please fill in the information below</p>

<div class="form-container">
    <form action='' method='POST' enctype='multipart/form-data' class="styled-form">
        <label>ID Menu</label>
        <input required type='text' name='id_menu'>

        <label>Menu Name</label>
        <input required type='text' name='nama_menu'>

        <label>Description</label>
        <input required type='text' name='keterangan'>

        <label>Price (RM)</label>
        <input required type='number' name='harga' step='0.01'>

        <label>Category</label>
        <select name='id_kategori' required>
            <?php while ($k = mysqli_fetch_array($lak_kat)) : ?>
                <option value='<?= $k['id_kategori'] ?>'><?= $k['kategori_menu'] ?></option>
            <?php endwhile; ?>
        </select>

        <label>Picture</label>
        <input required type='file' name='gambar'>

        <button type='submit' class="btn-submit">Register</button>
    </form>
</div>

<?php
# Menyemak kewujudan data POST
if (!empty($_POST)) {
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $keterangan = $_POST['keterangan'];
    $id_kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];

    # Mengambil data gambar
    $timestmp = date('Y-m-d-His');
    $nama_fail = basename($_FILES['gambar']['name']);
    $format_gambar = pathinfo($nama_fail, PATHINFO_EXTENSION);
    $lokasi = $_FILES['gambar']['tmp_name'];
    $nama_baru = $timestmp . "." . $format_gambar;

    # Data validation : harga mesti positif nombor
    if (!is_numeric($harga) || $harga <= 0) {
        die("<script>
            alert('Ralat Harga');
            location.href='menu-daftar.php';
        </script>");
    }

    # Semak id_menu telah wujud
    $sql_semak = "SELECT id_menu FROM menu WHERE id_menu = '$id_menu'";
    $laksana_semak = mysqli_query($condb, $sql_semak);
    if (mysqli_num_rows($laksana_semak) == 1) {
        die("<script>
            alert('ID Menu had been used, please use other ID.');
            location.href='menu-daftar.php';
        </script>");
    }

    # Proses simpan
    $sql_simpan = "INSERT INTO menu SET 
        id_menu = '$id_menu',
        nama_menu = '$nama_menu',
        id_kategori = '$id_kategori',
        keterangan = '$keterangan',
        harga = '$harga',
        gambar = '$nama_baru'";

    $laksana = mysqli_query($condb, $sql_simpan);

    if ($laksana) {
        move_uploaded_file($lokasi, "gambar/" . $nama_baru);
        echo "<script>
            alert('Pendaftaran Berjaya');
            location.href='menu-senarai.php';
        </script>";
    } else {
        echo "<p style='color:red;'>Pendaftaran Gagal</p>";
        echo $sql_simpan . mysqli_error($condb);
    }
}
?>

<?php include('footer.php'); ?>

<!-- CSS Styling -->
<style>
    body {
    background-color: #FFDFEF;
    font-family: 'Segoe UI', sans-serif;
    color: #AA60C8;
    margin: 0;
    padding: 0;
}

.page-title {
    text-align: center;
    font-size: 1.7em;
    margin-top: 25px;
    color: #AA60C8;
}

.page-subtitle {
    text-align: center;
    font-size: 1em;
    margin-bottom: 15px;
    color: #AA60C8;
}

.form-container {
    width: 420px;
    max-width: 90%;
    margin: auto;
    background-color: #EABDE6;
    padding: 20px 25px;
    border: 2px solid #D69ADE;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(170, 96, 200, 0.15);
}

.styled-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    font-size: 0.95em;
}

.styled-form label {
    font-weight: bold;
    color: #AA60C8;
    font-size: 0.95em;
}

.styled-form input[type="text"],
.styled-form input[type="number"],
.styled-form input[type="file"],
.styled-form select {
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #D69ADE;
    background-color: #fff;
    font-size: 0.95em;
}

.btn-submit {
    background-color: #AA60C8;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 10px;
    font-size: 0.95em;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #8C48A8;
}

@media (max-width: 480px) {
    .form-container {
        width: 95%;
        padding: 15px 20px;
    }

    .styled-form input,
    .styled-form select {
        font-size: 0.9em;
    }
}

</style>

 