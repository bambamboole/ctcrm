-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. Feb 2015 um 18:16
-- Server Version: 5.5.41-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `testdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `testtable`
--

DROP TABLE IF EXISTS `testtable`;
CREATE TABLE IF NOT EXISTS `testtable` (
  `TESTCOLUMN_INT` int(11) NOT NULL AUTO_INCREMENT,
  `TESTCOLUMN_CONTAINING_ONLY_NULL` tinyint(1) DEFAULT NULL,
  `TESTCOLUMN_BOOLEAN` tinyint(1) NOT NULL,
  `TESTCOLUMN_FLOAT` float NOT NULL,
  `TESTCOLUMN_ENUM` enum('ONE','TWO') NOT NULL,
  `TESTCOLUMN_VARCHAR` varchar(50) NOT NULL,
  `TESTCOLUMN_BLOB` blob NOT NULL,
  PRIMARY KEY (`TESTCOLUMN_INT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- TRUNCATE Tabelle vor dem Einfügen `testtable`
--

TRUNCATE TABLE `testtable`;
--
-- Daten für Tabelle `testtable`
--

INSERT INTO `testtable` (`TESTCOLUMN_INT`, `TESTCOLUMN_CONTAINING_ONLY_NULL`, `TESTCOLUMN_BOOLEAN`, `TESTCOLUMN_FLOAT`, `TESTCOLUMN_ENUM`, `TESTCOLUMN_VARCHAR`, `TESTCOLUMN_BLOB`) VALUES
(1, NULL, 0, 0, 'ONE', '', '');
