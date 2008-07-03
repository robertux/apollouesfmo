-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51a-community-nt


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
-- Definition of table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
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
-- Dumping data for table `alumno`
--

/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


--
-- Definition of table `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
CREATE TABLE `asignacion` (
  `id` int(10) unsigned NOT NULL,
  `usuario` int(11) NOT NULL default '0',
  `privilegio` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_asignacion_id_privilegio` (`privilegio`),
  CONSTRAINT `FK_asignacion_id_privilegio` FOREIGN KEY (`privilegio`) REFERENCES `privilegio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asignacion`
--

/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
INSERT INTO `asignacion` (`id`,`usuario`,`privilegio`) VALUES 
 (1,4,4);
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;


--
-- Definition of table `costo`
--

DROP TABLE IF EXISTS `costo`;
CREATE TABLE `costo` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_costo` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_costo` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costo`
--

/*!40000 ALTER TABLE `costo` DISABLE KEYS */;
/*!40000 ALTER TABLE `costo` ENABLE KEYS */;


--
-- Definition of table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id` int(11) NOT NULL auto_increment,
  `fechainicio` date NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_curso` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_curso` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


--
-- Definition of table `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
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
-- Dumping data for table `docente`
--

/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;


--
-- Definition of table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE `evaluacion` (
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
-- Dumping data for table `evaluacion`
--

/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;


--
-- Definition of table `foro_bans`
--

DROP TABLE IF EXISTS `foro_bans`;
CREATE TABLE `foro_bans` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(200) default NULL,
  `ip` varchar(255) default NULL,
  `email` varchar(50) default NULL,
  `message` varchar(255) default NULL,
  `expire` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_bans`
--

/*!40000 ALTER TABLE `foro_bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_bans` ENABLE KEYS */;


--
-- Definition of table `foro_categories`
--

DROP TABLE IF EXISTS `foro_categories`;
CREATE TABLE `foro_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_name` varchar(80) NOT NULL default 'New Category',
  `disp_position` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_categories`
--

/*!40000 ALTER TABLE `foro_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_categories` ENABLE KEYS */;


--
-- Definition of table `foro_censoring`
--

DROP TABLE IF EXISTS `foro_censoring`;
CREATE TABLE `foro_censoring` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `search_for` varchar(60) NOT NULL default '',
  `replace_with` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_censoring`
--

/*!40000 ALTER TABLE `foro_censoring` DISABLE KEYS */;
INSERT INTO `foro_censoring` (`id`,`search_for`,`replace_with`) VALUES 
 (1,'puta','****'),
 (2,'cerote','******');
/*!40000 ALTER TABLE `foro_censoring` ENABLE KEYS */;


--
-- Definition of table `foro_config`
--

DROP TABLE IF EXISTS `foro_config`;
CREATE TABLE `foro_config` (
  `conf_name` varchar(255) NOT NULL default '',
  `conf_value` text,
  PRIMARY KEY  (`conf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_config`
--

/*!40000 ALTER TABLE `foro_config` DISABLE KEYS */;
INSERT INTO `foro_config` (`conf_name`,`conf_value`) VALUES 
 ('o_cur_version','1.2.17'),
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
 ('o_avatars_dir',''),
 ('o_avatars_width','0'),
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
 ('p_subject_all_caps','1'),
 ('p_sig_all_caps','1'),
 ('p_sig_bbcode','1'),
 ('p_sig_img_tag','0'),
 ('p_sig_length','400'),
 ('p_sig_lines','4'),
 ('p_allow_banned_email','1'),
 ('p_allow_dupe_email','0'),
 ('p_force_guest_email','1');
/*!40000 ALTER TABLE `foro_config` ENABLE KEYS */;


--
-- Definition of table `foro_forum_perms`
--

DROP TABLE IF EXISTS `foro_forum_perms`;
CREATE TABLE `foro_forum_perms` (
  `group_id` int(10) NOT NULL default '0',
  `forum_id` int(10) NOT NULL default '0',
  `read_forum` tinyint(1) NOT NULL default '1',
  `post_replies` tinyint(1) NOT NULL default '1',
  `post_topics` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`group_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_forum_perms`
--

/*!40000 ALTER TABLE `foro_forum_perms` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_forum_perms` ENABLE KEYS */;


--
-- Definition of table `foro_forums`
--

DROP TABLE IF EXISTS `foro_forums`;
CREATE TABLE `foro_forums` (
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
-- Dumping data for table `foro_forums`
--

/*!40000 ALTER TABLE `foro_forums` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_forums` ENABLE KEYS */;


--
-- Definition of table `foro_groups`
--

DROP TABLE IF EXISTS `foro_groups`;
CREATE TABLE `foro_groups` (
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
-- Dumping data for table `foro_groups`
--

/*!40000 ALTER TABLE `foro_groups` DISABLE KEYS */;
INSERT INTO `foro_groups` (`g_id`,`g_title`,`g_user_title`,`g_read_board`,`g_post_replies`,`g_post_topics`,`g_post_polls`,`g_edit_posts`,`g_delete_posts`,`g_delete_topics`,`g_set_title`,`g_search`,`g_search_users`,`g_edit_subjects_interval`,`g_post_flood`,`g_search_flood`) VALUES 
 (1,'Administrators','Administrator',1,1,1,1,1,1,1,1,1,1,0,0,0),
 (2,'Moderators','Moderator',1,1,1,1,1,1,1,1,1,1,0,0,0),
 (3,'Guest',NULL,1,0,0,0,0,0,0,0,1,1,0,0,0),
 (4,'Members',NULL,1,1,1,1,1,1,1,0,1,1,300,60,30);
/*!40000 ALTER TABLE `foro_groups` ENABLE KEYS */;


--
-- Definition of table `foro_online`
--

DROP TABLE IF EXISTS `foro_online`;
CREATE TABLE `foro_online` (
  `user_id` int(10) unsigned NOT NULL default '1',
  `ident` varchar(200) NOT NULL default '',
  `logged` int(10) unsigned NOT NULL default '0',
  `idle` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `foro_online_user_id_ident_idx` (`user_id`,`ident`),
  KEY `foro_online_user_id_idx` (`user_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_online`
--

/*!40000 ALTER TABLE `foro_online` DISABLE KEYS */;
INSERT INTO `foro_online` (`user_id`,`ident`,`logged`,`idle`) VALUES 
 (1,'127.0.0.1',1215066011,0);
/*!40000 ALTER TABLE `foro_online` ENABLE KEYS */;


--
-- Definition of table `foro_posts`
--

DROP TABLE IF EXISTS `foro_posts`;
CREATE TABLE `foro_posts` (
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
-- Dumping data for table `foro_posts`
--

/*!40000 ALTER TABLE `foro_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_posts` ENABLE KEYS */;


--
-- Definition of table `foro_ranks`
--

DROP TABLE IF EXISTS `foro_ranks`;
CREATE TABLE `foro_ranks` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `rank` varchar(50) NOT NULL default '',
  `min_posts` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_ranks`
--

/*!40000 ALTER TABLE `foro_ranks` DISABLE KEYS */;
INSERT INTO `foro_ranks` (`id`,`rank`,`min_posts`) VALUES 
 (1,'Nuevo Miembro',0),
 (2,'Miembro',20),
 (3,'Miembro Activo',40);
/*!40000 ALTER TABLE `foro_ranks` ENABLE KEYS */;


--
-- Definition of table `foro_reports`
--

DROP TABLE IF EXISTS `foro_reports`;
CREATE TABLE `foro_reports` (
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
-- Dumping data for table `foro_reports`
--

/*!40000 ALTER TABLE `foro_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_reports` ENABLE KEYS */;


--
-- Definition of table `foro_search_cache`
--

DROP TABLE IF EXISTS `foro_search_cache`;
CREATE TABLE `foro_search_cache` (
  `id` int(10) unsigned NOT NULL default '0',
  `ident` varchar(200) NOT NULL default '',
  `search_data` text,
  PRIMARY KEY  (`id`),
  KEY `foro_search_cache_ident_idx` (`ident`(8))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_search_cache`
--

/*!40000 ALTER TABLE `foro_search_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_search_cache` ENABLE KEYS */;


--
-- Definition of table `foro_search_matches`
--

DROP TABLE IF EXISTS `foro_search_matches`;
CREATE TABLE `foro_search_matches` (
  `post_id` int(10) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `subject_match` tinyint(1) NOT NULL default '0',
  KEY `foro_search_matches_word_id_idx` (`word_id`),
  KEY `foro_search_matches_post_id_idx` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_search_matches`
--

/*!40000 ALTER TABLE `foro_search_matches` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_search_matches` ENABLE KEYS */;


--
-- Definition of table `foro_search_words`
--

DROP TABLE IF EXISTS `foro_search_words`;
CREATE TABLE `foro_search_words` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` varchar(20) character set utf8 collate utf8_bin NOT NULL default '',
  PRIMARY KEY  (`word`),
  KEY `foro_search_words_id_idx` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_search_words`
--

/*!40000 ALTER TABLE `foro_search_words` DISABLE KEYS */;
INSERT INTO `foro_search_words` (`id`,`word`) VALUES 
 (2,0x707275656261);
/*!40000 ALTER TABLE `foro_search_words` ENABLE KEYS */;


--
-- Definition of table `foro_subscriptions`
--

DROP TABLE IF EXISTS `foro_subscriptions`;
CREATE TABLE `foro_subscriptions` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `topic_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_subscriptions`
--

/*!40000 ALTER TABLE `foro_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_subscriptions` ENABLE KEYS */;


--
-- Definition of table `foro_topics`
--

DROP TABLE IF EXISTS `foro_topics`;
CREATE TABLE `foro_topics` (
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
-- Dumping data for table `foro_topics`
--

/*!40000 ALTER TABLE `foro_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `foro_topics` ENABLE KEYS */;


--
-- Definition of table `foro_users`
--

DROP TABLE IF EXISTS `foro_users`;
CREATE TABLE `foro_users` (
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
-- Dumping data for table `foro_users`
--

/*!40000 ALTER TABLE `foro_users` DISABLE KEYS */;
INSERT INTO `foro_users` (`id`,`group_id`,`username`,`password`,`email`,`title`,`realname`,`url`,`jabber`,`icq`,`msn`,`aim`,`yahoo`,`location`,`use_avatar`,`signature`,`disp_topics`,`disp_posts`,`email_setting`,`save_pass`,`notify_with_post`,`show_smilies`,`show_img`,`show_img_sig`,`show_avatars`,`show_sig`,`timezone`,`language`,`style`,`num_posts`,`last_post`,`registered`,`registration_ip`,`last_visit`,`admin_note`,`activate_string`,`activate_key`) VALUES 
 (1,3,'Guest','Guest','Guest',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'English','Oxygen',0,NULL,0,'0.0.0.0',0,NULL,NULL,NULL),
 (2,1,'ramayac','d033e22ae348aeb5660fc2140aec35850c4da997','ramayac@gmail.com','Br.','Rodrigo Amaya','http://SrByte.blogspot.com',NULL,NULL,NULL,NULL,NULL,'Santa Ana',0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'English','Sulfur',3,1214767309,1211988301,'127.0.0.1',1215065425,NULL,NULL,NULL),
 (4,4,'robertux','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','foo@bar.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,-6,'Spanish','Minerva',0,NULL,1214966189,'127.0.0.1',1214967051,NULL,NULL,NULL);
/*!40000 ALTER TABLE `foro_users` ENABLE KEYS */;


--
-- Definition of table `general`
--

DROP TABLE IF EXISTS `general`;
CREATE TABLE `general` (
  `titulo` varchar(50) NOT NULL,
  `contenido` varchar(150) NOT NULL,
  PRIMARY KEY  USING BTREE (`titulo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Tabla de contenido general de la Unidad de PostGrados';

--
-- Dumping data for table `general`
--

/*!40000 ALTER TABLE `general` DISABLE KEYS */;
INSERT INTO `general` (`titulo`,`contenido`) VALUES 
 ('secretaria','Verónica de Gonzáles'),
 ('telsecre1','2484-0821'),
 ('telsecre2','2484-0866'),
 ('emailsecre1','veronica.jazmin@gmail.com'),
 ('devel','Roberto C. Linares M., Rodrigo S. Amaya C.'),
 ('ad','2008');
/*!40000 ALTER TABLE `general` ENABLE KEYS */;


--
-- Definition of table `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
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
-- Dumping data for table `horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE `inscripcion` (
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
-- Dumping data for table `inscripcion`
--

/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;


--
-- Definition of table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
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
-- Dumping data for table `materia`
--

/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;


--
-- Definition of table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo` (
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
-- Dumping data for table `modulo`
--

/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;


--
-- Definition of table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
CREATE TABLE `novedades` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `titulo` varchar(50) NOT NULL,
  `vinculo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FECHA` (`fecha`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `novedades`
--

/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
INSERT INTO `novedades` (`id`,`titulo`,`vinculo`,`descripcion`,`fecha`) VALUES 
 (0,'Bienvenido Unidad de PostGrados','http://apollo-uesfmo.blogspot.com','<p>Este es el gestor de noticias de la Unidad de PostGrados de la Universidad de El Salvador, Facultad Multidisciplinaria de Occidente. Mediante la suscripcion a este gestor, usted estar informado de las noticias mas recientes de la Unidad de PostGrados. Gracias por suscribirse!</p>','2008-03-01 00:00:00'),
 (1,'prueba','prueba','<p>prueba</p>','2008-01-01 00:00:00'),
 (4,'Sr. Byte Blog','http://srbyte.blogspot.com','<p>El mejor blog del mundo!</p>','2008-06-29 00:00:00'),
 (5,'GOOGLE!','http://www.google.com','<p>es google</p>','2008-06-29 00:00:00');
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;


--
-- Definition of table `postgrado`
--

DROP TABLE IF EXISTS `postgrado`;
CREATE TABLE `postgrado` (
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
-- Dumping data for table `postgrado`
--

/*!40000 ALTER TABLE `postgrado` DISABLE KEYS */;
INSERT INTO `postgrado` (`id`,`nombre`,`notaminima`,`totaluvs`,`cumminimo`,`abreviatura`,`maxalum`,`presentacion`,`descripcion`) VALUES 
 (1,'Maestría y Técnicas de Investigación Social',7,999,7.5,'MTIS',999,'La Maestría en Métodos y Técnicas de Investigación Social, es un esfuerzo de carácter academico que las actuales autoridades impulsan par contribuir a elevar la calidad cientifica academica en la formacion permanente de  profesionales especializados en el dominio de las principales corrientes metodologicas y en el manejo de herramientas tecnicas y procedimentales para la obtencion, procesamiento, analisis y presentacion de datos. Que contribuyan al desarrollo del conocimiento cientifico en El Salvador y puedan proponer soluciones concretas a los diversos problemas de la realidad social.','Objetivos:\r\nFormar teórica y metodológicamente recurso humano especializado en investigación cuantitativa y cualitativa que contribuya al desarrollo del conocimiento cientifico a nivel regional y nacional.\r\nDesarrollar competencias en la planificacion, ejecucion y presentacion de informes de investigacion.\r\nGenerar sensibilidad por el estudio de aquellas problematicas sociales de interés nacional, que permitan la reflexión, el análisis y la propuesta de alternativas de solución.\r\n\r\nPoblación a la que se dirige el programa:\r\nLicenciados, Ingenieros, Máster o Doctores graduados de la Universidad debidamente autorizados por el Ministerio de Educación.'),
 (2,'Maestría en Consultoría Empresarial',7,999,7.5,'MAECE',999,'El programa de Maestría en consultoría Empresarial se desarrollará desde la perspectiva de integración del directivo o empresario en el rol de los negocios, en forma amplia abordando situaciones de la realidad de consultoría empresarial con un enfoque teórico y práctico.\r\nPara adquirir estas destrezas se define el programa con la intención de formar profesionales que asuman responsabilidades, que sepan cooperar entre organizaciones y con las personas, desde el conocimiento eficaz de las diferentes áreas de la empresa, entendiéndola de mejor manera y adquiriendo las competencias particulares del área relacionadas con la cooperación, la especialización, las innovaciones tecnológicas y la globalización de los mercados.\r\nLa MAECE es la formación profesional orientada a la excelencia académica donde se fortalecen los conocimientos, particularmente los especializados en técnicas de gestión; fomenta las capacidades personales y directivas, conceptuales y analíticas de cada participante, necesarias en la empresa actual.','Vision:\r\nSer lideres en la formación de profesionales a nivel de maestría, mejorando continuamente la calidad académica e incorporando en los planes de estudio contenidos programáticos que faciliten la efectiva ejecución de la gestión y consultoría empresarial.\r\nMision:\r\nFormar profesionales con iniciativa par organizar unidades especificas de negocios, con elevada formación teórico-practica para enfrentar los retos que demande el actual desarrollo empresarial y social.'),
 (3,'Maestría en Profesionalización de la Docencia Superior',7,999,7.5,'MPDC',999,'La Maestría en Profesionalización de la Docencia Superior, cuenta ya con una generación de graduados en la Facultad Multidisciplinaria de Occidente y con una segund ageneración en proceso de formación.\r\nLas metas y finalidades de este pograma de Maestría se orientan a la construcción de la educación superior como objeto de estudio. En tal sentido, el programa es una maestría académica que busca por una parte la profesionalización, entendida como el dominio pertinente de las competencias técnico-pedagógicas para el ejercicio docente a nivel superior, y por otra, la generación de conocimientos mediante la investigación académica sobre los distintos niveles del sistema educativo nacional (Parvularia, Básica, Media, Superior, no universitaria y Universitaria); así como de aquellas experiencias de gestión, promoción, innovación y evaluación en los diversos ámbitos de la educación salvadoreña.','El programa de maestria en profesionalizacion de la docencia superior nacio en un convenio entre la Universidad de El Salvador (UES) y la facultad de estudios superiores cuautitlán de la Universidad Autónoma de México (UNAM) en 1994. Se han graduado ya de este programa, diversos profesionales que laboran en instituciones publicas y privadas de todo el país.\r\nVisión:\r\nLa alta formación de cuadros académicos y profesionales, así como la generación de conocimientos mediante la investigación del que hacer educativo de la zona occidental del país; con el objeto de fortalecer los procesos de enseñanza-aprendizaje en los distintos niveles del sistema educativo nacional y la producción académica en función de la cualificación de la educación en general y la universitaria en particular.\r\nMisión:\r\nLa construcción de la educación y de una docencia universitaria de la zona occidental del país, como objeto de estudio, y su visualización como fenómeno socio-cultural asequible desde una prespectiva teórica transdisciplinar y una práctica íntimamente ligada a los campos social, económico y político; tomando como base la enseñanza integral desd ela perspectiva teórica práctica en el enfoque metodológico del trabajo analítico.');
/*!40000 ALTER TABLE `postgrado` ENABLE KEYS */;


--
-- Definition of table `presentadoc`
--

DROP TABLE IF EXISTS `presentadoc`;
CREATE TABLE `presentadoc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='documentos a presentar';

--
-- Dumping data for table `presentadoc`
--

/*!40000 ALTER TABLE `presentadoc` DISABLE KEYS */;
INSERT INTO `presentadoc` (`id`,`descripcion`) VALUES 
 (1,'Fotografía tamaño cédula a color.'),
 (2,'Certificado de Partida de Nacimiento.'),
 (3,'DUI y NIT.'),
 (4,'Certificcion del Titulo Universitario autenticado por la Universidad y el MINED.'),
 (5,'Titulo Universitario autenticado por el Ministerio de Educacion.'),
 (6,'Certificado de salud.'),
 (7,'Titulo de Bachiller.');
/*!40000 ALTER TABLE `presentadoc` ENABLE KEYS */;


--
-- Definition of table `privilegio`
--

DROP TABLE IF EXISTS `privilegio`;
CREATE TABLE `privilegio` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilegio`
--

/*!40000 ALTER TABLE `privilegio` DISABLE KEYS */;
INSERT INTO `privilegio` (`id`,`nombre`) VALUES 
 (1,'general'),
 (2,'estudiante'),
 (3,'maestro'),
 (4,'admin');
/*!40000 ALTER TABLE `privilegio` ENABLE KEYS */;


--
-- Definition of table `requisito`
--

DROP TABLE IF EXISTS `requisito`;
CREATE TABLE `requisito` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_requisito` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_requisito` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='tabla de requisitos de graduacion';

--
-- Dumping data for table `requisito`
--

/*!40000 ALTER TABLE `requisito` DISABLE KEYS */;
INSERT INTO `requisito` (`id`,`nombre`,`postgrado`) VALUES 
 (1,'Titulo de Licenciado, Ingeniero, Máster o Doctor, extendido por una Universidad Debidamente Autorizada.',1),
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
 (14,'Realizarse exámenes médicos de: heces, orina, hemograma, baciloscopía o radiografía de tórax, VDLR o serologia, con los cuales deberá tramitar una certificación de salud de bienestar universitario.',2),
 (15,'Los profesionales graduados en el exterior presentar original y copia del titulo universitario y certificación global de notas autenticados por el MRE y aprobados por la UES.',2),
 (16,'Aprobar las asignaturas y seminario del plan de estudios.',3),
 (17,'Presentación del trabajo de graduación.',3),
 (18,'Cumplimiento del servicio social (300 horas).',3),
 (19,'Requisitos y trámites de graduación según los reglamentos de Administración Académica de la UES.',3);
/*!40000 ALTER TABLE `requisito` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `clave` varchar(10) default NULL,
  `nombre` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


--
-- Definition of table `utileria`
--

DROP TABLE IF EXISTS `utileria`;
CREATE TABLE `utileria` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `titulo` varchar(50) NOT NULL,
  `vinculo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utileria`
--

/*!40000 ALTER TABLE `utileria` DISABLE KEYS */;
/*!40000 ALTER TABLE `utileria` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
