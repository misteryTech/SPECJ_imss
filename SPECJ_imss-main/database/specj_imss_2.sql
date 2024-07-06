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

 Date: 01/07/2024 07:40:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
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
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'asd', 'asd', 'reymarkescalante12@gmail.com', 'asd', 'asd', '2024-06-28 22:25:15');
INSERT INTO `customers` VALUES (2, 'Reymark', 'Escalant', 'reymarkescalante12@gmail.com', '09852003016', 'asd', '2024-06-29 01:27:50');

-- ----------------------------
-- Table structure for motor_parts_table
-- ----------------------------
DROP TABLE IF EXISTS `motor_parts_table`;
CREATE TABLE `motor_parts_table`  (
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
-- Records of motor_parts_table
-- ----------------------------
INSERT INTO `motor_parts_table` VALUES (1, 'asd', 'asd1231', 'sad', 'asd', 12312.00, '123', 'asd', NULL, 'asd', 'Car');
INSERT INTO `motor_parts_table` VALUES (2, 'Spark Plug', 'asd123', 'asd', 'asd', 123.00, '123', 'asd', NULL, 'asd', 'Motorcycle');
INSERT INTO `motor_parts_table` VALUES (3, 'Battery', 'asd123', 'Body Parts', 'SEcret', 145.00, '5', 'the rats', '2024-06-28 20:55:14', 'new', 'Motorcycle');
INSERT INTO `motor_parts_table` VALUES (4, 'Spark Plug', 'asd123', 'engine-components', 'brembo', 123.00, '100', 'the rats', '2024-06-28 21:17:19', 'New', 'Motorcycle');
INSERT INTO `motor_parts_table` VALUES (5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-28 22:21:04', NULL, NULL);
INSERT INTO `motor_parts_table` VALUES (6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-28 22:22:44', NULL, NULL);
INSERT INTO `motor_parts_table` VALUES (7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-28 22:23:24', NULL, NULL);

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `services_type` enum('Car','Motorcycle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `services_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of services
-- ----------------------------
INSERT INTO `services` VALUES (1, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services` VALUES (2, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services` VALUES (3, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services` VALUES (4, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services` VALUES (5, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services` VALUES (6, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services` VALUES (7, 'Motorcycle', 'Overhaul', 800.00);
INSERT INTO `services` VALUES (8, 'Car', 'Overhaul', 1500.00);
INSERT INTO `services` VALUES (9, 'Motorcycle', 'Change Oil', 150.00);
INSERT INTO `services` VALUES (10, 'Car', 'Signal Light Wiring', 150.00);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactPerson` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'asd', 'asd', 'reymarkescalante12@gmail.com', 'asd', 'asd', '2024-06-28 22:25:15');

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
