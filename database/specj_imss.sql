/*
 Navicat Premium Data Transfer

 Source Server         : starbright
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : specj_imss

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 08/07/2024 16:27:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for c_vehicles_registration_tbl
-- ----------------------------
DROP TABLE IF EXISTS `c_vehicles_registration_tbl`;
CREATE TABLE `c_vehicles_registration_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_year` int NOT NULL,
  `license_plate` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mileage` int NULL DEFAULT NULL,
  `vin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `registration_date` date NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  CONSTRAINT `c_vehicles_registration_tbl_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers_tbl` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_vehicles_registration_tbl
-- ----------------------------
INSERT INTO `c_vehicles_registration_tbl` VALUES (1, 3, 'Rusi', 2024, '1231-123123-1231', 122000, '1230ASDG123', '2024-07-08', 'NEW CUSTOMER');
INSERT INTO `c_vehicles_registration_tbl` VALUES (2, 3, '123', 123, '123', 123123, 'asda', '2024-07-10', 'asd');
INSERT INTO `c_vehicles_registration_tbl` VALUES (3, 4, '123', 123, '123', 123, '123', '2024-07-01', 'asd');
INSERT INTO `c_vehicles_registration_tbl` VALUES (4, 1, 'asd', 123, '123', 123, 'asd', '2024-07-30', 'asd');

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of customers_tbl
-- ----------------------------
INSERT INTO `customers_tbl` VALUES (1, 'asd', 'asd', 'reymarkescalante12@gmail.com', 'asd', 'asd', '2024-06-28 22:25:15');
INSERT INTO `customers_tbl` VALUES (3, 'Reymark', 'EScalante', 'reymarkescalante@Gmail.com', '091248480202', 'asd', '2024-07-08 11:55:17');
INSERT INTO `customers_tbl` VALUES (4, 'harley', 'silvestre', 'harly@gmail.com', '123123123', 'saasdad', '2024-07-08 13:37:50');

-- ----------------------------
-- Table structure for inventory_logs
-- ----------------------------
DROP TABLE IF EXISTS `inventory_logs`;
CREATE TABLE `inventory_logs`  (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity_change` int NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventory_logs
-- ----------------------------
INSERT INTO `inventory_logs` VALUES (1, 7, 'Approve Request', '0', '2024-07-06 08:55:42', '', 1);
INSERT INTO `inventory_logs` VALUES (2, 6, 'Approve Request', '0', '2024-07-06 08:58:03', '', 13);
INSERT INTO `inventory_logs` VALUES (3, 6, 'Approve Request', '0', '2024-07-06 08:58:13', '', 13);
INSERT INTO `inventory_logs` VALUES (4, 6, 'Approve Request', '0', '2024-07-06 08:59:04', '0', 13);
INSERT INTO `inventory_logs` VALUES (5, 7, 'Approve Request', '0', '2024-07-06 08:59:34', '0', 1);
INSERT INTO `inventory_logs` VALUES (6, 7, 'Approve Request', '0', '2024-07-06 09:02:03', 'Approved', 1);
INSERT INTO `inventory_logs` VALUES (7, 6, 'Approve Request', 'the rats', '2024-07-06 09:02:40', 'Approved', 13);
INSERT INTO `inventory_logs` VALUES (8, 7, 'asd', 'the rats', '2024-07-06 09:38:20', 'Rejected', 1);
INSERT INTO `inventory_logs` VALUES (9, 6, 'Approve Request', 'the rats', '2024-07-06 09:38:44', 'Delivered', 123);
INSERT INTO `inventory_logs` VALUES (10, 6, 'asd', 'the rats', '2024-07-06 09:38:53', 'Rejected', 123);
INSERT INTO `inventory_logs` VALUES (11, 7, 'Approve Request', 'the rats', '2024-07-06 09:39:00', 'Delivered', 1);
INSERT INTO `inventory_logs` VALUES (12, 6, 'Approve Request', 'the rats', '2024-07-06 09:39:03', 'Delivered', 123);
INSERT INTO `inventory_logs` VALUES (13, 7, 'g', 'the rats', '2024-07-06 09:39:07', 'Rejected', 1);
INSERT INTO `inventory_logs` VALUES (14, 7, 'Approve Request', 'the rats', '2024-07-06 09:39:23', 'Delivered', 1);
INSERT INTO `inventory_logs` VALUES (15, 4, 'Approve Request', '', '2024-07-06 09:44:26', 'Delivered', 1230);

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`reorder_id`) USING BTREE,
  INDEX `parts_id`(`parts_id` ASC) USING BTREE,
  CONSTRAINT `reorders_tbl_ibfk_1` FOREIGN KEY (`parts_id`) REFERENCES `motorparts_tbl` (`m_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of reorders_tbl
-- ----------------------------
INSERT INTO `reorders_tbl` VALUES (1, 3, 200, 145.00, '2024-07-14', '2024-07-15', '0', '');
INSERT INTO `reorders_tbl` VALUES (2, 3, 132123, 145.00, '2024-07-06', '2024-07-08', '0', '');
INSERT INTO `reorders_tbl` VALUES (3, 3, 132123, 145.00, '2024-07-06', '2024-07-08', '0', '');
INSERT INTO `reorders_tbl` VALUES (4, 3, 1230, 123.00, '2024-07-20', '2024-07-13', '', 'Delivered');
INSERT INTO `reorders_tbl` VALUES (5, 3, 123123, 145.00, '2024-07-18', '2024-07-19', '', '');
INSERT INTO `reorders_tbl` VALUES (6, 3, 123, 0.00, '2024-07-06', '2024-07-06', 'the rats', 'Delivered');
INSERT INTO `reorders_tbl` VALUES (7, 3, 1, 12.00, '2024-07-06', '2024-07-08', 'the rats', 'Delivered');

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers_tbl
-- ----------------------------
INSERT INTO `suppliers_tbl` VALUES (2, 'Mistery Tech Shops', 'Reymark S. Escalante', 'rey@gmail.com', '1231231231', 'gensans', '2024-07-06 01:55:59', '');
INSERT INTO `suppliers_tbl` VALUES (3, 'Starbrigh', 'Gilber', 'gil@gmail.coim', '0914561231231`', 'asd', '2024-07-06 09:29:58', '');
INSERT INTO `suppliers_tbl` VALUES (4, 'asd', 'as', 'asd@gmail.com', '1231231', 'asdasd', '2024-07-06 09:31:24', '');

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
