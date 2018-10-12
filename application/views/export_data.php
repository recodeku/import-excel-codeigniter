<?php
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xlsx");

header("Pragma: no-cache");

header("Expires: 0");
?>

<table border="1" width="100%">
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
        <?php foreach ($mahasiswa as $row) { ?>
            <tr>
                <td><?php echo $row->nim;?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->jenis_kelamin; ?></td>
                <td><?php echo $row->tempat_lahir; ?></td>
                <td><?php echo $row->tanggal_lahir; ?></td>
                <td><?php echo $row->alamat; ?></td>
            </tr>
            
        <?php } ?>
    </tbody>

</table>