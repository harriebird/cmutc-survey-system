/*
Navicat MySQL Data Transfer

Source Server         : SuperRootmi
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : cmu_tc

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-03-17 12:46:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `colleges`
-- ----------------------------
DROP TABLE IF EXISTS `colleges`;
CREATE TABLE `colleges` (
  `college_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_name` varchar(45) NOT NULL,
  PRIMARY KEY (`college_id`),
  UNIQUE KEY `college_id_UNIQUE` (`college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of colleges
-- ----------------------------
INSERT INTO `colleges` VALUES ('1', 'College of Agriculture');
INSERT INTO `colleges` VALUES ('2', 'College of Arts and Sciences');
INSERT INTO `colleges` VALUES ('3', 'College of Business and Management');
INSERT INTO `colleges` VALUES ('4', 'College of Education');
INSERT INTO `colleges` VALUES ('5', 'College of Engineering');
INSERT INTO `colleges` VALUES ('6', 'College of Forestry and Environmental Science');
INSERT INTO `colleges` VALUES ('7', 'College of Human Ecology');
INSERT INTO `colleges` VALUES ('8', 'College of Nursing');
INSERT INTO `colleges` VALUES ('9', 'College of Veterinary Medicine');

-- ----------------------------
-- Table structure for `offer_students`
-- ----------------------------
DROP TABLE IF EXISTS `offer_students`;
CREATE TABLE `offer_students` (
  `offstud_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enlist_date` datetime NOT NULL,
  `offstud_testimonial` text,
  `testi_posted` datetime DEFAULT NULL,
  PRIMARY KEY (`offstud_id`),
  KEY `fk_subject_offer_idx` (`offer_id`),
  KEY `fk_user_stud_idx` (`user_id`),
  CONSTRAINT `fk_subject_offer` FOREIGN KEY (`offer_id`) REFERENCES `subject_offers` (`offer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_stud` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of offer_students
-- ----------------------------

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(90) NOT NULL,
  `post_details` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `fk_user_post` (`user_id`),
  CONSTRAINT `fk_user_post` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for `programs`
-- ----------------------------
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(45) NOT NULL,
  `college_id` int(11) NOT NULL,
  PRIMARY KEY (`program_id`),
  UNIQUE KEY `program_id_UNIQUE` (`program_id`),
  KEY `fk_college_programs_idx` (`college_id`),
  CONSTRAINT `fk_college_programs` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES ('1', 'BS Agribusiness Management', '1');
INSERT INTO `programs` VALUES ('2', 'BS Agriculture - Agricultural Economics', '1');
INSERT INTO `programs` VALUES ('3', 'BS Agriculture - Agricultural Education', '1');
INSERT INTO `programs` VALUES ('4', 'BS Agriculture - Agricultural Extension', '1');
INSERT INTO `programs` VALUES ('5', 'BS Agriculture - Agronomy', '1');
INSERT INTO `programs` VALUES ('6', 'BS Agriculture - Animal Science', '1');
INSERT INTO `programs` VALUES ('7', 'BS Agriculture - Entomology', '1');
INSERT INTO `programs` VALUES ('8', 'BS Agriculture - Horticulture', '1');
INSERT INTO `programs` VALUES ('9', 'BS Agriculture - Plant Breeding', '1');
INSERT INTO `programs` VALUES ('10', 'BS Agriculture - Plant Pathology', '1');
INSERT INTO `programs` VALUES ('11', 'BS Asgriculture - Soil Science', '1');
INSERT INTO `programs` VALUES ('12', 'BS Development Communication', '1');
INSERT INTO `programs` VALUES ('13', 'AB English', '2');
INSERT INTO `programs` VALUES ('14', 'AB History', '2');
INSERT INTO `programs` VALUES ('15', 'AB Political Science', '2');
INSERT INTO `programs` VALUES ('16', 'AB Psychology', '2');
INSERT INTO `programs` VALUES ('17', 'AB Sociology', '2');
INSERT INTO `programs` VALUES ('18', 'BS Biology', '2');
INSERT INTO `programs` VALUES ('19', 'BS Chemistry', '2');
INSERT INTO `programs` VALUES ('20', 'BS Mathematics', '2');
INSERT INTO `programs` VALUES ('21', 'BS Physics', '2');
INSERT INTO `programs` VALUES ('22', 'BS Accountancy', '3');
INSERT INTO `programs` VALUES ('23', 'BS Business Administration', '3');
INSERT INTO `programs` VALUES ('24', 'BS Office Administration', '3');
INSERT INTO `programs` VALUES ('25', 'BS Education - Biology', '4');
INSERT INTO `programs` VALUES ('26', 'BS Education - English', '4');
INSERT INTO `programs` VALUES ('27', 'BS Education - Filipino', '4');
INSERT INTO `programs` VALUES ('28', 'BS Education - General Science', '4');
INSERT INTO `programs` VALUES ('29', 'BS Education - Mathematics', '4');
INSERT INTO `programs` VALUES ('30', 'BS Education - Physical Education', '4');
INSERT INTO `programs` VALUES ('31', 'BS Education - Physics', '4');
INSERT INTO `programs` VALUES ('32', 'BS Agricultural Engineering', '5');
INSERT INTO `programs` VALUES ('33', 'BS Civil Engineering', '5');
INSERT INTO `programs` VALUES ('34', 'BS Electrical Engineering', '5');
INSERT INTO `programs` VALUES ('35', 'BS Information Technology', '5');
INSERT INTO `programs` VALUES ('36', 'BS Mechanical Engineering', '5');
INSERT INTO `programs` VALUES ('37', 'BS Environmental Science', '6');
INSERT INTO `programs` VALUES ('38', 'BS Forestry', '6');
INSERT INTO `programs` VALUES ('39', 'BS Food Technology', '7');
INSERT INTO `programs` VALUES ('40', 'BS Home Economics - Food Business Management', '7');
INSERT INTO `programs` VALUES ('41', 'BS Home Economics - Home Economics Education', '7');
INSERT INTO `programs` VALUES ('42', 'BS Hotel and Restaurant Management', '7');
INSERT INTO `programs` VALUES ('43', 'BS Nutrition and Dietetics', '7');
INSERT INTO `programs` VALUES ('44', 'BS Nursing', '8');
INSERT INTO `programs` VALUES ('45', 'Doctor of Veterinary Medicine', '9');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(15) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Student');
INSERT INTO `roles` VALUES ('2', 'Tutor');
INSERT INTO `roles` VALUES ('3', 'Administrator');

-- ----------------------------
-- Table structure for `semesters`
-- ----------------------------
DROP TABLE IF EXISTS `semesters`;
CREATE TABLE `semesters` (
  `sem_id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_name` varchar(45) NOT NULL,
  `sem_num` tinyint(1) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`sem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of semesters
-- ----------------------------

-- ----------------------------
-- Table structure for `subjects`
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(12) NOT NULL,
  `subject_desc` varchar(70) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_id_UNIQUE` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subjects
-- ----------------------------

-- ----------------------------
-- Table structure for `subject_offers`
-- ----------------------------
DROP TABLE IF EXISTS `subject_offers`;
CREATE TABLE `subject_offers` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_date` datetime NOT NULL,
  `sem_id` int(11) NOT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `fk_user_offer_idx` (`user_id`),
  KEY `fk_subject_offer_idx` (`subject_id`),
  KEY `fk_offer_sem_idx` (`sem_id`),
  CONSTRAINT `fk_offer_sem` FOREIGN KEY (`sem_id`) REFERENCES `semesters` (`sem_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_offer` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subject_offers
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) NOT NULL,
  `user_pass` varchar(45) NOT NULL,
  `user_lname` varchar(30) NOT NULL,
  `user_fname` varchar(30) NOT NULL,
  `user_mname` varchar(30) NOT NULL,
  `user_gender` varchar(1) NOT NULL,
  `user_bday` date NOT NULL,
  `program_id` int(11) NOT NULL,
  `user_verified` tinyint(1) NOT NULL,
  `user_vcode` varchar(8) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_reg` date NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  KEY `fk_user_program_idx` (`program_id`),
  KEY `fk_user_role_idx` (`role_id`),
  CONSTRAINT `fk_user_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', 'Administrator', 'Super', 'M', '1996-03-08', '35', '1', '63048180', '3', '2016-02-28', '2016-03-17 12:19:39');
