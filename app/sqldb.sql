use trip_planner;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
   `id` int(11) NOT NULL auto_increment,
   `email` VARCHAR(200),
   `password` VARCHAR(50),
   `created` DATETIME DEFAULT NULL,
   `modified` DATETIME DEFAULT NULL,
   `lastlogin` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `trip_planner`.`admins` VALUES (1, 'tours@pantrypan.com', '77c87b93dc113f501cebe27c81a014124035788f', '2013-03-24 00:00:00', '2013-03-24 00:00:00', '');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(10),
  `created` datetime,
  `modified` datetime,
  `lastlogin` datetime,
  `first_name` varchar(100),
  `last_name` varchar(100),
  `middle_name` varchar(100),
  `email` varchar(200),
  `password` varchar(42),
  `verified` boolean,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
)ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles`(
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `about_me` varchar(1000),
  `sex` varchar(6),
  `phone` varchar(20),
  `zone_id` int(11),
  `languages` varchar(200),
  `image` varchar(200),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`(
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `work_number` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar (200),
  `address` varchar(2000),
  `description` text,
  `what_to_take` text,
  `duration` bigint,
  `duration_type` int(1),
  `price_low` bigint,
  `price_high` bigint,
  `per_person` boolean,
  `from_people_range` int(11),
  `to_people_range` int(11),
  `url` varchar(200),
  `external_url` varchar(200),
  `category_id` int(11) NOT NULL,
  `show` boolean,
   PRIMARY KEY (`id`),
   UNIQUE KEY `url` (`url`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `itineraries`;
CREATE TABLE `itineraries` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `activity` varchar(10000),
  `time` int(11),
   PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `lat` varchar(200),
  `long` varchar(200),
   PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `booking_date` date,
  `created` datetime default NULL,
  `modified` datetime default NULL,
   PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `airports`;
CREATE TABLE `airports` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `icao_code` varchar(10),
  `iata_code` varchar(10),
  `airport_name` varchar(100),
  `city_town` varchar(100),
  `country` varchar(1000),
   PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `flights`;
CREATE TABLE `flights` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `carrier` varchar(250),
  `flight` varchar(10),
  `city_departing` varchar(100), 
  `datetime_departing` varchar(100), 
  `city_ariving` varchar(100), 
  `datetime_ariving` varchar(100),
  `aircraft_type` varchar(10),
  `cabin` varchar(250),
  `miles` varchar(100),
  `meals` varchar(2500),
  `travel_time` varchar(100),
   PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(200),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `trip_planner`.`categories` VALUES (NULL, 'Restaurant'),(NULL, 'Hotel'),(NULL, 'Car Rental'),(NULL, 'Giftshop'),(NULL, 'Tour');

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `name` varchar(200),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `products_sub_categories`;
CREATE TABLE `products_sub_categories` (
    `id` int(11) unsigned NOT NULL auto_increment,
	`product_id` int(11) NOT NULL,
	`sub_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `my_trips`;
CREATE TABLE `my_trips` (
    `id` int(11) unsigned NOT NULL auto_increment,
	`product_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `schedulers`;
CREATE TABLE `schedulers` (
    `id` int(11) unsigned NOT NULL auto_increment,
    `user_id` int(11) NOT NULL,
	`product_id` int(11) NOT NULL,
	`title` varchar(200),
	`multiday` boolean,
	`recurring` boolean,
	`start_time` datetime NOT NULL,
	`end_time` datetime NOT NULL,
	`quantity_min` int(11),
	`quantity_max` int(11),
	`all_day` boolean,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`(
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `image` varchar(200) NOT NULL,
  `imageSmall` varchar(200),
  `imageMedium` varchar(200),
  `extension` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `size` varchar(10) NOT NULL,
  `position` int(20),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `token` varchar(32) default NULL,
  `data` text,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `token` (`token`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `search_indices`;
CREATE TABLE `search_indices` (
    `id` int(11) NOT NULL auto_increment,
    `association_key` int(11) NOT NULL,
    `model` varchar(128) collate utf8_unicode_ci NOT NULL,
    `data` longtext collate utf8_unicode_ci NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    PRIMARY KEY  (`id`),
    KEY `association_key` (`association_key`,`model`),
    FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `country_code` char(2) COLLATE utf8_bin DEFAULT NULL,
  `country_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  KEY `idx_country_code` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
INSERT INTO `countries` VALUES ('AD','Andorra'),('AE','United Arab Emirates'),('AF','Afghanistan'),('AG','Antigua and Barbuda'),('AI','Anguilla'),('AL','Albania'),('AM','Armenia'),('AN','Netherlands Antilles'),('AO','Angola'),('AQ','Antarctica'),('AR','Argentina'),('AS','American Samoa'),('AT','Austria'),('AU','Australia'),('AW','Aruba'),('AX','Aland Islands'),('AZ','Azerbaijan'),('BA','Bosnia and Herzegovina'),('BB','Barbados'),('BD','Bangladesh'),('BE','Belgium'),('BF','Burkina Faso'),('BG','Bulgaria'),('BH','Bahrain'),('BI','Burundi'),('BJ','Benin'),('BL','Saint Barthélemy'),('BM','Bermuda'),('BN','Brunei'),('BO','Bolivia'),('BQ','Bonaire, Saint Eustatius and Saba '),('BR','Brazil'),('BS','Bahamas'),('BT','Bhutan'),('BV','Bouvet Island'),('BW','Botswana'),('BY','Belarus'),('BZ','Belize'),('CA','Canada'),('CC','Cocos Islands'),('CD','Democratic Republic of the Congo'),('CF','Central African Republic'),('CG','Republic of the Congo'),('CH','Switzerland'),('CI','Ivory Coast'),('CK','Cook Islands'),('CL','Chile'),('CM','Cameroon'),('CN','China'),('CO','Colombia'),('CR','Costa Rica'),('CS','Serbia and Montenegro'),('CU','Cuba'),('CV','Cape Verde'),('CW','Curaçao'),('CX','Christmas Island'),('CY','Cyprus'),('CZ','Czech Republic'),('DE','Germany'),('DJ','Djibouti'),('DK','Denmark'),('DM','Dominica'),('DO','Dominican Republic'),('DZ','Algeria'),('EC','Ecuador'),('EE','Estonia'),('EG','Egypt'),('EH','Western Sahara'),('ER','Eritrea'),('ES','Spain'),('ET','Ethiopia'),('FI','Finland'),('FJ','Fiji'),('FK','Falkland Islands'),('FM','Micronesia'),('FO','Faroe Islands'),('FR','France'),('GA','Gabon'),('GB','United Kingdom'),('GD','Grenada'),('GE','Georgia'),('GF','French Guiana'),('GG','Guernsey'),('GH','Ghana'),('GI','Gibraltar'),('GL','Greenland'),('GM','Gambia'),('GN','Guinea'),('GP','Guadeloupe'),('GQ','Equatorial Guinea'),('GR','Greece'),('GS','South Georgia and the South Sandwich Islands'),('GT','Guatemala'),('GU','Guam'),('GW','Guinea-Bissau'),('GY','Guyana'),('HK','Hong Kong'),('HM','Heard Island and McDonald Islands'),('HN','Honduras'),('HR','Croatia'),('HT','Haiti'),('HU','Hungary'),('ID','Indonesia'),('IE','Ireland'),('IL','Israel'),('IM','Isle of Man'),('IN','India'),('IO','British Indian Ocean Territory'),('IQ','Iraq'),('IR','Iran'),('IS','Iceland'),('IT','Italy'),('JE','Jersey'),('JM','Jamaica'),('JO','Jordan'),('JP','Japan'),('KE','Kenya'),('KG','Kyrgyzstan'),('KH','Cambodia'),('KI','Kiribati'),('KM','Comoros'),('KN','Saint Kitts and Nevis'),('KP','North Korea'),('KR','South Korea'),('KW','Kuwait'),('KY','Cayman Islands'),('KZ','Kazakhstan'),('LA','Laos'),('LB','Lebanon'),('LC','Saint Lucia'),('LI','Liechtenstein'),('LK','Sri Lanka'),('LR','Liberia'),('LS','Lesotho'),('LT','Lithuania'),('LU','Luxembourg'),('LV','Latvia'),('LY','Libya'),('MA','Morocco'),('MC','Monaco'),('MD','Moldova'),('ME','Montenegro'),('MF','Saint Martin'),('MG','Madagascar'),('MH','Marshall Islands'),('MK','Macedonia'),('ML','Mali'),('MM','Myanmar'),('MN','Mongolia'),('MO','Macao'),('MP','Northern Mariana Islands'),('MQ','Martinique'),('MR','Mauritania'),('MS','Montserrat'),('MT','Malta'),('MU','Mauritius'),('MV','Maldives'),('MW','Malawi'),('MX','Mexico'),('MY','Malaysia'),('MZ','Mozambique'),('NA','Namibia'),('NC','New Caledonia'),('NE','Niger'),('NF','Norfolk Island'),('NG','Nigeria'),('NI','Nicaragua'),('NL','Netherlands'),('NO','Norway'),('NP','Nepal'),('NR','Nauru'),('NU','Niue'),('NZ','New Zealand'),('OM','Oman'),('PA','Panama'),('PE','Peru'),('PF','French Polynesia'),('PG','Papua New Guinea'),('PH','Philippines'),('PK','Pakistan'),('PL','Poland'),('PM','Saint Pierre and Miquelon'),('PN','Pitcairn'),('PR','Puerto Rico'),('PS','Palestinian Territory'),('PT','Portugal'),('PW','Palau'),('PY','Paraguay'),('QA','Qatar'),('RE','Reunion'),('RO','Romania'),('RS','Serbia'),('RU','Russia'),('RW','Rwanda'),('SA','Saudi Arabia'),('SB','Solomon Islands'),('SC','Seychelles'),('SD','Sudan'),('SE','Sweden'),('SG','Singapore'),('SH','Saint Helena'),('SI','Slovenia'),('SJ','Svalbard and Jan Mayen'),('SK','Slovakia'),('SL','Sierra Leone'),('SM','San Marino'),('SN','Senegal'),('SO','Somalia'),('SR','Suriname'),('SS','South Sudan'),('ST','Sao Tome and Principe'),('SV','El Salvador'),('SX','Sint Maarten'),('SY','Syria'),('SZ','Swaziland'),('TC','Turks and Caicos Islands'),('TD','Chad'),('TF','French Southern Territories'),('TG','Togo'),('TH','Thailand'),('TJ','Tajikistan'),('TK','Tokelau'),('TL','East Timor'),('TM','Turkmenistan'),('TN','Tunisia'),('TO','Tonga'),('TR','Turkey'),('TT','Trinidad and Tobago'),('TV','Tuvalu'),('TW','Taiwan'),('TZ','Tanzania'),('UA','Ukraine'),('UG','Uganda'),('UM','United States Minor Outlying Islands'),('US','United States'),('UY','Uruguay'),('UZ','Uzbekistan'),('VA','Vatican'),('VC','Saint Vincent and the Grenadines'),('VE','Venezuela'),('VG','British Virgin Islands'),('VI','U.S. Virgin Islands'),('VN','Vietnam'),('VU','Vanuatu'),('WF','Wallis and Futuna'),('WS','Samoa'),('XK','Kosovo'),('YE','Yemen'),('YT','Mayotte'),('ZA','South Africa'),('ZM','Zambia'),('ZW','Zimbabwe');


DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(35) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_zone_name` (`zone_name`)
) ENGINE=MyISAM AUTO_INCREMENT=419 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
INSERT INTO `zones` VALUES (NULL,'Pacific/Honolulu'),(NULL,'America/Anchorage'),(NULL,'America/Los_Angeles'),(NULL,'America/Phoenix'),(NULL,'America/Denver'),(NULL,'America/Chicago'),(NULL,'America/New_York'),(NULL,'America/Indiana/Indianapolis'),(NULL,'Pacific/Midway'),(NULL,'Pacific/Pago_Pago'),(NULL,'Pacific/Honolulu'),(NULL,'America/Juneau'),(NULL,'America/Los_Angeles'),(NULL,'America/Tijuana'),(NULL,'America/Denver'),(NULL,'America/Phoenix'),(NULL,'America/Chihuahua'),(NULL,'America/Mazatlan'),(NULL,'America/Chicago'),(NULL,'America/Regina'),(NULL,'America/Mexico_City'),(NULL,'America/Monterrey'),(NULL,'America/Guatemala'),(NULL,'America/New_York'),(NULL,'America/Indiana/Indianapolis'),(NULL,'America/Bogota'),(NULL,'America/Lima'),(NULL,'America/Halifax'),(NULL,'America/Caracas'),(NULL,'America/La_Paz'),(NULL,'America/Santiago'),(NULL,'America/St_Johns'),(NULL,'America/Sao_Paulo'),(NULL,'America/Argentina/Buenos_Aires'),(NULL,'America/Guyana'),(NULL,'America/Godthab'),(NULL,'Atlantic/South_Georgia'),(NULL,'Atlantic/Azores'),(NULL,'Atlantic/Cape_Verde'),(NULL,'Europe/Dublin'),(NULL,'Europe/London'),(NULL,'Europe/Lisbon'),(NULL,'Africa/Casablanca'),(NULL,'Africa/Monrovia'),(NULL,'Etc/UTC'),(NULL,'Europe/Belgrade'),(NULL,'Europe/Bratislava'),(NULL,'Europe/Budapest'),(NULL,'Europe/Ljubljana'),(NULL,'Europe/Prague'),(NULL,'Europe/Sarajevo'),(NULL,'Europe/Skopje'),(NULL,'Europe/Warsaw'),(NULL,'Europe/Zagreb'),(NULL,'Europe/Brussels'),(NULL,'Europe/Copenhagen'),(NULL,'Europe/Madrid'),(NULL,'Europe/Paris'),(NULL,'Europe/Amsterdam'),(NULL,'Europe/Berlin'),(NULL,'Europe/Rome'),(NULL,'Europe/Stockholm'),(NULL,'Europe/Vienna'),(NULL,'Africa/Algiers'),(NULL,'Europe/Bucharest'),(NULL,'Africa/Cairo'),(NULL,'Europe/Helsinki'),(NULL,'Europe/Kiev'),(NULL,'Europe/Riga'),(NULL,'Europe/Sofia'),(NULL,'Europe/Tallinn'),(NULL,'Europe/Vilnius'),(NULL,'Europe/Athens'),(NULL,'Europe/Istanbul'),(NULL,'Europe/Minsk'),(NULL,'Asia/Jerusalem'),(NULL,'Africa/Harare'),(NULL,'Africa/Johannesburg'),(NULL,'Europe/Moscow'),(NULL,'Asia/Kuwait'),(NULL,'Asia/Riyadh'),(NULL,'Africa/Nairobi'),(NULL,'Asia/Baghdad'),(NULL,'Asia/Tehran'),(NULL,'Asia/Muscat'),(NULL,'Asia/Baku'),(NULL,'Asia/Tbilisi'),(NULL,'Asia/Yerevan'),(NULL,'Asia/Kabul'),(NULL,'Asia/Yekaterinburg'),(NULL,'Asia/Karachi'),(NULL,'Asia/Tashkent'),(NULL,'Asia/Kolkata'),(NULL,'Asia/Kathmandu'),(NULL,'Asia/Dhaka'),(NULL,'Asia/Colombo'),(NULL,'Asia/Almaty'),(NULL,'Asia/Novosibirsk'),(NULL,'Asia/Rangoon'),(NULL,'Asia/Bangkok'),(NULL,'Asia/Jakarta'),(NULL,'Asia/Krasnoyarsk'),(NULL,'Asia/Shanghai'),(NULL,'Asia/Chongqing'),(NULL,'Asia/Hong_Kong'),(NULL,'Asia/Urumqi'),(NULL,'Asia/Kuala_Lumpur'),(NULL,'Asia/Singapore'),(NULL,'Asia/Taipei'),(NULL,'Australia/Perth'),(NULL,'Asia/Irkutsk'),(NULL,'Asia/Ulaanbaatar'),(NULL,'Asia/Seoul'),(NULL,'Asia/Tokyo'),(NULL,'Asia/Yakutsk'),(NULL,'Australia/Darwin'),(NULL,'Australia/Adelaide'),(NULL,'Australia/Melbourne'),(NULL,'Australia/Sydney'),(NULL,'Australia/Brisbane'),(NULL,'Australia/Hobart'),(NULL,'Asia/Vladivostok'),(NULL,'Pacific/Guam'),(NULL,'Pacific/Port_Moresby'),(NULL,'Asia/Magadan'),(NULL,'Pacific/Noumea'),(NULL,'Pacific/Fiji'),(NULL,'Asia/Kamchatka'),(NULL,'Pacific/Majuro'),(NULL,'Pacific/Auckland'),(NULL,'Pacific/Tongatapu');