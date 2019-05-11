-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2019 pada 10.17
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vif-validation-dev`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `acceess_group`
--

CREATE TABLE `acceess_group` (
  `GROUP_ID` decimal(10,0) NOT NULL,
  `ACCESS_ID` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `acceess_groups`
--

CREATE TABLE `acceess_groups` (
  `GROUP_ID` decimal(8,0) NOT NULL,
  `ACCESS_ID` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `access`
--

CREATE TABLE `access` (
  `ACCESS_ID` decimal(8,0) NOT NULL,
  `ACCESS_TITLE` varchar(50) DEFAULT NULL,
  `ACCESS_ICON` varchar(50) DEFAULT NULL,
  `ACCESS_URL` varchar(50) DEFAULT NULL,
  `ACCESS_INDEX` decimal(8,0) DEFAULT NULL,
  `PARENT_ID` varchar(50) DEFAULT NULL,
  `ENABLE_ACCESS` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `branch`
--

CREATE TABLE `branch` (
  `ID_BRANCH` decimal(8,0) NOT NULL,
  `BRANCH_TITLE` varchar(50) DEFAULT NULL,
  `BRANCH_LOCATION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `DETAIL_ID` decimal(8,0) NOT NULL,
  `FORM_ID` decimal(8,0) DEFAULT NULL,
  `CODE` varchar(1024) DEFAULT NULL,
  `DESCRIPTON` text,
  `AMOUNT` decimal(15,0) DEFAULT NULL,
  `USE_DATE` datetime DEFAULT NULL,
  `DETAIL_CREATED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `emlployee`
--

CREATE TABLE `emlployee` (
  `EMPLOOYEEID` decimal(8,0) NOT NULL,
  `USER_ID` decimal(8,0) DEFAULT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `IMAGE` text,
  `POSITION` decimal(8,0) DEFAULT NULL,
  `BRANCH` decimal(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emlployee`
--

INSERT INTO `emlployee` (`EMPLOOYEEID`, `USER_ID`, `NAME`, `IMAGE`, `POSITION`, `BRANCH`) VALUES
('1', NULL, 'Arya', 'dummy.jpg', '1', '2'),
('2', NULL, 'Santo', 'dummy.jpg', '1', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `form`
--

CREATE TABLE `form` (
  `FORM_ID` decimal(8,0) NOT NULL,
  `USER_ID` decimal(8,0) DEFAULT NULL,
  `SUBJECT` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  `CURRENCY` decimal(8,0) DEFAULT NULL,
  `AMOUNT_IN_WORD` decimal(8,0) DEFAULT NULL,
  `BANK` varchar(50) DEFAULT NULL,
  `ACCOUNT_NUMBER` varchar(50) DEFAULT NULL,
  `ACCOUNT_NAME` varchar(50) DEFAULT NULL,
  `STAGE` decimal(8,0) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `MODIFIED_DATE` datetime DEFAULT NULL,
  `CREATE_FOR_BRANCH` decimal(8,0) DEFAULT NULL,
  `TOTAL_AMOUNT` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `GROUP_ID` decimal(8,0) NOT NULL,
  `GROUP_TITLE` varchar(50) DEFAULT NULL,
  `ENABLE_GROUP` tinyint(1) DEFAULT NULL,
  `GROUP_INDEX` decimal(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups_branch`
--

CREATE TABLE `groups_branch` (
  `ID_BRANCH` decimal(8,0) NOT NULL,
  `GROUP_ID` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `HISTORY_ID` decimal(8,0) NOT NULL,
  `FORM_ID` decimal(8,0) DEFAULT NULL,
  `HISTORY_STATUS` varchar(20) DEFAULT NULL,
  `HISTORY_NOTES` text,
  `APPROVER` decimal(8,0) DEFAULT NULL,
  `FORWARD_TO` decimal(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'apikey-validation', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `LOG_ID` decimal(8,0) NOT NULL,
  `LOG_ACTION` varchar(50) DEFAULT NULL,
  `LOG_STATUS` tinyint(1) DEFAULT NULL,
  `LOG_MESSAGE` text,
  `LOG_IPADDRESS` varchar(50) DEFAULT NULL,
  `LOG_USER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_status`
--

CREATE TABLE `master_status` (
  `STATUS_ID` decimal(8,0) NOT NULL,
  `TEXT` varchar(100) DEFAULT NULL,
  `VALUE` varchar(100) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
--

CREATE TABLE `session` (
  `USER_ID` decimal(8,0) DEFAULT NULL,
  `SESSION_ID` decimal(8,0) DEFAULT NULL,
  `SESSION_USER` varchar(50) DEFAULT NULL,
  `SESSION_STATUS` tinyint(1) DEFAULT NULL,
  `SESSION_MASSAGE` text,
  `SESSION_IPADDRESS` varchar(50) DEFAULT NULL,
  `SESSION_TOKEN` varchar(50) DEFAULT NULL,
  `SESSION_EXPIRED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `USER_ID` decimal(8,0) NOT NULL,
  `EMPLOOYEEID` decimal(8,0) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `ENABLE_USER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`USER_ID`, `EMPLOOYEEID`, `EMAIL`, `PASSWORD`, `ENABLE_USER`) VALUES
('1', '1', 'aryabayu23@gmail.com', '7ce01cec918125efad4603ba57a5be993bc44181', 1),
('2', '2', 'santo@gmail.com', '65f8a7483392475f6ebad5d9b8fd646b28785de4', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_groups`
--

CREATE TABLE `user_groups` (
  `GROUP_ID` decimal(8,0) NOT NULL,
  `USER_ID` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `acceess_group`
--
ALTER TABLE `acceess_group`
  ADD PRIMARY KEY (`GROUP_ID`,`ACCESS_ID`),
  ADD KEY `ACCEESS_GROUP_FK` (`GROUP_ID`),
  ADD KEY `ACCEESS_GROUP2_FK` (`ACCESS_ID`);

--
-- Indeks untuk tabel `acceess_groups`
--
ALTER TABLE `acceess_groups`
  ADD PRIMARY KEY (`GROUP_ID`,`ACCESS_ID`),
  ADD KEY `FK_ACCEESS_GROUPS2` (`ACCESS_ID`);

--
-- Indeks untuk tabel `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`ACCESS_ID`);

--
-- Indeks untuk tabel `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`ID_BRANCH`);

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`DETAIL_ID`),
  ADD KEY `FK_FORM_HAS_DETAIL` (`FORM_ID`);

--
-- Indeks untuk tabel `emlployee`
--
ALTER TABLE `emlployee`
  ADD PRIMARY KEY (`EMPLOOYEEID`),
  ADD KEY `FK_HAVE_2` (`USER_ID`);

--
-- Indeks untuk tabel `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`FORM_ID`),
  ADD KEY `FK_CREATE` (`USER_ID`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GROUP_ID`);

--
-- Indeks untuk tabel `groups_branch`
--
ALTER TABLE `groups_branch`
  ADD PRIMARY KEY (`ID_BRANCH`,`GROUP_ID`),
  ADD KEY `FK_GROUPS_BRANCH2` (`GROUP_ID`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`HISTORY_ID`),
  ADD KEY `FK_FORM_HAS_HISTORY` (`FORM_ID`);

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`LOG_ID`);

--
-- Indeks untuk tabel `master_status`
--
ALTER TABLE `master_status`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indeks untuk tabel `session`
--
ALTER TABLE `session`
  ADD KEY `FK_HAVE` (`USER_ID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `FK_HAVE_3` (`EMPLOOYEEID`);

--
-- Indeks untuk tabel `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`GROUP_ID`,`USER_ID`),
  ADD KEY `FK_USER_GROUPS2` (`USER_ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `acceess_groups`
--
ALTER TABLE `acceess_groups`
  ADD CONSTRAINT `FK_ACCEESS_GROUPS` FOREIGN KEY (`GROUP_ID`) REFERENCES `groups` (`GROUP_ID`),
  ADD CONSTRAINT `FK_ACCEESS_GROUPS2` FOREIGN KEY (`ACCESS_ID`) REFERENCES `access` (`ACCESS_ID`);

--
-- Ketidakleluasaan untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `FK_FORM_HAS_DETAIL` FOREIGN KEY (`FORM_ID`) REFERENCES `form` (`FORM_ID`);

--
-- Ketidakleluasaan untuk tabel `emlployee`
--
ALTER TABLE `emlployee`
  ADD CONSTRAINT `FK_HAVE_2` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `FK_CREATE` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `groups_branch`
--
ALTER TABLE `groups_branch`
  ADD CONSTRAINT `FK_GROUPS_BRANCH` FOREIGN KEY (`ID_BRANCH`) REFERENCES `branch` (`ID_BRANCH`),
  ADD CONSTRAINT `FK_GROUPS_BRANCH2` FOREIGN KEY (`GROUP_ID`) REFERENCES `groups` (`GROUP_ID`);

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `FK_FORM_HAS_HISTORY` FOREIGN KEY (`FORM_ID`) REFERENCES `form` (`FORM_ID`);

--
-- Ketidakleluasaan untuk tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `FK_HAVE` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_HAVE_3` FOREIGN KEY (`EMPLOOYEEID`) REFERENCES `emlployee` (`EMPLOOYEEID`);

--
-- Ketidakleluasaan untuk tabel `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `FK_USER_GROUPS` FOREIGN KEY (`GROUP_ID`) REFERENCES `groups` (`GROUP_ID`),
  ADD CONSTRAINT `FK_USER_GROUPS2` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
