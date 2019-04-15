CREATE TABLE IF NOT EXISTS `coms` (
  `nodeid` varchar(12) DEFAULT NULL,
  `comtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comuser` varchar(500) DEFAULT NULL,
  `compost` varchar(6000) DEFAULT NULL,
  `comip` varchar(500) DEFAULT NULL,
  `comurl` varchar(500) DEFAULT NULL,
  `comcredit` int(11) DEFAULT '0',
  `comcode` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  UNIQUE KEY `comcode` (`comcode`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nodeid` varchar(12) DEFAULT NULL,
  `vip` int(11) DEFAULT '0',
  `nodecode` varchar(500) DEFAULT NULL,
  `nodename` varchar(500) DEFAULT NULL,
  `nodedesc` varchar(500) DEFAULT NULL,
  `nodeusers` int(11) DEFAULT '0',
  `orgtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uptime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nodeip` varchar(500) DEFAULT NULL,
  UNIQUE KEY `nodeid` (`nodeid`),
  KEY `id` (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `replies` (
  `nodeid` varchar(12) DEFAULT NULL,
  `comtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comuser` varchar(500) DEFAULT NULL,
  `compost` varchar(1000) DEFAULT NULL,
  `comip` varchar(500) DEFAULT NULL,
  `comcredit` int(11) DEFAULT '0',
  `comnum` int(11) DEFAULT NULL,
  `comcode` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `comcode` (`comcode`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charname` varchar(50) DEFAULT NULL,
  `charid` varchar(100) DEFAULT NULL,
  `charemail` varchar(50) DEFAULT NULL,
  `charimage` varchar(500) DEFAULT 'default.png',
  `bio` varchar(135) DEFAULT NULL,
  `twitchurl` varchar(500) DEFAULT NULL,
  `yturl` varchar(500) DEFAULT NULL,
  `twiturl` varchar(500) DEFAULT NULL,
  `gaburl` varchar(500) DEFAULT NULL,
  `mindsurl` varchar(500) DEFAULT NULL,
  `facebookurl` varchar(500) DEFAULT NULL,
  `discordurl` varchar(500) DEFAULT NULL,
  `redditurl` varchar(500) DEFAULT NULL,
  `periscopeurl` varchar(500) DEFAULT NULL,
  `instagramurl` varchar(500) DEFAULT NULL,
  `patreonurl` varchar(500) DEFAULT NULL,
  `paypalurl` varchar(500) DEFAULT NULL,
  `personalurl` varchar(500) DEFAULT NULL,
  `following` varchar(5000) DEFAULT 'id = 1',
  `chartimer1` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chartimer2` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `chartimer3` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `chartimer4` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `currency` int(11) DEFAULT '100',
  `experience` int(11) DEFAULT '0',
  UNIQUE KEY `charname` (`charname`),
  KEY `id` (`id`)
) ENGINE=InnoDB;