<?php
session_start();
include('header.php');
include('connection.php');
include('kawalan-admin.php');

$tarikhsemasa = isset($_POST['tarikh_semasa']) ? $_POST['tarikh_semasa'] : date("Y-m-d");

$sqltarikh = "SELECT DATE(tarikh) AS tarikh, count(*) as bilangan 
              FROM resit 
              GROUP BY DATE(tarikh) 
              ORDER BY DATE(tarikh) DESC";
$laktarikh = mysqli_query($condb, $sqltarikh);

$sql = "SELECT *, 
        (SELECT sum(tempahan.kuantiti * tempahan.harga_asal) 
         FROM tempahan 
         WHERE tempahan.no_resit = resit.no_resit) AS jum 
        FROM resit 
        WHERE resit.tarikh LIKE '%$tarikhsemasa%' 
        ORDER BY resit.tarikh DESC";
$laksql = mysqli_query($condb, $sql);
?>

<h2 class="page-title">Order report</h2>

<div class="filter-container">
    <form action='' method='POST' class="filter-form">
        <label for='tarikh_semasa'>Pilih Tarikh:</label>
        <select name='tarikh_semasa' id='tarikh_semasa'>
            <option value='<?= $tarikhsemasa ?>'>
                <?= date_format(date_create($tarikhsemasa), "d/m/Y"); ?>
            </option>
            <option disabled>Pilih Tarikh Lain</option>
            <?php while ($mm = mysqli_fetch_array($laktarikh)): ?>
                <option value='<?= $mm['tarikh'] ?>'>
                    <?= date_format(date_create($mm['tarikh']), "d/m/Y") ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type='submit' value='Display' class="btn-filter">
    </form>
</div>

<!-- Senarai Tempahan -->
<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Receipt number</th>
                <th>Date</th>
                <th>Order status</th>
                <th>Total payment (RM)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($m = mysqli_fetch_array($laksql)) { ?>
                <tr>
                    <td align='left'>
                        <strong><u><?= $m['no_resit'] ?></u></strong><br><br>
                        <?php
                        $sqlpaparmenu = "SELECT * FROM tempahan, menu 
                                         WHERE tempahan.id_menu = menu.id_menu 
                                         AND tempahan.no_resit = '".$m['no_resit']."'";
                        $lakpaparmenu = mysqli_query($condb, $sqlpaparmenu);
                        while ($mm = mysqli_fetch_array($lakpaparmenu)) {
                            echo $mm['nama_menu']." ( ".$mm['kuantiti']." x RM".$mm['harga_asal']." )<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $tarikh = date_create($m['tarikh']);
                        echo "Tarikh: " . date_format($tarikh, "d/m/Y") . "<br>";
                        echo "Masa: " . date_format($tarikh, "H:i:s");
                        ?>
                    </td>
                    <td>
                        <?= $m['status_tempah'] ?><br>
                        <i><?= $m['jenis_tempah'] ?></i>
                    </td>
                    <td><?= number_format($m['jum'], 2) ?></td>
                    <td>
                        <?php if ($m['status_tempah'] == 'DONE') {
                            echo "&#9989;";
                        } else {
                            echo "<a href='tempah-siap.php?no_resit=".$m['no_resit']."' title='Tandakan Siap'>&#10060;</a>";
                        } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #4B0082;
    }

    .page-title {
        text-align: center;
        margin: 30px auto 20px;
        color: #AA60C8;
        font-size: 2em;
    }

    .filter-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .filter-form {
        background-color: #EABDE6;
        padding: 15px 25px;
        border-radius: 12px;
        border: 2px solid #D69ADE;
        box-shadow: 0 4px 8px rgba(170, 96, 200, 0.2);
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-form select,
    .filter-form input[type="submit"] {
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #D69ADE;
        background-color: white;
        color: #AA60C8;
        font-weight: 500;
    }

    .btn-filter {
        background-color: #AA60C8;
        color: white;
        font-weight: bold;
        transition: 0.3s ease;
        cursor: pointer;
    }

    .btn-filter:hover {
        background-color: #8C48A8;
    }

    .table-container {
        max-width: 90%;
        margin: 0 auto 50px;
        overflow-x: auto;
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border: 2px solid #D69ADE;
        border-radius: 10px;
        overflow: hidden;
    }

    .styled-table th,
    .styled-table td {
        border: 1px solid #D69ADE;
        padding: 12px;
        text-align: center;
    }

    .styled-table th {
        background-color: #D69ADE;
        color: white;
    }

    .styled-table tr:nth-child(even) {
        background-color: #FCEBFA;
    }

    .styled-table tr:hover {
        background-color: #F8DFF8;
    }

    a {
        text-decoration: none;
        font-weight: bold;
        color: #AA60C8;
    }

    a:hover {
        color: #8C48A8;
    }

    @media (max-width: 768px) {
        .filter-form {
            flex-direction: column;
            align-items: stretch;
        }

        .styled-table th,
        .styled-table td {
            font-size: 0.9em;
        }
    }
</style>

