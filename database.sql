-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2019 pada 17.21
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhdfarm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '9ae2be73b58b565bce3e47493a56e26a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata`
--

CREATE TABLE `biodata` (
  `idmitra` int(11) NOT NULL,
  `cabang` varchar(12) DEFAULT NULL,
  `ktp` varchar(25) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `tplahir` varchar(45) DEFAULT NULL,
  `tglahir` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `kecamatan` varchar(45) DEFAULT NULL,
  `kelurahan` varchar(45) DEFAULT NULL,
  `tglgabung` varchar(255) DEFAULT NULL,
  `referensi` varchar(255) DEFAULT NULL,
  `Jkmandiri` int(11) NOT NULL,
  `Jkplasma` int(11) NOT NULL,
  `bank` varchar(25) DEFAULT NULL,
  `norek` varchar(25) DEFAULT NULL,
  `anrek` varchar(25) DEFAULT NULL,
  `photo` varchar(12) DEFAULT 'nophoto.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biodata`
--

INSERT INTO `biodata` (`idmitra`, `cabang`, `ktp`, `nama`, `telp`, `tplahir`, `tglahir`, `alamat`, `kota`, `kecamatan`, `kelurahan`, `tglgabung`, `referensi`, `Jkmandiri`, `Jkplasma`, `bank`, `norek`, `anrek`, `photo`) VALUES
(1, 'Palembang', '1671061110860007', 'A Irfan Oktariansyah ', '81367698455', 'Palembang, 11/10/1986', NULL, 'Jl. Swadaya Lr. Perikanan V No.89 Rt.002 Rw.001', 'Palembang', 'Kemuning', 'Talang Aman', NULL, NULL, 1, 0, 'Bri', '0059-01-015599-53-8', 'A. Irfan Oktariansyah', 'nophoto.jpg'),
(2, 'Palembang', NULL, 'A. Zainuri', NULL, NULL, NULL, 'Jalan Demang Lebar Daun Komplek Asrama Haji Lorong Mawar Gang Dahlia Rt:02 Rw: No: 24 ', 'Banyuasin', 'Rantau Bayur', 'Tanjung Pasir', NULL, NULL, 3, 0, NULL, '0002333587', NULL, 'nophoto.jpg'),
(3, 'Palembang', '1671180709780003', 'Abdul Rizal', '0813-6849-9979', 'Tanjung Purung, 7 September 1978', NULL, 'Jl. Lebak Jaya 3, Lr. Jaya 10 Sei Selayur Kalidoni', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 10, 0, 'Bni', '0448687695 BNI', 'Abdul Rizal', 'nophoto.jpg'),
(4, 'Palembang', NULL, 'Novellarose Bessie', '0813-4353-7826wa Sama', 'Palembang,24 November 1991', NULL, 'Jalan Kedelai No. 3 Pusri', 'Palembang', 'Kalidoni', 'Sei Selayur', NULL, NULL, 9, 15, 'Bri', '005901089820505 BRI', 'Novellarose Bessie', 'nophoto.jpg'),
(5, 'Palembang', '1671060902840009', 'Suwardi Gunawan', '0851-0270-4042', 'Palembang, 9 Februari 1984', NULL, 'Jl. Bambang Utoyo Lr. Kerukunan 1 No. 100', 'Palembang ', 'Ilir Timur Ii', 'Duku', NULL, NULL, 2, 0, 'Bca', '1150598571', 'Suwardi Gunawan', 'nophoto.jpg'),
(6, 'Palembang', '1671072304740010', 'Afrianto', '0812-7282-9916', 'Palembang, 23 April 1974', NULL, 'Jl. Brigjen Noesmir Lg Amalia No. 3, Sukabangun, Sukarami', 'Palembang', 'Sukarami', 'Sukabangun', NULL, NULL, 1, 10, 'Bca', '0212241596 BCA', 'Afrianto', 'nophoto.jpg'),
(7, 'Palembang', NULL, 'Afriyanto', NULL, NULL, NULL, 'Sukabangun', 'Palembang', NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(8, 'Palembang', '1205070807960010', 'Agung Arie Anggoro', '0812-9038-7126', 'Sei Dendang, 8/7/1996', NULL, 'Asrama Arhanudri 41/Ss Rt. 001 Rw. 005, Siring Agung, Pakjo', 'Palembang', 'Ilir Barat I', 'Siring Agung', NULL, NULL, 5, 0, 'Bri', '575801007492537', 'Agung Arie Anggoro', 'nophoto.jpg'),
(9, 'Palembang', '1671060604610005', 'Agus Susanto (Ayub Umboyo)', '0812-7111-6169/0812-7397-2034', 'Kediri, 6 April 1961', NULL, 'Jl. Ratu Sianum Komp. Pt Telkom B.16 Rt.005 Rw.001', 'Palembang', 'Ilir Timur 11', 'Sei Buah', NULL, NULL, 8, 0, 'Mandiri', '1120007815298', 'Langsat Pariasi', 'nophoto.jpg'),
(10, 'Palembang', '1671092508800010', 'Agus Waluyo', ' 0821-7954-0398wa Sama', 'Plg, 25 Agustus 1980', NULL, 'Jl.Kebun Bunga Perumbukit Indah Indah Blok H.5 Rt.61/07', 'Palembang', 'Sukarami', 'Kebun Bunga', NULL, NULL, 2, 0, 'Mandiri', '113-00-1160034-7', 'Surani', 'nophoto.jpg'),
(11, 'Palembang', '1671102008900004', 'Agustian Giri Kuncoro', '0821-7568-9253/0812-4911-5583', 'Palembang 20 Agustus 1990', NULL, 'Jl. Iswahyudi No. 051 Rt/Rw. 018/004 ', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 11, 0, 'Mandiri', '112-00135-78542', 'Agustian Giri Kuncoro', 'nophoto.jpg'),
(12, 'Palembang', '1671041804790008', 'Ahmad Afriza', '0812-7941-5303', 'Palembang 18 April 1979', NULL, 'Jl. Tanjung Rawa No. 911, Rt.054 Rw.016, Bukit Lama', 'Palembang', 'Ilir Barat I', 'Bukit Lama', NULL, NULL, 1, 0, 'Sumsel Babel', '1500-165124', 'Rika Apriani Nys', 'nophoto.jpg'),
(13, 'Palembang', '1671130707870003', 'Ahmad Alhafif Juliansyah', '0821-8302-0322', 'Palembang, 7/7/1987', NULL, 'Jl.Kemas Rindo No. 1327 Rt/Rw.025/006 Kel. Kemas Rindo Kec. Kertapati Plg.', 'Palembang', 'Kertapati', 'Kemas Rindo', NULL, NULL, 1, 0, 'Mandiri', '1130012356691', 'Mulya Ningsih', 'nophoto.jpg'),
(14, 'Palembang', NULL, 'Ahmad Efriliansyah', '0852-7905-7575wa Sama', 'Palembang 31 Oktober 1978', NULL, 'Pangkalan Benteng Talang Kelapa Rt. 007 Rw. 003', 'Banyuasin', 'Talang Kelapa', 'Pangkalan Benteng', NULL, NULL, 5, 0, 'Bca ', '8055163576 BCA', 'Ahmad Efriliansyah', 'nophoto.jpg'),
(15, 'Palembang', '1604102810760004', 'Ahmad Fauzan', '0852-7310-4555', 'Palembang, 28/10/1976', NULL, 'Jl. Bay Salim Rt.001 Rw.001 Sekip Jaya', 'Palembang', 'Kemuning', 'Sekip Jaya', NULL, NULL, 1, 0, 'Mandiri', '9000011122281 ', 'Ahmad Fauzan', 'nophoto.jpg'),
(16, 'Palembang', '1671062107800014', 'Ahmad Furqon', '0822-0823-6808', 'Sri Tanjung, 21/7/1980', NULL, 'Jln. Merdeka No. 051 Sritanjung, Tanjg Batu Oi', NULL, NULL, NULL, NULL, NULL, 1, 0, 'Mega Syariah', '2000517288 ', 'Ahmad Furqon', 'nophoto.jpg'),
(17, 'Palembang', '1671060607730014', 'Ahmad Solahudin', '82375564944', 'Palembang, 06/07/1973', NULL, 'Jl. Hikmah Iii Sukorejo ', 'Palembang', 'Ilir Timur Iii', NULL, NULL, NULL, 1, 0, 'Bri', '0059-01-063185-50-3', 'Ahmad Solahudin', 'nophoto.jpg'),
(18, 'Palembang', '1671062812600003', 'Ahmad Taufik Mashabi', '0813-9147-3875', 'Palembang, 28 Desember 1960', NULL, 'Jl. Sutan Syahrir Lr. H Saad Rt.13 Rw.003 ', 'Palembang', 'Ilir Timur Ii', '5 Ilir', NULL, NULL, 2, 0, 'Bni', '0768224882', 'Bpk Taufiq Ahmad Mashabi', 'nophoto.jpg'),
(19, 'Palembang', '1671020711870015', 'Ahmad Zauzi', '0813-7373-3153', 'Palembang, 7 November 1987', NULL, 'Jl.Talang Keramat Griya Keramat Indah 2 Blok L No.2-3', 'Banyuasin', 'Talang Kelapa', 'Talang Keramat', NULL, NULL, 4, 0, 'Bri Syariah', '1007512728 ', 'Ahmad Zauzi', 'nophoto.jpg'),
(20, 'Palembang', NULL, 'Airtas Asnawi', '0813-6716-6744', 'Palembang, 23 Maret 1963', NULL, 'Tanjung Siapi-Api Komp Pdk Blok D-2 Rt.032 Rw.012 ', 'Palembang', 'Sukarami', 'Kebun Bunga', NULL, NULL, 2, 0, 'Bni', '0235964048', 'Bpk. Airtas Asnawi', 'nophoto.jpg'),
(21, 'Palembang', '1671081109600005', 'Akhmad Syafriadi', '0821-7963-3594wa Sama', 'Palembang, ', NULL, 'Komp Griya Sejahtera Blok Mm No. 09 Rt.101 Rw.036', 'Palembang', 'Sako', 'Sako', NULL, NULL, 1, 0, 'Bni', '396934675', 'Akhmad Syafriadi', 'nophoto.jpg'),
(22, 'Palembang', '1671080101470010', 'Amir Husin', '0812-7321-9947', 'Kangkung 1 Januari 1947', NULL, 'Jl. Rustini Gg Ilalang 1 No 50 Rt.001 Rw Kel. Sukamaju Kec. Sako Kenten, Palembang', 'Palembang', 'Sako', 'Suka Maju ', NULL, NULL, 5, 0, 'Cash', 'CASH DARI IBU IRMA', 'Cash', 'nophoto.jpg'),
(23, 'Palembang', '1606030306830005', 'Andi Lala', '0812-7863-3059wa Sama', 'Kerta Jaya, 3 Juni 1983', NULL, 'Jl. Rama Iv No. 31a Rt.001 Rw.001 Alang-Alang Lebar, Maskarebet', 'Palembang', 'Alang-Alang Lebar', 'Alang - Alang Lebar', NULL, NULL, 1, 0, 'Bri', '7751-01-006891-53-0', 'Depi Susarti', 'nophoto.jpg'),
(24, 'Palembang', '1607102808820008', 'Andi Muhammad', '0812-7171-8088', 'Sungsang, 28 Agustus 1982', NULL, 'Talang Persatuan Rt.020 Rw. 010 ', 'Banyuasin', 'Talang Kelpa', 'Sungai Rengit', NULL, NULL, 2, 0, 'Mandiri', '113001005495', 'Andi Muhammad', 'nophoto.jpg'),
(25, 'Palembang', '1671060605780007', 'Andi Rahmansyah', '0811-2900-936', 'Garut, 6 Mei 1978', NULL, 'Jl. Ratu Sianum Lr. Lamggar No.10 Rt/Rw. 038/012 Kel. 3 Ilir Plg', 'Palembang', 'Ilir Timur Ii', '3 Ilir ', NULL, NULL, 1, 0, 'Mandiri', '1120005146977 MANDIRI', 'Andi Rahmansyah', 'nophoto.jpg'),
(26, 'Palembang', '1671012709700002', 'Anhary Arifani', '0822-8154-1916', 'Bukit Tinggi, 27 September 1970', NULL, 'Jl. Rambutan Dalam No. 72 Rt/Rw. 033/011 Kec. 30 Ilir Kec. Ib Ii Kota Palembang', 'Palembang', 'Ilir Barat Ii', '30 Ilir', NULL, NULL, 17, 8, 'Bca', '0212461618', 'Anhary Arifani', 'nophoto.jpg'),
(27, 'Palembang', '1671082203870002', 'Anton', '0853-8290-0745', 'Palembang, 22/3/1987', NULL, 'Jl. H. Najamuddin Lrg. Aguscik No. 344 Rt.04 Rw.002 Sukamaju, Sako', 'Palembang', 'Sako', 'Sukamaju', NULL, NULL, 2, 0, 'Bri', '005901082240500 BRI', 'Anton', 'nophoto.jpg'),
(28, 'Palembang', NULL, 'Antoni', '0812-2856-4347', 'Palembang, 4 Juli 1977', NULL, '-Jl. Bayam Komp. Pusri-Komp. Bukit Bunga Indah P-9 Rt.056 Rw.007 Kel. Kebun Bunga Kec. Sukarami', 'Palembang', 'Sukarami', 'Kebun Bunga', NULL, NULL, 5, 0, 'Mandiri', '1120002103336', 'Antoni', 'nophoto.jpg'),
(29, 'Palembang', '1671071510770004', 'Anwar Sanusi', '0821-8416-6274', 'Tulung Agung 15 Oktober 1977', NULL, 'Jl. Pipa Lr. Mufakat I Rt011 Rw.003', 'Palembang', 'Sukarami', 'Sukajaya', NULL, NULL, 2, 0, 'Bri', '3396-01-040615-53-2', 'Lilin Kartini', 'nophoto.jpg'),
(30, 'Palembang', '1677151703820001', 'Apitria Sugianto', '0812-7178-8280', 'Air Sugihan, 17 Maret 1982', NULL, 'Jl. Swadaya Ii No.2821 Aal ', 'Palembang', 'Alang-Alang Lebar', NULL, NULL, NULL, 2, 0, 'Sumsel Babel ', '8100902330 SUMSEL BABEL', 'Apitria Sugianto', 'nophoto.jpg'),
(31, 'Palembang', '1671092304800007', 'Aptrikal Rahman', '0812-7859-5595sama', 'Palembang 23 April 1980', NULL, 'Jl. Orde Baru No. 1744 Rt.027 Rw.008 Kel. 20 Ilir Ii Palembang', 'Palembang', 'Sako', 'Sukamaju', NULL, NULL, 3, 0, 'Bca', '8555049532', 'Aptrikal Rahman', 'nophoto.jpg'),
(32, 'Palembang', '1603072027910002', 'Arachman Azhari', '0813-6866-1261', 'Lahat, 22 Juli 1991', NULL, 'Komp. Bsi Blok F3 Rt.009 Rw.005 ', 'Palembang', 'Ilir Barat I', 'Bukit Baru', NULL, NULL, 2, 0, 'Bca', '0212894956', 'Archman Azhari', 'nophoto.jpg'),
(33, 'Palembang', '1671102105800007', 'Ari Andisan', '0878-6867-2523', 'Musi Banyuasin, 21 Mei 1980', NULL, 'Kenten Permai Blok C No 23 Rt.019 Rw.004', 'Palembang', 'Kalidoni', 'Bukit Sangkal', NULL, NULL, 1, 0, 'Bni', '0147675557 ', 'Bpk Mustaryono', 'nophoto.jpg'),
(34, 'Palembang', '1671072408880005', 'Ariansyah', '81367740844', 'Palembang, 24/8/1988', NULL, 'Jl. Kebun Bunga Lr. Seroja Ii No.1590', NULL, NULL, NULL, NULL, NULL, 2, 0, 'Bca', '6175130288', 'Masry Kenedy', 'nophoto.jpg'),
(35, 'Palembang', NULL, 'Arie Wibawa', '0812-7253-1383', 'Tanjung Enim, 25 Januari 1987', NULL, 'Jl. Al Barokah Lrg. Embah Salam, Rt.018 Rw.004, Kalidoni', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 3, 0, 'Bni', '0083847143 BNI', 'Arie Wibawa', 'nophoto.jpg'),
(36, 'Palembang', NULL, 'Arli Wahyu', '082307504040/089676296176', NULL, NULL, 'Jl. Masjid Sukamulya Rt 1/1 No. 24 Lr Kuburan Km 10 (Bandra Lama)', 'Palembang', NULL, NULL, NULL, NULL, 1, 0, 'Mandiri', '113-00-1255923-7', 'Eri Apriyani', 'nophoto.jpg'),
(37, 'Palembang', '1671080606820010', 'Arli Wijaya', '0821-6466-6682', 'Kayu Agung, 6 Juni 1982', NULL, 'Jl. Rustini No. 683 Sukamaju Sako', 'Palembang', 'Sako Kenten', 'Suka Maju', NULL, NULL, 2, 0, 'Mandiri', '1060010837675', 'Arli Wijaya', 'nophoto.jpg'),
(38, 'Palembang', '1671080205880012', 'Armitas Rizky', '0853-5751-4488', 'Palembang, 2 Mei 1988', NULL, 'Jl.Air Saleh Komp.Pu No.792 Rt012/005', 'Palembang', 'Sako', 'Sukamau', NULL, NULL, 1, 0, 'Permata', '4123569739', 'Armitias Rizky', 'nophoto.jpg'),
(39, 'Palembang', '1671041407580001', 'Asnawi', '0821-8093-9458', 'Palembang, 14 Juli 1958', NULL, 'Jl. Sungai Sahang No. 83', 'Palembang', 'Ilir Barat 1', 'Lorok Pakjo', NULL, NULL, 1, 0, 'Sumsel Babael', '1500993286 SUMSEL BABEL', 'Asnawi', 'nophoto.jpg'),
(40, 'Palembang', '1671112909880005', 'Bagus Setiawan', '0812-7163-7667', 'Palembang, 29/9/1988', NULL, 'Aspol Bukit Kecil, Blok B No. 11', 'Palembang', 'Bukit Kecil', '26 Ilir', NULL, NULL, 2, 0, 'Bri', '1500-01-000974-50-3', 'Bagus Setiawan', 'nophoto.jpg'),
(41, 'Palembang', '1671062102770006', 'Bakri', '0813-7309-8774', 'Jambi 21 Februari 1977', NULL, 'Jl. Taqwa Perum Puri Pesona Blok E 1 Rt. 010 Rw. 001 Mata Merah', 'Palembang', 'Sematang Borang', 'Karya Mulya', NULL, NULL, 1, 0, 'Sumsel Babel', '17509001224', 'Bakri', 'nophoto.jpg'),
(42, 'Palembang', '1671066509830006', 'Bambang Sahuleka', '0813-7761-0196', 'Palembang, 25/09/1983', NULL, 'Jl. Lirip Sumoharjo Perum  Sekojo Indah Residence Blok A14 Rt.018 Rw.010', 'Palembang', 'Ilir Timur Ii', '2 Ilir', NULL, NULL, 1, 0, 'Bri', '0059-01-068795-50-7', 'Erika Silvia', 'nophoto.jpg'),
(43, 'Palembang', '1671081510860003', 'Bangun Gunadi', '8117301880', 'Palembang, 15 Oktober 1986', NULL, 'Jl.Prajurit Nazarudin Lr.Hidaya Rt.031/001 Srimulya', 'Palembang', 'Samatang Morang', 'Srimulya', NULL, NULL, 1, 0, 'Bni', '741639624', 'Bangun Gunadi', 'nophoto.jpg'),
(44, 'Palembang', NULL, 'Bhakti Yudho Suprapto', '0812-7837-34000', NULL, NULL, 'Jl. Sapta Marga Lr.Kelapa Kampit No. 65 Bukit Sangkal Kalidoni', 'Palembang', 'Kalidoni', 'Bukit Sangkal', NULL, NULL, 1, 0, 'Bni', '0210087631', 'Bpk. Bhakti Yudo Suprapto', 'nophoto.jpg'),
(45, 'Palembang', NULL, 'Brimob Ferli/Dody', '0812-7178-9994', 'Palembang 1/1/1976', NULL, 'Jl. Srijaya Negara Asmob Bukit Besar Blok C No.1 Dang Ss1 Rt.36 Rw.11', 'Palembang', 'Ilir Barat 1', 'Bukit Lama', NULL, NULL, 2, 0, 'Bni', '0558614891', 'Musi Palembang', 'nophoto.jpg'),
(46, 'Palembang', '1671070110810016', 'Daril Amwal', '0813-7100-8811', 'Palembang, 1/10/1981', NULL, 'Jl. Naskah Ii No.773 Rt.046 Rw.013 Sukarami', 'Palembang', 'Sukarami', 'Sekarami', NULL, NULL, 1, 0, 'Mandiri', '9000027699074', 'Daril Amwal', 'nophoto.jpg'),
(47, 'Palembang', '1671040701890005', 'Dean Andhika Ferrari', '0852-6727-7221', 'Palembang, 07/01/1989', NULL, 'Komplek Politehnik No. 45 Rt.041 Rw. 013 ', 'Palembang ', 'Ilir Barat', 'Bukit Lama', NULL, NULL, 1, 0, 'Mandiri', '112-00-1419901-0', 'Dean Andhika Ferrari', 'nophoto.jpg'),
(48, 'Palembang', '1671076010890015', 'Debby Octaria', '0853-6883-1640', '32801', NULL, 'Jl. Tanjung Raya Km.11 Lr. Durian No.1624 Rt.024 Rw.005', 'Palembang', 'Sukamrami', 'Sukodadi', NULL, NULL, 4, 0, 'Bri', '575701014166539', 'Emilisna', 'nophoto.jpg'),
(49, 'Palembang', NULL, 'Dede Mahpuzh', '0852-7356-4086', NULL, NULL, 'Jl. Lintas Timur Komplek Caram Seguguk Permai, Indralaya, Kolam: Jl. Lr. Mazmu Indralaya Utara', 'Indralaya', 'Indra;Laya Utara', NULL, NULL, NULL, 2, 0, 'Bni', '0286029669', 'Sdr Dede Mahpuzh', 'nophoto.jpg'),
(50, 'Palembang', '1671100911800006', 'Dede Setiawan St', '0811-7874-44', 'Muara Enim, 9/11/1980', NULL, 'Jl. R.E Martadinata Lrg. Wiratno Komplek Villa Arafuru Blok D5', NULL, NULL, NULL, NULL, NULL, 3, 0, 'Bri', '7043-01-007439-53-4', 'Dede Setiawan', 'nophoto.jpg'),
(51, 'Palembang', NULL, 'Deden Husmarman, Se', '0812-7883-420', NULL, NULL, 'Jl. Kol. Noeh Macan Lr. Penggawa Kadir No. 26a Rt. 03 Kelurahan Mangunjaya Kecamatan Kota Kayu Agung Kabupaten Ogan Komering Ilir Provinsi Sumatera Selatan Kode Pos 30613', 'Oki', 'Kota Kayu Agung', 'Mangunjaya', NULL, NULL, 3, 0, 'Bri', '003001002992509 BRI', 'Deden Husmarman', 'nophoto.jpg'),
(52, 'Palembang', '1602030609790005', 'Dedi Candra', '0858-9636-7031', 'Pedamaran 6 September 1979', NULL, 'Jl. Demsi Husin No Dusun Iv', 'Oki', 'Pedamaran', 'Pedamaran Vi', NULL, NULL, 11, 0, 'Bri', '563801019294531', 'Roni Adi', 'nophoto.jpg'),
(53, 'Palembang', NULL, 'Dedi Slamet', '0812-3790-9019', NULL, NULL, 'Asrama Batalyon Arhanud 12, Rt.008 Rw.002 Sukoromo, Talang Kelapa/Asrama Arhanud Serong, Km.18', 'Musi Banyuasin', 'Talang Kelapa', 'Sukomo', NULL, NULL, 10, 0, NULL, '575801011705532 BRI', NULL, 'nophoto.jpg'),
(54, 'Palembang', '1603061111920001', 'Dedi Suhendro', '0812-9073-6571', 'Serdang, 11/11/1992', NULL, 'Dusun Ii, Talang-Taling, Gelumbang', 'Muara Enim', 'Gelumbang', 'Talang Taling', NULL, NULL, 8, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(55, 'Palembang', NULL, 'Dedy Widodo', '0812-7341-128', NULL, NULL, 'Lingkungan Iv Rt.029 Rw.008, Betung', 'Musi Banyuasin', 'Betung', NULL, NULL, NULL, 4, 0, NULL, '578401024772539 BRI', NULL, 'nophoto.jpg'),
(56, 'Palembang', NULL, 'Deni Chandra', '0822-3331-1140', NULL, NULL, 'Jl. Swadaya Lr. Flamboyan No. 2042 Rt/Rw.037/011 Kel. Srijaya Kec. Aal Plg.', 'Palembang', 'Alang - Alang Lebar', 'Srijaya', NULL, NULL, 15, 0, 'Bca', '0212825849', 'Yessi', 'nophoto.jpg'),
(57, 'Palembang', '1610121412890002', 'Desri Aryadi', '0821-8271-5475', 'Sungai Pinang, 14/12/1989', NULL, 'Dusun Iii Rt. 06 Desa Sungai Pinang Ii Kec. Sungai Pinang', 'Ogan Ilir', 'Sungai Pinang', 'Sungai Pinang', NULL, NULL, 3, 0, ' Mandiri', '1120013887208', NULL, 'nophoto.jpg'),
(58, 'Palembang', '1603151012740001', 'Destarius ', '0853-6771-5007', 'Sugihan, 10/12/1974', NULL, 'Jl. Super Semar Lr. Kalpataru 1 Rt.34 Rw.7', 'Palembang', 'Kemuning', 'Pipa Reja', NULL, NULL, 1, 3, 'Bni', '083871801', 'Desy Julika', 'nophoto.jpg'),
(59, 'Palembang', NULL, 'Dewi Juniarti', '0812-7760-148', NULL, NULL, 'Jl. Perindustrian Ii No. 96 Sukadamai', 'Palembang', NULL, 'Sukadamai', NULL, NULL, 2, 0, NULL, '1130005906809 MANDIRI', NULL, 'nophoto.jpg'),
(60, 'Palembang', NULL, 'Dewi Yana', NULL, 'Palembang, 27 Januari 1959', NULL, 'Jl.Oga Iv No.112-1250 Rt.020 Rw.005 Lebung Gajah Sematang Borang', 'Palembang', 'Sematang Borang', 'Lebung Gajah', NULL, NULL, 2, 0, 'Sumsel Babel', '175-01-00-223', 'Dewi Yana', 'nophoto.jpg'),
(61, 'Palembang', '1671101310740008', 'Didi Setiono', '0813-1118-9983', 'Palembang, 13 Oktober 1974', NULL, 'Jl. Peltu Kohar No. 56 Rt.023 Rw.005 Kalidoni (Alamat Rumah)', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 1, 0, 'Bni', '0069951060', 'Bpk Didi Setiono', 'nophoto.jpg'),
(62, 'Palembang', '1671082202870005', 'Dipo Febriansyah', '0812-7175-3433', 'Palembang, 22/2/1987', NULL, 'Jalan Mesuji Blok A 16 Rt.18 Rw.05, Ib 1 Demang Lebar Daun', 'Palembang', 'Sako', 'Sako', NULL, NULL, 1, 0, 'Bca', '8570295137', 'Yuli Ayu Lestari', 'nophoto.jpg'),
(63, 'Palembang', '1671022811830008', 'Dodi Hopiansyah', '0821-7970-0710wa Sama', 'Muara Kuang, 28 November 1983', NULL, 'Jl. Wahid Hasyim Lr. Tajur No.768 Kertapati (Alamat Ktp)Jl. Jaya 7 Lr. Lematang Blok D4 Rsh 3 Rt.67 Plaju (Alamat Kolam)', 'Palembang', 'Seberang Ulu Ii', 'Plaju', NULL, NULL, 2, 0, 'Bri', '574901009584535', 'Dodi Hopiansyah', 'nophoto.jpg'),
(64, 'Palembang', '1671102004720000', 'Edi Pramono ', '0812-7885-925', 'Palembang, 20 April 1972', NULL, 'Jl. Taqwa Lr. Iskandar No. 85 Sei Selincah, Kalidoni', 'Palembang', 'Kalidoni', 'Sei Selincah', NULL, NULL, 1, 0, 'Bca', '213079112', 'Edi Pramono', 'nophoto.jpg'),
(65, 'Palembang', '1671030608430006', 'Edo Agustriliasnyah', '0857-6819-9339', 'Palembang, 6 Agustus 1993', NULL, 'Jl. Banten Vi Lr. Masjid Rt. 55 Rw. 2', 'Palembang', 'Seberang Ulu Ii', '16 Ulu', NULL, NULL, 3, 0, 'Mandiri Syariah', '7130239538 ', 'Edo Agustriliansyah', 'nophoto.jpg'),
(66, 'Palembang', '1610036607940003', 'Ejia Putri', '0821-7661-9120', 'Seri Dalam, 26-7-1994', NULL, 'Dusun I Rt.004 Rw.00 Seri Dalam Tanjung Raja', 'Ogan Ilir', 'Tanjung Raja', 'Seri Dalam', NULL, NULL, 5, 0, 'Bri', '564701016300536', 'Ejia Putri', 'nophoto.jpg'),
(67, 'Palembang', NULL, 'Emilisna', '0852-7970-2563', 'Palembang, 18/12/1962', NULL, 'Jl. Tanjung Raya Lr. Durian No. 1624 Sukodadi Sukarami', NULL, 'Sukarami', 'Sukodadi', NULL, NULL, 4, 0, 'Bri', '575701014166539', 'Emilisna', 'nophoto.jpg'),
(68, 'Palembang', NULL, 'Endang', '0822-8251-1899', NULL, NULL, 'Talang Keramat, Palembang', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(69, 'Palembang', NULL, 'Erios Kenedi', '0813-7948-3925', NULL, NULL, 'Griya Sejahtera Blok Ii No.024 Rt/Rw : 100/036 Kel. Sako Kec. Sako Palembang', 'Palembang', 'Sako', 'Sako', NULL, NULL, 1, 0, 'Bri', '576101022928534 ', 'Erios Kenedi', 'nophoto.jpg'),
(70, 'Palembang', '1671091206810000', 'Erwandie', '0813-5162-3987wa Sama', 'Palembang, 12 Juni 1981', NULL, 'Jl. Tombak Bambu Runcing No.681 Rt.08 Sekip Ujung (Ktp)Jl. Amd Lr. Asifah Talang Jambe', 'Palembang', 'Kemuning (Ktp)Sukarame(Kolam)', '20 Ilir Ii (Ktp)Talang Jambe (Kolam)', NULL, NULL, 4, 0, 'Mandiri', '113-00-1318680-8', 'Erwandie', 'nophoto.jpg'),
(71, 'Palembang', '1671143005870003', 'Erwin Ariansyah', '0853-7843-3136', 'Palembang, 30 Mei 1987', NULL, 'Jl. Kopral Paiman Lr. Budiman No. 39-816 Rt.007 Rw.006', 'Palembang', 'Plaju', 'Bagus Kuning', NULL, NULL, 1, 0, 'Mandiri', '11-2-00-11-68-688-3', 'Erwin Ariansyah', 'nophoto.jpg'),
(72, 'Palembang', '1671104107810030', 'Eva Dewi', '0838-0826-664', 'Palembang, 01-07-1981', NULL, 'Jl. Sunarna Rt.017 Rw.003', 'Palembang', 'Sematang Borang', 'Sukamulya', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(73, 'Palembang', '1671031911830006', 'Fadly Yusuf', '0819-2761-9665', 'Palembang, 19 November 1983', NULL, 'Jl. Kapten Robani Kadir Lr. Nurul Huda Rt.20 Rw.05', 'Palembang', 'Plaju', 'Talang Putri', NULL, NULL, 1, 0, 'Bri', '574701024384530', 'Eka Octoviani', 'nophoto.jpg'),
(74, 'Palembang', '1672012609010002', 'Faturrahman Hakim', '081379212104/ 081367604800', 'Curup, 26/09/2001', NULL, 'Jl.Tanjung Barangan Gang Tem/Yang X Blok A No.5 Rt.007 Rw.003 Bukit Baru', 'Palembang', 'Ilir Barat I', 'Bukit Baru', NULL, NULL, 1, 0, 'Sumsel Babel', '80109002302', 'Emildayati Harun', 'nophoto.jpg'),
(75, 'Palembang', '1671040807860011', 'Ferry Adriansyah', '0813-1241-8787', 'Palembang 8 Juni 1986', NULL, 'Jl. Kancil Putih Gg. Bersama 11 Rt.037 Rw.010 ', 'Palembang', 'Ilir Barat 1', 'Demang Lebar Daun', NULL, NULL, 4, 0, 'Bca', '1510575144 BCA', 'Herminda Lussia Sh Mh', 'nophoto.jpg'),
(76, 'Palembang', '1610042502770001', 'Fery Kesuma', '0813-6832-3474/0813-6888-8188', 'Bengkuli 25 Februari 1977', NULL, 'Jl. Kebun Bunga, Km 9, Komp. Bb1 Blok K 12', 'Palembang', 'Sukarame', 'Kebun Bunga', NULL, NULL, 1, 0, 'Bri', '5739-01-014636536', NULL, 'nophoto.jpg'),
(77, 'Palembang', '1603160409870001', 'Firdaus', '0857-8970-5052', 'Petar Dalam, 5 September 1987', NULL, 'Jl. Kol. Sulaiman Amin No. 484 Rt.039 Rw.012', 'Palembang', 'Alang - Alang Lebar', 'Talang Kelapa', NULL, NULL, 2, 0, 'Bca', '0212589860', 'Firdaus', 'nophoto.jpg'),
(78, 'Palembang', NULL, 'Firmansyah Tanjung Batu', '0853-7831-2643', NULL, NULL, 'Dusun Ii Senuro Timur Tanjung Batu', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '564501007768537 BRI', NULL, 'nophoto.jpg'),
(79, 'Palembang', NULL, 'Firmansyah, Se', '0812-7811-3018', NULL, NULL, 'Jl. Kemudi No. 969/ Boster Pdam Samping Punti Kayu', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(80, 'Palembang', '1671063003970005', 'Franky', '0823-7159-9605', 'Palembang, 30 Maret 1997', NULL, 'Jl. Bambang Utoyo Lr. Kerukunan No. 38 Rt.011 Rw.003', 'Palembang', 'Ilir Timur Ii', 'Duku', NULL, NULL, 2, 0, 'Bca', '0450784931', 'Franky', 'nophoto.jpg'),
(81, 'Palembang', '1671115010810000', 'Fuji Astuti, Se', '0813-6847-3305', 'Bengkulu, 10 Oktober 1981', NULL, 'Jl. Tanah Mas Lr. H. Rohidin Rt.41 Rw.02', 'Banyuasin', 'Talang Kelapa', 'Tanah Mas', NULL, NULL, 3, 0, 'Bri', '005901035447509 BRI', 'Fuji Astuti', 'nophoto.jpg'),
(82, 'Palembang', NULL, 'Gumunsang Sinambella', '0812-5203-4471/0813-7758-0840', 'Taput, 16/12/1967', NULL, 'Jl. Ujung Landasan Rt/Rw. 044/010 Kebun Bunga Sukarami', 'Palembang', 'Sukarami', 'Kebun Bunga ', NULL, NULL, 5, 3, 'Bni', '414763939 ', 'Bpk Gumunsang Sinambela', 'nophoto.jpg'),
(83, 'Palembang', '1607101005860004', 'Gunawan Ws', '0853-8082-1005', 'Karang Agung, 10/5/1986', NULL, 'Jl. Swadaya Iv No. 11 Sukajadi Talang Kelapa', NULL, NULL, NULL, NULL, NULL, 1, 0, 'Sumsel Babel', '1690990540', 'Ade Roma Dewi', 'nophoto.jpg'),
(84, 'Palembang', '1671091202680004', 'Gusman Fristian', '0821-7900-9737', 'Palembang, 12/2/1968', NULL, 'Jl. Basuki Rahmat No.18-1565 Rt/Rw. 023/009 Kel. Pahlawana Kec. Kemuning Palembang', 'Palembang', 'Kemuning', 'Pahlawan', NULL, NULL, 3, 0, 'Bri', '704301007470530', 'Gusman Fristian', 'nophoto.jpg'),
(85, 'Palembang', NULL, 'H. Atta', '0821-7752-7481', NULL, NULL, 'Pedamaran', NULL, NULL, NULL, NULL, NULL, 4, 0, 'Bni', '0324592646', 'Bpk Muhammad Hatta', 'nophoto.jpg'),
(86, 'Palembang', '1671091303860003', 'Hadi Markos', '0813-7312-5126', 'Prabumulih, 13/3/1986', NULL, 'Pusri', NULL, NULL, NULL, NULL, NULL, 5, 0, 'Mandiri', '1120510101087', 'Hadi Markos', 'nophoto.jpg'),
(87, 'Palembang', '1671086212950007', 'Hanna Intan Kusuma Dewi', '0822-7110-1177', 'Palembang, 22/12/1995', NULL, 'Jl. Jaya Indah Gg. Melati No. 37 Plaju Palembang', 'Palembang', 'Seberang Ulu Ii', '14 Ulu', NULL, NULL, 1, 0, 'Bca', '8435169445 BCA', 'Hanna Intan Kusuma Dewi', 'nophoto.jpg'),
(88, 'Palembang', '1671101406520004', 'Hardi Manap', '0852-7373-7289', 'Muara Enim, 14/06/1952', NULL, 'Jl. Mayor Abdul Bakrie No. 025 Rt.019 Rw.004, Kalidoni', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 1, 0, 'Bri', '575301008300539 BRI', 'Hardi Manap', 'nophoto.jpg'),
(89, 'Palembang', NULL, 'Hasan Basri', '0813-6730-6681', NULL, NULL, 'Tanjung Batu Inderalaya', NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(90, 'Palembang', NULL, 'Hasbi', '0853-6864-9044', NULL, NULL, 'Jl. Sofian Kenawas Perumahan Patra Sriwijaya Blok Cc.08 Rt. 29/05 Kecamatan Gandus', 'Palembang', 'Gandus', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(91, 'Palembang', '1671086405830005', 'Helmiana Hudalinnisya', '081367064583/ 082282658306', 'Palembang, 24/5/1983', NULL, 'Jl. Lebak Murni Perum. Griya Lebak Murni Blok K No.20 ', 'Palembang', 'Sako', 'Sako', NULL, NULL, 2, 0, 'Bni Syariah', '0191447222', 'Helmiana Hudalinnisya', 'nophoto.jpg'),
(92, 'Palembang', '1671061202680012', 'Hendraswanto', '89615823184', 'Palembang, 12/02/1968', NULL, 'Jl. Sersan Kko Badarudin Lr. Birawa No.1217 Rt.025 Rw.004 Sei Buah', 'Palembang', 'Ilir Timur Ii', 'Sei Buah', NULL, NULL, 2, 0, 'Bri', '0059-01-123618-50-1', 'Hendraswanto', 'nophoto.jpg'),
(93, 'Palembang', '1607100210760002', 'Hendri Adi', '0821-8401-0467', 'Danad Cala, 2/10/1976', NULL, 'Jl. Perum Mega Asri 2 Blok D No.10, Sukajadi Talang Kelapa', 'Palembang', 'Talang Kelapa', 'Sukajadi', NULL, NULL, 4, 0, 'Bri', '217401006341506', 'Hendri Adi', 'nophoto.jpg'),
(94, 'Palembang', NULL, 'Hendro Suwastono', '0811-779-970', NULL, NULL, 'Jl. Kancil I Blok K No 08 Komplek Kedamaian', 'Palembang', NULL, NULL, NULL, NULL, 2, 0, 'Bni', '0072954351', 'Bpk Hendro Suwastono', 'nophoto.jpg'),
(95, 'Palembang', '1672020809850002', 'Hendy Harja, Se', '0813-7366-7172wa Sama', 'Pagar Alam, 8/9/1985', NULL, 'Komp. Griya Sako Permai. Blok Bougenvile 3 No 02 Rt.029 Rw.001, Sako', 'Palembang', 'Sako', 'Sako Poaru', NULL, NULL, 5, 0, 'Mandiri', '112-0013-555-888', 'Hendy Harja', 'nophoto.jpg'),
(96, 'Palembang', '1671125503800008', 'Herawati', '0812-7199-5503', 'Teluk Kijing, 15/3/1980', NULL, 'Jl. Alamsah Ratu Prawiranegara (Musi 2) Rt. 07 Rw. 02 Lrg. Keluarga Kel. Karang Jaya', 'Palembang', 'Gandus', 'Karang Jaya', NULL, NULL, 10, 0, 'Mandiri', '1130005500404 ', 'Herawati', 'nophoto.jpg'),
(97, 'Palembang', NULL, 'Heri Saputra', '0822-8964-0302', NULL, NULL, 'Jl. Jaya 7 Lr. Lematang Rt/Rw : 066/006 Kel. 16 Ulu Kec. Seberang Ulu Ii Palembang', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(98, 'Palembang', NULL, 'Herlinawati/ Sailani', '0813-6884-3017/0812-7857-1238', NULL, NULL, 'Jl. Sutan Syahrir Lr. Mesjid No. 1578 Rt/Rw. 021/004 Kel. 5 Ilir Kec. Ilir Timur Ii Plg', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '9000031326680 BRI', NULL, 'nophoto.jpg'),
(99, 'Palembang', NULL, 'Hermanto', '0853-7816-4677', NULL, NULL, 'Pedamaran', NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(100, 'Palembang', '1671141903860009', 'Heru Pratikno', '0813-7777-0770', 'Palembang, 19 Maret 1986', NULL, 'Lr. Perguruan No.277 Rt.005 Rw.003 ', 'Palembang', 'Plaju', 'Talang Bubuk', NULL, NULL, 1, 0, NULL, '1120004779323 MANDIRI', NULL, 'nophoto.jpg'),
(101, 'Palembang', '1603072906850003', 'Heru Yuniagara Simanungkalit', '82182526058', 'Palembang 29 Juni 1985', NULL, 'Jl.Lettu Karim Kadir.Komp Mitra Permai D 21 Rt.24 Rw.03', 'Palembang ', 'Gandus', 'Karang Jaya', NULL, NULL, 3, 0, 'Bri', '110201002328500', 'Heru Yuniagara', 'nophoto.jpg'),
(102, 'Palembang', '1671080307650005', 'Hidayat', '0853-6773-9963wa Sama', 'Palembang 3 Juli 1965', NULL, 'Jl. Sukarna Suka Mulya Sematang Borang', 'Palembang', 'Sematang Borang', 'Sukamulya', NULL, NULL, 8, 0, 'Bri Syariah', '1036470816', 'Hidayat', 'nophoto.jpg'),
(103, 'Palembang', NULL, 'Horasman Libert Sinaga', '0852-4786-9202', NULL, NULL, 'Asrama Kodim 0402/Oki', 'Oki', 'Kayu Agung', 'Paku', NULL, NULL, 5, 0, 'Bri', '5768-0102-2607-534', 'Horasman Libert Sinaga', 'nophoto.jpg'),
(104, 'Palembang', NULL, 'Humaidi', '0821-8686-2050', NULL, NULL, 'Dusun Ii Rt/Rw.004/000 Kel.Senuro Barat Kec. Tanjung Batu Kab.Ogan Ilir', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(105, 'Palembang', '1607111202880001', 'Husein', '0813-4736-4318', 'Sri Jaya, 4/3/1985', NULL, 'Ds. 1 Desa Srijaya Rt.01 Kec. Rantau Bayur Banyu Asin Sumatera Selatan', 'Banyuasin', 'Rantau Bayur', 'Sri Jaya', NULL, NULL, 4, 0, NULL, '0358767867 BNI', NULL, 'nophoto.jpg'),
(106, 'Palembang', '1671057011640002', 'Ida Nuryani', '0822-6906-6569', 'Palembang, 30/11/1964', NULL, 'Perumahan Bougenvile Blok Cc.16', 'Palembang', NULL, NULL, NULL, NULL, 5, 0, NULL, '1130004301366 MANDIRI', NULL, 'nophoto.jpg'),
(107, 'Palembang', '1671050404780006', 'Ignasius Suryono', '0819-9000-3388', 'Lampung, 8/4/1978', NULL, 'Lr. Nangling No. 579, 15 Ilir Palembang', 'Palembang', NULL, '15 Ilir', NULL, NULL, 2, 0, NULL, '8495006189', NULL, 'nophoto.jpg'),
(108, 'Palembang', '1601140705750004', 'Ilman Jauhari', '0811-7199-15', 'Palembang, 07/05/1975', NULL, 'Jl.Ponorogo', NULL, NULL, 'Sukamaju', NULL, NULL, 0, 0, 'Bni', '231957705', 'Bpk Ilman Jauhari', 'nophoto.jpg'),
(109, 'Palembang', '1671070812770010', 'Ilyas Fahmi', '0813-7369-5228', 'Palembang, 08/12/1977', NULL, 'Jl.Kol.H.Burlian No.2413 Rt.036/011 Karya Baru', 'Palembang', 'Sukarami', 'Aal', NULL, NULL, 8, 7, NULL, '1130005199611 MANDIRI', NULL, 'nophoto.jpg'),
(110, 'Palembang', '1671020511830005', 'Iman Nopensah', '0821-7878-2629', 'Palembang, 5 November 1983', NULL, 'Perum Top Jl.Walet Blok A.14 No.2 Rt.62/17', 'Palembang', 'Seberang Ulu 1 ', '15 Ulu', NULL, NULL, 3, 4, NULL, '8010916633', NULL, 'nophoto.jpg'),
(111, 'Palembang', '1671074108950011', 'Indah Anggraini', '0821-7793-3017', 'Palembang, 1/8/1995', NULL, 'Komp. Sukarame Petra Permai I, Kebun Bunga', NULL, NULL, NULL, NULL, NULL, 5, 0, 'Bca', '0411-31222-3', 'Indah Anggraini', 'nophoto.jpg'),
(112, 'Palembang', NULL, 'Indah Monasyari', '0812-7870-8727', NULL, NULL, 'Jl. Opi Iii Komplek Plamboyan Blok B. 03 Rt.065 Rw.011, 15 Ulu Jakabaring', 'Palembang', 'Jakabaring', '15 Ulu', NULL, NULL, 7, 6, NULL, '574301005514534 BRI', NULL, 'nophoto.jpg'),
(113, 'Palembang', '1671025602980008', 'Indah Valentina', '85891666205', 'Palembang, 16/02/1998', NULL, 'Lr. Abadi No.19966 Rt.041 Rw.012 3/4 Ulu', 'Palembang', 'Seberang Ulu I', '3/4 Ulu', NULL, NULL, 1, 0, 'Bni', '226610851', 'Indah Valentina', 'nophoto.jpg'),
(114, 'Palembang', '1671032903740003', 'Indra Wahyudi', '0858-3200-4538', 'Palembang, 29/03/1974', NULL, 'Jl. Di Panjaitan No. 1390 Rt. 037 Rw. 009 Tangga Takat, Seberang Ulu Ii', 'Palembang', 'Seberang Ulu Ii', 'Tangga Takat', NULL, NULL, 3, 0, 'Cimb Niaga', '7058-7293-2000', 'Indra Wahyudi', 'nophoto.jpg'),
(115, 'Palembang', '1671043010630005', 'Ir. Agus Mulyono', '0812-7482-1963', 'Oki- Terate 3 Oktober 1963', NULL, 'Jl. Puncak Sekuning Lr. H. Abdul Faqih 1 No. 26 Rt.06 Rw.02 Pakjo', 'Palembang', 'Ilir Barat 1', 'Kebun Bunga', NULL, NULL, 5, 0, NULL, '575901002309505 BRI', NULL, 'nophoto.jpg'),
(116, 'Palembang', NULL, 'Ir. Marwan Saragih', '0821-7750-5428', NULL, NULL, 'Kenten Permai Blok M No. 24 Rt.16/Rw.04 Bukit Sangkal Kalidoni Palembang', NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, '034201010791536 BRI', NULL, 'nophoto.jpg'),
(117, 'Palembang', '1671111430370005', 'Ir. Ra. Sri Martini', '0821-8623-9572', NULL, NULL, 'Jl. Kapuran, Jl. Ki Kemas Umar No. 124 Rt. 005 Rw. 002', 'Palembang', 'Bukit Kecil', '22 Ilir', NULL, NULL, 4, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(118, 'Palembang', NULL, 'Ir. Rayon Antonius Ginting', '0812-7812-953', NULL, NULL, 'Jl. Embacang No 129 Rt.58 33 Rw.11', 'Palembang', 'Ilit Barat 2', '30 Ilir', NULL, NULL, 1, 0, 'Bri', '5745-01-013727-53-5', 'Ir. Rayon Antonius Gintin', 'nophoto.jpg'),
(119, 'Palembang', NULL, 'Irham', '0813-7787-5577/0823-7632-1571', NULL, NULL, 'Lrg. Srijaya 8 No. 139 Plaju Ulu', 'Palembang', 'Plaju', NULL, NULL, NULL, 5, 0, NULL, '0213471969', NULL, 'nophoto.jpg'),
(120, 'Palembang', '1671081708620000', 'Iwan Supandi', '0852-6789-1532', 'Krui, Lampung 17 Agustus 1962', NULL, 'Jl. Karya 60, No. 86 Rt. 032 Rw. 004, ', 'Palembang', 'Sematang Borang', 'Srimulya', NULL, NULL, 2, 0, 'Mandiri', '1120002266398', 'Iwan Supandi', 'nophoto.jpg'),
(121, 'Palembang', NULL, 'Jelly Hendro', '0852-6893-9444', NULL, NULL, 'Lr.Kulit Gang Hanim No. 1214', 'Palembang', NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(122, 'Palembang', NULL, 'Jhoni Iskandar', '0821-8417-6867', NULL, NULL, 'Jl. Lebak Jaya Lr. Perdamaian Rt.73 Rw.14 No. 66', 'Palembang ', NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(123, 'Palembang', '1671020908770007', 'Johan Kuswara', '0822-3717-1119', 'Prabumulih, 9/8/1977', NULL, 'Unnamed Road, Harapan, Kec. Pemulutan, Kabupaten Ogan Ilir, Sumatera Selatan 30653', 'Palembang', 'Seberang Ulu I', '5 Ulu', NULL, NULL, 2, 0, 'Bri', '574001011718530', 'Ahmad Dai Robi', 'nophoto.jpg'),
(124, 'Palembang', NULL, 'Joko Mulyono (Mandi Api)', '0812-8482-2522wa Sama', NULL, NULL, 'Jl. Gotong Royong Lr. Abdi No.1905 Rt/Rw.035/010 Kel. Sri Jaya Kec. Aal Plg.', 'Palembang', 'Alang - Alang Lebar', 'Sri Jaya', NULL, NULL, 5, 0, 'Bni', '0320557671 BNI', 'Joko Mulyono', 'nophoto.jpg'),
(125, 'Palembang', NULL, 'Joko Setiawan', '0821-7772-2774', NULL, NULL, 'Jl. Pangeran Ayin, Komp. Kencana Damai Blok B.35', 'Palembang', NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(126, 'Palembang', '1604102706830005', 'Jonzafitra Zarkoni', '0831-7370-9888 (Wa)0813-7357-7199 (Hp)', 'Palembang, 27 Juni 1983', NULL, 'Jl. Srikaton Belakang Akper Griya Srikaton Asri Gg.Serasan 8 Blok E4', 'Lahat', 'Lahat', 'Pagar Agung', NULL, NULL, 4, 0, 'Bri', '575701014166539', 'Emilisna', 'nophoto.jpg'),
(127, 'Palembang', NULL, 'Jumar Fanegar', '0812-7295-3672', NULL, NULL, 'Teluk Kecapi Pemulutan', 'Ogan Ilir', NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(128, 'Palembang', '1671106006710008', 'Juniarsih', '0821-7723-4632', 'Palembang,  20 Juni 1971', NULL, 'Jl.Prajurit Yusuf Rt.24/05', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 1, 0, 'Btn', '0064301560000530', 'Juniarsih', 'nophoto.jpg'),
(129, 'Palembang', '1671095004860006', 'Kartika Aprilia', '82280039801', 'Bandung, 10/04/1986', NULL, 'Jl. Tanjung Pinang, Pinang House 106 Sako Kenten', 'Palembang', 'Kenten', 'Sako', NULL, NULL, 1, 0, 'Bca', '8490002406', 'Kartika Aprilia', 'nophoto.jpg'),
(130, 'Palembang', NULL, 'Khoiriyah/Ardiansyah', '0821-1397-5513/0812-7815-9475', NULL, NULL, 'Jl. Taqwa Mata Merah Lr. Sei Putat Rt.47/07', NULL, NULL, 'Kalidoni', NULL, NULL, 4, 0, 'Bni Syariah', NULL, 'Irma Suryani', 'nophoto.jpg'),
(131, 'Palembang', '1671044205870005', 'Kiki Puspita Sari', '0895-0251-8895', 'Palembang 25 Mei 2019', NULL, 'Lr.Padang Kapas (Perumahan Dosen Poltek)Rt.44', 'Palembang', 'Ilir Barat I', 'Lorok Pakjo', NULL, NULL, 3, 0, 'Bri Syariah', '1004611817', 'Kiki Puspita', 'nophoto.jpg'),
(132, 'Palembang', NULL, 'Kms. M. Amin Khaitami', '0853-6919-1988', NULL, NULL, 'Jl. Ki. Gede Ing Suro 32 Ilir Barat Ii', 'Palembang', 'Ilir Barat Ii', '32 Ilir', NULL, NULL, 6, 0, 'Bca', '3410578696', 'Muhammad Ali Iskandar', 'nophoto.jpg'),
(133, 'Palembang', NULL, 'Kms. M. Ibrahim', '0859-2465-5410', NULL, NULL, 'Jl. Embacang No. 27 Rt.034 Rw.12, 30 Ilir', 'Palembang', NULL, '30 Ilir', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(134, 'Palembang', NULL, 'Lasirin', '0823-7310-4705', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '578801012193533 BRI', NULL, 'nophoto.jpg'),
(135, 'Palembang', NULL, 'Lenny Pahlianti Dwita', '0818-0206-0677', NULL, NULL, 'Jl. Syakyakirti No.81-1771 Mata Merah', 'Palembang', 'Ilir Timur I', '20 Ilir D 1', NULL, NULL, 25, 0, 'Cimb Niaga', '705915951500', 'Lenny Pahlianti Dwita', 'nophoto.jpg'),
(136, 'Palembang', NULL, 'M Imron Hamzah', '0812-7160-6207', NULL, NULL, 'Jl. Tanah Mas Perumahan Bumi Mas Indah Blok E3 No. 11', NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, '1130009956370 MANDIRI', NULL, 'nophoto.jpg'),
(137, 'Palembang', '1671040701900009', 'M Jamaludin', '0895-3361-16690', 'Palembang 7 Januari 1990', NULL, 'Jl. Bukit Baru Rt. 004 Rw. 006 Kecamatan Ilir Barat I No. 53', 'Palembang', 'Ilir Barat I', 'Bukit Baru', NULL, NULL, 2, 0, 'Bni', '0445582708 ', 'Bpk Mohammad Jamaludin', 'nophoto.jpg'),
(138, 'Palembang', '1671050204890004', 'M. Akbar', '0852-6800-4200', 'Palembang, 2/4/1989', NULL, 'Jl. Iswahyudi Lr. Mbah Salam No.137 Kalidoni', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 1, 0, 'Bca', '8570-3696-70', 'Muhammad Akbar', 'nophoto.jpg'),
(139, 'Palembang', '1671041206970007', 'M. Arief Rahman', '0821-8000-5400', 'Palembang, 1997-06-12', NULL, 'Jl. Darmapala No.21-H Rt.050 Rw.015 Bukit Lama', 'Palembang', 'Ilir Barat I', 'Bukit Lama', NULL, NULL, 1, 0, 'Bni', '1120619970', 'M. Arief Rahman', 'nophoto.jpg'),
(140, 'Palembang', NULL, 'M. Fauzi', '0821-7883-1251', NULL, NULL, 'Lorong Depok 4 No. 517 Rt.07/03, Plaju', 'Palembang', NULL, NULL, NULL, NULL, 2, 0, 'Bni', '0323892754 BNI', 'M. Fauzi', 'nophoto.jpg'),
(141, 'Palembang', '1671060904820006', 'M. Khoirun Kurniawan(Aan Satriya)', '0815-3210-1345wa Sama', 'Palembang, 9 April 1982', NULL, 'Jl. R.E Martadinata Lr.Satria No.278 Rt.003', 'Palembang', 'Ilir Timur 2', '2 Ilir', NULL, NULL, 1, 0, 'Mandiri', '112-000-647-1341', 'M. Agus Ridwan', 'nophoto.jpg'),
(142, 'Palembang', NULL, 'M. Nur S. Kom', '0852-7389-9778', NULL, NULL, 'Seduduk Putih', 'Palembang', '8 Ilir', 'Ilir Timur Iii', NULL, NULL, 6, 0, 'Bri', '5744-0100-0460-530', 'Muhammad Nur', 'nophoto.jpg'),
(143, 'Palembang', NULL, 'M. Ridwan', '0813-6767-7103', NULL, NULL, 'Talang Kemang Sentosa Sebrang Ulu Ii', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(144, 'Palembang', NULL, 'M. Saleh, St', '0821-7839-5522', NULL, NULL, 'Jl. Ra Abusama Lr. Keluarga 1, Rt.047 Rw.006, Sukabangun, Sukarumi', 'Palembang', 'Sukarami', 'Sukabangun', NULL, NULL, 5, 0, NULL, '0083968768', NULL, 'nophoto.jpg'),
(145, 'Palembang', NULL, 'M. Tantow', '0852-1515-7093', NULL, NULL, 'Pemukiman Hkti No. 06 Rt.011 Rw.004, Talang Keramat, Talang Kelapa', 'Palembang', 'Talang Kelapa', 'Talang Keramat', NULL, NULL, 1, 0, NULL, '1500107327 SUMSEL BABEL', NULL, 'nophoto.jpg'),
(146, 'Palembang', NULL, 'Maimunah', '0812-7114-6101/0813-6884-3017', NULL, NULL, 'Perum Sukoromo City Blok A Lily No. 18 Talang Kelapa', 'Palembang', 'Talang Kelapa', NULL, NULL, NULL, 2, 0, NULL, '1130004920124 MANDIRI', NULL, 'nophoto.jpg'),
(147, 'Palembang', NULL, 'Makhali', '0', NULL, NULL, 'Desa Permata Baru Inderalaya Utara', NULL, NULL, NULL, NULL, NULL, 5, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(148, 'Palembang', NULL, 'Maramis', '0813-7382-1952', NULL, NULL, 'Perum 3 Putri Kencana Km 14 Blok D No. 4', 'Palembang', NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(149, 'Palembang', NULL, 'Marhaili Sutomo', '0812-7883-294', NULL, NULL, 'Jl. Balap Sepeda Lr. Muhajirin Iii No. 1416 Kel. Lorok Pakjo Kec. Ilir Barat I Palembang', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(150, 'Palembang', '1671020708550005', 'Marwan Ak', '0812-7851-687', NULL, NULL, 'Komp. Atlit Dekranasda Jl. Pinus 1 Blok Ee.3 Jakabaring', 'Palembang', 'Seberang Ulu I', '15 Ulu', NULL, NULL, 0, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(151, 'Palembang', NULL, 'Maulana ', '0815-3262-3771', NULL, NULL, 'Jl. Irigasi Lorong Kiyep Rt. 17 Rw. 03 Kelurahan Sukamulya Kecamatan Sematang Borang', NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, '576101026090537 BRI', NULL, 'nophoto.jpg'),
(152, 'Palembang', '1671101305840005', 'Meidiyanto Hendra', '0', NULL, NULL, 'Komp. Kedamaian Permai Blok A-2 009/ 002 Bukit Sangkal, Kalidoni Palembang', 'Palembang', 'Kalidoni', 'Bukit Sangkal', NULL, NULL, 5, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(153, 'Palembang', NULL, 'Ming-Ming', '0811-7887-229', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(154, 'Palembang', '1671064904900015', 'Monica Aprinda', '0852-6835-9903', 'Sekayu, 09/04/1990', NULL, 'Jl. Mandi Api 10 Dan Jl. Bambang Utoyo Lrg. Kerukunan Iii No.62 Et/Rw. 011/003 Kelurahan Duku Kec. It Iipalembang', 'Palemmbang', 'Iliri Timur Ii', 'Duku', NULL, NULL, 5, 0, 'Bri', '775101005275537 BRI', NULL, 'nophoto.jpg'),
(155, 'Palembang', '1607101204820006', 'Muhammad Aidil', '81373882628', 'Musi Landas, 12/4/1982', NULL, 'Jl.Kemang No.89 Rt.071 Rw.020 Sukajadi,Talang Kelapa', 'Palembang', 'Air Batu', NULL, NULL, NULL, 4, 0, 'Mandiri', '113-00-1270857-8', 'Muhammad Aidil', 'nophoto.jpg'),
(156, 'Palembang', '1671041404940006', 'Muhammad Aidil Fath', '0812-22164817', 'Palembang, 14/4/1994', NULL, 'Perumahan Poli Tehnic No. 13 Bukit Lama', 'Palembang', 'Bukit Lama', 'Ilir Barat I', NULL, NULL, 1, 0, 'Bca', '0213370038', 'Muhammad Aidil Fath', 'nophoto.jpg'),
(157, 'Palembang', NULL, 'Muhammad Ali Iskandar', '0853-6919-1988', NULL, NULL, 'Jl. Ki Gede Ing Suro Rt.036 Rw.003, 32 Ilir, Palembang', 'Palembang', NULL, NULL, NULL, NULL, 2, 0, NULL, '3410578696 BCA', NULL, 'nophoto.jpg'),
(158, 'Palembang', NULL, 'Muhammad Ardiansyah', '0811-1686-933', NULL, NULL, 'Jl. Tanjung Harapan No. 15 Rt.021 Rw.005, Bukit Sangkal, Kalidoni', 'Palembang', 'Kalidoni', 'Bukit Sangkal', NULL, NULL, 3, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(159, 'Palembang', '1671101507830010', 'Muhammad Dani', '0813-6998-1983wa Sama', 'Palembang 15 Juli 2019', NULL, 'Jl. Irigasi Lorong Kiyep  ', 'Palembang', 'Sematang Borang', 'Sukamulya', NULL, NULL, 8, 0, 'Bri', '576101026109530 BRI', 'Muhammad Dani', 'nophoto.jpg'),
(160, 'Palembang', '1610040306820003', 'Muhammad Izwani', '85896506291', '30105', NULL, 'Dusun Iii Rt.005 Rw.003', 'Ogan Ilir', 'Indralaya', 'Sakatiga Seberang', NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(161, 'Palembang', NULL, 'Muhammad Nur, S.Kom', '0852-7389-9778', NULL, NULL, 'Komp. Perwira Seduduk Putih No.17', NULL, NULL, NULL, NULL, NULL, 6, 0, NULL, '574401000460530 BRI', NULL, 'nophoto.jpg'),
(162, 'Palembang', NULL, 'Muhammad Randy', '0812-7676-7693', NULL, NULL, 'Jl. Insp. Marzuki Lr. Batu Haji, No. 31 Siring Agung', 'Palembang', 'Pakjo', 'Siring Agung', NULL, NULL, 2, 0, 'Bri', '5758-01-01213453-0', 'Muhammad Randy', 'nophoto.jpg'),
(163, 'Palembang', '1671082309890004', 'Muhammad Rizal Paripurna', '0813-7366-7466', 'Palembang . 23 September 1984', NULL, 'Jl. Cendrawasih No. 68 Rt.044 Rw. 013, Sialang Sako', 'Palembang', 'Sako', 'Sialang', NULL, NULL, 4, 0, 'Bca', '1510541223', 'Aulia Ratri Wigyaningrum', 'nophoto.jpg'),
(164, 'Palembang', '1671071405910009', 'Muhammad Roberto', '0821-7666-4817', 'Palembang, 14 Mei 1991', NULL, 'Jl. Letnan Darna No. 1, Samping Kodam Sriwijaya, Palembang', 'Palembang', 'Ilir Timur I', '20 Ilir', NULL, NULL, 2, 0, 'Mandiri', '1130012971572', 'Muhammad Roberto', 'nophoto.jpg'),
(165, 'Palembang', '1671030111840003', 'Muhammad Zaid', '0813-7391-1064', 'Palembang, 1/11/1984', NULL, 'Jl. Urip Sumoharjo Lr.Langgar No.1718, 2 Ilir', 'Palembang', 'Ilir Timur Ii', '2 Ilir', NULL, NULL, 1, 0, 'Mandiri', '112-00-0518624-7', 'Muhammad Zaid', 'nophoto.jpg'),
(166, 'Palembang', NULL, 'Muhlisin', '0821-8148-9041', NULL, NULL, 'Dusun Ii Senuro Timur Tanjung Batu', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(167, 'Palembang', '1671092609760005', 'Mukromin', '0813-7365-1111', NULL, NULL, 'Jl. Basuki Rahmat No.1611 Rt.24 Rw.09', 'Palembang', 'Kemuning', 'Pahlawan', NULL, NULL, 0, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(168, 'Palembang', NULL, 'Mulyadi', '0813-6736-9701', NULL, NULL, 'Jl. Sako Raya Lr. Sd Sukamaju No. 619 Rt. 011 Rw. 004 Kel. Sako Baru Kec. Sako Plg', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(169, 'Palembang', NULL, 'Muspan Edison', '0812-7330-078', NULL, NULL, 'Jl. Perintis Kemerdekaan Lr. Produksim No.59', 'Palembang', NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(170, 'Palembang', '1671145505650005', 'Nani Yati', '0813-6762-8868', 'Palembang, 15/5/1965', NULL, 'Jl. Kopral Urip Lr.Sekampung No.52 Rt.02 Rw.01', 'Palembang', 'Plaju', 'Talang Putri', NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(171, 'Palembang', NULL, 'Nasution', '0852-6818-1311', NULL, NULL, 'Desa Srijaya Kec. Rantau Bayur Banyu Asin Sumatera Selatan', NULL, 'Rantau Bayur', NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(172, 'Palembang', NULL, 'Nazri Denta Perdian', '0822-9289-0346/0813-7395-9471', NULL, NULL, 'Indralaya', 'Ogan Ilir', 'Indralaya ', 'Timbangan', NULL, NULL, 3, 0, 'Bri', '3554-01-025954-53-3', 'Nazri Denta Perdian', 'nophoto.jpg'),
(173, 'Palembang', '1602210404900006', 'Nepriyadi ', '82186802627', 'Embacang, 04/03/1989', NULL, 'Dusun Ii Rt.004 Rw.001 Embacang, Mesuji Raya', 'Oki', 'Mesuji Raya', 'Embacang', NULL, NULL, 2, 0, 'Bri', '721701015679537', 'Nepriyadi', 'nophoto.jpg'),
(174, 'Palembang', '1671042403780005', 'Nico  Martin Silalahi', '0823-7748-4337', 'Palembang, 24 Maret 1978', NULL, 'Jl. Insp Marzuki No.37 Rt.004 Rw.001 ', 'Palembang', 'Ilir Barat I', 'Siring Agung', NULL, NULL, 3, 0, 'Mandiri', '112-00-0442727-9', 'Nico Martin Silalahi', 'nophoto.jpg'),
(175, 'Palembang', '1671011906650002', 'Nizarudin', '0812-7750-6049', NULL, NULL, 'Lr. Kedukan Bukit I No.342 Rt.07 Rw.02', 'Palembang', 'Ilir Barat Ii', '32 Ilir', NULL, NULL, 0, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(176, 'Palembang', '1671046608850010', 'Nurma Harida', '0821-8072-7339/0852- 6884-1114', 'Pangkal Pinang, 26/8/1985', NULL, 'Jl. Insp Marzuki Wijaya 1- 509 Rt.003, Rw.002. Siring Dalam. Ilir Barat I', 'Palembang', NULL, NULL, NULL, NULL, 2, 0, 'Bri', '5760-0100-3572-530', 'Henny', 'nophoto.jpg'),
(177, 'Palembang', NULL, 'Octaria Srikandi Permatasari', '0823-7177-1234', NULL, NULL, 'Jl. Puncak Sekuning Lr. H. Abdul Faqih 1 No. 26 Rt. 06 Rw. 02 Pakjo', 'Palembang', 'Pakjo', NULL, NULL, NULL, 2, 0, NULL, '575901008975532', NULL, 'nophoto.jpg'),
(178, 'Palembang', NULL, 'Pifi Yulita', '8127494928', NULL, NULL, 'Komp. Bank Sumsel Blok B-6 Rt.003 Rw.001 Kel. Bukit Lama Kec. Ilir Barat 1 ', 'Palembang', 'Ilir Barat 1 ', 'Bukit Lama', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(179, 'Palembang', NULL, 'Pikes', '0813-7369-4496/0822-6222-2009', NULL, NULL, 'Perum Opi Cluster Almond Blok B.05, Rt/Rw.033/011 15 Ulu Jakabaring', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(180, 'Palembang', '1671031506750007', 'Piter Abdullah Yasin', '0813-6842-5679', '27560', NULL, 'Jl. Kh. Azhari No.511a Tangga Takat Seberang Ulu Ii', 'Palembang', 'Seberang Ulu Ii', 'Tangga Takat', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(181, 'Palembang', '1671042506870004', 'Prima Anggara Putra', '0813-6624-3562', '32014', NULL, 'Jl. Lettu Karim Kadir Komplek Mitra Permai Blok.B No.8 ', 'Palembang', 'Gandus', 'Karang Jaya', NULL, NULL, 1, 0, 'Bca', '0213469077', 'Prima Anggara Putra', 'nophoto.jpg'),
(182, 'Palembang', NULL, 'Puadi Nurdin', '0812-7872-483', NULL, NULL, 'Komp. Pu Jl. Saleh No. 771 Sukamaju', 'Palembang', NULL, 'Sukamaju', NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(183, 'Palembang', NULL, 'Purwadi', '0852-7367-2005', NULL, NULL, 'Indogrosir', NULL, NULL, NULL, NULL, NULL, 11, 0, 'Bni', '(009)0569196620 BNI', NULL, 'nophoto.jpg'),
(184, 'Palembang', '1671102607830000', 'Radikal', '0812-7151-546', 'Palembang, 26 Juli 1983', NULL, 'Jl. Pasundan No. 39 Rt.037 Rw.007 Kalidoni', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 1, 0, 'Mandiri', '1130011240219', 'Radikal', 'nophoto.jpg'),
(185, 'Palembang', NULL, 'Ramdon', '0853-6858-8038', NULL, NULL, 'Jl. Noerdin Pandji, Jl. Sungai Sedapat Lr. Mas Koki', 'Banyuasin', 'Talang Kelapa', 'Talang Buluh', NULL, NULL, 1, 0, 'Cimb Niaga', '704549744500', 'Fansuri Rahman', 'nophoto.jpg'),
(186, 'Palembang', NULL, 'Rangga Suluh', '0878-9774-4165', NULL, NULL, 'Jl. Letnan Yasin No.2912/979', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(187, 'Palembang', '1671081011780007', 'Rani Yugiri', '0821-8245-4744', 'Bandung, 10/11/1978', NULL, 'Jl. Sako Raya No. 627 Rt.011 Rw.004, Sako Baru', NULL, NULL, NULL, NULL, NULL, 5, 0, 'Mandiri', '1130006667079', NULL, 'nophoto.jpg'),
(188, 'Palembang', NULL, 'Rendi Meysah', '0877-3861-9559', NULL, NULL, 'Tj. Dayang Selatan, Inderalaya Selatan', NULL, NULL, NULL, NULL, NULL, 4, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(189, 'Palembang', NULL, 'Reno Edwin Dwi', '0813-7383-1902', NULL, NULL, 'Jl. Talang Keramat Lrg. Bidan Yeni', 'Palembang', NULL, NULL, NULL, NULL, 1, 0, NULL, '220601003337503 BRI', NULL, 'nophoto.jpg'),
(190, 'Palembang', '1611061003850004', 'Reno Hendri', '0813-2404-6626', 'Tebing Tinggi, 10/3/1985', NULL, 'Desa Lampar Barut', 'Empat Lawang', 'Talang Padang', 'Talang Padang', NULL, NULL, 5, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(191, 'Palembang', '1671075204880010', 'Reny', '0819-7786-8000', 'Palembang, 12/4/1988', NULL, 'Jl.Opi Ii Cempaka Ii B.15 Rt.065/011', 'Palembang', 'Seberang Ulu I', '15 Ulu', NULL, NULL, 2, 0, 'Bca', '8490-0963-97', 'Reny', 'nophoto.jpg'),
(192, 'Palembang', NULL, 'Rewis Sinaga', '0813-6622-0360', NULL, NULL, 'Jl. Sejahtera Rimbo Mulyo Rt.21 Rw.008 Talang Betutu', NULL, NULL, NULL, NULL, NULL, 27, 0, NULL, '1191808709', NULL, 'nophoto.jpg'),
(193, 'Palembang', NULL, 'Reza Maulana Rahmad', '0821-7855-3608', NULL, NULL, 'Jl. Kapten Arivai', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '576001009715534 BRI', NULL, 'nophoto.jpg'),
(194, 'Palembang', NULL, 'Reza Yulhansyah', '0813-6174-6411', NULL, NULL, 'Jl. Naskah Ii Perum Griya Naskah Pinang Mas Rt/Rw.012/013 Sukarami Plg.', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, '3261917597', NULL, 'nophoto.jpg'),
(195, 'Palembang', '3275081003870036', 'Rezif Abdila', '0852-1350-0054', 'Jakarta 10 Maret 11987', NULL, 'Jl. Tegal Binangun No.1015 Rt.25/08 Lorong Zeni, Plaju Darat, Plaju - Palembang 30267', 'Palembang', 'Plaju', 'Plaju Darat', NULL, NULL, 1, 0, 'Bca', '8435180678 BCA', 'Rezif Abdila', 'nophoto.jpg'),
(196, 'Palembang', '1671040306860006', 'Ria Ramad Kurniawan', '0852-681-11455', '31566', NULL, 'Jl.Pameswara Macan Tutul No.3102 Rt.003/001', 'Palembang', 'Ilir Barat I', 'Bukit Baru', NULL, NULL, 1, 0, 'Mandiri', '1120006717123', 'Ria Ramad Kurniawan', 'nophoto.jpg'),
(197, 'Palembang', NULL, 'Riko Apriyanto', '0813-6819-2554', NULL, NULL, 'Jl. Pasundan Yuka 1 Perumahan Citra Pesona No. 1b Rt.39 Rw.06 Kel/Kec: Kalidoni. Kolam Jl. Jati No. 9 Komplek Pusri', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 4, 0, NULL, NULL, NULL, 'nophoto.jpg');
INSERT INTO `biodata` (`idmitra`, `cabang`, `ktp`, `nama`, `telp`, `tplahir`, `tglahir`, `alamat`, `kota`, `kecamatan`, `kelurahan`, `tglgabung`, `referensi`, `Jkmandiri`, `Jkplasma`, `bank`, `norek`, `anrek`, `photo`) VALUES
(198, 'Palembang', NULL, 'Ris Paula', '0853-7777-1332', NULL, NULL, 'Jl. Sosial Lr. Lebak Jaya Ii No. 494 Sukabangun', 'Palembang', NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(199, 'Palembang', NULL, 'Rismala Ilmawati, Se', '0857-6415-9778', NULL, NULL, 'Perumnas Talang Kelapa Blok Iv No.9', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(200, 'Palembang', NULL, 'Rivo Ivan Purba', '0811-7888-324', 'Jkarta, 24 Maret 1984', NULL, 'Jl. Alhkmah (Belakang Masjid Al-Hikmah) Yuka', 'Palembang', 'Sako', 'Suka Maju', NULL, NULL, 4, 0, 'Mandiri', '1160-0021-33644', 'Rivo Ivan Purba', 'nophoto.jpg'),
(201, 'Palembang', NULL, 'Rizal', '0812-7366-7466', NULL, NULL, 'Perumnas Kenten', NULL, NULL, NULL, NULL, NULL, 4, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(202, 'Palembang', NULL, 'Rizki Amelia', '0852-6710-5528', NULL, NULL, 'Jl. Talang Buluh No. 56 Rt.15 Rw.03 Sukomoro Talang Kelapa', NULL, NULL, NULL, NULL, NULL, 10, 0, 'Bri', '034201048784503 BRI', 'Rizki Amelia', 'nophoto.jpg'),
(203, 'Palembang', NULL, 'Rubbiyanto', '0853-57220-0012', NULL, NULL, 'Jl. Stm Ub Lr. Kesuma No. 1758a Rt/Rw. 049/006 Kel. Sukajaya Kec. Sukarami Kota Palembang', 'Palembang', 'Sukarami', 'Sukajaya', NULL, NULL, 1, 0, 'Mandiri', '1130006272755', 'Rubiyanto', 'nophoto.jpg'),
(204, 'Palembang', '1671044057200003', 'Rumiati', '0821-8000-9906', 'Sekayu, 01/05/1972', NULL, 'Jl.Letjen H.Alamsyah Rpn Bukit Baru', 'Palembang', 'Ilir Barat I', 'Bukit Baru', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(205, 'Palembang', NULL, 'Rumiaty/Sugeng', '0812-1526-8771', NULL, NULL, 'Jl. Pdam No. 273 Karang Jaya Gandus', 'Palembang', 'Gandus', 'Karang Jaya', NULL, NULL, 5, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(206, 'Palembang', NULL, 'Ruslan', '0821-8451-6254', NULL, NULL, 'Dusun Ii Senuro Timur Tanjung Batu', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(207, 'Palembang', NULL, 'Rusman', '0813-6790-1888', NULL, NULL, 'Jl. Perindustrian Ii, Rt.21 (Belakang Yayasan Al-Kahfi) Km.9', 'Palembang', NULL, NULL, NULL, NULL, 74, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(208, 'Palembang', NULL, 'Safri', '0856-0933-7397', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(209, 'Palembang', '1671011201760002', 'Sahuri', '0813-7353-1044', 'Palembang 19 Januari 1976', NULL, 'Lr. Gelora Gg. Yasin No.1676 Rt.32 Rw.007', 'Palembang', 'Ilur Barat Ii', '32 Ilir', NULL, NULL, 2, 0, 'Bca', '450822604', 'Sahuri', 'nophoto.jpg'),
(210, 'Palembang', NULL, 'Saiful Huda', '0852-6873-8377', NULL, NULL, 'Dusun Iii Seri Dalam Tanjung Raja', 'Ogan Ilir', NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(211, 'Palembang', NULL, 'Salman Al Farizal', '0821-8274-9858', NULL, NULL, 'Komplek Kenten Sejahtera 6 Blok D.15 Talang Keramat', 'Palembang', NULL, NULL, NULL, NULL, 4, 0, NULL, '0506820236 BNI', NULL, 'nophoto.jpg'),
(212, 'Palembang', '1671081303560005', 'Sanusi Bernawi', '0813-6817-4452', 'Campang Tiga, 13 Maret 1956', NULL, 'Komp. Perum Guru, Karya Mulya Sematang Borang', 'Palembang', 'Sematang Borang', 'Karya Mulya', NULL, NULL, 2, 0, 'Bri', '5746-01-019618-53-4', 'Sanusi Bernawi', 'nophoto.jpg'),
(213, 'Palembang', NULL, 'Satria Afriadi Dalamu', '0812-7155-5775/0812-7345-5455', 'Palembang, 23 September 1984', NULL, 'Jl. Darma Bakti (Dekat Kantor Camat Sematang Borang) Kel. Sri Mulya Kec Sematang Borang', 'Palembang', 'Sematang Borang', 'Sri Mulya', NULL, NULL, 2, 0, 'Bri', '005901050434507 BRI', 'Satria Afriadi Dalamu', 'nophoto.jpg'),
(214, 'Palembang', '1602196308890001', 'Sinta', '0812-7777-7264', '32743', NULL, 'Perum Top Type 100a.4/008. Jl. Pangeran Ratu, Jakabaring', 'Palembang', 'Jakabaring', '15 Ulu', NULL, NULL, 5, 0, 'Bri', '117601000162507', 'Sinta', 'nophoto.jpg'),
(215, 'Palembang', '1671036405820005', 'Sisca Herlin', '0812-7163-7383', 'Palembang, 24/5/1982', NULL, 'Jl. Jaya Vii Lr.Lematang No.999 D Rt. 18 Rw.06', 'Palembang', 'Seberang Ulu I', '16 Ulu', NULL, NULL, 10, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(216, 'Palembang', '1671121603960008', 'Sodikul Amzat', '82374391304', 'Palembang, 16 Maret 1996', NULL, 'Jl. Pdam Tirta Musi No.74 Rt.009 Rw. 002 ', 'Palembang', 'Gandus', 'Karang Jaya', NULL, NULL, 2, 0, 'Bri', '7054-01-005300-53-2', 'Sodikul Amzat ', 'nophoto.jpg'),
(217, 'Palembang', NULL, 'Solihin', '0813-7374-6177', NULL, NULL, 'Lk.Iii No.59 Kedaton Rt/Rw : 006/003 Kel. Kedaton Kec. Kayu Agung Oki', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(218, 'Palembang', '1671076005800012', 'Sri Utami Purnawati', '0823-7779-0550', 'Banjanegara 20 Mei 1980', NULL, 'Jl. Swadaya Srijaya Rt.49 Rw. 14 ', 'Palembang', 'Alang - Alang Lebar', 'Srijaya', NULL, NULL, 1, 0, 'Bri', '575801002496536', 'Sri Utami Purnawati', 'nophoto.jpg'),
(219, 'Palembang', NULL, 'Sudarno', '0852-7352-3381', NULL, NULL, 'Jl. Sukawinatan Ponorogo No. 5661 B Rt/Rw.032/007 Kel. Sukajaya Kec. Sukarami Kota Palembang', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(220, 'Palembang', '1671101010620010', 'Suharto', '0812-7313-242', 'Palembang, 10 Oktober 1962', NULL, 'Jl. Famili Ii No. 39 Rt.041 Rw.007', 'Palembang', 'Kalidoni', 'Kalidoni', NULL, NULL, 5, 0, 'Mandiri', '1130002201204 MANDIRI', 'Suharto', 'nophoto.jpg'),
(221, 'Palembang', '1871111209540002', 'Suhirin', '81368655926', 'Palembang, 12/9/1954', NULL, 'Jl. Nuruk Yakin No.1736 Rt.023 Rw. 005 ', 'Palembang', 'Sukarami', 'Sukodadi', NULL, NULL, 2, 0, 'Mandiri', '112-00-0220624-6', 'Alhoiri', 'nophoto.jpg'),
(222, 'Palembang', '1671042105980003', 'Sukres Pratama', '0857-8883-9758 (Hp)0853-8270-6864 (Wa)', 'Palembang, 21 Mei 1998', NULL, 'Jl. Tanjung Bubuk Rt.003 Rw.003, Bukit Baru', 'Palembang', 'Ilir Barat 1', 'Bukit Baru', NULL, NULL, 5, 0, 'Bca', '0213496449', 'Sukres Pratama', 'nophoto.jpg'),
(223, 'Palembang', NULL, 'Sulaiman', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'Bri', '215501006477509 BRI', 'Sulaiman', 'nophoto.jpg'),
(224, 'Palembang', '1602211904790001', 'Sumedi', '82181818124', '29117', NULL, 'Bumi Makmur Rt.002 Rw.002 ', 'Oki', 'Mesuji Raya', 'Bumi Makmur', NULL, NULL, 5, 0, 'Bri', '7217-01-018332-53-2', 'Sumedi', 'nophoto.jpg'),
(225, 'Palembang', NULL, 'Sunarto/Pipin', '0823-0658-0010', NULL, NULL, 'Jl. Solok Kemas Tanah Mas Talang Kelapa', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(226, 'Palembang', NULL, 'Suryani (Lurah)', '0852-6790-9409', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(227, 'Palembang', NULL, 'Susilo ', '0821-8483-8177', NULL, NULL, 'Jl. Karya Jaya Kertapati', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(228, 'Palembang', '1703070205840002', 'Syafri', '0823-0000-9323', 'Karang Anyar I, 2/5/1984', NULL, 'Jl. Sukawinatan, Lorong Generasi 2 No. 85 Rt. 062 Kecamatan Sukajaya', 'Palembang', 'Sukajaya', NULL, NULL, NULL, 4, 0, 'Bni', '849581591', 'Syafri', 'nophoto.jpg'),
(229, 'Palembang', NULL, 'Syailani', '0813-6884-3017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(230, 'Palembang', '1671092104590004', 'Syailendra', '8127341043', '21661', NULL, 'Jl.R.Sukamto Lr.Lelinci No.250 Rt.003/001', 'Palembang', 'Pipareja', 'Pipareja', NULL, NULL, 5, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(231, 'Palembang', '1671082803900008', 'Syamsu Hapi Sucipto', '0813-6817-4452', 'Palembang, 28/3/1990', NULL, 'Komp. Perum Guru, Karya Mulya Sematang Borang', 'Palembang', 'Sematang Borang', 'Karya Mulya', NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(232, 'Palembang', '1671071209610005', 'Syamsul Hamid', '0812-7111-596', 'Babat Toman 12 September 1961', NULL, 'Jl. Halim Lr. Melati Iii No. 1512, Sukadadi, Sukarami', 'Palembang', 'Sukarami', 'Sukadadi', NULL, NULL, 10, 0, 'Bri', '3396-01-0016-7853-1', 'Syamsul Hamid', 'nophoto.jpg'),
(233, 'Palembang', NULL, 'Tavip Pamungkas', '0812-6817-9859/0822-8127-0000', NULL, NULL, 'Komp. Pepabri Blok E. No. 9 Karya Baru Alang-Alang Lebar', 'Palembang', 'Alang-Alang Lebar', 'Karya Baru', NULL, NULL, 3, 0, 'Mandiri', '1120004041070 MANDIRI', 'Tavip Pamungkas', 'nophoto.jpg'),
(234, 'Palembang', NULL, 'Tenny Septine Mn, Se', '0821-7653-3735', NULL, NULL, 'Jl. Bambang Utoyo Rama Kasih I No.959', 'Palembang', NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(235, 'Palembang', '1671071609710000', 'Tony Hendryawan', '0857-6415-9778', 'Kayu Agung 16 September 1971', NULL, 'Perumnas Talang Kelapa Blok Iv No.9 Rt. 28 Rw. 07', 'Palembang', 'Alang - Alang Lebar', 'Talang Kelapa', NULL, NULL, 4, 0, 'Mandiri', '113-0006326817', 'Tony Hendriawan', 'nophoto.jpg'),
(236, 'Palembang', NULL, 'Tri Sisca Sisilia', '0853-6883-1640', NULL, NULL, 'Jl. Tanjung Raya Lr. Durian No. 1624 Sukodadi Sukarami', 'Palembang', 'Sukarami', 'Sukoddadi', NULL, NULL, 4, 0, 'Bri', '575701014166539', 'Emilisna', 'nophoto.jpg'),
(237, 'Palembang', '1671042010830011', 'Usman', '0896-6868-6855', '30609', NULL, 'Jl. Putri Rambut Selako No.55 1493 Rt.016 Rw.007 Bukit Lama', 'Palembang', 'Ilir Barat I', 'Bukit Lama', NULL, NULL, 5, 0, 'Bca', '8055017464', 'Usman', 'nophoto.jpg'),
(238, 'Palembang', NULL, 'Victor Sinaga', '0852-8547-7555', NULL, NULL, 'Jl. Siaran Kenten Sako Dekat Kantor Lurah', 'Palembang', 'Sako', NULL, NULL, NULL, 1, 0, 'Bri', '704301007257534', 'Ratna Juita Girsan', 'nophoto.jpg'),
(239, 'Palembang', '1671160608770001', 'Wahyudi', '0812-7137-1379', NULL, NULL, 'Jl. Kl. Atmaja Sukamulya Sematang Borang', 'Palembang', 'Sematang Borang', 'Sukamulya', NULL, NULL, 8, 0, 'Bri', '5761-0102-6108-534', 'Wahyudi', 'nophoto.jpg'),
(240, 'Palembang', '1671063001700018', 'Waluyo, S.Pd', '0813-5068-3378', 'Plaju, 30 Januari 1970', NULL, 'Jl. Seduduk Putih 1 No. 89 Rt. 27 Rw.07 It Ii', 'Palembang', 'Ilir Timur Ii', '8 Ilir', NULL, NULL, 1, 0, 'Mandiri', '900-00-3120801-1', 'Waluyo', 'nophoto.jpg'),
(241, 'Palembang', NULL, 'Willarossi Muljaya', '0823-2687-3333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'Bni', '0312691095 BNI', 'Bpk Willarosi Muljaya', 'nophoto.jpg'),
(242, 'Palembang', NULL, 'Wiwin Kurniawan', '0856-6493-6663', NULL, NULL, 'Komp. Griya Buana Indah Ii Blok M7 Sukajaya Sukabangun Sukarami', 'Palembang', 'Sukarami', 'Sukabangun', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(243, 'Palembang', NULL, 'Yakkub', '0823-8006-1702', NULL, NULL, 'Dusun Ii Rt/Rw. 004/000 Kel. Senuro Barat Kec. Tanjung Batu Kab. Ogan Ilir', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(244, 'Palembang', NULL, 'Yanti', '0813-6736-8701', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'Bni', '0794912808', 'Gella Patricia Putri', 'nophoto.jpg'),
(245, 'Palembang', '1671070105860008', 'Youri Malbi Putra', '85377752126', 'Palembnagn, 1 Mei 1986', NULL, 'Perumahan Victoria Park Blok A,1 Rt.059 Rw.001 ', 'Palembang', 'Sukarami', 'Kebun Bunga', NULL, NULL, 2, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(246, 'Palembang', NULL, 'Yuliardi', '0813-6660-6362', NULL, NULL, 'Jl.Kl. Anwar Mangku Talang Kemang Rt/Rw.019/005 Kel.Sentosa Kec.Sebrang Ulu Ii Palembang', 'Palembang', 'Seberang Ulu 1', 'Sentosa', NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg'),
(247, 'Palembang', NULL, 'Yusuf Wibisono', '0812-7843-0208', NULL, NULL, 'Sekip Ujung Lr. Bening Sari Rt.10 No.956 (Deket Rs. Hermina)', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 'nophoto.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deleteduser`
--

CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `sender`, `reciver`, `title`, `feedbackdata`, `attachment`) VALUES
(19, 'belajar.yok@gmail.com', 'Admin', 'Cepet Dong', 'Kalo bayar itu yang cepet dong', ' ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notification`
--

INSERT INTO `notification` (`id`, `notiuser`, `notireciver`, `notitype`, `time`) VALUES
(18, 'belajar.yok@gmail.com', 'Admin', 'Create Account', '2019-11-24 15:07:03'),
(19, 'belajar.yok@gmail.com', 'Admin', 'Create Account', '2019-11-24 15:13:46'),
(20, 'belajar.yok@gmail.com', 'Admin', 'Send Feedback', '2019-11-24 16:03:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `cabang` varchar(30) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kelurahan` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'nophoto.jpg',
  `status` int(10) NOT NULL,
  `referensi` varchar(30) NOT NULL DEFAULT 'Facebook',
  `ban` varchar(15) NOT NULL,
  `norek` varchar(15) NOT NULL,
  `anrek` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `cabang`, `ktp`, `name`, `alamat`, `kota`, `kecamatan`, `kelurahan`, `email`, `password`, `gender`, `mobile`, `designation`, `image`, `status`, `referensi`, `ban`, `norek`, `anrek`) VALUES
(21, '', '', 'Ikan', '', '', '', '', 'belajar.yok@gmail.com', '202cb962ac59075b964b07152d234b70', 'Male', '123545646456', 'Popo', 'header-dhd.png', 1, 'Facebook', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`idmitra`) USING BTREE,
  ADD UNIQUE KEY `idunik` (`idmitra`) USING BTREE,
  ADD KEY `Jkplasma_index` (`Jkplasma`);

--
-- Indeks untuk tabel `deleteduser`
--
ALTER TABLE `deleteduser`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `biodata`
--
ALTER TABLE `biodata`
  MODIFY `idmitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT untuk tabel `deleteduser`
--
ALTER TABLE `deleteduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
