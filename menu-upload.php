<?php
# memulakan fungsi session & fail header
session_start();
include('header.php');
include('kawalan-admin.php');
?>

<!-- Tajuk Laman -->
<h2 class="page-title">Upload menu data (*.txt)</h2>

<!-- Borang untuk memuat naik fail -->
<div class="upload-container">
    <form action='' method='POST' enctype='multipart/form-data' class="upload-form">
        <label for="data"><b>Please pick a .txt file u wan to upload</b></label>
        <input type='file' name='data' id='data' required>
        <button type='submit' name='upload' class="btn-upload">Upload</button>
    </form>
</div>

<?php include ('footer.php'); ?>

<!-- Bahagian Memproses Data yang dimuat naik -->
<?php
if (isset($_POST['upload'])) {
    include('connection.php');

    $namafailsementara = $_FILES['data']['tmp_name'];
    $namafail = $_FILES['data']['name'];
    $jenisfail = $_FILES['data']['type'];

    if ($_FILES["data"]["size"] > 0 && $jenisfail == "text/plain") {
        $fail_data = fopen($namafailsementara, "r");
        $bil = 0;

        while (!feof($fail_data)) {
            $ambilbarisdata = fgets($fail_data);
            if (trim($ambilbarisdata) == "") continue;

            $data = explode("|", $ambilbarisdata);

            $id_menu = trim($data[0]);
            $nama_menu = trim($data[1]);
            $id_kategori = trim($data[2]);
            $keterangan = trim($data[3]);
            $harga = trim($data[4]);

            $pilih = mysqli_query($condb, "SELECT * FROM menu WHERE id_menu='$id_menu'");
            if (mysqli_num_rows($pilih) == 1) {
                echo "<script>
                    alert('ID Menu $id_menu in this file .txt telah already exist . Please change the ID.');
                </script>";
            } else {
                $sql_simpan = "INSERT INTO menu SET 
                    id_menu = '$id_menu',
                    nama_menu = '$nama_menu',
                    id_kategori = '$id_kategori',
                    keterangan = '$keterangan',
                    harga = '$harga'";

                $laksana_arahan_simpan = mysqli_query($condb, $sql_simpan);
                $bil++;
            }
        }

        fclose($fail_data);

        echo "<script>
            alert('Data import has been done. As much as $bil data has been sotred. Please update menu and upload picture.');
            window.location.href='menu-senarai.php';
        </script>";
    } else {
        echo "<script>alert('Only files that are in .txt format are allowed');</script>";
    }
}
?>

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
        margin-top: 40px;
        font-size: 2em;
        color: #AA60C8;
    }

    .upload-container {
        width: 50%;
        margin: 30px auto;
        background-color: #EABDE6;
        border: 2px solid #D69ADE;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(170, 96, 200, 0.2);
    }

    .upload-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .upload-form label {
        font-weight: bold;
        color: #AA60C8;
        font-size: 1.1em;
    }

    .upload-form input[type="file"] {
        border: 1px solid #D69ADE;
        padding: 10px;
        border-radius: 8px;
        background-color: #fff;
    }

    .btn-upload {
        background-color: #AA60C8;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-upload:hover {
        background-color: #8C48A8;
    }

    @media (max-width: 768px) {
        .upload-container {
            width: 90%;
            padding: 20px;
        }
    }
</style>

