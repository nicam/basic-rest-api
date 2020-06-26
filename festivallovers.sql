/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80020
Source Host           : localhost:3306
Source Database       : festivallovers

Target Server Type    : MYSQL
Target Server Version : 80020
File Encoding         : 65001

Date: 2020-06-22 10:12:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `subtitle` text,
  `desc_title` text,
  `desc_lead` mediumtext,
  `desc_text` longtext,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `youtube_link` text,
  `genre_id` int unsigned DEFAULT NULL,
  `location_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `genre_id` (`genre_id`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `events_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES ('1', 'St.Galler Openair', 'sbeste wo gits', 'hier rockts', 'nochmehr text', 'noch vielmehr text', '2021-07-01', '2021-07-04', null, null, '2', '2020-05-20 13:10:08', '2020-05-20 13:44:48', null);
INSERT INTO `events` VALUES ('2', 'Gurtenfestival 2021', null, null, null, null, '2021-07-14', '2021-07-17', null, null, '3', '2020-05-20 14:31:21', '2020-05-20 14:31:28', null);

-- ----------------------------
-- Table structure for `genres`
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of genres
-- ----------------------------
INSERT INTO `genres` VALUES ('1', 'acid rock', '2020-05-20 12:46:55', null, null);
INSERT INTO `genres` VALUES ('2', 'adult alternative', '2020-05-20 12:47:21', null, null);
INSERT INTO `genres` VALUES ('3', 'alternative country', '2020-05-20 12:47:54', null, null);
INSERT INTO `genres` VALUES ('4', 'alternative hip hop', '2020-05-20 12:48:21', null, null);
INSERT INTO `genres` VALUES ('5', 'alternative metal', '2020-05-20 12:48:31', null, null);
INSERT INTO `genres` VALUES ('6', 'baroque pop', '2020-05-20 12:48:42', null, null);
INSERT INTO `genres` VALUES ('7', 'bebop', '2020-05-20 12:48:52', null, null);
INSERT INTO `genres` VALUES ('8', 'bhangra', '2020-05-20 12:49:04', null, null);
INSERT INTO `genres` VALUES ('9', 'big band', '2020-05-20 12:49:19', null, null);
INSERT INTO `genres` VALUES ('10', 'black metal', '2020-05-20 12:49:27', null, null);
INSERT INTO `genres` VALUES ('11', 'blue-eyed soul', '2020-05-20 12:53:57', null, null);
INSERT INTO `genres` VALUES ('12', 'bluegrass', '2020-05-20 12:54:05', null, null);
INSERT INTO `genres` VALUES ('13', 'C-pop', '2020-05-20 12:54:14', null, null);
INSERT INTO `genres` VALUES ('14', 'cajun', '2020-05-20 12:54:25', null, null);
INSERT INTO `genres` VALUES ('15', 'calypso', '2020-05-20 12:54:35', null, null);
INSERT INTO `genres` VALUES ('16', 'celtic', '2020-05-20 12:54:49', null, null);
INSERT INTO `genres` VALUES ('17', 'alternative rock', '2020-05-20 12:55:02', null, null);
INSERT INTO `genres` VALUES ('18', 'anarcho-punk', '2020-05-20 12:55:14', null, null);
INSERT INTO `genres` VALUES ('19', 'arabic pop', '2020-05-20 12:55:24', null, null);
INSERT INTO `genres` VALUES ('20', 'blues', '2020-05-20 12:55:50', null, null);
INSERT INTO `genres` VALUES ('21', 'blues rock', '2020-05-20 12:56:02', null, null);
INSERT INTO `genres` VALUES ('22', 'boogie woogie', '2020-05-20 12:56:12', null, null);
INSERT INTO `genres` VALUES ('23', 'british blues', '2020-05-20 12:56:23', null, null);
INSERT INTO `genres` VALUES ('24', 'britpop', '2020-05-20 12:56:32', null, null);
INSERT INTO `genres` VALUES ('25', 'country blues', '2020-05-20 15:19:23', null, null);
INSERT INTO `genres` VALUES ('26', 'country', '2020-05-20 15:19:34', null, null);
INSERT INTO `genres` VALUES ('27', 'country rock', '2020-05-20 15:19:49', null, null);

-- ----------------------------
-- Table structure for `locations`
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of locations
-- ----------------------------
INSERT INTO `locations` VALUES ('2', 'Sittertobel SG', '47.4264', '9.37602', '2020-05-20 13:10:45', '2020-05-20 13:13:47', null);
INSERT INTO `locations` VALUES ('3', 'Gurten', '48.2409', '13.3444', '2020-05-20 13:15:36', null, null);
INSERT INTO `locations` VALUES ('4', 'Glastonbury', '51.1474', '-2.71845', '2020-05-20 13:16:02', null, null);
