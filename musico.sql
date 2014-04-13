-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2014 at 05:45 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticketme`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin@cmsjm.com', '77c87b93dc113f501cebe27c81a014124035788f', 'admin', '2013-03-24 00:00:00', '2014-04-12 16:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `regular` int(255) NOT NULL,
  `vip` int(255) NOT NULL,
  `child` int(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `product_id`, `booking_date`, `regular`, `vip`, `child`, `created`, `modified`) VALUES
(1, 0, 0, NULL, 0, 0, 0, '2013-12-12 14:47:29', '2013-12-12 14:47:29'),
(2, 0, 0, NULL, 0, 0, 0, '2013-12-12 14:51:39', '2013-12-12 14:51:39'),
(3, 0, 0, NULL, 4, 0, 4, '2013-12-12 14:55:25', '2013-12-12 14:55:25'),
(4, 0, 0, NULL, 5, 4, 4, '2013-12-12 14:56:35', '2013-12-12 14:56:35'),
(5, 0, 0, NULL, 0, 0, 0, '2013-12-12 15:02:56', '2013-12-12 15:02:56'),
(6, 0, 0, NULL, 4, 6, 1, '2013-12-12 15:05:23', '2013-12-12 15:05:23'),
(7, 0, 0, NULL, 0, 0, 0, '2013-12-12 15:06:54', '2013-12-12 15:06:54'),
(8, 0, 0, NULL, 1, 5, 2, '2013-12-12 15:08:11', '2013-12-12 15:08:11'),
(9, 0, 0, NULL, 0, 0, 0, '2013-12-12 15:09:57', '2013-12-12 15:09:57'),
(10, 0, 0, NULL, 7, 1, 5, '2013-12-12 15:19:14', '2013-12-12 15:19:14'),
(11, 0, 0, NULL, 0, 0, 0, '2013-12-12 15:34:11', '2013-12-12 15:34:11'),
(12, 0, 0, NULL, 0, 0, 0, '2013-12-13 14:40:28', '2013-12-13 14:40:28'),
(13, 0, 0, NULL, 0, 0, 0, '2013-12-13 14:41:13', '2013-12-13 14:41:13'),
(14, 0, 0, NULL, 4, 7, 1, '2013-12-13 14:41:38', '2013-12-13 14:41:38'),
(15, 0, 0, NULL, 4, 1, 2, '2013-12-13 16:43:11', '2013-12-13 16:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Reggae'),
(2, 'Dancehall'),
(3, 'RnB'),
(4, 'Soca'),
(5, 'Rock');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(10) COLLATE utf8_bin NOT NULL,
  `work_number` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_code` char(2) COLLATE utf8_bin DEFAULT NULL,
  `country_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  KEY `idx_country_code` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_code`, `country_name`) VALUES
('AD', 'Andorra'),
('AE', 'United Arab Emirates'),
('AF', 'Afghanistan'),
('AG', 'Antigua and Barbuda'),
('AI', 'Anguilla'),
('AL', 'Albania'),
('AM', 'Armenia'),
('AN', 'Netherlands Antilles'),
('AO', 'Angola'),
('AQ', 'Antarctica'),
('AR', 'Argentina'),
('AS', 'American Samoa'),
('AT', 'Austria'),
('AU', 'Australia'),
('AW', 'Aruba'),
('AX', 'Aland Islands'),
('AZ', 'Azerbaijan'),
('BA', 'Bosnia and Herzegovina'),
('BB', 'Barbados'),
('BD', 'Bangladesh'),
('BE', 'Belgium'),
('BF', 'Burkina Faso'),
('BG', 'Bulgaria'),
('BH', 'Bahrain'),
('BI', 'Burundi'),
('BJ', 'Benin'),
('BL', 'Saint Barthélemy'),
('BM', 'Bermuda'),
('BN', 'Brunei'),
('BO', 'Bolivia'),
('BQ', 'Bonaire, Saint Eustatius and Saba '),
('BR', 'Brazil'),
('BS', 'Bahamas'),
('BT', 'Bhutan'),
('BV', 'Bouvet Island'),
('BW', 'Botswana'),
('BY', 'Belarus'),
('BZ', 'Belize'),
('CA', 'Canada'),
('CC', 'Cocos Islands'),
('CD', 'Democratic Republic of the Congo'),
('CF', 'Central African Republic'),
('CG', 'Republic of the Congo'),
('CH', 'Switzerland'),
('CI', 'Ivory Coast'),
('CK', 'Cook Islands'),
('CL', 'Chile'),
('CM', 'Cameroon'),
('CN', 'China'),
('CO', 'Colombia'),
('CR', 'Costa Rica'),
('CS', 'Serbia and Montenegro'),
('CU', 'Cuba'),
('CV', 'Cape Verde'),
('CW', 'Curaçao'),
('CX', 'Christmas Island'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DE', 'Germany'),
('DJ', 'Djibouti'),
('DK', 'Denmark'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('DZ', 'Algeria'),
('EC', 'Ecuador'),
('EE', 'Estonia'),
('EG', 'Egypt'),
('EH', 'Western Sahara'),
('ER', 'Eritrea'),
('ES', 'Spain'),
('ET', 'Ethiopia'),
('FI', 'Finland'),
('FJ', 'Fiji'),
('FK', 'Falkland Islands'),
('FM', 'Micronesia'),
('FO', 'Faroe Islands'),
('FR', 'France'),
('GA', 'Gabon'),
('GB', 'United Kingdom'),
('GD', 'Grenada'),
('GE', 'Georgia'),
('GF', 'French Guiana'),
('GG', 'Guernsey'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GL', 'Greenland'),
('GM', 'Gambia'),
('GN', 'Guinea'),
('GP', 'Guadeloupe'),
('GQ', 'Equatorial Guinea'),
('GR', 'Greece'),
('GS', 'South Georgia and the South Sandwich Islands'),
('GT', 'Guatemala'),
('GU', 'Guam'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HK', 'Hong Kong'),
('HM', 'Heard Island and McDonald Islands'),
('HN', 'Honduras'),
('HR', 'Croatia'),
('HT', 'Haiti'),
('HU', 'Hungary'),
('ID', 'Indonesia'),
('IE', 'Ireland'),
('IL', 'Israel'),
('IM', 'Isle of Man'),
('IN', 'India'),
('IO', 'British Indian Ocean Territory'),
('IQ', 'Iraq'),
('IR', 'Iran'),
('IS', 'Iceland'),
('IT', 'Italy'),
('JE', 'Jersey'),
('JM', 'Jamaica'),
('JO', 'Jordan'),
('JP', 'Japan'),
('KE', 'Kenya'),
('KG', 'Kyrgyzstan'),
('KH', 'Cambodia'),
('KI', 'Kiribati'),
('KM', 'Comoros'),
('KN', 'Saint Kitts and Nevis'),
('KP', 'North Korea'),
('KR', 'South Korea'),
('KW', 'Kuwait'),
('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'),
('LA', 'Laos'),
('LB', 'Lebanon'),
('LC', 'Saint Lucia'),
('LI', 'Liechtenstein'),
('LK', 'Sri Lanka'),
('LR', 'Liberia'),
('LS', 'Lesotho'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('LV', 'Latvia'),
('LY', 'Libya'),
('MA', 'Morocco'),
('MC', 'Monaco'),
('MD', 'Moldova'),
('ME', 'Montenegro'),
('MF', 'Saint Martin'),
('MG', 'Madagascar'),
('MH', 'Marshall Islands'),
('MK', 'Macedonia'),
('ML', 'Mali'),
('MM', 'Myanmar'),
('MN', 'Mongolia'),
('MO', 'Macao'),
('MP', 'Northern Mariana Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MS', 'Montserrat'),
('MT', 'Malta'),
('MU', 'Mauritius'),
('MV', 'Maldives'),
('MW', 'Malawi'),
('MX', 'Mexico'),
('MY', 'Malaysia'),
('MZ', 'Mozambique'),
('NA', 'Namibia'),
('NC', 'New Caledonia'),
('NE', 'Niger'),
('NF', 'Norfolk Island'),
('NG', 'Nigeria'),
('NI', 'Nicaragua'),
('NL', 'Netherlands'),
('NO', 'Norway'),
('NP', 'Nepal'),
('NR', 'Nauru'),
('NU', 'Niue'),
('NZ', 'New Zealand'),
('OM', 'Oman'),
('PA', 'Panama'),
('PE', 'Peru'),
('PF', 'French Polynesia'),
('PG', 'Papua New Guinea'),
('PH', 'Philippines'),
('PK', 'Pakistan'),
('PL', 'Poland'),
('PM', 'Saint Pierre and Miquelon'),
('PN', 'Pitcairn'),
('PR', 'Puerto Rico'),
('PS', 'Palestinian Territory'),
('PT', 'Portugal'),
('PW', 'Palau'),
('PY', 'Paraguay'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RS', 'Serbia'),
('RU', 'Russia'),
('RW', 'Rwanda'),
('SA', 'Saudi Arabia'),
('SB', 'Solomon Islands'),
('SC', 'Seychelles'),
('SD', 'Sudan'),
('SE', 'Sweden'),
('SG', 'Singapore'),
('SH', 'Saint Helena'),
('SI', 'Slovenia'),
('SJ', 'Svalbard and Jan Mayen'),
('SK', 'Slovakia'),
('SL', 'Sierra Leone'),
('SM', 'San Marino'),
('SN', 'Senegal'),
('SO', 'Somalia'),
('SR', 'Suriname'),
('SS', 'South Sudan'),
('ST', 'Sao Tome and Principe'),
('SV', 'El Salvador'),
('SX', 'Sint Maarten'),
('SY', 'Syria'),
('SZ', 'Swaziland'),
('TC', 'Turks and Caicos Islands'),
('TD', 'Chad'),
('TF', 'French Southern Territories'),
('TG', 'Togo'),
('TH', 'Thailand'),
('TJ', 'Tajikistan'),
('TK', 'Tokelau'),
('TL', 'East Timor'),
('TM', 'Turkmenistan'),
('TN', 'Tunisia'),
('TO', 'Tonga'),
('TR', 'Turkey'),
('TT', 'Trinidad and Tobago'),
('TV', 'Tuvalu'),
('TW', 'Taiwan'),
('TZ', 'Tanzania'),
('UA', 'Ukraine'),
('UG', 'Uganda'),
('UM', 'United States Minor Outlying Islands'),
('US', 'United States'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VA', 'Vatican'),
('VC', 'Saint Vincent and the Grenadines'),
('VE', 'Venezuela'),
('VG', 'British Virgin Islands'),
('VI', 'U.S. Virgin Islands'),
('VN', 'Vietnam'),
('VU', 'Vanuatu'),
('WF', 'Wallis and Futuna'),
('WS', 'Samoa'),
('XK', 'Kosovo'),
('YE', 'Yemen'),
('YT', 'Mayotte'),
('ZA', 'South Africa'),
('ZM', 'Zambia'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_bin NOT NULL,
  `imageSmall` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `imageMedium` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8_bin NOT NULL,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `size` varchar(10) COLLATE utf8_bin NOT NULL,
  `position` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=111 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `user_id`, `created`, `modified`, `image`, `imageSmall`, `imageMedium`, `extension`, `type`, `size`, `position`) VALUES
(20, 33, 1, '2013-06-03 19:19:27', '2013-06-03 19:19:27', '5349747875da7.jpg', '51acec3ff2815-crop-100x100-small.jpg', '51acec3ff2815-resize-600x400-medium.jpg', 'jpg', 'image/jpeg', '80764', 0),
(21, 34, 1, '2013-06-03 19:19:34', '2013-06-03 19:19:34', '53497675b02c4.jpg', '51acec468d15e-crop-100x100-small.jpg', '51acec468d15e-resize-800x531-medium.jpg', 'jpg', 'image/jpeg', '98442', 0),
(22, 1, 1, '2013-06-03 19:19:38', '2013-06-03 19:19:38', '51acec4a9b16a.jpg', '51acec4a9b16a-crop-100x100-small.jpg', '51acec4a9b16a-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '314480', 2),
(24, 2, 1, '2013-06-03 19:24:34', '2013-06-03 19:24:34', '51aced72cd0e2.jpg', '51aced72cd0e2-crop-100x100-small.jpg', '51aced72cd0e2-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '1863288', 0),
(25, 2, 1, '2013-06-03 19:24:43', '2013-06-03 19:24:43', '51aced7be1adf.jpg', '51aced7be1adf-crop-100x100-small.jpg', '51aced7be1adf-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '171719', 1),
(26, 2, 1, '2013-06-03 19:24:48', '2013-06-03 19:24:48', '51aced80f1215.jpg', '51aced80f1215-crop-100x100-small.jpg', '51aced80f1215-resize-600x395-medium.jpg', 'jpg', 'image/jpeg', '70032', 2),
(27, 2, 1, '2013-06-03 19:24:56', '2013-06-03 19:24:56', '51aced8804819.jpg', '51aced8804819-crop-100x100-small.jpg', '51aced8804819-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '205924', 3),
(28, 3, 1, '2013-06-03 19:38:00', '2013-06-03 19:38:16', '51acf098e6577.jpg', '51acf098e6577-crop-100x100-small.jpg', '51acf098e6577-resize-550x411-medium.jpg', 'jpg', 'image/jpeg', '54235', 0),
(33, 4, 1, '2013-06-03 19:48:56', '2013-06-03 19:49:23', '51acf3285869f.jpg', '51acf3285869f-crop-100x100-small.jpg', '51acf3285869f-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '448199', 2),
(37, 5, 1, '2013-06-03 20:52:20', '2013-06-03 20:52:20', '51ad0204486b6.jpg', '51ad0204486b6-crop-100x100-small.jpg', '51ad0204486b6-resize-800x380-medium.jpg', 'jpg', 'image/jpeg', '216537', 0),
(29, 3, 1, '2013-06-03 19:38:06', '2013-06-03 19:38:06', '51acf09e6dff5.jpg', '51acf09e6dff5-crop-100x100-small.jpg', '51acf09e6dff5-resize-557x392-medium.jpg', 'jpg', 'image/jpeg', '46753', 1),
(31, 3, 1, '2013-06-03 19:38:21', '2013-06-03 19:38:21', '51acf0ad2b5af.jpg', '51acf0ad2b5af-crop-100x100-small.jpg', '51acf0ad2b5af-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '802825', 2),
(32, 3, 1, '2013-06-03 19:38:25', '2013-06-03 19:38:25', '51acf0b1e03e2.jpg', '51acf0b1e03e2-crop-100x100-small.jpg', '51acf0b1e03e2-resize-800x466-medium.jpg', 'jpg', 'image/jpeg', '123968', 3),
(34, 4, 1, '2013-06-03 19:49:04', '2013-06-03 19:49:04', '51acf3305d122.jpg', '51acf3305d122-crop-100x100-small.jpg', '51acf3305d122-resize-550x368-medium.jpg', 'jpg', 'image/jpeg', '25926', 1),
(35, 4, 1, '2013-06-03 19:49:08', '2013-06-03 19:49:23', '51acf3347ef6c.jpg', '51acf3347ef6c-crop-100x100-small.jpg', '51acf3347ef6c-resize-550x412-medium.jpg', 'jpg', 'image/jpeg', '43660', 0),
(36, 4, 1, '2013-06-03 19:49:12', '2013-06-03 19:49:12', '51acf338299ad.jpg', '51acf338299ad-crop-100x100-small.jpg', '51acf338299ad-resize-550x412-medium.jpg', 'jpg', 'image/jpeg', '55917', 3),
(38, 5, 1, '2013-06-03 20:52:30', '2013-06-03 20:52:30', '51ad020eb2536.jpg', '51ad020eb2536-crop-100x100-small.jpg', '51ad020eb2536-resize-800x380-medium.jpg', 'jpg', 'image/jpeg', '208229', 1),
(39, 5, 1, '2013-06-03 20:52:35', '2013-06-03 20:52:35', '51ad0213a5e49.jpg', '51ad0213a5e49-crop-100x100-small.jpg', '51ad0213a5e49-resize-800x380-medium.jpg', 'jpg', 'image/jpeg', '213515', 2),
(40, 5, 1, '2013-06-03 20:52:40', '2013-06-03 20:52:40', '51ad021804dd1.jpg', '51ad021804dd1-crop-100x100-small.jpg', '51ad021804dd1-resize-800x380-medium.jpg', 'jpg', 'image/jpeg', '192751', 3),
(41, 6, 1, '2013-06-03 21:05:23', '2013-06-03 21:05:23', '51ad0513f0bbb.jpg', '51ad0513f0bbb-crop-100x100-small.jpg', '51ad0513f0bbb-resize-632x442-medium.jpg', 'jpg', 'image/jpeg', '53918', 0),
(42, 6, 1, '2013-06-03 21:05:36', '2013-06-03 21:05:36', '51ad05205eebf.jpg', '51ad05205eebf-crop-100x100-small.jpg', '51ad05205eebf-resize-632x442-medium.jpg', 'jpg', 'image/jpeg', '50416', 1),
(43, 6, 1, '2013-06-03 21:05:39', '2013-06-03 21:05:39', '51ad0523e3177.jpg', '51ad0523e3177-crop-100x100-small.jpg', '51ad0523e3177-resize-560x312-medium.jpg', 'jpg', 'image/jpeg', '74131', 2),
(44, 6, 1, '2013-06-03 21:05:45', '2013-06-03 21:05:45', '51ad05292f1c6.jpg', '51ad05292f1c6-crop-100x100-small.jpg', '51ad05292f1c6-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '171318', 3),
(45, 7, 1, '2013-06-03 21:59:05', '2013-06-03 21:59:05', '51ad11a912710.jpg', '51ad11a912710-crop-100x100-small.jpg', '51ad11a912710-resize-395x209-medium.jpg', 'jpg', 'image/jpeg', '65163', 0),
(46, 7, 1, '2013-06-03 21:59:14', '2013-06-03 21:59:14', '51ad11b26ec3b.jpg', '51ad11b26ec3b-crop-100x100-small.jpg', '51ad11b26ec3b-resize-395x209-medium.jpg', 'jpg', 'image/jpeg', '57019', 1),
(47, 7, 1, '2013-06-03 21:59:17', '2013-06-03 21:59:17', '51ad11b5754e2.jpg', '51ad11b5754e2-crop-100x100-small.jpg', '51ad11b5754e2-resize-395x209-medium.jpg', 'jpg', 'image/jpeg', '77832', 2),
(48, 7, 1, '2013-06-03 21:59:20', '2013-06-03 21:59:20', '51ad11b81cc9d.jpg', '51ad11b81cc9d-crop-100x100-small.jpg', '51ad11b81cc9d-resize-395x209-medium.jpg', 'jpg', 'image/jpeg', '65214', 3),
(49, 8, 1, '2013-06-03 22:27:25', '2013-06-03 22:27:25', '51ad184d88c5b.jpg', '51ad184d88c5b-crop-100x100-small.jpg', '51ad184d88c5b-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '53056', 0),
(50, 8, 1, '2013-06-03 22:27:32', '2013-06-03 22:27:32', '51ad18549b9e3.jpg', '51ad18549b9e3-crop-100x100-small.jpg', '51ad18549b9e3-resize-640x480-medium.jpg', 'jpg', 'image/jpeg', '48075', 1),
(51, 34, 1, '2013-06-03 22:27:36', '2013-06-03 22:27:36', '53497675b02c4.jpg', '51ad1858364ee-crop-100x100-small.jpg', '51ad1858364ee-resize-640x480-medium.jpg', 'jpg', 'image/jpeg', '38794', 2),
(52, 8, 1, '2013-06-03 22:27:39', '2013-06-03 22:27:39', '51ad185b8cd20.jpg', '51ad185b8cd20-crop-100x100-small.jpg', '51ad185b8cd20-resize-570x427-medium.jpg', 'jpg', 'image/jpeg', '48339', 3),
(53, 9, 1, '2013-06-03 23:13:45', '2013-06-03 23:14:03', '51ad2329b5536.png', '51ad2329b5536-crop-100x100-small.png', '51ad2329b5536-resize-697x310-medium.png', 'png', 'image/png', '125173', 1),
(54, 9, 1, '2013-06-03 23:13:56', '2013-06-03 23:14:03', '51ad2334e0bdc.jpg', '51ad2334e0bdc-crop-100x100-small.jpg', '51ad2334e0bdc-resize-500x375-medium.jpg', 'jpg', 'image/jpeg', '49698', 0),
(55, 9, 1, '2013-06-03 23:15:47', '2013-06-03 23:15:47', '51ad23a3aaa4d.png', '51ad23a3aaa4d-crop-100x100-small.png', '51ad23a3aaa4d-resize-700x310-medium.png', 'png', 'image/png', '278042', 2),
(56, 9, 1, '2013-06-03 23:15:52', '2013-06-03 23:15:52', '51ad23a840c08.png', '51ad23a840c08-crop-100x100-small.png', '51ad23a840c08-resize-700x310-medium.png', 'png', 'image/png', '135583', 3),
(57, 10, 1, '2013-06-04 13:48:47', '2013-06-04 13:49:27', '51adf04023f2a.jpg', '51adf04023f2a-crop-100x100-small.jpg', '51adf04023f2a-resize-760x200-medium.jpg', 'jpg', 'image/jpeg', '136918', 0),
(58, 10, 1, '2013-06-04 13:48:56', '2013-06-04 13:48:56', '51adf048d815d.jpg', '51adf048d815d-crop-100x100-small.jpg', '51adf048d815d-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '125198', 1),
(60, 10, 1, '2013-06-04 13:49:14', '2013-06-04 13:49:14', '51adf05acfc59.jpg', '51adf05acfc59-crop-100x100-small.jpg', '51adf05acfc59-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '193832', 2),
(62, 10, 1, '2013-06-04 13:49:36', '2013-06-04 13:49:36', 'img/user.png', NULL, NULL, '', '', '', 3),
(63, 10, 1, '2013-06-04 13:49:53', '2013-06-04 13:49:53', 'img/user.png', NULL, NULL, '', '', '', 4),
(64, 11, 1, '2013-06-04 14:41:12', '2013-06-04 14:41:12', '51adfc8899474.jpeg', '51adfc8899474-crop-100x100-small.jpeg', '51adfc8899474-resize-625x468-medium.jpeg', 'jpeg', 'image/jpeg', '41460', 0),
(65, 11, 1, '2013-06-04 14:41:18', '2013-06-04 14:41:18', '51adfc8e0c04d.jpg', '51adfc8e0c04d-crop-100x100-small.jpg', '51adfc8e0c04d-resize-610x407-medium.jpg', 'jpg', 'image/jpeg', '23895', 1),
(66, 11, 1, '2013-06-04 14:41:23', '2013-06-04 14:41:23', '51adfc93221b0.jpg', '51adfc93221b0-crop-100x100-small.jpg', '51adfc93221b0-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '57681', 2),
(67, 11, 1, '2013-06-04 14:41:26', '2013-06-04 14:41:26', '51adfc9668aa9.png', '51adfc9668aa9-crop-100x100-small.png', '51adfc9668aa9-resize-640x480-medium.png', 'png', 'image/png', '120195', 3),
(68, 12, 1, '2013-06-04 15:05:12', '2013-06-04 15:05:12', '51ae02280931d.jpeg', '51ae02280931d-crop-100x100-small.jpeg', '51ae02280931d-resize-625x468-medium.jpeg', 'jpeg', 'image/jpeg', '41460', 0),
(69, 12, 1, '2013-06-04 15:05:17', '2013-06-04 15:05:17', '51ae022d43617.png', '51ae022d43617-crop-100x100-small.png', '51ae022d43617-resize-640x480-medium.png', 'png', 'image/png', '120195', 1),
(70, 12, 1, '2013-06-04 15:05:21', '2013-06-04 15:05:21', '51ae0231c4a79.jpg', '51ae0231c4a79-crop-100x100-small.jpg', '51ae0231c4a79-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '57681', 2),
(71, 12, 1, '2013-06-04 15:05:24', '2013-06-04 15:05:24', '51ae0234ed963.jpg', '51ae0234ed963-crop-100x100-small.jpg', '51ae0234ed963-resize-610x407-medium.jpg', 'jpg', 'image/jpeg', '23895', 3),
(72, 13, 1, '2013-06-04 19:36:11', '2013-06-04 19:36:11', '51ae41abd81c1.png', '51ae41abd81c1-crop-100x100-small.png', '51ae41abd81c1-resize-141x121-medium.png', 'png', 'image/png', '22451', 0),
(73, 13, 1, '2013-06-04 19:38:35', '2013-06-04 19:38:35', '51ae423b8d914.jpg', '51ae423b8d914-crop-100x100-small.jpg', '51ae423b8d914-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '1150164', 1),
(74, 13, 1, '2013-06-04 19:38:39', '2013-06-04 19:38:39', '51ae423faa80d.jpg', '51ae423faa80d-crop-100x100-small.jpg', '51ae423faa80d-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '651792', 2),
(75, 13, 1, '2013-06-04 19:38:43', '2013-06-04 19:38:43', '51ae4243970e5.jpg', '51ae4243970e5-crop-100x100-small.jpg', '51ae4243970e5-resize-800x600-medium.jpg', 'jpg', 'image/jpeg', '167976', 3),
(76, 14, 1, '2013-06-04 20:34:17', '2013-06-04 20:34:17', '51ae4f499cf92.png', '51ae4f499cf92-crop-100x100-small.png', '51ae4f499cf92-resize-509x102-medium.png', 'png', 'image/png', '12908', 0),
(77, 14, 1, '2013-06-04 20:34:24', '2013-06-04 20:34:24', '51ae4f502407b.jpg', '51ae4f502407b-crop-100x100-small.jpg', '51ae4f502407b-resize-316x475-medium.jpg', 'jpg', 'image/jpeg', '88319', 1),
(78, 14, 1, '2013-06-04 20:34:27', '2013-06-04 20:34:27', '51ae4f536d92d.jpg', '51ae4f536d92d-crop-100x100-small.jpg', '51ae4f536d92d-resize-404x475-medium.jpg', 'jpg', 'image/jpeg', '154085', 2),
(79, 14, 1, '2013-06-04 20:34:31', '2013-06-04 20:34:31', '51ae4f5720037.jpg', '51ae4f5720037-crop-100x100-small.jpg', '51ae4f5720037-resize-277x475-medium.jpg', 'jpg', 'image/jpeg', '125259', 3),
(80, 14, 1, '2013-06-04 20:34:35', '2013-06-04 20:34:35', '51ae4f5b0d4d9.jpg', '51ae4f5b0d4d9-crop-100x100-small.jpg', '51ae4f5b0d4d9-resize-323x475-medium.jpg', 'jpg', 'image/jpeg', '97322', 4),
(81, 15, 1, '2013-06-04 20:54:49', '2013-06-04 20:54:49', '51ae54191df20.jpg', '51ae54191df20-crop-100x100-small.jpg', '51ae54191df20-resize-550x412-medium.jpg', 'jpg', 'image/jpeg', '67339', 0),
(82, 15, 1, '2013-06-04 20:54:54', '2013-06-04 20:54:54', '51ae541e399aa.jpg', '51ae541e399aa-crop-100x100-small.jpg', '51ae541e399aa-resize-550x412-medium.jpg', 'jpg', 'image/jpeg', '60843', 1),
(83, 15, 1, '2013-06-04 20:54:57', '2013-06-04 20:54:57', '51ae54219be38.jpg', '51ae54219be38-crop-100x100-small.jpg', '51ae54219be38-resize-550x412-medium.jpg', 'jpg', 'image/jpeg', '32157', 2),
(84, 15, 1, '2013-06-04 20:55:00', '2013-06-04 20:55:00', '51ae5424d0237.jpg', '51ae5424d0237-crop-100x100-small.jpg', '51ae5424d0237-resize-550x412-medium.jpg', 'jpg', 'image/jpeg', '27839', 3),
(85, 16, 1, '2013-06-05 20:20:13', '2013-06-05 20:20:13', '51af9d7d76c3d.jpg', '51af9d7d76c3d-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '29795', 0),
(86, 16, 1, '2013-06-05 20:20:24', '2013-06-05 20:20:24', '51af9d889436e.jpg', '51af9d889436e-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '885374', 1),
(87, 16, 1, '2013-06-05 20:20:28', '2013-06-05 20:20:28', '51af9d8c09b65.jpg', '51af9d8c09b65-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '49752', 2),
(88, 16, 1, '2013-06-05 20:20:35', '2013-06-05 20:20:35', '51af9d934ff27.jpg', '51af9d934ff27-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '40330', 3),
(89, 17, 1, '2013-06-05 20:43:21', '2013-06-05 20:43:21', '51afa2ea39ec0.jpg', '51afa2ea39ec0-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '55584', 0),
(90, 17, 1, '2013-06-05 20:43:30', '2013-06-05 20:43:30', '51afa2f2509c0.jpg', '51afa2f2509c0-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '79079', 1),
(91, 17, 1, '2013-06-05 20:43:34', '2013-06-05 20:43:34', '51afa2f64bdba.jpg', '51afa2f64bdba-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '26448', 2),
(92, 17, 1, '2013-06-05 20:43:38', '2013-06-05 20:43:38', '51afa2fac8c82.jpg', '51afa2fac8c82-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '31329', 3),
(93, 18, 1, '2013-06-05 21:10:10', '2013-06-05 21:10:36', '51afa932e6562.jpg', '51afa932e6562-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '131650', 1),
(94, 18, 1, '2013-06-05 21:10:19', '2013-12-11 18:44:18', '51afa93b1fd94.jpg', '51afa93b1fd94-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '76038', 0),
(95, 18, 1, '2013-06-05 21:10:22', '2013-06-05 21:10:32', '51afa93e9a1df.jpg', '51afa93e9a1df-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '274679', 3),
(96, 18, 1, '2013-06-05 21:10:26', '2013-12-11 18:44:18', '51afa942552c9.jpg', '51afa942552c9-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '76875', 2),
(97, 19, 1, '2013-06-05 21:20:45', '2013-06-05 21:21:17', '51afabadb052a.jpg', '51afabadb052a-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '255146', 0),
(98, 19, 1, '2013-06-05 21:21:01', '2013-06-05 21:21:01', '51afabbd1f93a.jpg', '51afabbd1f93a-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '78127', 1),
(99, 19, 1, '2013-06-05 21:21:04', '2013-06-05 21:21:04', '51afabc0763b5.jpg', '51afabc0763b5-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '90414', 2),
(101, 19, 1, '2013-06-05 21:22:52', '2013-06-05 21:22:52', '51afac2c83e1c.jpg', '51afac2c83e1c-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '69800', 3),
(104, 20, 1, '2013-06-05 21:33:16', '2013-06-05 21:33:16', '51afae9c0e432.jpg', '51afae9c0e432-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '242497', 1),
(103, 20, 1, '2013-06-05 21:32:52', '2013-06-05 21:32:56', '51afae842ff41.jpg', '51afae842ff41-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '104313', 0),
(105, 20, 1, '2013-06-05 21:33:20', '2013-06-05 21:33:20', '51afaea025829.jpg', '51afaea025829-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '119590', 2),
(106, 20, 1, '2013-06-05 21:33:23', '2013-06-05 21:33:23', '51afaea3cf20d.jpg', '51afaea3cf20d-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '26526', 3),
(107, 21, 1, '2013-06-08 15:52:14', '2013-06-08 15:52:14', '51b3532e366b6.jpg', '51b3532e366b6-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '89144', 0),
(108, 21, 1, '2013-06-08 15:52:23', '2013-06-08 15:52:23', '51b3533724161.jpg', '51b3533724161-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '78305', 1),
(109, 21, 1, '2013-06-08 15:52:30', '2013-06-08 15:52:30', '51b3533e7569e.jpg', '51b3533e7569e-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '68135', 2),
(110, 21, 1, '2013-06-08 15:52:39', '2013-06-08 15:52:39', '51b353474451d.jpg', '51b353474451d-crop-100x100.jpg', NULL, 'jpg', 'image/jpeg', '78401', 3);

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE IF NOT EXISTS `itineraries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `activity` varchar(10000) COLLATE utf8_bin DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `lat` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `long` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `my_trips`
--

CREATE TABLE IF NOT EXISTS `my_trips` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Dumping data for table `my_trips`
--

INSERT INTO `my_trips` (`id`, `product_id`, `user_id`) VALUES
(18, 2, 1),
(20, 18, 1),
(22, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fav_song` varchar(233) COLLATE utf8_bin NOT NULL,
  `role_model` varchar(233) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `what_to_take` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `guest_artistes` varchar(255) COLLATE utf8_bin NOT NULL,
  `duration` bigint(20) DEFAULT NULL,
  `duration_type` int(1) DEFAULT NULL,
  `child` int(255) NOT NULL,
  `regular` int(255) NOT NULL,
  `price_low` bigint(20) DEFAULT NULL,
  `price_high` bigint(20) DEFAULT NULL,
  `per_person` tinyint(1) DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `from_people_range` int(11) DEFAULT NULL,
  `to_people_range` int(11) DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `start_date` int(255) NOT NULL,
  `external_url` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `facebook` varchar(233) COLLATE utf8_bin NOT NULL,
  `twitter` varchar(233) COLLATE utf8_bin NOT NULL,
  `youtube` varchar(233) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=35 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `fav_song`, `role_model`, `user_id`, `created`, `modified`, `name`, `address`, `description`, `what_to_take`, `guest_artistes`, `duration`, `duration_type`, `child`, `regular`, `price_low`, `price_high`, `per_person`, `video_url`, `from_people_range`, `to_people_range`, `url`, `start_date`, `external_url`, `category_id`, `facebook`, `twitter`, `youtube`) VALUES
(34, '"I have no idea I am an idiot"', '"my favourite nobody"', 1, '2014-04-12 17:20:40', '2014-04-12 17:31:42', 'Beyonce', 'Runaway Bay Heart Hotel', ' is an American recording artist and actress. Born and raised in Houston, Texas, she performed in various singing and dancing competitions as a child, and rose to fame in the late 1990s as lead singer of R&B girl-group Destiny''s Child. Managed by her father Mathew Knowles, the group became one of the world''s best-selling girl groups of all time. Their hiatus saw the release of BeyoncÃ©''s debut album, Dangerously in Love (2003), which established her as a solo artist worldwide; it sold 11 million copies, earned five Grammy Awards and featured the Billboard number-one singles "Crazy in Love" and "Baby Boy".', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, '', NULL, NULL, '3732-beyonce', 0, NULL, 3, 'https://www.youtube.com/watch?v=pZ12_E5R', 'https://www.youtube.com/watch?v=pZ12_E5R', '<iframe width="560" height="315" src="//www.youtube.com/embed/pZ12_E5R3qc" frameborder="0" allowfullscreen></iframe>'),
(33, '"My Favourite song is no woman nuh cry"', '"My role model is my mother who helped me through all circumstances"', 1, '2014-04-12 16:52:36', '2014-04-12 17:10:39', 'Bob Marley', 'Kingston, Jamaica', 'Robert Nesta "Bob" Marley OM (6 February 1945 â€“ 11 May 1981) was a Jamaican reggae singer-songwriter and guitarist who achieved international fame and acclaim.[1][2] Starting out in 1963 with the group the Wailers, he forged a distinctive songwriting and vocal style that would later resonate with audiences worldwide. The Wailers would go on to release some of the earliest reggae records with producer Lee Scratch Perry.[3] After the Wailers disbanded in 1974,[4] Marley pursued a solo career which culminated in the release of the album Exodus in 1977 which established his worldwide reputation.[5] He was a committed Rastafari who infused his music with a profound sense of spirituality', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, '', NULL, NULL, '3375-bob-marley', 0, NULL, 1, 'https://www.youtube.com/watch?v=K69A1lL1', 'https://www.youtube.com/watch?v=K69A1lL1', '');

-- --------------------------------------------------------

--
-- Table structure for table `products_sub_categories`
--

CREATE TABLE IF NOT EXISTS `products_sub_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=109 ;

--
-- Dumping data for table `products_sub_categories`
--

INSERT INTO `products_sub_categories` (`id`, `product_id`, `sub_category_id`) VALUES
(36, 4, 8),
(35, 4, 8),
(34, 4, 8),
(51, 5, 8),
(50, 5, 8),
(49, 5, 8),
(27, 1, 6),
(26, 1, 6),
(25, 1, 6),
(87, 2, 6),
(86, 2, 6),
(85, 2, 6),
(33, 3, 6),
(32, 3, 6),
(31, 3, 6),
(45, 6, 8),
(44, 6, 9),
(43, 6, 8),
(46, 14, 5),
(47, 14, 5),
(48, 14, 5),
(57, 15, 8),
(56, 15, 9),
(55, 15, 6),
(58, 16, 3),
(59, 16, 3),
(60, 16, 3),
(66, 17, 2),
(65, 17, 2),
(64, 17, 2),
(72, 18, 1),
(71, 18, 1),
(70, 18, 1),
(73, 19, 2),
(74, 19, 2),
(75, 19, 2),
(76, 20, 1),
(77, 20, 1),
(78, 20, 1),
(79, 21, 4),
(80, 21, 4),
(81, 21, 4),
(82, 22, 1),
(83, 22, 1),
(84, 22, 1),
(88, 23, 6),
(89, 23, 6),
(90, 23, 6),
(91, 24, 1),
(92, 24, 1),
(93, 24, 1),
(94, 25, 1),
(95, 25, 1),
(96, 25, 1),
(97, 26, 1),
(98, 26, 1),
(99, 26, 1),
(100, 27, 1),
(101, 27, 1),
(102, 27, 1),
(103, 28, 1),
(104, 28, 1),
(105, 28, 1),
(106, 29, 1),
(107, 29, 1),
(108, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about_me` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `sex` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `languages` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `about_me`, `sex`, `phone`, `zone_id`, `full_name`, `languages`, `image`) VALUES
(1, 1, NULL, NULL, '8764324682', 419, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedulers`
--

CREATE TABLE IF NOT EXISTS `schedulers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `multiday` tinyint(1) DEFAULT NULL,
  `recurring` tinyint(1) DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `quantity_min` int(11) DEFAULT NULL,
  `quantity_max` int(11) DEFAULT NULL,
  `all_day` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `search_indices`
--

CREATE TABLE IF NOT EXISTS `search_indices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `association_key` int(11) NOT NULL,
  `model` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_key` (`association_key`,`model`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `search_indices`
--

INSERT INTO `search_indices` (`id`, `association_key`, `model`, `data`, `created`, `modified`) VALUES
(1, 1, 'Product', 'Hotel Riu Montego Bay. The Hotel Riu Montego Bay (All Inclusive 24h) is located in the northeast of the island in a bay close to Montego Bay, Jamaica, offers a wide range of service to its clients next to a tranquil beach with turquoise water.\r\n\r\nIf you are looking for recharging, the Riu Hotel Montego Bay provides the best installations for it: A cool water swimming pool, Jacuzzi, sauna, a gym and the wellness center ''Renova Spa'' with different kinds of treatments.\r\n\r\nThe hotel offers a service with high quality such as the All Inclusive system where the clients comfort and enjoyment are the most important aspects. For that you will have the possibility to try a wide variety of food in the restaurantÂ´s buffet and to taste the best gastronomy that our chefs prepare in the theme restaurants..  Montego Bay, Jamaica. All Inclusive', '2013-05-27 12:54:29', '2013-06-03 19:18:36'),
(2, 2, 'Product', 'Jamaica Inn. It begins the moment you arrive at this timeless Jamaica hotel.\r\n\r\nYou sense a warm, familiar feeling that only grows as you stroll the beautifully manicured grounds to your antique-appointed bedroom.\r\n\r\nThen, standing on your private, exquisitely furnished verandah drinking in the magnificent Caribbean vista, it all becomes clear. Youâ€™ve come home.\r\n\r\nSince 1950, Jamaica Inn has consistently ranked among the top luxury hotels in Jamaica and the Caribbean. Located in Ocho Rios on one of the premier private beaches in Jamaica, the hotel features just 48 suites and cottages, each with a view of the Caribbean Sea.. Ocho Rios, St. Ann, Jamaica. All Inclusive', '2013-05-28 19:44:19', '2013-12-11 16:19:03'),
(3, 3, 'Product', 'Grand Pineapple Beach Resort Negril. Nestled amidst lush greenery, swaying palm trees and manicured lawns, featuring whimsical, vividly hued architecture and a prime spot on one of the world''s most beloved beaches, every inch of this Negril all-inclusive resort in Jamaica invites you to submerge yourself completely in the heart and soul of the tropics. Dig your toes into sugary white sands.\r\n\r\n Stroll aimlessly through luscious, scent-laden foliage. Lose all track of time in this intimate getaway, as you swim endlessly in sparkling turquoise waters. Experience the very essence of the islands at this all-inclusive beach resort in Negril, Jamaica.. Negril, Jamaica. All Inclusive', '2013-05-28 19:48:11', '2013-06-03 19:39:02'),
(4, 4, 'Product', 'Altamont Court Hotel. Situated in the heart of New Kingston, Jamaica, this Conde'' Nast Traveler-recommended hotel is a social, entertainment and business hub. Altamont Court''s central location places it close to two airports; marinas; wharfs; several high commissions and embassies; major convention sites; local and international banks; couriers and money transfer services; art galleries; museums; nightclubs and entertainment centers.\r\n\r\nSpecial group rates and conference packages are available through our Sales Department.\r\n\r\nOur closeness to Kingston''s financial and business centres, entertainment and shopping venues, universities and general city amenities makes Altamont Court Hotel in Kingston the ideal accommodation for business and leisure travellers alike.. New Kingston, Jamaica. Business', '2013-05-30 02:32:48', '2013-06-03 19:52:55'),
(5, 5, 'Product', 'Christar Villas Hotel. \r\nSet in Kingstonâ€™s city centre, this hotel is less than 1 km from Bob Marley Museum. It offers a restaurant with daily continental breakfast, free wired internet and guest rooms with a full kitchenette.\r\n\r\nA cable TV and a work desk are furnished in all rooms at Christar Villas Hotel. The simply styled accommodation also provides a private balcony and a seating area.\r\n\r\nGuests at Hotel Christar Villas can use the on-site fitness room or business centre. Meeting and banquet facilities are also available.\r\n\r\nThis hotel is 4 km from Hope Gardens, and 1.3 km from Devon House & the United States Embassy. University of the West Indies is a 12-minute drive away.\r\n. New Kingston, Jamaica. Business', '2013-05-30 02:38:03', '2013-06-04 20:35:24'),
(6, 6, 'Product', 'Courtleigh Hotel And Suites. ocated only 25 minutes away from the Norman Manley International Airport in the heart of the city''s premiere financial district, New Kingston, Jamaica the hotel offers, to discerning guests, unparalleled personalized service. Kingston ''s top shopping, cultural and entertainment centers; nightclubs, restaurants, international business offices and embassies are within a five-minute walk.\r\n\r\n The Courtleigh Hotel & Suites is the perfect jump off point for visits to the old pirate city of Port Royal , the famous Devon House, the Bob Marley Museum (former home of the Reggae King), Lime Cay for swimming and the magnificent Blue Mountains (over 7000 feet above sea level) for hiking, birding or sight seeing tour.. New Kingston, Jamaica. Business. Weddings', '2013-06-03 21:02:35', '2013-06-03 21:11:34'),
(7, 7, 'Product', 'Avis Rent A Car Jamaica. Taking care of your transportation needs is what we do best at AVIS Jamaica. Our courteous, efficient and experienced staff has been in the car rental business since 1983. We have three (3) offices strategically located throughout the island, including in-terminal rental kiosks at both of Jamaicaâ€™s international airports. \r\n\r\nAVIS Jamaica is operated by Bargain Rent-A-Car (Jamaica) Ltd, the exclusive licensee for the island. Over the past 2 decades, the Companyâ€™s growth has been accompanied by a significant increase in market share, thus allowing us to become a top car rental Company on the island. . Kingston, Jamaica', '2013-06-03 21:57:28', '2013-06-03 21:57:28'),
(8, 8, 'Product', 'Cavanor Auto Rentals Ltd. We have over 10 years experience in the auto rental industry. We look forward to providing you with our excellent customer care and our fine fleet of vehicles to suit your transportation needs.. Kingston, Jamaica', '2013-06-03 22:27:12', '2013-06-03 22:27:12'),
(9, 9, 'Product', 'Island Car Rentals. Need a rental car in Jamaica? There is only one choice. Island Car Rentals Ltd. has been in operation in Jamaica for over thirty years and is the largest Jamaican rent-a-car company with branches in Montego Bay and Kingston serving vacationers, returning residents and locals. \r\n\r\nThe company is licensed by the Jamaica Tourist Board and is a member of the Jamaica Hotel & Tourist Association and the Jamaica U-drive Association. Island offers a range of ground transportation services. Clients may opt for sightseeing tours, private transfers, executive chauffeur service or day trips as well as car rentals.\r\n\r\n For visitors seeking a flexible, varied holiday that allows them to see all Jamaica, we offer Fly/Drive Jamaica, a unique vacation package with attractive rates that include a choice of accommodations and a rented car. . Montego Bay, Jamaica', '2013-06-03 23:12:23', '2013-06-03 23:12:23'),
(10, 10, 'Product', 'Fiesta Car Rentals Jamaica Limited.  Fiesta offers free airport/hotel pick-up and drop-off; comfortable new cars at affordable rates, free cellular phones (conditions apply) and everything else you''ve ever wanted in a car rental company are a way of life for us. \r\n\r\nOther Office:\r\nMontego Freeport, St James, Jamaica. Waterloo Rd, Kingston, Jamaica', '2013-06-04 13:46:56', '2013-06-04 13:52:24'),
(11, 11, 'Product', 'Dhana Car Rental and Tours. In 1994 Dhana became the first Jamaican Car Rental Company to advertise on the internet. We recognized that "direct to customer" rentals meant we could offer the best car rental rates on the island of Jamaica. \r\n\r\nThese low rates, combined with our personalized, professional and friendly Jamaican service, proved to be a winning combination. Dhana Car Rental & Tours, Ltd. has been the leading car rental company in Jamaica for the last ten years. . Montego Bay, Jamaica', '2013-06-04 14:29:29', '2013-06-04 14:29:29'),
(12, 12, 'Product', 'Dhana Car Rental and Tours. In 1994 Dhana became the first Jamaican Car Rental Company to advertise on the internet. We recognized that "direct to customer" rentals meant we could offer the best car rental rates on the island of Jamaica.\r\n\r\n These low rates, combined with our personalized, professional and friendly Jamaican service, proved to be a winning combination. Dhana Car Rental & Tours, Ltd. has been the leading car rental company in Jamaica for the last ten years. . Montego Bay, Jamaica', '2013-06-04 14:55:59', '2013-06-04 14:55:59'),
(13, 13, 'Product', ' Prospective Car Rentals & Tours Ltd.  Welcome to Prospective Rent-A-Car. We make car rental in Jamaica as splendid as any holiday, easy, exciting and exceptional. We are Montego Bay''s most prestigious car rental company, offering affordable rental rates, nice and spacious cars and Suvs, we await you as you arrive at the Sangster International Airport in Montego Bay, Jamaica. We give you comfortable care like that received on airplane flights.\r\n\r\nRenting a car in Jamaica has been mastered by Prospective Rent-A-Car - a family owned and operated business - since July of 1985, we have made thousands of car renters happy, on vacation in Jamaica and we still will because we guarantee world class service and offer immaculate, reliable cars for rental. We are one of oldest, finest and most respected car rental and Jamaica Tour Company. With more than twenty (20) staff members to make your trip to Jamaica the ultimate and unforgettable - thatâ€™s our commitment.. Montego Bay, Jamaica', '2013-06-04 19:35:13', '2013-06-04 19:35:13'),
(14, 14, 'Product', 'Gorgeous Flowers Company Ltd. Gorgeous Flowers has been serving its Jamaican community since 1992. Twenty years of dedication and exceptional service, we have been serving our valued customers; businesses, schools, families, churches, and our loyal florist companies. Our competitive prices allow us to be among the top florists in Jamaica.\r\n\r\n\r\nWe have been meeting the needs of special occasions across the world as we are a member of the Teleflora Community. Through our network we are able to send flowers and gift items through other Teleflora members operating near your loved one. We cater for various occasions such as, Birthdays, Anniversaries, New Arrivals, Weddings, Funerals, Business Functions, Church Functions, Sympathy, Thank you, Congratulations, Graduations, Just Because, Iâ€™m sorry, Christmas, Motherâ€™s day, Fatherâ€™s day and Valentines.. Kingston, Jamaica. Craft Market', '2013-06-04 20:31:19', '2013-06-04 20:31:19'),
(15, 15, 'Product', 'Sea Wind Resort. A hidden paradise resort located in beautiful Negril, Jamaica. Sea Wind Resort is located only 1h30 min from Montego Bay Airport and directly on Negril''s famous 7-miles white sand beach. Only a few steps to the beach, 5 minutes away from all shopping centers, live reggae music and great dance clubs.. Negril, Jamaica. All Inclusive. Weddings. Business', '2013-06-04 20:50:32', '2013-06-04 20:54:35'),
(16, 16, 'Product', 'Toscanini Italian Restaurant & Bar. Near to Ocho Rios, at Harmony Hall, there is a famous Italian restaurant which is called Toscanini form the name of an Italian musician.\r\n\r\nThe owners are Mirella Ricci and Pierluigi Ricci, the chef which in 1999 was winning the prize as best new chef in Jamaica.\r\n\r\nToscanini restaurant is located in an ancient beautiful colonial villa which was into a wide pimento plantation.\r\n\r\nAmong its habitual customers Toscanini has famous politicians, musicians, intellectuals and spot men. Most of its guests are Americans, Canadians, Japanese, British.\r\n\r\nToscanini has a great reputation and he has been mentioned by The Jamaica Observer, national newspaper with pictures and specials after winning the Award for the best quality service.\r\n\r\nContact For Queries: \r\nTelephone: 876-975-4785. Harmoney Hall, Jamaica. Italian', '2013-06-05 20:08:56', '2013-06-05 20:08:56'),
(17, 17, 'Product', 'Golden Bowl Restaurant. Whether you choose to eat in the elegant dining room, or opt for the efficient take out service, you and your guests will enjoy this fine Chinese restaurant. The friendly staff, comfortable ambiance, excellent food and affordable prices keep diners coming back for more\r\n\r\n The spacious dining area offers large tables for families and groups, as well as intimate corner tables for two. Secure, private parking facilities are provided. Reservations are required for parties of ten or more persons. Although there is no ramp for the disabled, the doors are wide enough to accommodate a wheel chair.\r\n\r\nFor Reservations:\r\n\r\n 876-929-8556\r\n876-960-1030. Kingston, Jamaica. Chinese', '2013-06-05 20:28:39', '2013-06-05 20:33:29'),
(18, 18, 'Product', 'China Express. China Express serves up Kingston''s finest Chinese cuisine with exciting dishes and unique ambiance. Our menu offers a variety of regional creations from our province schools of cooking, whether it is a Szechwan, Hunan, Shanghai, Peking or Cantonese style you will find it here. Our authentic menu and atmosphere creates a truly enjoyable dining experience.\r\nChina Express has been a local favourite since 1983. We have received numerous recommendations and awards throughout the years for our delicious and creative dishes. Our menu offers many popular specials as well as a variety of vegetarian dishes and other healthy alternatives to suit your lifestyle.\r\n\r\n\r\nWe will greet you with the warmest welcome, whether you are a regular patron or coming for the first time. Much painstaking effort has been made to create the tidiest and cleanest dining place and we guarantee you friendly and timely service.. Kingston, Jamaica. Indian', '2013-06-05 20:51:33', '2013-06-05 20:54:04'),
(19, 19, 'Product', 'Jade Garden Restaurant. Come to Jade Garden Restaurant for a taste of the Orient. Enjoy the elegant and exquisite ambiance of our comfortable cocktail lounge and private dining room. In addition a private conference room is also available. Call or visit us for reservations or take out service. All major credit cards are accepted.\r\n\r\nReservation:\r\nSovereign Centre, 106 Hope Road, Kingston, Jamaica\r\n978-3476-9. Kingston, Jamaica. Chinese', '2013-06-05 21:20:03', '2013-06-05 21:20:03'),
(20, 20, 'Product', 'Cuddy''z Sports Bar & Restaurant. Cuddy''z Ultimate Sports Bar is owned by none other the famed Cricketer Courtney A. Walsh. Courtney Walsh is a former international cricketer who represented the West Indies from 1984 to 2001, captaining the West Indies in 22 Test matches. Itâ€™s no wonder the interior is heavily decorated with memorabilia from the world of sports.\r\n\r\nCuddyâ€™z is a swinging high-tech sports bar with over 55 big screens. The menu is made up of sports-themed dishes such as the Formula One Burger, the Champion Cheeseburger, or the cake and vanilla dessert known ready to rumble. Kids are welcome and have their own menu and there is no cover charge except for when a big game is on.\r\n\r\nReservations:\r\n876-920-8019\r\n\r\nHours of Operation\r\nMonday to Thursday: 11:30 am - 1:00 am\r\nFriday and Saturday: 11:30 am - 2:00 am\r\nSunday: 1:00 pm - 11:00 pm. Kingston, Jamaica. Indian', '2013-06-05 21:29:12', '2013-06-05 21:29:12'),
(21, 21, 'Product', 'CafÃ© Whats On. Creative relaxing cafe with scrumptious all day breakfast menu and our usual lunch favourites wraps, burgers and salads, soups, fresh juices and coffee. Meeting rooms available for hire and free Wifi.\r\n\r\nOpening Hours:  \r\n\r\nMon - Sat: 10:00 am - 3:00 pm\r\n\r\nReservations: \r\n\r\n133 Barbican Road, Kingston, Jamaica\r\n969-5862.  Kingston, Jamaica. Jamaican', '2013-06-08 15:46:53', '2013-06-08 15:46:53'),
(22, 22, 'Product', 'Test. Teting. try. Indian', '2013-08-26 18:47:01', '2013-08-26 18:47:01'),
(23, 23, 'Product', 'My Product. Set in Kingstonâ€™s city centre, this hotel is less than 1 km from Bob Marley Museum. It offers a restaurant with daily continental breakfast, free wired internet and guest rooms with a full kitchenette.\r\n\r\nA cable TV and a work desk are furnished in all rooms at Christar Villas Hotel. The simply styled accommodation also provides a private balcony and a seating area.\r\n\r\nGuests at Hotel Christar Villas can use the on-site fitness room or business centre. Meeting and banquet facilities are also available.\r\n\r\nThis hotel is 4 km from Hope Gardens, and 1.3 km from Devon House & the United States Embassy. University of the West Indies is a 12-minute drive away.. Kingston, Jamaica. All Inclusive', '2013-12-12 02:29:55', '2013-12-12 02:29:55'),
(24, 24, 'Product', 'hhh. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?. Indian', '2014-04-11 17:22:48', '2014-04-11 17:22:48'),
(25, 25, 'Product', 'https://www.youtube.com/watch?v=MHI8yixm. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?. Indian', '2014-04-11 17:24:50', '2014-04-11 17:24:50'),
(26, 26, 'Product', 'https://www.youtube.com/watch?v=MHI8yixm. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?. Indian', '2014-04-11 17:24:59', '2014-04-11 17:24:59'),
(27, 27, 'Product', 'www. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?. Indian', '2014-04-11 17:25:24', '2014-04-11 17:25:24'),
(28, 28, 'Product', 'h. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?. Indian', '2014-04-11 17:26:26', '2014-04-11 17:26:26'),
(29, 29, 'Product', 'gg. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?. Indian', '2014-04-11 17:28:45', '2014-04-11 17:28:45'),
(30, 30, 'Product', 'eee. https://www.youtube.com/watch?v=MHI8yixmhAQ. https://www.youtube.com/watch?', '2014-04-11 17:29:21', '2014-04-11 17:29:21'),
(31, 31, 'Product', 'Ijah Shaani. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.". Kingston, Jamaica', '2014-04-11 17:36:07', '2014-04-11 17:37:13'),
(32, 32, 'Product', 'sdsd. sdsd. sdsd', '2014-04-11 17:37:58', '2014-04-11 17:37:58'),
(33, 33, 'Product', 'Bob Marley. Robert Nesta "Bob" Marley OM (6 February 1945 â€“ 11 May 1981) was a Jamaican reggae singer-songwriter and guitarist who achieved international fame and acclaim.[1][2] Starting out in 1963 with the group the Wailers, he forged a distinctive songwriting and vocal style that would later resonate with audiences worldwide. The Wailers would go on to release some of the earliest reggae records with producer Lee Scratch Perry.[3] After the Wailers disbanded in 1974,[4] Marley pursued a solo career which culminated in the release of the album Exodus in 1977 which established his worldwide reputation.[5] He was a committed Rastafari who infused his music with a profound sense of spirituality. Kingston, Jamaica', '2014-04-12 16:52:36', '2014-04-12 17:10:39'),
(34, 34, 'Product', 'Beyonce.  is an American recording artist and actress. Born and raised in Houston, Texas, she performed in various singing and dancing competitions as a child, and rose to fame in the late 1990s as lead singer of R&B girl-group Destiny''s Child. Managed by her father Mathew Knowles, the group became one of the world''s best-selling girl groups of all time. Their hiatus saw the release of BeyoncÃ©''s debut album, Dangerously in Love (2003), which established her as a solo artist worldwide; it sold 11 million copies, earned five Grammy Awards and featured the Billboard number-one singles "Crazy in Love" and "Baby Boy".. Runaway Bay Heart Hotel', '2014-04-12 17:20:40', '2014-04-12 17:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Indian'),
(2, 1, 'Chinese'),
(3, 1, 'Italian'),
(4, 1, 'Jamaican'),
(5, 4, 'Craft Market'),
(6, 2, 'All Inclusive'),
(7, 2, 'Beach front'),
(8, 2, 'Business'),
(9, 2, 'Weddings');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `token` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `data` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `created`, `modified`, `token`, `data`) VALUES
(13, '2013-06-04 21:01:35', '2013-06-04 21:01:35', '97c23456d2', 'a:1:{s:4:"User";a:10:{s:2:"id";s:3:"126";s:5:"title";N;s:7:"created";s:19:"2013-06-04 20:45:55";s:8:"modified";s:19:"2013-06-04 21:01:21";s:9:"lastlogin";s:19:"2013-06-04 21:01:21";s:10:"first_name";s:8:"fellisha";s:9:"last_name";s:8:"williams";s:11:"middle_name";N;s:5:"email";s:26:"fellishawilliams@yahoo.com";s:8:"password";s:40:"1b3f096d5128a8e6d6018a9219c2e6917818c05c";}}'),
(12, '2013-06-04 20:47:18', '2013-06-04 20:47:18', 'a45ac06853', 'a:1:{s:4:"User";a:10:{s:2:"id";s:3:"126";s:5:"title";N;s:7:"created";s:19:"2013-06-04 20:45:55";s:8:"modified";s:19:"2013-06-04 20:47:00";s:9:"lastlogin";s:19:"2013-06-04 20:47:00";s:10:"first_name";s:8:"fellisha";s:9:"last_name";s:8:"williams";s:11:"middle_name";N;s:5:"email";s:26:"fellishawilliams@yahoo.com";s:8:"password";s:40:"1b3f096d5128a8e6d6018a9219c2e6917818c05c";}}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `middle_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(42) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(128) COLLATE utf8_bin NOT NULL,
  `role` varchar(64) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=128 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `created`, `modified`, `lastlogin`, `first_name`, `last_name`, `middle_name`, `email`, `password`, `username`, `role`, `status`) VALUES
(125, NULL, '2013-05-31 22:51:36', '2013-06-04 13:41:09', '2013-06-04 13:41:09', 'Horace', 'Cunningham', NULL, 'herrhorace@gmail.com', '852afc511e73d6b74d2aea776fb39ebeafbe1378', '', '', 0),
(101, NULL, '2013-05-27 12:52:56', '2013-05-27 12:52:56', '2013-05-27 12:52:56', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(102, NULL, '2013-05-27 21:45:01', '2013-05-27 21:45:01', '2013-05-27 21:45:01', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(103, NULL, '2013-05-28 01:17:08', '2013-05-28 01:17:08', '2013-05-28 01:17:08', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(104, NULL, '2013-05-28 14:05:33', '2013-05-28 14:05:33', '2013-05-28 14:05:33', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(105, NULL, '2013-05-28 15:21:25', '2013-05-28 15:22:08', '2013-05-28 15:22:08', 'John ', 'Dough', NULL, 'nonfabricated@hotmail.com', '77c87b93dc113f501cebe27c81a014124035788f', '', '', 0),
(106, NULL, '2013-05-28 19:43:15', '2014-04-11 15:11:11', '2013-05-28 19:43:15', NULL, NULL, NULL, NULL, NULL, '', '', 1),
(107, NULL, '2013-05-29 00:10:30', '2013-05-29 00:10:30', '2013-05-29 00:10:30', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(108, NULL, '2013-05-29 02:03:15', '2013-05-29 02:03:15', '2013-05-29 02:03:15', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(109, NULL, '2013-05-29 13:10:51', '2013-05-29 13:10:51', '2013-05-29 13:10:51', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(110, NULL, '2013-05-29 17:17:37', '2013-05-29 17:17:37', '2013-05-29 17:17:37', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(111, NULL, '2013-05-29 21:54:45', '2013-05-29 21:54:45', '2013-05-29 21:54:45', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(112, NULL, '2013-05-29 23:49:58', '2013-05-29 23:49:58', '2013-05-29 23:49:58', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(113, NULL, '2013-05-29 23:50:32', '2013-05-29 23:50:32', '2013-05-29 23:50:32', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(115, NULL, '2013-05-30 01:01:33', '2013-05-30 01:01:33', '2013-05-30 01:01:33', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(116, NULL, '2013-05-30 02:08:09', '2013-05-30 02:08:09', '2013-05-30 02:08:09', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(117, NULL, '2013-05-30 02:28:48', '2013-05-30 02:28:48', '2013-05-30 02:28:48', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(118, NULL, '2013-05-30 13:22:47', '2013-05-30 13:22:47', '2013-05-30 13:22:47', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(119, NULL, '2013-05-30 14:23:04', '2013-05-30 14:23:04', '2013-05-30 14:23:04', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(120, NULL, '2013-05-31 01:07:50', '2013-05-31 01:07:50', '2013-05-31 01:07:50', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(121, NULL, '2013-05-31 03:18:26', '2013-05-31 03:20:57', '2013-05-31 03:20:57', 'Andre', 'Piper', NULL, 'apiper2012@live.com', '206af8d4de317a67806d200940bdcae5601b87e5', '', '', 0),
(122, NULL, '2013-05-31 03:23:59', '2013-05-31 03:23:59', '2013-05-31 03:23:59', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(123, NULL, '2013-05-31 13:12:22', '2013-05-31 13:12:22', '2013-05-31 13:12:22', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(124, NULL, '2013-05-31 22:32:35', '2013-05-31 22:32:35', '2013-05-31 22:32:35', NULL, NULL, NULL, NULL, NULL, '', '', 0),
(126, NULL, '2013-06-04 20:45:55', '2013-06-04 21:01:21', '2013-06-04 21:01:21', 'fellisha', 'williams', NULL, 'fellishawilliams@yahoo.com', '1b3f096d5128a8e6d6018a9219c2e6917818c05c', '', '', 0),
(127, NULL, '2014-04-11 15:10:31', '2014-04-11 15:10:31', NULL, NULL, NULL, NULL, 'pan@gmail.com', '2bf3d8f2886f2299df01f950e54c671c0a0155d8', 'herrhorace', 'king', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(35) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_zone_name` (`zone_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=550 ;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `zone_name`) VALUES
(419, 'Pacific/Honolulu'),
(420, 'America/Anchorage'),
(421, 'America/Los_Angeles'),
(422, 'America/Phoenix'),
(423, 'America/Denver'),
(424, 'America/Chicago'),
(425, 'America/New_York'),
(426, 'America/Indiana/Indianapolis'),
(427, 'Pacific/Midway'),
(428, 'Pacific/Pago_Pago'),
(429, 'Pacific/Honolulu'),
(430, 'America/Juneau'),
(431, 'America/Los_Angeles'),
(432, 'America/Tijuana'),
(433, 'America/Denver'),
(434, 'America/Phoenix'),
(435, 'America/Chihuahua'),
(436, 'America/Mazatlan'),
(437, 'America/Chicago'),
(438, 'America/Regina'),
(439, 'America/Mexico_City'),
(440, 'America/Monterrey'),
(441, 'America/Guatemala'),
(442, 'America/New_York'),
(443, 'America/Indiana/Indianapolis'),
(444, 'America/Bogota'),
(445, 'America/Lima'),
(446, 'America/Halifax'),
(447, 'America/Caracas'),
(448, 'America/La_Paz'),
(449, 'America/Santiago'),
(450, 'America/St_Johns'),
(451, 'America/Sao_Paulo'),
(452, 'America/Argentina/Buenos_Aires'),
(453, 'America/Guyana'),
(454, 'America/Godthab'),
(455, 'Atlantic/South_Georgia'),
(456, 'Atlantic/Azores'),
(457, 'Atlantic/Cape_Verde'),
(458, 'Europe/Dublin'),
(459, 'Europe/London'),
(460, 'Europe/Lisbon'),
(461, 'Africa/Casablanca'),
(462, 'Africa/Monrovia'),
(463, 'Etc/UTC'),
(464, 'Europe/Belgrade'),
(465, 'Europe/Bratislava'),
(466, 'Europe/Budapest'),
(467, 'Europe/Ljubljana'),
(468, 'Europe/Prague'),
(469, 'Europe/Sarajevo'),
(470, 'Europe/Skopje'),
(471, 'Europe/Warsaw'),
(472, 'Europe/Zagreb'),
(473, 'Europe/Brussels'),
(474, 'Europe/Copenhagen'),
(475, 'Europe/Madrid'),
(476, 'Europe/Paris'),
(477, 'Europe/Amsterdam'),
(478, 'Europe/Berlin'),
(479, 'Europe/Rome'),
(480, 'Europe/Stockholm'),
(481, 'Europe/Vienna'),
(482, 'Africa/Algiers'),
(483, 'Europe/Bucharest'),
(484, 'Africa/Cairo'),
(485, 'Europe/Helsinki'),
(486, 'Europe/Kiev'),
(487, 'Europe/Riga'),
(488, 'Europe/Sofia'),
(489, 'Europe/Tallinn'),
(490, 'Europe/Vilnius'),
(491, 'Europe/Athens'),
(492, 'Europe/Istanbul'),
(493, 'Europe/Minsk'),
(494, 'Asia/Jerusalem'),
(495, 'Africa/Harare'),
(496, 'Africa/Johannesburg'),
(497, 'Europe/Moscow'),
(498, 'Asia/Kuwait'),
(499, 'Asia/Riyadh'),
(500, 'Africa/Nairobi'),
(501, 'Asia/Baghdad'),
(502, 'Asia/Tehran'),
(503, 'Asia/Muscat'),
(504, 'Asia/Baku'),
(505, 'Asia/Tbilisi'),
(506, 'Asia/Yerevan'),
(507, 'Asia/Kabul'),
(508, 'Asia/Yekaterinburg'),
(509, 'Asia/Karachi'),
(510, 'Asia/Tashkent'),
(511, 'Asia/Kolkata'),
(512, 'Asia/Kathmandu'),
(513, 'Asia/Dhaka'),
(514, 'Asia/Colombo'),
(515, 'Asia/Almaty'),
(516, 'Asia/Novosibirsk'),
(517, 'Asia/Rangoon'),
(518, 'Asia/Bangkok'),
(519, 'Asia/Jakarta'),
(520, 'Asia/Krasnoyarsk'),
(521, 'Asia/Shanghai'),
(522, 'Asia/Chongqing'),
(523, 'Asia/Hong_Kong'),
(524, 'Asia/Urumqi'),
(525, 'Asia/Kuala_Lumpur'),
(526, 'Asia/Singapore'),
(527, 'Asia/Taipei'),
(528, 'Australia/Perth'),
(529, 'Asia/Irkutsk'),
(530, 'Asia/Ulaanbaatar'),
(531, 'Asia/Seoul'),
(532, 'Asia/Tokyo'),
(533, 'Asia/Yakutsk'),
(534, 'Australia/Darwin'),
(535, 'Australia/Adelaide'),
(536, 'Australia/Melbourne'),
(537, 'Australia/Sydney'),
(538, 'Australia/Brisbane'),
(539, 'Australia/Hobart'),
(540, 'Asia/Vladivostok'),
(541, 'Pacific/Guam'),
(542, 'Pacific/Port_Moresby'),
(543, 'Asia/Magadan'),
(544, 'Pacific/Noumea'),
(545, 'Pacific/Fiji'),
(546, 'Asia/Kamchatka'),
(547, 'Pacific/Majuro'),
(548, 'Pacific/Auckland'),
(549, 'Pacific/Tongatapu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
