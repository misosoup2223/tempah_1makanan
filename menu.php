<?php
# Memulakan fungsi session dan memanggil fail header.php
session_start();
include('header.php');
include('connection.php');
$tambahan = [];
$where_clause = "";
// Filter by category
if (!empty($_GET['jenis'])) {
    $id_kategori = mysqli_real_escape_string($condb, $_GET['jenis']);
    $tambahan[] = "id_kategori = '$id_kategori'";
}
// Filter by search
if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($condb, $_GET['search']);
    $tambahan[] = "nama_menu LIKE '%$search%'";
}
// Combine filters
if (!empty($tambahan)) {
    $where_clause = "WHERE " . implode(" AND ", $tambahan);
}
// Final query
$sql = "SELECT * FROM menu $where_clause ORDER BY id_kategori, nama_menu ASC";
$laksana = mysqli_query($condb, $sql);
#mendapatkan data kategori
$sql_kategori = "SELECT * FROM kategori";
$laksana_kategori = mysqli_query($condb,$sql_kategori);
?>
<div class="menu-page">
    <h2 class="menu-title">Our menu choice</h2>
    <div class="category-navigation">
        <a href='menu.php' class="category-link <?php if(empty($_GET['jenis'])) echo 'active'; ?>">All</a>
        <?php while($mm = mysqli_fetch_array($laksana_kategori)){ ?>
        <span class="separator">|</span>
        <a href='menu.php?jenis=<?= $mm['id_kategori'] ?>' class="category-link <?php if(!empty($_GET['jenis']) && $_GET['jenis'] == $mm['id_kategori']) echo 'active'; ?>">
            <?= $mm['kategori_menu'] ?>
        </a>
        <?php } ?>
    </div>
    <form method="GET" action="menu.php" class="search-form">
    <input type="text" name="search" placeholder="Search menu..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Search</button>
</form>
<?php
    if(mysqli_num_rows($laksana) !=0 ){
        echo "<ul class='menu-grid'>";
        while($m=mysqli_fetch_array($laksana)){ ?>
            <li class='menu-item'>
                <div class='menu-image'>
                    <img src='gambar/<?= $m['gambar'] ?>' alt='<?= $m['nama_menu'] ?>'>
                </div>
                <div class='menu-details'>
                    <h3 class='menu-name'><?= $m['nama_menu'] ?></h3>
                    <p class='menu-description'><?= $m['keterangan'] ?></p>
                </div>
                <div class='menu-actions'>
                    <a href='tempah-tambah.php?page=menu&jenis=<?= $m['id_kategori'] ?>&id_menu=<?= $m['id_menu'] ?>' class='add-to-cart-button'>Add to cart</a>
                </div>
            </li>
        <?php }
        echo "</ul>";
    } else {
        echo "<div class='no-menu-message'>";
        echo "<p>This menu is not registered.</p>";
        echo "<p>Please click daownload menu list on top to register menu for this category.</p>";
        echo "</div>";
    } ?>
</div>

<?php include ('footer.php'); ?>

<style>
    body {
        background-color: #FFDFEF;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    .menu-page {
        width: 90%;
        max-width: 1200px;
        margin: 30px auto;
        background-color: #EABDE6;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(170, 96, 200, 0.2);
    }

    .menu-title {
        color: #AA60C8;
        text-align: center;
        font-size: 1.8em;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .category-navigation {
        text-align: center;
        margin-bottom: 30px;
    }

    .category-link {
        display: inline-block;
        padding: 10px 18px;
        margin: 0 8px;
        text-decoration: none;
        color: #AA60C8;
        background-color: #F8EAF7;
        border: 2px solid #D69ADE;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .category-link:hover,
    .category-link.active {
        background-color: #AA60C8;
        color: #fff;
        transform: scale(1.05);
    }

    .separator {
        margin: 0 8px;
        color: #D69ADE;
    }

    .menu-grid {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .menu-item {
        background-color: #FFF5FB;
        border: 2px solid #D69ADE;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(170, 96, 200, 0.2);
    }

    .menu-image {
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }

    .menu-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .menu-details {
        padding: 15px;
        flex-grow: 1;
    }

    .menu-name {
        color: #AA60C8;
        margin: 0;
        font-size: 1.2em;
        font-weight: bold;
    }

    .menu-description {
        color: #5C5470;
        font-size: 0.95em;
        margin-top: 5px;
    }

    .menu-actions {
        padding: 12px 15px;
        text-align: center;
        background-color: #F7E3F8;
        border-top: 1px solid #E0C4ED;
    }

    .add-to-cart-button {
        background-color: #AA60C8;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 8px;
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .add-to-cart-button:hover {
        background-color: #D69ADE;
        transform: scale(1.05);
    }

    .no-menu-message {
        color: #AA60C8;
        text-align: center;
        padding: 20px;
        background-color: #FFE8F3;
        border: 2px dashed #D69ADE;
        border-radius: 10px;
    }
    .search-form {
    text-align: center;
    margin-bottom: 25px;
}

.search-form input[type="text"] {
    padding: 10px 15px;
    width: 280px;
    max-width: 90%;
    border: 2px solid #D69ADE;
    border-radius: 8px;
    font-size: 1em;
    outline: none;
    transition: 0.3s;
}

.search-form input[type="text"]:focus {
    border-color: #AA60C8;
    box-shadow: 0 0 8px rgba(170, 96, 200, 0.3);
}

.search-form button {
    padding: 10px 20px;
    margin-left: 10px;
    background-color: #AA60C8;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-form button:hover {
    background-color: #D69ADE;
}
</style>
