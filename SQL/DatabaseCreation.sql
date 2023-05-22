DROP DATABASE IF EXISTS QLMH;
CREATE DATABASE QLMH;
USE QLMH;
-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: QLSV
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
mysqldump: Got error: 1049: Unknown database 'QLSV' when selecting the database
sh-4.4# mysqldump -u root -p QLMH
Enter password:
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChucVuGV`
--

LOCK TABLES `ChucVuGV` WRITE;
/*!40000 ALTER TABLE `ChucVuGV` DISABLE KEYS */;
INSERT INTO `ChucVuGV` VALUES (1,'ADMIN'),(2,'GV');
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
                                    `HK` int DEFAULT NULL,
                                    `Nam` int DEFAULT NULL,
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
INSERT INTO `DanhSachMonDaHoc` VALUES ('841020','3121560004',9.3,1,2021),('841021','3121560004',9.4,1,2021),('841303','3121560004',9.2,2,2021),('841401','3121560004',8,1,2021),('841402','3121560004',7.7,1,2021),('841403','3121560004',8.8,1,2021),('841404','3121560004',8.8,2,2021),('841405','3121560004',5.2,2,2021),('866101','3121560004',8,1,2021);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GiaoVien`
--

LOCK TABLES `GiaoVien` WRITE;
/*!40000 ALTER TABLE `GiaoVien` DISABLE KEYS */;
INSERT INTO `GiaoVien` VALUES (2,'Hồng Anh','a@b.c','0123456789','DCT',1),(4,'TEST','A@b.c','0123415678','CHU',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HinhThucThanhToan`
--

LOCK TABLES `HinhThucThanhToan` WRITE;
/*!40000 ALTER TABLE `HinhThucThanhToan` DISABLE KEYS */;
INSERT INTO `HinhThucThanhToan` VALUES (1,'Chuyển khoản'),(2,'Trực tiếp'),(3,'Học bổng');
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
                          `ID` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HocPhi`
--

LOCK TABLES `HocPhi` WRITE;
/*!40000 ALTER TABLE `HocPhi` DISABLE KEYS */;
INSERT INTO `HocPhi` VALUES (12,1050000,3,1,3,'3121560004');
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
INSERT INTO `Khoa` VALUES ('CHU','Chung',360000),('CNTT','Công nghệ thông itn',540000),('TEST','TEST',3000);
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
INSERT INTO `LopHoc` VALUES ('DKP1212','DKP1212','DKP'),('TEST','TEST','CHU');
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
                                `ID_MONHOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                `SL_SV` int DEFAULT NULL,
                                `HOC_KY` int NOT NULL,
                                `NAM_HOC` int NOT NULL,
                                `NGAY_BAT_DAU` date DEFAULT NULL,
                                PRIMARY KEY (`ID_DSMH`,`NAM_HOC`,`HOC_KY`),
                                KEY `Lop_Hoc_Phan___fk` (`ID_MONHOC`),
                                CONSTRAINT `Lop_Hoc_Phan___fk` FOREIGN KEY (`ID_MONHOC`) REFERENCES `MonHoc` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lop_Hoc_Phan`
--

LOCK TABLES `Lop_Hoc_Phan` WRITE;
/*!40000 ALTER TABLE `Lop_Hoc_Phan` DISABLE KEYS */;
INSERT INTO `Lop_Hoc_Phan` VALUES ('841022_1','841022',30,3,2023,'2022-05-09'),('841022_2','841022',30,3,2023,'2022-05-09'),('841022_3','841022',30,3,2023,'2022-05-09'),('841022_8','841022',30,1,2023,'2022-05-09'),('841107_41','841107',10,3,2023,'2023-05-22'),('841107_42','841107',60,2,2023,'2023-02-06'),('841107_42','841107',0,3,2023,'2023-02-06'),('841401_1','841401',50,3,2023,'2022-05-09'),('841401_2','841401',60,3,2023,'2023-05-21'),('841401_45','841401',35,3,2023,'2023-05-22'),('841402_7','841402',32,3,2023,'2023-05-22'),('861301_1','861301',120,3,2023,'2022-05-09'),('861301_2','861301',120,3,2023,'2022-05-09'),('861302_1','861302',0,3,2023,'2022-05-09'),('861302_3','861302',0,3,2023,'2022-05-09'),('861303_4','861303',120,3,2023,'2022-05-09'),('861303_6','861303',120,3,2023,'2022-05-09');
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
INSERT INTO `MonHoc` VALUES ('841020','Cơ sở lập trình',3,'DCT'),('841021','Kiến trúc máy tính',3,'DCT'),('841022','Hệ điều hành',3,'DCT'),('841044','Lập trình hướng đối tượng',4,'DCT'),('841048','P/tích thiết kế hệ thống thông tin',4,'DCT'),('841058','Hệ điều hành mã nguồn mở',3,'DCT'),('841107','Lập trình Java',4,'DCT'),('841108','Cấu trúc dữ liệu và giải thuật',4,'DCT'),('841109','Cơ sở dữ liệu',4,'DCT'),('841303','Kỹ thuật lập trình',4,'DCT'),('841401','Giải tích 1',3,'CHU'),('841402','Đại số tuyến tính',3,'CHU'),('841403','Cấu trúc rời rạc',4,'DCT'),('841404','Mạng máy tính',3,'DCT'),('841405','Xác suất thống kê',3,'CHU'),('841406','Giải tích 2',3,'CHU'),('841419','Lập trình web và ứng dụng',4,'DCT'),('841422','Ngôn ngữ lập trình Python',4,'DCT'),('841464','Lập trình Web và ứng dụng nâng cao',4,'DCT'),('861301','Triết học Mác-Lênin',3,'CHU'),('861302','Kinh tế chính trị Mác-Lênin',2,'CHU'),('861303','Chủ nghĩa xã hội khoa học',2,'CHU'),('862101','Giáo dục thể chất (I)',1,'CHU'),('862406','Giáo dục quốc phòng và an ninh I',3,'CHU'),('862407','Giáo dục quốc phòng và an ninh II',2,'CHU'),('862408','Giáo dục quốc phòng và an ninh III',2,'CHU'),('865006','Pháp luật đại cương',2,'CHU'),('866101','Tiếng Anh I',2,'CHU'),('866102','Tiếng Anh II',2,'CHU');
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
INSERT INTO `MonTienQuyet` VALUES ('841303','841109'),('841406','841401'),('861302','861301'),('861303','861302'),('866102','866101');
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
INSERT INTO `Nganh` VALUES ('CHU','Chung','CHU'),('DCT','Công nghệ thông tin','CNTT'),('DKP','Kỹ thuật phần mềm','CNTT');
/*!40000 ALTER TABLE `Nganh` ENABLE KEYS */;
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
                            `SO_THE_NH` mediumtext,
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
INSERT INTO `SinhVien` VALUES ('3121560003','TEST','A@b.c','0123415678','TEST','123',2021,'0123456789'),('3121560004','Võ Minh Trí','a@b.c','0123456785','DKP1212','123',2021,'079236547');
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
-- Table structure for table `SinhVien_LHP`
--

DROP TABLE IF EXISTS `SinhVien_LHP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SinhVien_LHP` (
                                `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                `ID_DSMH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                `NAM` int NOT NULL,
                                `HK` int NOT NULL,
                                PRIMARY KEY (`MSSV`,`ID_DSMH`,`NAM`,`HK`),
                                KEY `SinhVien_MonHoc_MonHoc_ID_fk` (`ID_DSMH`),
                                KEY `SinhVien_LHP_Lop_Hoc_Phan_ID_DSMH_NAM_HOC_HOC_KY_fk` (`ID_DSMH`,`NAM`,`HK`),
                                CONSTRAINT `SinhVien_LHP_Lop_Hoc_Phan_ID_DSMH_NAM_HOC_HOC_KY_fk` FOREIGN KEY (`ID_DSMH`, `NAM`, `HK`) REFERENCES `Lop_Hoc_Phan` (`ID_DSMH`, `NAM_HOC`, `HOC_KY`),
                                CONSTRAINT `SinhVien_LHP_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SinhVien_LHP`
--

LOCK TABLES `SinhVien_LHP` WRITE;
/*!40000 ALTER TABLE `SinhVien_LHP` DISABLE KEYS */;
INSERT INTO `SinhVien_LHP` VALUES ('3121560004','841022_8',2023,1),('3121560004','841107_42',2023,2);
/*!40000 ALTER TABLE `SinhVien_LHP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SinhVien_MonHocTamThoi`
--

DROP TABLE IF EXISTS `SinhVien_MonHocTamThoi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SinhVien_MonHocTamThoi` (
                                          `MSSV` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                          `IDHP` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                          PRIMARY KEY (`MSSV`,`IDHP`),
                                          KEY `SinhVien_MonHocTamThoi_Lop_Hoc_Phan_ID_DSMH_fk` (`IDHP`),
                                          CONSTRAINT `SinhVien_MonHocTamThoi_SinhVien_MSSV_fk` FOREIGN KEY (`MSSV`) REFERENCES `SinhVien` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SinhVien_MonHocTamThoi`
--

LOCK TABLES `SinhVien_MonHocTamThoi` WRITE;
/*!40000 ALTER TABLE `SinhVien_MonHocTamThoi` DISABLE KEYS */;
INSERT INTO `SinhVien_MonHocTamThoi` VALUES ('3121560004','841022_3');
/*!40000 ALTER TABLE `SinhVien_MonHocTamThoi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ThoiGianMonHoc`
--

DROP TABLE IF EXISTS `ThoiGianMonHoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ThoiGianMonHoc` (
                                  `ID_DSMH` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                  `TIET_BAT_DAU` int NOT NULL,
                                  `LOP` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
                                  `TIET_KET_THUC` int DEFAULT NULL,
                                  `TUANHOC` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                  `ID_GVGD` int DEFAULT NULL,
                                  `HK` int NOT NULL,
                                  `NAM` int NOT NULL,
                                  `THU` int DEFAULT NULL,
                                  PRIMARY KEY (`ID_DSMH`,`LOP`,`TIET_BAT_DAU`,`HK`,`NAM`),
                                  KEY `ThoiGianMonHoc_GiaoVien_ID_fk` (`ID_GVGD`),
                                  KEY `ThoiGianMonHoc_Lop_Hoc_Phan_ID_DSMH_NAM_HOC_HOC_KY_fk` (`ID_DSMH`,`NAM`,`HK`),
                                  CONSTRAINT `ThoiGianMonHoc_GiaoVien_ID_fk` FOREIGN KEY (`ID_GVGD`) REFERENCES `GiaoVien` (`ID`),
                                  CONSTRAINT `ThoiGianMonHoc_Lop_Hoc_Phan_ID_DSMH_NAM_HOC_HOC_KY_fk` FOREIGN KEY (`ID_DSMH`, `NAM`, `HK`) REFERENCES `Lop_Hoc_Phan` (`ID_DSMH`, `NAM_HOC`, `HOC_KY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ThoiGianMonHoc`
--

LOCK TABLES `ThoiGianMonHoc` WRITE;
/*!40000 ALTER TABLE `ThoiGianMonHoc` DISABLE KEYS */;
INSERT INTO `ThoiGianMonHoc` VALUES ('841022_1',6,'C.A305',10,'12345678912345',2,3,2023,4),('841022_2',3,'C.A305',5,'12345678912345',2,3,2023,6),('841022_2',6,'C.A305',7,'12345678912345',2,3,2023,6),('841022_3',1,'C.A305',5,'12345678912345',2,3,2023,5),('841022_8',9,'C.A110',10,'123456789012345',2,1,2023,3),('841022_8',4,'C.E305',5,'123456789012345',2,1,2023,5),('841107_42',1,'C.A110',2,'123456789012345',2,2,2023,2),('841107_42',1,'C.A110',2,'123456789012345',2,3,2023,2),('841107_42',3,'C.A510',5,'123456789012345',2,2,2023,2),('841107_42',3,'C.A510',5,'123456789012345',2,3,2023,2),('841401_1',6,'C.A305',10,'12345678912345',2,3,2023,6),('841401_2',1,'C.A123',3,'123456',2,3,2023,3),('841402_7',2,'C.A123',5,'123453',4,3,2023,4),('861301_1',3,'C.B201',5,'12345678912345',2,3,2023,3),('861301_2',6,'C.B201',7,'12345678912345',2,3,2023,3),('861302_3',8,'C.B201',9,'12345678912345',2,3,2023,3),('861303_4',1,'C.B201',2,'12345678912345',2,3,2023,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrangThaiHoaDon`
--

LOCK TABLES `TrangThaiHoaDon` WRITE;
/*!40000 ALTER TABLE `TrangThaiHoaDon` DISABLE KEYS */;
INSERT INTO `TrangThaiHoaDon` VALUES (1,'Đang xử lý'),(2,'Hủy'),(3,'Xác nhận');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `YCMoThemSL`
--

LOCK TABLES `YCMoThemSL` WRITE;
/*!40000 ALTER TABLE `YCMoThemSL` DISABLE KEYS */;
INSERT INTO `YCMoThemSL` VALUES (7,'841401','3121560004');
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

-- Dump completed on 2023-05-22  5:31:05