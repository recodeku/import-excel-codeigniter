CREATE TABLE `mahasiswa` ( 
    `id` int(10) NOT NULL AUTO_INCREMENT,  
    `nim` varchar(15) NOT NULL,  
    `nama` varchar(30) NOT NULL,  
    `jenis_kelamin` enum('PRIA','WANITA') NOT NULL,  
    `tempat_lahir` varchar(50) NOT NULL,  
    `tanggal_lahir` date NOT NULL,  
    `alamat` varchar(100) NOT NULL,  
    PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
