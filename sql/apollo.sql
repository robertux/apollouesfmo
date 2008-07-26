-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51-3


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema apollo
--

CREATE DATABASE IF NOT EXISTS apollo;
USE apollo;

--
-- Definition of table `apollo`.`alumno`
--

DROP TABLE IF EXISTS `apollo`.`alumno`;
CREATE TABLE  `apollo`.`alumno` (
  `id` int(11) NOT NULL auto_increment,
  `apellidos` varchar(200) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(8) default NULL,
  `fechanacimiento` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_usuario_id_alumno` (`usuario`),
  CONSTRAINT `fk_usuario_id_alumno` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`alumno`
--

/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
LOCK TABLES `alumno` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


--
-- Definition of table `apollo`.`asignacion`
--

DROP TABLE IF EXISTS `apollo`.`asignacion`;
CREATE TABLE  `apollo`.`asignacion` (
  `id` int(10) unsigned NOT NULL,
  `usuario` int(11) NOT NULL default '0',
  `privilegio` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_asignacion_id_privilegio` (`privilegio`),
  CONSTRAINT `FK_asignacion_id_privilegio` FOREIGN KEY (`privilegio`) REFERENCES `privilegio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`asignacion`
--

/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
LOCK TABLES `asignacion` WRITE;
INSERT INTO `apollo`.`asignacion` VALUES  (1,4,4);
UNLOCK TABLES;
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;


--
-- Definition of table `apollo`.`costo`
--

DROP TABLE IF EXISTS `apollo`.`costo`;
CREATE TABLE  `apollo`.`costo` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_costo` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_costo` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`costo`
--

/*!40000 ALTER TABLE `costo` DISABLE KEYS */;
LOCK TABLES `costo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `costo` ENABLE KEYS */;


--
-- Definition of table `apollo`.`curso`
--

DROP TABLE IF EXISTS `apollo`.`curso`;
CREATE TABLE  `apollo`.`curso` (
  `id` int(11) NOT NULL auto_increment,
  `fechainicio` date NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_curso` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_curso` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
LOCK TABLES `curso` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


--
-- Definition of table `apollo`.`docente`
--

DROP TABLE IF EXISTS `apollo`.`docente`;
CREATE TABLE  `apollo`.`docente` (
  `id` int(11) NOT NULL auto_increment,
  `apellidos` varchar(200) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `gradoacademico` varchar(50) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_usuario_id_docente` (`usuario`),
  CONSTRAINT `fk_usuario_id_docente` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`docente`
--

/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
LOCK TABLES `docente` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;


--
-- Definition of table `apollo`.`evaluacion`
--

DROP TABLE IF EXISTS `apollo`.`evaluacion`;
CREATE TABLE  `apollo`.`evaluacion` (
  `id` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `porcentaje` double NOT NULL,
  `nota` double NOT NULL,
  `modulo` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_modulo_id_evaluacion` (`modulo`),
  CONSTRAINT `fk_modulo_id_evaluacion` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`evaluacion`
--

/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
LOCK TABLES `evaluacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_bans`
--

DROP TABLE IF EXISTS `apollo`.`foro_bans`;
CREATE TABLE  `apollo`.`foro_bans` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(200) default NULL,
  `ip` varchar(255) default NULL,
  `email` varchar(50) default NULL,
  `message` varchar(255) default NULL,
  `expire` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_bans`
--

/*!40000 ALTER TABLE `foro_bans` DISABLE KEYS */;
LOCK TABLES `foro_bans` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_bans` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_categories`
--

DROP TABLE IF EXISTS `apollo`.`foro_categories`;
CREATE TABLE  `apollo`.`foro_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_name` varchar(80) NOT NULL default 'New Category',
  `disp_position` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_categories`
--

/*!40000 ALTER TABLE `foro_categories` DISABLE KEYS */;
LOCK TABLES `foro_categories` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_categories` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_censoring`
--

DROP TABLE IF EXISTS `apollo`.`foro_censoring`;
CREATE TABLE  `apollo`.`foro_censoring` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `search_for` varchar(60) NOT NULL default '',
  `replace_with` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_censoring`
--

/*!40000 ALTER TABLE `foro_censoring` DISABLE KEYS */;
LOCK TABLES `foro_censoring` WRITE;
INSERT INTO `apollo`.`foro_censoring` VALUES  (1,'puta','****'),
 (2,'cerote','******');
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_censoring` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_config`
--

DROP TABLE IF EXISTS `apollo`.`foro_config`;
CREATE TABLE  `apollo`.`foro_config` (
  `conf_name` varchar(255) NOT NULL default '',
  `conf_value` text,
  PRIMARY KEY  (`conf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_config`
--

/*!40000 ALTER TABLE `foro_config` DISABLE KEYS */;
LOCK TABLES `foro_config` WRITE;
INSERT INTO `apollo`.`foro_config` VALUES  ('o_cur_version','1.2.17'),
 ('o_board_title','Unidad de PostGrados, UES-FMOcc'),
 ('o_board_desc','¡Hacia la libertad, por la Cultura!'),
 ('o_server_timezone','0'),
 ('o_time_format','H:i:s'),
 ('o_date_format','Y-m-d'),
 ('o_timeout_visit','600'),
 ('o_timeout_online','300'),
 ('o_redirect_delay','1'),
 ('o_show_version','0'),
 ('o_show_user_info','1'),
 ('o_show_post_count','1'),
 ('o_smilies','1'),
 ('o_smilies_sig','1'),
 ('o_make_links','1'),
 ('o_default_lang','Spanish'),
 ('o_default_style','Minerva'),
 ('o_default_user_group','4'),
 ('o_topic_review','15'),
 ('o_disp_topics_default','30'),
 ('o_disp_posts_default','25'),
 ('o_indent_num_spaces','4'),
 ('o_quickpost','0'),
 ('o_users_online','1'),
 ('o_censoring','0'),
 ('o_ranks','1'),
 ('o_show_dot','0'),
 ('o_quickjump','0'),
 ('o_gzip','0'),
 ('o_additional_navlinks',''),
 ('o_report_method','0'),
 ('o_regs_report','0'),
 ('o_mailing_list','lista@email.com'),
 ('o_avatars','0'),
 ('o_avatars_dir','');
INSERT INTO `apollo`.`foro_config` VALUES  ('o_avatars_width','0'),
 ('o_avatars_height','0'),
 ('o_avatars_size','0'),
 ('o_search_all_forums','1'),
 ('o_base_url','http://localhost/apollo'),
 ('o_admin_email','admin@email.com'),
 ('o_webmaster_email','webmaster@email.com'),
 ('o_subscriptions','0'),
 ('o_smtp_host',NULL),
 ('o_smtp_user',NULL),
 ('o_smtp_pass',NULL),
 ('o_regs_allow','1'),
 ('o_regs_verify','0'),
 ('o_announcement','0'),
 ('o_announcement_message','Se han terminado las pruebas con el foro.\nFalta afinar algunos detalles.'),
 ('o_rules','0'),
 ('o_rules_message','Entra tus reglas aqui...'),
 ('o_maintenance','0'),
 ('o_maintenance_message','El foro esta temporalmente de baja por motivos de mantenimiento, por favor intente de nuevo en algunos minutos<br />\n<br />\n/Administrator'),
 ('p_mod_edit_users','1'),
 ('p_mod_rename_users','0'),
 ('p_mod_change_passwords','0'),
 ('p_mod_ban_users','0'),
 ('p_message_bbcode','1'),
 ('p_message_img_tag','1'),
 ('p_message_all_caps','1'),
 ('p_subject_all_caps','1');
INSERT INTO `apollo`.`foro_config` VALUES  ('p_sig_all_caps','1'),
 ('p_sig_bbcode','1'),
 ('p_sig_img_tag','0'),
 ('p_sig_length','400'),
 ('p_sig_lines','4'),
 ('p_allow_banned_email','1'),
 ('p_allow_dupe_email','0'),
 ('p_force_guest_email','1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_config` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_forum_perms`
--

DROP TABLE IF EXISTS `apollo`.`foro_forum_perms`;
CREATE TABLE  `apollo`.`foro_forum_perms` (
  `group_id` int(10) NOT NULL default '0',
  `forum_id` int(10) NOT NULL default '0',
  `read_forum` tinyint(1) NOT NULL default '1',
  `post_replies` tinyint(1) NOT NULL default '1',
  `post_topics` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`group_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_forum_perms`
--

/*!40000 ALTER TABLE `foro_forum_perms` DISABLE KEYS */;
LOCK TABLES `foro_forum_perms` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_forum_perms` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_forums`
--

DROP TABLE IF EXISTS `apollo`.`foro_forums`;
CREATE TABLE  `apollo`.`foro_forums` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `forum_name` varchar(80) NOT NULL default 'New forum',
  `forum_desc` text,
  `redirect_url` varchar(100) default NULL,
  `moderators` text,
  `num_topics` mediumint(8) unsigned NOT NULL default '0',
  `num_posts` mediumint(8) unsigned NOT NULL default '0',
  `last_post` int(10) unsigned default NULL,
  `last_post_id` int(10) unsigned default NULL,
  `last_poster` varchar(200) default NULL,
  `sort_by` tinyint(1) NOT NULL default '0',
  `disp_position` int(10) NOT NULL default '0',
  `cat_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_forums`
--

/*!40000 ALTER TABLE `foro_forums` DISABLE KEYS */;
LOCK TABLES `foro_forums` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_forums` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_groups`
--

DROP TABLE IF EXISTS `apollo`.`foro_groups`;
CREATE TABLE  `apollo`.`foro_groups` (
  `g_id` int(10) unsigned NOT NULL auto_increment,
  `g_title` varchar(50) NOT NULL default '',
  `g_user_title` varchar(50) default NULL,
  `g_read_board` tinyint(1) NOT NULL default '1',
  `g_post_replies` tinyint(1) NOT NULL default '1',
  `g_post_topics` tinyint(1) NOT NULL default '1',
  `g_post_polls` tinyint(1) NOT NULL default '1',
  `g_edit_posts` tinyint(1) NOT NULL default '1',
  `g_delete_posts` tinyint(1) NOT NULL default '1',
  `g_delete_topics` tinyint(1) NOT NULL default '1',
  `g_set_title` tinyint(1) NOT NULL default '1',
  `g_search` tinyint(1) NOT NULL default '1',
  `g_search_users` tinyint(1) NOT NULL default '1',
  `g_edit_subjects_interval` smallint(6) NOT NULL default '300',
  `g_post_flood` smallint(6) NOT NULL default '30',
  `g_search_flood` smallint(6) NOT NULL default '30',
  PRIMARY KEY  (`g_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_groups`
--

/*!40000 ALTER TABLE `foro_groups` DISABLE KEYS */;
LOCK TABLES `foro_groups` WRITE;
INSERT INTO `apollo`.`foro_groups` VALUES  (1,'Administrators','Administrator',1,1,1,1,1,1,1,1,1,1,0,0,0),
 (2,'Moderators','Moderator',1,1,1,1,1,1,1,1,1,1,0,0,0),
 (3,'Guest',NULL,1,0,0,0,0,0,0,0,1,1,0,0,0),
 (4,'Members',NULL,1,1,1,1,1,1,1,0,1,1,300,60,30);
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_groups` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_online`
--

DROP TABLE IF EXISTS `apollo`.`foro_online`;
CREATE TABLE  `apollo`.`foro_online` (
  `user_id` int(10) unsigned NOT NULL default '1',
  `ident` varchar(200) NOT NULL default '',
  `logged` int(10) unsigned NOT NULL default '0',
  `idle` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `foro_online_user_id_ident_idx` (`user_id`,`ident`),
  KEY `foro_online_user_id_idx` (`user_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_online`
--

/*!40000 ALTER TABLE `foro_online` DISABLE KEYS */;
LOCK TABLES `foro_online` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_online` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_posts`
--

DROP TABLE IF EXISTS `apollo`.`foro_posts`;
CREATE TABLE  `apollo`.`foro_posts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `poster` varchar(200) NOT NULL default '',
  `poster_id` int(10) unsigned NOT NULL default '1',
  `poster_ip` varchar(15) default NULL,
  `poster_email` varchar(50) default NULL,
  `message` text,
  `hide_smilies` tinyint(1) NOT NULL default '0',
  `posted` int(10) unsigned NOT NULL default '0',
  `edited` int(10) unsigned default NULL,
  `edited_by` varchar(200) default NULL,
  `topic_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `foro_posts_topic_id_idx` (`topic_id`),
  KEY `foro_posts_multi_idx` (`poster_id`,`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_posts`
--

/*!40000 ALTER TABLE `foro_posts` DISABLE KEYS */;
LOCK TABLES `foro_posts` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_posts` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_ranks`
--

DROP TABLE IF EXISTS `apollo`.`foro_ranks`;
CREATE TABLE  `apollo`.`foro_ranks` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `rank` varchar(50) NOT NULL default '',
  `min_posts` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_ranks`
--

/*!40000 ALTER TABLE `foro_ranks` DISABLE KEYS */;
LOCK TABLES `foro_ranks` WRITE;
INSERT INTO `apollo`.`foro_ranks` VALUES  (1,'Nuevo Miembro',0),
 (2,'Miembro',20),
 (3,'Miembro Activo',40);
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_ranks` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_reports`
--

DROP TABLE IF EXISTS `apollo`.`foro_reports`;
CREATE TABLE  `apollo`.`foro_reports` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `post_id` int(10) unsigned NOT NULL default '0',
  `topic_id` int(10) unsigned NOT NULL default '0',
  `forum_id` int(10) unsigned NOT NULL default '0',
  `reported_by` int(10) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL default '0',
  `message` text,
  `zapped` int(10) unsigned default NULL,
  `zapped_by` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `foro_reports_zapped_idx` (`zapped`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_reports`
--

/*!40000 ALTER TABLE `foro_reports` DISABLE KEYS */;
LOCK TABLES `foro_reports` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_reports` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_search_cache`
--

DROP TABLE IF EXISTS `apollo`.`foro_search_cache`;
CREATE TABLE  `apollo`.`foro_search_cache` (
  `id` int(10) unsigned NOT NULL default '0',
  `ident` varchar(200) NOT NULL default '',
  `search_data` text,
  PRIMARY KEY  (`id`),
  KEY `foro_search_cache_ident_idx` (`ident`(8))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_search_cache`
--

/*!40000 ALTER TABLE `foro_search_cache` DISABLE KEYS */;
LOCK TABLES `foro_search_cache` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_search_cache` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_search_matches`
--

DROP TABLE IF EXISTS `apollo`.`foro_search_matches`;
CREATE TABLE  `apollo`.`foro_search_matches` (
  `post_id` int(10) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `subject_match` tinyint(1) NOT NULL default '0',
  KEY `foro_search_matches_word_id_idx` (`word_id`),
  KEY `foro_search_matches_post_id_idx` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_search_matches`
--

/*!40000 ALTER TABLE `foro_search_matches` DISABLE KEYS */;
LOCK TABLES `foro_search_matches` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_search_matches` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_search_words`
--

DROP TABLE IF EXISTS `apollo`.`foro_search_words`;
CREATE TABLE  `apollo`.`foro_search_words` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` varchar(20) character set utf8 collate utf8_bin NOT NULL default '',
  PRIMARY KEY  (`word`),
  KEY `foro_search_words_id_idx` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_search_words`
--

/*!40000 ALTER TABLE `foro_search_words` DISABLE KEYS */;
LOCK TABLES `foro_search_words` WRITE;
INSERT INTO `apollo`.`foro_search_words` VALUES  (2,0x707275656261);
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_search_words` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_subscriptions`
--

DROP TABLE IF EXISTS `apollo`.`foro_subscriptions`;
CREATE TABLE  `apollo`.`foro_subscriptions` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `topic_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_subscriptions`
--

/*!40000 ALTER TABLE `foro_subscriptions` DISABLE KEYS */;
LOCK TABLES `foro_subscriptions` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_subscriptions` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_topics`
--

DROP TABLE IF EXISTS `apollo`.`foro_topics`;
CREATE TABLE  `apollo`.`foro_topics` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `poster` varchar(200) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `posted` int(10) unsigned NOT NULL default '0',
  `last_post` int(10) unsigned NOT NULL default '0',
  `last_post_id` int(10) unsigned NOT NULL default '0',
  `last_poster` varchar(200) default NULL,
  `num_views` mediumint(8) unsigned NOT NULL default '0',
  `num_replies` mediumint(8) unsigned NOT NULL default '0',
  `closed` tinyint(1) NOT NULL default '0',
  `sticky` tinyint(1) NOT NULL default '0',
  `moved_to` int(10) unsigned default NULL,
  `forum_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `foro_topics_forum_id_idx` (`forum_id`),
  KEY `foro_topics_moved_to_idx` (`moved_to`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_topics`
--

/*!40000 ALTER TABLE `foro_topics` DISABLE KEYS */;
LOCK TABLES `foro_topics` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_topics` ENABLE KEYS */;


--
-- Definition of table `apollo`.`foro_users`
--

DROP TABLE IF EXISTS `apollo`.`foro_users`;
CREATE TABLE  `apollo`.`foro_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `group_id` int(10) unsigned NOT NULL default '4',
  `username` varchar(200) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `title` varchar(50) default NULL,
  `realname` varchar(40) default NULL,
  `url` varchar(100) default NULL,
  `jabber` varchar(75) default NULL,
  `icq` varchar(12) default NULL,
  `msn` varchar(50) default NULL,
  `aim` varchar(30) default NULL,
  `yahoo` varchar(30) default NULL,
  `location` varchar(30) default NULL,
  `use_avatar` tinyint(1) NOT NULL default '0',
  `signature` text,
  `disp_topics` tinyint(3) unsigned default NULL,
  `disp_posts` tinyint(3) unsigned default NULL,
  `email_setting` tinyint(1) NOT NULL default '1',
  `save_pass` tinyint(1) NOT NULL default '1',
  `notify_with_post` tinyint(1) NOT NULL default '0',
  `show_smilies` tinyint(1) NOT NULL default '1',
  `show_img` tinyint(1) NOT NULL default '1',
  `show_img_sig` tinyint(1) NOT NULL default '1',
  `show_avatars` tinyint(1) NOT NULL default '1',
  `show_sig` tinyint(1) NOT NULL default '1',
  `timezone` float NOT NULL default '0',
  `language` varchar(25) NOT NULL default 'English',
  `style` varchar(25) NOT NULL default 'Oxygen',
  `num_posts` int(10) unsigned NOT NULL default '0',
  `last_post` int(10) unsigned default NULL,
  `registered` int(10) unsigned NOT NULL default '0',
  `registration_ip` varchar(15) NOT NULL default '0.0.0.0',
  `last_visit` int(10) unsigned NOT NULL default '0',
  `admin_note` varchar(30) default NULL,
  `activate_string` varchar(50) default NULL,
  `activate_key` varchar(8) default NULL,
  PRIMARY KEY  (`id`),
  KEY `foro_users_registered_idx` (`registered`),
  KEY `foro_users_username_idx` (`username`(8))
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`foro_users`
--

/*!40000 ALTER TABLE `foro_users` DISABLE KEYS */;
LOCK TABLES `foro_users` WRITE;
INSERT INTO `apollo`.`foro_users` VALUES  (1,3,'Guest','Guest','Guest',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'English','Oxygen',0,NULL,0,'0.0.0.0',0,NULL,NULL,NULL),
 (2,1,'ramayac','d033e22ae348aeb5660fc2140aec35850c4da997','ramayac@gmail.com','Br.','Rodrigo Amaya','http://SrByte.blogspot.com',NULL,NULL,NULL,NULL,NULL,'Santa Ana',0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'English','Sulfur',3,1214767309,1211988301,'127.0.0.1',1215065425,NULL,NULL,NULL),
 (4,4,'robertux','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','foo@bar.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,-6,'Spanish','Minerva',0,NULL,1214966189,'127.0.0.1',1214967051,NULL,NULL,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `foro_users` ENABLE KEYS */;


--
-- Definition of table `apollo`.`horario`
--

DROP TABLE IF EXISTS `apollo`.`horario`;
CREATE TABLE  `apollo`.`horario` (
  `id` int(11) NOT NULL auto_increment,
  `dia` int(11) NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time NOT NULL,
  `aula` varchar(25) NOT NULL,
  `frecuencia` varchar(25) NOT NULL,
  `modulo` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_modulo_id_horario` (`modulo`),
  CONSTRAINT `fk_modulo_id_horario` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
LOCK TABLES `horario` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `apollo`.`inscripcion`
--

DROP TABLE IF EXISTS `apollo`.`inscripcion`;
CREATE TABLE  `apollo`.`inscripcion` (
  `id` int(11) NOT NULL auto_increment,
  `alumno` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `notafinal` double NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_alumno_id_inscripcion` (`alumno`),
  KEY `fk_curso_id_inscripcion` (`curso`),
  CONSTRAINT `fk_alumno_id_inscripcion` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`id`),
  CONSTRAINT `fk_curso_id_inscripcion` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`inscripcion`
--

/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
LOCK TABLES `inscripcion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;


--
-- Definition of table `apollo`.`materia`
--

DROP TABLE IF EXISTS `apollo`.`materia`;
CREATE TABLE  `apollo`.`materia` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `uvs` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `requisitopara` text,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_materia` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_materia` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`materia`
--

/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
LOCK TABLES `materia` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;


--
-- Definition of table `apollo`.`modulo`
--

DROP TABLE IF EXISTS `apollo`.`modulo`;
CREATE TABLE  `apollo`.`modulo` (
  `id` int(11) NOT NULL auto_increment,
  `correlativo` int(11) NOT NULL,
  `docente` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `duracion` int(11) NOT NULL,
  `notafinal` double NOT NULL,
  `curso` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_curso_id_modulo` (`curso`),
  KEY `fk_docente_id_modulo` (`docente`),
  KEY `fk_materia_id_modulo` (`materia`),
  CONSTRAINT `fk_curso_id_modulo` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `fk_docente_id_modulo` FOREIGN KEY (`docente`) REFERENCES `docente` (`id`),
  CONSTRAINT `fk_materia_id_modulo` FOREIGN KEY (`materia`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`modulo`
--

/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
LOCK TABLES `modulo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;


--
-- Definition of table `apollo`.`novedades`
--

DROP TABLE IF EXISTS `apollo`.`novedades`;
CREATE TABLE  `apollo`.`novedades` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `titulo` varchar(50) NOT NULL,
  `vinculo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FECHA` (`fecha`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apollo`.`novedades`
--

/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
LOCK TABLES `novedades` WRITE;
INSERT INTO `apollo`.`novedades` VALUES  (10,'Primer Post','','<p>Contenido del primer post</p><p>','2008-07-20 00:00:00'),
 (11,'Este post no va a aparecer en la lista','','<p>Ya que segun la paginacion, solo se muestran diez. Este seria el onceavo.</p>','2008-07-20 00:00:00'),
 (8,'Nuevo Post777','','<p>Contenido del nuevo post777</p><p>','2008-07-23 00:00:00'),
 (3,'Nuevo Post222','','<p>Contenido del nuevo post222</p><p>','2008-07-18 00:00:00'),
 (4,'Nuevo Post3','','<p>Contenido del nuevo post3</p>','2008-07-19 00:00:00'),
 (5,'Nuevo Post4','','<p>Contenido del nuevo post4</p>','2008-07-20 00:00:00'),
 (6,'Nuevo Post5','','<p>Contenido del nuevo post5</p>','2008-07-21 00:00:00'),
 (7,'Nuevo Post6','','<p>Contenido del nuevo post6</p>','2008-07-22 00:00:00'),
 (12,'Nuevisimo Post','','<p>Contenido del nuevo post.</p><p>Calientito.</p><p>Acabado de salir del horno.</p>','2008-07-24 00:00:00'),
 (13,'Nuevo Post desde Host Remoto','','<p>Contenido del nuevo post creado desde un host remoto.</p>','2008-07-24 00:00:00'),
 (14,'Probando Agregar un Nuevo Post','','<p>Contenido del nuevo post</p><p>Esperemos que funcione</p><p>Yo digo que si funcionara.</p><p>Si funciona, me voy en este mismo instante a preparame una taza de cafe.</p><p>Sino, no me movere de aca hasta armar un progreso commiteable.</p>','2008-07-25 00:00:00');
INSERT INTO `apollo`.`novedades` VALUES  (17,'Nuevo Post de Pruebas','','<p>Contenido del nuevo post</p>','2008-07-25 00:00:00'),
 (16,'Otro Post de Pruebas','','<p>Este es otro post para ver porque no funciona la autopaginacion al agregar/borrar posts.</p>','2008-07-25 00:00:00'),
 (18,'Nuevo Post de Prueba de Fuego','','<p>Contenido del nuevo post.</p><p>Con esto confirmo que en realidad funciona el hack que le acabo de hacer.</p>','2008-07-25 00:00:00'),
 (19,'Nuevo Post - Prueba de Fuego Definitiva','','<p>Contenido del nuevo post.</p><p>Ahora si, supuestamente elimine todos los bugs.</p><p>A ver si en realidad funciona...</p>','2008-07-25 00:00:00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;


--
-- Definition of table `apollo`.`postgrado`
--

DROP TABLE IF EXISTS `apollo`.`postgrado`;
CREATE TABLE  `apollo`.`postgrado` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `notaminima` double unsigned NOT NULL default '7',
  `totaluvs` int(10) unsigned NOT NULL default '0',
  `cumminimo` double unsigned NOT NULL default '7.5',
  `abreviatura` varchar(8) default NULL,
  `maxalum` int(11) NOT NULL default '0',
  `presentacion` text,
  `descripcion` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`postgrado`
--

/*!40000 ALTER TABLE `postgrado` DISABLE KEYS */;
LOCK TABLES `postgrado` WRITE;
INSERT INTO `apollo`.`postgrado` VALUES  (1,'Maestría y Técnicas de Investigación Social',7,999,7.5,'MTIS',999,'La Maestría en Métodos y Técnicas de Investigación Social, es un esfuerzo de carácter academico que las actuales autoridades impulsan par contribuir a elevar la calidad cientifica academica en la formacion permanente de  profesionales especializados en el dominio de las principales corrientes metodologicas y en el manejo de herramientas tecnicas y procedimentales para la obtencion, procesamiento, analisis y presentacion de datos. Que contribuyan al desarrollo del conocimiento cientifico en El Salvador y puedan proponer soluciones concretas a los diversos problemas de la realidad social.','Objetivos:\r\nFormar teórica y metodológicamente recurso humano especializado en investigación cuantitativa y cualitativa que contribuya al desarrollo del conocimiento cientifico a nivel regional y nacional.\r\nDesarrollar competencias en la planificacion, ejecucion y presentacion de informes de investigacion.\r\nGenerar sensibilidad por el estudio de aquellas problematicas sociales de interés nacional, que permitan la reflexión, el análisis y la propuesta de alternativas de solución.\r\n\r\nPoblación a la que se dirige el programa:\r\nLicenciados, Ingenieros, Máster o Doctores graduados de la Universidad debidamente autorizados por el Ministerio de Educación.'),
 (2,'Maestría en Consultoría Empresarial',7,999,7.5,'MAECE',999,'El programa de Maestría en consultoría Empresarial se desarrollará desde la perspectiva de integración del directivo o empresario en el rol de los negocios, en forma amplia abordando situaciones de la realidad de consultoría empresarial con un enfoque teórico y práctico.\r\nPara adquirir estas destrezas se define el programa con la intención de formar profesionales que asuman responsabilidades, que sepan cooperar entre organizaciones y con las personas, desde el conocimiento eficaz de las diferentes áreas de la empresa, entendiéndola de mejor manera y adquiriendo las competencias particulares del área relacionadas con la cooperación, la especialización, las innovaciones tecnológicas y la globalización de los mercados.\r\nLa MAECE es la formación profesional orientada a la excelencia académica donde se fortalecen los conocimientos, particularmente los especializados en técnicas de gestión; fomenta las capacidades personales y directivas, conceptuales y analíticas de cada participante, necesarias en la empresa actual.','Vision:\r\nSer lideres en la formación de profesionales a nivel de maestría, mejorando continuamente la calidad académica e incorporando en los planes de estudio contenidos programáticos que faciliten la efectiva ejecución de la gestión y consultoría empresarial.\r\nMision:\r\nFormar profesionales con iniciativa par organizar unidades especificas de negocios, con elevada formación teórico-practica para enfrentar los retos que demande el actual desarrollo empresarial y social.');
INSERT INTO `apollo`.`postgrado` VALUES  (3,'Maestría en Profesionalización de la Docencia Superior',7,999,7.5,'MPDC',999,'La Maestría en Profesionalización de la Docencia Superior, cuenta ya con una generación de graduados en la Facultad Multidisciplinaria de Occidente y con una segund ageneración en proceso de formación.\r\nLas metas y finalidades de este pograma de Maestría se orientan a la construcción de la educación superior como objeto de estudio. En tal sentido, el programa es una maestría académica que busca por una parte la profesionalización, entendida como el dominio pertinente de las competencias técnico-pedagógicas para el ejercicio docente a nivel superior, y por otra, la generación de conocimientos mediante la investigación académica sobre los distintos niveles del sistema educativo nacional (Parvularia, Básica, Media, Superior, no universitaria y Universitaria); así como de aquellas experiencias de gestión, promoción, innovación y evaluación en los diversos ámbitos de la educación salvadoreña.','El programa de maestria en profesionalizacion de la docencia superior nacio en un convenio entre la Universidad de El Salvador (UES) y la facultad de estudios superiores cuautitlán de la Universidad Autónoma de México (UNAM) en 1994. Se han graduado ya de este programa, diversos profesionales que laboran en instituciones publicas y privadas de todo el país.\r\nVisión:\r\nLa alta formación de cuadros académicos y profesionales, así como la generación de conocimientos mediante la investigación del que hacer educativo de la zona occidental del país; con el objeto de fortalecer los procesos de enseñanza-aprendizaje en los distintos niveles del sistema educativo nacional y la producción académica en función de la cualificación de la educación en general y la universitaria en particular.\r\nMisión:\r\nLa construcción de la educación y de una docencia universitaria de la zona occidental del país, como objeto de estudio, y su visualización como fenómeno socio-cultural asequible desde una prespectiva teórica transdisciplinar y una práctica íntimamente ligada a los campos social, económico y político; tomando como base la enseñanza integral desd ela perspectiva teórica práctica en el enfoque metodológico del trabajo analítico.');
UNLOCK TABLES;
/*!40000 ALTER TABLE `postgrado` ENABLE KEYS */;


--
-- Definition of table `apollo`.`privilegio`
--

DROP TABLE IF EXISTS `apollo`.`privilegio`;
CREATE TABLE  `apollo`.`privilegio` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`privilegio`
--

/*!40000 ALTER TABLE `privilegio` DISABLE KEYS */;
LOCK TABLES `privilegio` WRITE;
INSERT INTO `apollo`.`privilegio` VALUES  (1,'general'),
 (2,'estudiante'),
 (3,'maestro'),
 (4,'admin');
UNLOCK TABLES;
/*!40000 ALTER TABLE `privilegio` ENABLE KEYS */;


--
-- Definition of table `apollo`.`requisito`
--

DROP TABLE IF EXISTS `apollo`.`requisito`;
CREATE TABLE  `apollo`.`requisito` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_requisito` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_requisito` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='tabla de requisitos de graduacion';

--
-- Dumping data for table `apollo`.`requisito`
--

/*!40000 ALTER TABLE `requisito` DISABLE KEYS */;
LOCK TABLES `requisito` WRITE;
INSERT INTO `apollo`.`requisito` VALUES  (1,'Titulo de Licenciado, Ingeniero, Máster o Doctor, extendido por una Universidad Debidamente Autorizada.',1),
 (2,'Presentar solicitud de admisión y documentación exigida por Administración Académica.',1),
 (3,'Someterse a entrevista con el coordinador de la maestría.',1),
 (4,'Conocimiento básico de Internet, Word, Excel y Power Point.',1),
 (5,'Cancelación de solicitud de ingreso, la cual se pagara en colecturía de la Facultad.',2),
 (6,'Cancelación de Matrícula (Anual) de $17.14 .',2),
 (7,'Solicitud de Ingreso a la MAECE.',2),
 (8,'Presentar 2 fotografías a color tamaño cédula.',2),
 (9,'Presentar original y copia de la partida de nacimiento.',2),
 (10,'Presentar original y copia de DUI y NIT.',2),
 (11,'Original y copia del titulo de bachiller, firmado por el sustentante.',2),
 (12,'Certificación global de notas y del titulo universitario, debidamente autenticado por el MINED.',2),
 (13,'Presentar hoja de vida actualizada con sus respectivos atestados.',2),
 (14,'Realizarse exámenes médicos de: heces, orina, hemograma, baciloscopía o radiografía de tórax, VDLR o serologia, con los cuales deberá tramitar una certificación de salud de bienestar universitario.',2);
INSERT INTO `apollo`.`requisito` VALUES  (15,'Los profesionales graduados en el exterior presentar original y copia del titulo universitario y certificación global de notas autenticados por el MRE y aprobados por la UES.',2),
 (16,'Aprobar las asignaturas y seminario del plan de estudios.',3),
 (17,'Presentación del trabajo de graduación.',3),
 (18,'Cumplimiento del servicio social (300 horas).',3),
 (19,'Requisitos y trámites de graduación según los reglamentos de Administración Académica de la UES.',3);
UNLOCK TABLES;
/*!40000 ALTER TABLE `requisito` ENABLE KEYS */;


--
-- Definition of table `apollo`.`usuario`
--

DROP TABLE IF EXISTS `apollo`.`usuario`;
CREATE TABLE  `apollo`.`usuario` (
  `id` int(11) NOT NULL auto_increment,
  `clave` varchar(10) default NULL,
  `nombre` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apollo`.`usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
LOCK TABLES `usuario` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
