<?php
session_start();

include('header.php');
include('connection.php');
$menu = "<br>";

$sql = "SELECT *, (SELECT sum(tempahan.kuantiti * tempahan.harga_asal) FROM tempahan WHERE tempahan.no_resit=resit.no_resit) AS jum 
        FROM resit 
        WHERE notel ='" . $_SESSION['notel'] . "'
        ORDER BY resit.tarikh DESC";
$laksql = mysqli_query($condb, $sql);

if (isset($_GET['no_resit'])):
    $sqlpaparmenu = "SELECT * FROM tempahan, menu WHERE tempahan.id_menu = menu.id_menu AND tempahan.no_resit ='" . $_GET['no_resit'] . "' ";
    $lakpaparmenu = mysqli_query($condb, $sqlpaparmenu);
    $menu = "<br>";
    while ($mm = mysqli_fetch_array($lakpaparmenu)):
        $menu .= $mm['nama_menu'] . " ( " . $mm['kuantiti'] . " X RM " . $mm['harga_asal'] . " )<br>";
    endwhile;
endif;
?>

<div class="history-container">
    <h3>Order History</h3>

    <?php if (mysqli_num_rows($laksql) > 0) { ?>
        <table class="history-table">
            <tr>
                <th>No Resit</th>
                <th>Date</th>
                <th>Status<br>Order</th>
                <th>Total<br>Payment (RM)</th>
            </tr>

            <?php while ($m = mysqli_fetch_array($laksql)) { ?>
                <tr>
                    <td>
                        <a href="tempah-sejarah.php?no_resit=<?= $m['no_resit'] ?>" class="resit-link"><?= $m['no_resit'] ?></a>
                        <?php
                        if (isset($_GET['no_resit']) && $m['no_resit'] == $_GET['no_resit']) {
                            echo "<div class='menu-details'>" . $menu . "</div>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $tarikh = date_create($m['tarikh']);
                        echo "Date: " . date_format($tarikh, "d/m/Y") . "<br>Time: " . date_format($tarikh, "H:i:s");
                        ?>
                    </td>
                    <td>
                        <?= $m['status_tempah'] . "<br><i style='color: #7a3aa4;'>" . $m['jenis_tempah'] . "</i>" ?>
                    </td>
                    <td><?= number_format($m['jum'], 2) ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p class="empty-message">No order history</p>
    <?php } ?>
</div>

<style>
    body {
        background-color: #FFDFEF;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
    }

    .history-container {
        background-color: #FFDFEF;
        min-height: 100vh;
        padding: 40px 20px;
    }

    h3 {
        text-align: center;
        color: #AA60C8;
        font-size: 2em;
        margin-bottom: 30px;
    }

    table.history-table {
        width: 85%;
        margin: 0 auto;
        border-collapse: collapse;
        background-color: #EABDE6;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(170, 96, 200, 0.2);
    }

    table.history-table th {
        background-color: #D69ADE;
        color: white;
        padding: 16px 12px;
        font-weight: bold;
        text-align: center;
    }

    table.history-table td {
        padding: 16px 12px;
        border: 1px solid #D69ADE;
        font-size: 1em;
        background-color: #FFF0FA;
        text-align: center;
    }

    table.history-table tr:nth-child(even) td {
        background-color: #FFDFEF;
    }

    table.history-table td:first-child {
        text-align: left;
    }

    a.resit-link {
        color: #AA60C8;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a.resit-link:hover {
        color: #8C48A8;
        text-decoration: underline;
    }

    .menu-details {
        margin-top: 8px;
        font-size: 0.95em;
        color: #6a2b8d;
        line-height: 1.4em;
    }

    .empty-message {
        text-align: center;
        font-size: 1.2em;
        color: #AA60C8;
        margin-top: 40px;
    }
</style>

