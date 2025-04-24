<?php
# memulakan fungsi session
session_start();

# memanggil fail header, kawalan-admin
include('header.php');
include('kawalan-admin.php');
?>
<!-- Tajuk Laman -->
<h3>Upload users data (*.txt)</h3>
<!-- Borang untuk memuat naik fail -->
<form action='' method='POST' enctype='multipart/form-data'>
    <h3><b>Place a File that u want to upload</b></h3>
    <input type='file' name='data_pengguna' required>
    <button type='submit' name='upload'>Upload</button>
</form>
<?php include ('footer.php'); ?>
<!-- Bahagian Memproses Data yang dimuat naik -->
<?php
# data validation : menyemak kewujudan data dari borang
if (isset($_POST['upload'])) 
{
    # memanggil fail connection
    include ('connection.php');

    # mengambil nama sementara fail
    $namafailsementara = $_FILES["data_pengguna"]["tmp_name"];

    # mengambil nama fail
    $namafail = $_FILES['data_pengguna']['name'];

    # mengambil jenis fail
    $jenisfail = pathinfo($namafail, PATHINFO_EXTENSION);

    # menguji jenis fail dan saiz fail
    if ($_FILES["data_pengguna"]["size"] > 0 AND $jenisfail == "txt") 
    {
        # membuka fail yang diambil
        $fail_data_pengguna = fopen($namafailsementara, "r");
        $bil = 0;

        # mendapatkan data dari fail baris demi baris
        while (!feof($fail_data_pengguna)) 
        {
            # mengambil data sebaris sahaja bg setiap pusingan
            $ambilbarisdata = fgets($fail_data_pengguna);

            # memecahkan baris data mengikut tanda pipe
            $pecahkanbaris = explode("|", $ambilbarisdata);

            # selepas pecahan tadi akan diumpukan kepada 3
            if (count($pecahkanbaris) >= 3) {
                list($notel, $nama, $katalaluan) = $pecahkanbaris;

                # semak kewujudan notel
                $pilih = mysqli_query($condb, "SELECT * FROM pengguna WHERE notel='" . trim($notel) . "'");

                if (mysqli_num_rows($pilih) == 1) {
                    echo "<script>
                        alert('phone number $notel already exist. Please change in .txt file.');
                    </script>";
                } else {
                    # arahan SQL untuk menyimpan data
                    $arahan_sql_simpan = "INSERT INTO pengguna (notel, nama, katalaluan, tahap) 
                                          VALUES ('$notel', '$nama', '$katalaluan', 'ADMIN')";

                    # memasukkan data ke dalam jadual pengguna
                    $laksana_arahan_simpan = mysqli_query($condb, $arahan_sql_simpan);
                    $bil++;
                }
            }
        }

        # menutup fail txt yang dibuka
        fclose($fail_data_pengguna);

        echo "<script>
            alert('File imported successfully, as much as $bil has beeen recorded.');
            window.location.href='pengguna-senarai.php';
        </script>";
    } 
    else 
    {
        # jika fail yang dimuat naik kosong atau tersalah format.
        echo "<script>alert('Only .txt format files are allowed.');</script>";
    }
}
?>

<!-- Gaya CSS -->
<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
        margin: 0;
        padding: 0;
    }

    h3 {
        text-align: center;
        margin-top: 40px;
        color: #AA60C8;
        font-size: 1.8em;
    }

    form {
        background-color: #EABDE6;
        border: 2px solid #D69ADE;
        border-radius: 15px;
        width: 90%;
        max-width: 600px;
        margin: 30px auto;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(170, 96, 200, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    form h3 {
        font-size: 1.2em;
        margin: 0;
        color: #AA60C8;
    }

    input[type="file"] {
        border: 2px dashed #D69ADE;
        padding: 10px;
        border-radius: 8px;
        background-color: #FFDFEF;
        color: #AA60C8;
        width: 100%;
        cursor: pointer;
    }

    input[type="file"]::file-selector-button {
        background-color: #AA60C8;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: #8C48A8;
    }

    button[type="submit"] {
        background-color: #AA60C8;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #8C48A8;
    }

    @media (max-width: 600px) {
        form {
            width: 95%;
            padding: 20px;
        }
    }
</style>

