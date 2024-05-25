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


$sql = "SELECT Kd_dokter, Nama_dokter, Kd_spesialis, telepon, sex FROM tb_dokter";
$result = $conn->query($sql);

$sql5 = "SELECT Nama_pasien, Kd_spesialis, Tanggal_masuk, Tanggal_keluar, Kd_pasien, sex FROM tb_pasien";
$resultPasien = $conn->query($sql5);

// Form Tambah Data Dokter
if (isset($_POST['submit'])) {
  $Kd_dokter = $_POST['Kd_dokter'];
  $Nama_dokter = $_POST['Nama_dokter'];
  $Kd_spesialis = $_POST['Kd_spesialis'];
  $telepon = $_POST['telepon'];
  $sex = $_POST['sex'];

  $sql2 = "INSERT INTO tb_dokter (Kd_dokter, Nama_dokter, Kd_spesialis, telepon, sex) VALUES ('$Kd_dokter', '$Nama_dokter', '$Kd_spesialis', '$telepon', '$sex')";

  if ($conn->query($sql2) === TRUE) {
    echo "Buku Berhasil Ditambahkan";
    sleep(2);
    header("Location: admin.php");
  } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}

// Hapus Data Dokter
if (isset($_POST['delete'])) {
  $Kd_dokter = $_POST['Kd_dokter'];

  $sql3 = "DELETE FROM tb_dokter WHERE Kd_dokter = '$Kd_dokter'";

  if ($conn->query($sql3) === TRUE) {   
    echo "Data Dokter Dihapus";
    sleep(2);
    header("Location: admin.php");
  } else {
    echo "Error: " . $sql3 . "<br>" . $conn->connect_error;
  }
}

// Edit Data Dokter
if (isset($_POST['edit'])) {
  $Kd_dokter = $_POST['Kd_dokter'];
  $Nama_dokter = $_POST['Nama_dokter'];
  $Kd_spesialis = $_POST['Kd_spesialis'];
  $telepon = $_POST['telepon'];
  $sex = $_POST['sex'];

  $sql4 = "UPDATE tb_dokter SET Nama_dokter = '$Nama_dokter', Kd_spesialis = '$Kd_spesialis', telepon = '$telepon', sex = '$sex' WHERE Kd_dokter = '$Kd_dokter'";

  if ($conn->query($sql4) === TRUE) {
    echo "Data Dokter Berhasil Diubah";
    sleep(2);
    header("Location: admin.php");
  } else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
  }
}

// Form Tambah Data Pasien
if (isset($_POST['submitPasien'])) {
  $Kd_pasien = $_POST['Kd_pasien'];
  $Nama_pasien = $_POST['Nama_pasien'];
  $sex = $_POST['sex'];
  $Kd_spesialis = $_POST['Kd_spesialis'];
  $Tanggal_masuk = $_POST['Tanggal_masuk'];
  $Tanggal_keluar = $_POST['Tanggal_keluar'];

  $sql6 = "INSERT INTO tb_pasien (Kd_pasien, Nama_pasien, sex, Kd_spesialis, Tanggal_masuk, Tanggal_keluar) VALUES ('$Kd_pasien', '$Nama_pasien', '$sex', '$Kd_spesialis', '$Tanggal_masuk', '$Tanggal_keluar')";

  if ($conn->query($sql6) === TRUE) {
    echo "Datan Pasien Berhasil Ditambahkan";
    sleep(2);
    header("Location: admin.php");
  } else {
    echo "Error: " . $sql6 . "<br>" . $conn->error;
  }
}

// Hapus Data Pasien
if (isset($_POST['deletePasien'])) {
  $Kd_pasien = $_POST['Kd_pasien'];

  $sql = "DELETE FROM tb_pasien WHERE Kd_pasien = '$Kd_pasien'";

  if ($conn->query($sql) === TRUE) {   
    echo "Data Pasien Dihapus";
    sleep(2);
    header("Location: admin.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->connect_error;
  }
}

// Edit Data Pasien
if (isset($_POST['editPasien'])) {
  $Kd_pasien = $_POST['Kd_pasien'];
  $Nama_pasien = $_POST['Nama_pasien'];
  $sex = $_POST['sex'];
  $Kd_spesialis = $_POST['Kd_spesialis'];
  $Tanggal_masuk = $_POST['Tanggal_masuk'];
  $Tanggal_keluar = $_POST['Tanggal_keluar'];

  $sql8 = "UPDATE tb_pasien SET Nama_pasien = '$Nama_pasien', sex = '$sex', Kd_spesialis = '$Kd_spesialis', Tanggal_masuk = '$Tanggal_masuk', Tanggal_keluar = '$Tanggal_keluar' WHERE Kd_pasien = '$Kd_pasien'";

  if ($conn->query($sql8) === TRUE) {
    echo "Data Pasien Berhasil Diubah";
    sleep(2);
    header("Location: admin.php");
  } else {
    echo "Error: " . $sql8 . "<br>" . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
    <script>
        function showForm() {
            document.getElementById('form').style.display = 'block';
            document.getElementById('main').style.display = 'none';
        }

        function hideForm() {
            document.getElementById('form').style.display = 'none';
            document.getElementById('main').style.display = 'block';
        }

        function showEditForm(Kd_dokter, Nama_dokter, Kd_spesialis, telepon, sex) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('main').style.display = 'none';
            document.getElementById('Kd_dokter').value = Kd_dokter;
            document.getElementById('Nama_dokter').value = Nama_dokter;
            document.getElementById('Kd_spesialis').value = Kd_spesialis;
            document.getElementById('telepon').value = telepon;
            document.getElementById('sex').value = sex;
        }

        function hideEditForm() {
            document.getElementById('editForm').style.display = 'none';
            document.getElementById('main').style.display = 'block';
        }

        function showPasien() {
          document.getElementById('pasien').style.display = 'block';
          document.getElementById('main').style.display = 'none';
        }

        function hidePasien() {
          document.getElementById('pasien').style.display = 'none';
          document.getElementById('main').style.display = 'block';
        }

        function showEditPasien(Kd_pasien, Nama_pasien, Kd_spesialis, sex, Tanggal_masuk, Tanggal_keluar) {
          document.getElementById('editPasien').style.display = 'block';
          document.getElementById('main').style.display = 'none';
          document.getElementById('Kd_pasien').value = Kd_pasien;
          document.getElementById('Nama_pasien').value = Nama_pasien;
          document.getElementById('Kd_spesialis').value = Kd_spesialis;
          document.getElementById('sex').value = sex;
          document.getElementById('Tanggal_masuk').value = Tanggal_masuk;
          document.getElementById('Tanggal_keluar').value = Tanggal_keluar;
        }

        function hideEditPasien() {
          document.getElementById('editPasien').style.display = 'none';
          document.getElementById('main').style.display = 'block';
        }

        function delayRedirect() {
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 2000);
        }
    </script>
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
        .booklist, .listPasien {
          padding: 10px;
        }
        .hapus a:hover {
          color: slategray;
        }
      </style>
  </head>
  <body>
      <nav>
        <div class="navbar">
          <div>
            <span style='font-weight: bold; font-size: 24px; padding-right: 10px;'>RSUD Ciawi</span>
            <div class="navlist">
              <a href="index.php">Menu</a> |
              <a href="dokter.php">Dokter</a> |
              <a href="admin.php">Admin</a>
            </div>
          </div>
        </div>
      </nav>
    
    <div id="main">

      <!-- List Buku -->
      <div class="booklist">
        <h1>Halaman Admin</h1>
        <h2>Data Dokter :</h2>
        <button onclick="showForm()" style='margin-bottom: 5px;'>Tambah Data Dokter</button>
          <?php
          if ($result->num_rows > 0) {
            echo "<table style='width: 100%'>";
            echo "<tr>";
            echo "<th>Kode Dokter</th>";
            echo "<th>Nama Dokter</th>";
            echo "<th>Spesialisasi</th>";
            echo "<th>No Telepon</th>";
            echo "<th>Jenis Kelamin</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td><p style='text-align: center;'>" . $row["Kd_dokter"]. "</p></td>";
              echo "<td><p>" . $row["Nama_dokter"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $row["Kd_spesialis"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $row["telepon"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $row["sex"]. "</p></td>";

              // Delete Button
              echo "<td style='text-align: center;'>";
              echo "<form action='delete.php' method='get'>";
              echo "<input type='hidden' name='Kd_dokter' value='".$row["Kd_dokter"]."'>";
              echo "<button type='submit'>Delete</button>";
              echo "</form>";
              echo "</td>";

              // Edit Button
              echo "<td style='text-align: center;'><button onclick='showEditForm(\"".$row["Kd_dokter"]."\", \"".$row["Nama_dokter"]."\", \"".$row["Kd_spesialis"]."\", \"".$row["telepon"]."\", \"".$row["sex"]."\")'>Edit</button></td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "Tidak ada data ditemukan.";
          }
          ?>
        </div>

        <hr/>

        <!-- List Pasien -->
        <div class='listPasien'>
          <h2>Data Pasien :</h2>
          <button onclick="showPasien()" style='margin-bottom: 5px;'>Tambah Data Pasien</button>
          <?php
          if ($resultPasien->num_rows > 0) {
            echo "<table style='width: 100%'>";
            echo "<tr>";
            echo "<th>Kode Pasien</th>";
            echo "<th>Nama Pasien</th>";
            echo "<th>Dokter Tujuan</th>";
            echo "<th>Jenis Kelamin</th>";
            echo "<th>Tanggal Masuk</th>";
            echo "<th>Tanggal Keluar</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            while($pasien = $resultPasien->fetch_assoc()) {
              echo "<tr>";
              echo "<td><p style='text-align: center;'>" . $pasien["Kd_pasien"]. "</p></td>";
              echo "<td><p>" . $pasien["Nama_pasien"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $pasien["Kd_spesialis"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $pasien["sex"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $pasien["Tanggal_masuk"]. "</p></td>";
              echo "<td><p style='text-align: center;'>" . $pasien["Tanggal_keluar"]. "</p></td>";

              // Delete Button
              echo "<td style='text-align: center;'>";
              echo "<form action='delete.php' method='get'>";
              echo "<input type='hidden' name='Kd_pasien' value='".$pasien["Kd_pasien"]."'>";
              echo "<button type='submit'>Delete</button>";
              echo "</form>";
              echo "</td>";

              // Edit Button
              echo "<td style='text-align: center;'><button onclick='showEditPasien(\"".$pasien["Kd_pasien"]."\", \"".$pasien["Nama_pasien"]."\", \"".$pasien["Kd_spesialis"]."\", \"".$pasien["sex"]."\", \"".$pasien["Tanggal_masuk"]."\", \"".$pasien["Tanggal_keluar"]."\")'>Edit</button></td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "Tidak ada data ditemukan.";
          }
          ?>
        </div>
    </div>

    <!-- Input Data Buku -->
    <div id="form" style="display: none; padding: 10px;">
        <h2>Masukan Detail Buku :</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
          <table>
            <tr>
              <td style='width: 15%; padding: 5px;'>Kode Dokter</td> 
              <td style='width: 25%'><input type="text" name="Kd_dokter" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Nama Dokter</td> 
              <td style='width: 25%'><input type="text" name="Nama_dokter" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Spesialisasi</td> 
              <td style='width: 25%'>
                <select type="text" name="Kd_spesialis" style='width: 98%;'>
                  <option>ANK</option>
                  <option>BDH</option>
                  <option>DLM</option>
                  <option>GIG</option>
                  <option>JTG</option>
                  <option>KDG</option>
                  <option>KLT</option>
                  <option>MAT</option>
                  <option>SRF</option>
                  <option>THT</option>
                  <option>UMM</option>
                </select>
              </td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>No Telepon</td> 
              <td style='width: 25%'><input type="text" name="telepon" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Jenis Kelamin</td> 
              <td style='width: 25%'>
                <select type="text" name="sex" style='width: 98%;'>
                  <option>P</option>
                  <option>W</option>
                </select>
              </td>
            </tr>
          </table>
          <br>
            <input type="submit" name="submit" value="Tambahkan">
            <button type="button" onclick="hideForm()">Cancel</button>
        </form>
    </div>

    <!-- Edit Data Buku -->
    <div id="editForm" style="display: none; padding: 10px;">
        <h2>Edit Data Dokter :</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
          <table>
            <tr>
              <td style='width: 15%; padding: 5px;'>Kode Dokter</td> 
              <td style='width: 25%'><input type='text' id="Kd_dokter" name='Kd_dokter' style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Nama Dokter</td> 
              <td style='width: 25%'><input type="text" id="Nama_dokter" name="Nama_dokter" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Spesialisasi</td> 
              <td style='width: 25%'>
                <select type="text" id="Kd_spesialis" name="Kd_spesialis" style='width: 98%;'>
                  <option>ANK</option>
                  <option>BDH</option>
                  <option>DLM</option>
                  <option>GIG</option>
                  <option>JTG</option>
                  <option>KDG</option>
                  <option>KLT</option>
                  <option>MAT</option>
                  <option>SRF</option>
                  <option>THT</option>
                  <option>UMM</option>
                </select>
              </td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>No Telepon</td> 
              <td style='width: 25%'><input type="text" id="telepon" name="telepon" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Jenis Kelamin</td> 
              <td style='width: 25%'>
                <select type="text" id="sex" name="sex" style='width: 98%;'>
                  <option>P</option>
                  <option>W</option>
                </select>
              </td>
            </tr>
          </table>
          <br>
            <input type="submit" name="edit" value="Edit">
            <button type="button" onclick="hideEditForm()">Cancel</button>
        </form>
    </div>


    <!-- Input Pasien -->
    <div id="pasien" style="display: none; padding: 10px;">
        <h2>Masukan Data Pasien :</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
          <table>
            <tr>
              <td style='width: 15%; padding: 5px;'>Kode Pasien</td> 
              <td style='width: 25%'><input type="text" name="Kd_pasien" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Nama pasien</td> 
              <td style='width: 25%'><input type="text" name="Nama_pasien" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Dokter Tujuan</td> 
              <td style='width: 25%'>
                <select type="text" name="Kd_spesialis" style='width: 98%;'>
                  <option>ANK</option>
                  <option>BDH</option>
                  <option>DLM</option>
                  <option>GIG</option>
                  <option>JTG</option>
                  <option>KDG</option>
                  <option>KLT</option>
                  <option>MAT</option>
                  <option>SRF</option>
                  <option>THT</option>
                  <option>UMM</option>
                </select>
              </td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Jenis Kelamin</td> 
              <td style='width: 25%'>
              <select type="text" name="sex" style='width: 98%;'>
                <option>P</option>
                <option>W</option>
              </select>
              </td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Tanggal Masuk</td> 
              <td style='width: 25%'><input type="date" name="Tanggal_masuk" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Tanggal Keluar</td> 
              <td style='width: 25%'><input type="date" name="Tanggal_keluar" style='width: 98%;'></td>
            </tr>
          </table>
          <br>
            <input type="submit" name="submitPasien" value="Tambahkan">
            <button type="button" onclick="hidePasien()">Cancel</button>
        </form>
    </div>

    <!-- Edit Data Pasien -->
    <div id="editPasien" style="display: none; padding: 10px;">
        <h2>Edit Detail Buku :</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
          <table>
            <tr>
              <td style='width: 15%; padding: 5px;'>Kode Pasien</td> 
              <td style='width: 25%'><input type='text' id="Kd_pasien" name='Kd_pasien' style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Nama Pasien</td> 
              <td style='width: 25%'><input type="text" id="Nama_pasien" name="Nama_pasien" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Dokter Tujuan</td> 
              <td style='width: 25%'><input type="text" id="Kd_spesialis" name="Kd_spesialis" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Jenis Kelamin</td> 
              <td style='width: 25%'><input type="text" id="sex" name="sex" style='width: 98%;'></td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Tanggal Masuk</td> 
              <td style='width: 25%'>
              <select type="text" id="Tanggal_masuk" name="Tanggal_masuk" style='width: 98%;'>
                  <option>ANK</option>
                  <option>BDH</option>
                  <option>DLM</option>
                  <option>GIG</option>
                  <option>JTG</option>
                  <option>KDG</option>
                  <option>KLT</option>
                  <option>MAT</option>
                  <option>SRF</option>
                  <option>THT</option>
                  <option>UMM</option>
              </select>
            </td>
            </tr>
            <tr>
              <td style='width: 15%; padding: 5px;'>Tanggal Keluar</td> 
              <td style='width: 25%'>
                <select type="text" id="Tanggal_keluar" name="Tanggal_keluar" style='width: 98%;'>
                  <option>P</option>
                  <option>W</option>
                </select>
              </td>
            </tr>
          </table>
          <br>
            <input type="submit" name="editPasien" value="Edit">
            <button type="button" onclick="hideEditPasien()">Cancel</button>
        </form>
    </div>

  </body>
</html>
