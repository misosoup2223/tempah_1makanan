<?php
session_start();
include('header.php');
include('connection.php');
include('kawalan-admin.php');
?>
<div id = "saiz">
<div class="pengguna-container">
    <h3 class="page-title">Users list</h3>

    <table class="pengguna-table">
        <tr class="filter-row">
            <td colspan='1'>
                <form action='' method='POST' class="search-form">
                    <input type='text' name='nama' placeholder='Search Users name' class="search-input">
                    <input type='submit' value='Search' class="search-button">
                </form>
            </td>
            <td colspan='4' class="tools-cell">
                | <a href='pengguna-upload.php' class="action-link">Upload workers data</a> |
                <?php include('butang-saiz.php'); ?>
            </td>
        </tr>
        <tr class="table-header">
            <th>Nama</th>
            <th>Phone Number</th>
            <th>Password</th>
            <th>Level</th>
            <th>Action</th>
        </tr>

        <?php
        $tambahan = "";
        if (!empty($_POST['nama'])) {
            $tambahan = " WHERE pengguna.nama LIKE '%" . $_POST['nama'] . "%'";
        }

        $arahan_papar = "SELECT * FROM pengguna $tambahan";
        $laksana = mysqli_query($condb, $arahan_papar);

        while ($m = mysqli_fetch_array($laksana)) {
            echo "<tr class='data-row'>
                <td>{$m['nama']}</td>
                <td>{$m['notel']}</td>
                <td>{$m['katalaluan']}</td>
                <td>{$m['tahap']}</td>
                <td style='text-align:center;'>
                    <a href='pengguna-kemaskini-borang.php?notel={$m['notel']}' class='action-button'>Update</a>
                    <a href='pengguna-padam-proses.php?notel={$m['notel']}' class='action-button' onClick=\"return confirm('Are u sure u wan to erase this data.')\">Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>
</div>

<?php include('footer.php'); ?>

<style>
    body {
        background-color: #FFDFEF;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        color: #AA60C8;
    }

    .pengguna-container {
        padding: 40px 20px;
        min-height: 100vh;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #AA60C8;
        margin-bottom: 30px;
    }

    .pengguna-table {
        width: 90%;
        max-width: 1000px;
        margin: 0 auto;
        border-collapse: collapse;
        border: 1px solid #D69ADE;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(170, 96, 200, 0.2);
    }

    .pengguna-table th,
    .pengguna-table td {
        padding: 15px;
        border: 1px solid #D69ADE;
        font-size: 1em;
        text-align: center;
    }

    .filter-row,
    .table-header {
        background-color: #EABDE6;
    }

    .data-row {
        background-color: #FDEAF8;
    }

    .pengguna-table td:first-child {
        color: #AA60C8;
        font-weight: bold;
    }

    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .search-input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #D69ADE;
        width: 200px;
        font-size: 1em;
    }

    .search-button {
        background-color: #AA60C8;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #8C48A8;
    }

    .action-button {
        background-color: #AA60C8;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease;
        display: inline-block;
        margin: 2px;
    }

    .action-button:hover {
        background-color: #6A1A8D;
    }

    .tools-cell {
        text-align: right;
    }

    .action-link {
        text-decoration: none;
        color: #AA60C8;
        font-weight: bold;
    }

    .action-link:hover {
        color: #6A1A8D;
    }

    @media (max-width: 768px) {
        .pengguna-table {
            font-size: 0.95em;
        }

        .search-form {
            flex-direction: column;
            align-items: flex-start;
        }

        .tools-cell {
            text-align: left;
            padding-top: 10px;
        }
    }
</style>


