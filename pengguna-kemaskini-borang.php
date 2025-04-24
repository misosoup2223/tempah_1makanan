<?php
session_start();
include('header.php');
include('kawalan-admin.php');
include('connection.php');

if (empty($_GET)) {
    die("<script>window.location.href='pengguna-senarai.php';</script>");
}

$sql = "SELECT * FROM pengguna WHERE notel = '" . $_GET['notel'] . "'";
$laksana = mysqli_query($condb, $sql);
$m = mysqli_fetch_array($laksana);
?>

<div class="form-container">
    <h3>Update user</h3>

    <form action='pengguna-kemaskini-proses.php?notel_lama=<?= $_GET['notel'] ?>' method='POST' class="styled-form">
        <label>Name</label>
        <input type='text' name='nama' value='<?= $m['nama'] ?>' required>

        <label>Phone number</label>
        <input type='text' name='notel' value='<?= $m['notel'] ?>' required>

        <label>Password</label>
        <input type='text' name='katalaluan' value='<?= $m['katalaluan'] ?>' required>

        <label>Level</label>
        <select name='tahap'>
            <option value='<?= $m['tahap'] ?>'><?= $m['tahap'] ?></option>
            <?php
            $arahan_sql_tahap = "SELECT tahap FROM pengguna GROUP BY tahap ORDER BY tahap";
            $laksana_arahan_tahap = mysqli_query($condb, $arahan_sql_tahap);
            while ($n = mysqli_fetch_array($laksana_arahan_tahap)) {
                if ($n['tahap'] != $m['tahap']) {
                    echo "<option value='" . $n['tahap'] . "'>" . $n['tahap'] . "</option>";
                }
            }
            ?>
        </select>

        <input type='submit' value='Update' class="submit-button">
    </form>
</div>

<?php include('footer.php'); ?>

<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
        margin: 0;
    }

    .form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        background-color: #EABDE6;
        border: 2px solid #D69ADE;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(170, 96, 200, 0.15);
    }

    h3 {
        text-align: center;
        color: #AA60C8;
        margin-bottom: 25px;
    }

    .styled-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .styled-form label {
        font-weight: bold;
        font-size: 1em;
        color: #AA60C8;
    }

    .styled-form input[type="text"],
    .styled-form select {
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #D69ADE;
        font-size: 1em;
        background-color: white;
        color: #6A1A8D;
    }

    .styled-form select {
        background-color: #fff;
    }

    .submit-button {
        background-color: #AA60C8;
        color: white;
        padding: 10px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-button:hover {
        background-color: #8C48A8;
        transform: scale(1.03);
    }

    @media (max-width: 600px) {
        .form-container {
            width: 90%;
            padding: 20px;
        }
    }
</style>
