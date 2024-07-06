/*
 Navicat Premium Data Transfer

 Source Server         : MisteRy_Connection
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : specj_imss

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 06/07/2024 07:07:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers_tbl
-- ----------------------------
DROP TABLE IF EXISTS `customers_tbl`;
CREATE TABLE `customers_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `c_firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `c_lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers_tbl
-- ----------------------------
INSERT INTO `customers_tbl` VALUES (1, 'asd', 'asd', 'reymarkescalante12@gmail.com', 'asd', 'asd', '2024-06-28 22:25:15');

-- ----------------------------
-- Table structure for motorparts_tbl
-- ----------------------------
DROP TABLE IF EXISTS `motorparts_tbl`;
CREATE TABLE `motorparts_tbl`  (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `parts_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `parts_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `manufacturer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `QuantityInStock` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_added` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `services_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of motorparts_tbl
-- ----------------------------
INSERT INTO `motorparts_tbl` VALUES (1, 'asd', 'asd1231', 'sad', 'asd', 12312.00, '123', 'asd', NULL, 'asd', 'Car');
INSERT INTO `motorparts_tbl` VALUES (2, 'Spark Plug', 'asd123', 'asd', 'asd', 123.00, '123', 'asd', NULL, 'asd', 'Motorcycle');
INSERT INTO `motorparts_tbl` VALUES (3, 'Battery', 'asd123', 'Body Parts', 'SEcret', 145.00, '5', 'the rats', '2024-06-28 20:55:14', 'new', 'Motorcycle');

-- ----------------------------
-- Table structure for reorders_tbl
-- ----------------------------
DROP TABLE IF EXISTS `reorders_tbl`;
CREATE TABLE `reorders_tbl`  (
  `reorder_id` int NOT NULL AUTO_INCREMENT,
  `parts_id` int NOT NULL,
  `quantity_to_reorder` int NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `reorder_date` date NOT NULL,
  `expected_delivery_date` date NOT NULL,
  `supplier_id` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`reorder_id`) USING BTREE,
  INDEX `parts_id`(`parts_id` ASC) USING BTREE,
  CONSTRAINT `reorders_tbl_ibfk_1` FOREIGN KEY (`parts_id`) REFERENCES `motorparts_tbl` (`m_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reorders_tbl
-- ----------------------------
INSERT INTO `reorders_tbl` VALUES (1, 3, 200, 145.00, '2024-07-14', '2024-07-15', '0');
INSERT INTO `reorders_tbl` VALUES (2, 3, 132123, 145.00, '2024-07-06', '2024-07-08', '0');
INSERT INTO `reorders_tbl` VALUES (3, 3, 132123, 145.00, '2024-07-06', '2024-07-08', '0');
INSERT INTO `reorders_tbl` VALUES (4, 3, 123, 145.00, '2024-07-20', '2024-07-12', '');
INSERT INTO `reorders_tbl` VALUES (5, 3, 123123, 145.00, '2024-07-18', '2024-07-19', '');
INSERT INTO `reorders_tbl` VALUES (6, 3, 123, 145.00, '2024-07-06', '2024-07-08', 'the rats');

-- ----------------------------
-- Table structure for services_tbl
-- ----------------------------
DROP TABLE IF EXISTS `services_tbl`;
CREATE TABLE `services_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `services_type` enum('Car','Motorcycle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `services_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of services_tbl
-- ----------------------------
INSERT INTO `services_tbl` VALUES (1, 'Car', 'Checkups', 151.00);
INSERT INTO `services_tbl` VALUES (4, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services_tbl` VALUES (5, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services_tbl` VALUES (6, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services_tbl` VALUES (7, 'Motorcycle', 'Overhaul', 800.00);
INSERT INTO `services_tbl` VALUES (8, 'Car', 'Overhaul', 1500.00);
INSERT INTO `services_tbl` VALUES (9, 'Motorcycle', 'Change Oil', 150.00);
INSERT INTO `services_tbl` VALUES (10, 'Car', 'Signal Light Wiring', 150.00);

-- ----------------------------
-- Table structure for suppliers_tbl
-- ----------------------------
DROP TABLE IF EXISTS `suppliers_tbl`;
CREATE TABLE `suppliers_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactPerson` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers_tbl
-- ----------------------------
INSERT INTO `suppliers_tbl` VALUES (2, 'Mistery Tech Shops', 'Reymark S. Escalante', 'rey@gmail.com', '1231231231', 'gensan', '2024-07-06 01:55:59');

-- ----------------------------
-- Table structure for user_table
-- ----------------------------
DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT ' ',
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_table
-- ----------------------------
INSERT INTO `user_table` VALUES (1, 'Starbrigh', 'Gensan', 'admin', 'admin@gmail.com', 'admin');
INSERT INTO `user_table` VALUES (2, 'Reymark', 'Gensan', 'sample1', 'reymarkescalante12@gmail.com', 'sample1');

SET FOREIGN_KEY_CHECKS = 1;
