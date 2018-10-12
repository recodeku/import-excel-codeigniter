<html>
<head>
<title>IMPORT EXCEL CI 3</title>
</head>
<body>
<h1>Data Mahasiswa</h1><hr>
<a href="<?php echo base_url("index.php/mahasiswa/form"); ?>">Import Data</a><br><br>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <td>NIM</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Tempat Lahir</td>
            <td>Tanggal Lahir</td>
            <td>Alamat</td>
        </tr>
    </thead>
    <tbody>

    <?php
    if (!empty($mahasiswa)) { // Jika data pada database tidak sama dengan empty (alias ada datanya)
        foreach ($mahasiswa as $row) { ?>
                <tr>
                    <td><?php echo $row->nim; ?></td>
                    <td><?php echo $row->nama; ?></td>
                    <td><?php echo $row->jenis_kelamin; ?></td>
                    <td><?php echo $row->tempat_lahir; ?></td>
                    <td><?php echo $row->tanggal_lahir; ?></td>
                    <td><?php echo $row->alamat; ?></td>
                </tr>
                
            <?php 
        }
    } else { // Jika data tidak ada
        echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
    }
    ?>

    </tbody>

</table>
</body>
</html>
