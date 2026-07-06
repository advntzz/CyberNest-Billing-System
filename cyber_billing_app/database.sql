CREATE DATABASE IF NOT EXISTS cyber_billing_db;
USE cyber_billing_db;

CREATE TABLE IF NOT EXISTS pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS komputer (
    id_komputer INT AUTO_INCREMENT PRIMARY KEY,
    kode_pc VARCHAR(20) NOT NULL UNIQUE,
    spesifikasi TEXT NOT NULL,
    status ENUM('Tersedia','Dipakai','Maintenance') DEFAULT 'Tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS sesi_billing (
    id_sesi INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT NOT NULL,
    id_komputer INT NOT NULL,
    waktu_mulai DATETIME NOT NULL,
    durasi_jam DECIMAL(5,2) NOT NULL,
    tarif_per_jam DECIMAL(12,2) NOT NULL,
    total_bayar DECIMAL(12,2) NOT NULL,
    status_bayar ENUM('Lunas','Belum Lunas') DEFAULT 'Belum Lunas',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
    FOREIGN KEY (id_komputer) REFERENCES komputer(id_komputer) ON DELETE CASCADE
);

INSERT INTO pelanggan (nama, no_hp, alamat) VALUES
('Dom', '081234567890', 'Yogyakarta'),
('Raka', '081298765432', 'Sleman'),
('Adit', '082233445566', 'Bantul');

INSERT INTO komputer (kode_pc, spesifikasi, status) VALUES
('PC-01', 'Ryzen 5, RAM 16GB, GTX 1660, Monitor 144Hz', 'Tersedia'),
('PC-02', 'Intel i5, RAM 16GB, RTX 2060, Monitor 144Hz', 'Tersedia'),
('PC-03', 'Ryzen 7, RAM 32GB, RTX 3060, Monitor 165Hz', 'Maintenance'),
('PC-04', 'Intel i7, RAM 16GB, RTX 3060 Ti, Monitor 165Hz', 'Tersedia');
