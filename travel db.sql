/*
 Navicat Premium Data Transfer

 Source Server         : db_naufal
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : travel

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 26/09/2024 00:20:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for destinasi
-- ----------------------------
DROP TABLE IF EXISTS `destinasi`;
CREATE TABLE `destinasi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_destinasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of destinasi
-- ----------------------------
INSERT INTO `destinasi` VALUES (1, 'menara eifel', 'prancis');
INSERT INTO `destinasi` VALUES (2, 'Candi Borobudur', 'Magelang, Jawa Tengah');
INSERT INTO `destinasi` VALUES (3, 'Taman Nasional Komodo', 'Nusa Tenggara Timur');
INSERT INTO `destinasi` VALUES (4, 'Danau Toba', 'Sumatera Utara');
INSERT INTO `destinasi` VALUES (5, 'Kawah Ijen', 'Banyuwangi, Jawa Timur');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int NOT NULL,
  `tanggal_pemesanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
