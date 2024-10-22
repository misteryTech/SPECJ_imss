/*
 Navicat Premium Dump SQL

 Source Server         : miste_ry
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : specj_imss

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 22/10/2024 22:08:20
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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of c_vehicles_registration_tbl
-- ----------------------------
INSERT INTO `c_vehicles_registration_tbl` VALUES (6, 4, 'Haojues', 2222, 'MVP102305', 111111111, 'ASD', '2024-07-11', 'ASD');
INSERT INTO `c_vehicles_registration_tbl` VALUES (8, 6, 'Rusi', 2023, '222mwp', 22, '1230ASDG123', '2024-07-11', 'asd');
INSERT INTO `c_vehicles_registration_tbl` VALUES (10, 7, 'isuzu', 2211, 'asd321', 1299, 'SAFASFSA', '2024-10-03', 'qwe');

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
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `c_middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of customers_tbl
-- ----------------------------
INSERT INTO `customers_tbl` VALUES (4, 'Reymark', 'Escalante', 'reymarkescalante12@gmail.com', '1231231', 'reymark@gmail.com', '2024-07-10 00:55:34', 'customer1', 'customer2', 'Escalante');
INSERT INTO `customers_tbl` VALUES (6, 'ray leigh marts', 'escalante', 'reydhenebueza0023@gmail.com', '09635438188', 'yusaville sinawal gensan ', '2024-10-02 16:49:51', 'luffy', 'luffy', '');
INSERT INTO `customers_tbl` VALUES (7, 'empal', 'hagu', '123?@gmail.com', '1234341', 'gensan davao', '2024-10-08 19:47:02', 'empal', 'empal', '');

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_logs
-- ----------------------------
INSERT INTO `inventory_logs` VALUES (1, 1, 'Approve Request', 'sample shop', '2024-10-14 10:14:17', 'Delivered', 2222);
INSERT INTO `inventory_logs` VALUES (2, 1, 'Approve Request', 'sample shop', '2024-10-14 10:14:17', 'Delivered', 2222);
INSERT INTO `inventory_logs` VALUES (3, 1, 'Approve Request', 'sample shop', '2024-10-14 10:14:37', 'Received', 2222);
INSERT INTO `inventory_logs` VALUES (4, 1, 'wow', '2', '2024-10-14 14:46:27', 'Rejected', 2222);
INSERT INTO `inventory_logs` VALUES (5, 1, 'Approve Request', '2', '2024-10-14 14:51:12', 'Delivered', 2222);
INSERT INTO `inventory_logs` VALUES (6, 1, 'Approve Request', '2', '2024-10-14 14:51:15', 'Delivered', 2222);
INSERT INTO `inventory_logs` VALUES (7, 1, 'Approve Request', '2', '2024-10-16 10:32:47', 'Received', 2222);

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
INSERT INTO `mechanist_tbl` VALUES (2, 'mechanist', 'mechanist', 'mechanist@gmail.com', '123456789', 'mechanist gensan', '2024-10-11 09:57:22', 'mechanist', 'mechanist');
INSERT INTO `mechanist_tbl` VALUES (3, 'Sample', 'sampple', 'sample@gmail.cojm', '09124804022', 'gensan', '2024-10-11 20:26:53', 'sample', 'sample');

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
  `date_expired` date NULL DEFAULT NULL,
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of motorparts_tbl
-- ----------------------------
INSERT INTO `motorparts_tbl` VALUES (18, 'Computer', '11100-22223', 'transmission-and-drivetrain', 'showa', 5000.00, '7', '2', '2024-10-14 13:47:00', 'New', 'Motorcycle', 'uploads/131945163_4079243218772496_7963949365508560768_n.jpg', NULL);
INSERT INTO `motorparts_tbl` VALUES (19, 'brake', '11231231', 'protective-gear', 'wiseco', 250.00, '4000', '2', '2024-10-17 16:11:21', 'New', 'Motorcycle', 'uploads/P-BL-R3000_13966_1_750_750.jpeg', NULL);
INSERT INTO `motorparts_tbl` VALUES (20, 'ASD', '11100-22223', 'protective-gear', 'scorpion-exhausts', 123.00, '12', '2', '2024-10-17 14:40:02', 'New', 'Car', 'uploads/COPMP.jpg', '2024-10-17');

-- ----------------------------
-- Table structure for released_parts_tbl
-- ----------------------------
DROP TABLE IF EXISTS `released_parts_tbl`;
CREATE TABLE `released_parts_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sched_service_id` int NULL DEFAULT NULL,
  `part_id` int NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_released` date NULL DEFAULT current_timestamp,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of released_parts_tbl
-- ----------------------------
INSERT INTO `released_parts_tbl` VALUES (1, 1, 18, '190', '2024-10-14', 'Released');
INSERT INTO `released_parts_tbl` VALUES (2, 1, 18, '190', '2024-10-14', 'Released');
INSERT INTO `released_parts_tbl` VALUES (3, 1, 19, '99', '2024-10-14', 'Released');
INSERT INTO `released_parts_tbl` VALUES (4, 1, 18, '1', '2024-10-14', 'Released');
INSERT INTO `released_parts_tbl` VALUES (5, 1, 18, '1', '2024-10-14', 'Released');
INSERT INTO `released_parts_tbl` VALUES (6, 1, 18, '1', '2024-10-14', 'Released');
INSERT INTO `released_parts_tbl` VALUES (7, 1, 19, '1', '2024-10-14', 'Released');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of reorders_tbl
-- ----------------------------
INSERT INTO `reorders_tbl` VALUES (1, 19, 2222, 250.00, '2024-10-14', '2024-10-19', '2', 'Received');

-- ----------------------------
-- Table structure for return_item_tbl
-- ----------------------------
DROP TABLE IF EXISTS `return_item_tbl`;
CREATE TABLE `return_item_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NULL DEFAULT NULL,
  `item_stock` int NULL DEFAULT NULL,
  `return_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `quantity_return` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `return_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of return_item_tbl
-- ----------------------------
INSERT INTO `return_item_tbl` VALUES (1, 19, NULL, 'w', NULL, '446', 2, '2024-10-17');
INSERT INTO `return_item_tbl` VALUES (2, 19, 4446, 'adasd', NULL, '4441', 2, '2024-10-17');
INSERT INTO `return_item_tbl` VALUES (3, 19, 4446, 'damage\r\n', 'Received', '446', 2, '2024-10-17');
INSERT INTO `return_item_tbl` VALUES (4, 19, 4446, 'asd', 'Received', '11', 2, '2024-10-17');
INSERT INTO `return_item_tbl` VALUES (5, 19, 4446, 'new\r\n', 'Received', '123', 2, '2024-10-17');
INSERT INTO `return_item_tbl` VALUES (6, 19, 4446, 'asd', 'Received', '446', 2, '2024-10-17');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of scheduling_services_tbl
-- ----------------------------
INSERT INTO `scheduling_services_tbl` VALUES (1, 6, 8, 1, 'carefully', '2024-10-12', '00:01:00', 2, 'safe to work', NULL, NULL, 'Completed');

-- ----------------------------
-- Table structure for services_tbl
-- ----------------------------
DROP TABLE IF EXISTS `services_tbl`;
CREATE TABLE `services_tbl`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `services_type` enum('Car','Motorcycle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `services_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of services_tbl
-- ----------------------------
INSERT INTO `services_tbl` VALUES (1, 'Motorcycle', 'Tune up', 150.00, 'Tune up using machine');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers_tbl
-- ----------------------------
INSERT INTO `suppliers_tbl` VALUES (2, 'sample shop', 'sample2', 'sample@gmail.com', '123456789', 'gensan', '2024-10-11 09:55:01', '', 'supplier', 'supplier');

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
INSERT INTO `user_table` VALUES (1, 'Specjj', 'Specjj', 'admin', 'admin@gmail.com', 'admin');
INSERT INTO `user_table` VALUES (2, 'Reymark', 'Gensan', 'sample1', 'reymarkescalante12@gmail.com', 'sample1');

SET FOREIGN_KEY_CHECKS = 1;
