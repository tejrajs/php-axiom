--
-- Axiom: a lightweight PHP framework
--
-- @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
-- @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
--

--
-- Table structure for table `ax_files`
--

DROP TABLE IF EXISTS `ax_files`;
CREATE TABLE `ax_files` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `filename` varchar(90) NOT NULL,
  `path` text NOT NULL,
  `mime_type` varchar(45) NOT NULL,
  `upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ax_users_id` bigint(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ax_files_ax_users` (`ax_users_id`),
  CONSTRAINT `fk_ax_files_ax_users` FOREIGN KEY (`ax_users_id`) REFERENCES `ax_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Table structure for table `ax_users`
--

DROP TABLE IF EXISTS `ax_users`;
CREATE TABLE `ax_users` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `login` varchar(90) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(90) NOT NULL,
  `surname` varchar(90) NOT NULL,
  `creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_connection` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ax_users`
--

LOCK TABLES `ax_users` WRITE;
INSERT INTO `ax_users` VALUES (1,'admin',md5('admin'),'Delespierre','Benjamin','2011-07-06 08:20:45','2011-09-01 14:53:12');
UNLOCK TABLES;

