<html>
<head>
<title>Form Import</title>

<!-- Load File jquery.min.js yang ada difolder js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
// Sembunyikan alert validasi kosong
$("#kosong").hide();
});
</script>
</head>
<body>
<h3>Form Import</h3>
<hr>

<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
<form method="post" action="<?php echo base_url("index.php/mahasiswa/form"); ?>" enctype="multipart/form-data">
<!-- Buat sebuah input type file class pull-left berfungsi agar file input berada di sebelah kiri-->
<input type="file" name="file">

<!-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import-->
<input type="submit" name="preview" value="Preview">
</form>

<?php
if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form 
    if (isset($upload_error)) { // Jika proses upload gagal
        echo "<div style='color: red;'>" . $upload_error . "</div>"; // Muncul pesan error upload
        die; // stop skrip
    }

// Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='" . base_url("index.php/mahasiswa/import") . "'>";

// Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
</div>";

    echo "<table border='1' cellpadding='8'>
<tr>
<th colspan='6'>Preview Data</th>
</tr>
        <tr>
            <td>NIM</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Tempat Lahir</td>
            <td>Tanggal Lahir</td>
            <td>Alamat</td>
        </tr>";

    $numrow = 1;
    $kosong = 0;

    foreach ($sheet as $row) { 

        $nim = $row['A']; 
        $nama = $row['B']; 
        $jenis_kelamin = $row['C']; 
        $tempat_lahir = $row['D']; 
        $tanggal_lahir = $row['E'];
        $alamat = $row['F'];

// Cek jika semua data tidak diisi
        if (empty($nim) && empty($nama) && empty($jenis_kelamin) && empty($tempat_lahir) && empty($tanggal_lahir) && empty($alamat))
            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

// Cek $numrow apakah lebih dari 1
// Artinya karena baris pertama adalah nama-nama kolom
// Jadi dilewat saja, tidak usah diimport
        if ($numrow > 1) {
// Validasi apakah semua data telah diisi
            $nim_td = (!empty($nim)) ? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
            $nama_td = (!empty($nama)) ? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
            $jk_td = (!empty($jenis_kelamin)) ? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
            $tempat_lahir_td = (!empty($tempat_lahir)) ? "" : " style='background: #E07171;'";
            $tanggal_lahir_td = (!empty($tanggal_lahir)) ? "" : " style='background: #E07171;'";
            $alamat_td = (!empty($alamat)) ? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

// Jika salah satu data ada yang kosong
            if (empty($nim) or empty($nama) or empty($jenis_kelamin) or empty($tempat_lahir) or empty($tanggal_lahir) or empty($alamat)) {
                $kosong++; // Tambah 1 variabel $kosong
            }

            echo "<tr>";
            echo "<td" . $nim_td . ">" . $nim . "</td>";
            echo "<td" . $nama_td . ">" . $nama . "</td>";
            echo "<td" . $jk_td . ">" . $jenis_kelamin . "</td>";
            echo "<td" . $tempat_lahir_td . ">" . $tempat_lahir . "</td>";
            echo "<td" . $tanggal_lahir_td . ">" . $tanggal_lahir . "</td>";
            echo "<td" . $alamat_td . ">" . $alamat . "</td>";
            echo "</tr>";
        }

        $numrow++; // Tambah 1 setiap kali looping
    }

    echo "</table>";

// Cek apakah variabel kosong lebih dari 1
// Jika lebih dari 1, berarti ada data yang masih kosong
    if ($kosong > 1) {
        ?> 
<script>
$(document).ready(function(){
// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
$("#jumlah_kosong").html('<?php echo $kosong; ?>');

$("#kosong").show(); // Munculkan alert validasi kosong
});
</script>
<?php

} else { // Jika semua data sudah diisi
    echo "<hr>";

// Buat sebuah tombol untuk mengimport data ke database
    echo "<button type='submit' name='import'>Import</button>";
    echo "<a href='" . base_url("index.php/mahasiswa") . "'>Cancel</a>";
}

echo "</form>";
}
?>
</body>
</html>
