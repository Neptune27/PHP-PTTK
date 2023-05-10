DROP DATABASE IF EXISTS QLMH;
CREATE DATABASE QLMH;
USE QLMH;

-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: QLMH
-- ------------------------------------------------------
-- Server version       8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ChucVuGV`
--

DROP TABLE IF EXISTS `ChucVuGV`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ChucVuGV` (
                            `ID` int NOT NULL AUTO_INCREMENT,
                            `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChucVuGV`
--

LOCK TABLES `ChucVuGV` WRITE;
/*!40000 ALTER TABLE `ChucVuGV` DISABLE KEYS */;
/*!40000 ALTER TABLE `ChucVuGV` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DanhSachMonDaHoc`
--

DROP TABLE IF EXISTS `DanhSachMonDaHoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `DanhSachMonDaHoc` (
                                    `ID_MON_HOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                    `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                    `DIEM` float DEFAULT NULL,
                                    PRIMARY KEY (`ID_MON_HOC`,`MSSV`),
                                    KEY `DanhSachMonDaHoc_SinhVien_MSSV_fk` (`MSSV`),
                                    CONSTRAINT `DanhSachMonDaHoc_MonHoc_ID_fk` FOREIGN KEY (`ID_MON_HOC`) REFERENCES `MonHoc` (`ID`),
                                    CONSTRAINT `DanhSachMonDaHoc_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DanhSachMonDaHoc`
--

LOCK TABLES `DanhSachMonDaHoc` WRITE;
/*!40000 ALTER TABLE `DanhSachMonDaHoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `DanhSachMonDaHoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GiaoVien`
--

DROP TABLE IF EXISTS `GiaoVien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `GiaoVien` (
                            `ID` int NOT NULL AUTO_INCREMENT,
                            `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `EMAIL` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `PHONE` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `ID_NGANH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `ID_CHUC_VU` int DEFAULT NULL,
                            PRIMARY KEY (`ID`),
                            KEY `GiaoVien_ChucVuGV_ID_fk` (`ID_CHUC_VU`),
                            KEY `GiaoVien_Nganh_ID_fk` (`ID_NGANH`),
                            CONSTRAINT `GiaoVien_ChucVuGV_ID_fk` FOREIGN KEY (`ID_CHUC_VU`) REFERENCES `ChucVuGV` (`ID`),
                            CONSTRAINT `GiaoVien_Nganh_ID_fk` FOREIGN KEY (`ID_NGANH`) REFERENCES `Nganh` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GiaoVien`
--

LOCK TABLES `GiaoVien` WRITE;
/*!40000 ALTER TABLE `GiaoVien` DISABLE KEYS */;
/*!40000 ALTER TABLE `GiaoVien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HinhThucThanhToan`
--

DROP TABLE IF EXISTS `HinhThucThanhToan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HinhThucThanhToan` (
                                     `ID` int NOT NULL AUTO_INCREMENT,
                                     `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                     PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HinhThucThanhToan`
--

LOCK TABLES `HinhThucThanhToan` WRITE;
/*!40000 ALTER TABLE `HinhThucThanhToan` DISABLE KEYS */;
/*!40000 ALTER TABLE `HinhThucThanhToan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HocBong`
--

DROP TABLE IF EXISTS `HocBong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HocBong` (
                           `ID` int NOT NULL AUTO_INCREMENT,
                           `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                           `PHAN_THUONG` int DEFAULT NULL,
                           PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HocBong`
--

LOCK TABLES `HocBong` WRITE;
/*!40000 ALTER TABLE `HocBong` DISABLE KEYS */;
/*!40000 ALTER TABLE `HocBong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HocPhi`
--

DROP TABLE IF EXISTS `HocPhi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HocPhi` (
                          `ID` int NOT NULL,
                          `TIEN_HOC_PHI` int DEFAULT NULL,
                          `TONG_TIN_CHI` int DEFAULT NULL,
                          `ID_HINH_THUC` int DEFAULT NULL,
                          `ID_TRANG_THAI` int DEFAULT NULL,
                          `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                          PRIMARY KEY (`ID`),
                          KEY `HocPhi_HinhThucThanhToan_ID_fk` (`ID_HINH_THUC`),
                          KEY `HocPhi_SinhVien_MSSV_fk` (`MSSV`),
                          KEY `HocPhi_TrangThaiHoaDon_ID_fk` (`ID_TRANG_THAI`),
                          CONSTRAINT `HocPhi_HinhThucThanhToan_ID_fk` FOREIGN KEY (`ID_HINH_THUC`) REFERENCES `HinhThucThanhToan` (`ID`),
                          CONSTRAINT `HocPhi_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`),
                          CONSTRAINT `HocPhi_TrangThaiHoaDon_ID_fk` FOREIGN KEY (`ID_TRANG_THAI`) REFERENCES `TrangThaiHoaDon` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HocPhi`
--

LOCK TABLES `HocPhi` WRITE;
/*!40000 ALTER TABLE `HocPhi` DISABLE KEYS */;
/*!40000 ALTER TABLE `HocPhi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Khoa`
--

DROP TABLE IF EXISTS `Khoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Khoa` (
                        `ID` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                        `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                        `TIEN_1_TIN` int DEFAULT NULL,
                        PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Khoa`
--

LOCK TABLES `Khoa` WRITE;
/*!40000 ALTER TABLE `Khoa` DISABLE KEYS */;
INSERT INTO `Khoa` VALUES ('CNTT','Công nghệ thông itn',540000);
/*!40000 ALTER TABLE `Khoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LopHoc`
--

DROP TABLE IF EXISTS `LopHoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `LopHoc` (
                          `ID` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                          `TEN` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                          `ID_NGANH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                          PRIMARY KEY (`ID`),
                          KEY `LopHoc_Nganh_ID_fk` (`ID_NGANH`),
                          CONSTRAINT `LopHoc_Nganh_ID_fk` FOREIGN KEY (`ID_NGANH`) REFERENCES `Nganh` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LopHoc`
--

LOCK TABLES `LopHoc` WRITE;
/*!40000 ALTER TABLE `LopHoc` DISABLE KEYS */;
INSERT INTO `LopHoc` VALUES ('DKP1212','DKP1212','DKP');
/*!40000 ALTER TABLE `LopHoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Lop_Hoc_Phan`
--

DROP TABLE IF EXISTS `Lop_Hoc_Phan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Lop_Hoc_Phan` (
                                `ID_DSMH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                `SL_SV` int DEFAULT NULL,
                                `LOP_HOC` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                `HOC_KY` int DEFAULT NULL,
                                `NAM_HOC` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                PRIMARY KEY (`ID_DSMH`),
                                CONSTRAINT `Lop_Hoc_Phan_MonHoc_ID_fk` FOREIGN KEY (`ID_DSMH`) REFERENCES `MonHoc` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lop_Hoc_Phan`
--

LOCK TABLES `Lop_Hoc_Phan` WRITE;
/*!40000 ALTER TABLE `Lop_Hoc_Phan` DISABLE KEYS */;
/*!40000 ALTER TABLE `Lop_Hoc_Phan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MonHoc`
--

DROP TABLE IF EXISTS `MonHoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MonHoc` (
                          `ID` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                          `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                          `TIN_CHI` int DEFAULT NULL,
                          `ID_NGANH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                          PRIMARY KEY (`ID`),
                          KEY `MonHoc_Nganh_ID_fk` (`ID_NGANH`),
                          CONSTRAINT `MonHoc_Nganh_ID_fk` FOREIGN KEY (`ID_NGANH`) REFERENCES `Nganh` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MonHoc`
--

LOCK TABLES `MonHoc` WRITE;
/*!40000 ALTER TABLE `MonHoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `MonHoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MonTienQuyet`
--

DROP TABLE IF EXISTS `MonTienQuyet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MonTienQuyet` (
                                `ID_MON_HOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                `ID_MON_HOC_TRUOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                PRIMARY KEY (`ID_MON_HOC`,`ID_MON_HOC_TRUOC`),
                                KEY `MonTienQuyet_MonHoc_ID_fk` (`ID_MON_HOC_TRUOC`),
                                CONSTRAINT `MonTienQuyet_MonHoc_ID_fk` FOREIGN KEY (`ID_MON_HOC_TRUOC`) REFERENCES `MonHoc` (`ID`),
                                CONSTRAINT `MonTienQuyet_MonHoc_IDMH_fk` FOREIGN KEY (`ID_MON_HOC`) REFERENCES `MonHoc` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MonTienQuyet`
--

LOCK TABLES `MonTienQuyet` WRITE;
/*!40000 ALTER TABLE `MonTienQuyet` DISABLE KEYS */;
/*!40000 ALTER TABLE `MonTienQuyet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Nganh`
--

DROP TABLE IF EXISTS `Nganh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Nganh` (
                         `ID` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                         `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                         `ID_KHOA` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                         PRIMARY KEY (`ID`),
                         KEY `Nganh_Khoa_ID_fk` (`ID_KHOA`),
                         CONSTRAINT `Nganh_Khoa_ID_fk` FOREIGN KEY (`ID_KHOA`) REFERENCES `Khoa` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Nganh`
--

LOCK TABLES `Nganh` WRITE;
/*!40000 ALTER TABLE `Nganh` DISABLE KEYS */;
INSERT INTO `Nganh` VALUES ('DCT','Công nghệ thông tin','CNTT'),('DKP','Kỹ thuật phần mềm','CNTT');
/*!40000 ALTER TABLE `Nganh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PhanCongGiangDay`
--

DROP TABLE IF EXISTS `PhanCongGiangDay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PhanCongGiangDay` (
                                    `ID_MON_HOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                    `ID_GIAO_VIEN` int NOT NULL,
                                    PRIMARY KEY (`ID_MON_HOC`,`ID_GIAO_VIEN`),
                                    KEY `PhanCongGiangDay_GiaoVien_ID_fk` (`ID_GIAO_VIEN`),
                                    CONSTRAINT `PhanCongGiangDay_GiaoVien_ID_fk` FOREIGN KEY (`ID_GIAO_VIEN`) REFERENCES `GiaoVien` (`ID`),
                                    CONSTRAINT `PhanCongGiangDay_MonHoc_ID_fk` FOREIGN KEY (`ID_MON_HOC`) REFERENCES `MonHoc` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PhanCongGiangDay`
--

LOCK TABLES `PhanCongGiangDay` WRITE;
/*!40000 ALTER TABLE `PhanCongGiangDay` DISABLE KEYS */;
/*!40000 ALTER TABLE `PhanCongGiangDay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SinhVien`
--

DROP TABLE IF EXISTS `SinhVien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SinhVien` (
                            `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                            `HO_TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `EMAIL` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `PHONE` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `ID_LOP` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `PASSWORD` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                            `NAM_BAT_DAU` int DEFAULT NULL,
                            PRIMARY KEY (`MSSV`),
                            KEY `SinhVien_LopHoc_ID_fk` (`ID_LOP`),
                            CONSTRAINT `SinhVien_LopHoc_ID_fk` FOREIGN KEY (`ID_LOP`) REFERENCES `LopHoc` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SinhVien`
--

LOCK TABLES `SinhVien` WRITE;
/*!40000 ALTER TABLE `SinhVien` DISABLE KEYS */;
INSERT INTO `SinhVien` VALUES ('3121560004','Võ Minh Trí','a@b.c','0123456789','DKP1212','a',2021);
/*!40000 ALTER TABLE `SinhVien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SinhVien_HocBong`
--

DROP TABLE IF EXISTS `SinhVien_HocBong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SinhVien_HocBong` (
                                    `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                    `ID_HOC_BONG` int NOT NULL,
                                    `HOC_KY` int DEFAULT NULL,
                                    `NAM_HOC` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                    PRIMARY KEY (`MSSV`,`ID_HOC_BONG`),
                                    KEY `SinhVien_HocBong_HocBong_ID_fk` (`ID_HOC_BONG`),
                                    CONSTRAINT `SinhVien_HocBong_HocBong_ID_fk` FOREIGN KEY (`ID_HOC_BONG`) REFERENCES `HocBong` (`ID`),
                                    CONSTRAINT `SinhVien_HocBong_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SinhVien_HocBong`
--

LOCK TABLES `SinhVien_HocBong` WRITE;
/*!40000 ALTER TABLE `SinhVien_HocBong` DISABLE KEYS */;
/*!40000 ALTER TABLE `SinhVien_HocBong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SinhVien_MonHoc`
--

DROP TABLE IF EXISTS `SinhVien_MonHoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SinhVien_MonHoc` (
                                   `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                   `ID_DSMH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                   PRIMARY KEY (`MSSV`,`ID_DSMH`),
                                   KEY `SinhVien_MonHoc_MonHoc_ID_fk` (`ID_DSMH`),
                                   CONSTRAINT `SinhVien_MonHoc_MonHoc_ID_fk` FOREIGN KEY (`ID_DSMH`) REFERENCES `MonHoc` (`ID`),
                                   CONSTRAINT `SinhVien_MonHoc_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SinhVien_MonHoc`
--

LOCK TABLES `SinhVien_MonHoc` WRITE;
/*!40000 ALTER TABLE `SinhVien_MonHoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `SinhVien_MonHoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ThoiGianMonHoc`
--

DROP TABLE IF EXISTS `ThoiGianMonHoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ThoiGianMonHoc` (
                                  `ID_DSMH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                  `TIET_BAT_DAU` int DEFAULT NULL,
                                  `TIET_KET_THUC` int DEFAULT NULL,
                                  `TUAN_BAT_DAU` int DEFAULT NULL,
                                  `TUAN_KET_THUC` int DEFAULT NULL,
                                  PRIMARY KEY (`ID_DSMH`),
                                  CONSTRAINT `ThoiGianMonHoc_Lop_Hoc_Phan_ID_DSMH_fk` FOREIGN KEY (`ID_DSMH`) REFERENCES `Lop_Hoc_Phan` (`ID_DSMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ThoiGianMonHoc`
--

LOCK TABLES `ThoiGianMonHoc` WRITE;
/*!40000 ALTER TABLE `ThoiGianMonHoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `ThoiGianMonHoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrangThaiHoaDon`
--

DROP TABLE IF EXISTS `TrangThaiHoaDon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TrangThaiHoaDon` (
                                   `ID` int NOT NULL AUTO_INCREMENT,
                                   `TEN` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                   PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrangThaiHoaDon`
--

LOCK TABLES `TrangThaiHoaDon` WRITE;
/*!40000 ALTER TABLE `TrangThaiHoaDon` DISABLE KEYS */;
/*!40000 ALTER TABLE `TrangThaiHoaDon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `YCMoThemSL`
--

DROP TABLE IF EXISTS `YCMoThemSL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `YCMoThemSL` (
                              `ID` int NOT NULL AUTO_INCREMENT,
                              `ID_MON_HOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                              `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                              PRIMARY KEY (`ID`),
                              KEY `YCMoThemSL_MonHoc_ID_fk` (`ID_MON_HOC`),
                              KEY `YCMoThemSL_SinhVien_MSSV_fk` (`MSSV`),
                              CONSTRAINT `YCMoThemSL_MonHoc_ID_fk` FOREIGN KEY (`ID_MON_HOC`) REFERENCES `MonHoc` (`ID`),
                              CONSTRAINT `YCMoThemSL_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `YCMoThemSL`
--

LOCK TABLES `YCMoThemSL` WRITE;
/*!40000 ALTER TABLE `YCMoThemSL` DISABLE KEYS */;
/*!40000 ALTER TABLE `YCMoThemSL` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;