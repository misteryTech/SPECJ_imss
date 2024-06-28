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

 Date: 28/06/2024 06:25:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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

SET FOREIGN_KEY_CHECKS = 1;
