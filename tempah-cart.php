<?php

# Memulakan fungsi session dan memanggil fail header.php
session_start();
include('header.php');
include('connection.php');
$jumlah_harga = 0;

# menyemak jika tatasusunan order kosong
if (!isset($_SESSION['orders']) or count($_SESSION['orders']) == 0) {
    die("<script>
        alert('Ur cart is empty!');
        window.location.href='menu.php';
    </script>");
} else {
    ?>
    <div class="cart-page">
        <h2 class="cart-title">Your order cart</h2>
        <table class="cart-table">
            <thead class="cart-header">
                <tr>
                    <th>Menu</th>
                    <th class="center">Quantity</th>
                    <th class="right">Price /unit (RM)</th>
                    <th class="right">Price (RM)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                # dapatkan bilangan setiap elemen
                $bilangan = array_count_values($_SESSION['orders']);
                # Filter elemen yang muncul lebih dari satu kali
                $sama = array_filter($bilangan, function ($count) {
                    return $count >= 1;
                });

                foreach ($sama as $key => $bil) {
                    $sql = "SELECT * FROM menu WHERE id_menu = '$key'";
                    $lak = mysqli_query($condb, $sql);
                    $m = mysqli_fetch_array($lak);
                    ?>
                    <tr>
                        <td class="menu-item"><?= $m['nama_menu'] ?></td>
                        <td class="center">
                            <a href='tempah-tambah.php?page=cart&id_menu=<?= $m['id_menu'] ?>' class="cart-button">[ + ]</a>
                            <span class="cart-quantity"><?= $bil ?></span>
                            <a href='tempah-padam.php?id_menu=<?= $m['id_menu'] ?>' class="cart-button">[ - ]</a>
                        </td>
                        <td class="right"><?= number_format($m['harga'], 2) ?></td>
                        <td class="right"><?php
                            $harga = $bil * $m['harga'];
                            $jumlah_harga = $jumlah_harga + $harga;
                            echo number_format($harga, 2);
                            ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot class="cart-footer">
                <tr class="total-row">
                    <td colspan='3' class="right strong">Jumlah Bayaran (RM)</td>
                    <td class="right strong"><?= number_format($jumlah_harga, 2) ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="order-form">
            <h3 class="form-title">Order Type</h3>
            <form action='tempah-sah.php' method='POST'>
                <table class="form-table">
                    <tr>
                        <td>Order type</td>
                        <td>
                            <select name='jenis_tempahan' class="form-select">
                                <option>Take away</option>
                                <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    echo "<option>Table $i </option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="center">
                            <input type='submit' value='Confirm order' class="submit-button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
}
include('footer.php');
?>

<style>
    .cart-page {
        width: 90%;
        max-width: 850px;
        margin: 30px auto;
        background-color: #EABDE6;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
    }

    .cart-title {
        color: #AA60C8;
        text-align: center;
        font-size: 2em;
        margin-bottom: 25px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 1.05em;
        border: 2px solid #D69ADE;
        background-color: #FFDFEF;
        margin-bottom: 40px;
        border-radius: 6px;
        overflow: hidden;
    }

    .cart-header th {
        background-color: #D69ADE;
        color: white;
        padding: 14px 10px;
        text-align: center;
    }

    .cart-table td {
        border: 1px solid #D69ADE;
        padding: 12px 10px;
        background-color: #FFF0FA;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .cart-quantity {
        margin: 0 12px;
        font-weight: bold;
        color: #AA60C8;
    }

    .cart-button {
        display: inline-block;
        padding: 6px 10px;
        margin: 0 4px;
        text-decoration: none;
        color: #AA60C8;
        border: 1px solid #AA60C8;
        border-radius: 5px;
        font-size: 0.9em;
        background-color: transparent;
        transition: all 0.3s ease-in-out;
    }

    .cart-button:hover {
        background-color: #AA60C8;
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(170, 96, 200, 0.3);
    }

    .cart-footer .total-row td {
        font-weight: bold;
        background-color: #D69ADE;
        color: white;
        font-size: 1.2em;
        padding: 14px 10px;
    }

    .order-form {
        margin-top: 30px;
        padding: 20px;
        background-color: #FFDFEF;
        border: 2px solid #D69ADE;
        border-radius: 10px;
    }

    .form-title {
        color: #AA60C8;
        text-align: center;
        font-size: 1.5em;
        margin-bottom: 20px;
    }

    .form-table {
        width: 100%;
        border-spacing: 0;
    }

    .form-table td {
        padding: 10px;
        font-size: 1em;
        color: #AA60C8;
    }

    .form-table td.center {
        text-align: center;
    }

    .form-select {
        width: 100%;
        padding: 10px;
        font-size: 1em;
        border: 1px solid #D69ADE;
        border-radius: 6px;
        background-color: #FFF0FA;
        color: #AA60C8;
    }

    .submit-button {
        background-color: #AA60C8;
        color: #fff;
        padding: 12px 24px;
        font-size: 1.1em;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        background-color: #8C48A8;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(140, 72, 168, 0.4);
    }

    .strong {
        font-weight: bold;
    }

    .menu-item {
        font-size: 1.1em;
        color: #AA60C8;
    }
</style>
