<?php
session_start();
include('header.php');
include('connection.php');
include('kawalan-admin.php');

$tambahan = "";
if (!empty($_POST['nama_menu'])) {
    $tambahan = " AND menu.nama_menu LIKE '%" . $_POST['nama_menu'] . "%'";
}

$arahan_papar = "SELECT * FROM menu, kategori 
WHERE menu.id_kategori = kategori.id_kategori 
$tambahan ORDER BY menu.id_kategori, menu.nama_menu";

$laksana = mysqli_query($condb, $arahan_papar);
?>

<h3 class="page-title">Menu List</h3>

<div id="saiz">
<div class="table-container">
    <table class="menu-table">
        <tr class="filter-row">
            <td colspan='2' class="no-border">
                <form action='' method='POST' class="search-form">
                    <input type='text' name='nama_menu' placeholder='Search Menu' class="search-input">
                    <input type='submit' value='Search' class="search-button">
                </form>
            </td>
            <td colspan='3' class="tools-cell no-border">
                | <a href='menu-daftar.php' class="action-link">Register new menu</a> |
                | <a href='menu-upload.php' class="action-link">Upload new menu</a> |
                <br>
                <?php include('butang-saiz.php'); ?>
            </td>
        </tr>

        <tr class="table-header">
            <th>Picture</th>
            <th>Menu</th>
            <th>Price (RM)</th>
            <th>Category</th>
            <th>Action</th>
        </tr>

        <?php while ($m = mysqli_fetch_array($laksana)): ?>
            <tr class="data-row">
                <td><img src='gambar/<?= $m['gambar'] ?>' width='100%' style='max-width:120px; border-radius:8px;'></td>
                <td><strong class='dark-purple'><?= $m['nama_menu'] ?></strong><br><?= $m['keterangan'] ?></td>
                <td><?= $m['harga'] ?></td>
                <td><?= $m['kategori_menu'] ?></td>
                <td class='no-border'>
                    <div class='action-buttons'>
                        <a href='menu-kemaskini-borang.php?id_menu=<?= $m['id_menu'] ?>' class='btn btn-edit'>Update</a>
                        <a href='menu-padam-proses.php?id_menu=<?= $m['id_menu'] ?>' class='btn btn-delete'
                           onclick="return confirm('Anda pasti anda ingin memadam data ini.')">Delete</a>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
</div>
</div>

<?php include('footer.php'); ?>

<!-- === Updated Styling for Senarai Menu Table === -->
<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
        margin: 0;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        margin: 30px 0;
        color: #AA60C8;
        font-weight: bold;
    }

    .table-container {
        padding: 40px 20px;
        min-height: 100vh;
    }

    .menu-table {
        width: 90%;
        max-width: 1000px;
        margin: 0 auto;
        border-collapse: collapse;
        border: 1px solid #D69ADE;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(170, 96, 200, 0.2);
    }

    .menu-table th,
    .menu-table td {
        padding: 15px;
        border: 1px solid #D69ADE;
        font-size: inherit;
        text-align: center;
    }
    

    .table-header {
        background-color: #EABDE6;
        color: #AA60C8;
        font-weight: bold;
    }

    .filter-row {
        background-color: #EABDE6;
    }

    .data-row {
        background-color: #FDEAF8;
    }

    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
        margin: 10px 0;
    }

    .search-input {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #D69ADE;
        width: 200px;
        font-size: 1em;
    }

    .search-button {
        background-color: #AA60C8;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s ease;
        font-weight: bold;
    }

    .search-button:hover {
        background-color: #8C48A8;
    }

    .tools-cell {
        text-align: right;
        font-size: 0.95em;
        padding: 5px;
        vertical-align: middle;
    }

    .action-link {
        color: #AA60C8;
        font-weight: bold;
        text-decoration: none;
        margin: 0 6px;
    }

    .action-link:hover {
        color: #6A1A8D;
        text-decoration: underline;
    }

    .dark-purple {
        color: #AA60C8;
        font-weight: bold;
        font-size: 1.05em;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 8px 0;
    }

    .btn {
        padding: 10px 16px;
        font-size: 0.95em;
        text-align: center;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        text-decoration: none;
        color: white;
        background-color: #AA60C8;
        transition: 0.3s ease;
    }

    .btn:hover {
        background-color: #8C48A8;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
            align-items: flex-start;
        }

        .tools-cell {
            text-align: left;
        }

        .action-buttons {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>







