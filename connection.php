<?php
data_default_timezone_set("Asia/Kuala_Lumpur");

# Mencipta hubungan dengan pangkalan data
$condb = mysqli_connect('localhost','root','');

# Memilih Pangkalan Data
mysqli_select_db($condb,'tempah_makanan'); 

?>

<?php
include('footer.php');
?>

