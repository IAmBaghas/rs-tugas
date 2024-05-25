<!-- Github.com/IAmBaghas -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dokter";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Kd_pasien, Nama_pasien, Tanggal_masuk, Tanggal_keluar, sex, Kd_spesialis FROM tb_pasien";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
  <head>
      <title>RSUD Ciawi</title>
      <style>
        body {
          font-family: arial, sans-serif;
          padding: 0px;
          margin: 0px;
        }
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        p {
          padding-left: 5px;
          padding-right: 5px;
        }
        .navbar {
          height: 40px;
          padding: 10px;
          display: flex;
          justify-content: space-between;
          align-items: center;
          background-color: slategray;
        }

        .navbar div {
          display: flex;
          align-items: center;
        }

        .navbar div form {
          margin-left: 10px;
        }
        a {
          text-decoration: none;
          color: black;
          padding-top: 6px;
        }
        a:hover {
          color: white;
        }
        .booklist {
          padding: 10px;
        }
      </style>
  </head>
  <body>
      <nav>
        <div class="navbar">
          <div>
            <span style='font-weight: bold; font-size: 24px; padding-right: 10px;'>RSUD Ciawi </span>
            <div class="navlist">
              <a href="index.php">Menu</a> |
              <a href="dokter.php">Dokter</a> |
              <a href="admin.php">Admin</a>
            </div>
          </div>
        </div>
      </nav>
      
      <div class="booklist">
      <h2>Daftar Pasien :</h2>
      <?php
      if ($result->num_rows > 0) {
        echo "<table style='width: 100%'>";
        echo "<tr>";
        echo "<th>Kode Pasien</th>";
        echo "<th>Nama</th>";
        echo "<th>Tanggal Masuk</th>";
        echo "<th>Tanggal Keluar</th>";
        echo "<th>Jenis Kelamin</th>";
        echo "<th>Dokter Tujuan</th>";
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td><p style='text-align: center;'>" . $row["Kd_pasien"]. "</p></td>";
          echo "<td><p>" . $row["Nama_pasien"]. "</p></td>";
          echo "<td><p style='text-align: center;'>" . $row["Tanggal_masuk"]. "</p></td>";
          echo "<td><p style='text-align: center;'>Rp " . $row["Tanggal_keluar"]. "</p></td>";
          echo "<td><p style='text-align: center;'>" . $row["sex"]. "</p></td>";
          echo "<td><p style='text-align: center;'>" . $row["Kd_spesialis"]. "</p></td>";
          echo "</tr>";
          // echo "<hr>";
        }
        echo "</table>";
      } else {
        echo "No books found.";
      }
      $conn->close();
      ?>
      </div>
  </body>
</html>
