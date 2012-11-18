--
-- SQL, которые надо выполнить движку при активации плагина админом. Вызывается на исполнение ВРУЧНУЮ в /plugins/PluginAbcplugin.class.php в методе Activate()
-- Например:

-- CREATE TABLE IF NOT EXISTS `prefix_tablename` (
--  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
--  `page_pid` int(11) unsigned DEFAULT NULL,
--  PRIMARY KEY (`page_id`),
--  KEY `page_pid` (`page_pid`),
-- ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_setmebold` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`string` TEXT NOT NULL COMMENT  'string to find and replace',
`bold` BOOLEAN NOT NULL COMMENT  'set bold or not',
`reference` TEXT NOT NULL ,
`number` INT NOT NULL DEFAULT '0' COMMENT  'how much to select string'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `prefix_setmebold` (`id`, `string`, `bold`, `reference`, `number`) VALUES ('1', 'Наш сайт', '1', '/', '0');
