/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.10-MariaDB : Database - auth_role
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`auth_role` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `auth_role`;

/*Table structure for table `administrator` */

DROP TABLE IF EXISTS `administrator`;

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v_name` varchar(100) NOT NULL,
  `v_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `d_last_login_date` datetime NOT NULL,
  `v_access_code` varchar(100) NOT NULL,
  `v_image` varchar(100) NOT NULL,
  `e_is_super_admin` enum('Yes','No') NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `e_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `administrator` */

insert  into `administrator`(`id`,`v_name`,`v_email`,`password`,`d_last_login_date`,`v_access_code`,`v_image`,`e_is_super_admin`,`remember_token`,`e_status`,`created_at`,`updated_at`) values (1,'Admin','admin@gmail.com','$2y$10$g/JPSjlSOUpEu6DI0OkdXuDbdVs2TzaQ8ey4eUu3oumm3y6..S/iC','2020-02-20 11:55:41','','1464676177-P1rZGL.png','Yes','F5FqYoplj4rI7IYFiwnhBIErLkeKeWIB9CoIkDQQ0dqoQqyxMiu56dJxkc86','Active','0000-00-00 00:00:00','2020-02-18 08:21:21');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (5,'2014_10_12_000000_create_users_table',1),(6,'2014_10_12_100000_create_password_resets_table',1),(7,'2020_02_18_052131_entrust_setup_tables',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values (1,3),(2,3),(3,2),(4,1),(5,3),(6,3),(7,2),(8,1),(9,3),(10,3),(11,2),(12,1);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'add-sliderimage','Add Slider Image','Add User Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(2,'edit-sliderimage','Edit Slider Image','Edit User Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(3,'delete-sliderimage','Delete Slider Image','Delete User Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(4,'list-sliderimage','List Slider Image','List User Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(5,'add-category','Add Category','Add Category Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(6,'edit-category','Edit Category','Edit Category Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(7,'delete-category','Delete Category','Delete Category Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(8,'list-category','List Category','List Category Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(9,'add-product','Add Product','Add Product Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(10,'edit-product','Edit Product','Edit Product Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(11,'delete-product','Delete Product','Delete Product Permission','2020-02-16 00:00:00','2020-02-17 00:00:00'),(12,'list-product','List Product','List Product Permission','2020-02-16 00:00:00','2020-02-17 00:00:00');

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`user_id`,`role_id`) values (1,1),(1,2),(1,3),(4,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'shopkeeper','ShopKeeper','Shop Keeper Role','2020-02-15 00:00:00','2020-02-15 00:00:00'),(2,'merchant','Merchant','Merchant Role','2020-02-15 00:00:00','2020-02-15 00:00:00'),(3,'developer','Developer','Developer Role','2020-02-15 00:00:00','2020-02-15 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `unique_user_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`unique_user_id`,`remember_token`,`created_at`,`updated_at`) values (1,'Niraj Radadiya','radadiya.niraj@gmail.com',NULL,'peopAuth|6ae1acf2-1e42-4d6c-ba41-3774a731b377',NULL,'2020-02-18 05:44:22','2020-02-20 10:44:10'),(4,'NExpert','nxpertdeveloper@gmail.com',NULL,'peopAuth|30d36d33-04b5-42e0-8f40-2e5ab7275762',NULL,'2020-02-18 05:44:22','2020-02-20 11:19:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
