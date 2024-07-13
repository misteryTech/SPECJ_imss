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

 Date: 13/07/2024 16:39:10
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of c_vehicles_registration_tbl
-- ----------------------------
INSERT INTO `c_vehicles_registration_tbl` VALUES (6, 4, 'Haojues', 2222, 'MVP102305', 111111111, 'ASD', '2024-07-11', 'ASD');
INSERT INTO `c_vehicles_registration_tbl` VALUES (8, 5, 'Rusi', 2023, '222mwp', 22, '1230ASDG123', '2024-07-11', 'asd');

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
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of customers_tbl
-- ----------------------------
INSERT INTO `customers_tbl` VALUES (4, 'Reymark', 'Escalante', 'reymarkescalante12@gmail.com', '1231231', 'reymark@gmail.com', '2024-07-10 00:55:34', 'customer1', 'customer2');
INSERT INTO `customers_tbl` VALUES (5, 'Starbrigh', 'Gensan', 'admin@gmail.com', '09399213074', 'Pres Quirino Ave', '2024-07-11 15:28:41', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `inventory_logs` VALUES (16, 5, 'asd', '', '2024-07-06 15:28:54', 'Rejected', 123123);
INSERT INTO `inventory_logs` VALUES (17, 7, 'Approve Request', 'the rats', '2024-07-07 19:25:59', 'Received', 1);
INSERT INTO `inventory_logs` VALUES (18, 4, 'Approve Request', '', '2024-07-07 19:26:24', 'Received', 1230);
INSERT INTO `inventory_logs` VALUES (19, 1, 'Approve Request', 'the rats', '2024-07-10 15:28:38', 'Delivered', 10);
INSERT INTO `inventory_logs` VALUES (20, 1, 'Approve Request', 'the rats', '2024-07-10 15:29:37', 'Received', 10);
INSERT INTO `inventory_logs` VALUES (21, 2, 'Approve Request', 'the rats', '2024-07-10 15:32:09', 'Delivered', 20);
INSERT INTO `inventory_logs` VALUES (22, 3, 'Tamad MAgbenta', 'the rats', '2024-07-10 15:34:57', 'Rejected', 200);
INSERT INTO `inventory_logs` VALUES (23, 2, 'Approve Request', 'the rats', '2024-07-13 07:51:33', 'Received', 20);
INSERT INTO `inventory_logs` VALUES (24, 4, 'Approve Request', 'asd', '2024-07-13 07:53:13', 'Delivered', 200);
INSERT INTO `inventory_logs` VALUES (25, 4, 'Approve Request', 'asd', '2024-07-13 07:53:28', 'Received', 200);

-- ----------------------------
-- Table structure for mechanist_tbl
-- ----------------------------
DROP TABLE IF EXISTS `mechanist_tbl`;
CREATE TABLE `mechanist_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `m_firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `m_lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mechanist_tbl
-- ----------------------------
INSERT INTO `mechanist_tbl` VALUES (1, 'Rusi', 'asd', 'reymarkescalante12@gmail.com', 'asd', 'asd', '2024-06-28 22:25:15', 'rusi', 'rusi');

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `services_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of motorparts_tbl
-- ----------------------------
INSERT INTO `motorparts_tbl` VALUES (2, 'Spark Plug', 'asd123', 'asd', 'asd', 123.00, '201', 'asd', '2024-07-13 13:53:28', '0', 'Car', NULL);
INSERT INTO `motorparts_tbl` VALUES (3, 'Battery', 'asd123', 'Body Parts', 'SEcret', 145.00, '25', 'the rats', '2024-07-13 13:51:33', 'new', 'Motorcycle', NULL);
INSERT INTO `motorparts_tbl` VALUES (9, 'Cowling', '154-123', 'accessories', 'Rusi', 750.00, '50', 'rusi', '2024-07-10 21:11:42', 'New', 'Motorcycle', NULL);
INSERT INTO `motorparts_tbl` VALUES (10, 'headlight', '154-987', 'accessories', 'Rusi', 600.00, '100', 'rusi', '2024-07-11 09:50:53', '0', 'Motorcycle', NULL);
INSERT INTO `motorparts_tbl` VALUES (12, '123', '1231', 'accessories', 'shinko', 123.00, '123123', '1asdasd', '2024-07-11 09:54:05', 'Replacement', 'Motorcycle', NULL);
INSERT INTO `motorparts_tbl` VALUES (13, 'last', 'last', 'maintenance-tools', 'kn', 123.00, '123', 'last', '2024-07-11 11:25:21', 'Generic', 'Motorcycle', 'uploads/hospital2.png');
INSERT INTO `motorparts_tbl` VALUES (14, 'asdasd', '123', 'asdasd', 'asdasd', 123123.00, '12312', '2', '2024-07-11 16:55:01', 'New', 'Car', 'uploads/photo_2024-05-20_07-17-54.jpg');

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of reorders_tbl
-- ----------------------------
INSERT INTO `reorders_tbl` VALUES (1, 3, 10, 150.00, '2024-07-10', '2024-07-15', 'the rats', 'Received');
INSERT INTO `reorders_tbl` VALUES (2, 3, 20, 145.00, '2024-07-11', '2024-07-20', 'the rats', 'Received');
INSERT INTO `reorders_tbl` VALUES (3, 3, 200, 170.00, '2024-07-13', '2024-07-13', 'the rats', 'Rejected');
INSERT INTO `reorders_tbl` VALUES (4, 2, 200, 123.00, '2024-07-13', '2024-07-20', 'asd', 'Received');

-- ----------------------------
-- Table structure for scheduling_services_tbl
-- ----------------------------
DROP TABLE IF EXISTS `scheduling_services_tbl`;
CREATE TABLE `scheduling_services_tbl`  (
  `sched_service_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
  `services_id` int NULL DEFAULT NULL,
  `service_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `service_date` date NULL DEFAULT NULL,
  `preferred_time` time NULL DEFAULT NULL,
  `mechanist_id` int NULL DEFAULT NULL,
  `technician_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `customer_comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `special_instruction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sched_service_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scheduling_services_tbl
-- ----------------------------
INSERT INTO `scheduling_services_tbl` VALUES (1, 4, 6, 11, 'top1 oil', '2024-07-13', '10:47:50', 1, 'make it faster', 'give tip', 'please avoid the bolts to disappear', 'Request');
INSERT INTO `scheduling_services_tbl` VALUES (2, 4, 6, 9, 'asd', '2024-07-12', '03:00:00', 3, 'asd', 'asd', 'asd', 'Request');
INSERT INTO `scheduling_services_tbl` VALUES (3, 4, 6, 6, 'asd', '2024-07-12', '05:09:00', 3, 'asd', 'asd', 'asd', 'Request');

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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of services_tbl
-- ----------------------------
INSERT INTO `services_tbl` VALUES (1, 'Car', 'Checkup', 151.00);
INSERT INTO `services_tbl` VALUES (6, 'Motorcycle', 'Checkup', 150.00);
INSERT INTO `services_tbl` VALUES (7, 'Motorcycle', 'Overhaul', 800.00);
INSERT INTO `services_tbl` VALUES (8, 'Car', 'Overhaul', 1500.00);
INSERT INTO `services_tbl` VALUES (9, 'Motorcycle', 'Change Oil', 150.00);
INSERT INTO `services_tbl` VALUES (11, 'Motorcycle', 'Tune Up', 600.00);

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
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers_tbl
-- ----------------------------
INSERT INTO `suppliers_tbl` VALUES (2, 'Mistery Tech Shops', 'Reymark S. Escalante', 'rey@gmail.com', '1231231231', 'gensan', '2024-07-06 01:55:59', '', 'supplier', 'supplier');
INSERT INTO `suppliers_tbl` VALUES (3, 'Starbrigh', 'Gilber', 'gil@gmail.coim', '0914561231231`', 'asd', '2024-07-06 09:29:58', '', NULL, NULL);

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
