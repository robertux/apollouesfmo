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
 (0,0,4),
 (1,1,4),
 (2,2,4);
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
  `descripcion` text,
  PRIMARY KEY  (`id`),
  KEY `fk_usuario_id_docente` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente`
--

/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` (`id`,`apellidos`,`nombres`,`gradoacademico`,`usuario`,`descripcion`) VALUES 
 (1,'Perez','Juan','Licenciado en Ciencias de la Educacion',1,'<p>Este es un registro de prueba, para que pueda observar como lucen los docentes. Borrelo cuando le sea posible.</p>');
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
-- Definition of table `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `postgrado` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `fecha` datetime NOT NULL,
  `lugar` varchar(300) NOT NULL,
  `detalle` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evento`
--

/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` (`id`,`postgrado`,`titulo`,`fecha`,`lugar`,`detalle`) VALUES 
 (1,0,'Evento de Prueba','2008-09-02 00:00:00','Aula S2D Edificio de Salud, UES - FMO','<p>Este es un evento de prueba para que pueda observar como luciran una vez agregados. Borrelo cuando le sea posible.</p>');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;


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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_categories`
--

/*!40000 ALTER TABLE `foro_categories` DISABLE KEYS */;
INSERT INTO `foro_categories` (`id`,`cat_name`,`disp_position`) VALUES 
 (6,'Bienvenido',0);
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
 ('o_base_url','http://localhost/apollo/Forum'),
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_forums`
--

/*!40000 ALTER TABLE `foro_forums` DISABLE KEYS */;
INSERT INTO `foro_forums` (`id`,`forum_name`,`forum_desc`,`redirect_url`,`moderators`,`num_topics`,`num_posts`,`last_post`,`last_post_id`,`last_poster`,`sort_by`,`disp_position`,`cat_id`) VALUES 
 (5,'Bienvenido',NULL,NULL,NULL,1,1,1219257190,4,'ramayac',0,0,6);
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_posts`
--

/*!40000 ALTER TABLE `foro_posts` DISABLE KEYS */;
INSERT INTO `foro_posts` (`id`,`poster`,`poster_id`,`poster_ip`,`poster_email`,`message`,`hide_smilies`,`posted`,`edited`,`edited_by`,`topic_id`) VALUES 
 (4,'ramayac',2,'127.0.0.1',NULL,':D',0,1219257190,NULL,NULL,4);
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
INSERT INTO `foro_search_matches` (`post_id`,`word_id`,`subject_match`) VALUES 
 (4,5,1),
 (4,6,1),
 (4,7,1);
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_search_words`
--

/*!40000 ALTER TABLE `foro_search_words` DISABLE KEYS */;
INSERT INTO `foro_search_words` (`id`,`word`) VALUES 
 (2,0x707275656261),
 (5,0x7072696D6572),
 (6,0x74656D61),
 (7,0x666F726F);
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foro_topics`
--

/*!40000 ALTER TABLE `foro_topics` DISABLE KEYS */;
INSERT INTO `foro_topics` (`id`,`poster`,`subject`,`posted`,`last_post`,`last_post_id`,`last_poster`,`num_views`,`num_replies`,`closed`,`sticky`,`moved_to`,`forum_id`) VALUES 
 (4,'ramayac','Primer tema del foro.',1219257190,1219257190,4,'ramayac',1,0,0,0,NULL,5);
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
 (2,1,'ramayac','d033e22ae348aeb5660fc2140aec35850c4da997','ramayac@gmail.com','Br.','Rodrigo Amaya','http://SrByte.blogspot.com',NULL,NULL,NULL,NULL,NULL,'Santa Ana',0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'English','Sulfur',4,1219257190,1211988301,'127.0.0.1',1219259485,NULL,NULL,NULL),
 (4,4,'robertux','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','foo@bar.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,-6,'Spanish','Minerva',0,NULL,1214966189,'127.0.0.1',1220109321,NULL,NULL,NULL);
/*!40000 ALTER TABLE `foro_users` ENABLE KEYS */;


--
-- Definition of table `general`
--

DROP TABLE IF EXISTS `general`;
CREATE TABLE `general` (
  `titulo` varchar(80) NOT NULL,
  `contenido` text NOT NULL,
  PRIMARY KEY  (`titulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general`
--

/*!40000 ALTER TABLE `general` DISABLE KEYS */;
INSERT INTO `general` (`titulo`,`contenido`) VALUES 
 ('about','<p>Unidad de PostGrado es de reciente creaciÃ³n y ha sido fundada para planificar, gestionar, coordinar, ejecutar y evaluar los programas de postgrado que se lleven a cabo en la <span style=\"color: rgb(0, 0, 0);\">UES-<span>FMO</span></span><span style=\"color: rgb(0, 0, 0);\">.</span> Esta unidad es estratÃ©gica en la formaciÃ³n de profesionales de alto nivel acadÃ©mico en sus distintas especializaciones, con incidencia en la identificaciÃ³n, discusiÃ³n y propuestas de alternativas de soluciÃ³n a los problemas mas sentidos por la poblaciÃ³n de la zona occidental del paÃ­s.</p>'),
 ('autores','<p>Los autores de este proyecto son: <b>Roberto C. Linares M.</b>  y  <b>Rodrigo S. Amaya C.</b>\r\nAmbos son dos estudiantes de <b>Ingenieria de Sistemas Informaticos</b>, en su ultimo ciclo de carrera (Ciclo II - 2008).\r\n<i>Este proyecto es parte de su servicio de horas sociales.</i>\r\n</p>'),
 ('contacto','<p>Para mayor informacion puede llamarnos a los telefonos:</p><p style=\"text-align: center;\"><strong>2484-0821</strong> y <strong>2484-0866</strong></p><p>con <strong>VerÃ³nica de GonzÃ¡les </strong>o al correo electronico:</p><p style=\"text-align: center;\"><strong>veronica.jazmin@gmail.com</strong></p>'),
 ('proyecto','Este proyecto fue desarrollado unicamente con herramientas y librerias con licencia GNU/GPL 2.0 (software libre). \nEl software usado para este proyecto es el siguiente:\n<ul>\n<li>Apache 1.3.x</li>\n<li>PHP 5.x.x</li>\n<li>MySQL 5.x.x</li>\n</ul>\n\nY estas son algunas herramientas extra de desarrollo:\n<ul>\n<li>Aptana Studio</li>\n<li>Zend Studio (Trial Edition)</li>\n<li>Notepad++</li>\n<li>svn</li>\n<li>TortoiseSVN</li>\n<li>FireBug</li>\n</ul>\n... y muchas mas!.\n\n<p>Puedes leer sobre el desarrollo de este proyecto en el blog: <a href=\"http://apollo.infoluciones.org/\">http://apollo.infoluciones.org/</a></p>'),
 ('supervisores','Los autores del proyecto desean agradecer a las siguientes personas: \r\n<p><br/>\r\n<b>Lic. Raul Grijalva</b> <br/>\r\n<b>Ing. William Zamora</b> <br/>\r\n<b>Lic. Flor de Maria ...</b>\r\n</p>'),
 ('suscripcion','<p style=\"text-align: center;\">suscripcion aqui...</p><p style=\"text-align: center;\">[...vinculo al RSS/Feed...]</p>');
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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `novedades`
--

/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
INSERT INTO `novedades` (`id`,`titulo`,`vinculo`,`descripcion`,`fecha`) VALUES 
 (1,'Prueba','','<p>Este es un registro de prueba, para que pueda observar como lucen las novedades o noticias de la unidad. Borrelo cuando le sea posible.</p>','2008-09-02 00:00:00');
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;


--
-- Definition of table `postgrado`
--

DROP TABLE IF EXISTS `postgrado`;
CREATE TABLE `postgrado` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text,
  `codigo` varchar(10) NOT NULL,
  `esactual` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postgrado`
--

/*!40000 ALTER TABLE `postgrado` DISABLE KEYS */;
INSERT INTO `postgrado` (`id`,`nombre`,`descripcion`,`codigo`,`esactual`) VALUES 
 (8,'Ninguna',NULL,'MA-0000',0),
 (9,'Maestria de Prueba','<p>Este es un registro de prueba, para que pueda observar como lucen las maestrias. Borrelo cuando le sea posible.</p>','PR-00001',0),
 (10,'Maestria de Prueba','<p>Creada con el objetivo de probar la insercion de registros.</p><p>Borrese cuando le sea posible.</p>','MA-0000001',1);
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
-- Definition of table `procesos`
--

DROP TABLE IF EXISTS `procesos`;
CREATE TABLE `procesos` (
  `id` int(11) NOT NULL,
  `imagen` longblob,
  `nombre` varchar(20) default NULL,
  `descripcion` text,
  `vprevia` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procesos`
--

/*!40000 ALTER TABLE `procesos` DISABLE KEYS */;
INSERT INTO `procesos` (`id`,`imagen`,`nombre`,`descripcion`,`vprevia`) VALUES 
 (1,0x89504E470D0A1A0A0000000D49484452000001E00000045608020000006C1DF60D000000017352474200AECE1CE900000006624B474400FF00FF00FFA0BDA793000000097048597300000B1300000B1301009A9C180000000774494D4507D8051808111D5138DA93000020004944415478DAECDD675813D9FF3FFC13424280044287D0A437A95204A5A820D84041565111BBA0624774756D6B5BBBB28A0D2C5840054529A2A85828D20404A4F7126A68A1A5FD1FCCEFE6E25677D7EFAE4AF1F37AE02593C9943393774ECECC9C8372727210000080E1E4F9F3E71C0E078710121414D4D4D48412010080E1A0ACACACB3B3B3BEBE9E1F21A4A9A99995950585020000C3819393535C5C1C42880FCA020000862708680000808006000000010D000010D000000020A0010000021A000000043400000008680000808006000000010D000010D00000007E387E288251E3FAF5EB1919192377FB555555376EDC08C7110008E8D123212121303010219492925255553572774452523239391921F4CB2FBFB8B9B9C1910500027A647BF7EE9DB7B777616121F6E7E9D3A78D8D8D47E28ED4D6D62E58B0E0EEDDBB08A1D4D4542291386BD62C38BE00021A8C484D4D4DD6D6D64C26B3A6A666E5CA955BB66C4108292A2A0A09098DC4DD61B15826262608A1DBB76FEFDFBF7FE5CA95542AF5EEDDBB06060670ACC14F0B2E128E3C7D7D7DDDDDDDEAEAEAC5C5C50606066D6D6D67CF9ED5D2D2D2D2D21AA1E98C10221008D82EECDCB9B3ADADCDD9D9B9A4A464C2840925252570C401043418191A1A1A8C8C8C848585C5C5C59D9C9CA2A3A34545454924D2A8D9412291282A2A7AE9D2A5A54B97B2582C0D0D0DC86800010D4680D2D2526767E78282025353D3F2F2F2E8E8E851BCB3972F5F5EB870A18080808989497676361C7D00010D86AFBCBCBC152B56A4A6A64E9A34293E3EFE67D8E5A0A0204F4F4F26933973E6CCC4C444380700043418A6AE5FBF9E90903063C68C9090105151D19F64AF2F5FBEBC6CD9B29A9A9A5DBB76C1390020A0C1B0B661C3067979F99F6A97030202D6AC59535151111E1E0E2700808006C3CEF3E7CF9F3D7BF63D961C1515F5F6EDDBBF7A353232127B78E413A9A9A91111113F66DF492492AFAF6F4545C5F6EDDBEFDDBB072703808006C34B5656565656D6FAF5EB0D0D0DBFED92D3D2D2F2F3F3FFEA557575751A8DF6F9743939390D0D8D1FB6FBF2F2F2FBF7EF2F2929819668F05381075546125353536969E9EFB4F055AB564D9830212A2A8AC1604C9830C1C7C7475656F6EDDBB70A0A0ACACACA1C0EE7DAB56B111111140A65F5EAD5FDFDFDC5C5C5FAFAFA0821168B75E3C68D070F1EE070383737B7254B967CF36DA35028D6D6D6700200086830EC4446461E3E7CF87BAF25272787C1606CD9B285CBE5DEBE7DFBFAF5EBFEFEFE9595954422112174FBF6ED9898985DBB76B158AC8282022121A18A8A0AEC8DF7EFDF7FF6ECD9B66DDB381CCEC3870FBF47400300010D86A9AEAEAE96969603070E7878787CD715F9FBFB9B9898F078BCF6F6F65BB76E0D7E292C2C6CDBB66D16161608214B4BCBB0B0B08197A2A2A2162F5E6C6565C5E3F1949595E178010001FDD3211289FCFCDFF778494949F1F1F12184848484D86CF6E0979A9B9B151414B057B17F0730180C1919193C1E8F10FAD9EE3001E0BB828B84E0ABA8A9A9A5A7A7F7F5F5F5F4F4D4D7D70F7E494949292F2FAFBBBB9BC9648EE80EA901801A341891162D5A74FBF6EDEEEE6E841097CBC51AA631B367CF0E0B0BEBEFEFE772B9858585565656505C004040FF5C9292920A0B0BB5B4B4BEED62CDCDCDA9542A4268EEDCB9140A059B48A3D1A64E9D8A101A3F7EBC94941442C8D1D191CBE5BE7EFD5A5858D8D9D999C562090B0B6333DBDBDBB3D96CEC66EA2953A6C09102E05B323434E481612C2727C7C9C9092174E3C68D9FB6105EBE7C8910DAB061039C0F60D47374744408D5D7D7431BF408A0AFAF6F6F6F0FE500C0CF06027A243975EA545656D64FB8E33535353B77EE841300FC6CA00D7A6458B870615656D6CD9B379B9A9A7EC2DDEFEAEA4A4A4A727070D8B469139C0C00021A0C2FB2B2B27272723FE7BE7774744C993265FCF8F1B76FDF969494849301FC3CA08963C41014142412893366CC484A4AE2F1783FC95EB7B7B72B2828343434484A4A423A030868304CEDDBB76FD3A64D442271C284094949493FC32E575454E8EAEA7677773B3A3A3E7EFC18CE0100010D86AF23478EF8F8F8080B0B5B5B5B272424A4A7A78FE29DCDCDCD9D3E7D7A5D5D9DA3A3E3E81E7D1180BF026DD023CCB163C770385C5555D5A44993C68C1973EDDA355B5BDBD1B79B6969693E3E3E1F3F7E9C356B160CA40220A0C18871F4E8511E8F47A150AE5CB9E2E3E3B37AF56A5353D30913268C8EBDCBC9C979F9F2655858584646C6BC79F30203030904021C7400010D460C1C0E77EAD4295555D5A2A2A28D1B378E1F3F7ED2A449A363D73232329E3E7D3A67CE9C43870E797979898989C1E10610D060842193C93B76ECA8ADADC5E3F1414141292929A366D766CF9E7DF8F0E16FDEEB080010D0E087929797DFBB77AF9B9BDBF75ED1FAF5EB4B4A4AA2A2A23EE90CFA7BD0D0D050575787830B0004F488A7A0A0A0A0A0F0BDD72222228210727272C23AE60700FC00709B1D000040400300008080060000086800000010D0000000010D00263333F3C48913B9B9B95F7C353D3DFDC48913F9F9F95050007C27709B1DF84B6FDFBEDDBA756B7C7CFCD8B1636B6B6B1142FBF7EFDFB76F5F7171F1A54B97D2D3D3131212A4A5A5757575A1AC008080063FD4D4A95367CD9AF5F8F1E3274F9E60538E1E3D5A5E5E5E5F5F1F1F1F8F109A3F7FFEA8E903048061089A38C05FD2D6D61E3B76ECE029BDBDBD212121583A2384C68D1BA7AAAA0A05050004341802EBD7AF9F3D7BF6175FF2F2F2F2F2F282220200021A0C0D5959597171F1CFA7E3703829292929292928220020A0C190090A0A9A3E7DFA2713172E5C78ECD831281C0020A0C1105355551512121AF89342A1282B2B43B10000010D865E404080B6B6F6C09F161616070E1C80620100021A0C0BB366CDC22AD162626253A74E85020100021A0C177BF7EEC5469F929797F7F3F383020100021A0C237BF6ECA15028DBB66D83A200E0C7F8D99F243C7AF4685656169C075F89C562C5C6C6C6C6C64251FC237D7DFD1D3B7640390008E87FEFF5EBD7D1D1D1701E7CBD3B77EE40217C8DE6E66608680001FD0DBC7CF952464606CA017C132D2D2DD6D6D6500E0002FADBD0D0D0909797877200DF446363231402F826E02221000040400300008080060000086800000010D0000000010D000000021A000000043400004040FF9C3E7CF8E0EDEDFDF9742B2BAB61B59D0E0E0E4C26138E17A6AEAECEDDDDFD93891E1E1E555555503800027A64505757979393A3D168C6C6C6070E1C686868F87C9EDEDEDEBABABACFA79797972384D2D2D2962D5BF6AF37203C3C7CDFBE7DDF645F2A2A2AB85CEEDFCFD3D1D1111818686666A6A3A3B371E3C6929292EF5DC24C26934AA5CAC9C9A9AAAADADBDB5FB870A1B1B191C7E32184CCCCCCFAFAFABEEDEA5C5D5DB19D62B1589F67717575358BC582D31E0C07F0A8F757C5477D7D3D87C3C9CFCF3F77EEDC9D3B773C3D3D050404C864324288C7E3555757639FF6A6A6A6EEEE6E2291282E2E2E202030B0047D7DFDC3870F0F2CADADAD8DCD668B8888888989F178BCDEDE5E0683D1DFDFCFCFCF2F262686F58BDFD6D6D6D1D181C7E3C5C4C41C1D1D274D9A84ADABA3A3A3BDBD9DC7E3512814313131ECBD0402A1BBBB9B8F8F4F4C4C4C58581887C37DB2FDD81AC9643296CE1C0EA7B5B5B5BBBB1B8FC753A9D4C16F61B1580F1E3C888B8BBB7EFD3A8D468B8B8B63301808A1DADA5A5959593C1E8F10EAE9E9E9EAEA221289BDBDBDD8F6D368340E87D3D2D2C266B3050404C4C4C4482452575717B65E2121214949491C0E874DE172B9424242542A954020602BE5F178929292252525BDBDBD1F3E7C387FFE7C7D7DFDBA75EBA4A4A42222228844228FC7EBECEC6C6F6F1F786F4B4B0BB6D75C2E574444844AA562BBD0D5D5D5DEDECE62B1848484242424B02D2793C99D9D9D381C4E54549442A19C3B774E5252125B3587C3696E6E6632990402414C4C4C505070A0DC3E2FA5FEFE7E0683D1DBDB8B1D29616161F8740008E8E1F15B838F6FCC9831DADADA6D6D6D070E1C303737F7F0F0C0126DE2C489E1E1E1A5A5A5BB76ED2A2E2EA65028CB972F77707018F8B46766661E3F7E3C222282C160848585C5C6C67675754D983061F7EEDD7D7D7D111111B1B1B1B5B5B52412C9DDDD7DEEDCB94C26F3F4E9D3EFDFBF171212F2F0F0E072B9EFDFBF3F7EFC784343C3C58B17131313FBFBFBF5F4F4FCFDFDF3F3F377EDDA656969999F9FCFE170DCDCDC962C5942A150065787EFDFBF7FFFFEFDBEBE3E7D7D7D0683C1E3F1F2F2F2CE9E3D5B56564622919C9D9DE7CD9B8775C68F10EAEBEB7BF4E8919F9F9FAEAE2E4268DEBC79D8746767E7478F1E613D962426265EBF7EDDC8C8E8D9B367323232151515C1C1C12F5FBEBC7FFF7E4F4FCF983163162E5C686A6A7AE7CE9D989818269349A3D17EFDF5576565E5D3A74FBF7EFD9AC3E1E8E9E9AD58B1C2D0D0F093422691486666669B376FBE70E1427171B1949494B5B5756161617777F7993367121313B95CEED8B16357AD5AE5E7E747A3D1E8747A5757D7B871E3B66CD942A3D1180C46686868545414B6527F7F7F2929292B2BAB458B16656666F6F5F5D9D9D9AD5CB9D2D3D3333030101BC4ABBEBE7EEFDEBDF9F9F9C2C2C20B162C98356BD6C077C6E7A594989878F3E6CDBABA3A3131315757572F2F2FF85C0068E218623C1EEFE1C3870F1E3CB871E3465151D1E7B13230DBA449931E3C78B068D1A2478F1E7DB11DF3E5CB97B9B9B93B76EC78F8F0A19E9E1E0E87633299353535870E1D8A8B8BDBB3674F6A6A6A5151D1C58B17B95C6E6868E8850B1706A2136BEB603018E7CE9D7BF8F02189440A0C0CC4A64F9F3E3D3232F2F7DF7F8F8A8AFAA4A79EF4F4F4B4B4343F3FBFF0F070353535EC1BE5CF3FFF1C3B766C4444C4BE7DFBF2F3F3D3D2D206571BCBCBCBFF6A1F3F81C3E1D6AE5DFBFCF9733535B53367CEAC5CB9F2D1A3475BB76EE5E7E77FF3E64D5E5EDEAE5DBB1E3E7C68686878ECD8B1F6F6F6C78F1F6FDFBE3D222262EEDCB97C7C7C7FD3A6C4E170DADADA06A6B4B4B43C7BF66CE7CE9DF7EFDF777171C1DECBE5722F5EBC88757F7AFDFA75EC9BE3C3870FBFFEFAEBC3870F4D4C4C8E1F3F8E1D177D7DFDFBF7EF070404949797E7E4E47CB23A131393070F1EF8F8F82424247CFCF8119BD8DFDF3F504A7BF7EECDCBCB4B4B4BBB7BF7AEA1A1E1BD7BF702030307AAFF0040400FB1B8B8B8F8F8F89A9A1A2727277B7BFB2FCEA3AAAA3A7DFA74515151474747269389B50C7CA2A8A8485353D3D8D89842A1CC9B370F8FC78B8B8BCF9D3B373535352424E4FDFBF7C5C5C56D6D6D6FDFBE5DBC78B1A4A4248D467372721A787B6E6EAE8D8D8D8A8A0A954A5DB264497272324248474767CA94296432D9D2D292C562F5F7F70F5E634D4D8DB8B8F8F8F1E3A954EAC2850BA9542A9BCD7EF1E2454F4F4F5858584A4A4A5959596D6DEDE0B770381C7EFEAFFA6965656565646484CDECE0E0909191111212525353636060505E5EAEA2A2626C6C4CA552972F5F9E9292222828386EDCB8D7AF5F878686623F47FE6AB158430AD6068D2193C906060609090977EFDE15101050545444082D58B0404E4E4E464666F6ECD9E9E9E908A18A8A0A4545C571E3C661E5939A9A8A10929696767373131111D1D3D3131313EBEAEA1ABC2E5959595757575151511B1B1B028140A7D3B1E9834BE9DDBB77656565757575E6E6E6CDCDCD2121216FDEBCB1B3B383CF0580268EA187C3E106EAAA0353B85C2E8FC7C3E170BDBDBD0313B19A1DF6EFE07C195CCBFEA481B8B5B5F5FCF9F3442291442271B95C0683C166B3B95C2E16529FE072B903154F3E3E3EAC41999F9F9F482462FFF9AB35622B1D782F8BC5C21A6A793C9E9999998181C1E0961C3939B9D2D2523D3DBD4F5A78D86C36B60D0357ED040505B1552384FCFCFC9E3F7F5E5151111515D5D0D0F0C97AB95C2E954ADDB0614352525245454576763687C3F9AB8CABA9A9C1E3F1831B6A2425257D7D7D9393932B2A2A0646C01928A281A218BC523C1ECFE170B057492412360587C37D7E5C061FB5C1069792B9B9B98181C19831639292920A0B0BDFBE7D9B9797B77FFF7EF87400A8410F3B626262454545743ABDA3A3E3E6CD9BD8C4AAAAAA172F5E747575BD7AF50ABB90F5F91BD5D4D4CACACAF2F2F2984C6674743487C3E9E8E8484B4B737171D9BC79F3E4C993B12B8416161677EFDE6530188D8D8DAF5FBF1E78BBB6B6767272724D4D4D4747C7DDBB77C78D1BF78F9B4AA3D1DADADA3233333B3B3B1F3C78805D789C32658AB6B6F6860D1BB66CD9626B6B3BF8621791489C32654A7070704D4D0D93C94C4C4CC46E789095957DF5EA556F6F6F5555D51787BC7AF9F2A58383C39A356B141515DFBF7FAFA8A8585555959797D7D9D9191A1A6A6262D2D3D3939797E7E2E2B26CD9321E8F87DDDFF289FEFEFED2D2D25BB76E51A9546565E581E95D5D5D85858573E6CC59B264495F5F1FD67CF4E0C183A6A6A6969696B8B838AC4D465151B1B6B6F6C3870F9D9D9D616161C6C6C6FF583E4D4D4DD82581949414369B2D25253590FE03A5B479F3665B5B5B2121A18C8C0C3535355F5F5F3B3BBB172F5EC00701400D7A389A3A75EAD5AB57BDBDBD29148A8A8ACA4085EBE9D3A7585EBBB9B9613FC33F616B6B5B575777ECD8312E97ABA3A3E3E8E848A5522D2C2C8E1E3D4A201068341A561F5FB972654040C0AA55AB848585A74E9D3AF0F63973E65CBE7CD9CFCF8FCBE54A48486CDAB4A9B2B2F2EF37D5C4C4A4B8B8F8D4A95358D598CBE51289441F1F9F909090B8B83884D0983163162C583038A0DDDCDC828282FCFCFC783C9EB2B2B2A7A7274268C58A152121210F1F3E141717C7AAD29FE8E8E8F0F3F3633299626262B367CF363535ADACAC3C72E40887C3111010D8B871238FC72B2828888888E8EBEBA3D16883ABED08213A9DEEEAEA8AC7E3C964F29831635C5D5D6934DAE09F0EB9B9B9F7EEDDEBEFEF575050C02E607674746CDDBA95C9642A2A2AFAFAFA22842C2D2DCBCBCB8F1E3DCAE1708844E2860D1BFEF150B2D9ECC4C4C4F0F070849093931376E5102B076F6FEF9B376F0E2EA5EEEEEEB367CF363535118944AC5800F8BE3FDF11428686863FEDC0A93367CE8C8E8EAEA9A9F99B11553232323EA9ABF6F7F7D7D4D4B4B4B460A947A7D33535354B4A4AC8643283C1101414545656C67EA163EFEDECECACABABD3D2D2E2F1782D2D2D7575757D7D7DB2B2B20A0A0A5C2EB7B1B1B1AEAE0E6B04E8EBEB939797A752A93535350D0D0DFCFCFC4A4A4A5C2E97C9642A2B2BF378BCFAFA7A3A9DCE66B3A5A5A59594943A3A3A5A5A5AB0AB7F08A1FCFC7C151595C1F78AF1783C0683515D5DDDDFDF2F2525D5DCDC6C6C6CCCE3F16A6A6A9A9B9B114212121272727258230086C3E13435356177168A8B8BD368341289D4D3D3535E5EDED9D929242444A150B09BE7B01AFA405B4D6565258BC5A252A90A0A0A828282CDCDCDD89E52A9545555553E3E3E3A9D4EA7D3B95CAEA4A4A49C9CDCC09D881C0E076B2FC6E3F12412495A5A5A5252126BB1C9CCCC343232E2F178D87B793C9E9494949C9CDCECD9B3376CD8202D2DCD66B3656464141515B1E68B969696DADA5A6CA52A2A2AD8B7C2C097414545058542A1D3E9AAAAAA8282827D7D7D797979D84D7B2412495151515454342F2F4F5D5D9D4422B1D9EC4F4A093BEE58218C1933667023CC608D8D8D3232320E0E0E4F9F3E858801FF829393535C5C5C7D7D3D04F43F07341886A64F9F7EE0C00113139361B86D10D0E05B0534B4418311494848E88BD75101184DA00D1A8C48F7EFDF874200A31ED4A0010000021A0000000434000040400300008080060000086800000010D000000020A0010000021A0000C037014F122284505151517B7B3B9403F8265A5B5BA1100004F4373379F2642804000004F4F0626B6B2B222202E7C1D778F8F02197CB75757585A2F81AFAFAFA50080002FA3FF1F3F38393E02B292828F4F7F7DFBE7D1B8A02801F032E12020000043400000008680000808006000000010D000010D000000020A0C17047A7D37372723A3B3BBFF86A7D7D7D4E4E4E57571714140010D0E0473B7BF6ACA1A1E1D9B3679F3D7BD6DBDB3B389A9F3D7BB661C3064343C3E4E464282800BE0778D41BFC1D6363637575F55DBB76617F52289490901084505252D2850B17104213264C90939383820200021AFC68EEEEEEB1B1B1252525D89F9D9D9D8B172F1E3CC3EAD5ABC78E1D0B0505C0F7004D1CE01FCC9B374F4747E78B2FCD9C3973DCB871504400404083A1E1E8E8A8A2A2F2C5976C6D6D757575A1880080800643E6E0C1831A1A1A9F4C74777777777787C20100021A0C252323230A85F2C944252525656565281C0020A0C1108B8F8F9795951DF873EEDCB9FBF6ED83620100021A0C3D3131311A8D86FD5F4040404E4E4E5858188A05000868302C646464E0F1788490B5B5F5D9B367A14000808006C3C894295328148AB9B93914050010D06018090B0B9B316386888888BABAFAEBD7AFA14000F8DEE04942F055AE5EBDBA71E3C68E8E0E84D0B265CB8C8C8C4E9C3801A3A10300010D86D29D3B77DEBD7B77E7CE9D8E8E8E53A74EE170B8A2A2A2F3E7CFFBF9F9595B5B2F5AB4C8D4D4144A09000868F043C5C6C65EBF7E3D3535B5BCBCFCF0E1C32A2A2ABFFCF20B0E876B6868B0B1B1898A8A3A73E6CCBB77EF9495958F1E3DAAA4A4042506000434F8115EBE7CB97EFD7AAC9BA423478EAC59B366E0591519199979F3E6595959B158ACB0B0B0949494D2D2D267CF9E51A954283700BE21B848083E555E5EAEA3A3B368D1A29292924D9B367DFCF871EDDAB59F3F49A8A8A878F6ECD98F1F3F5A5959A5A7A79B9B9BDBDADA42E901003568F0EDF5F7F7F3783C6565E5DEDEDEDEDE5E1717978B172F9248241289F4576F9196969696968E8B8B63B3D963C78E4D4D4D1513139B3265CAAD5BB7F0783C3F3F9C5D00400D1AFC674D4D4D1616162412A9A9A9C9C4C4A4B7B7372C2C8C4AA5FE4D3A0F2093C9542AB5A6A6A6B2B2525050303C3C9C44226DD8B0E1AF06CA0200400D1A7C95DADADADADA5A3F3FBFACAC2C232323090989F8F8F87FB7286969E9972F5F2E5EBCB8B9B9F9FCF9F3020202F3E7CFD7D6D6161111817206006AD0E07F505F5FFFE8D1A32D5BB6585858F4F6F63A3B3BC7C5C5FDEB74C6686969BD7BF7EED2A54BCECECE9191911616167FFEF9E7A3478F582C16143800508306FFACA3A3232C2C2C3333F3C2850BE3C68D5BB972E5DAB56B0D0D0DBFD5F2A74C993265CA94B0B0B0E7CF9FFFF9E79FF5F5F5A74F9F969696F6F0F080C207E07F636868C8033F8DFEFEFE8D1B376287DED4D4F4E5CB97DF7575C1C1C192929208215151D1A0A020287F00FE91A3A323F61B176AD03F977DFBF6D5D5D55DBA7449555575F3E6CDFAFAFA363636DF758D4B972E151010686E6EDEB061C3AFBFFE9A9999696565B560C102381600401307F83FC78F1F4F4949898B8B63B158F7EFDF979090B0B3B3FB31AB5EB0600197CB9597972F2929D9BE7D7B4C4C4C4444C48A152B9C9C9CE0B8000001FD53BB7EFDFAE5CB970B0A0A5A5A5A1042CF9F3FFFF19D1CF1F1F1B9B9B96137DE6DDFBEBDBCBC3C2B2B4B5656363030505F5F1F8E11005FFEE040118C6E6161619B376F4E4C4C6C6969090D0D2D2E2EFE6115E7CF51289475EBD61517176FDCB8B1B4B434313171FAF4E99595957098008080FE893099CCB76FDF522894152B56F4F5F59D3D7BB6B3B373EEDCB9EAEAEA7C7C4379D0858585D5D5D5FFF8E38FCECECE79F3E631188CB163C7CACACA3299CC9E9E1E38700040408F724545456432D9DADA9AC7E3AD5FBFBEABABCBD7D7974C266303560D074422914C26878686767575999B9B373535611B4CA7D3E1F0013000DAA04795DCDCDC8E8E0E27272701018171E3C64D9C38F1E0C183C37C9B9F3F7FEEE0E0D0DADA9A9191E1E1E171F0E041454545454545389A0040408F123939392525257BF6ECC9CDCD9D3973268D46BB78F1E248D9F867CF9ED1E9F4B56BD7D6D6D64E983061FEFCF9EEEEEE969696727272706401043418C10A0A0A5EBC78111E1EFEE2C50B1717171B1B9B63C78E0909098DACBD9095950D0F0FCFCACABA7CF9726A6AAA9B9B9BB7B7B7BEBEBEA7A7E7E73D9D0200010D4680E2E2E2EDDBB74746462284E6CE9D7BECD8B13163C68CDCDD3132323A77EE5C4242C2D6AD5B2F5CB880102A2A2A3A7EFC38F45C0A20A0C148D2DEDEBE6DDBB6EAEAEAD8D8582727A73973E64C99326544A7F3003B3BBB93274F1614141C3972E4CC99335D5D5DF2F2F2FBF6ED83830E20A0C108E0E5E5D5D0D0101717676262F2F0E1430D0D0D5D5DDDD1B483363636363636DADADA0C06C3DDDD5D4040203B3B7BE2C4895BB76E85A30F20A0C130B561C38677EFDE6566668A8A8AA6A4A4888A8A6A6B6B8FD69DC5FA0979FBF66D7979F9FCF9F3DFBE7D7BFFFEFD356BD62C5EBC18CE0400010D8697CD9B375FBE7CB9A7A70787C3656666FE24F7A2999B9B1B1B1B878686CE9F3FBFA5A5A5A8A8485050D0DDDD1DCE0730EAC1832AC31D9BCD6E6F6F3F72E488A0A0E0952B578844624646467777F74F75A7308140707777EFE9E9397BF62C97CB5DBA74A9A0A0E0DBB76FDBDBDBE10C0110D0600870389CC2C2C29B376F52A9D41D3B76502894909090B6B636131393AF192A70B49DA97C7C2412C9D7D7B7ADAD6DFDFAF5783CDEDADA9A4AA57EFCF8B1A2A202CE16302A8DAA260E2E979B9E9E6E6E6E3E3A76272626C6D9D91921242D2DADA3A3E3EDEDEDE2E202A72C42E8D0A1431C0EE7DDBB77C9C9C9BABABAAAAAAA0F1E3C30303080920110D043E6C993271D1D1DD8FF6934DAC489133F99A1B7B7D7C3C3A3B4B474A41F9567CF9E31180C0F0F0F5151514747C7891327FAFAFAC2C93AD81F7FFC8110F2F6F6A6D3E99191918B162DDAB56B979696D6371CB80B0008E8FFC1962D5B264E9C88FDBAD7D3D3FB3CA04781F8F8F8FCFCFCE3C78F575757AF5BB74E5E5E7EFBF6ED709AFE950B172E747575EDDCB9B3AAAA6ADEBC7993274F767171993A75EA88BEB3854EA7A7A7A7CF9C39F3EF674B4949A150287A7A7A701A40400F17870F1F161717C7FEDFD7D7979D9D9D9898D8D6D6262727377BF6EC816782BBBABA525252D2D2D2B85CEEB871E3ACADAD0504041E3F7EFCE1C3076161E18913279A99990D6DAF9B5FF4F4E9D36DDBB66567672384FCFDFD0F1D3A340C3772B82193C967CE9C292F2F271008F7EEDD7BF1E285B3B3F3891327D4D5D587647B2223239D9D9D7138DCC094F7EFDF33180C535353111191AF59426565E5952B57FE31A0A3A3A395949420A021A087A9F7EFDFC7C5C5C9CACA0A0909E5E5E5757676AE5CB9127B292F2F2F3434544B4B4B4444242D2D4D4F4FEF7BC7BC590000200049444154FDFBF7E1E1E15656560C06E3CE9D3BFCFCFCE3C68D1B3EFB92969676E1C2858C8C8CECECEC0D1B36181818CC9F3F1FD2F9EBA9A8A81C3E7CD8C9C9E9EEDDBB8F1E3DEAEFEFA7D168A74F9FFEF1FD789C3B776EE2C489121212D89F3D3D3DB1B1B1121212A3E6D2088080FE4BF3E7CF27128908217373F355AB56B9BBBB8F1933864824969696FAF8F82C59B2049BADB5B5B5B9B9D9CBCBCBD0D0B0B9B959424222282868D9B265D3A64D6B6969B97AF56A4242C23009E89A9A1A6F6FEFBABABAF7EFDF2F5EBCF8E0C183666666D2D2D2706AFEAFD4D4D4D4D4D42C2D2DCBCACA76EDDAF5E4C993AAAA2A3939B91B376EFCC8CDD0D7D78F888818A82BE4E7E7777474D8DADA2626264644443437374F9E3C79C58A151F3E7CB87DFBB6ACAC6C5A5ADAFAF5EB2D2D2D6FDEBC191B1B2B2A2AAAAAAA8A10EAEEEE4E4848888C8C6C6A6A525555F5F5F55552526A69693977EE5C5E5E9EB6B6764141819292124288CBE5868787474646F278BCE9D3A7BBBBBBC7C6C666656571389CDCDCDCC3870FBF7DFB362E2E4E5858D8D9D979D6AC59D0B10904F4F7B27DFB765151518490A8A82891484C4E4EF6F7F76F6C6C64B3D98585855C2E77E04362696979F4E851168B356FDE3C3737B7C2C2421B1B1B2291282D2D3D66CC988C8C8CE1B03B13264C686F6FCFCBCB737070484F4F979797979595FD264BA6D3E9FEFEFED7AF5FFFAEDB7FE6CC190D0D8DE9D3A70F9F33444747474747475353B3A3A3C3C1C1A1ABAB2B3F3F7FC2840967CE9CF9311BE0EDEDBD74E9D2850B170A0909B158ACD4D4542A95DADCDCFCF8F1637B7B7B1A8D76FDFAF55BB76EC9CACA464545AD59B366CB962D5A5A5A0F1F3E7CFAF4E992254B582CD6D9B367C964F29B376F121313E7CE9D2B282818171777EEDCB93D7BF65CBE7CB9A1A1C1DBDB3B2F2F2F3C3C7CEAD4A908A1C78F1F47444460EF8D8E8E161616AEA8A8888A8AF2F1F1993973E6AB57AFE2E3E357AF5EDDDCDC1C19192928280863F542407F2F464646036DD0111111C9C9C99B376F56515161B1580E0E0E3C1E0F7B8946A3AD5BB76EC992251F3F7E3C7DFAB48989898888487373B39898188BC562329982828243BE2F969696EFDEBDE3F178E3C78F0F0D0D1DD8AF7FF7B3FAC89123037F1208848484848282827FB128131393CCCCCCAFAFFE639BEDE0E0101A1A3AF0BBFE6B929D4AA57A79797DA7B2D5D0D040087DF8F0414141212323232F2F8F9F9FFFC489133FA622AFA7A7F7F8F1E379F3E6959595D5D5D55959592524244C983061E6CC994242420402E1D0A1433E3E3EFAFAFA1E1E1ED2D2D2381CEEE1C3871E1E1EF6F6F66C36BBA5A5253232D2C6C666FCF8F1C2C2C2783C5E474767E6CC99DDDDDD313131972F5FD6D4D4D4D5D5CDCACAC2D678FBF6ED254B964C993285C3E1F4F4F4BC78F1425555D5C6C666CE9C39542AF5C08103BEBEBE7676763D3D3D5D5D5DCF9F3F87801E4146702B677F7F3F9BCD2693C93D3D3D57AF5E653018032F65656505060632180C3C1ECF66B3B95CEE2FBFFCB267CF9EC2C2C2972F5FBE7EFDDAD2D27248B6B9BBBBBBB9B979D6AC590402A1A8A808FB6A79FBF6ED7F496784506767E7A64D9BCAFF3F4545457F35674F4F4F6B6B6B6B6B6B7777378FC7E372B94C2673604A6B6B6B6D6D6D737333F6845E6F6FEFE071025B5B5B11421C0EA7A3A3A3B5B5B5A3A383CD66632F8586868A89892184582C567B7B7B4B4B0B83C1E8EBEBE3F178EDEDEDDDDDDD0C06A3A5A5A5B3B393C3E1F4F6F6D2E9F4868686E6E666168B85150BB60D3D3D3D03DFB2FF9DBCBC3C8BC5CACCCC2493C957AE5C211008478E1C1958E9F7FA44F1F1AD5EBDFAFAF5EB4C26332B2B8BCD665B5A5A363636FAF9F9696969292828CC9933072B55515151191919EC72229D4E575151211008241209FB766969693973E68CB9B9B98282829E9E5E7A7A3A97CB6D6E6E565353E3E3E3939292929191C1D6585B5BBB64C9126565651515155F5FDFBEBE3E84909494949898180E87A3D3E95A5A5A783C5E58589846A36123BB03A8417F7BEAEAEA8347D5B3B1B1292D2DDDB061033F3FFFECD9B30D0D0DF9F9F9B1935B5E5E9EC7E3AD5AB58A4020787A7AAAABABEBEAEA1E3C7870F1E2C56262625E5E5E8E8E8E3F78E33B3A3AAAABABCF9D3B171818A8A4A4A4A5A5F5F4E9531A8DF60D73E11FDB165B5B5B0302029E3E7DCA66B3EDECEC366EDCC860302E5CB8F0EEDD3B7E7EFEA953A73E79F2A4B5B5D5CECECECCCCECEAD5AB972E5D6232993B76ECC0DE6E6060505E5E9E9D9D7DE8D0A1EAEA6A0D0D8DCACA4A13131384D0A44993E2E3E3A954EAE3C78FEFDCB9535E5E4E2693172C58306FDEBC3973E6989B9BBF7FFFBEB1B1515B5B7BEBD6AD151515C1C1C1783CFEC68D1B2121218A8A8A478E1C79FBF62D1E8F9F366DDAEAD5ABA5A4A4BED9F9CDCF6F6C6CDCD4D4F4F0E1C35DBB761D3F7E7CC78E1D57AF5E353333D3D6D6FE4E83346A6868A8A9A95DB972A5ADAD6DDCB871542A554E4EEEE4C993D88D463D3D3D9D9D9D9F34B2292828141414686868B0D9ECBCBC3C8450424242797979484888AAAA6A4343838D8D0D0E87939595CDCFCFD7D3D3A3D3E9B5B5B52A2A2A08216565E5DF7EFBCDCECE8E40203099CCFEFEFE90909081252B2A2AE6E4E4D068B4EEEEEECACA4AB8BC0101FDBD60DDD20FA0D1683B77EEDCB97327F6E7E6CD9B11424F9E3C4108C9C8C8F8F9F9F9F9F90D9E7FFFFEFDFBF7EF1F922D6F6F6F3F7DFAF4DEBD7B1142DADADA414141565656DF7615C5C5C5CF9F3F1F086B3535B5CFE7090E0E6E6A6ABA77EF1E0E870B0808B875EB96A4A464474747707030D6241A1717A7A5A5959B9BFB576B613299E7CF9F9F3469D2A2458B92929276EFDEFDC9EF83B4B4B4C3870F2B2A2ABE7FFF3E242404BB1FB9ABABEBEAD5AB2412E9D2A54B57AF5E3D77EEDCC78F1FC5C5C5D7AE5D8B10DABD7B3797CB8D8E8E663018172F5E8C8C8C5CB162C5373F04B367CF9E3D7BF6F9F3E7F7EFDFBF74E95284D0A3478F66CD9AF53D0EB7A0A0E0CC993377EEDC696565656D6D8D109A3973665858188BC5525454ACAFAF6F6868183B76ECE0B7CC9933E7FEFDFB5C2E97CBE53E78F08044225128143E3EBEECECECE2E2E2E4E4E4F6F6762291386BD6ACC0C0C069D3A6959696666666628F02787A7ADEBD7BB7A3A38342A15456560A08080C5EF22FBFFC72EBD62D369BCD6030D2D2D23C3C3C20F520A0C1FF61B3D977EFDE2D2A2ADAB76F9F8686869999D9F2E5CBBF793A2384DEBD7BD7D6D636506DFCFDF7DF3F9FE7D5AB5746464609090958106467677B7979090B0BC7C5C5292A2A5A5A5A0A0B0BFF63B312F61C8D989898ADADED27B78E898888AC59B326373737232383C562D5D4D43437372384962F5F8EFD56C086E3FA6499717171AEAEAE58BDBEBBBBFBDF359D7FA5356BD670B9DCE4E4E4A8A8283737B76BD7AE4948487CF39F53FCFCFC4646463367CE343434C41A22B026B5E8E8E8376FDE8C1933C6CDCD8DC3E18C1F3F7EE02D3366CCE8EEEE7EF6EC998888888787474B4B8B9595556B6B6B4242021E8FB7B5B5F5F0F0101414F4F2F20A0E0E7EFCF8B18686C682050BB07BBD1D1D1DF1787C7474746767A78E8ECEE4C9934B4B4B079A715C5D5D592C56545494909090ABABAB9D9D1D7C2A21A00142085DBD7AB5A1A161C78E1D341A6DF3E6CD5656566E6E6EDF695D8B162DDAB871E3C09F5555559FCFC362B1CACBCBB106501E8F676F6F3F7EFC787E7EFED4D4D457AF5EBD7AF5EAF35F18583B351F1F1FD6A08CFD492010B018FAA45105AB5FF7F4F4E0F1782E975B555585C584909010D6D24A20103E6F6266B1582525254D4D4D08211289F43DBEBD065BB76EDDBA75EBFEF8E38FFAFAFA850B172A292961379EDBDBDB7FC3B5C8C8C8603F9830381CCECACAEA935D3332321A9CE91E1E1E9F546F972E5D8A55F61142F3E7CF47080908087CF2BB105BB88383838383C3E0369681FF130884458B162D5AB4083E8F10D0E0FFDCBC79F3C3870F972F5F663018E2E2E2478F1E5DB870E1906F95B9B939994CF6F2F21217172F2B2B6B6C6CACAFAF2791486BD7AECDCFCF5FBF7E3D93C9241289ADADADD8454B32995C5A5A5A5D5D2D2121F1E4C993EEEE6E0281A0AAAA1A1B1B3B7DFAF49C9C9CDCDCDCC195E8EEEEEEF8F8F893274F1A1919E5E7E7E7E7E7FF4D1DB3B7B7B7AFAF4F404060E2C4891A1A1A8B162D1212122A2C2CC4AE717D6FFEFEFE1C0E474848E8F0E1C35BB66C3134347474749C3D7BF6505D3D060002FA07090909F9EDB7DF2A2B2B1142172F5E9492929A3367CEF75EE9EDDBB7DFBF7F3F107F7BF6ECF97C1E2F2FAF1B376EFCF6DB6F6C369B4AA5DADADA522894C8C8C8CB972FB3D96C6B6B6B0A85626767B776ED5A0303831D3B76989A9A7EF8F0C1DFDF5F444444525292C3E1080B0B2F5AB4E8F6EDDB313131C2C2C25D5D5D83972F28283871E2C4C0C040128944A552FFA6B3666D6DEDBB77EFAE58B162F7EEDD6BD6AC090A0ADAB66D1B97CB151717FF61D76FF178FCCE9D3BB5B5B5DFBF7F7FFAF4E9ECECEC57AF5EFDF9E79FA6A6A6700E83610287103234341CB8A712FC17B1B1B1A74F9F2E2828A8AAAA3A71E2C4D8B163274F9EFC031EDC2A2F2F2F2E2E1EFC9BD7DADA3A2B2B6B702B27A6BABABAA2A2A2AFAF4F5C5C5C5555954824565454343434E0F1785555551A8D86DDA8272A2A6A6666D6DFDF5F5555555D5D8DC3E11415152B2B2B274D9AD4D3D3F3F1E3C7B6B6363131310E87232F2F4FA3D19292924C4D4DF9F9F96B6A6ACACACA381C8EA4A4647F7FBFA2A2627575B5AEAE2ED6BADDDEDE5E5656666C6CCC60304A4A4ADADADACCCCCCA8546A7979795555159BCD969494545151F9CA3E2BBE95C6C6C6ACACAC5BB76EDDB871C3C8C8485A5AFADAB56B727272703E83A1E2E4E4141717575F5F0F01FD6DE4E5E52D5CB8B0A5A5A5A6A666FBF6EDF3E7CF575757FFC76B6E60F8686868A0D3E95BB66C79FEFCB9B6B6B6989858525212140B18DA8086268E6FA0B6B6D6C6C6067B8E63D3A64DBFFDF69B90901014CBC822232323232373FFFE7D4747C7D4D4541C0E676969999C9C0C25038610F497F6EFB5B6B6D2E9743131316565652291E8E9E9C9E3F14E9E3C09E93C7251A954ECF97B1515959292121C0E3773E64C3A9DFE496B3B0010D0C3575D5D5D7676B69393939C9C9C828282BDBD7D7D7DFD0FEE350D7C57D89320868686797979727272FEFEFED9D9D90303FA0000013D4C959797AF5BB7CEC8C8282D2D6DC28409494949D8E38BA0AFAF6F34B509282A2A666565858484E8E8E89C3F7FDEC8C8E8D4A953308E38F891A00DFA7F505B5BFBFCF9F3E8E8E8070F1ED8D8D88C1933E6F0E1C33FBE4BF861ABA5A565EDDAB55FDF19DE883071E2C48080801B376E242727EFDDBB97C7E3A9AAAA2E5AB40886530010D0C30593C93C77EE5C6161617070B08585C5B66DDB3C3C3C063F090646B12953A64C9932253C3C3C3535F5D2A54BF5F5F5353535323232CB972F87C20110D0436CCF9E3D743AFDD2A54BDADADA274F9E3433331B29E3D576757525262626272773B95C5353D349932691C9E4D8D8D8E4E4647E7E7E6B6B6B1B1B9BC1B769633D877CF8F0415A5A5A5A5A5A5858984824B6B4B4B4B7B7575555EDDCB9B3BBBBFBE1C387959595C2C2C2767676161616FCFCFCD863E23C1E4F5F5F1F5B4E6A6A6A5353D38C1933B03FFFF8E38FF5EBD7B358AC888888A2A222090909070787B163C78EAC4AA89B9B9B9B9B9B9191119D4EDFB66D9B8888485E5E9EB1B1B1A7A7277C460004F4D0D8B163C7E9D3A77B7B7B959595B18EDC46D0C6E7E7E7878585191A1A8A8A8AE6E4E4181818242727878585595B5B7777773F7EFC9848240EFEB279F4E8514C4CCCA44993BABABA828282F4F5F5858585DFBD7BE7E2E262646444241277EFDEADABABABA7A7575757F7F8F1634141C1BEBEBEBB77EF6A6A6A52A9D47BF7EE0DACB7B0B07020A0AF5DBBB662C58AFBF7EFA7A5A5595A5A5655558586867A79796969698DB8F301EB2E43545474F9F2E5A74E9D525656460841460308E82FB875EB567070F0F758F2AA55AB2A2A2A9E3E7D9A9A9ADAD7D7F7FCF97332993CE2C6FD6C6F6F6F6E6E3632323236366E6B6B939494DCB66DDB82050BA64D9BD6D3D373EBD6AD57AF5E0D0EE8E0E0605F5FDFC9932733180C3A9DDEDDDD8D103233339B3F7FBE9494140E87F3F4F4D4D0D02093C96D6D6D172F5ECCC9C9A9A8A8D0D5D55DB87021994CC6E3F1A74F9FFEE29670389CB0B0B0FDFBF79B9B9BD7D4D40406066667678FC480C62C5EBC78CC98315959595BB66CD9B973E7B56BD7B66DDBF6E33B190710D0C35A4545C58B172FBEC792F3F2F2FAFAFADADADA22222234353547E8E0F663C78EB5B5B53D72E4486F6FEFFCF9F3E7CF9F9F9F9FEFEFEF8F75C1DCDEDE3E7BF6ECC1F31715158D1F3F9E4020484A4AEAEAEAA6A7A72384D4D5D5B1744608B158AC55AB56151717F7F5F5B5B6B6FAF9F9D5D4D4585A5A52A9543E3EBE891327FE5540F378BCAAAA2A3333332291A8A4A444A150068F8033F23E36FCFC93274FB6B0B0707474BC79F3E69123470A0B0BA954EA3759B8BEBEFE9D3B77209BC02869E2080E0E767676FE268B7AF3E68DBBBB3B97CB6D686840088586868EE851906564647C7C7C962F5FFEF1E3C73FFEF8C3D4D4545C5CFCF8F1E35877FE5C2E9744220D9E5F4C4CACA1A141545414CB5F6C221E8FC7D21921B47EFD7A7F7F7F0B0B0B3C1EFFE79F7F72B95C0A85D2DEDECE62B18844627D7D3D361B0E87E370382C168B4020B4B7B773381C849088884853539382820236EAC727FDCA8F44C2C2C27A7A7ABFFDF61B93C90C0808A8ADADFDEFA70A368A1B0413183D014DA150BE7EB8D2BF377BF66C168B75E9D2A5DF7FFFBDB5B575FEFCF94F9F3ED5D1D1515050188925939393F3E4C913AC41030BD9952B579E3E7D7AF3E6CD22222229292958ABC5C0FC0B162CD8BF7FBFBFBF7F5555D59D3B773EEF6B091B84B0BBBB3B3535F5E9D3A7F3E7CF9F3C79727878B88484848C8CCCC18307B1D96465659F3F7F1E1313A3A6A676EBD62DAC33A669D3A61D3A74C8DBDB3B2D2DADB1B1D1C5C565A49F787D7D7D4D4D4D414141010101626262C2C2C2B1B1B19F0C95F23FE9EDED1D0EC3190308E8616DD5AA55AB56ADDAB3674F4C4C8C8B8B4B6F6F6F6A6AAA909090AEAEEEC8DA117979794141413F3F3FAC3F784D4D4D1313132E97BB7BF7EEEEEE6E0B0B8B254B960C9EDFDBDBBBB9B979CD9A358A8A8A8686860402415E5E7EF097DFE1C3870302023A3A3A8C8D8DEDECEC64646466CC98D1D6D676E2C4092E97EBEAEAFAF6ED5B84D0F8F1E36B6B6BCF9F3FCFE3F19C9D9D2D2D2D8944E2C68D1BFFF8E30F5F5F5F7979F9E5CB976383198E501C0EE7FDFBF7191919DEDEDED2D2D2A6A6A6BB77EFFE4E0368819F9DA1A1216F643A70E00042E8DEBD7BDF6F15EBD6ADC37E8CABAAAA62BD348C6E050505FDFDFD757575870E1D3A79F2240F7CC9DDBB77B1CF0E8D46BB74E9D2B75A2C36D88D85850594F04F0EBBE00CBDD9FDB3808000028140A7D3EFDCB9B37CF9F28D1B371A18189899998DD6FDBD7BF7AE8C8C4C4343436363A39797179C009F78F4E851535393B7B737954A7573733333335BB97225140B80268E2173F2E4C9CECE4E151595B2B2B2152B56D8D8D860C3238DB8168FAF3169D2A457AF5E9148A4F9F3E7C3A39283C5C4C4646565050606D6D4D4F8FBFBCBCACA0E1E04120008E82143A1500E1E3C585959696565151F1FBF73E7CED7AF5F6B6A6AFEFAEBAFB2B2B2A3694F274E9C38529E93FC61DEBC7973EFDEBD172F5EE4E5E56DD9B245595979CD9A35783C1E4A0640400F23CACACABEBEBE0E0E0E1C0E273A3A3A2E2EAEB8B8F8DEBD7B705FD428F6EEDDBB8D1B37623D406DDBB6CDDFDF1F1B5117801F007AE4FA9F696B6B9F3973E6D5AB57C6C6C64F9E3C7174747477771F115BBE6EDDBADADADABF9FE7078C6F3B52D4D6D6DADADA2E5BB62C333373D9B265AF5EBDDAB66D1BA433801AF470A7A6A6A6A6A616191989DDAC969A9AAAADAD3D69D2A4C0C0C0E1BCD9D9D9D9D87D027F232525E51F97939494F4E0C18363C78E0D4C717676BE76ED1A9BCDB6B1B1193CE7C993272D2D2D030202626363FBFBFB6D6C6C962D5B262A2A7AF5EAD5274F9E080A0AAE59B366E6CC999F3C2F331C181B1BB7B7B79797974F9D3A352222425252F25BDD6B0F0004F48FA0A8A88810AAAAAAAAA9A9313131090A0ABA73E7CEC68D1B77EDDA357C1E3EE472B92C168BC7E3E1F1781E8F874D64B1581C0E0787C3F1F3F3FF555B2A87C361B3D93C1E0F87C3110884C13DCF757777D3E9F4C133575454B0D96C369B2D2020F0FAF5EB81E94242423B76ECE072B9C1C1C1222222AF5EBD7AF2E4899999999898584848487171F1D1A347CDCCCCB02E878683FEFEFE193366A4A5A5757474686B6BB7B5B511080418C30C40408F54222222BABABAA9A9A92E2E2E9D9D9DFBF6EDE3E3E35BBC78B1ACACEC90570CFBFAFAE2E2E2CE9C39D3D4D4646565555D5D8D106A6868D8B76FDFDBB76F050505172E5CE8E5E5252A2AFAC91B3B3A3A2223236FDEBC595959292D2DBD79F3662727A7AFD91D3C1EFFC9D2F2F3F377ECD8A1A6A6462412172C58804DB4B3B3E370381C0E47444464E039F2A1D5D6D6D6D6D6E6E3E3131F1FAFA0A0A0A0A0909B9B0BA737185AD006FD6D1818189497970707078F1F3FFEFCF9F32A2A2AD7AF5F4F4949C1BAA1182A1F3F7E8C8A8AF2F1F1494848183B766C7F7F3F42E8D8B1632222222F5FBEBC78F1626969697C7CFCE76FACADAD2D2B2BBB78F1E2FBF7EFFDFDFD1F3C78F08F8DD71826939932484B4B8BB5B575686868747474464646656525F6B03842A8A0A0E0F4E9D3CECECE929292437BEC180C464A4ACAB66DDBB03B29C78F1F9F9C9C0CE90CA0063DDA383B3B3B3B3B5FBA7469DFBE7DDEDEDE08A13B77EE60FDD30FC9F6343434E070384747470A85B260C1026C58DBE8E8E84D9B36252626F6F7F77777779796967EFE460D0D8DC58B17979696E6E4E4B058ACD2D2D2BF19D61A6B061958E3912347065EDABA75EBBA75EB1E3E7C181313C36030141414E6CD9B67696989958C9696D62FBFFC32840D08DDDDDDCF9E3D4B4D4D3D74E810F62D7BE1C2056CF30080801E9D56AD5A8510CACCCC0C0D0DF5F0F0909494BC72E5CA90F40DC4E572114204020121442412B1E66626939994948475CA83C7E3BFD8936A6D6DEDA54B97B01E41D96C765555D5E09F0258FF763D3D3DD842BABABA88442296D1AAAAAA0F1F3EFC64699E9E9E9E9E9E4D4D4D376EDCB87EFD3A96807A7A7ADADADA4338A22387C33973E6CCAFBFFE8A10D2D1D1B1B1B1F1F0F080740610D03F4B46EBEAEAD2E9F4C3870FFBFAFA6667679B9A9A4E9F3EFD476E8698981842283D3DDDD8D8382121A1B1B11121646B6B6B6F6FEFECEC4C20100A0B0BBFD8ED676D6D6D7676F6FEFDFB353535B3B2B232323206BF4AA552F9F9F9DFBC79636D6DCDE1706262625455558944228BC5FA7C51CF9F3F979797575555E5E7E72793C903F3888A8A0E611BFDB973E71A1A1A7EFFFD77ACE726535353E8EA084040FF5CD6AF5FCF66B3151515CBCACAF6ECD9A3A7A7171515B560C1821FF6A89E868686B1B1F1E5CB97C964328140E8EDEDC5B62A2424E4DDBB7708211111912F7E67484B4B63437C090A0A0A0B0B7776760E7E554545C5D6D6F6FEFDFB9191910821168BE5E9E9292424C46432ABABABD7AC593330E7B265CB1A1B1B9F3E7DDAD5D5C5E572F178FCC03DE3D8D85A3A3A3A3FF8A0040505656464DCB973A7ABABEBFCF9F3D2D2D26E6E6E70AE0208E89FB27CF9F97D7C7C5A5B5BF9F8F88E1E3D9A979797929272E1C2851F337A96B8B8B8ABABAB96961693C9A4D168D3A64D939595555555151212AAACACE472B97272721A1A1A9FE4174248494969FDFAF56565653C1E4F5E5E7EEAD4A9AAAAAA03F3888A8A3A3B3B6B6A6A363737E370383939395D5D5D0281202E2E7EF1E2C5C14BC356A7A2A2D2D8D888C7E31514140686B95AB972E58FBF3C181C1CBC77EFDE9A9A1A84D0AD5BB706EE2A0160F882EE467F80E6E6E6C4C4C465CB962184B4B5B5ADACACEAEAEAA05BC51F262A2ACACACA4A4E4E0E21F4E79F7F26262662B7870F2BD0DD2880EE4687868484849595958E8ECECE9D3B57AF5E1D1F1F3F7EFC787171F1F7EFDF43E17C57797979CECECE9D9D9D4D4D4DBFFDF6DB92254BE4E4E460E012004D1CE0536262626262625151516C36DBDCDC3C3B3B9B4C265B5A5A3E7EFC78183EEE3CD2757474D06834EC59CAA54B979E3A758A482462F7B4003022C0832A43404040405858382F2F4F5757575252323E3EDECDCDADA4A464440F743DACD4D6D6969494A8A8A8F4F5F5C9CBCB7B79795DBA7449585818D219400D1A7CADDCDCDCAAAAAA850B17969595696868AC5AB5CAD3D3534F4F0FBB3D0EFC0BE5E5E5B5B5B59B366D4A4F4FB7B0B09093937BF0E001140B801A34F837949494DEBC79131414E4E6E6F6FAF56B6B6BEBE3C78F878787FF63B773E013555555E1E1E11B376EB4B6B61614147473737BFAF429A433801A34F8AFACACACACACAC1E3D7AB47DFB76ECB1E303070EFCFAEBAFC3A423A1E1AFBABA7AF7EEDDD7AF5F4708D9DBDB070404686B6B43B1000868F0CD383B3BE370B8ECECECC0C0C05DBB76F5F4F4C8CACAAE5BB70E4AE66F3099CC23478E949797DFBA756BC284094E4E4E2E2E2E90CE00021A7C7BB366CD9A356B969E9E5E7373B3B7B7B7A8A8684E4E8E8585C5F2E5CBA1703EB76DDB363A9D1E1212A2A3A373E9D2250303030B0B0B281600013D34D86CB6ABABAB8686C68913273E7FB5AFAFCFDDDD5D5B5BFBE8D1A323FAA860E34E090B0B2F5CB8F0F2E5CBB1B1B19191914B972E85F1A806ECDBB72F2323E3D9B367BDBDBDCACACA414141D0CF1180801E623C1EEFF1E3C7C2C2C26FDFBEFDA47FB8B973E7565656A6A7A73737378F8E63F3CB2FBFA8ABABA7A5A5AD5BB7AEA6A6262B2B8B44224D9B360DCEDADF7FFFFDD4A953EDEDED08A1E4E46432993C76EC582816303A8DA047BDB95C6E727232B6D96432994AA52284242525959494B051A6949494E874FA687AE8B3A7A7A7B2B272D7AE5D08210909092525A58F1F3FFEB48FC0060505292929090B0B2384A2A3A32B2B2B47D9B146F0A83718F4A8F708BBCD0E87C3292A2A629D08777575B5B5B521849A9B9BABAAAAD86C360E87131717979191194D5F9F241249494969EFDEBDBDBDBDAEAEAEF5F5F506060682828258FDF127C1E170A2A3A34924D2EAD5AB9B9A9ACE9D3BD7DBDB3B6DDA34252525A86081516CE4DD072D2F2FFFFCF9F32FBE242828385ABBB6C0E3F1020202972E5D5ABC78B19A9A1A9BCDD6D0D0282828C086191CDD0A0B0BE3E2E266CE9C292020A0AEAE7EE6CC192F2F2F010101B80711401BF470242222A25588493D0000200049444154AFAFFFE1C3874FA65B59598DFA0376E5CA158490ABAB6B4343838E8E8EB9B9F91F7FFCA1A4A434B83BD051233333B3A3A363EAD4A90402C1CECE6ED2A449BB77EF860F2D80801ED6B4B4B40E1D3AF4F910181111113FC9618B8888C086A0AEAFAF9F346992B3B3B38787879595D5A8F9C99F9696565A5AFADB6FBF959494B8BBBB2B2A2A7EF1BE1D0046BF91D81F746E6EAEBDBDFDE0BDF0F2F2EAE9E9F9D92E26E4E7E70F8C48BB78F1E2EAEAEA51B05349494903F7CC2D5BB66C1876DC0C170901F407FD77F4F4F4E6CD9B171F1F3F3065E7CE9D3F618F9D3A3A3A274E9C888E8E8E8A8ABA71E3069BCD565252DABD7BF708EDEF383737F7D6AD5B6FDEBC494E4EF6F4F4D4D5D5F5F1F1C1EECF01009A3846121B1B1B575757AC5963C78E1DA3ECE68DAFA7AFAFAFAFAF3F79F2E4BCBCBCA3478FDEBE7DBBAAAA4A4E4EEEF8F1E323682F1A1B1BB76FDF5E5151F1F2E5CBD9B3670707074F9932056ED20010D02395A6A6A689890916D0D3A64D131111F9990FA4B9B9B9B9B9B9AEAE6E6B6BEB2FBFFCC2E170F2F3F32D2C2CF6ECD933FC37DECDCDADA5A5E5D5AB5713264C888989D1D0D0505757870F27007F17D06C367B98F76C40A7D3B1FFAC58B1824C260FCF8D9497977FF4E8D18F591776BC1212124C4D4D636363939292F0783CF690CBB0E5E2E2121515C5E5720D0D0D6FDCB8312A6F4701E0DB07348FC7CBCCCC1C11BB515454346CB70D7B9AE647323131A9ADADCDCACA9A3163C6E1C3870303030F1E3CB864C992E156322B57AE8C8989696C6C249148C5C5C54422F1C78FF30DC0480D688CA9A9694A4A0A94D4BF332463A3E070381A8D262727C766B36FDDBAB566CD9A65CB96AD58B1223232D2DCDC5C525272081FF1E8EFEF6F6F6F3F75EAD4D1A347B95CAEA8A8684141818A8A0A1F1F8C1D01C0FF1ED008213C1E0F2535E2E070383C1EBF78F1E29E9E9E73E7CE555555CD9C391321949A9A6A666636249BD4D3D373E5CA95F5EBD7238468349A8484C4F5EBD7D5D4D4E06001F045506D19FD56AF5E9D9393B379F3667B7B7B2121211B1B9BF8F8F8B4B4B41FB90D5C2E373E3E3E282868FDFAF5F2F2F2F6F6F6818181393939C6C6C6708000F84F3568300A600F496FDDBAB5B6B6D6C1C141434363F7EEDD9A9A9AE6E6E6DF7BD58F1F3F6E696959BA74A98484C4A2458B264D9AB46CD932382200404083FF9FE3C78FF7F7F793C9E42B57AE787A7A5A59591D3F7EFCBB76757FF7EE5D5F5FDFC6C646111191DDBB7763ED1B00000868F0054422F1D8B1635A5A5A1F3E7CB871E3869F9F9FA5A5E592254BF4F4F4BEED8A1E3D7AF4E6CD9BB0B0B0C6C6C6FDFBF7CBC8C8AC5AB50ACA1F000868F077A854EAD6AD5BABAAAAECEDED2322228E1F3F9E9E9EAEA8A878F2E4C96F72A3DB9B376F2E5FBE9C9696565050F0EBAFBF6A6B6BCF9B378F482442C90300010DBE8A929212D6CAB166CD9A3D7BF6848484545454484A4AFE974E014B4A4AD6AC59535757979797E7E3E373F6EC595353D321B9D71000086830E2A9A9A9A9A9A9696A6ACE9A35EBCD9B37783CDEC5C5253232F25F2CAAA9A969FAF4E9C5C5C508A1E5CB97EFDFBF1F1E3C01E0BF80DBEC004208292B2BBF7AF5AAA1A1814824C6C6C662EDC55C2E97C7E3FDE37BB1B122F5F4F47475754B4B4BEDEDED1B1A1A4E9F3E0DE90CC0300A68369BDDD6D646A7D31B1B1BB19E6DC108222626262D2DDDDDDD9D9F9F8FC7E3EFDFBF8FC7E377EEDC595F5FDFD7D7F7C5B7747474D4D7D7DBD9D9E1F1F89696160505050E87F3ECD9336969E961DB350A003F6340F7F7F7BF7EFD7ACB962DAEAEAE0B172EBC76ED1A14EE08A5AEAE5E5757171A1AAAA0A070F8F0611A8D76F9F2E5EEEEEE4F666B6C6CF4F5F5A5D168AF5FBFD6D6D6CECFCF1FAD0342023054BE591B744141C1DDBB776D6C6C4E9E3CD9D7D7875D686A6D6DFDF8F1238542696C6CD4D6D6969797AFAAAAAAA8A860B1580A0A0A1A1A1A08A1FAFAFA8A8A8AEEEE6E0A85A2ABAB2B2222121F1FAFACAC5C5D5D2D2D2DADAFAF8F2D3F353555575717AB97B5B7B79794948C1B37AEB4B4B4B3B393CD6633180C1289646060202A2A3AB0492525254C26B3BFBFBFADAD4D5050D0C0C0008FC7E7E6E60E74D1979B9B2B2323232525C5E3F10A0B0B6B6B6BF178BCBCBC3C42884422292A2A62B3252727EBEBEB93C9E48E8E8EC2C2C2F6F6760A85A2A9A949A55247F1B8A553A74EFDF3CF3F2F5CB8909B9BEBEBEB8B05B7A3A3230E876B6969494B4B0B0F0FBF71E3868181018D460B0C0C141717878F1300C334A0535353959595A74F9F8E45A4B7B7379680DEDEDED3A74FEFE8E8F0F4F4ECEFEF0F0A0A6A6868E07038C2C2C2581FA10F1E3CA8AEAEEEEAEAEAEDED9D3E7DBABBBBFB9C3973D6AE5DDBDEDE6E66663610D03B76EC080808D0D5D54508151515EDDFBFFFF1E3C7A1A1A18989895A5A5AEDEDED6D6D6D0E0E0E3E3E3E039B74F3E6CD8C8C0C757575EC552727275B5BDB6DDBB6BD7AF50A9BE1D4A953AEAEAE3366CCC8CBCB0B080860B3D91C0E474A4AAAA7A7474D4DCDDBDB5B5050B0A9A969EBD6ADF7EEDDC3E170313131313131783C9ECD66DBDBDBCF9E3D7BF0F7C1E8E3E2E2E2E2E2121C1CFCE6CD9BBD7BF7B6B4B4040505F1F1F1E5E7E71F3B764C4F4F6FC992252B57AEFC19C6EA0560640774636323954AFDFC862A2121A159B366595959110884C3870F130884FDFBF793C9E4AB57AFDEBA756BF9F2E55A5A5ACB962D2393C9A9A9A9274E9C983E7D3A3F3FBFA9A9E9AC59B3BE66082B7171F1952B57AAAAAAA6A6A6AE5FBF7E704063AFAE5EBD7ACC9831EFDEBDDBB871A3ADADED171712101080C54D5B5B5B7070704949098542292F2FD7D5D58D8989D1D3D3A3D168656565313131F3E6CDB3B5B54D4A4A0A0D0D353636363030F87FECDD67401457FB3FFC33DB7759968E94A517698282528C8A425434A8010B44EC185BEC1A8D25C688C6586249D4D8152588808AB1D014A52822A0A08201A95296BECBB2BD3E2FE6FFECCD0F4D628C05CDF579B5CCCCCE1ECE8C5FC6B333D7F9E84F913973E6CC9933E7975F7E59BF7E7D646424BED0D5D575E7CE9D63C78E857F42007C00018D107AE937FE565656BEBEBE643219215454542493C976EDDA858F6C747575B1D9EC8686865F7FFD95CBE5CAE5F2C2C242B95C4EA3D18283835F7182412F2FAFBE7DFB1289C4C18307B7B4B4F4583B68D0204747470281F0C9279F343737FFD94E727272E472F9F7DF7FAF50289E3E7D6A6666A650284A4B4B2D2D2D2F5FBE8C87BE4020E072B9C3870FD7D2D2FAE4934FCE9C39D3D9D9F9DF3951962C5942A7D39B9A9A0E1D3AB466CD1A2727A7A0A020F8F703C08711D07DFAF4696969E172B9464646DD971389442A95FAFF3E8C44727474747171C1876EFBF4E953545474F1E2456767671B1B1B8542919494A456AB310C7B71CE530CC3E47239FE67A0FB2D22643219AF864A22915EFC0B412693F142C3F85A0CC3300C532814241249269329140A4DC3060E1C686060A056ABFDFCFC1C1C1CF2F2F2CACACA300C2310081E1E1E7803080402FE16854281EFEA3F75AECC9D3B572A957A79798D193306FEE500F00EBCB1BB387C7C7C9E3F7F7EEDDAB5CECECEE6E6E603070EBCB8CD902143040281A7A767686868DFBE7DEBEBEB9B9B9BB95C6E4040405050905C2E97C9647FB67F369B9D9E9ECEE7F36B6A6A5EFB161132994C2693333333BBBABA9293938B8B8BF1E5E3C68D6B6868183162C4B871E38C8D8D3B3A3A7C7D7D6B6A6A7EF9E59761C386E1B31DB2582C0303834B972EF178BCEBD7AF532894FFE0D762542A15D219800F2FA0FBF6ED1B1E1E9E9595151818F8678517A64E9D6A6B6BBB78F1626F6FEFEDDBB71B1818B8BBBBE32528C78E1D5B5656F617D36A2C5CB830373777C890218B162D7AEDF9618D8D8D274D9AB471E3C6808080E4E464CDA5FD8A152BD46A756868E8F0E1C3E3E2E2582C969B9B1B83C178FEFCF9902143F0CD4C4D4D2322222E5EBC18101010131313121202B3E70100DE2A0C21E4E1E1515454F4E23AB95C4EA150060E1CF88AC5DD954AA5582C96CBE504028146A351A9548542219148BA3FB320954A2512894AA5229148743A9D4020482412A9548A6118854291C9642C168BCFE7EBEAEABEB8739148A450280804028542512A954C26532C166318A619ADE6F178DDDF28168B0904822685793C9E8E8E8E5C2E178BC52A950ADF099D4EC7C7C7C562B1542A55ABD56432994EA713894491482497CB994CA6664219854221168B150A05914864301824D2DF0F10B1582C2323A3CACA4A38D5C0DF924824743ADDC7C7072699FB8F0B0A0A4A4D4DE570386FF24B422291D8E3F9311289D46309954AD524268EC16030180CCD6B84D08BE98CEF5C5B5BBBC7C21E43D53DDEF8D2B5140AE5A557F7743ABDC7F69A5675FF755E6C030000F4F6210E00000010D0000000010D00000002FA45959595BFFFFE3B1C2100000474AF53515181575CBA78F1626161E1ABBFB1BABAFAF8F1E37068010010D06F9D9D9D9DB1B1F1AB6FDFD4D474FDFA7538B400800FDDBFBDCD4EAD56E357AC0F1F3EB4B2B25AB87061464646FFFEFDFDFDFDE572796666666B6B6B4444C4B163C7EAEAEA5A5A5AAAABABFDFCFCD6AD5B47A552EBEAEA8E1D3B565050606E6E3E6FDE3C4F4F4FB55A7DF0E0C16BD7AE999999999898E01F919D9DEDE4E4646161A152A9A2A3A32F5EBC482291424343C3C2C2E2E2E2AAAAAA0402C1A3478FFAF4E9B36EDD3A5D5DDD850B17D6D7D70F1B366CF6ECD9B366CD4A4D4D8D8D8D6D6A6AF2F7F75FB56A55F7121F3B76EC50A9546565658D8D8D63C78E5DBC78B152A9BC7BF7EED9B367EBEAEA2C2C2C162F5EECE1E1412010C68C1913121272F5EAD5FEFDFB7B7B7BC7C7C773381C7B7BFB55AB56D9DBDBFFD79EF906007C1857D0CDCDCDA74F9F2693C95151518E8E8E67CF9EB5B2B2DABF7FBF582C6E6A6A4A4C4C1C34681042A8A6A6E6FAF5EBC3870F8F8A8AAAA8A83872E4484747C7A953A76432D9F7DF7FEFE1E1111717575D5D7DF6ECD99C9C9CAD5BB74E9A3429272707FF88AAAAAAD6D65684505C5CDCF5EBD7D7AF5FBF70E1C2BB77EF262727D7D5D5A5A6A67A7A7AEEDCB9B36FDFBE9B376F3632325ABF7EBDA7A7E7891327264C98909999999898387EFCF89D3B77D6D4D41C3D7AB47BE3CBCBCBAF5DBB3669D2A4AD5BB7DEB973E7CC9933A5A5A5090909D3A74FFFE9A79FFAF5EB171D1D8D9758CACACAAAA8A8D8BA75ABA3A3637676F6FCF9F37FFAE927369B7DF0E041983B0600D04BAFA0391C4E7979795454147ECDBB6AD52A0B0B0B5B5BDBC3870FABD5EA010306E055F9114213264CF8ECB3CF984CE6B7DF7E3B6DDAB43163C6141616EED8B1C3C2C2C2DCDC7CC3860D0D0D0DF1F1F11B376E1C3468904422696868C8CDCDEDFE5967CE9C59B3668DBBBBBB4C266B6C6CCCC9C9D1D5D50D0E0E0E0909A1D168B6B6B66E6E6E6432D9C2C282C964E29F7BF3E6CD010306F8FBFB33188C458B162D5BB66CE9D2A5DDF719111111181848A3D156AE5CB979F3E6193366ECD8B18340206018666A6A3A6FDE3C1E8F676A6ACA6432972F5F6E6666E6E2E2121212825F327FF9E5972121213299ECC5475A0000E0FD07B44C264B4949C9CFCF2710082A950A21442291860C19B267CF1E3A9DBE7FFF7ECD7FFF8D8D8DB5B4B4300CB3B6B66E696991CBE5B76FDFFEECB3CF346F9C33674E5B5B9BA5A5258661542AD5CCCCECC5ABF53973E690C964B55AAD56ABC3C2C210423A3A3AF813802C160B2F77D71D97CB3D71E2C4DEBD7BF1D19817AB67989A9AD268340CC32C2D2D5B5B5BB95C6E747474525212DEC2E6E6E6EFBFFF1EFFA5F09956381CCEA953A7525252DADADA140A45636323DE780000E87501CD6030424343D7AC59636F6FAF52A99A9B9B190C465454D48A152B783CDEB973E7366EDC883FDBFDECD9B3D6D6567D7DFDFBF7EFDBD9D9D168B4CF3EFB6CC3860D8E8E8E6AB5BAB5B5554F4FCFC6C6A6B0B0D0C4C44420103C79F2A4C767393A3ACE993367F8F0E12412A9B3B3532E97FFC5DD1A72B99C4C269B9B9B6FDCB871CA9429FAFAFA62B1181F2AE9AEA4A4C4DFDF9FC964161616DADADA969595656666EEDDBBD7C5C5A5B9B979DAB4693DB6BF77EF5E6565E5D1A347EDECECEAEBEBA1B41B00A0F706B49999D9800103A2A3A33D3C3C944AE5B367CFF04BDACF3EFBACBDBD7DE7CE9D0505059F7CF2091E6DF1F1F1FAFAFAC9C9C9919191868686C3860D8B8E8E1E3060805AADAEA8A8080B0B9B3A756A7C7CBC4020108944191919F845AB466464644242424B4B0B8D466B6C6CD47C8BD88396961691483C77EE9CB7B7F7E8D1A3E3E2E2626363CDCDCDB95C6E6B6BEBBA75EBBA6F7CFBF66D2323232D2DAD6BD7AE4D9B364D4B4B8BC562E5E7E73F7BF6ACACACACBEBEBEC7CE7575754924526E6EEEA3478F9E3C79C2E572E11C0200F4D2803630309832654A7272724141018542193264486363E3575F7D45A1508C8C8CA64E9DAA89306F6F6FB1585C5050307CF8F0C993275328944993262527273F78F0804422F9F9F9999A9ADAD9D949A5D2BB77EF1A1A1ACE9C3953A9542284060F1E6C656585101A3972248140C8C8C8108BC54E4E4EBEBEBE2C16AB7B85A319336620842C2D2D838383F3F3F30D0C0CF03999D2D3D33333334D4D4DC78D1BD7A3FDFEFEFE2D2D2D6D6D6DE3C78F0F0E0E96482478D154B55AEDE9E9191919696060A0D9334268E0C0813C1E2F2F2F8F4020F8F9F9A954AA1EB59F0000E04D7993E546FFC2860D1B6C6D6D3533DAF512919191F8A4B16FEF23A0DC287875506E14E034E546A1160700007CA4431CAF282222424B4BABB7FDF28B172F7EF15E110000F86F05B48B8B4B2FFCE5070C1800670000A0D782210E000080804608213464C8908686867FFA2E7C26C057DC382F2F2F3C3C1C2124954AFF629AF01ED46AB5402080130200F0DF0D687C62D67FFAAEC8C8C8ACACAC57DC58A552E1B97CF4E851BC60E9AB686F6FF7F5F585130200D07BBCDD31688944525353C3E57269349A9595959E9EDE4B37EBE8E8A8ABAB130A852C16CBC1C1814C26B7B4B43C7FFE5CA150E8EBEBCBE5F2D6D6D6C78F1F93C9643F3F3FA552595A5AAA193EAEACACD4D1D1313030A8A9A9E17038140AA5A5A5055F357EFC787C7E58994C565353D3D6D6866198B1B1B19595554B4B0B8FC753ABD59D9D9D140AC5DEDEFEDEBD7B2291283B3BDBC8C8C8C9C90921D4DADA5A575727168BF5F4F4FAF6EDAB99DB1B00003EF880964AA5595959F1F1F142A110211418183871E2C4975EBA5EB870E1EEDDBB1289844020CC9933C7D7D777FFFEFD5555554422D1CCCC4C2A959697975FBA74E9CE9D3B03060CE072B9F3E7CFBF7FFF3EFEF67DFBF6F9FBFBF7EBD7EFE79F7F6E6D6DD5D2D2D20C6B9C3A75CAD4D474FEFCF9376FDECCCACA7AFEFCB95C2E3735358D8C8CCCCCCCFCFDF7DF9D9D9D5B5B5B8542E1A851A36EDCB8D1DEDEFECB2FBF0C1932C4C9C9A9A9A9292E2EEEC1830732998C48242E5FBE1C2FCB0700001F43407774749C3F7F7EE4C891C1C1C14F9E3C397DFA74BF7EFD5EDCECDEBD7BA5A5A50B162C707777BF7EFDFA2FBFFCE2EEEE9E9696B66DDB365F5FDFCACA4A2D2DADF6F6F6B973E706040420845EFA74757474B4B1B1715454944824DAB66D5B8F12A0CDCDCD53A64C717575E5F3F967CF9EBD70E182A1A1A19696D6AC59B39C9D9DEFDFBFBF7CF9F2949494C0C0C0F8F878FC2D1919190D0D0DAB57AF767070484C4CDCB367CFB973E7E07401007C24012D140A737272582C564949894C26CBCFCFFFFCF3CF5FDCACB6B6F6D1A347542AF5DAB56B2291283737974EA7070606A6A5A5DDBB77AF7FFFFEC3860DFBDBCF7AF8F0E1D6AD5BF5F4F4747474C68F1F7FECD8B1EE6BC78C19939E9E7EE5CA15A954FAFCF9730CC30C0D0D3D3D3D3D3C3C8844E2279F7CD2DEDEDE6364BCACACACA4A4243636964C260B85C27FFF2C250000F4A280C6304C4B4BCBD6D6564B4B4BAD563B3A3ABABABABE74330303031B1B1B32998C10DABE7DBB9696D6E2C58B1F3D7A545B5B9B96964622BDA4910A85824422C96432BCC4288140C00B772084342F348E1C3922954AD96C368944120A851C0E0721442291F061651289F462C9500281D0A74F1F1B1B1BFCD3070E1C08E70A00E01D7B8B777130994C3F3F3F2D2DAD891327868484B058AC97DEF4E6E0E0C066B3FBF6ED3B75EAD43163C6088542B1589C9A9A3A68D0A0E0E0600CC31A1A1AA8542A97CBC5B398442231188CACAC2C814070EBD62DBC8A888F8F4F7C7C7C5B5B5B5D5D5D5C5C5C8F8FC8CDCDB5B6B69E366DDAB061C3F001F197FE9D2093C96D6D6DF88F6E6E6E7A7A7AFDFBF79F366DDAA851A3A06A1D00E0A3BA82363030983D7BF6891327CE9E3D4B24127D7D7DBDBDBD5FDCCCD7D797C7E31D3B76ECDB6FBFD5D1D1193D7A3486615C2E77FAF4E91289C4C3C3C3CFCF8F46A31D3E7C78C78E1DE9E9E9BABABA5F7CF1C5F7DF7FAF52A95C5D5DF1ABE0C8C8C81D3B764C9830415757D7C4C444241275FF889933679E3973E6C489132626267F36FF2C8D46F3F2F21A3B76ECE8D1A3A3A2A2468E1C29140A77EFDEDDD8D8A8AFAF3F79F26438570000EFD8DBAD66A7542A3B3B3BC562313EDCC16432DBDADA0C0D0D7BDCB226954AF97CBE4C262310082C168BC1600804028140A052A9180C86B6B6B65C2EC72BF49B9B9B6318269148783C9E4AA5A2D1684AA592C964D2E9F4CECE4EA150482010F0858686867C3E9F402030994CA954CAE3F1F012FE542A55A95452A954954AC562B1F006E0D5A5F97CBE4020A0D3E9788951B158DCD5D52593C948249266DE967F0AAAD9815707D5EC004E53CDEEEDDE074D2412F5F5F5BB2FE9D3A7CF8B9B51A9542323A3EE4BB4B5B5B5B5B5FF779D4F2275CF473A9DFE625CEAEAEAEAEAEAF60847CDFE5FFAB91A78C9A41E7B78E9A70000C03B03B538000000021A0000000434000040400300008080060000086800000010D000000020A0010000021A00000004340000404003000078E7FEBE16079FCF4F4B4B839E7A3DAF3E19390000FCE3802E2F2F1F3D7A34F4140000F4A2802610085F7FFD756F6E7D6E6E6E4E4ECEF8F1E3FBF6EDDB6B1BD9A39E1F0000BC81802612893B77EEECCDADDFB66D5B4E4ECEF4E9D3274D9A04C71200F091812F09C16BBA7EFDFAB56BD7A01F00783F57D00074171E1EDEDEDEAEF9B1B6B61621B46FDF3ECD127D7DFDF3E7CF43470100010DDE9D458B16656767979595E1F3F6E266CE9C8961D8E9D3A7FF77329148FDFAF51B3264C8AFBFFE0A9D06000434785BD46AB54AA5FAE1871F7EFEF96781402097CB8B8A8A4C4C4C341BE0F381EDDAB54BB3A4A9A9A97FFFFE1515158989894B962CD9B061038140C0300C3A1380D70363D0E025A452E99123474824D2EEDDBBA954EAB56BD7140A859B9B9B61375A5A5A5A5A5ADD97B8B9B929148AEBD7AF53A9D49F7EFA8944221D3E7C582A95427F0200010DDE0C894472E6CC99850B171A1B1BEFDBB7AFBEBE3E2020E0D5DF3E62C488FAFAFAFDFBF71B1B1B2F5AB4283A3A5A229140AF02F01A608803FC1F72B9FCCC9933F3E7CF373535FDEEBBEF66CF9EFD7AFB99356B964C26DBBC79F3FCF9F3D56AF59C3973C86432742F0010D0E0F59D387162E1C2852626269B366D9A3F7FFEBFD9D5BC79F3D46AF5E6CD9B172C58A052A9162E5C08DD0B000434784D870E1D5AB66C998181C1962D5BBEFCF2CB7FBFC3F9F3E71389C46FBEF966E9D2A52A95EAABAFBE824E06E0D5C11834F89F9D3B7792C9E4BD7BF7BE9174C6CD9D3B77EFDEBD140AA5973F950A000434E8BD366EDCD8D6D646A552A74F9FFE66F73C7DFA742A95DAD6D6B671E346E8670020A0C13F76E3C60DA15078F1E2C5B7B1F38B172F8A44A2F4F4F457D9F8D4A95357AF5E8523020004F4C7EFD75F7F7576767EC5A2DE7E7E7E6FA30DAFB8DBB4B4346767E7BABABA214386C081030002FAE3C7E3F19E3D7B161A1AAAA7A7F7C71F7FBCF4C991888888C2C2C2E2E2621A8DF636DA40A5521F3D7A5458583875EAD417D74AA5D2B2B2323D3DBDD0D0D067CF9E9148245D5D5D387000C05D1C1FBF75EBD63534341C3C781021E4ECECCC60304A4B4BA9546AF7E7B68542A142A1D0D1D1797BCDD0D1D1512A9542A1B0FBC2A6A626A954EAEAEA8A2F673018EBD6AD5BBF7E3D1C3500E00AFABFC2DADA5A336F804824B2B6B61E3D7AF4FDFBF76B6A6ADE57936A6A6AEEDFBF1F1414646D6DAD49EDA0A0A0A8A828385E007C3C57D0F9F9F9140A058EE55F707474747272BA7BF7AE66C9A3478F7C7C7CC68C19B360C1020F0F8F77D998DADADAE2E2E223478E5CBF7EBDC72A0E87F3FBEFBFFF670F53F76281007C24010D37D8BEB6E4E4E4E4E4E469D3A6D5D4D47CFEF9E74C26F31DA4F3B7DF7E7BF6ECD997AECDCDCD9D3061021C17003E86801E3264C8B7DF7E0B47F1552426263E7DFAF4A5ABB85CAE44223136362691DEFAF920168B3B3A3A5EBACAC2C262D6AC5970A4D86C367402F81802DADFDFDFDFDF1F8EE2AB282D2D7D31A0870D1B161616E6EFEFBF61C386A3478FAE5FBFFEAD7E4F8810727272DABE7DFBD8B163CF9F3F9F9595D57D9542A1B0B0B078830F310200010D3E00C78F1FBF77EF5EF7257DFBF6DDB66D9BADADED800103DE71635C5C5C5C5C5C060F1E5C5959B971E3C63FFEF8035FCEE17052525220A0018080FE6F292A2A6A6868C05FD3E9F4F4F4746D6D6D7777F7F7D8A4FEFDFBF7EFDFDFD1D191CFE78F1C39522C162384323333F7ECD9B372E54A3864004040FF271C3C78302626067F7DE3C60D1B1B1B5B5BDB5ED2B67EFDFA21849E3C79525353131818D8DEDEBE65CB160A85B278F162387000C07DD01F3F8140A05028CE9D3BD7D5D53562C48897A6735C5CDCC081035D5D5DDFD20C553299CCC5C5C5CBCBEBA5D37EDBDADA0E1F3EBCABAB2B2E2E4EA150747474C00D67004040FF27AC5DBB56201084878733994C02E1E5479C46A3118944A150F8961E5DA9AEAE160A854422F1CF1E252710084C26332C2C4C2010B058AC0B172EC08103008638C0FFE3EEEE5E5454E4EBEBCBE572DFF8CEFDFCFCA854EA2B8E7A2F5FBE1C0E070070050DFEE7E8D1A326262672B9FC158B82BEBAF4F474994CD6A74F9F63C78E413F0300010D5EC7F4E9D32512C9F4E9D3939292DED43E2F5FBE3C63C60C7CB7D0C300FC2330C401FE272A2A0AC3B0A8A8A8E5CB97CBE5F2C99327FFCB1D262424AC59B3A6A9A969E3C68D500509000868F0AF6CDCB89144227DF7DD77EBD6AD53A954616161AFBDABF8F8F8F5EBD7D7D4D47CFFFDF76BD7AE85BE0500021AFC2B140A65E5CA95241269C3860DEBD7AF27128993264D7A8DFD5CB87061DDBA755555555BB76E5DB66C19954A85BE05E09F823168D01393C95CBC78F1D6AD5BABAAAA56AE5CE9EBEBDBBD4EE9DFCACDCDF5F5F55DB162455555552777094400002000494441545454D492254BDE41913C0020A0C17F058BC55ABE7C794D4DCDB871E3F2F2F2424242ACADAD9B9B9BFFFA5D2D2D2DD6D6D69F7FFE795E5E5E7070704D4DCD8A152B582C16F42700AF074308797878141515415F801729140A8542316DDAB49B376F4AA552B55AFD5727138651A9D4808080DF7EFB8D4422BD83E2A5007C94828282525353391C0EFC13027F05CFD9C4C4448490BFBFBFE6229ACFE773381C232323CD4C5A08216363E31E15440100FFEA1F20740178459999999AD7313131D3A74F5FB366CDEAD5ABA16700784B600C1A000020A00100004040030000043400000008680000808006000000010D000000021AFC6B5656562626266D6D6D9D9D9DDD97F3F9FCB6B6361313134B4B4BE8250020A0C17B606767D7DCDC6C6464141414D4D0D080106A6A6A2A2929090A0A3232326A6E6EB6B7B7875E02E00D825A1CE01F2091484AA5F2E57FEA09843F5B0500F84734B538E00A1AFC03A1A1A1AFB10A00F07A20A0C13F70F0E0C1D75805008080066F9D9696D6CA952B5F5CBE62C50AA8CA0F000434789F180CC6ECD9B35F5C3E7BF66C068301FD03000434789FACADADB76FDFDE7DC9F6EDDB6D6C6CA06700808006EF1993C91C387060F7255E5E5E30BE01000434E815860D1BA6F94AF0C08103FEFEFED02700BC0D30A3CAFBA456ABFF7626D65EDB72CD8B8E8E8E0FAEFD8686863065228080067F85CFE79B9A9A7ED0BFC292254B962C59F2C135FBE9D3A74E4E4E7006020868F037F4F4F4BCBDBDA11FDE8DE2E2E2A6A626E80700010D5E89BBBB7B4A4A0AF4C3BB111E1E7EFEFC79E807F041802F09010000021A0000000434000040400300008080060000086800000010D000000020A0010000021AFC773C7DFA149F3D160000010DFE472291242626666767BFC7369C3C79322323038E05006F093CEAFDA12A2F2FDFB06183B7B7B79B9B9B9E9E1E74080010D0A05750ABD5A9A9A9BEBEBE2C16ABA0A060E4C8910821A55279F3E6CDCCCC4C0CC37C7C7CCACBCB478F1E9D9696A6AFAF5F5252121111E1E1E191919171FBF66D8542F1C9279F8C1E3D9A4824161717A7A4A4F0F9FC418306DDBF7F7FCB962D8D8D8D972F5FAEABAB63B158A3468DF2F2F22293C9BB76ED727373CBCDCD653018DF7CF34D8FF6F078BCCB972F3F79F2844422F9F9F98D1A358A46A369D66EDBB6CDD7D73733335322917878788C1D3B564F4F2F2121C1D1D1D1C3C3032124954A77ECD8B169D3A6C6C6C66BD7AE555454F4E9D367E8D0A1F7EFDF8F8888D0D5D54508D5D4D4E4E4E48C1B378E4C26676767E7E6E6767575595B5BCF9E3D1BA60B0030C4017A11854271F5EAD579F3E6B9BBBB676565A9542A84504E4ECEC58B174D4D4D1D1D1D636262E2E3E3ABABAB4F9C38C1E170060E1C686868989999191B1B6B6565656B6B9B9C9C9C9191515E5E9E90902097CB5D5C5CB2B2B20E1E3C28140AF7EEDDABA5A585E77252525259591942282E2E2E2E2ECEC9C9C9D3D3F3C5F6FCFCF3CF5D5D5D5E5E5E969696376FDEBC7DFB76F7B53131310909090E0E0EB6B6B6D9D9D9D7AF5F4708656666565454E01BC8E5F23367CEB4B7B7C7C7C7979797BBBABAB6B5B52525252526263E7CF850AD564BA5D2BCBCBCC2C2420A85929A9A5A5858686F6F3F60C080D2D2D2E8E868381F005C41835E24373797C5620D1C3850A552151515555757DBD9D9A5A4A40C1830203C3C9C46A31108845F7EF90521646767171E1E6E6565452010A2A2A2468C18111A1A8A10A2D3E9C9C9C983070F562A953367CE343333737070888B8BA350289191913636360C0683CBE5EED9B3A7ACACCCCDCD0D21F4F9E79F07070793C9E417DB3371E2441313133D3D3DB1587CE9D2A5CCCCCCA0A0A0EE1B4C993265C890210A85824C26E7E7E7474444BCB893868686E2E2E2152B56383B3B3F7FFEFCBBEFBE737575FDFDF7DF870E1DCAE3F1EEDFBF3F78F0603A9DEEEDEDEDE5E5656262422412070D1A3467CE9CAFBEFA0A4E0900010D7A8BD8D8D849932651A9542B2B2B4343C3FCFC7C3B3BBB868686808000168B856198A6C0B4B1B1319ECE08A18A8A8AD4D4D41F7EF841A5520985423F3F3F2E97ABA5A5C566B38944E2800103A8542A42A8B5B575D3A64D55555552A9B4A3A3C3D1D111DF157E4DFDF2FF8811086BD7AE2D2828108BC542A1B0473A23843C3C3C28140A8542313232128BC52FDD895028BC7CF9F29D3B778844A252A96C6E6E8E8989F9EEBBEFDADBDBEBEBEBCBCACAD6AF5F8F10C230ECB7DF7EBB7EFD7A5B5B9B52A9140804703E000868D05BB4B5B52527272726267EF3CD372A954A2693CD993367DCB871DADADA3C1E4F269391C9E4C6C6464D74E2E98C10D2D7D75FB3668DB7B737814050A9544422312929492E970B0402168BD5D4D4A4542A4522D1C68D1BD7AF5F3F68D02084D0962D5B34B35B1189C43F6BD2D75F7F3D6EDCB8EFBFFF9E4AA55EB972252B2BEBC504D7BCC677482412A552A952A9241008ADADAD082132991C1414B46DDB367D7D7DB55AAD542A592C565A5A5A4C4C8C4422F1F1F1D1D7D747089D3B77AEADADEDC081036C36BBABABCBD7D7174E0900010D7A8B0B172E7CFEF9E7FBF7EFC77FCCCBCBBB74E9D293274F3EFDF4D3A4A4245D5D5D0303835DBB76BDF8C62FBEF8E2ECD9B3542AD5D4D4B4A8A8A8ADADCDD7D7372F2F2F3131D1CBCBEBF4E9D33C1E0FBF4495CBE5ADADADB9B9B93939397852FF350CC3140A455757576161616C6C2C9BCDFEDBB7383A3A666565999B9B6B6B6BEFDBB70F21646E6EEEE8E878F6ECD909132648A5D2AB57AFCE9A356BE6CC993367CE3434343C78F0208661F87B552A954422A9ACAC3C7DFAB4E6EF070010D0E0FDABADAD9D3C79B2E6477B7B7B5B5B5B1E8F171C1CCCE3F1F6EEDD8B61D8D0A143939393F5F4F46C6D6D355B868484601876E0C081F6F6F6FEFDFBCF9E3DDBD5D5352424E4E4C993F1F1F1C3870FD7D3D36330186BD6AC3971E2845028F4F6F61E31628491911142A85FBF7E140AA5474BACACACF0B59B376FDEB76F5F5C5C9C8383C3C891236532598FF10DCD0CAD9A264D9E3C99CFE747454531188C2953A68844225353D359B3669D3E7D7ACD9A35341A6DC284090606063636366E6E6EC6C6C6AEAEAEF81E4243434F9E3CB96EDD3AFC8DB5B5B5704A808F998787871ABC0FF815ABBFBFFF9BDA6155555557579748243A79F2646464E4ABBCA5A9A9A9A5A5452291DCB871232828482A957EDC7D1E161686107AFAF4299C7EA0D71A3D7A344288C3E1C015F447E5F6EDDB028140A150141414CC9831E355DE525252F2F0E14332995C58583871E2C4BF18680600BC63701FF447C5C7C707C3308944121111111010F02A6F717474343636160A8523478E9C34691204340030060DDE0A1717171717977FF416369B3D7DFA74E83A00E00A1A000000043478130A0A0A76ECD8515E5EDE7B9A74F8F0E16BD7AEBDB8BCB8B878F7EEDD4F9E3C81A30620A0C1C74F2A95A6A6A6D268345353D37FB39F51A346757676BEA9563D7FFEBCA5A5E5C5E596969662B1F8F6EDDB72B91C8E1DF838C018F40740A954CA6432A55249229128140A866152A954A1502084C864B266895AAD56A9544AA5122144A5526532199148A4D3E94AA5522A95E28F0E52A9540CC3844221994C96CBE52412894AA5CAE572B95C8E6F40A7D335CF839496968A44A2112346686B6B2384040201FE2E0CC328140AFED8B75C2E97C9646AB59A4422E115ECD46A35BE106F9E42A1A8ADADE5F3F92412494B4B4BD3181289A4542A69341A9148D4EC9948249248247C870402814AA5E25F5AAA542AFCB143FC2970BC7932994CF329542A554F4FCFC7C7E7CE9D3B5555557DFBF685D306404083B74E26936565651D3A74A8A6A6C6C7C767EDDAB55C2EF7F0E1C3B9B9B9040261E4C8912B56AC303333FBE69B6F9A9A9A8442614545456565E5DAB56B5352523C3D3DF7EDDB97929272F2E4C99A9A1A1B1B9B6FBFFDB66FDFBED6D6D6919191191919C1C1C173E6CCC14B5BB4B7B75B5B5BEFDCB9132F8D8410AAACACA452A9363636F88F4E4E4E3366CC484D4DA5502853A64CC1EFB33E7DFA744242029FCFEFDFBFFFCE9D3B4D4C4C1A1B1B0F1D3A949A9AAA56AB030303F3F3F36B6A6A860F1F6E6161919696969999B967CF9EA6A6A6010306E4E5E51D3D7AF4934F3EB1B2B25AB468516A6AAA9D9DDD8811231213131B1A1A4C4C4CD6AC591310104024121F3F7EBC79F3E6AAAA2A2727270E87E3E4E4D4DEDEBE67CF9ED4D454954A357AF4E855AB56191A1ABAB8B86466663E7FFE1C021AC0100778172A2B2B131212424343333232C68D1B472010121212A64F9F9E9F9F7FF9F2652A957AFEFC797C4BB158BC75EBD6C78F1FB3582C3A9D7EF3E6CDC3870F171616A6A5A5CD9B370F2FA6BC7FFF7E994CA652A9ACACAC323333376FDE5C505060666676E9D2A5828282D0D0D06DDBB6693EBABDBD9D4422E1153034D7F2376EDCF8E5975FCACBCB9393939393939F3E7DBA6FDFBECCCC4C1313931F7FFC1121545656F6F8F1E35F7FFD353D3D7DE0C081D1D1D1B6B6B6050505B76FDFAEAFAF8F8F8F8F8888B875EB56606060F7070EB5B5B533323256AE5CC9E7F34F9E3C999F9FFFD5575F45474773B95C8944F2F3CF3F0F1D3AF4F6EDDB3366CC100A8508A1D3A74F73B9DC8B172F5EBE7C99C7E39D3A750A21646464A4542AB95C2E9C3600AEA0C1BBD0DADA2A9148C68D1BA7A3A33376EC5884D09A356B9E3C79929C9C2C97CBD56AF5B367CFF02D8383835D5C5C88442291485CB468113E2E515D5DDDD2D2D2D1D1919E9E4E2693EFDDBBA7502874757567CC98A1A5A585100A0A0AAAA8A8C8CBCB9348240C06E3FEFDFBDDE318C330CD53DA08A165CB96E9E9E9F5EBD7CFD3D3B3B4B41421E4E9E9D9AF5F3F2A95BA7CF9F251A3462184F4F5F5FBF4E9939595F5FCF9F37EFDFA99989868DECEE3F1783CDEF8F1E3592C567070F0B973E7F0E5643279FEFCF94C26D3C3C3434747E7C9932722914826939596964AA5522A95FAE8D1A39D3B77EAE9E9F9FBFB0F1E3C182174FFFEFD79F3E6999B9B631816161676E0C00184109148C4C779E0B40110D0E05D50A9546AB5BA7B9DCFD8D8583C1CD56A757575759F3E7DF0E54C26130F530CC374747434215B5F5F9F9B9B4B2693552A55505010994C261289787C2384EEDDBB77F5EA55FC62562E9777FF364F5B5B9BCBE50A0402CDDEF051660281A0190B26128978A53A1A8D86EFA46FDFBEB367CFCECECEBE79F3E6AD5BB7962F5FAED9219E9E7823C964B2A6C49DA6C1151515A74F9F160A8578F5250E8783FFFA0A8502AF04422291F0B7E34BF0E1720A85827F31C8E7F3894422FE87070018E2006F9D9E9E1E954ABD73E78E50287CF0E0415B5B5B4242C2C081037FFCF1C7AFBFFE5A5342E8CF989B9B0F193264D6AC59BB76EDDAB265CBA851A37A3C2B585050A056AB57AD5AB575EBD691234776AF0BCA66B3A552697D7DBD66496262A25028ACA9A979F6EC99B5B5B5B5B5757979797575B550288C8F8FC7EBDE7576762A95CA458B162D5AB4A8B6B6B6B9B9994AA5E2C30E4C26535B5BFBEEDDBB2291E8EEDDBB7575753D5A5B5D5D5D5353337FFEFC6DDBB6858686E27F45482492BDBD7D6A6AAA50282C2E2EC66FA4C3879BDBDBDB3B3A3A6EDEBC893F9E535D5D4D2412BB5FB3030057D0E02DB2B6B61E366CD8B973E72E5CB8A0AFAF3F77EEDCB163C7DEBC79F3CE9D3B743ABDB5B5B5FBEC7F2FEADFBF7F7D7D7D4C4CCCA953A7C864B28989C9902143BA6FE0EEEE5E5E5E1E151585DF08D1BD7AA7B3B3F38D1B379E3C79E2E8E8885FC2979696AE5EBD5A2291585A5A0606062284EAEBEB7FFCF1472291281289962E5D8A10128944E9E9E9B1B1B172B9DCDEDEDED4D4342020E0BBEFBE333737DFB06143404040747474424202954A1589443D5A6B6161A1AFAFBF67CF1E1A8DC662B1F0D2FE341A6DC68C19717171A9A9A9743A1DBFC60F0B0B3B7AF4E8BA75EB1042542A75C182053299ECE1C3870C06A37B013F0020A0C15BA4A3A3131C1CECE0E0C0E3F14C4C4C4C4D4D67CF9E5D52528257D9D7D1D1C1875CE7CE9D8B4FAE8A10EA3E4D9FA1A1E1F8F1E39D9D9D3B3A3A28148A9D9D1D93C93C72E4886683214386181B1B3737371389441B1B1B7F7F7FCD2A6363630F0F8FFCFC7C2F2F2F7B7B7B84D0FCF9F39F3F7F4E2291ECECECACACAC1042B367CFAEACAC944AA5262626F80CB06666665F7CF1455D5D1D8661363636161616CB962DFBE38F3F88442293C91C376E9C9D9D5D575717994CAEADADC5735FD3604747C7A54B973E7FFE1CC3307373F351A346191B1B9348A4C0C0406363E38E8E0E7D7DFD2FBEF882CD669B9B9B7FF5D55735353508212B2B2B4747C7929292A74F9F060404C01CE7E0A38121843C3C3C8A8A8AA02FDEBDCECE4E5D5D5D7F7FFF1EB3ACF61E7C3EBFA3A3C3D8D898C160B0D9ECDADADA7F594DA9AAAAAAACACCCCFCF2F292929272767EDDAB50E0E0E6FA4A95D5D5D1D1D1D0606067F3DC9777878F8F9F3E79F3E7DEAE4E4046720E89D828282525353A1DC28F81B2C168BC562BDC11DAAD5EACB972FAF5EBDDAD4D474D5AA55F865F81BA1ADADADF9E6130018E200FF2D555555FFBE18A9ADADED810307542A1586619A3B40000010D0E05F7971CAABD7D0E3C66A00C05F80EB17F0D6DDBF7F1FAF1C0200808006BDCBCC9933F19912D3D3D3FFD11BD3D3D3F107BB01808006E02D924AA5FFB458F3C68D1BDBDADAA0EBC07F168C067EC0944AE5B367CF6EDEBCD9DCDCACAFAF3F7AF468474747CDF7781289243F3FFFCE9D3B3299CCDDDDDDDFDF3F3E3E7ED2A44906060608A1DADADAECECEC69D3A669F6A656ABB3B2B2727272D46AB58F8F8F959555555595B7B7B7BEBE7E5353D39D3B77C68C19A356ABF7EFDFEFEAEA5A5C5CACA7A73772E448BC6EDCDDBB77737272A452E9A041833EFDF4531289F4F4E9D31B376E747676F6EFDF1F7FDE04C3302A958A7F506565654646466363A3A5A5E5E79F7FCE643277EEDCE9EDED9D9F9F8F10F2F5F5F5F3F34B4C4CACAFAFDFB973679F3E7D366DDAD4DEDE9E9696565E5E6E6060306AD4287B7B7BF88211C01534E8BD381C4E7474349148B4B4B46C6969898F8FE770389AB5F5F5F5C78F1FC730CCD4D4B4B4B4B4A1A12126264653E9ADA1A1E1D2A54BDDF7969D9D7DF6EC591D1D1D6D6DED2B57AE646767DFBF7FFFCE9D3B4AA5322121A1ADAD0DC3309148B47BF7EECCCC4C6363E3868686F8F8F8DADADADCDCDC9898181A8D66606070E5CA955BB76ED5D4D4E08D313232BA79F3268FC74308F1F97CFC8194E7CF9FC7C7C7D7D5D5999A9A3E78F0E0DCB973F86E6FDFBE6D6464A456AB2F5CB8505C5C6C6E6E4EA3D16C6C6CECEDED0502C1C58B17737373FBF4E9C3E1701212121A1B1BE1040070050D7A2F5D5DDD2953A6D8DBDB33188CC6C6C6CD9B37373636B2D96C7CAD4020A8ABAB8B8888F0F1F1E9ECECD4143CFA3331313143870E9D3C79329EC84F9E3CF1F3F32B2C2C94CBE50D0D0DB367CFA6D168F8E38B93264D1A3870607575F5A143879E3E7D9A9696E6E9E91916164622919292922E5FBE3C66CC98CECECE458B16595959E5E5E55DB870A1FB071517177774747CF9E597B6B6B6252525AB57AF9E32650A93C99C3C79B2ABAB2B9FCFFFE1871FCACBCB67CE9C6968683879F2642B2BABDADADA8C8C8C65CB96797A7AD6D7D7EFD8B1A3A6A646F39B0200010D7A1D2291585757B76DDBB6BABA3A994C565F5F3F63C60CCD5A7CF4E0E0C183BB76ED0A0E0E8E8888F8EBBD959595656767E33729777676FAF8F8B8B9B9656666EEDCB9333232122FEC89106232995E5E5E140AC5D6D69642A1F078BC8A8A8AEBD7AF1F397244AD56777575393939757474E017BF241269D0A0413DCACBB5B5B59D3B772E2323834020C8E5F2CACA4A954A45A3D1DCDDDD894422FE2860F752D1F8704D5A5ADAD3A74FF17958EAEBEB434242E0040010D0A0F7AAADAD3D76ECD882050BF05A6E4B962CE95E0A594F4FEFCB2FBFFCE28B2F2A2B2B0F1D3AE4ECEC4C2412A552294248A552757575F5D81B8BC55AB76E9DBBBB3BFE239D4ECFCECE269148A1A1A1E5E5E55C2E177F845AA15070B95C131313914884D741653299DBB76FF7F6F6D6D41D4D4F4F57A954229188C56271B9DC1EF7D851A9D4F0F0F0850B1732180C7C09FE021F3DC7FF0C74AFD984AF1A3468D09E3D7B34F546F09174003E6E3006FD01C3E7F7A3D16872B93C2929A9A4A4A4FBDA9A9A9A1D3B76343737E35BAA54AA7EFDFA9D3A75AAA2A2E2EEDDBB7BF6ECE9B1B7A953A746474737343428140A7C83FCFCFC7EFDFAAD5CB952AD56E7E5E5E157B51C0E67DFBE7D656565F1F1F12291C8D1D171F2E4C9172F5EACAEAE56A954050505A74F9F767474E4F3F90909096565653FFDF4538F395EDDDDDD552A55464686542AE570383FFEF8638FEB650D2323A3478F1EB5B6B6EAEBEBFBFAFAC6C6C6767575F178BCE8E8E8B2B2323801005C4183DECBD2D2322C2C2C2A2A4A2E978F1831C2DBDBBB7B9D207D7D7D13139365CB96A954AA4993260D1A34C8D9D9F9C71F7F0C0F0FB7B1B119356A54F742CF08A1F0F0700CC3366DDAD4D1D13170E0C0FEFDFBB7B7B70704049048A4F9F3E74747477FFAE9A7E8FF2F79111919696666B668D1223737B77EFDFA218476EDDAC5E170060C18307FFE7C0F0F8FC993271F3A74E8D4A953C1C1C19E9E9E4422914C26DBD9D92184DCDCDCA64F9F7EE2C48953A74EE9EBEBCF9C399342A1749F45B04F9F3EF83C5B73E7CEDDBF7FFF8E1D3B727272E6CD9B77E4C8912FBFFC924C268F1F3FFE5F4E340EC00701AAD9BD4FBDBF9A5D0FADADAD0101018F1F3FFE70FB1CAAD981DE4F53CD0E86380000A097828006FF0083C198356B16F4030010D0A0D7D1D2D25AB56A15F4030010D0000000010D000000021A0000000434000040400300008080060000086800000010D000000020A00100E00302D5ECDEBF8A8A8A152B56403FBC1B0F1F3E844E0010D0E055353434ECDBB70FFA01000001DD8B6869696564647C882DBF71E3C60F3FFCB060C1822953A67C88EDB7B4B484D30F404083BFEC7D1269C488111FE8553F42C8CECEEE036D3F001F04F89210000020A00100004040030000043400000008680000808006000000010D000000021AFC6BF3E7CF8F8C8CFCB3B573E7CE9D376F1EF412006F103CA8025ED5B56BD75A5A5ACACBCB070E1CE8E5E5A559BE72E5CAFCFCFCBCBC3C232323E82500DE200C21E4E1E1515454047D01FE5A7575B5BDBDBD4AA56230182C16ABA9A9C9D0D0504F4FAFA1A14124121108848A8A0A1B1B1BE82800FEA5A0A0A0D4D4540E870357D0E055D9D8D830180C814020128944221142A8ADADADADAD0D5F4BA7D3219D0178B3600C1AFC03555555AFB10A0000010DDE3A3299ECE1E1F1E2720F0F0F32990CFD03000434786F7475756362625E5C7EF6EC593D3D3DE81F0020A0C1FBA4AFAF3F6EDCB8EE4B828383F5F5F5A16700808006EF999999D9D2A54BBB2F59BA74A9B9B939F40C0010D0E0FD7372729A3D7B36FE7AF6ECD9CECECED027004040835E81CD66070404E0AF478C18C166B3A14F00781BE03EE8DEE5871F7EB872E54AEF6FA7E6F6E72D5BB61C3A74A897B7D6CFCF6FCF9E3D7076010868F0AF545656DEBB77EF036A704545454545452F6F24DC610220A0C11B73E7CE9D010306403FFC7B1C0EC7CECE0EFA0140408337864AA5D2E974E8877F8F46A34127800F177C4908000010D000000020A0010000021A000000043400004040030000808006000000010D000010D0E0DD50A9543C1E4F2814FED9060A85A2ABABEB8D7FAE52A9E4F3F9FF7E3F4B972EBD74E9121C470020A03F42F5F5F5DEDEDE4B962C91C9642FDDE0E9D3A7EBD6AD7BE39F5B5555B572E5CA37F20746A552C17104E02FC0A3DE1FAACCCC4C737373954AF5F8F1632F2F2F84904020A8AAAAE272B9140AC5D6D6D6CACA6ADEBC790821B55ADDD4D4545B5B2B97CBCDCCCC1A1B1B870E1DDAD9D9595E5EAEADADDDDADA4A24126D6C6C8C8D8DE5727979793997CB251289E6E6E69696960402A1A5A5A5B6B6562A95B2D96C1B1B1B3333B3C58B17E3BBC5574924127D7DFDBE7DFBAA54AAC2C2426363E3A6A6260CC32C2C2CCCCCCC48A4FF9D632291A8BCBC9CCFE7EBE9E9E157F76AB5BAAEAEAEAEAE4EA552999B9B5B5B5B1308FFBB68282828707373C31FD7E6F1780D0D0DAEAEAE95959552A9542A95F2F97C3A9DEEE2E2C26432E17C0010D0A0B7502A95494949F3E7CF6F6868C8CCCCF4F4F4C4302C3939392525452291D0E9744F4FCF8103076EDDBAF5F7DF7F6F6C6C8C8989292E2EA65028FAFAFAA74F9FEEE8E8282929993B776E707070737373575757FFFEFD172C5890999979FFFEFDE6E666B95C6E65653573E64C1D1D9DD8D8D8C78F1F2384ACADAD376FDE5C5D5DFDF5D75FA7A7A7373737C7C6C63E78F040AD562384E6CD9BE7E0E03069D2A4993367363535757575393838CC9D3B5753AB482693DDBC79333636964824B258AC478F1E8D1F3FBEAAAAEAC891234D4D4D4AA5D2C4C464EEDCB9DDCBFF7FF5D557F1F1F156565608A1A2A2A2C3870FC7C5C59D3871E2E9D3A76C369BCBE57675754D9C3871C68C19704A000868D05B545454B4B6B6060505DDBB77EFCA952BADADADC6C6C61919196C367BEEDCB95A5A5A77EEDCD16C9C9393D3D2D2B26EDD3A1B1B9B73E7CE6118862FA7D1684141413E3E3E151515DF7EFB6D6363637B7BFBBC79F3ACACAC5A5B5BA3A3A3D3D2D20C0C0C381CCEAA55ABECEDEDB3B2B2BAB7213737B7A6A666E5CA950E0E0EE7CF9FFFE5975F7EFEF96732993C78F0E01123463436366EDFBEBDB4B45413D09D9D9D717171A1A1A163C68CC9CFCF2F2A2A420845474733180CBC58F3891327121212366DDAF4B7BFBE8E8ECE575F7D656D6D9D9393F3CD37DF4040030868D08BC4C7C7070505E9EAEADAD8D8686B6B3F78F020282868F8F0E1797979FBF7EF3736360E0D0DEDE8E8C0377EFEFCB9A5A565DFBE7D2914CAE4C993BFFDF65B7CB9A5A5E5D0A143C964B29B9B1B866152A974DCB87157AE5C696868904AA5E5E5E50E0E0E9D9D9D0E0E0E4E4E4E140A252828A87B1BEAEBEBCDCCCC5C5D5DA954EAA449937EFCF1478490BEBEFEE8D1A329148ABDBD3D8BC51289449AED2512495D5D5D50501093C9F4F1F1C1AF94F3F3F3F5F5F577EFDEAD56AB6B6A6ABA8F87FC85C183073B3A3A120884E1C387373636C2F90020A0416F2110082E5DBAA4A3A3535E5E2E12892A2A2A180C464040C0D8B163ADADAD9F3F7F5E5A5ABA6BD7AEC8C8487C7B0CC3542A153E102197CBF11708212291482693F117F865F5AE5DBBF4F4F4ACACAC08040297CB95CBE5040241F3DE1E0804825AADC6BFE893CBE5442211FF2C0A8582AFC530ACFB1B310C2310084AA51275FB86904020383838D8D8D86018E6E2E2828F6674FF08B95C8E6F2F168BC8B20936000020004944415435CBC964323E544D22915EDA36003E0E7017C787273B3BDBD2D272EDDAB5E1E1E173E6CC99366D5A5757574D4D4D4646068140080E0E1E3468507E7EBE667B3B3BBBCACACAE2E2623E9F7FFCF8713CF25E2A2B2BCBDDDD3D3C3CBC7FFFFE7C3E5FAD563B3B3B9794943C7CF8B0ABABEBECD9B3DDD3D0DADABAB6B6B6A0A080C7E39D3871C2C7C7E7AF9B4DA3D16C6C6C1212123A3B3B6FDDBA850F718C1831422010040404848585B9B8B868AEFA716C363B25254524125556569E3F7F1E0E3D802B68D0DB2526264E9E3C5933E0E0E2E272F4E8D1C78F1FEBEAEAFEFCF3CFE5E5E5BABABAAB57AFD66C3F7CF8F0BABABAB56BD72A140A6F6FEFBF184658BA74E9FEFDFB7FF8E1072B2B2BFC42F8D34F3F6D6969D9BC79735757D7A851A3BA6F3C64C890FAFAFAA8A8A8CECE4E6B6B6BCDC8C99FD1D5D58D8C8CDCBD7BF78913271C1D1DF18BF7D9B3679F3C7932323292CFE73B3A3A4E9F3EBD477B76EFDE7DFAF469369B6D6262229148E0E883FF140C21E4E1E1815FCE80F72E3232F2E4C993050505F89D732FC5E3F1E8743A954AC57F54A95442A19044221189448140808F36B0582C0CC30402013E1D9F582C1608042A95AAB5B575C68C190F1E3C90C96442A15033591F97CB6532992A958ACFE72B954A32994C2291300C63B15862B15828142A954A2D2D2D2693A95028F87CBEBEBE3EBE5B7C15954A65B15808A18E8E0E4343437C9F7C3E9F42A1749FD3047FAF5C2EA750282A954A4B4B8B46A3894422A150A852A928148A969616FE87A1FBF632998C4422E16FD1D5D5EDEAEA2291489A19675A5A5A8C8D8DFFACAF1A1B1BCDCDCDC78C1973FDFA7538BBC08722282828353595C3E1C015F487475757B7FB8F0402415B5B1B7F8DE7A686267F535252B4B4B4D86CF6EEDDBB274C988010A25028DDA350B3A59191518F8FA3D3E9DDE7DF2291489A4FE9B10A21A4496784101ED9FFE7FF6BDDDEABC16030180CC6CBFF7FF7B2ED35BF2CEE2FD2190018E2001F00369B7DE8D0A1F2F2F24183062D5BB60C3A04000868D05B0C1A34E8D4A953D00F007C58E02E0E00008080066F534646C61F7FFCD17BDA93979757585808C70500086880AE5CB9F2666FC5292A2A4A4A4A7AEDB7DFBA752B2727078E0B0010D0E0CD2B2B2BBB75EB16F40300EF117C49F8A152ABD58D8D8D070E1C282D2D7577772F2F2FF7F1F151281467CF9EBD7AF52A91489C306142585818894452A954393939E7CE9D6B6A6A1A376EDC8C19338442E1B163C7EEDCB9A3AFAF1F1111316CD8B02D5BB6585A5ADEBF7FBFA1A1C1C3C363E8D0A15BB76EEDECEC2C292959BD7A755050904AA53A7FFEFC850B17300C1B3F7E7C585858F7BBF45A5B5B8F1D3B969B9B8B97EC88888878699B391CCEF1E3C71F3E7CE8EAEA3A6BD6AC989898891327BAB9B921841A1B1B77EEDCB96FDFBEDF7FFF3D373717C3B0E2E2E29F7EFA492A951E3870A0B1B1B16FDFBE3366CCE8D7AF5F4E4E4E6C6C6C5353939797D7CA952BA1D628808006BD8E48243A7EFCB84422F9FAEBAF0B0A0A9E3D7B86104A4C4C4C4B4B5BB870A14C268B89896130182121210505057171719E9E9EFDFAF54B4B4B934AA5274E9CA8ACAC5CB56A557979F9952B577474741E3D7A545454B470E1421D1D9DF3E7CFA7A5A5CD9C39B3A8A8E89B6FBE31373747085DBC78F1D2A54B8B172F964824972F5F6632992121219AC67CF7DD777E7E7E414141CDCDCDD7AE5D7BF10E6884505757D7F1E3C73B3A3A56AE5C595959D9DCDCFCF8F1E34F3FFD145F2B168B0B0A0A1042F5F5F5A9A9A94B962C9932658A9595D5C48913C78F1FBF60C182EAEAEAA2A222A552191F1F3F60C0003737B7D3A74FFFD9640500404083F74928146667671F3D7AD4DADADADEDE1E2FBEF1FBEFBF474444F8FBFBE38F17262727878484E4E7E75B58584C9C38514F4FCFDDDD1D2194949474F8F061070707171797CACACAB2B23284D0DCB9730303034924128944DAB871A3AFAF6F5D5D1D7E798B108A8D8D5DB060C1E0C183150A456767E7EDDBB7BB07F4F6EDDB29140A994C56281462B1382727E7C5E747BABABAEEDCB973F0E0411B1B1B6F6F6F4DD5D3170D1B362C242444474707C3B0CECE4EB55A6D6666E6E6E6A652A9E2E2E20C0C0C264F9EACA7A7676868D8E3A1150020A041AFA0542A3B3B3B2D2C2C080482A1A1A181810142A8ADADCDD2D2924C26ABD56A7373F3F6F67684506767A7B6B6B6AEAE2E86610C064328141614148C1A350A2F47A756AB77ECD88110EAD3A70F3E6AC162B15EBC326D6C6C9C356B165E3D4EAD56878686765F5B5C5CBC77EFDE478F1E49A552B1583C61C28417031A7F6E1B9FA545333CA2A9BED47DFA2B030303CDD392C78E1DDBB56BD7AFBFFE6A6363B37AF56A814040A7D3F5F4F4080482ADADED2B962705E003055F127EB07F5A49242323A3D2D252854251575787974566B3D9A5A5A51289442814969595999A9A22840C0D0DB95C6E53539342A1E0703818860D1D3AF4FAF5EB959595D5D5D50F1F3E1C3F7EFC8BFBC78B852A140AFC473B3BBB13274E3C7BF6ACB6B6B6A4A4A44769A4EFBFFF7EFCF8F14545452525255BB76E7D69095032996C68685852522297CB3B3B3BF1A86D6D6D95C96452A9F4CFEE11D4D6D63E74E8D09D3B77FCFDFD7FFBED377CAE2C0E87A350281E3E7C08431C00AEA0416FA4A5A515181878ECD8317F7FFFCACACAD2D252845048484842428242A1502814999999E1E1E108215F5FDF3367CEC4C6C6DADADA3E7EFCF8EBAFBF0E0B0B3B76ECD8B061C30804424545C5D0A1435FDC3F5E96E8D2A54B7E7E7E6C367BE6CC99F1F1F1784DA5BABA3A168BD5BDF29CB5B5755D5D5D4646464B4BCBD5AB575F5A1F83C5620504049C387162D8B0612D2D2D5E5E5EBEBEBE69696962B19848245EBE7CF9A5BFE6C993276D6D6D190C467B7BBB8585055ED82B2626C6C6C626252565F7EEDD9AA25100404083DE82C1604C9B36EDB7DF7EBB7DFB367E8783ADADADA7A7A75C2EBF7DFB3691480C0D0DC5BF827373730B0B0BBB76EDDAAD5BB7020202A8546A5858189D4EBF7BF7AE5AAD1E346890BDBD7D6060A0A64C92AEAEEED8B163DDDCDCBCBCBCD2D3D34D4D4DD96CF6C891238944624A4A8A5028747272FAE4934FBA3766F5EAD5717171D7AE5DB3B0B0080F0F97CBE52626267841D1EE7F51222222121212B2B2B21C1D1DCDCDCDEDEDED0904427676B68E8E4E78787849490942C8D9D959201068DE3561C284C4C4C4F6F676171797CF3FFFDCDCDC7CCA9429D7AE5DCBCCCCF4F2F2EA5E2A0F808F0F941BED5D5EA5DC287875506E147C8834E546610C1A00007A2908680000808006000000010D000010D000000020A0010000021A000000043400000008680000808006000000010D000010D0000000DE39A866D71B454646C2547B6F04148C0610D0E00D2B2E2E864E00004040F72E870E1DDABF7F7FEF6FE7F9F3E7E7CE9DBB75EBD665CB967D006739CC8C0520A0C1BF47A5523F882942F04652A954188A01E0ED812F09010000021A0000000434000040400300008080060000086800000010D000000020A0C1BFE6EBEBEBE9E9F9676BBDBCBC7C7C7CA09700808006EF019FCF2F2A2AA2D3E9A3468D1289440821B158CCE3F1468F1E4DA7D31F3E7CC8E7F3A197007883308490878747515111F405F85B241249A954BEFC4F3D81F067AB0000FF485050506A6A2A87C3812B68F00FF8F9F9BDC62A00C0EB818006FFC0C58B175F63150000021ABC75743A3D2222E2C5E51111110C0603FA07000868F0DE3099CC6FBEF9E6C5E56BD7AE85B27600404083F7CCDCDC7CD5AA55DD97AC5AB58ACD6643CF0000010DDE333D3DBDA0A0A0EE4B468F1EADA7A7073D0300043478FFBCBDBDA3A2A2F0D75BB66C81E75300808006BD058BC5B2B6B6C65F5B5B5BB3582CE81300DE0698F2EACD282828F84FDD08AC52A9F017B366CD9A3367CE7FE4B7BE78F1E2B871E3E06C0710D01F18B55AAD5028F4F4F4CCCDCDA1373E3ECDCDCDADADAD6AB51ABA0240407FA8264E9C78ECD831E8878FCFA64D9B34C3EE00BC3330060D000010D000000020A0010000021A000000043400004040030000808006000000010D000010D0E0FDFAE38F3F5E3A37604D4D8D50287CB39FD5D8D8C8E5725FBAAAA5A5A5B5B5150E070010D01F86BABABAD4D4D4D4D4D4F4F4F4BCBC3C1E8FF7363E253434F4A5B36BAF5EBDFAE1C3876FF6B3F6EEDD7BF5EAD597AE3A79F2646C6C6C2F3C0AC5C5C51D1D1D7036820F023CEAFDEE5CBD7AF5E8D1A31E1E1E08218542E1EBEBBB70E1422291083DF32E6DDFBE7DC18205C3870F87AE0010D0E0FF080909D9B46993542ABD7FFFFED2A54BE7CE9DDBDCDC7CFBF6EDA6A6262693E9EBEBEBE2E28261D8DDBB771F3E7C48A1501C1D1D5B5B5BA74C99525D5D9D9393D3D1D1616161111818A8ABABABD9A75AADAEACACCCC9C9E1F3F92E2E2E62B1182124168B333333CBCBCB190C869F9F9F9393D38B8D292F2FCFCBCBA3D1684D4D4D5E5E5E140AA5B0B01021141C1C8C977C52A954E5E5E5B9B9B99D9D9D3636369F7EFAA99696168FC7BB71E3467D7D3D9BCDE67038EEEEEEF1F1F123468C30323242083537376765654D9E3C59F3294AA5F2EEDDBB4545450402C1D3D3D3DBDBBBFBDFA4DF7EFBCDDCDCBCB4B454A552797979E1A5A52B2A2AEEDEBDCBE3F1ACADAD3FFDF453128974FCF871171797274F9EB8BABA0606066ADE7EE8D021777777BCAF7C7C7CDCDDDDA552E983070F1E3D7A241289D86CF6F8F1E3F97CFED5AB57CDCCCCCACBCBA552E91F7FFC71EEDC39BCFF69341A9FCFCFCCCCACAAAAD2D1D1193E7CB8A68C2A0010D0FF516AB55AA552611826954A7FFDF5573C6D2B2B2BEBEBEB232222DADBDBF1D8A252A9478E1C696F6F1F3C78F0F9F3E75B5B5BFBF4E973FDFA753E9F3F75EA542A95AA1939898F8F6F6D6D353333BB7AF52A8FC753A954C9C9C9292929F6F6F61C0EA7A1A161EAD4A92F36E3C993277BF7EE0D0D0DEDECECCCCDCD35313161B3D94F9F3E6D6D6DDDB8712342A8BABA3A2E2E4E24121918185CBC785128144E9C38312929293B3BDBD1D1F1E1C3878F1F3F1E3D7AF4F1E3C79D9D9DF1806E6C6C3C75EA54F780BE7BF76E7474B4ADADAD42A1888E8EC630CCD7D757B3F6D75F7FB5B0B0F0F4F4140A8567CF9E2512898686867171715D5D5D868686494949028160CC98319B366D9A376F9E8989498FFF706CDBB66DC28409B6B6B61C0EA7B2B2924C263F7FFEFCE1C387743A5DA552A5A5A529140A6767E7AD5BB7464444181A1A92C9640281402693C96432866162B1F8CA952B77EEDCB1B6B62E292961B3D910D00002FABF2BF1FF63EF3EE39ABCFE3FE09FEC412021ECBD04948D20284B0544B40EC481828A93DA81D53AAAADD556EBA8B6AE3AEA4264880AEEC1B46A850A38D87B6FC29011C81EF783EB7FE7CE8DB6BFDA6A45FDBE1FF80AD73C39493E399E5CD7394949E5E5E5381C4E2693AD58B18242A14C9830C1D9D9594D4DADBDBDFD975F7E292B2BCBCCCC747070080B0BC3E170A74E9D4A4E4E2E2D2D6D696959B56AD5881123B2B2B20E1F3E1C1414A408E8E2E2620E87F3F1C71F9B9B9B67666626252549A5D2E8E8E855AB56F9FAFA72389C5F7FFD353F3FFFA5E5313131090B0BA352A9E1E1E1E3C78F5FB870617979F9679F7D8605F4D3A74F0706062222228C8D8DEFDDBB77E0C081C0C0C0AB57AF7EF1C5171E1E1E555555858585FFF3295FBC78D1C5C565E1C28562B1382626E6EAD5ABCA018D101A376EDCF2E5CB0502416C6CEC8D1B37468F1EDDDBDB1B1111616A6A7AFFFEFD83070F060404A8A8A84C9F3EDDCDCD8D44220D39BEBFBFFFD4A9533B3B3BCF9E3D7BFFFE7D5F5F5F1313133333332291989797F7F5D75FEFDDBB574343233838D8C1C1814824E6E4E4CC993307EBE2E07038376FDE8C8888F0F0F0686A6AA252A9F0160510D01FAED1A3472F5EBC188FC7ABAAAA8E183182442251A9D44D9B363536368A44A2FAFA7A1B1B9BDADADAE0E0606C9A126F6FEFE4E4E49E9E1E0A85626D6D4D22913C3C3C366DDA24914814C77CFEFC398D46B3B4B4C4D632180CB95CFEF0E1C39E9E9E03070E482492C6C6461313939796475757D7C4C40487C3D168343B3B3B3A9D6E6E6EDED7D787ADEDECEC545757373333239148E3C78FFFFCF3CFC562717373B3878707954AB5B6B6363737FF9F4FB9BABA7AF9F2E558A9468F1E7DE4C891211B4C9830814EA7D36834070787D3A74F1B1B1B33994C0B0B0B1289E4E3E3F3C5175FC8E57215159597A6334268D2A449542A555F5FDFD8D8B8B2B292CD662726263E78F0A0A7A74722913434342084343535B1741EB2AF5028FCEDB7DF5A5B5B29148A442259BD7AB5919111BC4B0104F407CADCDCDCD7D757F1E7C0C0C0F6EDDB172D5A64636383C7E30F1D3A24954A6934DAE0E020D607826525894492CBE57C3E9F4422F5F5F591C9641C0EA73808894492C9640281804422F5F7F763D7D8191A1AEEDEBD9BCD662B82382323E3C5F2E0F1783C1E8F10C2E17044221187C3291F994C264B2412A1504822917A7B7B69341A1E8FC7FA6DA954AA4020100804D8418442A15C2E97CBE55C2E77C829E8747A7F7F3FD6ABC3E5725F6CA56257B3C864B2C1C1411A8D462291A4522976D2BEBE3E1A8D8615EFA5E98C10EAE9E9515555158BC542A19042A15CBA74A9B1B171D5AA55DADADA3C1E2F3838182BE18BE98C2DB7B6B6FEF1C71F994C26564BF01605C30A5C66F736C964B2B6B6360303036363E38A8A0AEC32381F1F9FB8B8B89A9A9AFAFAFA03070EE07038131393FEFEFE9B376FB6B5B51D3972C4D1D151D1BF8110323333EBEDEDBD73E70ED649D2D1D141201066CE9C79F5EA553535350D0D8DECECEC8282827F503C2B2BAB8686868C8C8CB6B6B67DFBF64D9830814AA58E1E3DFAE8D1A3EDEDEDB76EDD7AF0E00142C8C2C2E2CA952B1D1D1DE5E5E53FFFFCF390834C9C38F1E4C993F5F5F5959595F1F1F1DEDEDE4336D8B76F5F5353537979796262A2B7B7F78811239A9B9BD3D2D2DADADA7EFEF9672F2F2FEC2BE4CFECD8B183C3E1E4E6E66667673B3B3B777777E3F1F8112346A8A9A9C5C7C7BFB8BD8A8A4A5B5B1B8FC74308A9AAAA7A7A7AA6A6A6AAABABB3582C98300540407FB8180CC690F955E974FAA64D9B366EDCE8E5E5959E9E6E6B6BABA2A2B274E9525B5BDBD9B3678786863A38389048246767E7050B169C3F7FDED7D7B7B9B979E3C68D0C06437110171797D9B3679F397366D2A4490402C1DCDC9C44226DDCB8514D4D6DC68C19010101D5D5D56666661A1A1ACAB18E10A2D1688AAB41343434C86432D6A8D4D1D1C1167A7979CD9A35EBD8B163BEBEBE8383835BB76E653018EBD7AFAFADADF5F5F54D4D4DB5B7B7575151D9B061437B7BBBA7A7E7EAD5AB3D3C3C343535B1ECC30AF9F1C71F3B38380405052D5CB8D0CDCD2D3C3C7C48B58C193366F6ECD98B162D727171090B0BF3F0F0983D7BF68913277C7D7D7B7B7BB76CD9422693FFA26D3B72E4C8808080CD9B37FBFAFA4E9D3A75C18205FDFDFD010101B367CFB6B6B6D6D3D32393C958913073E7CEC57ED5ECEBEB6332996BD6AC11080453A64C993E7D7A565616BC4BC1B0E3E8E82807FF4E6E6E2E4268C58A15AFE568EDEDED42A110BBB061D5AA55EF71BD797A7A565555FDE3DDF5F5F5A552E97F50CE6FBFFD162174FDFA7578AB83FFC0E4C99311426D6D6DD0073D1C252525696A6AF2F9FC8C8C8CF9F3E7438500F06182801E8EC68C1973E5CA153E9F3F73E64CECBBF47D356DDAB421DD3EAF64C18205CABF6A0200010DDE383737373737B70FE1996EDAB4E9DFECFED34F3FC1BB05BCC7E047420000808006AF554F4FCF575F7DF5D7DB3C7DFAF4C48913C3A1B41289E4D34F3F85570D0008E80F824020484F4FFFEB6D5A5B5BB1F18FDE848B172F5EB870E16F6E2C954A6FDFBE5D5656F6F5D75FBFD259E6CD9B27168BE1E5061F26E88306FF507373F3ABDED9616666F6D9679FBDD22EB9B9B932990C6A1B400B1A0C7742A1F0C081030E0E0E767676274F9E4408C964B2C78F1F878484585A5A7EF4D1478F1F3F7EE9742A42A1F0C4891363C68C193162C49A356BB0FBE8DADBDB77ECD8616F6F6F6B6BBB75EB56C5042872B9BCAAAA6AD9B2655656567E7E7EA9A9A9581BF6EEDDBB9E9E9E6666664141415F7CF1C5F7DF7FBF7DFB763D3DBD070F1E78787874757561BBA7A7A763BD192291E8C489132E2E2EB6B6B6D8AF79252525EBD7AF47087577771F3A74C8CDCDCDC4C464FAF4E90D0D0D7575754E4E4E5F7FFDB58D8D8DA3A3E3D1A3477B7B7BA74E9DDADCDC6C6262E2EDED2D93C9F2F2F24243432D2D2DA74C99F2C71F7F48A552459166CD9AF5F0E1437887000868F0D65CB870A1A8A8283E3EFEDEBD7BD84872555555D1D1D193264DCACDCD9D3367CE891327381CCE8B3B5EBD7A353B3BFBD8B163D9D9D9FDFDFD7BF6EC41083D7DFA343F3F3F2E2EEEC18307868686D8C01A08A1AEAEAE23478E585B5B3F7AF4283232F2CA952B65656508A1B56BD7AE5BB7AEB0B070F3E6CD1E1E1EDBB66DDBBA756B5B5BDBF8F1E307060614ED5C8944828D497DE3C68DDCDCDC63C78E61032E631D1DD877434A4A0AB641494989BFBFFF962D5B64321987C3D1D7D7CFCCCC3C72E4C883070FF2F3F3EFDCB9636868D8D0D0F0F0E1C3FAFAFA3367CE787B7BE7E4E48485859D3D7BB6B9B979EDDAB5EBD7AF2F2C2CFCEAABAF5A5B5BE11D0220A0C15BF3F8F1E3A953A78E1C39524B4B0BBB40ADB5B5B5A5A5C5D0D0B0A2A2C2C8C8A8BCBC7C6060E0C51DF3F3F3C78F1FEFE0E0A0A9A9B969D3A6D4D454841093C96430184F9F3EADA8A8F8E8A38FF4F4F4B08DFBFAFAF2F2F2ECECECAAAAAA984C6647474747470742C8C6C6A6B2B2323B3B9BC9644E9B36ED7F96B6A0A0C0C3C3C3C9C9495353F39B6FBE515E3577EEDC59B366B5B6B61617173B393965676723844C4D4D972D5BC666B3C78D1BC76432878CBBC4E170EAEAEA4C4D4D2B2B2BF5F4F46A6A6AFAFAFA468D1A555151919D9DCD62B1FE4E910078B7401FF43BD6C541A552B141EBB101D82412497171F1B163C78844A25C2ED7D2D2A2D3E92FEE28128928140A36A29B9A9A1AD68C7572725AB060416A6A6A4A4A8A9191D1975F7EA99848A5B6B6F6D75F7FC546D14308A9ABAB238476EFDE1D1717171D1D4D2010B051E214B011AEB1EE11C550A842A1904C262B4E3AE40BE3D2A54B4D4D4D229148229160DD230402012B3C9148C4E3F1433AB82512495959D9F1E3C7B1678A7DBBECD9B347B948414141F0260110D0E0ED3033332B2E2E767575653299C9C9C958740606062E5EBCD8D1D1512C1697949460613A043656726B6BABA6A6667272B29D9D1D4288C7E3E9E9E9EDDCB9B3BABA7AE3C68D1C0E070B681A8DE6EFEFBF64C912777777B95C8EB5CD1142CDCDCD919191381CEEE4C993E9E9E99696963C1E4F241291C964369B5D5050A0A1A1D1DDDDFDF8F163C5496B6B6B5B5A5AB4B4B4EEDCB9A35C9EACAC2C9148B46BD72E2D2D2D6C20BA3F7BCA6432B9BFBF5F4B4B8BC9640604048487873B3B3B4B2492D2D2522D2DADFCFCFCC8C84884D0A953A7D2D3D321A0010434786B3EFAE8A3B367CFFEFCF3CF2A2A2AF5F5F508217373735757D78B172F62792D97CBCDCDCD55545486ECE8EFEF1F131373E8D0211A8D5657571711118110EAEEEEBE7AF52A4288CFE79B9B9B2B925D434363DAB469D7AE5DBB7FFF3E0E8793CBE5D87C518F1F3FBE7BF7AE4C26EBEDED75717161B158376FDEDCBE7DFBB265CB424242E2E3E3FFF8E30F3C1E5F5A5AAAAAAA8A10F2F5F53D77EEDCC18307D5D4D486F48C5B58589495959D3A758A42A108048297FEB089F1F4F4DCB3678FB9B979585898A7A7676262626A6A2A562A2323A3DCDC5CE522C13B04404083B7C6DEDE3E3C3CBCB0B0502E974F9D3AB5A1A181CD664F9F3EDDC0C0A0A9A9894C26DBDADA625D1F8AEDB1BE051B1B9B458B161516160A04023F3F3F6C50662323A3808080CACA4A0281E0E0E080359F1142743A7DF2E4C99A9A9A7575750402C1DADA1A5B151C1CFCE8D1A3C1C1410F0F8F3163C64824121289D4DADA4A2693434242F4F4F4381C8E868686AFAF2FD6CB3172E4C8458B16E5E7E74B24928F3EFAC8D3D3D3D4D474D5AA5508211F1F1FEC3B864824DAD9D961BDEAEBD6AD53943C3434149B0566DDBA753939392A2A2A2C160BEB286F6C6C249148B6B6B66C367BF6ECD958913C3D3D5D5D5DE11D02DE4330DCE8701B6E140C3730DC28782BC38DC2551C0000304C4140030000043400000008680000808006000000010D000010D000000020A001000040400300000434000000086800008080060000F09F83D1EC5EA7A8A8A8989818A887F7CF5F0C880A0004F47047A552478D1AF5E13CDFBEBEBED6D6566D6D6D0D0D8D0FE75963E35C030001FD8EB1B7B72F2D2DFD709E6F5C5CDCA2458B366CD880CDD20D007813A00F1A000020A00100004040030000043400000008680000808006000000010D000000021AFC6B464646DADADA9D9D9DBDBDBDCACB7B7B7B3B3B3B7574740C0D0DA196008080066F81B5B575575797B6B6F69429539A9B9B11426D6D6D45454553A74ED5D6D6EEE8E8B0B6B6865A02E035C221841C1D1DF3F3F3A12EC0FF442412FF6C540A3C1E0F035600F05A040606A6A6A6B6B5B5410B1ABC823973E6FC835500807F06021ABC825F7EF9E51FAC0200404083378EC160AC5BB7EEC5E5EBD6AD633018503F00404083B78646A32D59B2E4C5E5E1E1E1743A1DEA07000868F036999A9AFEF8E38FCA4BF6ECD963666606350300043478CB180CC6E8D1A395978C1E3D1AFA3700808006C3828F8FCFB163C7B0C7478F1E1D3F7E3CD409006F02CCA8025E19994CD6D1D15153534308E9E8E890C964A8130020A0DF888A8A0A1E8F07F5F04ACCCCCC962F5F2E97CBCDCDCDF3F2F2A042FE3E128964676707F50020A0FF96B0B0B0A74F9F423DFC33070F1E844A7825060606D88DF2004040FF5DE1E1E1381C0EEA01BC51172E5C804A0010D0AFECF4E9D34422D40678B36EDFBE0D9500FE3EB88A03000020A00100004040030000043400000008680000808006000000010D000000021A000020A0C1FB273535B5ABABEBC5E5393939D5D5D5AFEB2C1C0E272323E3A5AB7A7B7BE1160F00010DDE0D72B9FC2F06C1904AA5870F1F7EE9AA63C78E8944A2573DDDE1C3871B1B1B5F5C9E9494F4E8D123E525EDEDED274E9C686868502C696969397CF8B04020F89F67A9AEAE3E7EFCF84B57B5B7B7FFF4D34FF0BA030868F06ED8BB77EF5FAC6532992F5DAEA6A6F646871C696B6BDBB163477A7ABA5C2EC7965CBF7EFDFBEFBFE7F3F9F09201F0AA60F489775B5E5E5E5252929E9EDE93274F545454424343DDDCDC70385C7676767878B85C2EAFA8A8B874E9525D5D9DBBBBFBBC79F3727272E6CC99432291E472797575757C7C7C6D6D0C62D7770000200049444154AD85854558589885858522BBE572796565656C6C6C7373B3ABAB2B87C34108C964B2D8D8D8070F1E50289469D3A6050404FC59A9DADBDBEBEBEBCDCCCCEAEAEA1A1B1B25120976CCB6B6B6E8E8E8F2F2722323A39090103B3B3B994C76E1C285F4F474168BA5AFAF8FED7EF1E2450D0D0D7F7F7FECCF952B572A66AA95C964393939972F5FEEE8E87074745CB162C59F7D1501002D68F09671389CA4A4248140101A1A6A626272EAD4A98E8E0E994C76E7CE1D84506363637C7CBC5C2E0F0909E1F178FDFDFD29292962B118CBD0D8D858B1583C7FFE7C3E9F1F1B1BDBD1D1A1386C6B6B6B7C7C3C4228242484C3E1B4B6B6621D1A696969B367CFF6F0F0484D4DCDCACA7A69918C8C8C343434EEDFBF8F10BA76ED9AADAD2D8BC542080D0C0C9C3D7BB6A3A363FEFCF9542A353E3EBEAEAEEEC68D1B77EEDC090E0EF6F2F24A4F4FC78E505252525B5BAB38E0AD5BB7148F8B8A8A2E5EBC686868387FFEFCD2D2D2D3A74F2B9AEA00400B1A0C3BB6B6B68B162DD2D4D47475759D3B77EEC0C080969616B6AAB6B6B6A3A363F3E6CD464646E3C68D539E78BBBDBDBDA6A666FBF6EDA6A6A69696965BB76EE570383A3A3A8A806E6868D8B66D9B8989898585C5DDBB771142274F9EDCB163C7983163F87C3E97CB1DD2FBACDCBB626666F6C71F7F646464D4D7D7FBF8F860E7E572B9999999FBF7EFB7B2B2B2B5B5FDF1C71F6B6A6A2E5FBE1C12123265CA14B158DCDDDDADC8E83F535050A0A2A2327FFE7C2D2D2D7D7DFD4F3EF964EDDAB5304E2C80163418A6984CA68E8E0E814060B3D972B95C269329560D0E0ECAE5724343430281C0643249249262954020100A852626260402C1CCCC4C28142AFF8EC7E7F3452211B6D6DCDC1CEB46A8A9A999356B96898989B5B5F5D6AD5B0706065EFE96C2E3EDEDED6532D9B7DF7E6B6868686A6A8A2D9748247D7D7D9696960402C1D0D0108FC70F0E0EB6B4B4585B5B93C9643A9D3E72E4C8178F36A481DCD7D7C76030B4B5B50904828D8D4D5B5B1BBC010004347827A9A8A8E0F1F8969616A954DADFDF8FF5056328140A8542696C6C944AA5F5F5F564329942A128D652A9543299DCD4D484ADEDEFEF4708999999A5A5A5353434343737D7D7D76FDEBCF9CFCE6B6060606F6FAFA6A63666CC180D0D8DFFFBCF1A91C864326B6A6AA452694B4B8B4C26A3D3E9FAFAFA55555562B198CFE7575656625B92C9E4C1C1413E9F2F954A6B6B6B95335A4D4D6D7070B0B3B3532A95969595299AFC0040170778C7989B9B6B6A6A4647478F1B37AEA4A464D6AC598A55BABABA6666665151515E5E5E0F1E3C1831628472D8191818181B1B474545797A7A666565D5D7D723843EF9E49303070ECC9D3B974AA5969595E9E9E9FDC5A94342424242429497A8AAAA7A7878FCFAEBAF93274F7EFAF4A98A8A8A85854570703036C98848244A4C4CC426A2B5B2B2CAC8C8B876ED9A8686C6AD5BB794BF571C1C1C9E3D7B76E1C2056B6BEBC4C4C4D9B36743FF06808006C3CE94295310423A3A3A2E2E2E8A855E5E5EAAAAAA783C7EF2E4C908216363E3B0B0B00B172EC4C5C58D1B374E4D4D2D2020009B38464F4F6FD1A245717171B1B1B11616168B162D520E687D7DFDD0D0D0989898B8B8B83163C6040707B358AC3973E6C864B22B57AE0885426767676767672E976B6C6C3CA4BFC5C3C3634851274D9A442291545454962E5D7AF6ECD9D8D8584343C3B0B0307373735353D3C1C1C10B172EA8ABABCF9B37AFA7A707DB7E60602039399944224D9B36ADBFBF5F5555D5CBCB0B0BE879F3E6252525E5E6E63A3A3A464444404083F7180E21E4E8E8989F9FFFC15681ABABEBD3A74FC562314C7905DE346D6D6D32990C93C682BF161818989A9ADAD6D6067DD00000304C4140030000043400000008680000808006EFBF8D1B3762F76DFF35373737A82B0020A05F4D4848089D4E2F2E2EC6EEB6F88FF178BCB163C7BEAEA34546463E78F0E06F6E9C9797171E1EFEEF4FDAD5D5C5E3F1FEE7664D4D4D6FA80E1D1C1CFEE5115253533FFEF863F8B48377CEFB7F6199A6A6A65C2EB7B7B75755557DF2E4098D463332327ABDA7904AA55D5D5D5C2E974824B2D96C555555C5C5B9542A3521210121343030D0D3D34324120707070904829696968A8A8AE2A6381A8DC666B369341A42A8AFAFAFA7A7472291686A6AD268B4D6D6563A9DCEE572353434BEF9E61BEC568E9A9A1A168BD5DBDB8BC7E3D96C363688687F7FFFF3E7CF2512099BCD66B3D9A3468DDAB56B1742482E9773B95C6C958A8A8A8E8E8E542A6D6E6E663018FDFDFD381C4E5D5D9DC964E2F1FFDFB7B55028ECECEC140804743A5D79FCE8CECE4EC52E2C16EBC56B90E572398FC7EBEEEE160A8524124953535345454520107476760A85420A85A2A9A9A93C24884422E9EAEAC2EE1A575353D3D4D4944AA5BDBDBDD8B7298BC5525757BF7AF52AB6319FCFEFECEC1489440C06432010E8E9E9512894EAEA6A7575F5DEDE5E841093C954575747083D7FFEBCBFBF5F269331180C2693D9D4D4D4D5D5555959A9A5A5A5AEAEDED4D4A4A3A343269311420281E0F9F3E72A2A2A5C2E1787C3F1783C4343431289D4D1D1C1E3F170381C93C964B3D91289A4A7A787CBE5E2F178757575EC2C004040FF5B478F1E7DF6EC5976763697CBB5B6B67674743C7CF8B08181818585C56B39BE5C2E2F2929F9E5975F1A1A1AC864726060E082050B14F737F3F97C7F7FFF9A9A9AF4F4F4BD7BF7BAB8B85456564AA5D2E0E0E0254B969C3A752A3D3D5D2412999A9A8685854D9C38B1A3A3E3ECD9B359595942A130303070D2A4493367CE9C3E7D7A7979F992254BEEDCB9B368D1A2499326797A7A2E5EBCB8B0B01087C3F9FAFA2E5DBA142114171777EFDE3D8140E0E3E3F3CD37DF141616FEF0C30F376EDC78FEFC797C7C7C7A7A3A9FCFD7D1D1D9BC79338D46F3F3F39B376F5E51519150289C3061C28A152B14A37D8A44A2070F1E9C3871A2BFBFDFC4C4A4B8B858D146DEB3674F7575351E8FF7F2F25AB66CD98B3713F6F7F75FBE7CF9B7DF7E6B6B6BA352A973E6CC993D7BF6B56BD72E5FBECCE572F5F5F5E7CE9D3B73E64CC5F639393957AE5C292E2E9648243636369191917C3EFFF4E9D3E5E5E56432D9CDCD6DEDDAB55E5E5E6D6D6D3C1E2F393939363696C7E3595858A4A7A75FBA7469F4E8D12E2E2E6BD6AC79F2E4099FCF7776768E8888E0F17857AE5CC9CBCB1B1C1C3432329A3973E6A143873A3B3B57AE5C1919193967CE9CC58B171F3F7E1C1BFAA3B0B070E7CE9D1F7DF4D1F9F3E7478C18515F5F7FF0E0410E8773E5CA15ECD6735757D7888888F6F6F6B367CFD6D6D652A9544F4FCF8D1B37120804880F005D1CAF81AFAFAF8A8A0AF6B8A0A060FCF8F1919191898989757575AFA5F97CF8F0615B5BDB4B972E6DDFBEBDAAAA2A3B3BFBA55BE270B859B3665DB97265DBB66D972F5FEEEDED3D71E2444444C4E5CB973FFFFC73AC4177FDFAF5B6B6B63D7BF65CB972054B4C3C1EEFE3E373EDDAB5F9F3E72B1F8DCD665FBC7871F7EEDD4D4D4DE9E9E9292929B5B5B5DF7FFFFDE5CB97478C18A1BCE5FDFBF72B2B2BB76EDD7AF9F265474747C5D424AEAEAE172F5EDCBF7F7F797979595999729F464242C2AC59B392929266CC98A1180AE3C08103DADADA172E5C387CF83097CB4D494979F1390E0C0CF4F6F6EEDAB5EBF6EDDB9B376FCECCCCACABAB3B75EAD48C1933AE5EBDBA75EB56E5113F1042CF9E3D9B3D7BF6F5EBD71312120C0C0C121212F2F2F2B85CEEFEFDFB636363478D1AA568A4D7D7D7A7A4A42C5DBA34292969E2C489CA8D772323A3F3E7CF9F3C795224126566669696967A7B7B272424DCBE7DDBCDCD2D232363EFDEBD53A74E7DF0E0C19C3973FEEC75241008CB962D4B4E4EB6B3B3CBC9C9898888B875EBD6E9D3A72914CAAD5BB71E3E7C48A1508E1D3B76EEDC39030303080EF041B7A0B18C785D47D3D5D5A552A98383838A25C9C9C9C9C9C9A1A1A163C78E551E07F99FB5A0EFDEBD6B62621217172712896A6A6A5A5A5A5EBAA59D9D9D8F8F0F8944F2F0F0E0F3F962B1382020202727A7A1A1C1D2D2D2DDDD1D21545454E4E5E56569694922914242428A8B8B0D0D0D030303A954EA90A36163D5DBD8D8D8D8D85455550985422727271B1B1B32993C64108CBABA3A0B0B0B0707070A85B26CD9324F4F4F84909E9EDECC993329148ABDBD3D83C150AE9CC1C1C1D6D6D6193366A8A9A9F9FAFA2A5E88F4F4F4E0E0E0F8F8788944D2D4D4F4D21B2FB5B5B5A74C99F2F0E1C3BEBE3E9148545A5ADADFDFEFE7E757515171E6CC193333B32137828786866667679F3B774E2814B6B7B77775754D9830212F2FEFDAB56BBABABAEEEEEE58B70F42A8A7A787CFE7FBF9F931188CC0C0C093274F62CB69345A5858188D46535555353232EAEDED5DBE7CF993274F2E5EBCC8E7F3BBBBBB8B8B8B67CC98F13F5F475757575757576CC0BF952B573E7CF8F08F3FFE108BC5CDCDCD5C2E77FCF8F1ADADAD898989BABABA9E9E9ECADD41007C7001DDDCDCBC7AF5EA377D96F3E7CF9F3F7FFEB534A285422197CB95CBE51E1E1ECA8363FCFFEA9A48C43EFF4422116B966EDCB8F1F7DF7FAFAFAFBF7DFB765F5FDF82050BE472390E87536E1E120804E54E5B45635C9111381C4E2E97BFB8A3F257886239B631D630C71AB3040241B170C829B07F15FBCA64329148843D4D5B5B5BEC1B65080E8773E2C4093A9D4EA7D3A5522997CB954AA59F7DF6D9C3870FABABAB7FFBEDB7E6E6E6C8C848C5F6D8A42D6A6A6A783CBEAFAF4F2010B8BABA522894828282DADADAC78F1FEFDEBD5BF12C944BA55C4E2CC4F1783C1E8F97CBE5376FDECCCFCF5755552591487D7D7D2FFEC289C3E11493BC280659A55028D87F621042C78F1FE772B958777F7F7F3F954A9D3871228BC52A2929A9A8A8C8CECE3E7EFC380C0C003EF43E680F0F8F65CB96BD96436DDAB4E9A5F352FF7B381CCEDFDFDFD4D474CE9C394422F1C993272FB676FFCC6FBFFD16181888C3E18E1E3D8A75F5DADADAE6E4E4383838181A1A666464FC5947B95C2E8F898959BE7C794343434545C5E8D1A3A552694141417979B9B9B9797A7A7A5050906263131393CCCCCC9292124B4B4B6CF0A3BF2E159D4ED7D5D54D4949090C0CCCCACAAAA8A8C096FBF9F96969692D59B28446A3151616BE742A939E9E9EC2C2C2DDBB778F1C39322727E7E6CD9B08A17BF7EE8D1D3B362020203A3A3A37375779FBBB77EF4E9B366DC18205DDDDDDBFFCF24B7F7F7F43438350280C0D0D2D2F2FC7BAA4B12D592C16954AFDFDF7DFBDBDBD333232FEE2A291ECEC6C7D7DFD152B56E0F178ACA14D2010B06F0B55555584908E8E4E5656969999594F4F8FE2174865B76FDF5EB76EDDD4A9539B9A9AB009702B2A2AC864F2E2C58BF3F2F256AE5CA93CE836001F68405B5A5A2E5FBEFCB51CEA871F7E7831A057AF5E1D1010B066CD9AEAEAEA7F7C640281101919191D1D9D9A9A8A103237370F0D0DFD9BFBF6F4F47CF1C5173C1E4F474767DEBC7908A11933669C3D7B76CB962D3299CCCBCBEB2F7EC96C696959BA74A9542A757373F3F3F3C3E1701D1D1D3B76EC904AA52E2E2ECA01EDE3E3D3D4D4B473E74EEC2A8E2FBFFCF2AF4BA5A9A93977EEDC73E7CEC5C7C7EBEAEA6253642184D6AC5973ECD8B155AB5649A5522323A3D9B367BFB8AF969696B3B3F30F3FFC4022918C8C8C844221424820107CFBEDB73D3D3D6C365BF9174284507070F0EDDBB76FDDBAC562B1B016BD4422B97DFBF6E1C387E572F9A44993B0662C42C8D4D4D4CFCFEFCC9933A74E9DD2D5D595C9647F368E9DBFBF7F5252D28A152BE8743A76C58E9E9E9E48249A3F7FFEC71F7F3C63C68C254B96444545DDBA754B71E5CC100B172E8C8F8F8F8B8BD3D0D0E0F3F9542A552C165FBA7469EFDEBD381C6EC18205F00B21F86F0CD3D1ECF2F3F39D9D9DC3C3C3A3A3A3FFFDD1962E5D9A909080850526242464FDFAF5A6A6A6D84C51FF72343BA954DADADAFAFCF973B95CAEAEAEAEABABABF8294C2693959494D8DBDBF7F4F460174560CBCBCACA2C2C2CB85C6E6B6BAB442261B1587A7A7A542A552E9777757571381C8944A2AFAFAFAAAADAD4D464656585ED555757A7A1A1A1A6A6A6ABABFBECD9B38E8E0E0281A0ABABABA9A98910EAEEEEE6703862B1585757575757777070B0ADAD6DC4881172B9FCF9F3E76D6D6D62B198C9649A9898482492BABA3AC50C260D0D0D4C26139B3910C3E7F31B1B1B793C9E9A9A9A4824D2D7D7C72655696D6DEDECEC94C9644C2653575757B9EFA5A0A0C0D1D1512A9576767672381C994CC662B1F87CBE9191914C266B6969110804AAAAAA060606CA7B71B9DCE6E6661E8F47A552B173191A1AB6B7B7F7F4F4E0F1783D3D3D0D0D8DA2A222474747B95C3E3030D0DCDC2C10082412C9F6EDDB77EFDE6D6767879D173B5A7B7B3B42484D4DADA5A505BBEA514B4BABA7A7C7C2C2A2A5A5A5A7A7C7D0D050474747281436363672B95C0A85C2643205020193C9148BC58AEB58FAFBFB1B1B1B8542A18A8A0A954AC5E3F15A5A5A6D6D6D7D7D7D4422D1C0C080CD66FFB3B70A8C6607FE0EC56876080B68F9309397978710C2E6A5FEF7946F157177776F6A6AEAE9E951ACC5BA8CC562B1FCDDA1ABAB2BFFF01417175FBF7EBDBBBBFBE0C1832B56AC686C6C7CE79E829696968181811C80BF848DE7DED6D6F6FEFFD03167CE9C9C9C1C168BC562B12A2B2B7138DC7BF0F3CE8779A304954A4D4E4E5EBF7EBDB5B5F5B7DF7EAB68F002007DD0EF2A7D7DFD51A346A5A5A5BD4F97AF9696967E806F560B0B8BE3C78FC387164040BF3F0E1F3E0C2F3300E05D04D7DBBF4D62B1F8D6AD5BFFE5196FDEBCA93C07EB1BF5ECD933EC1AB5FFA648F5F5F5D84F1700404083D780C7E3AD5FBFFEBF3CE3975F7EC9E572A3A2A25E69AF6BD7AEFD83FB2D6362621E3D7AF4778AA4B85BE4DFC8CCCC7C2DB71D0100010DDE1AB95CFEAA2DD653A74EC1956100FCF7E076D57F9574696969292929229168C284093367CE7CF4E8D1D3A74F4924524949098BC55AB870A18D8D8DE29E6C6CDCBB1B376E3436368E183162C992252FBD9E041BDC23252585C7E3797B7BBBBABAE6E6E6FAFAFAEAE9E9B5B6B6DEBD7B77CA94291A1A1A9F7CF2C9840913323333994CE68C1933C68C1983DDE83CA4484422111BDAA2A7A7C7C3C383C7E3C9E572ECC61CB95C5E535373EDDAB59A9A1A6363E3850B171A1A1AF2F9FCCD9B377B7B7BFFFEFBEF381CCECFCFAFBEBEBEA0A060DBB66D1A1A1A515151FDFDFD898989797979D85D27A3478F56BE6B83C3E1C4C5C55557575B5B5BD7D7D7631738CA64B2EBD7AFDFBD7B974824FAFBFB4F9E3C19BBE57DC8B36E6B6B4B4848A8AEAE363030080E0E1E3972646D6DEDC58B17EBEBEB0D0C0C66CD9AA5B8DE1921D4D7D777FDFAF5DCDC5C8944E2EEEEAE3CFCC8C993273D3D3D6D6D6D1142BDBDBD070E1CF8FEFBEF1F3E7C98999989C7E39B9B9BA74E9D8AC3E1525252545454962F5F6E6E6E7EFFFEFD67CF9E0D79E17A7B7BE3E2E2CACACAB4B5B567CE9CE9E4E4D4D8D878F9F2E58A8A0A369B3D7BF6ECFF794F2600D0827E6BEEDEBD7BE1C2055757576F6FEFDF7EFB2D2525A5AAAAEAFCF9F332996CCA94294422F1C08103CA83295757575FB870018FC7070606B6B4B444454549A5D2170FFBE0C1830B172ED8DBDB4F9C38F1FEFDFB1919192D2D2D29292952A9F4EAD5AB0281001B32222626262B2BCBD7D797C96426262662D775BC58A4CACACA4B972ED168345F5FDF9C9C1C2E972B168BAF5CB982106A6E6EBE70E1C2C0C0404040405F5F5F6C6C2C97CB15894431313179797913274EB4B4B4BC75EB168944D2D7D7C78651158944090909F9F9F97E7E7E2C16EBEAD5ABD8989C8A1E9BB8B8B8DADA5A7F7F7F3E9F5F5E5E8E2DBF73E7CEE5CB97C78F1FEFE4E4949696F6FBEFBFBFF8ACB95C6E6C6C6C5353939F9F9F50283C7FFE7C5353D3810307C462F18C19332C2C2CFEF8E38F218DFADEDEDEC99327FBFAFA3E7EFC58F98EED870F1FFEDF15FE08F1783CAC97BFBABAFADAB56B2C16CBD4D4F4975F7EB97DFBF68409138442E1E9D3A7114295959509090972B91C7BE1F6EFDFCFE3F1CE9D3B575252E2EFEF4FA1502E5CB850515171FAF4E9EEEEEEA953A73A3939DDBB770F3E02005AD0C3576262624040405050100E8723914877EEDC7175751D3D7A34361EB49B9BDBA44993943B13F2F3F3A552696868A88181818D8DCDB265CB962C59F2E261AF5CB9E2E3E3131C1C4C2693A9546A6262627878785A5ADAF9F3E7391CCE9C3973B00125E8747A7878B893931387C3397EFC787E7EBE9D9D9D72918844627272B2582C96C9648B162DD2D3D3333131B97CF9B2E244555555EDEDED6BD7AE3531317174745CBD7A757878B88A8A0A8BC55ABA74A9A9A9E9E0E0E0F7DF7FAFAAAAAAA5A5356EDCB8D1A347F7F4F4DCBA756BC78E1D0E0E0EDDDDDDFBF6EDABACAC1C356A1476C0C1C1C18C8C8C1F7FFCD1C6C6A6A9A9E9E9D3A7D8F2B367CF2E5FBE7CD2A44942A1502291DCBF7FDFCFCF6FC8B3EEEBEBCBCACADAB973E7A851A39C9D9DF7EEDD5B5B5BDBD8D8686262E2EAEACA62B1B85CAEF2F6F3E7CFA7D3E94C26532693B1D9EC989898808080BF7EBD1C1D1DE7CC9983C7E3AF5EBD1A1818181010606464A4F80DC0C5C565FEFCF9D80B877DC15CBF7E7DFFFEFD0E0E0EADADAD870F1F2E2929696D6D353434747070D0D7D7EFE9E9818F0080801EBEEAEBEB57AF5EBD61C3066C50346F6F6F8490B6B6B69696160E87D3D5D5158944CA230AF5F4F41C3F7EFCDCB973381C4E2A953E7FFEFCA563EE3436362624247CFDF5D772B95C2814BAB8B88C183122393979DFBE7D2B56AC303333C3069F2391488E8E8E442251575797C160607951575777F5EA55E522F5F6F652A9547D7D7D0281606F6FAF3C90537F7F7F4C4CCC952B57B0F2F4F6F6625F27140AC5C2C2029B4C041B8642B18B542ABD77EFDE471F7D840D3F343030E0ECECAC588B4D8F6263634324128D8D8D15C3F95757572F5DBA944422C964323E9F3F6434548C582CEEEDED1D356A149148343131C1E1708383835BB66CF9F5D75FFDFCFCCCCDCDBFFBEE3B6D6D6DC5F67C3EFF871F7EB87FFF7E5F5F9F4422F9B3110495696868B0D96CECABCBDCDC1C9BF045311893969696E285130A853299ACBDBDDDDEDE1EBBB79B46A3F5F5F5AD5EBDFAE4C9933367CED4D0D0D8B973E78BF31500005D1CC385AEAE6E7C7C7C6D6D6D7373736B6B6B7C7C3C521A9FF3C5A17C545555D7AC59535454D4D4D4D4DCDCDCD5D5F5D271EFB4B5B5CF9E3D5B5D5DDDDCDCDCD2D2929494545A5A2A1008D6AE5DDBD8D8585B5B8B85BE4422A9A9A991C964D840C958B35A575717EB64501489C16088C5E2EEEE6E994C565757A7DCE542A7D3972D5B969F9F8F95A7B3B3131B5AE8C5614BB10447086173A9646767373434343737B7B7B7CF9D3B57B119814060B1580D0D0D3299ACA3A3E3F9F3E7D872030383DBB76F63BBB4B5B51D3870E0C5674D20105455551B1B1B65321987C391CBE5542AD5D6D6F6C48913797979B366CD528C3B8AD9BE7DBB95951536586B4242827267118944E272B91289442A952A0F7AA7FCD2289EA0E21B74C80B87C3E1343434EAEAEA6432193683978A8A8AA5A5E58103070A0A0A222323376FDE0C1F01002DE8E16BDEBC790909092291485757B7A2A2A2B7B777C8742143383939151616C6C7C7BBBBBBF7F5F5DDB97367CB962D2F6E367BF6ECC4C4448944626464545959595050A0A2A2326AD4A8C58B17EFDFBF3F3737D7DCDC1C1B62FFE8D1A3212121454545CF9F3FC746890B09095114A9BCBCBCAFAFCFC7C7E7D1A347172F5E747272BA7CF9B2F27FCCADACACB2B2B2CE9E3DEBE3E3C3E3F1D2D3D3376CD8F0D271DAF4F4F49E3E7D4A2010468D1A3575EAD483070FCE9A350B87C33D7AF4C8C7C74731D4099D4EF7F2F23A72E4487070F0D3A74F1F3F7E3C7DFA7484D0B265CB0E1D3AB464C9125555D5A2A2220A85B270E1C221A7603299A3478F3E7EFCF8F4E9D3B3B2B2180C86A9A9E99123472C2D2D8D8C8C7A7A7A14B38861D4D4D40607076B6A6ABABBBB875C35E8E0E0909E9ECE6030C864F2B163C7FED98B4B2291264F9E7CE8D0A1909090BCBC3C3E9F6F636373EEDC39168B656969C9E170B4B4B4E0230020A0872FEC6280A4A4A4AEAE2E3B3BBBD0D0D0A6A626E5EB13BCBCBC94AFD3183972646868E8C58B17F7ECD9C362B1E6CE9D4BA150B0F94D94617DA9494949EDEDEDA3468D7277776F6E6E9E32650A8140983F7FFED5AB57070707190C06954AB5B7B73F74E890BABA7A6868287685C38B45B2B1B19933674E6C6CEC83070FFCFCFC02030329148A97971742C8D4D474E1C285090909FBF6ED6330184141412A2A2A128944B948969696FAFAFA0B172E8C8E8EBE76EDDA9D3B77962C5912171777F4E85184D0C48913CDCCCC141BABA8A8AC58B1E2E8D1A358D7EDF4E9D3757575B1AF1C84505454148FC77376761E3277979797178140C0F63D71E2C4FEFDFB4D4D4DC3C3C3CDCDCD030202CE9D3B575353636363B36EDD3AE5BD3EFFFCF33367CEECDCB953575777DAB4695555557A7A7A587FC582050BA2A3A38F1E3DAAAAAA1A1C1C8CFD26890D5184EDEBEAEA8A4D8146A3D1B06F17434343E5FFCD787B7B53A9D455AB561D3B766CFFFEFDFAFAFA616161B6B6B6783C3E3636362121C1C4C464FBF6EDF011006FDA0731DCE85FFBF7C38DFEF7E472B98181416B6B2BBC83DF2D30DC28F83B14C38D421F3400000C5310D0EFAA6DDBB641250000010D861D1C0EF7F1C71F433D0000010D000000021A0000000434000040400300008080060000086800000010D0000000010D000000021A0000C0FF04A3D9FD9FD0D050C5E48100BC21FDFDFD9A9A9A500F0002FAD52426264225000020A08797A4A424A15008F5F04A6EDCB8B171E3C60D1B362C5FBE1C6AE3D53E7244F8D00108E8BFCDD4D4142AE15561D3F1696B6B5B5B5B436D00F08640AF2B000040400300008080060000086800000010D0000000010D000000021ABC4B56AE5CB974E9D23F5BBB6CD9B2952B57422D01F01AC175D0E0EF4A4E4EEEE8E8A8AAAA727575757575552C5FBB76EDE3C78F737373B5B4B4A096008080066F416666A68585455656D6B367CF2E5CB88010DAB367CFAFBFFEDAD6D6C6E3F1F0787C565616D4120010D0E02D303535653018FDFDFD7C3E9FCFE72384BABBBBBBBBBBB1B52A2A2A704F2600AF17F4418357505D5DFD0F56010020A0C11B4722919C9D9D5F5CEEECEC4C2291A07E008080066F0D8BC58A89897971F9B973E7D4D5D5A17E008080066F139BCD9E316386F292E9D3A76B686840CD0000010DDE327D7DFDC8C848E525919191FAFAFA503300404083B76FD4A851CB962DC31E2F5BB66CD4A85150270040408361C1C0C060E2C489D8E3091326181A1A429D00F026C075D0E09F080C2B664FBA00002000494441540C5CBD7AB55C2E9F32650AD4060010D0EF245B5BDBC1C1C1F7F2A9F5F7F723846EDCB8F15E3EBBD2D2523A9D0E6F600001FD3E6B6A6A1A1C1C5453537B5F9F605F5FDF7BF68C0606062412894C2683772F80807EFF999A9AD6D4D4403DBC2BBCBCBC605011304CC08F84000000010D000000021A000020A001000040400300000434000000086800000010D000000001FDE1E8EBEB934AA5EFF4531008043C1E0F21D4DFDF2F91485E695FC5CC847F81CBE58AC5E27F5F4EA954FAFEDDB2080004F41BF4E5975F666464949494FC9B830885C2E2E2E2E2E2E2B2B2B2DADADADEDEDEFFF226E3A8A8A89F7EFA0921B478F1E2A74F9FBED2BEC78E1D3B7AF4E85F6F131111F15AEECAABAAAA0A0A0A82B71CF8D0C0ADDEFFDC9933676C6C6CAAAAAA525252D4D4D4C68C19F30F0E525F5FEFE3E3E3E2E2422693D5D5D5EDEDED67CD9A656161412010A08601808006FFDCF4E9D30F1E3CE8EFEF6F6E6EBE7DFBF6112346B8BBBBBFEA411C1C1CD2D3D30502415555D5E9D3A72F5DBAF4C9279F68686888C5E2BCBCBC8686060A85626B6B6B6666D6D7D7575454D4D6D646A1509C9C9C8C8D8DDBDADA8A8A8AFAFAFA180C86A3A3A3BEBEFE9D3B774C4C4CAAAAAAE874BABDBD7D7171B18A8A4A4B4B8BBBBBFBE0E060454585542AB5B4B4747070C0E35FF2FF279148949B9BDBDADAAAA2A2626B6B6B626282C3E194DBFB393939EDEDED6C369BC3E1686B6BCBE5F2DADADAD2D2521E8F676666367AF4682291F8D2BE8EC78F1F77767692C9646B6B6B2B2B2B2291F8FCF9F3C2C2420E8743A3D11C1D1D4D4C4CB08DE572796363634949C9E0E0A0B5B5B5BDBDBDE23862B1B8B6B6B6A2A282C7E3B1D9ECB163C732188CBABABAE2E262A150A8AFAF6F6767C764328714492A95565656565555C964323333331B1B1B1A8D06EF5E0001FD9EFBF1C71F8944E2AE5DBB6A6B6B172E5CE8EEEE3E6FDE3C5F5F5F2727A7573D14954AB5B7B75FB972E59E3D7B3A3B3B353434323333CF9F3FAFA6A62610080A0B0B434343B3B2B2B2B2B268341A994CAEABAB0B0B0B8B8F8FEFEFEFE7F3F97D7D7D9595956161611B376EF4F7F7575151D1D5D5158BC55BB66C9932658A4C269348244F9E3C914AA5783C3E3D3D3D2222C2D5D5F5C562DCBB772F2E2E4E5353532010E4E5E52D5CB8D0D4D454B1F6B7DF7E8B8F8FD7D2D2C2E3F1393939414141D5D5D53131315C2E178FC76764648487877B7979BD78D89898988E8E0E1E8F373838F8F8F1E3D0D0503B3BBB6BD7AEE5E6E6624FA7B1B1F1F3CF3FC7366E6868387FFE7C6B6B2B954A2D2E2EB6B1B1511CA7A8A828353595CBE50A0482EEEEEEF6F6F659B3661D3C7850229130180C0A85422010343535871489CD66FFFAEBAF381C8E46A3151515696A6A2ABE0C0080807E9F6DDBB66DD7AE5DD8E39C9C9C9C9C1C7F7F7F6767E74F3EF9C4CCCCEC558F3662C4082C7D1042C78F1F0F0A0A9A39732687C3397DFA744E4ECEE3C78F35343456AE5CC966B39F3E7D4A2010ACADAD3D3D3D994C666565E5FEFDFB9B9A9AB026795858188D46BB79F3A68686C6DCB9731D1D1D77EEDCA9A9A9B962C50A2A957AEAD4A9B8B8B89706F4B163C7E6CF9F3F73E6CCBABABAA8A8A8478F1E2907F4F1E3C7172E5C386DDAB4DADADAFAFA7A84D0CD9B374924D2BA75EBB4B5B5131212CE9E3DFBD28066B3D9414141DADADA1D1D1DD1D1D15959597676768F1E3D32303058BE7C3983C1282A2A526CFCFBEFBFF7F5F57DF6D967A6A6A6CF9E3D536EE953A9544F4F4F2727272A95FAF8F1E3AD5BB74E993225333373C78E1D9E9E9E1C0E874AA55EB9724551A4F3E7CF9F3D7B362C2CACB1B1F1ABAFBEB2B3B3ABAEAE56555585F72D80807EE36EDCB8919494F476CBF0E26F7A191919191919858585DADADA58D4FE7D580B177BFCE0C103994C969696269148CACBCBB5B4B4020303D3D3D3B76FDFAEAEAEBE74E9520683C166B37FFEF9670E87231289727272C2C3C3114253A74E55FC17DED4D4D4C1C18148245655558587876B6969E170B8499326AD5FBFFEA505282A2A8A8B8BA3D3E9969696060606ADADADCA6B8B8B8BA74E9D4AA7D3ADACAC9C9D9D1142E5E5E5959595D5D5D5783CFEF9F3E79D9D9D2F3DACABABEBE9D3A79B9A9A8442614D4D4D6060204268DAB469F7EEDDDBBA75ABB6B63656724C535393B1B1F1881123482492A7A7A7F271F4F5F5CBCACAB66DDBD6D3D3837501D168B43973E6DCB871E3E6CD9B6E6E6ED3A74F1F52A4AEAE2E3333336767E7E8E8680A853269D2A4912347C2271F4040BF71454545B1B1B1C3B36CA9A9A9FF60AFD2D252269389CDE5C16432434242582C1642482E975B5959E9E8E858585870389CFCFCFCEDDBB7EFDEBDFBE4C993DEDEDEDEDEDE3299ACB1B111BBEC4FB9839548249248248410994C160A8532998C4020F0783C3299FCD2025028141E8FA7AAAA2A91482412C990CDB0B50C064322910885422A954A2693274C98E0EEEE4E2412E572F99F4D4DF0EDB7DF8E1D3BD6C5C5854020DCBA750BBBA46FD2A4495656561D1D1D4F9E3CD9BD7BB7E2A5241289D8D9B1922B7BF0E0C1FDFBF7DDDDDDB13EFA9494142A951A1111515F5FDFD8D878EFDE3D55555512893471E24477777702818015C9C8C8282222A2A9A9A9BABAFAF2E5CB6666668E8E8EF0E10710D0FF859F7EFA69D2A4496FB100EDEDED93274FFE374790CBE57C3EBFB0B0F0975F7E717575D5D5D54508CD9831A3A0A060F5EAD5140AE5EEDDBB0D0D0D3939397A7A7AAEAEAE0281E0D4A9533C1EAFB9B9D9D9D9D9C2C2223939F9CF5AAF8A36ECF5EBD7ADADAD5555554F9F3EFDD28E0884908F8FCFE1C387D7AD5B575050505151317BF6EC216B8F1E3DBA66CD9A67CF9EA5A7A7CF9933C7C3C3233333535B5BDBDEDEBEACACECFEFDFB63C78E7DF1B0F9F9F94B962CF1F4F4CCCBCBABAAAAD2D0D040085DB972C5DCDCDCCDCDADB7B7F7E2C58B8A8D6D6D6DAF5FBF9E9393E3ECEC9C9090B072E54AC52A0E8723140AC78E1DABA6A6161D1D2D1289783C5E5454D4C2850B757474EEDFBFDFD5D5E5E9E9999999A9A5A5A52892BABA7A5656D6F4E9D3190CC6C58B17DFD749C80004F470646262E2E0E0F0B6CE2E168BFDFCFC862CC4E170D7AF5F7773731B3162C4FF3CC2A3478FF4F5F5E974BA8585C5DCB973838282B04ED28D1B37EEDDBBD7D7D7572291F8FAFA7EF6D9670402E1D0A1434F9E3CD1D6D6DEB56B1736BBF6A2458BA452E984091368341A0E8753BEE842D9C2850BBBBABA8282824422D1CC99333FF9E413AC9C43B6DFB265CB860D1B5C5D5DB5B5B557AE5C3961C204E5B55F7FFDF5975F7EE9E2E2326AD428369B8D100A0E0E168BC5EBD6ADABABAB1B3972646464E49FB5A0376EDCD8D7D7E7E0E080FD9F0021646868B86FDFBEBCBC3C2323A3EFBEFB4EB1B1BFBF7F7777F7962D5B3A3B3B172C58A07C1C6F6FEF274F9E4C9E3C9942A10407071308042291482693A74D9B363838181010E0E7E7676262221289948BC46030AAAAAA264C9880C3E1E6CF9F6F6969099F7CF0CE707474940F3379797908A1F0F0F0BFDEEC871F7E4008252626BEC5A262BFCB61E874BAAEAE6E54549462ADAAAAAAB9B9B91CBC3BB05E6F2E970B5501DE16EC7FE46D6D6D7015C7BF525E5E8E5DF88CFD6E366BD6ACAD5BB742B50000A08BE3ED0B0E0E1E1818080C0CB4B2B23A74E81054080000027A58484D4D9D3871A28787C7E9D3A7A136000010D0C3484343C3B66DDBB4B5B5A12A000010D0C34B444404540200E0CD81E146010000021A0000000434000040400300008080060000086800000010D0000000FE145C07FDC671B9DC3367CE403DBC2B381C0E54028080FE50747676AE58B102EA010000013DBCECDBB74F2412BD7FCFEBC99327313131414141BEBEBEEFE50B47A150E0DD0B20A0DF731F7FFCF17BF9BCE2E2E26262623C3D3DFF6C847E00C0BF073F12020000043400000008680000808006000000010D000010D000BC544A4A4A7272F29FAD4D4E4E4E4949815A02E03582CBECC0DFB562C58ABEBEBE9F7EFAC9C0C04079F9EDDBB79B9B9B376CD8A0AAAADAD2D2021505000434F8AFAD5DBB76C3860DAB56AD3237377772724208A5A7A70F0E0EC6C6C6D6D4D4E070B86DDBB6412D0100010DDE8275EBD67DF5D55752A9B4B6B6B6B6B6162194969696969686ADC5E170EBD6AD835A02E035823E68F00AA2A2A2FEC12A0000043478E3A64C99F20F56010020A0C11BC766B35F7A21C79D3B77343434A07E008080066F0D8140303636A6D3E9CA0BE974BAB1B131814080FA0100021ABC4D363636D7AF5F575E72EDDA355B5B5BA8190020A0C1DBC762B1ACADADB1C7D6D6D62C160BEA04000868302CB8BABA6ED9B2057BFCCD37DF8C193306EA04803701AE8306FF84B5B5B5A7A727F6006A03000868F07F8E1C39321C2636A5D16872B9FCE6CD9B376FDE7C8BC5505151D9B46913BC2B00043418164E9D3A555858384C0A73F7EEDDB75B002D2D2D086800010D86111C0E37E4528A0FD392254BA0120004341876A64F9F0E9540A552C56231D403785FC1551C000000010D000000021A000020A001000040400300000434000000086800000010D0000000010DDE69A1A1A15009000C137027E17B482C16BBBBBB2B2FD9B469D3BC79F3FECEBEF7EEDDFB9767CFCACA4A4F4FFFEEBBEFE0850000021A0C2597CB3B3A3A1E3F7EAC58A2A6A6F69F9DDDD5D515265801E0B5802E8EF7138140D0FB7F1189C46FBEF9E6D6AD5B32990C21D4DBDBEBE3E3535F5FDFDBDB1B1515E5EDED6D6A6A3A7EFCF87BF7EE492412C5112E5DBAB466CD1AC59F63C68C696D6DFDE38F3F66CE9C696666E6E8E878E0C081BEBE3E1E8F77F8F0E13163C6585B5B1F3F7E1C6B83AF5BB70E21343838F8CB2FBFB8BABA5A5858AC58B1A2A7A7273737D7D1D131323272E4C891F6F6F6C78E1DEBEFEF1F1C1CDCB46913B664CF9E3DFDFDFD08A1274F9E848585999B9B3B3939894422784101043478AF7A398AFE5FEDEDED2C16ABA4A4E4F9F3E708A1B4B4343333335353D3F2F2F2969696B8B8B8D2D2D24F3FFDF4CC9933D8068A66B85C2E57FC2993C9E472F9F1E3C777ECD8515A5A1A151555575777EFDEBDC4C4C4C2C2C2D3A74FE7E6E662DBCBE572EC9BE0E6CD9B050505C78F1FCFCDCDA550283FFEF82396DA63C68CC9CECE3E7CF8705A5A5A4D4DCDC183077B7A7A1E3E7C989494D4DEDE7EE5CA1584D0850B17CCCCCC1E3E7C989A9A4A2291E00505D0C501DE1F3D3D3D583316E3E5E5555353D3DCDCACA6A6969090B06AD52A84908B8B8B9E9E5E737373555595AAAA6A7979B95028FCEBC31E3A74A8AAAAEA8F3FFE9048241289A4A9A9A9BCBC3C3030D0C6C68644227DFAE9A7CA1B1717178F1B37CEC1C18142A16CD8B0213838383838D8DADA7ADEBC79542AD5DBDBFBE8D1A33C1EEFD6AD5B4B972E2D2828904824341AADA4A40421646A6A5A5353F3DB6FBF191B1B6B6969E17038784D010434784F686B6BA7A5A529FE148944EBD6AD2B2E2E1608041D1D1D3E3E3E08A1BABABAB367CF72381C2C6DEBEBEBB1962F06CB44994C86C7E3C56231D63A3E71E2447575B5582C964AA5A5A5A5E6E6E62291884C26E3F1F897B6E249241281404008A9A8A808040284109148A452A9D8036C333E9F9F9A9ACA6030B053F8F9F92184E6CF9F9F9E9E9E9B9B9B9C9CECE1E1F1D2E30300010DDE07643279E2C489696969696969414141341A0D21545555555D5DBD65CB163333B3BCBCBC274F9E28EF42A5520706061A1B1B7574741E3D7AD4DBDB8B108A8E8E3E7CF8B08787474B4BCBEEDDBB1142565656F9F9F9CECECE5A5A5ACF9E3DF3F0F0501CC1D8D8B8B2B2B2A9A9494747E7FAF5EB4E4E4E2F2D9B9B9BDBB871E366CF9E4DA552EBEAEAB01EE7D6D6D63163C604070767656561110F000434784FF4F6F66ED8B041F167505090B7B7774C4C4C7171F137DF7C832DD4D7D767B3D9274F9EA4D3E9783C7E707050F9089696962C166BE7CE9D6C361B8FC7F3F97CAC797BF9F2E5F4F4740281D0D4D4646F6F3F7DFAF4E8E8E87DFBF651A9545D5D5DE580F6F7F73F77EEDC4F3FFD44A1503A3A3A3EF9E4939716F5D34F3F3D77EE5C595919F645E2E5E5656F6FDFDCDC9C9595251289783C9E8F8F0FB4A0010434785F5E5422F1E8D1A3CA4B343535B5B4B4BEFCF2CBE7CF9F5B5858600B478E1CF9F1C71FD7D4D42084CCCCCCC68E1DABA9A979E4C8116CAD8585C5F2E5CBCBCACAE472B9B9B9B99B9B9BBABAFA860D1BF2F2F2442291B6B6F6D4A953B5B4B4ACADAD972D5B565A5A2A168BB136B2A3A3238BC5C2227EC99225A5A5A542A1D0D8D8D8CDCDADB7B777EDDAB58A52AD5EBDDACACA4A535373C58A1515151562B1584F4FCFCECE0E21E4EEEE4EA7D3DBDBDBB12F0F784DC187CBD1D1513ECCE4E5E52184C2C3C3FF7AB31F7EF8012194989828FF90383838E070383990CBF5F5F5B5B4B4A01EC07B66F2E4C908A1B6B636689B0000C03005010D000010D000000020A0010000021A000000043400004040030000808006000000010D000010D000000020A00100E07D068325BDAB6022288490F29C2F00404083E1124C140A05EA0121A4A5A505950020A0C170616767874D4AF216757575D5D6D61A1919E9E9E9BDDD9260439B0200010D8685F8F8F8B75E86B8B8B8458B16AD5EBD7AFDFAF5F08A00F086C08F84000000010D000000021A000020A001000040408361E3C993273B76EC807A0000021ABC7D2B57AE2C292951FCD9DBDB5B595939641B994CE6E9E9097505000434F84F1D3E7C382222424D4D6D606040B130323272F5EAD508218140E0EEEECE66B3535353A1AE00808006FF291A8DA6A9A9C9E7F34D4C4C6A6B6BDBDADA1042643299CBE5D6D6D64E9A3429373797CD6633180CA82B005E23B85105FC2DD7AF5F3734346C6969B1B0B0C096B4B6B6AE5EBDFAFCF9F3D89FD9D9D9504B00400B1ABC1D818181381C4EF167424282229DFDFCFC606C100020A0C15B73FAF4693CFEE56F9803070E30994CA8220020A0C15BF3D29137162F5EACA3A3039503000434789BD6AD5BF7E2C2850B176A6B6B43E50000010DDE26269379E8D021E5256BD6AC717272829A0100021ABC656432D9D7D75779C9E8D1A361C87C0020A0C1B0606565151B1B8B3DDEBC79F3AC59B3A04E007843E03A68F0CA8D684343431A8D2693C9F4F4F4E0E6140020A0C17021140AF5F5F5B76FDF5E56563679F2E4FEFE7E353535A81600DE04E8E200AF402C16272424585B5B6FD8B0212A2ACADADA7AEFDEBD3D3D3D503300400B1ABC4D376FDEECE8E858B162858E8E8E8F8F0F42A8B0B070E7CE9D381CCEC1C161C68C197033210010D0E0BF76E3C68D8686866FBFFD5624124546465A5B5B7FF6D96708A1EBD7AFDFBD7BF7DCB9734D4D4DBB76EDD2D1D159B66C1954170010D0E0BF909696F6E0C1838B172FD6D4D47CF5D557BABABA6BD6AC51AC9D3973E6CC9933C78D1B5757578735A56B6A6AACACACC2C3C3A1EA008080066F504646C6C68D1B0B0A0A1042DF7EFBEDA64D9BE874FA8B9B2D58B00021646C6CBC68D1A25DBB76191A1ACA64B2A54B9742050200010D5EBFA2A2A2CD9B37D7D7D79794947CF1C51793264DF2F2F27A693A2B848585A9ABABD7D4D47CF1C5175BB76EBD7CF9724444C48C1933A03201808006AF0797CBF5F5F5E572B9151515F3E7CF8F8E8E363535D5D4D4FC9F3BE270B88F3EFA88C7E3797878DCBC7973FBF6ED8585853B76ECF8F5D75F5D5C5CA06201808006FFCAB871E31A1B1B5B5B5BC78E1DDBD4D4C46030582CD62B1D814EA7BBBABA8E1A356AE5CA95DF7DF7DD993367A64C9942A1508A8B8B613C520020A0C12B1B1C1C14080453A74E7DFCF8B1BABABABBBB7B6666268140F8C707FC7FD8BBCFB0A692FE6FE043420984DE412148EF1D0414050411156465112CA828A8B85674ED5DB1A0887511D4B5A0284551EA2AA0205590DE02A87482F41A0884E479719E3B7F2EF7BEB72AF5F779B1179B72CE9C39872FE39C3333442291482406060622845EBC7841A150A4A5A5EBEAEAD8D9D921A601F8EB60A0CAB4D6D1D1515A5AEAEEEE2E2A2ADADADAAAAEAE4EA150B2B2B2FE4D3AB3E0F1F83B77EEB4B5B5D9D9D99148245151517373F3D2D2D2A6A626A8790020A0C1FFD4DDDDFDE6CD9B53A74E696A6A1617175B5959C5C6C69694947072727EF37D4547471716165A5959717171696A6A6EDAB4E9CD9B370D0D0D701600F863D0C531EDD0E9F4B0B0B0AAAAAA13274E2084B4B4B4AE5CB9F2D524A2DF1C0707475252D2A74F9F366CD8101B1B1B1B1BBB7EFD7A1B1B1B1B1B1B98AD14000868F0FF5DBB760D5B18455151D1DEDE7ED1A245DF3B9D591414147EF9E597BB77EFBE7FFFFEFEFDFBF7EFDFDFBE7DFBA953A7FEEEAD480020A0C15413101050535373E5CA151111917DFBF6292B2B3B3A3A8E71193434342E5FBE9C9191919696161C1C7CFDFA751A8D262E2E7EFAF46938410040404F47C1C1C1494949F1F1F12D2D2DB76EDD1213135BBE7CF93896C7CCCCCCCCCCCCD8D8B8B6B676DFBE7D1D1D1DF5F5F54A4A4A870F1F8693050004F4DFD3D1D171F4E8D19B376F4EBA92C7C7C75FBD7AB5BCBCBCAEAECECFCF4F4343C3DADAFA9B3CA4F1EF5958582084E4E5E53B3A3A1C1D1D050505535353EDEDEDB19998000010D00821646B6BDBD2D282FD6C676777F6ECD9AF3E40A3D132323226DD71A5A4A46CDEBCB9BEBE1E2174E9D2A5CD9B371389C48956487373730683111D1D6D6F6FFFEAD5ABDCDC5C0E0E8E4D9B36C165090004344208959696BE7FFF1E6B577273734F81236A6C6C343434A4D1689D9D9DBB77EFDEB76F9FA0A02081409898A5C5E170767676140A253636D6C3C363CF9E3DC78F1FBF7FFFBEADAD2D5C9C603A83E7A0FF3F090909494949494949010181969696CB972F1B1B1B9348246B6BEB828202D6C7AAABABF7EEDDABA6A6A6AEAE7EF4E8D1CECECE969696356BD6282828CC9E3D3B3030904AA58EE3517476767EF9F24548488844223199CCA54B973299CCCB972F4B4A4A4ED874C6E0F1784949C98D1B373299CCA3478F3299CC65CB96B1B1B1E5E6E6B2FE71030004F434555454545858585858585757979595C5C1C1111515555656E6EAEAEAE3E3C3FA587676368542090B0B7BF7EE9DACAC2C9D4EF7F1F1919292CAC9C9F1F3F3CBC9C979FDFAF5781D426D6DADADADADA4A4647777B7B5B5757373F3C3870F27E3B9D8B76F5F7373F3E6CD9BB1993D1415152B2A2AE01205D0C5317D1D3870808D8D0D21646565B56BD7AEFAFAFACACA4A1A8D262929999393C3FA98A8A82891484C4F4F57505058B870A1B0B0704242C29B376F8485850D0C0CF2F2F2C864F2D817BEBABABAAAAAEADCB97339393973E6CC1114148C898999EC67E4EAD5AB082132999C989868636373E7CE1D4949496D6DED497A381F3E7C505555FDE345D0190C465A5A1AB69C180010D0FF272E2E8E9D9D9DD54C0E0F0F6F6F6F1F1919A1D3E9A3FF896D6C6C3C323292929292999929222272E0C0011A8D86DD796367676767671F1E1E1ECB62373636262525C5C6C6868585999B9BAF5DBBF6DCB973D2D2D253E3A46019BD71E3C6F6F6765B5BDBD9B3676FDDBA555F5F5F5353732C8BD1D4D444A7D365656559AFD0E9F4F7EFDF9348A4993367FEC58D1C3C78D0DFDFFF8F4B3E3434B476EDDA9A9A1AF87D0410D0FF535E5E5E6F6FEF810307242424323333E3E2E2586F757575898A8A1E3E7C984C267B7B7B777575E9E8E8BC7CF972F9F2E5F5F5F53535356A6A6A6353C8BEBEBE8080808A8A8ABB77EFCE9E3DFBE79F7F5EB56A95AEAEEED43B1D77EFDE6D69695156562693C9EBD6ADB3B3B3B3B4B47472729297971F9B02646565B5B4B46CD8B0813551494B4BCBC58B17CF9C39F3D7031A0008E86F434949292F2FEFDAB56B0402819D9D9D4EA7B3DEEAECEC7CF1E205954AA5D168DADADA020202DBB66DBB7BF7EE870F1FB0117163F3EF532693B977EF5E6C3E4F2323A38B172F9A9B9B4FE133222E2EEEEBEB5B515181C7E35FBC78111F1F9F999979FDFAF51933668CC1DE7978781A1A1A6A6B6B959494B0575EBD7A252B2B2B2626161C1C5C5151212222626767A7ACAC7CE5CA154D4DCDACAC2C2291E8EDED5D5D5D1D1313D3DADAAAA1A1D1D9D98910EAE8E8888888A8AEAE26100873E7CE353737676767CFCCCC7CFBF6EDF0F0F0ECD9B359E7B7AEAEEED5AB57B5B5B5D2D2D28E8E8ED2D2D2C78E1D9B3B776E4646C6AC59B34C4D4D5FBD7AF5E5CB9759B3662D5BB64C545414EBA00310D053D0F5EBD7478FDD303636E6E5E5ADABABC3E3F18A8A8AFAFAFA828282D8C3D1F2F2F20E0E0E353535ECECECEAEAEA222222F3E6CDE3E2E26A6C6CE4E6E65657579F356BD6F72EEDC18307EBEAEA4242424824D2D9B367E5E5E54D4C4CA6C369525151397FFEBCB3B3735050506464E4E0E0A09090507070300EF77DEF75EBEAEAA6A7A7171414C8CBCBE3F1F881818190909063C78EBD78F1A2ACAC4C5B5BBBA6A626222262DDBA758F1E3DD2D1D1B1B4B41415156D6E6E0E0D0D6D6F6F575353CBCFCFC72659BD70E1C2AC59B3D4D5D55B5A5AE2E2E2B8B8B8080442585898B4B4B4B4B474787838B6C7E6E666AC934D4949A9B4B4F4E9D3A79E9E9E376EDCA052A9BABABA381C2E343474606040414121373777606060C3860D13F00977F06DE8E8E8302798FCFC7C84D0BA75EBFEF86367CE9C410885878733A787F3E7CF2F58B0809797978D8D2D3131F1FDFBF713A4601E1E1E9D9D9DFFF52D6F6FEFDADADA6FBBBBB2B2B2C4C444AC3D6B6565E5E1E1F15D8F6E6464E4F1E3C73E3E3E0D0D0D4C2633323272FDFAF55555552E2E2ED9D9D9341AEDF3E7CF9B366D4A4D4DD5D3D37BF6ECD9D0D01093C9CCCACADAB061434949098D46FBF0E183AEAE6E7171F1870F1F3A3B3BE9747A6767E7D5AB572F5FBE7CF1E2C50B172E343737D368B4A8A828ECF9C877EFDE7979799594940C0D0D9595952D5BB6ACAEAE4E4C4C2C2B2B6B787838313171CB962D64329946A3656565D9DBDB532814269842B01100140A055AD093C383070F2E5EBCD8D8D8D8D5D5F5FCF9736565650D0D8D6FB2E59B376F060404B0FE373939D9DDDD3D3A3AFA6F6DE4FDFBF7434343FFAB43FF9B3F1BAEA6A6A6A6A6161F1F3F3838A8ADAD9D9191919999696F6F7FEEDCB9EF51F9381C6EDEBC79595959959595121212818181C78F1F1F191979F5EA557171311E8F1F1919696E6EC6A637313434E4E0E0C06E12D0E9746565650E0E0E2D2D2D21212184100707C7D6AD5B2B2B2B070707BBBABAD6AF5F3F303060606020262686C3E1E6CE9D8BEDB1BBBB3B2222222525058FC7D3E9F4868686E1E1611C0E676060C0CECEDED3D383C7E3151414D8D9D9757575DBDBDBC7F8D634802E0EF0FFFB2293939357AC5831303030303080C3E1222222ECEDED590F9CFC7BD8EDAFB56BD762FF2B2C2C7CEFDE3D6CD70C9416286B000020004944415406838D8D0DFB2F0E87FBAA9713FB0042E8ABD7190CC6FFFACAB7A5A0A080102A2B2BD3D4D42493C91F3F7EBC73E7CEB163C7B66DDBF6CDF73B63C60C1515958282829696162121213D3DBDFAFA7A3333337F7F7F616161ECA8B1495359A7868383038FC7F7F4F4888888747474D0683484D0D6AD5B7FFAE9A73973E67070703C7CF8B0BBBB9B4824F6F7F7D368346E6EEEE6E666ECBB9C9C9C8E8E8E070E1CE0E7E7C7362E2222C2C6C6866D1CBB57D9D3D3232C2CDCDEDE4E2010BE77270F182F705E27AEC6C6C6B76FDF5A595951A9544141C19B376F0E0F0F3B39397DC374C6F0F2F28AFE474F4F0F76BF312C2CCCCACA6AE3C68D9A9A9A46464621212158C4600607079F3D7B666969A9A5A5B573E74EEC49440683412693DDDDDDB5B4B4E6CF9FFFF4E9D3311857A9A2A2323C3CFCF6ED5B5151D1E1E1E11D3B765CBF7EBDB1B1F1DB362AD9D8D8962E5D5A5C5C7CE1C285F5EBD77372728A8888CC9E3DFBFEFDFBCDCDCD0D0D0DB76FDFFE6A34CDCC9933F9F9F9EFDDBB575C5C7CEBD6AD8F1F3F2284868787D9D8D868345A5A5A5A5454144268CE9C39191919090909C5C5C5D8120A0821454545111191E7CF9FB7B6B6D6D4D4F8F9F9B5B7B7B3B63C6BD62C2693F9E8D1A3A2A2227F7F7F0303833F7EBC1A4040836FA9BCBC3C37379744222D5DBAD4C0C0C0DBDBBBA1A161CB962DDF6977B5B5B5B9FFC1643259AFF7F7F72F5FBE3C3B3BFBD4A95377EFDEEDEEEE66BD555050F0FAF5EB3D7BF6A4A5A5C9CACA6269D8DBDB7BF3E64D0D0D8DF4F4F413274EBC7BF7AEB0B0706C6ACCDCDCBCA1A1E1FAF5EB060606274F9E9C3973E6F3E7CFF3F2F2BEE12E482492AEAEAEAEAEAE8181011B1B9B9090908787073737F7AE5DBB0E1C38202828282525A5A6A6C67A144F4E4ECECDCDADA4A464C78E1D6C6C6C6666660402C1CFCFEFF1E3C7EBD7AF4F4C4CB4B4B49C3163C682050B162D5A141414B47BF76E2B2B2B2D2D2D8490BCBCFCBA75EB5A5A5ABCBCBC4E9E3CA9A5A5C5C7C7C71AA4A3AAAABA66CD9ADCDCDC6DDBB6D168B4AD5BB7620D6D3035C14DC289A3B0B03036365651511121646767E7E5E5F5BDF778ECD8312D2DADC5FFD1D2D2A2AAAACA64329F3E7DEAE5E545A3D1984CE6D0D090818141636323EB5BE1E1E1DEDEDEBDBDBD4C26B3B5B5555555F5CB972FCDCDCDBABABA0F1F3E8C8D8D7DF6ECD90F3FFCF0ECD9330B0B8BF2F2F2B1ACC34B972E2D5EBC988F8F0F87C3C5C6C6A6A6A6C24D27003709C1BF959B9BBB6BD7AEB4B4348490ABABEBE3C78FC7A66F71DBB66DACE93DBBBABA58AF73707060ED410E0E0EECBA61BD353232C2C6C686DD0D63F5813299CCB6B6B6D7AF5F1308042693292424342EE338F6ECD983CD87E7EBEBBB64C9121289141414B470E142B8C0C0A403013D51FA34222323131212D2D2D256AC58A1A8A8B87FFFFE897CE7475454746060A0A8A848434323313111EBFDE0E4E4B4B4B4747676C616392C2D2D1DC741E7274F9EE4E2E26A6E6EBE7EFDFAF6EDDBD7AD5B676666862D1100000434F84B5A5A5A7C7C7CAAAAAAE2E3E3972E5D7AF5EA550707073939B9095E6C4D4DCD9292928080003E3E3EECAE1742888F8F6FD5AA557171716FDEBC616363E3E5E57575751DC7421E3A74A8BFBF5F5151B1ACACECF0E1C3868686666666EBD6ADD3D7D7870B0F4040833FE1E6E6D6DEDE1E1F1F6F6A6A1A1A1AAAA5A535665379B0383B3B8F5EA38048245EBE7C1921646666A6ACACCC7AFDFCF9F3D8F364187171716767673535352A952A2B2B6B6565252020C0C1C1616161212626D6D0D0C0C6C6262B2B2B272777ECD8B1716C471389C41D3B765028142B2BAB172F5E5CBB762D2727474646C6DFDF7FCA4C2905A638B849382E5C5C5CB04E0C1D1D9DD2D252B831F2BDD5D6D6FEF8E38FD8356F646484DDE1046022DF2484C7ECC6C14F3FFDA4AAAAFAFCF9732291482693A3A2A2D4D5D5A15ABE375959D99B376F92C9646363E39C9C1C7D7D7DACAF1C00E8E2F88ED6AD5BE7E9E93929CA29222272F9F2E5A1A1210683919B9B2B2B2B2B20200057E1981117171717174F4A4AA2D3E9AAAAAA595959424242B6B6B6F7EFDFC7A6F3862A0210D0DF8C80800089449AE085A4D3E98D8D8DE83FD3CF8B8888BC78F1C2C6C6062EBEF1828DBB6B6E6E6E6C6C3432320A0D0D0D0D0DDDB16387B7B7F718EC1D8FC7C32CD2605A04F4B66DDBB66DDB36C10BD9D8D8E8E4E4D4D1D15155558510F2F0F03034349CD4D5DEDDDDDDD6D6864D85F195FEFEFE868606151595497120A2A2A267CE9CD9B8712342E8DAB56BD7AE5D1B839DCE9831A3A1A101A2074CFD809E1466CC9891959595959575FEFC7932997CE1C2053C1E6F6C6C6C6363C3C3C333198F282727E7C18307C1C1C1BF7FABB2B2F2F0E1C3A3D7A061191919A9AEAEAEAEAE1E191991919151505018DF85C6E3E2E29A9A9A3C3D3D2525255933E57F6FF1F1F1F01B0120A0271C131393172F5E444747C7C4C48484849C3D7BF6ECD9B3525252EBD7AF9F2635D0D7D7F7E8D1A3D6D6D68181011E1E9EB56BD71A1B1B8F4B49A2A3A32914CAEEDDBB7138DCA64D9B747474B66EDD3A36BB16171787DF0500013D41D9DBDBDBDBDB3F79F2844C26FBFAFA0E0E0ED6D5D59148A475EBD68D65313A3B3B1F3E7C282727575555A5AAAA2A2525555050D0D5D5B568D122EC7992D6D6D68484848686060909094B4B4B5959590683919898989F9F2F2020C09A282E3131515C5C1C9BC487C9645EB97265F4503D0683919F9F9F9999D9DFDFAFAEAE3E7FFE7C6363631313938181015F5FDFB2B2B2B10FE857AF5EBD7FFFFEDEBD7B353535FBF6ED939090189B7E670020A0278D952B572284141515376EDC78FCF8716969693A9D8EF5848E8D8E8E8E8B172F7A7A7AE270B8274F9EF0F3F32B2929353434DCB871E3DAB56B838383111111C5C5C5CACACAD80CC86BD7AE2D2D2D7DFCF8B18E8E4E6F6F6F7272B28888089677DADADAAC80BE74E9D2E8802E2A2A0A0909E1E7E7E7E7E77FFAF4290E875BB264C9D0D01036C9DC18AC0DF6FB74DEB76F5F51511142E8D8B163870E1DE2E2E282AB11404083FFC2CDCD8D8F8FAFBEBE7EC78E1D274E9C888B8B5BBD7A35B62AC7181016165EB16285A4A4E4891327B8B9B9DDDCDC060606ECECEC180C464747C7DBB76FBDBDBDF5F5F5CBCBCB6FDCB8F1F9F3E7E0E0E0050B16B8B8B8F4F6F6F6F5F5555757FFE92EDEBE7D2B2424B461C306111191989898DBB76F2F59B2A4BCBC3C2626C6CACACAC0C060CCAA3A2F2FCFC7C7A7A2A2A2B4B4D4DBDB7BCE9C3936363690CE00021AFC114747C78181017D7DFD376FDE1C3B762C3737175BA4CED4D4F47BEF9A97975759591987C3090808484949898A8A2284A8542A93C9A4D1689D9D9DFAFAFA5C5C5C588F476F6F6F6565E5D1A3470904022727A79191D15F09E8A6A6261D1D1D0909093C1E6F656575F8F06184504343437F7FFF98DD206D6B6B737474ECECEC2C2B2B7373730B0C0C545151C10E16000868F027B8B9B9E7CC99A3A3A3B36AD52A3F3FBF8080002727271E1E9EF4F474090989EFB75F3636366C2173EC076C8D286C42511C0EC7C9C9D9D3D3232626D6D7D78710626767E7E5E5EDECEC4408D1E974D6CCFD381C8E4EA733180C1C0E377A3A7F0C8140181818181E1EC6E3F1EDEDEDD8D3C7161616C6C6C66393CEC6C6C62D2D2DB5B5B5F3E7CFFFF8F1A39090D0E8E9440098F860A8F784C0CBCBABA0A070E5CA154F4FCFDEDEDEEAEA6A7979F9EEEEEE315832EAF7F8F9F9E5E5E50303036B6B6B9F3C7982C7E367CC98B174E9523F3FBF9A9A9AFCFCFCA0A020EC93323232EFDFBF2F2C2CACAEAE3E74E8D057DB3134344C4B4B4B4F4FAFADAD3D7EFC38D67B93929272EAD4A9EF5AFEC1C1C1BEBE3E2323A30F1F3EB4B7B79B9A9AFEF6DB6F0A0A0A90CE005AD0E09FE3E4E40C0A0A0A0A0A7274742C2D2D1514145456568E8D8DE5E3E3FBB6AD690E0E0ED66036616161D682497272726C6C6C626262DBB76F3F77EEDCB265CB949595BDBDBD959595B13F180E0E0E3366CC98376FDEC0C00042C8D9D9B9ADADCDC3C3834020B8BBBB171515717171494949615B5BB264495F5F9F8F8F4F474787ADADED9E3D7B10425C5C5CDF6F747B5757575B5BDBDEBD7B5FBE7C292323A3A4A4F4D53A81004C3E937736BBA96DDEBC797A7A7A08A1850B17A6A5A5353434C02C5FFF4B6767675A5ADA4F3FFD84105256569E3367CEA74F9F266039C5C4C466CC9801E70BC09257935E4A4A4A5D5DDD9A356B5EBF7EFDFAF56B3737B765CB96CD9D3BF7BBF64D4F3A341A2D2626A6A8A808EB39D1D2D2BA71E3C6BC79F3A06600747180EF4B5656F6F6EDDBD7AE5D2B2828080E0E0E0E0EDEB66DDB891327B0C7900142E8EAD5ABFBF7EFC71ACED6D6D6CB972F87740610D0608CA8A8A8DCBC79332B2B2B2121E1D9B367376EDC181E1E9690903879F2E434AF998080000A8572E6CC190909899F7EFA494B4BCBD1D1112E1800010DC69A898989898989B9B9796565E5E9D3A71B1B1B9B9B9B6564648E1C39320D6BE3C18307191919CF9F3F6F6B6BBB75EB968888086BA9140020A0C1F8B0B0B0B0B0B0505656EEEEEE767474141010C8C9C959B060C18E1D3BA6490D444747DFB973A7A0A0A0AEAECEDFDF5F5E5EDEDEDE1E7B881B0008683021621A21141B1BBB64C992A8A8A88C8C0C3C1E8F3DC030B52524246CDFBEBDB6B61621E4EFEFEFE9E9492412E17A0053180C5499AC6C6D6D6B6A6A1E3C78D0D6D676E8D0213939B9A8A8A8A97AB09F3E7D9293935BB56A556D6DEDBE7DFB6A6A6A366FDE0CE90C20A0C10485C7E34924D29A356B0607078F1E3DDADDDDBD72E54A0281909393D3D5D535358EB1B7B7B7ABAB4B4040404B4BABBBBB7BC9922583838367CF9E259148DCDCDC700D00086830B1CF1F0EC7C5C5B577EFDECECECE2D5BB6606BB5888B8B7FFAF469B21F5A4343C3DCB973858484FAFBFB2D2D2D3B3B3BEFDFBFCFC5C5854D2102C074007DD053879F9F1F36477E7A7ABA999959585898888888A6A6E6A43B909A9A9ADADADAC3870F171515999898888A8A464747C3F90510D06072F3F7F747086DDCB8B1B5B5D5C2C2C2C0C0E0E79F7F565757D7D2D29A2CADE6F4F4F4F0F0F067CF9ECD9D3BD7C5C5E5C68D1B303B2880800653C7DDBB773B3B3B4F9E3CF9F9F3675757D7850B172E5EBC78C992258A8A8A13B6CCDDDDDDF7EFDF2F2A2AFAF5D75F4D4C4C76EEDCE9E1E131199BFF004040833F21242474E5CA95AAAA2A7676F6C8C8C8D7AF5FA7A4A4F8FBFB9348A40958DAA1A1A103070EDCBA750B2164626272E9D2A53973E6C0490400027A2A5352523A7FFEBCBDBDFDA3478F222323878686C4C5C57FF9E517028130710A79E0C081A6A6A6E0E0604545C543870EA9AAAA8EC1823200404083F1A7ACACACACAC6C6C6C5C5B5BFBF3CF3FC7C6C6363636CE9C39F3EEDDBBE35EB6B367CFA6A7A727272733188CD8D85821212188660020A0A71D0D0D0D0D0D0D4545C5BEBE3E7373F39191918282022B2BAB8B172F8E4B79EEDCB9131010F0F9F3E7AEAEAE172F5E9048245D5D5D384D0040404FEBD63442A8A8A8485151312F2FAFBCBCFCC993277BF6ECD9BD7BF79895212121C1DDDDBDB7B7B7A7A70721141919B964C9127676B80E01F82F60A0CAB4A3A0A040A7D33333338944627777F7DEBD7BFDFDFDDBDADAE874FAF7DB2993C96C6B6B4B484858B468517B7B3B2727E7EDDBB7E974FAB265CB209D01808006FF078FC79B9898B4B6B6DEB973475D5DFDCC9933626262E1E1E1252525D8C2DEDF565555557E7EBE9898D8B265CBD4D5D50F1C38D0DADAEAE1E1C15A4D1C00F05F41E3655A737171717171B972E54A6C6CAC9797577777775C5C9CA0A0E0B7BA59575252D2DCDCBC71E3C68686066B6B6B1515951B376E40B503002D68F057EDDAB52B212161E7CE9D442271F1E2C54E4E4E090909FF7EB3B9B9B99E9E9E3636367575752E2E2E09090990CE00400B1AFC13274F9EE4E4E46C6E6EBE71E386979797979797BEBEBEA5A5E53FD8546969E96FBFFDF6F2E5CBACACAC152B56C8C8C89C3E7D1A6A18000868F0CF1D3E7C9846A3C9CACA7EFEFC79EFDEBD060606565656CECECE4646467F710B8D8D8D57AF5E2D2929898F8F777070F0F5F575757595919181BA0500021AFC5B5C5C5C3FFFFCF3972F5FCCCCCC5EBF7E7DF1E2C5F4F47405058553A74EC9C9C9FDC117994CE6BA75EB3A3A3A626363CDCDCD1F3E7C686868A8A6A606550A000434F896242424DCDCDCE6CF9F4FA7D39F3E7D9A9191515555151313232222F2BFBEE2E2E2121E1E8E103232320A0808D0D0D0806A04E05F829B84E07F929595F5F7F72F2C2C9C3B776E565696B9B939B61CE257B66CD9A2A3A3131919292626565858181A1A0AE90C000434F8EE242525B5B5B5A3A3A39B9B9BBBBABAD2D2D22425259D9D9D994C2693C93C79F2A4A4A4E4FDFBF78B8B8B0B0B0BCBCACAB4B5B567CD9A05F5C6F2CB2FBF484A4A464444FCFE0173269379F5EA554949C9972F5F424581FF0ABA38C09F1314144408353535B5B7B7ABAAAA464444E07038D65BAF5FBF9E376F1ED4D27FC5C6C6D6D7D7E7ECEC8C107AF3E60D83C1181919A150286FDEBC59B3660D42889F9F1F46EB000868F00D8888886466663A3B3B7776760E0C0C484B4B9F397306D2F90F7879797DFAF4C9CFCF0F2164656585BD282D2DCDFAC0E9D3A71D1C1CA0A2000434F806141515F3F3F3DFBC79F3F9F3670F0F0FA8903FA5AAAA2A2D2DDDD4D4F4FBB7E4E5E527E6120A6082803E68F04F585959413AFF451E1E1EACB6F3575C5C5C962D5B06550420A00118374B972EFDFD53E45A5A5AD03B0420A00118672E2E2EBF5FB1D7D0D070D1A245503900021A807176E8D0A1D143DE757575376FDE0CD50220A001187F969696020202ACFF9596969E3D7B36540B808006604278F1E28590901042485D5D3D2020002A0440400330512828281008043636365E5E5E595959A81000010DC044D1DCDC9C9999292121111111D1D6D606150220A001187F9F3F7FFEF0E1C3DCB973E5E4E49A9B9B6565651D1D1D3F7CF8D0D0D0009503FE008C2404E03BFAF4E9537979B99F9F5F7272324268E1C2859C9C9CDDDDDDA9A9A9464646CECECE6BD7AED5D7D71F3DF81B00086800BEAFC6C6C6DF7EFBEDD5AB57D834D9767676D2D2D2FEFEFE7C7C7CB5B5B5A74F9FAEACAC0C0F0F0F0F0FDFBC79B39191D18F3FFE38FA310F0020A001F8F6A854AABFBFFFC78F1FEFDFBF8F105AB06081898989BBBBBB828202F601128974E7CE9DBCBCBCE7CF9FBF7EFD3A3030303030B0A4A444525272FFFEFD508100021A80EFE2C89123CDCDCD77EFDE4508191919AD5DBB76CE9C397A7A7ABFFFA4BEBEBEBEBEBEADAD6D6161E1D5AB57AF5CB982C7E31B1A1AE4E4E4F6ECD903350920A001F866CE9E3D5B5050101313333030202B2B7BE9D2251289646C6CFCC7DF323737373737D7D4D46C6D6D757777BF71E386B0B0F0FBF7EFADADAD376DDA04B50A010D00F8570203031F3F7E5C5252D2D9D989104A4E4EE6E3E3D3D7D7FFEB5BC0D6129B3973664343C38A152BC2C3C3D3D2D21E3D7AE4EDEDEDE8E808350C010D00F8DB626363BDBDBDDBDADA3A3A3A1042919191EAEAEACACACAFF6C6BA6A6A6C3C3C31515154949495BB76EA55028151515FBF7EF7FF2E4C9DF8A7B3065C073D000FC6D4C26B3A8A8484040C0D9D9F9F3E7CF030303818181DDDDDDF6F6F6FF389D311C1C1CCACACA9E9E9EDDDDDDC78F1FEFEDEDFDF4E9D3BC79F3040404DADBDBA1E621A001007FA4BEBEBEB0B0504747676868485252F2D8B163542A75D3A64DFCFCFC783CFEDBFCC3969D9D9F9FFFC48913542AD5D3D3535C5C9C4AA59248A4EAEA6A0A8502A760FA802E0E00FEAA8A8A8A8E8E8EE5CB97B7B5B5999A9AEAE9E9DDBC79F37BEF149B56C9D9D9B9AEAE4E5E5E5E474727202040525212564F878006002084507979794545C5D9B3677372726C6D6DC5C4C4828383C7B200E1E1E1030303AB56AD6A6F6F373333B3B3B3DBB46993AEAEEEEF176A0110D0004C179F3F7F7EFDFA757474745C5CDCA2458BB66CD9E2E3E3232C2C3CF625E1E6E68E8C8CFCF4E9D3A54B974A4A4A7EF8E187356BD6CC993367F9F2E5E2E2E270A620A00198463A3A3AAE5FBF5E565616161666696979FCF8F1952B57AAA8A88C6FA9141414020202B2B3B3E3E2E2A2A3A31F3D7A9497973763C68C23478E7CAB1E7000010DC084B66BD7AED6D6D69090103D3DBD80800023232303038389533C6363636363634B4BCBF2F2F20B172ED4D4D4343535494B4B1F3F7E1CCE1D04340053D6A14387C864727474B4A8A8E8F3E7CF67CC98F1A7A301C7CBFCF9F3E7CF9FAFAAAADAD9D9B962C50A6E6EEEC2C2C2B973E77A7B7BC379848006604AB974E9D2F3E7CF4B4A4A7A7B7B939292848484FEEB1C1A130D360A313535B5BABA7AD5AA55A9A9A91111115E5E5E6E6E6E704E21A00198F49E3E7D7AF8F0E1B6B6B69E9E9EB0B0300303033939391C6E328D12303131313030983D7B764C4CCCCE9D3B2B2A2A4E9C38F1EBAFBFCE9F3F1FCEEFE4050355C0F4D5D3D39392924224123D3C3CDADADACE9D3BD7DFDFEFE4E4242F2F3FB9D219C3C1C1212F2FFFD34F3FF5F7F76FD9B2A5ADAD6DC992254422F1E3C78F7D7D7D70BA21A001981C6A6B6B4B4B4B050404162D5A3463C68CDDBB777777776FDDBA958787673246F368783C9E8787C7C7C7A7BBBBDBD5D575C68C196A6A6A7272725555558D8D8D70EA2717E8E200D30B994C6E6D6D5DB3664D434383B9B9B99A9A5A6060E0543DD83B77EE20847EF8E1070A85A2ACAC6C6464E4E7E73773E64C188508010DFEC89B376F66CF9E4D2412A12AC6329A4B4A4AFCFDFD3332326C6D6DE7CC99131212321D0E3C3232B2BBBBDBC3C3E3CB972FF3E6CD73707070737333363696959585AB02027ADA79F7EE5D515111F6330707C7E6CD9B7FFF9943870E3D7DFA14027ACC3A34A2A3A3131212A2A2A26C6D6DB76DDB76E4C811090989E95303020202E1E1E16432F9E6CD9B797979CECECEEBD6AD3334345CB972A58888085C2110D0D3485858587B7BBB86860616D05021E3A8B7B7D7D7D7F7E3C78F4F9F3E9D376FDEE9D3A7972F5FAEAEAE3E3D6B435555F5FAF5EB9999994949491111110F1E3C282E2E9690903875EA145C2A10D0D3889393D38F3FFE88FD3C3232525959F9E2C58B868606616161070707D6D3B5232323D9D9D9D1D1D1BDBDBD1A1A1A4B962C9196967EFBF66D626222954A9D33678E9393133B3B9CA37FC8DBDBFBCB972F2121215A5A5AB76FDFD6D1D1313232826A3135353535359D3B77EEC78F1F4F9C38D1D4D444A1504824D2912347A07220A0A79D8E8E0E6CACB08A8A4A4545C5F3E7CF050404B0B70607072F5CB8606969696060D0D8D8585555555D5D1D1111A1A3A3232424141919C9CECEEEE4E40475F8771D3D7AB4B0B0F0D5AB57BCBCBC515151E2E2E2B367CF866A19CDC2C2C2C2C2424949A9ABABCBD1D1514040203B3BDBDADA7AC78E1D503910D053DCC183077D7D7D1142040221313171FBF6ED3366CC201008EDEDEDA74F9FAEABAB63B5A0ABABABDDDCDC2C2D2D1142783CDECFCF4F4343C3D5D5959797979B9BFBE1C38710D07FCBB56BD71E3D7A545151D1D3D3F3EAD52B7171715D5DDD4951726767E75F7FFD958F8F6F2C773A7FFE7C2693999D9D4D2693D7AE5D9B9999F9E8D1A33D7BF6B8B8B8C0B53411C073D0DFC59E3D7B9E3D7BF6ECD9B39090102693595656E6E8E8A8ACAC6C606070FFFE7D2A958A7D8C8787E7E0C183F7EEDDB3B6B6F6F1F1E9ECEC6C6E6E969393131414E4E0E0303434ACAEAE86CAFC8B2223236565658F1C39929393131010505757676D6D3D36E97CE1C205D9515A5B5B172E5CF8773752525232323232F6F5C6C6C6666464E4E2E2525757B77FFFFE9C9C1C2F2F2F5959D9F7EFDFC34505013D35898A8ACAC8C8C8C8C8CC9C39F3CB972F7E7E7EFBF7EFCFCDCDCDCBCB737070603299D8C7F078FCD2A54B9F3D7B161919C96432636262040505DBDADA060606180CC6E7CF9FC5C4C4A032FF584747474646061717D79A356BFAFBFB4F9F3E4DA3D15C5D5D656464C66CC8495757D7B163C73EFE878888C893274F1042434343BDBDBD7D7D7D9D9D9DDDDDDDC3C3C35F7D717878B8A7A7A7ABAB8B4AA532180CEC450683817DA5A7A7E7F75FF94E383939656464BCBDBD69349A8787477F7FBFA5A5251717574D4D4D5757175C66D0C53175FF06E2705C5C5C9D9D9D1515151919191F3E7C707676C6DE1A1C1C3C7EFCB8BDBD3D1B1BDBC8C8083737B7858545585898A0A0A08484C4D5AB5757AC580115F8BF5457570F0E0E6A6A6A727070282828D8DBDB5FB87061DC7E91D8D9393939B19F5B5A5AACADAD8B8A8A4243437FFDF5577979F9C2C2420E0E0E2F2F2F575757D6C7FAFBFB232323EFDDBBD7DBDB6B6A6A8AAD0B3E323252545474E5CA95D2D2524141C1FDFBF7DBD8D88CE5B5CAC9C9E9EBEBEBEBEBBB6EDDBA9C9C1C0505052929A98484043E3EBE993367C25507013DE9292B2B8F6EF98A8A8A6EDEBCF9E9D3A78383832626260B172E1415153530302010081C1C1CE6E6E6818181542AD5C2C262F1E2C5626262FDFDFDA1A1A17D7D7DB6B6B63021D97F4526932914CAE6CD9BABAAAA2C2C2CE4E5E5EFDEBD3BBE452A2F2F7FFBF62DF633F684258646A3B9B8B85CBD7A353535F5DCB973F6F6F6AC80CECBCB4B4D4DDDB76F9FB1B1F1BD7BF7B0FE8DEEEEEEDBB76F1B1A1A5EBD7A352F2F8F9F9F7FBC8EE8C1830708217B7BFBF6F6767575F53973E69C3E7D5A4E4E0E462142404F6E5FDD072710083FFEF823EBA93BCC9C3973B01F1C1D1D1D1D1D47BFE5ECECCC6A6283AF545656E6E5E5DDBA752B25250521B46CD9B2E7CF9F4F84D93352525258F77EAF5CB9C27A1D9B569F8383C3DADA7AFFFEFD743A9DF5567D7DBD9090D0DCB9738944E2DAB56B7FF9E517AC599D9999A9A5A5F5DB6FBFD168344343C3F13DAEE8E8E8D6D6D6D5AB5727242458595961CF8FCE9D3B175AD310D000FC9F86868688888877EFDE454646627FD8E4E4E44E9C383141E636DAB265CBFAF5EB595D1CACD7393838B0C14A1C1C1CAC7B0F180683C1C6C686AD53C5C9C9C93A909E9E9EE2E262028180105254541CF743131313BB7DFBF6952B578A8B8BB15BDFEEEEEEDADADAEEEEEEAC074601043498A60606064E9E3C595F5F8F4D9D616B6B6B6969E9ECEC2C2F2F3FA98F4B4242222B2BABB0B0504343232E2EAEBBBB1BFBF7968585858D8D8D8D8D0D93C99C20CB0C9248247F7FFF82828257AF5EBD78F1E2DEBD7B082132992C212171F2E449B84421A0C134B577EF5E0A858245B3B1B1B19797978181819696D61438341D1D9DF2F2F2EBD7AF1308045E5E5EACF743404060E5CA95515151717171381C6EF5EAD5F3E6CD9B2005D6D5D5D5D5D59D3F7F3E994CF6F1F1090C0CE4E09B5F928A0000200049444154E0A8ABAB5356563E78F0205CAB10D0601A3979F2645656564A4ACAC0C0808C8C4C505090A4A4E4C41C75E2EEEE3E7ADE2B4141C180800084D082050B46AF6718101030BA4F404C4CCCC5C5C5C0C0607070505A5ADAC1C1814824727070CC9D3B574A4AAAB9B91987C32929294DB483353131313131515555EDEAEAFAE1871FEEDFBF2F2424F4EEDD3B7B7BFBAD5BB7C275FB5DFE92332798FCFC7C84D0BA75EB9860FAF9E5975FF4F4F4585996959555565606D53201151414BC7CF992F5F7464F4FEFF9F3E7502DFF9EADAD2D428842A1C040153081C4C5C5494B4BEFDBB72F3F3FBFBBBB3B3636B6A9A9C9D8D8584D4D0D2A6762B6ED162F5EDCD4D4141414D4DADA9A9F9FEFEEEE2E2D2D5D5050009533F5BB3806070747DF100753584D4D8DA9A92993C92410087C7C7C376FDE5CB366CD645F7D6A5A24083BBB9494948787C7C68D1B2F5CB870E5CA958E8E0E7D7D7D3636B66FBEAFB76FDF4E9C1E790868141A1A1A1A1A0ABF03D3040F0F8F828282ABABEBA14387A03626173636363636B683070F1E3C7870FBF6ED292929643299354E5D5050504646E6DF6C9F42A1B4B5B5410B7AA2E0E3E31BCB11AE607CBD79F366646464D6AC597E7E7EFFF237F9DBEAEAEAAAADADD5D1D18173F4D76DDCB8D1C1C161F5EAD5ADADAD4422D1CCCCCCD2D2F25F3EE6B163C78EEBD7AF43404F140A0A0AAF5FBF866B7D9AF0F4F46C6B6B7BF1E2C5C2850BADADADD7AE5D6B626232111E60282D2DF5F7F78F88889850D5D5DFDF4F2693ABABAB71389C868686BCBCFC0459B8A7A0A0A0B8B8D8DFDF1FBBC9BF6AD52A191999F3E7CFC3153E35BB38C03471FBF6EDF6F6764545C5AAAAAA972F5F2626263A3939999898AC5EBD5A4A4A0AEAE72BB5B5B5919191341AADAFAF2F252565EFDEBDE3FECF8ECACACAA8A8A8DF7EFB2D29290921B466CD1A4949C9F3E7CF4F90813610D000FC2B222222172F5EACAAAA3237377FF5EA1536A4B8A0A000FB3D1FF775BFA8546A5656565656566F6F2F89445AB56AD5E8698CB007CEDEBE7DDBD9D9696E6E6E6D6D5D5B5B1B1717D7D8D8C8CFCF8F4D4BCDCECEEEE7E7A7ADAD9D9999D9DBDB2B2E2E4E22918A8B8BB1F5C5DFBF7F9F9C9CDCDBDB6B6060B074E9D2AAAAAA376FDE080A0A92C9645757571289141F1F5F5C5CCCC6C6666060A0ADAD6D6F6FAFA1A141A150BCBDBDDBDBDBC731A0DBDADACE9F3F5F5959191D1D8D107276769E3D7BF6EAD5AB252525E1AA868006538A9292D29E3D7BACADADB17F293F7EFC1821D4D4D43473E64C6C859AF1F2E6CD9BC2C2426969694949C99C9C9C9191919F7EFA89F56E7171F193274F040505E5E5E5D3D3D34D4C4C6EDCB8A1ACACACA2A282B5768944A29A9ADAFDFBF767CF9E6D6E6E5E5F5F7FF3E6CDF5EBD72B2B2B8B8A8AE6E4E4848484C8CBCB8B8989C5C7C763ADCEC0C0C055AB56A9AAAA0A0A0ADEBE7D1B8FC72B2B2BF7F6F6262525B1B3B32F5DBAB4BFBF3F2525455E5E5E585878BCAAC5C3C3A3ADAD0D7B14DAC6C606EB9B9A08F387404003F0BDE8E8E8E8E8E8686969B5B6B6AE59B3E6C993274422313F3FDFC2C2E2F0E1C3E355240D0D0D6969693C1E6F6A6AEAE1E1313AA0535353F9F9F9D7AD5B272E2E5E5757C7CDCDBD7AF56A4545452291D8D6D676E9D2A58F1F3F628F72DBDBDB2F5EBCB8B8B838262666C58A152A2A2A783CFED8B163CACACAAB56ADE2E3E31313130B0D0D5DB16285BCBCBC8B8BCBAC59B370389CADADAD989898A8A8288D468B898949484858BA74695C5C5C5555D59A356BC6A51768D7AE5DA5A5A56FDFBE1D1919D1D4D4F4F7F797919151515181AB17021A4C97984608A5A4A4B4B7B7CF993327313131272727343474E7CE9D1B376E1CE3C2707070848686C6C7C7B7B7B7D3E9F4D6D6D6D1EF3637379348244949493C1EAFA0A040A7D33B3A3A366CD8505D5D3D3434D4D2D2C25AC7DDD8D818BBA127242484A53342A8A6A6263838F8F6EDDB585F8A84840442484242024B6784101717D7D9B367DFBF7FDFDFDF4FA552B13948CBCACA646565F5F4F4C6B8FFE7CC99336161619F3E7DA252A944223133339348244EF689AB20A001F827545454984C664B4B4B4646869393534949C9CE9D3B0F1E3CF8F8F1632B2BAB31BB07151E1EDED8D878FEFCF99933670E0C0C9899998D7E9787876760606070709048243299CC9E9E9ED3A74F7B7B7BEBE9E9E170B813274EB096B36285290E8763159E9797F7F4E9D30B162C606767673299ECECECA9A9A9381C8E354EE7C48913464646DBB76FE7E5E54D4949090F0F4708EDD9B3078FC78F4D3A33994C0683111C1CBC6FDFBEBEBE3E1A8DC6C6C6969393232727272A2A0A57E9F70323B5C044C7C6C6262626B66CD9323A9D1E1414242020D0DFDFBF70E1427676F6FCFCFCE6E6E63128039D4E673299381CAEB9B9D9CFCF6FF4BCFB08213333B3828282989898F2F2F2E3C78F33188CE1E1611C0E47A552636363333333FF78E30E0E0E494949050505FDFDFD1F3E7CB879F3E6571F181E1EC606E615171763537D22842E5CB8F0E8D1A33188E6A6A6A6D8D8587676767777F7C1C1412121A19898183A9D6E686808E90C2D6800FE8F8787878787C7C99327A3A2A2C864B2BEBEBE9090506262223F3FFFF7B837452412B1159E1C1D1DEFDCB9B36BD72E6E6E6E17171732993CFA63E6E6E6FDFDFD0F1E3C08080858BD7A353F3FFFEEDDBB6FDCB841A5524D4C4CCCCDCDB1FB786A6A6A5883171B33C9FABAADAD2D83C178F0E0416D6DAD9A9ADAE6CD9B070707656565591F3870E080BFBF7F4848C8AC59B36C6C6CBE7CF98210929696FEDEF9585656D6D3D3636A6A8A10121010505050F0F4F4DCB2650B5C8763D73A4108E9E8E8C0E42660D2D9B163C7C78F1F878686929292F4F4F47C7C7C66CD9AA5AAAA0A35F3EF1514145028944D9B363535356133AB999A9A1E3D7A741CCFF5F5EBD7535252A6C95C1C8B162D7AF5EA15854281163498ACAE5DBB8610EAEDEDDDB973675353D3E2C58B172D5AB462C58A79F3E68D6E9F82BFA5A8A8283737F7D6AD5BD9D9D9CB972F1715150D0C0C846A812E0E00FE093E3EBE5F7FFDF5E3C78F77EFDECDCECEDEB061C38A152BF4F4F4366EDC387A6D75F0A73E7DFA141E1E9E9C9CFCEAD52B4747C703070E787B7B431D424003F06F292A2A9E3B772E2F2F2F3535F5D1A347616161A5A5A5A2A2A2FEFEFE50397FAABBBBFBF8F1E33535352F5FBEB4B1B1B972E58A9D9D9DB2B232D40C043400DF8CBEBEBEBEBEFEECD9B36B6A6AF6EDDBD7D0D0D0DCDC2C272777EEDC39A89CFF65D3A64D5FBE7C898A8AD2D3D37BF2E489BABABAB6B636540B043400DF05B6689E8282426F6FEF82050B787979B3B2B2ECECECF6EDDB079533DADEBD7B737373D3D3D3050404DEBE7D2B2222323556E385800660A23332324208959797979595393939E5E7E7DFBB77EFD0A1436E6E6E5039BEBEBEF7EEDDABAFAFEFEFEFCFC8C8101313830934262618A802A6325555D565CB967574749C3B77AEBABA7AEBD6ADC2C2C2C9C9C9341A6DBA550593C9A4D1688F1F3F1616163E75EA547575754848484747074C6F04010DC0B8C1E3F14242425E5E5E8383837BF7EEE5E3E3B3B3B3231008C5C5C58D8D8DD3A412EAEAEA5EBF7E4D2010366FDECCC7C7E7EFEF3F3838E8E0E0202424F43D160F04DF0A74718069E4F8F1E3C78F1FF7F2F2CACBCBD3D3D31313137BF9F2A59090D04458BDE53B292929C106347273731B1B1BDBD9D99D387102AE0408680026A880800084D0AA55AB5A5B5B67CF9E6D6C6C7CE4C8116CFAE6A97498050505F5F5F5BB76EDFAFCF9B3BDBDBD9C9C1C36B40740400330D1858484B4B7B71F3C78B0B6B6D6C1C161E9D2A50E0E0ED6D6D6D8E41B93BDD59C999979FFFEFD8C8C8CE5CB972F58B020303010BA3220A001984C444444828282C864F2E3C78F535353376DDAE4EAEAAAA1A1F1D34F3F0909094DC623AAA9A979F4E8514646467C7CBC8383C3912347B66EDD0AEB3A4240033059A9AAAA9E3E7D3A2727273B3BFBCE9D3B4F9F3EADA8A8101717F7F3F39B444741A552F7EDDBD7D8D8F8E2C50B4B4BCB1B376E2C58B000A68E828006602A303232323232323030686C6CDCB66D5B5B5B5B6D6DADAAAAEA993367267EE1BDBCBC9A9A9AA2A2A2343434222222141515B1F568000434005387898909428844227576762E5CB8909F9F3F2525E5871F7EF0F6F69E98053E70E0407A7A7A4E4E0E2727676A6AAA8080008C06848006602A333434643018555555B9B9B9AEAEAEC5C5C501010167CE9C717171993885BC72E5CACD9B3729140AB6BCF7CC99336161C0A90706AA00F0DF7E3170384545C51F7FFC115B609042A1787878F0F3F3A7A5A5F5F7F78F57A9180C467F7F7F6868283F3FFFD1A3472914CA83070F7A7A7ACCCDCDA7583A373535F1F3F32F5FBEBCBFBF7F686868F45B542A954C26F3F3F3AF5CB912021A80E90B8FC7F3F1F16DDFBEBDAFAF6FC78E1D626262D6D6D6BCBCBC6432F9F3E7CF4D4D4D635692BABABACF9F3F272727F3F2F262535D9F3B77AEAFAFCFC9C9898F8F6FEA3D4287C3E104040422232379797977EFDEDDD3D383A5F6E7CF9F252525D5D4D4868787050404A6FC15084B5E01F037787A7A96959565656531180C7D7DFDEBD7AF4B49497DD747A72B2A2ADADBDB57AC58D1D8D8482010F4F5F52D2C2C7C7C7CA67C55E7E6E61A1A1AFEAF774D4C4CFE7435DEC90B96BC02E09FB87DFB3642C8C5C5A5B3B333212161CE9C394B972E757777373030209148DF765F6432B9ACACECE2C58B5959590821070787993367FE7ECDEFA94A5050D0CCCC2C2323E3F76FF1F0F05858584C874A80163400FF447373F3A953A73E7EFC9890908010727373333535757676FE262B6DD7D4D4C4C7C7C7C5C5C5C4C420847EF8E1074949497F7F7F2E2EAE6955C9B1B1B14B972EFDFDEB727272D5D5D553F8C0A1050DC0BF222929F9CB2FBF9496963E7BF62C3131313838383838B8A0A0405252F2C48913FFB853B8ABABCBDFDFBFA2A22234341421B464C9126363637777771919996958C9CACACACB962D7BF9F2E5E817D9D9D977EFDE3D4D6A00021A807F4E434343434363D1A245F9F9F9D7AF5F0F0A0AC21AD73367CE3C7AF4E8DFDDDAEEDDBB5B5A5A4242421042E6E6E6AB57AF9E3B77AE8686C6B4AD5E252525070787AF029A838363C78E1D10D00080BFC4D8D8D8D8D8585B5BBBA5A565C3860D414141FCFCFCB9B9B9161616BB76EDFA2B5B3872E4484949495C5CDCF0F0B0B2B2B2AFAFAF9C9C1C8C0644082D58B060CD9A358F1E3D62BD72EFDEBDE973F810D0007C1BA6A6A608A18484842F5FBE2C5EBCF8E5CB97E9E9E9A1A1A1DBB76F5FB56AD5FFFA96BFBF7F5858585959594F4F0F2727676666262F2FAFA6A626D427864422A9A9A98D7E65D1A245D3AB0A7474749800806F844EA757575707070763BF5FC2C2C27272726969695F7D2C2C2C4C4E4E8E9F9F1FFB586262624D4D0DD4DEEF757575AD5FBF1EABA5A4A4A4919191297FC8B6B6B60821B84908C0B787C7E3E5E4E46465659D9C9C0202024E9D3AD5D8D868656585C7E34B4A4A4444448A8A8A6C6D6DE9743A0E872310084F9F3E757070201008DF63BC495F5FDFC8C8C864AF52D6E32B020202BDBDBD93FA580804C2DF7B1A075AD0007C577BF7EE55515119FD6B492412555454FCFCFCBEF7AEF5F4F4E04FE68472E6CC1968410330815CBC78F1E2C58BEEEEEE9F3E7D7AFFFEBD8989898989C9850B17C6AC00F3E6CD83B330EE5A5B5BCBCBCBFFD65720A0011823F7EEDD6330185BB76EBD75EBD618EF3A39391996BC1A77E1E1E12B56ACF85B5F81C99200183B381C6EECD3194CE20B06AA00000020A00100004040030000043400000008680000808006000000010D000000021A0030FE0A0A0A26D4641A656565EDEDEDBF7FBDB6B6B6AEAE0E021A0030C9A4A6A6868484848484848787A7A7A7F7F7F7FFF5EF1E3C78F0D3A74F08A1E7CF9FFFE302F4F7F7BF7EFDFA9B1C8BAFAFEF870F1F7EFF7A6868684444C4B857350CF50600FC3DD8EA885252525856D6D7D7BBBABAFEDD8D1415152D5FBEFC9F158046A39597972F5CB870CA5735043400E06FDBBE7DBB9999D9C0C0404C4C4C484888ABAB2B93C9ACAAAA4A4A4AA25028241269F9F2E58282827575757171714D4D4D7C7C7C565656BABABAFF173DECEC140AE5CA952BAC575C5D5DF5F4F4BABBBB636363CBCBCB3938388C8C8CACACACB8B8B8180C465E5EDEBB77EF7A7A7A2C2C2C747474D8D9D911420C06A3ACAC2C2929A9A3A3435151119BB5D5D7D7D7D8D8383B3B1B21646666666A6ACAC3C3C3DA0B93C96C6E6E8E8E8E6E6C6C545252FAF2E50BF6E2DBB76FD3D2D270389CA9A9E9FCF9F327483D43170700E01FA2D3E95D5D5D04020121545D5D1D1A1ADADCDC2C2323939797171212D2D7D777FDFA753636B659B3660D0E0E464646565656B2BE7BF3E64D0281802DEAC8CFCF5F5E5EDED6D686BDDED6D6A6A0A0C0C7C7F7DB6FBFA5A6A622840A0B0B9F3C793234343473E6CC77EFDE757777638B607DFAF4293434B4ADAD4D4A4A2A3939392C2C8C4AA55EBE7C392525454A4A0A87C33D7BF6ACB0B07074997B7A7AC2C2C20A0B0BA5A5A5C964F2C78F1F1142C9C9C9C1C1C1E2E2E27C7C7C515151E9E9E9D08206004C56DEDEDE828282C3C3C39C9C9C870F1F4608E5E7E7F7F5F5797A7A9248A4929292DDBB776FD8B0C1C5C5454545854824B6B5B5F9FBFB8F0E6884909090D0DAB56BBBBBBB232222962E5D6A60608010B2B3B39B3973A6B0B030954A7DF6EC597272B2B5B5F59B376FC4C4C4D6AD5B272A2A5A5B5B3BBA9F844AA56EDDBA554646465D5DFDF4E9D3CB962DE3E5E5757171515353EBE9E9F1F1F1F9F8F123B61A19A6A3A3233D3D7DDFBE7DDADADA15151599999908A1070F1ED8D8D83839390D0D0D3D7DFA34212181B5D20D0434006092D9BA75ABB6B6767575F59D3B773838381042ADADAD8F1E3D7AF5EA150E871B1E1EC6EE0462915D5D5D3D3434F4E5CB177575F5AFB6333434949C9CDCDCDCBC7EFD7A61616184100F0FCFB163C7F2F3F30707077B7B7B172C5880106A6A6A323030101717C7E3F18A8A8A353535D8D73B3B3B7979794924123B3BBBB1B17143430393C9E4E6E6D6D4D4C4E3F1222222442271686868F41E070707BBBABAB4B5B5393939555454B09E7432999C959575F9F2650683D1DDDD6D616101010D0098AC141515757575353434F8F8F82E5FBEFCE0C1030281E0E6E6B679F3666E6E6E56F89E387162E7CE9DFAFAFA381CCEC7C787C9648EDE0893C92C2C2C4C4D4DF5F0F0909696C65EDCBF7FBFADADEDDEBD7B0904427C7C3CD6C2E5E1E1A152A9C3C3C3783C7EF416383939E9743A954AE5E7E76F6F6F67F535631FC3A6C0FE6AA7783C9E9393B3BBBB5B4C4CACAFAF6F60600021C4CFCF7FEEDC39D6EAB4DCDCDC81818113A19EA10F1A00F00F717070686969898888242525E9E9E90D0E0E26262652A9D4FAFAFAD3A74FD3E9F4C1C1414E4ECEE1E1E1D7AF5FFFBE63B7BEBEFEF6EDDBA6A6A64242422D2D2D83838308A18181017676763C1E5F5858181212827D72DEBC79A9A9A9BFFDF65B6565E5F1E3C7595B5053536B6D6D8D8888282B2B3B7BF6AC8D8D0D76F3F00F080909A9AAAADEB871A3BCBCFCC18307D83376EBD7AFBF75EB565353D3C0C000D6973D416A185AD00080BF474E4E8E4824623F0B08082C58B0A0AAAA6AF1E2C56BD6ACF9F5D75FEFDDBB272222B27EFD7A3E3EBE9F7FFEF9EAD5ABFDFDFD26262673E7CE151212929797C79AD8EAEAEA838383D9D9D9D8E31608A1B367CF2E5EBCF8F4E9D3BEBEBE414141CACACA565656743A1D21B460C1022A957AFFFEFDF6F6F68D1B377272722A29292184F4F5F55D5C5C828282EEDEBD6B6464B47BF76E0281A0AAAACA2AAA9494948888C8E8C28B8A8A7A7A7A5EBC78D1D3D3D3D4D474CE9C397C7C7CD8137B070F1EECEDED353636DEB871636E6EEE57ADF571C18610D2D1D129282880CB0E80A9475F5F3F3F3F9FC160C09257E30E5BF2EACC9933D86DD53FB068D1A257AF5E512814E8E2000080090A021A000020A00100004040030000043400004C35090909B76FDF868006004C56EDEDED7BF7EE3531313137373F7EFC785555D53FD8484646C6A14387FEEB5B6565655BB76EFDD32DF4F7F70707072F59B2C4D0D070E5CA95C9C9C97F71D70F1F3EBC7BF7EE7F7D8B42A16073748C3B780E1A00F04FFCFCF3CF929292C1C1C16C6C6C898989A9A9A94A4A4A4C2693C16030994C363636EC3962EC15EC073C1ECF7ADA6F64640487C3191A1A6A686860AFB0BE8BC3E170389C9292928F8FCF576FB136CBF2E2C58B9494949D3B77AAA9A95555550507075B58588CFE3C0E8763ED94C160604F1CE270B81F7FFC9135C8107B1D2184ED1ABA380000935B7676F6A64D9BE4E5E5151515B76CD9B261C386C1C1C1C78F1FDBD8D8A8A9A9AD58B1A2BEBE1E21949C9C6C6060B07AF56A5151D15F7FFD15CB411A8D666262525D5D9D9C9CBC63C70E8410954ABD73E78E8585859696D6D9B36711424545456E6E6E581BF9EEDDBBF3E6CDD3D0D0707373C336CB525B5BABAEAE3E77EEDC9933675A5959DDBD7B776464243B3BFB871F7ED0D0D0B0B3B38B8B8BA3D16808A1CECECEEDDBB7EBE8E8D8D8D8C4C4C4040606DEB8710321545959B97BF76E1D1D1D3535352F2FAFC6C646086800C0E4B670E1C2AB57AF262525151717532894919191376FDEA4A5A51D3F7E3C2F2F6FF6ECD9A74F9FC63E49A3D19C9C9C7C7C7C28140A36FF727C7CBC828282BCBC3C6B6B717171393939BEBEBEEFDFBFFF6AEC5F7272F2FBF7EFCF9E3D9B999929272787C5378BAAAA2A994C0E0B0BCBC9C9F9F8F1238D466B6B6BBB7DFBF6C2850B333333DDDDDD232323C9643242C8D7D7178FC72727270704048C6E868787872F5CB8F0FDFBF7E9E9E952525241414113A792A18B0300F04F1C3B762C3838F8E1C3870303032A2A2A2B57AE2C2E2E663299EDEDEDA9A9A932323277EEDCC13EA9AEAEBE64C992EAEAEA5F7EF9A5BABA5A4444243838D8C3C363F4D68A8B8B8D8C8CF4F5F5B9B8B8BCBCBC46BF555959A9ACAC6C6C6CCCCDCDBD63C70E4B4BCBD1EFDAD9D9717373C7C7C74745451189446767674D4DCDBABA3A5F5F5F6161E1254B96BC7DFB96F557212A2A4A4C4C4C4C4C4C4545A5A2A202DBC2CE9D3B2B2B2B33323286878785848452525214141420A001009398A0A0E0F6EDDB7FFAE9A7868686A0A0A0C8C8481C0E57565686CD39C76030ECECECB04F727171F1F0F0282B2BF3F1F195969622849A9B9BBF5AB5647878189B23E9F73B1A1919616767C76641E2E6E6FE6AFA506E6E6E3B3B3B3B3B3B2A959A9090E0E3E3131212323232C2C5C58510C2A64265F5ABB066DA1B2D3A3A3A3D3D7D707090C160B4B6B60E0F0F430B1A0030B9C5C5C5696868484B4B737171F1F2F2F6F7F7ABAAAA5A5A5ABABABA2A2929F5F4F4B06641C2707070989B9B4747472727272F5EBC78F4325408217979F9AAAAAACF9F3FCBC8C86467678F8E6F6969E9BCBCBCAAAA2A1289141515A5A5A535FA8BA5A5A5542A554D4D8D9D9D5D4444647070904020888989A5A4A4CC9F3F1F9B874450501021646C6CFCFCF9F3D5AB57F7F7F7B7B6B6B2B6101515656262E2E6E6363C3CFCE0C183A4A424086800C0E456575797929232383848A7D3B9B8B81C1D1DE5E5E5DBDBDBB13E5C76767669696956231A636262F2E8D1A39C9C9C9F7FFEF9ABAD2D58B08042A1F8FBFB1308046161E1D1016D6666F6F9F3E72B57AE7071717574747CF5EC5D6767E7EBD7AFB156737F7FFFD6AD5B8584841C1C1CC2C2C2E2E3E3FBFBFB0D0D0D1515151142DBB66D0B0808282D2D251008262626AC2D989B9B7FF8F0A1AAAA8A9393B3A7A767425532043400E09F58BE7C796969694747071717979C9C9C929212171797B3B333994CEEE8E8E0E1E1C19ABA1A1A1AD8731A0821111191DDBB77B7B6B6B26604D5D6D61610104008C9C9C9B9B9B991C9E4C1C141151515AC4DBD7FFF7E841089445AB3660D994CA652A9525252D8CA582C3A3A3A4422B1BEBE9E4EA78B8888E8EBEBF3F0F02C59B264C68C19EDEDED0202029A9A9AD85D474343C36DDBB6D5D5D56165D3D4D4C4BA3E5C5C5C5455553B3A3A787979A5A5A5BBBABA64656547AF6F3B8E60BA5100A632986E74E280E946010060EA8080060000086800000010D00080EFA7B2B2B2B7B7F7DF6C212F2FEF3B956D6464A4B0B0706CEAA1AAAAEA5FD6C39F82A73800007FCF810307F6EEDD6B666686FD6F7B7B7B5A5ADA579F59B870E17F1D158259BA74696363E39FDEB7FCF2E50B8542F95B0F5450A9546767E7CACACA3FFED8F0F070434343757535954A251289B366CD929595FDBBD3241D3E7C78DBB66DF3E6CD838006004C509D9D9D71717108A10F1F3EF0F2F2628FD0999B9BFF4140FF452D2D2D454545DFFC89373A9D9E9F9FFFF2E5CBAEAE2E0683C1C5C5252A2ABA7BF76ED652E51307043400D35A4040C0FAF5EBB9B9B9994C667171715B5B9BB9B93936429AD5264D4A4A2293C94422D1DCDC5C5D5DFDAB2D282A2A06060622848E1E3D4A22913C3C3CEEDCB9535454545050C0C5C5E5E9E9595959999696D6DEDE2E222262636343229110422929291F3E7CE0E2E2323333D3D3D3A3D168D9D9D9F9F9F9542A55565676F9F2E53C3CFFAFBD7B8F6AE2CCFB00FE842443122E15C22D180C374D01255514F182609572F102546D5DB5EED6566C6B5B51CF1E41B42D56ACD6636B61A5A76C57574540C4DA15975304C185EA7259E5DA82A22D50211220208418C8EDFD63F6A4BCACDDEDAEA8237C3F7F8599F0CC6F1ECEF9E6E1C9CC3C021E8F676363430831180CD7AF5FFFFBDFFFAE56ABE967D40DBF29DC6030545656969595E9743AD37D861D1D1D972F5F6E6E6EB6B7B70F0909118BC5A6017B4747475E5E9E8D8DCD5B6FBD656F6FDFDBDB5B5E5ECE66B3070606D2D2D2BCBDBD6B6B6BA74F9F3E6FDE3C53491289243A3A9ACFE7CBE5F28282828E8E0E4F4FCFEEEE6E7A52253F3FBFAEAE8ECFE7CF9933C7CFCF6F141F588A39688071ADA4A4A4A4A48410A252A9AE5EBD5A5F5F3F7CE6C160305CB87021373797CBE5CAE5F2B367CFDEBE7DFB3FB699969676E2C4092E976B6363D3D2D2929595353838686969D9D8D8989595A5542A0921A74F9FA628AAB3B3332B2BEBBBEFBE2B2C2CBC72E50A87C3B1B4B4BC7CF9724E4E0E21E4E6CD9B5F7FFD3521A4A6A626232343A9545214959999999F9F3FFC70353535999999BDBDBD5C2E3733339310A2542ACF9D3B575656C6E3F1EAEBEBCF9C39431F94D6DEDEDED6D6B672E5CA8913275214E5E0E0B06CD9321E8FA752A9F6EDDBF7B7BFFDCDC2C2C2C2C2627849C5C5C5393939BDBDBD3939391515151445555454FCF8E38F84908B172F6666665214D5DBDB7BEAD4A9D1BDA704236880716DE3C68DA9A9A98B171DD3C0180000135E494441542FEEE8E8502A95F3E7CFA71F4B649A0D3879F2E4BBEFBE1B1818D8D9D979E4C8915FF915DCC2850B57AD5AC5E3F17A7A7A962F5F2E954AF97C7E4B4BCBAE5DBBBABABA08214B962C090909E9ECEC3C76EC58494949484888542A9D34691287C3A9AEAEDEB163C7FAF5EB4DAD1517170B85C2575F7D552814E6E6E67EF9E597111111A6BD8585852291E8B7BFFDAD8D8D4D4E4ECE952B57EEDCB9535959B969D326994C76FBF6ED7DFBF6858585999E62AA56AB351ACDC489130921292929F4222CF4EA2AD6D6D65151513366CCE07038376FDE1C5E525C5C9CBFBF7F7979796C6CACAFAF6F5D5D1DFDC176ECD8B1152B564445452995CA3FFFF9CF8585853366CC404003C028983367CEE79F7F5E5959A9D7EB552AD588095F83C1505A5AAA5028288AD2EBF56D6D6D6E6E6EBFA6D9B973E7F2783C420845513FFDF4D3A14387DADBDBB55A6D5353535C5C1C9DE0E6E6E62291482C16DFBA75CBCACA2A2B2BABB8B8B8A7A747A7D3DDBD7B77786B6D6D6D7E7E7E8E8E8E6C367BE1C285BB77EF1EBEF7CE9D3BF3E7CF7770703033335BB468516262A24AA5CACBCBFBFEFBEF391C8E4EA7BB75EBD6D6AD5B7F9E373033333333D36AB55C2E372C2CCCCFCFEF77BFFB9D46A361B158969696743A13428697A4D56A150A855AAD56A95432998CA2A869D3A639393911421A1B1B838282CCCDCD1D1C1C3C3D3D4B4B4B31820680D1C1E3F156AF5E9D9696161111219148ACACAC86EF65B158AEAEAE7FF8C31F844221BD4094BDBDFD88198607A2288A7ED1D0D0909595B56EDD3A4F4F4F83C1B069D326BA9DEEEE6E0B0B8BA1A121FAF97359595972B99C5E464BA5522D5FBE7C4491F7EFDFA71F64DADDDD6D6969397C2F9FCF57ABD55AADD6DCDC9C9E1766B3D973E7CEDDBD7BB7B5B5357D38B1586C7AFF33CF3C43CFB7CC983163F2E4C993274F367D3DC862B14CFF400C2FA9BFBF3F323292CD6673B9DCFEFE7EA150A852A9E8855AACACAC944AA59393934EA71B1818A03F96460BE6A001C635168B151818D8D2D2525050B060C1821197BEB1D9ECE8E8E88C8C0C420897CB2D2C2CBC76EDDA7FD5FED0D0905AADB6B3B3130804DF7CF34D737333BD3D3131B1B5B5F5DB6FBFADA8A8983973667F7F3F8BC5727272321A8D696969A6D50269B366CD2A2929B97AF56A7373F3071F7CF0E28B2F0EDF3B7BF6ECE2E2E2F2F2F2969696C4C4444288B3B3B387874741410197CB35180C19191972B9DCF47E3737B7679F7DF6F0E1C3E5E5E55D5D5D959595434343FF7ACD5F5F5F9FA9247A916FA1502812898E1E3DDAD2D272F2E4C9DADA5A42C8F2E5CBF7EEDDDBDCDC5C565656585838FC3979184103C0C3B2B2B28A8A8AFAEEBBEF4C0F99FB3920389CAD5BB7A6A4A4AC5DBBD660308485858585858944A2078E136D6D6DADADADE9E1AA691CFAECB3CF2E5EBC78CB962DF423FCA74E9D4A3FFDCED7D777E5CA951616161B376E0C0909F1F0F048494959B162859595D5FAF5EBEBEAEA4C9F1F8490A54B97AA54AABD7BF72A95CAF0F0F06DDBB60D3FEEB265CB7A7B7B131212060707D7AE5DDBD3D3E3E2E2121313F3F9E79F4747470B0482975F7E99BE1AC474BEEBD6ADB3B0B04848485028141289E4FDF7DFB7B1B1E9EBEB73717131BDED37BFF9CDF092EAEBEB274E9CB871E3C68F3EFA283333332828E8B9E79EE3F3F9B1B1B149494951515113264C78F5D557972D5B36CA7F1E994C660480B168FAF4E9F454F2BF798F52A94C4C4CFCFAEBAF1955B94EA73B7BF62C3D2532366467671342F6EEDDFB1FDF191A1A4A0891CBE51841038C6BB9B9B9F45AAECF3FFF3CA30AEBEAEA2A2F2F67CEF2804F04021A605CFBF6DB6F8D46E36BAFBD36E2EBC1276E686868C28409A33F6380800680A7C58103079859988B8B4B7C7CFC38FFEBE02A0E00000434000020A0010010D00000808006004040030000021A000010D00000086800001815B8931060ECDBB973E77F5C421B1EB5C6C6460434008CB47FFF7E740246D000C02CC9C9C97D7D7D4FFB597CF1C517E7CF9F3F70E0C0D4A9539FF673914AA5086800208490F9F3E78F81B3F8E69B6F08210101010B162C18577F3E7C490800808006000004340000021A000010D00000086800004040030000021A0000010D0000086800189B3A3A3A6432D9DB6FBFFDC0BDEDEDED32992C363676CCF7036EF50600C6D1E974757575376EDC3873E6CC962D5BE88D46A3D168344E9932A5A7A7A7BBBBDBDDDD1D010D00F0B84D9C38B1B2B272E6CC990A8522212181DE181C1C6C7A434040C0B973E7C67C3F608A030098482010FCD21899A2A82953A68C874E40400300137979792527273F7097B3B3F3F1E3C711D000004F8C582C9E376FDE888D6C367BE5CA95E3A40710D000C05032996CC3860D2336521475F0E041043400C013367BF6EC888888E15B121313C7CFE923A00180B97C7C7C46CC72C4C4C420A001001861EDDAB5D1D1D1F4EBE3C78F5B585820A001001841229188C562FAF5ECD9B3399C7174F7066E5401805FE5F8F1E3DBB66D7B228756ABD5A68066B3D98FBF80A6A6265B5B5B043400309446A3512A953636369696968FF9D04F705AA3B3B353A3D1188D468CA00180E9929292DE7CF3CDF173BE8B172FBE74E9D2933A3AE6A00100180A010D00808006000004340000021A000010D00000086800004040030000021A009E1246A3B1B5B515FD40702721008CAEC1C1C1B6B636A552693018ACADAD9D9D9DADADADFFAB16F47AFDDCB973EFDCB9F3BF15A0D1686EDFBEEDE3E383800600F87FE178F1E2C5A2A2A2BB77EF1A0C064747C7E0E0E0152B563CCE1A7A7A7A32323292929210D000003FABAAAABA70E1425858D8A2458B783CDE8D1B375A5A5A0821B5B5B56D6D6D0683412E97474545999B9B979494DCBD7B97CBE54E9D3A75DAB4696C36BBA1A1A1BABA5AA7D379797911423A3B3BFFF18F7F848787D32D1714144C9D3A552412DDBB77AFB4B4B4A3A383A2A869D3A6F9F8F870389C1B376ED4D4D4A8D56A3F3F3F8944E2EFEF4FFF96C160B879F3667575B55AAD964824414141FDFDFDF9F9F92E2E2E4D4D4D1C0EE7B9E79E934AA55C2E17010D00635C7171F1F4E9D3434242ACACAC0821BEBEBEBEBEBE8490A2A2A2AFBEFA2A383898C3E1E874BAF4F474B55AADD56AFBFBFBEBEBEB09210281203D3D5DA3D1585B5B97979713425A5B5B8F1C39620AE82FBFFC72F3E6CD2291E88F7FFCE3E0E0A04EA7BB77EFDEF7DF7FBF7AF56A8AA2D2D3D38786862C2C2CE472F9AA55AB0E1D3A1419194908B975EBD6A953A70606060402C1A54B97F47ABD582C8E8B8B5BB76E1D87C3512814D5D5D56FBEF9A6878707021A00C6B8F6F6762F2F2FFAE9A06FBFFDB65EAF974AA5B1B1B18490499326BDF2CA2B1E1E1E6666666E6E6EFEFEFEF6F6F64AA5F2C48913A5A5A55C2E97A2A84D9B36393A3AE6E4E49C3F7FFE970EE1E9E9191010606767D7D5D575F4E8D1B2B2328D464351544C4C8C9393536D6DEDF037979696EAF5FACD9B373B3B3BFFE52F7F494D4DDDB76F9FB5B5F5B265CB6432995C2E4F4848686D6D454003C0D8C766B3F57A3DFDF4E4909090D6D6D673E7CED101EDE5E5E5EEEE6E66664608F1F1F1F9ECB3CF9A9B9B070707EFDCB913121262341AA552A9582CE670384B972E8D8F8FFFA54348A5D24F3EF9A4A5A5657070B0B5B5353A3ABABBBB3B2020402C16B3D9EC59B36635353599DEDCD6D63669D2248944C2E170962C599290904008110A857E7E7E1C0E4722915014353434C4D8FE444003C0A87175756D6D6DEDEBEBB3B1B1898C8C6C68683877EEDC3FB386C3312D86121717B770E1C2D0D0502E977BE1C2059D4EC7E7F3B55AAD4EA7E370387D7D7D8410168B4508D16AB55C2E57A3D168B55AFA77E3E3E3434343232222D86CF6575F7DA5D7EBCDCDCDE9498F7F5D6C85CBE56AB55AAD564B37CBE3F10821666666F4BA59F4A70593E13A680018354B962C292F2FCFC8C8E8EAEABA7FFFFE880907938686063737B759B366190C866BD7AE11427C7D7DCBCBCB6B6A6ABABBBB3FFAE82342088FC7331A8D454545BDBDBD595959A6A61A1A1ADCDDDDFDFCFC868686AAABAB09213367CEBC7CF9725555D5BD7BF73EFDF4D3E107F2F6F6AEAAAAAAACACA49B0D0D0D7DBAFA13236800183593274F7EFFFDF75352529293930D06434040C09E3D7B082114450D5F35EAE0C183BB77EFEEEAEA92C964AEAEAE3C1E6FE9D2A55D5D5D6FBDF5D6FDFBF7D7AE5D6B6565E5EAEABA7AF5EAF8F8F8818181D0D0506767677A80BC7FFFFEB8B8B89E9E9E1933664824127373F3C8C848954AB575EB56A552F9EEBBEF9A9999090402FA406161613D3D3D3B76ECE8ECEC5CB060415252925C2E37ED2584F0F97C26AF42CB2284C86432FA830800E0977CF1C5176FBCF1466A6AEA385CF2AAABAB4B28143EB683868585E5E7E7CBE5724C7100003014021A0000010D0000086800000434000020A0010010D00000808006000004340000021A000010D000000868000078ECF0343B00F82F1415150D0E0E8E9FF36D6D6D454003C0D321272727272707FD8080060006090E0E3E76ECD84336F2C9279FD4D5D51D3E7CF899679EF9F5BF75EAD4A9C2C2C2B8B838A954FA44CEDDD2D212010D00CC25954A1F3E1F4F9F3E5D5757F7D24B2F8944A25FFF5BD7AF5F2F2C2C0C0F0F5FB060C1B8EA737C490800808006000004340000021A0060F469B5DADADADAE6E6E607EE1D1A1AAAADAD6D6969414003003C6E0A85422693BDFCF2CB050505B76EDD1ABEABB8B8F8F4E9D332992C363676CCF703AEE20000C61108041111117979792FBCF0C2F2E5CB351A0D21E4E2C58B2D2D2D6FBCF1865AADB6B3B30B0A0A424003003C6E3636367BF6ECC9CBCB23849C3F7F9EDE989494647A83A7A7E7781841638A030098482C16BFF6DA6B0FDC656B6BFBCE3BEF8C874E4040030013393A3A4647473F7097B5B5F59A356B10D000004FCCECD9B3B76FDF3E62234551E9E9E9E3A40710D000C050767676DEDEDE2336B2D9EC79F3E621A001009EB0356BD6ECDCB973F896FAFAFAF173FA086800602E1E8FE7E4E464616141FFE8E0E0606F6F8F800600608477DE7967C3860DF4EB9292122B2BABF173EEB80E1A001EA1EEEEEE8A8A0AD38F9D9D9D8490A2A2225B5BDB5FDF88E9AEEE9292921F7EF8E161EAB1B4B40C0C0C444003C0B8363838989191D1D8D8F8F1C71F8FD8B56EDDBAFFADCD98989887ACCAD9D979EFDEBDEEEEEE4FC58D880868007824F6EFDFFFC1071F1042BCBDBD2323239950D2FDFBF70F1F3EBC61C306994C76E8D0A1458B1621A00160DC494C4CFCF0C30F1D1D1DE3E3E3A5526958581813AAD26834AEAEAE4D4D4D478E1CF9FDEF7F7FF0E041866734021A0046594242C2E1C387F97CFEB163C7C2C3C39953188FC7DBB2658B42A13033334B4949D9BE7D7B7272329397D1C2551C00309A76EEDC999292A256AB7373731995CE260E0E0EBB76EDDABC79734D4DCDA64D9B2A2B2B11D00030F6BDF7DE7B292929FDFDFD4545454CFE16CEC1C161CF9E3DAFBFFE7A6363E38A152B1A1B1B995927A638006074E874BAB6B636954A75E9D2A5A0A020168BC5E46A6D6D6D939393070606323333FBFBFB8D4623030BC6081A0046476262E2D1A347EDEDED8542A199D953902D7C3E5F2412F1F97C7F7FFF8E8E0E065688800680D1F4A73FFD4926933D2DD51E3A7468E3C68D0281A0AAAA8A81E5618A030046C18F3FFE78F3E6CD5169CA6834E6E6E69A7E9C32658A4EA7B3B5B57576767E14957FF6D96725252511111146A311010D0063505E5E5E7676766060A0442279C8A6F47AFD9A356B4C8FE48F8888D068349E9E9E8F28A0990C010D00A366FDFAF5BEBEBE0FDFCE840913D2D2D24C3FE6E7E70B040242486A6AEAF4E9D32B2A2A060707BDBCBC828282ACADADC7707F620E1A001E565555557676F6A36BFFAF7FFD2BFD18E8E4E4E48C8C0C168BA5D3E92E5CB850585888113400C0BF73FBF6ED929292D5AB578FD69DD34AA572E5CA95F4EB175F7C71F8AED0D0D0C58B176BB5DA93274F5EBD7A75C45E043400C003F8F8F8B8B9B98D4A53969696B1B1B1F46B171797B2B232D3AE3973E6F0783C737373914854575787113400C0634551D4FCF9F31F9C591C0E2184C562B1582C065E7731BA30070D0080800680314DA954F6F5F53D7C3B2C166BC4B57A7676769696968410171717D33D8A161616637E7D424C7100C0C3120A85EEEEEE9F7EFAA9B7B7F7EBAFBFFE90ADB1D9EC2B57AE0CDFF2DE7BEFD12F0A0A0A4C1B43424242424230820600F877162E5CB86DDB36F403021A0098EBF2E5CBCDCDCDE8070434003088BFBF7F5050D0A953A7C6FCA56F08680078CACC9A352B3030F069AC3C3939F9A79F7EFAD7A5C711D00030D62425253535353D45E99C9494D4DDDDFDCA2BAF30B03C5CC50100A3232626A6B6B6F6FCF9F3BDBDBD4F4BCDD7AF5F572814274E9C100A85184103C098E5E2E2E2E0E04008898C8C6C6F6F677EC1070E1C387BF62C2164DAB4695C2E17010D0063596A6AEAAA55AB140A85BBBB7B77773763EBD46AB51F7FFCF1AE5DBB0C06435E5EDEA83C2215010D008CC6E572B3B3B3A3A3A3F57ABD878707332FB953ABD52929293B76ECB0B1B1494F4F0F0F0F67EC0A8A988306805176E6CC99975E7A292727273838F8C489134C2BEFFAF5EBDBB76F178BC5070E1C888E8E66724F22A00160F4656767AF5AB52A27272728288881E54D9A34E9C30F3F34ADAA85800680F1E5F8F1E322918899B5F9F9F9AD5FBF9EF97D8880068047422010242727A31F1E06BE2404004040030000021A0000010D0000086800000434000020A0010000010D00808006000004340000021A00001E3B0E21E4871F7E080B0B435F000030C1B56BD7FEF9EAD2A54BE80E000046397DFAB456AB65E9F57A854281EE0000600E3B3B3B0E87F37FE2DA63CB3C346CF30000000049454E44AE426082,'Procesos Generales','<p>Este es un registro de prueba, para que pueda observar como lucen los procesos. Borrelo cuando le sea posible.</p>',NULL);
/*!40000 ALTER TABLE `procesos` ENABLE KEYS */;


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='tabla de requisitos de graduacion';

--
-- Dumping data for table `requisito`
--

/*!40000 ALTER TABLE `requisito` DISABLE KEYS */;
/*!40000 ALTER TABLE `requisito` ENABLE KEYS */;


--
-- Definition of table `servsocial`
--

DROP TABLE IF EXISTS `servsocial`;
CREATE TABLE `servsocial` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `descripcion` text NOT NULL,
  `duracion` varchar(200) NOT NULL,
  `total_horas` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servsocial`
--

/*!40000 ALTER TABLE `servsocial` DISABLE KEYS */;
INSERT INTO `servsocial` (`id`,`nombre`,`descripcion`,`duracion`,`total_horas`) VALUES 
 (1,'Servicio Social de Prueba','<p>Este es un servicio social de prueba para que pueda observar como luciran una vez agregados. Borrelo cuando le sea posible.</p>','Seis meses',250);
/*!40000 ALTER TABLE `servsocial` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `clave` varchar(50) default NULL,
  `nombre` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`clave`,`nombre`) VALUES 
 (0,'21232f297a57a5a743894a0e4a801fc3','admin'),
 (1,'5f4dcc3b5aa765d61d8327deb882cf99','docente'),
 (2,'5f4dcc3b5aa765d61d8327deb882cf99','docente2');
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utileria`
--

/*!40000 ALTER TABLE `utileria` DISABLE KEYS */;
INSERT INTO `utileria` (`id`,`titulo`,`vinculo`,`descripcion`) VALUES 
 (1,'Prueba','www.prueba.com','<p>Este es un registro de prueba, para que pueda observar como lucen los programas de utileria. Borrelo cuando le sea posible.</p>');
/*!40000 ALTER TABLE `utileria` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
