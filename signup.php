<?php
session_start();
include('header.php');
?>
<!-- Signup Form Page -->
<div class="signup-page">
  <div class="signup-container">
    <h3>Signup</h3>
    <p>Please fill in your information</p>

    <form action="" method="POST" class="signup-form">
      <label>Name
        <input required type="text" name="nama">
      </label>

      <label>Phone number
        <input required type="text" name="notel">
      </label>

      <label>Password
        <input required type="password" name="katalaluan">
      </label>

      <input type="submit" value="Register">
    </form>
  </div>
</div>
<?php
# Handle signup form submission
if (!empty($_POST)) {
    include('connection.php');

    $nama = $_POST['nama'];
    $notel = $_POST['notel'];
    $katalaluan = $_POST['katalaluan'];

    if (strlen($notel) > 12) {
        die("<script>
                alert('Phone number must not exceed 12 digits');
                location.href='signup.php';
            </script>");
    }

    if (strlen($notel) < 10) {
        die("<script>
                alert('Phone number must be at least 10 digits');
                location.href='signup.php';
            </script>");
    }

    $sql_semak = "SELECT notel FROM pengguna WHERE notel = '$notel'";
    $laksana_semak = mysqli_query($condb, $sql_semak);
    if (mysqli_num_rows($laksana_semak) == 1) {
        die("<script>
                alert('Phone number is already in use. Please use a different number.');
                location.href='signup.php';
            </script>");
    }
    $sql_simpan = "INSERT INTO pengguna (notel, nama, katalaluan, tahap)
                   VALUES ('$notel','$nama','$katalaluan','PEMBELI')";
    $laksana = mysqli_query($condb, $sql_simpan);

    if ($laksana) {
        echo "<script>
                alert('Registration Successful');
                location.href='login.php';
              </script>";
    } else {
        echo "<p style='color:red;'>Registration Failed</p>";
        echo $sql_simpan . mysqli_error($condb);
    }
}
?>
<?php include('footer.php'); ?>

<!-- Style -->
<style>
body {
  background-color: #FFDFEF;
  min-height: 100vh;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
  color: #4A004A;
  margin: 0;
}

/* Signup Page */
.signup-container {
  max-width: 500px;
  margin: auto;
  background-color: rgb(243, 238, 243);
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(170, 96, 200, 0.2);
}

.signup-container h3 {
  text-align: center;
  color: #AA60C8;
  font-size: 26px;
  margin-bottom: 10px;
}

.signup-container p {
  text-align: center;
  margin-bottom: 25px;
}

.signup-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.signup-form label {
  color: #AA60C8;
  font-weight: 500;
}

.signup-form input[type="text"],
.signup-form input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #D69ADE;
  border-radius: 8px;
  font-size: 14px;
  background-color: #fff;
  color: #4A004A;
}

.signup-form input[type="submit"] {
  background-color: #AA60C8;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  font-size: 16px;
  transition: all 0.3s ease;
}

.signup-form input[type="submit"]:hover {
  background-color: #8C48A8;
  transform: scale(1.05);
}
</style>

