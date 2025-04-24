<?php
# Memulakan fungsi session dan memanggil fail header.php
session_start();
include ('header.php');
?>
<form action='' method='POST'>
    <h3>Login</h3>
    <p>Please fill in the information below</p>

    Phone number  
    <input type='text' name='notel' required>

    Password   
    <input type='password' name='pass' required>

    <input type='submit' value='Login'>
</form>
<?php
# Bahagian proses login
if (!empty($_POST)) {
    include('connection.php');

    $notel = $_POST['notel'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM pengguna WHERE notel = '$notel' AND katalaluan = '$pass' LIMIT 1";
    $laksana = mysqli_query($condb, $sql);

    if (mysqli_num_rows($laksana) == 1) {
        $m = mysqli_fetch_array($laksana);
        $_SESSION['notel'] = $m['notel'];
        $_SESSION['tahap'] = $m['tahap'];
        echo "<script>window.location.href='menu.php';</script>";
    } else {
        echo "<div class='error-msg'>Login Gagal<br>Semak No Telefon dan Katalaluan</div>";
    }
}
?>
<?php include('footer.php'); ?>

<!-- Inline CSS untuk login page -->
<style>
    body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #FFDFEF; /* Consistent background */
            color: #AA60C8;
            line-height: 1.6;
            padding: 0; /* Remove default body padding from header */
        }

    h3 {
        color: #AA60C8;
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    p {
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        background-color: #F8F0FA;
        width: 400px;
        margin: 30px auto;
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(200, 162, 200, 0.3);
        border: 1px solid #EBD5F6;
    }

    input[type='text'],
    input[type='password'] {
        width: 100%;
        padding: 12px 15px;
        margin: 12px 0 20px 0;
        border: 1px solid #D8BFD8;
        border-radius: 10px;
        background-color: #FFF5FB;
        font-size: 1em;
    }

    input[type='submit'] {
        background-color: #AA60C8;
        color: white;
        padding: 12px;
        width: 100%;
        border: none;
        border-radius: 10px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    input[type='submit']:hover {
        background-color: #C47A6B;
        transform: scale(1.03);
    }

    .error-msg {
        color: red;
        text-align: center;
        font-weight: bold;
        margin-top: 15px;
    }
</style>


