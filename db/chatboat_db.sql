-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 22, 2019 at 07:27 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatboat`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(500) DEFAULT NULL,
  `question_short_text` varchar(255) DEFAULT NULL,
  `question_type` varchar(255) DEFAULT NULL,
  `category` int(3) DEFAULT NULL,
  `optional` tinyint(1) DEFAULT NULL COMMENT '1->can skip,0->cannot sikp',
  `status` tinyint(1) DEFAULT '1' COMMENT '1->active,0->inactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `question_short_text`, `question_type`, `category`, `optional`, `status`) VALUES
(1, 'How namy years of experiance you have', 'Experience', 'dropdown', 1, 1, 1),
(2, 'How namy technoloties you know', 'Technologies', 'checkbox', 1, 0, 1),
(3, 'What is your current package', 'Cur pack', 'input', 1, 1, 1),
(4, 'What is your expected package', 'Exp. pack', 'radio', 1, 0, 1),
(5, 'Are you willing to relocate', 'Relocate', 'radio', 1, 1, 1),
(7, 'How many team members you have', 'Team size', 'dropdown', 1, 0, 1),
(8, 'Where are you from', 'locatin', 'input', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

DROP TABLE IF EXISTS `question_answers`;
CREATE TABLE IF NOT EXISTS `question_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(500) DEFAULT NULL,
  `question_answer` varchar(255) DEFAULT NULL,
  `candidate_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answers`
--

INSERT INTO `question_answers` (`id`, `question_text`, `question_answer`, `candidate_name`) VALUES
(1, 'Technologies', 'html,php,mysql,javascript', 'dfghjkl;kjhgf'),
(2, 'Team size', '1-2', 'dfghjkl;kjhgf'),
(3, 'Technologies', 'php', 'test'),
(4, 'Exp. pack', '8-9', 'test'),
(5, 'Relocate', 'yes', 'test'),
(6, 'Team size', '1-2', 'test'),
(7, 'Technologies', 'php', 'test'),
(8, 'Exp. pack', '7-8', 'test'),
(9, 'Relocate', 'yes', 'test'),
(10, 'Team size', '1-2', 'test'),
(11, 'Technologies', 'php', 'test'),
(12, 'Exp. pack', '7-8', 'test'),
(13, 'Relocate', 'yes', 'test'),
(14, 'Team size', '3-4', 'test'),
(15, 'Experience', 'You skipped this question.!', 'suresh'),
(16, 'Technologies', 'php', 'suresh'),
(17, 'Cur pack', '4 lpa', 'suresh'),
(18, 'Exp. pack', '8-9', 'suresh'),
(19, 'Relocate', 'no', 'suresh'),
(20, 'Team size', '2-3', 'suresh'),
(21, 'Experience', 'You skipped this question.!', 'Prudve'),
(22, 'Technologies', 'php', 'Prudve'),
(23, 'Cur pack', '4lpa', 'Prudve'),
(24, 'Exp. pack', '8-9', 'Prudve'),
(25, 'Relocate', 'no', 'Prudve'),
(26, 'Team size', '2-3', 'Prudve'),
(27, 'locatin', 'Hyderabad', 'Prudve'),
(28, 'Experience', '1-2', 'suresh'),
(29, 'Technologies', 'html,javascript', 'suresh'),
(30, 'Cur pack', '3.2', 'suresh'),
(31, 'Exp. pack', '5-6', 'suresh'),
(32, 'Relocate', 'yes', 'suresh'),
(33, 'Team size', '3-4', 'suresh'),
(34, 'locatin', 'hyd', 'suresh'),
(35, 'Experience', '2-3', 'santhosh'),
(36, 'Technologies', 'javascript', 'santhosh'),
(37, 'Experience', 'You skipped this question.!', 'sad   sdf sdf'),
(38, 'Technologies', 'html', 'sad   sdf sdf'),
(39, 'Experience', '1-2', 'fg hh'),
(40, 'Experience', 'You skipped this question.!', 'sdfghjll'),
(41, 'Experience', '2-3', 'df sf34234#@$@#$'),
(42, 'Experience', '3-4', 'fghjk'),
(43, 'Experience', '3-4', 'dfghjkl'),
(44, 'Experience', '1-2', 'vbnm,'),
(45, 'Experience', '2-3', 'fgjkl'),
(46, 'Experience', '1-2', 'fghjk'),
(47, 'Experience', '3-4', 'fghjk'),
(48, 'Experience', '4-5', 'fghjk'),
(49, 'Experience', '1-2', 'dfghjk'),
(50, 'Technologies', 'html', 'dfghjk'),
(51, 'Experience', 'You skipped this question.!', 'vbnm,,'),
(52, 'Technologies', 'javascript', 'vbnm,,'),
(53, 'Cur pack', 'sdfghjkl;lkjhg', 'vbnm,,'),
(54, 'Exp. pack', '8-9', 'vbnm,,'),
(55, 'Relocate', 'no', 'vbnm,,'),
(56, 'Team size', '4-5', 'vbnm,,'),
(57, 'locatin', '34567890', 'vbnm,,'),
(58, 'Experience', '4-5', 'fghjklkjhg'),
(59, 'Technologies', 'html,php,mysql,javascript', 'fghjklkjhg'),
(60, 'Experience', '1-2', 'nm,k'),
(61, 'Technologies', 'php,mysql', 'nm,k'),
(62, 'Cur pack', 'You skipped this question.!', 'nm,k'),
(63, 'Exp. pack', '8-9', 'nm,k'),
(64, 'Relocate', 'You skipped this question.!', 'nm,k'),
(65, 'Team size', '4-5', 'nm,k'),
(66, 'Experience', '2-3', 'John'),
(67, 'Technologies', 'php,mysql', 'John'),
(68, 'Cur pack', '4 LPA', 'John'),
(69, 'Exp. pack', '6-7', 'John'),
(70, 'Relocate', 'yes', 'John'),
(71, 'Team size', '2-3', 'John'),
(72, 'locatin', 'Hyderabad', 'John'),
(73, 'Experience', '2-3', 'Saiprasad'),
(74, 'Technologies', 'html,mysql', 'Saiprasad'),
(75, 'Cur pack', '4LPA', 'Saiprasad'),
(76, 'Exp. pack', '6-7', 'Saiprasad'),
(77, 'Relocate', 'You skipped this question.!', 'Saiprasad'),
(78, 'Team size', '2-3', 'Saiprasad'),
(79, 'locatin', 'Karimnagar', 'Saiprasad'),
(80, 'Experience', '3-4', 'Saiprasad'),
(81, 'Technologies', 'html,php,mysql,javascript', 'Saiprasad'),
(82, 'Cur pack', 'You skipped this question.!', 'Saiprasad'),
(83, 'Exp. pack', '6-7', 'Saiprasad'),
(84, 'Experience', '1-2', 'ssss'),
(85, 'Experience', '1-2', 'ssssj'),
(86, 'Technologies', 'php,mysql', 'ssssj'),
(87, 'Cur pack', 'You skipped this question.!', 'ssssj'),
(88, 'Exp. pack', '7-8', 'ssssj'),
(89, 'Relocate', 'yes', 'ssssj'),
(90, 'Team size', '2-3', 'ssssj'),
(91, 'locatin', 'hyderabad', 'ssssj'),
(92, 'Experience', '1-2', 'prasad'),
(93, 'Technologies', 'php', 'prasad'),
(94, 'Cur pack', 'You skipped this question.!', 'prasad'),
(95, 'Exp. pack', '5-6', 'prasad'),
(96, 'Relocate', 'You skipped this question.!', 'prasad'),
(97, 'Team size', '1-2', 'prasad'),
(98, 'locatin', 'hyf', 'prasad'),
(99, 'Experience', '2-3', 'prasad'),
(100, 'Technologies', 'html', 'prasad'),
(101, 'Cur pack', 'You skipped this question.!', 'prasad'),
(102, 'Exp. pack', '4-5', 'prasad'),
(103, 'Experience', '1-2', 'saiprasad'),
(104, 'Technologies', 'php', 'saiprasad'),
(105, 'Cur pack', 'You skipped this question.!', 'saiprasad'),
(106, 'Exp. pack', '7-8', 'saiprasad'),
(107, 'Relocate', 'yes', 'saiprasad'),
(108, 'Team size', '1-2', 'saiprasad'),
(109, 'Experience', '1-2', 'saiprasad'),
(110, 'Technologies', 'javascript', 'saiprasad');

-- --------------------------------------------------------

--
-- Table structure for table `question_option`
--

DROP TABLE IF EXISTS `question_option`;
CREATE TABLE IF NOT EXISTS `question_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_option`
--

INSERT INTO `question_option` (`id`, `question_id`, `option_name`) VALUES
(1, 1, '1-2'),
(2, 1, '2-3'),
(3, 1, '3-4'),
(4, 1, '4-5'),
(5, 2, 'html'),
(6, 2, 'php'),
(7, 2, 'mysql'),
(8, 2, 'javascript'),
(9, 4, '1-2'),
(10, 4, '2-3'),
(11, 4, '3-4'),
(12, 4, '4-5'),
(13, 4, '5-6'),
(14, 4, '6-7'),
(15, 4, '7-8'),
(16, 4, '8-9'),
(17, 5, 'yes'),
(18, 5, 'no'),
(20, 7, '1-2'),
(21, 7, '2-3'),
(22, 7, '3-4'),
(23, 7, '4-5');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
