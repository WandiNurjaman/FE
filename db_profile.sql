-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2024 pada 16.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_profile`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(5) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
('001', 'ahmad', 'kiriseki202', 'kiririse202');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_orang_tua`
--

CREATE TABLE `data_orang_tua` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nik_ayah` varchar(16) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `pendidikan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `nik_ibu` varchar(16) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `pendidikan_ibu` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `penghasilan_ayah` decimal(15,2) NOT NULL,
  `penghasilan_ibu` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_orang_tua`
--

INSERT INTO `data_orang_tua` (`id`, `no_kk`, `nik_ayah`, `nama_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `nik_ibu`, `nama_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ayah`, `penghasilan_ibu`) VALUES
(1, '12', '12', '12', '12', '12', '12', '12', '12', '12', 12.00, 12.00),
(2, 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_sekolah_asal`
--

CREATE TABLE `data_sekolah_asal` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `npsn_sekolah` varchar(8) NOT NULL,
  `status_sekolah` varchar(50) NOT NULL,
  `jenis_sekolah` varchar(50) NOT NULL,
  `no_kip` varchar(20) DEFAULT NULL,
  `no_kis` varchar(20) DEFAULT NULL,
  `pilihan_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_sekolah_asal1`
--

CREATE TABLE `data_sekolah_asal1` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn_sekolah` varchar(50) NOT NULL,
  `status_sekolah` enum('Negeri','Swasta') NOT NULL,
  `jenis_sekolah` varchar(50) NOT NULL,
  `pilihan_jurusan` varchar(50) NOT NULL,
  `upload_foto` varchar(255) NOT NULL,
  `scan_kk` varchar(255) NOT NULL,
  `tanggal_submit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_sekolah_asal1`
--

INSERT INTO `data_sekolah_asal1` (`id`, `nama_sekolah`, `npsn_sekolah`, `status_sekolah`, `jenis_sekolah`, `pilihan_jurusan`, `upload_foto`, `scan_kk`, `tanggal_submit`) VALUES
(1, '121212', '1212', 'Swasta', '1111', 'Akuntansi', 'bg.png', 'image 3.png', '2024-06-21 13:38:59'),
(2, 'aaa', 'aaa', 'Negeri', 'aaa', 'Akuntansi', 'akuntansi.jpg', 'pram1.png', '2024-06-21 13:44:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `jumlah_saudara` int(11) NOT NULL,
  `status_anak` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kab_kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`id`, `nisn`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `anak_ke`, `jumlah_saudara`, `status_anak`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `kab_kota`, `provinsi`) VALUES
(1, 'dd', 'dd', 'dd', 'dd', '2024-06-29', 'L', 0, 0, 'dd', 'dd', 0, 0, 'dd', 'dd', 'dd', 'dd'),
(2, 'aaa', 'aaa', 'aaa', 'aaa', '2024-06-15', 'L', 2, 2, 'aaa', 'aaa', 0, 0, 'aaa', 'aaa', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_orang_tua`
--
ALTER TABLE `data_orang_tua`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_sekolah_asal`
--
ALTER TABLE `data_sekolah_asal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_sekolah_asal1`
--
ALTER TABLE `data_sekolah_asal1`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_orang_tua`
--
ALTER TABLE `data_orang_tua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_sekolah_asal`
--
ALTER TABLE `data_sekolah_asal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_sekolah_asal1`
--
ALTER TABLE `data_sekolah_asal1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
